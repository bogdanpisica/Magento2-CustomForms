<?php

namespace Thecon\CustomForms\Controller\Adminhtml\Collaboration;

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
		$resultPage->getConfig()->getTitle()->prepend((__('Collaboration Requests')));
		$resultPage->setActiveMenu('Thecon_CustomForms::collaboration');
		$resultPage->addBreadcrumb(__('Collaboration'), __('Collaboration'));

		return $resultPage;
	}

	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }


}