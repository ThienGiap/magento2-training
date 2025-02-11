<?php

namespace Valley\Bai2\Model;

use Magento\Framework\Model\AbstractModel;

class Valley extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Valley\Bai2\Model\ResourceModel\Valley::class);
    }
}