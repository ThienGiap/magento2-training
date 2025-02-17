<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Valley\Banner\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Valley\Banner\Model\Banner;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Save CMS page action.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Valley_Banner::save';

    protected $dataProcessor;
    protected $dataPersistor;

    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            // Optimize data
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Banner::STATUS_ENABLED;
            }
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            if (empty($data['images'])) {
                $data['images'] = null;
            } else {
                if ($data['images'][0] && $data['images'][0]['name']) {
                    $data['image'] = $data['images'][0]['name'];
                } else {
                    $data['image'] = null;
                }
            }

            // Init model and load by ID if exists
            $model = $this->_objectManager->create('Valley\Banner\Model\Banner');
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }


            // Validate data
            if (!$this->dataProcessor->validateRequireEntry($data)) {
                // Redirect to Edit page if has error
                return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]); // Redirect to Edit page
            }

            // Update model
            $model->setData($data);

            echo "<pre>";
            var_dump($model->setData($data));
            die;
            echo "</pre>";

            // Save data to database
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the image.'));
                $this->dataPersistor->clear('banner');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the image.'));
            }

            $this->dataPersistor->set('banner', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        // Redirect to List page
        return $resultRedirect->setPath('*/*/');
    }
}
