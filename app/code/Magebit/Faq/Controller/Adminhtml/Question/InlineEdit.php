<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\ResourceModel\Question\Collection;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action
{

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var Collection
     */
    protected $questionCollection;

    /**
     * @param Context     $context
     * @param Collection  $questionCollection
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context     $context,
        Collection  $questionCollection,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->questionCollection = $questionCollection;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /**
         * @var \Magento\Framework\Controller\Result\Json $resultJson
         */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postData = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postData))) {
            return $resultJson->setData(
                [
                    'messages' => [__('Please correct the data that you send.')],
                    'error' => true,
                ]
            );
        }

        try {
            $this->questionCollection
                ->addFieldToFilter('id', ['in' => array_keys($postData)])
                ->walk('saveCollection', [$postData]);
        } catch (\Exception $e) {
            $messages[] = __('There was an error saving the data: ') . $e->getMessage();
            $error = true;
        }

        return $resultJson->setData(
            [
                'messages' => $messages,
                'error' => $error,
            ]
        );
    }
}
