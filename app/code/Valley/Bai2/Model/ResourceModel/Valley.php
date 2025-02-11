<?php

namespace Valley\Bai2\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Valley extends AbstractDb
{
    protected function _construct()
    {
        // Tên bảng và khóa chính
        $this->_init('valley_bai2', 'valley_id');
    }
}