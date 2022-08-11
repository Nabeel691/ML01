<?php

declare(strict_types=1);



use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;

class View implements ActionInterface {
    private PageFactory $resultPageFactory;

    public function __construct(PageFactory $resultPageFactory) {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute() {
        return $this->resultPageFactory->create(ResultFactory::TYPE_PAGE);
    }
}
