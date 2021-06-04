<?php

namespace Thecon\CustomForms\Controller\Offer;

use Magento\Framework\Controller\ResultFactory;
use Thecon\CustomForms\Model\OfertaFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Mail\Template\TransportBuilder;

class Form extends \Magento\Framework\App\Action\Action
{

    protected $_offerFactory;
    protected $_pageFactory;
    protected $__scopeConfig;
    protected $_inlineTranslation;
    protected $_transportBuilder;
    protected $_storeManager;

    
    const XML_PATH_NAME_SEND_TO_OFFER = 'customforms/oferta/send_email_to_name_offer';
    const XML_PATH_EMAIL_SEND_TO_OFFER = 'customforms/oferta/send_email_to_offer';
    const XML_PATH_EMAIL_SUBJECT_OFFER = 'customforms/oferta/email_subject_offer';
    const XML_PATH_EMAIL_OFFER  = 'customforms/oferta/email_template';

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        OfertaFactory $offerFactory,
        ScopeConfigInterface $scopeConfig,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_offerFactory = $offerFactory;
        $this->_pageFactory = $pageFactory;
        $this->__scopeConfig = $scopeConfig;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {  
        $oferta = (array)$this->getRequest()->getPost();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        try {
            if ($oferta && !empty($oferta)) {

                $senderInfoo = [
                    'name' => $this->__scopeConfig->getValue(self::XML_PATH_NAME_SEND_TO_OFFER, ScopeInterface::SCOPE_STORE),
                    'email' => $this->__scopeConfig->getValue(self::XML_PATH_EMAIL_SEND_TO_OFFER, ScopeInterface::SCOPE_STORE)
                ];

                $templateOptions = [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
                ];

                $storeScopee = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
                $templateIdd = $this->__scopeConfig->getValue(self::XML_PATH_EMAIL_OFFER, ScopeInterface::SCOPE_STORE);

                $templateVarss = [
                    'store' => [],
                    'subject' => $this->__scopeConfig->getValue(self::XML_PATH_EMAIL_SUBJECT_OFFER, ScopeInterface::SCOPE_STORE),
                    'nume_prenume' => $oferta['nume_prenume'],
                    'telefon' => $oferta['telefon'],
                    'email' => $oferta['email'],
                    'mesaj' => $oferta['mesaj']
                ];


                $transport = $this->_transportBuilder
                    ->setTemplateIdentifier($templateIdd, $storeScopee)
                    ->setTemplateOptions($templateOptions)
                    ->setTemplateVars($templateVarss)
                    ->setFrom($senderInfoo)
                    ->addTo($senderInfoo['email'],$senderInfoo['name'])
                    ->getTransport();
                $transport->sendMessage();

                $salvare = $this->_offerFactory->create();
                $salvare->setData($oferta)->save();
                $this->messageManager->addSuccessMessage(__("Your request has been sent. You will receive an answer as soon as possible. Thank you!"));

                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }

        $this->resultPage = $this->_pageFactory->create();
        $this->resultPage->getConfig()->getTitle()->set((__('Reseller Offers')));
        return $this->resultPage;
    }
}