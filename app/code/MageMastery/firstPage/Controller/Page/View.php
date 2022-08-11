<?php

declare(strict_types=1);

namespace mageMastery\firstPage\Controller\Page;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class View implements ActionInterface {

    private JsonFactory $resultJsonFactory;

    public function __construct(JsonFactory $resultJsonFactory) {
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute() : Json {
        $jsonResult = $this->resultJsonFactory->create();
        return $jsonResult->setData([ 'message' => 'My first page' ]);
    }

}