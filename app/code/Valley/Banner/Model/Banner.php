<?php

namespace Valley\Banner\Model;

use Magento\Framework\Model\AbstractModel;

class Banner extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Valley\Banner\Model\ResourceModel\Banner::class);
    }
}