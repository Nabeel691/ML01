<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By: MageDelight Pvt. Ltd.
 */
namespace Magebit\Faq\Controller\Adminhtml\Question;
use Magento\Backend\App\Action;
use Magebit\Faq\Model\Question;
use Magento\Backend\App\Action\Context;

class Delete extends Action
{
    /**
     * @var \MD\UiExample\Model\Blog
     */
    protected $modelBlog;
    /**
     * @param Context  $context
     * @param Question $questionFactory
     */
    public function __construct(
        Context $context,
        Question $questionFactory
    ) {
        parent::__construct($context);
        $model = null;
        $this->modelBlog = $model;
    }
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magebit_Faq::question_delete');
    }
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->modelBlog;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Record deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Record does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}
