<?php

namespace Valley\Banner\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(\Valley\Banner\Model\Banner::class, \Valley\Banner\Model\ResourceModel\Banner::class);
    }
}