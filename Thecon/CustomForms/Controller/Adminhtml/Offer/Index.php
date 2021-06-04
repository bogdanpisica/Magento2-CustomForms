<?php

namespace Thecon\CustomForms\Controller\Adminhtml\Offer;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Reseller Offers')));
		$resultPage->setActiveMenu('Thecon_CustomForms::offer');
		$resultPage->addBreadcrumb(__('Offers'), __('Offers'));

		return $resultPage;
	}

	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }


}