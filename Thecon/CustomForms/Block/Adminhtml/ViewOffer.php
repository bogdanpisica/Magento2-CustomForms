<?php
namespace Thecon\CustomForms\Block\Adminhtml;
use Thecon\CustomForms\Model\OfertaFactory;

use Magento\Backend\Block\Template;

class ViewOffer extends Template
{
   public $_template = 'Thecon_CustomForms::viewOffer.phtml';
   protected $postFactory;

   public function __construct(
       \Magento\Backend\Block\Template\Context $context,
       \Thecon\CustomForms\Model\OfertaFactory $postFactory
   ) {
       $this->postFactory = $postFactory;
       parent::__construct($context);
   }

   public function getDataInfo() {

        $ceva = $this->getRequest()->getPost();
        $result = $this->postFactory->create();
        $sortare = $result->load($ceva['id']);
        return $sortare;
   }
}