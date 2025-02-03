<?php

namespace Valley\Bai2\Controller\Index;

use Magento\Framework\App\Action\Action;

class Index extends Action
{
    protected $pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo "Valley 2";
        exit;
    }
}