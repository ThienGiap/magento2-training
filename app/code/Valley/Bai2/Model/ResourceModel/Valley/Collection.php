<?php

namespace Valley\Bai2\Model\ResourceModel\Valley;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(\Valley\Bai2\Model\Valley::class, \Valley\Bai2\Model\ResourceModel\Valley::class);
    }
}