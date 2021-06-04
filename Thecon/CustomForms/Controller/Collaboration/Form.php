<?php

namespace Thecon\CustomForms\Controller\Collaboration;

use Magento\Framework\Controller\ResultFactory;
use Thecon\CustomForms\Model\SolicitareFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Mail\Template\TransportBuilder;

class Form extends \Magento\Framework\App\Action\Action
{

    protected $postFactory;
    protected $_pageFactory;
    protected $_scopeConfig;
    protected $_inlineTranslation;
    protected $_transportBuilder;
    protected $_storeManager;

    
    const XML_PATH_NAME_SEND_TO = 'customforms/collaboration/send_email_to_name';
    const XML_PATH_EMAIL_SEND_TO = 'customforms/collaboration/send_email_to';
    const XML_PATH_EMAIL_SUBJECT = 'customforms/collaboration/email_subject';
    const XML_PATH_EMAIL_TEMPLATE_FIELD  = 'customforms/collaboration/email_template_admin';

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        SolicitareFactory $postFactory,
        ScopeConfigInterface $scopeConfig,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->postFactory = $postFactory;
        $this->_pageFactory = $pageFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {  
        $post = (array)$this->getRequest()->getPost();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        try {
            if ($post && !empty($post)) {
                $senderInfo = [
                    'name' => $this->_scopeConfig->getValue(self::XML_PATH_NAME_SEND_TO, ScopeInterface::SCOPE_STORE),
                    'email' => $this->_scopeConfig->getValue(self::XML_PATH_EMAIL_SEND_TO, ScopeInterface::SCOPE_STORE)
                ];

                $templateOptions = [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID
                ];

                $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
                $templateId = $this->_scopeConfig->getValue(self::XML_PATH_EMAIL_TEMPLATE_FIELD, ScopeInterface::SCOPE_STORE);

                $templateVars = [
                    'store' => [],
                    'subject' => $this->_scopeConfig->getValue(self::XML_PATH_EMAIL_SUBJECT, ScopeInterface::SCOPE_STORE),
                    'nume_firma' => $post['nume_firma'],
                    'localitate_sediu' => $post['localitate_sediu'],
                    'nume_reprezentant' => $post['nume_reprezentant'],
                    'specific_vanzare' => $post['specific_vanzare'],
                    'telefon' => $post['telefon'],
                    'email' => $post['email']
                ];


                $transport = $this->_transportBuilder
                    ->setTemplateIdentifier($templateId, $storeScope)
                    ->setTemplateOptions($templateOptions)
                    ->setTemplateVars($templateVars)
                    ->setFrom($senderInfo)
                    ->addTo($senderInfo['email'],$senderInfo['name'])
                    ->getTransport();
                $transport->sendMessage();

                $model = $this->postFactory->create();
                $model->setData($post)->save();
                $this->messageManager->addSuccessMessage(__("Your request has been sent. You will receive an answer as soon as possible. Thank you!"));

                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setUrl($this->_redirect->getRefererUrl());
                return $resultRedirect;
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }

        $this->resultPage = $this->_pageFactory->create();
        $this->resultPage->getConfig()->getTitle()->set((__('Collaboration Request')));
        return $this->resultPage;
    }
}