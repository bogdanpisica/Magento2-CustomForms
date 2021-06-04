<?php
namespace Thecon\CustomForms\Block\Adminhtml;

class Solicitare extends \Magento\Backend\Block\Widget\Grid\Container
{

	protected function _construct()
	{
		$this->_controller = 'adminhtml_collaboration';
		$this->_blockGroup = 'Thecon_CustomForms';
		$this->_headerText = __('Collaboration Requests');
		parent::_construct();
	}

	protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}