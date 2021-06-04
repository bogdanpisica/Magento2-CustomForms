<?php
namespace Thecon\CustomForms\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Thecon\CustomForms\Model\SolicitareFactory;

class View extends Template
{
   public $_template = 'Thecon_CustomForms::view.phtml';

   protected $postFactory;

     public function __construct(
       \Magento\Backend\Block\Template\Context $context,
       \Thecon\CustomForms\Model\SolicitareFactory $postFactory
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