<?php

namespace Valley\Bai2\Controller\Index;

use Magento\Framework\App\Action\Action;
use Valley\Bai2\Model\ValleyFactory;

class Index extends Action
{
    protected $valleyFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        ValleyFactory $valleyFactory
    ) {
        parent::__construct($context);
        $this->valleyFactory = $valleyFactory;
    }

    public function execute()
    {
        /** 
         * Insert data into db table valley_bai2
         */

        $valley = $this->valleyFactory->create();

        $collection = $valley->getCollection();

        /** 
         * Select all data from table valley_bai2
         */
        // $data = $collection->getData();

        /** 
         * Select data from table valley_bai2 where = ? and = ? or = ?
         */
        $data = $collection
            // ->addFieldToSelect('valley_id') // chỉ lấy ra cột valley_id
            ->addFieldToFilter('valley_id', ['gt' => 0])
            // ->addFieldToFilter('image', ['like' => '%.jpeg'])
            ->addFieldToFilter('image', [
                ['like' => '%.jpeg'],
                ['like' => '%.png']
            ])
            ->getData(); // gt: greater than

        // addFieldToFilter() hàm thêm đk truy vấn
        foreach ($data as $item) {
            echo '<h3>';
            echo 'Id: ' . $item['valley_id'] .  ', Image: ' . $item['image'] .  ', Link: ' . $item['link'] . '<br>';
            echo '</h3>';
        }

        echo 'Insert data successfully';
        exit;
    }
}
