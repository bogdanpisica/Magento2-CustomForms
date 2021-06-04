<?php
namespace Thecon\CustomForms\Block\Adminhtml;

class Oferta extends \Magento\Backend\Block\Widget\Grid\Container
{

	protected function _construct()
	{
		$this->_controller = 'adminhtml_offer';
		$this->_blockGroup = 'Thecon_CustomForms';
		$this->_headerText = __('Reseller Offers');
		parent::_construct();
	}

	protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}