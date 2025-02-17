<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Valley\Banner\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Valley\Banner\Model\BannerFactory;

class InlineEdit extends \Magento\Backend\App\Action implements HttpGetActionInterface, HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Valley_Banner::save';

    protected $_coreRegistry;
    protected $jsonFactory;
    protected $bannerFactory;

    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        BannerFactory $bannerFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->bannerFactory = $bannerFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);

        foreach (array_keys($postItems) as $bannerId) {
            try {
                $banner = $this->bannerFactory->create();
                $banner->load($bannerId);
                $banner->setData($postItems[(string)$bannerId]);
                $banner->save();
            } catch (\Exception $e) {
                $messages[] = __('Something went wrong');
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
