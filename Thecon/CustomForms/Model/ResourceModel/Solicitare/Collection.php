<?php
namespace Thecon\CustomForms\Model\ResourceModel\Solicitare;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            'Thecon\CustomForms\Model\Solicitare',
            'Thecon\CustomForms\Model\ResourceModel\Solicitare'
        );
    }
}
