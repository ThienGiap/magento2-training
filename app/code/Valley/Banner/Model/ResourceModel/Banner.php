<?php

namespace Valley\Banner\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Banner extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('banner', 'id');
    }

    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $image = $object->getData('image');
        if ($image != null) {
            $imageUploader = \Magento\Framework\App\ObjectManager::getInstance()->get('Valley\Banner\BannerImageUpload');
            $imageUploader->moveFileFromTmp($image); // moveFileFromTmp() Cho phép di chuyển file từ thư mục tạm sang thư mục chính thức
        }

        return $this;
    }
}