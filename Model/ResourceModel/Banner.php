<?php

namespace Technobit\Banner\Model\ResourceModel;

/**
 * Class Banner
 * @package Technobit\Banner\Model\ResourceModel
 */
class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table and primary key column
     */
    protected function _construct()
    {
        $this->_init('technobit_banner', 'banner_id');
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return \Magento\Framework\Model\ResourceModel\Db\AbstractDb
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        if (is_array($object->getStoreId())) {
            $object->setStoreId(implode(',', $object->getStoreId()));
        }
        return parent::_beforeSave($object);
    }

    /**
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return \Magento\Framework\Model\ResourceModel\Db\AbstractDb
     */
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        $object->setStoreId(explode(',', $object->getStoreId()));
        return parent::_afterLoad($object);
    }
}
