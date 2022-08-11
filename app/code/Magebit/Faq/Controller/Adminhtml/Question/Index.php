<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPagefactory;

    /**
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PafeFactory $resultPageFactory
     */

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPagefactory = $resultPageFactory;
    }

    /**
     * Load the page defined in view\adminhtml\layout\faq_question_index.xml
     *
     * @return \Magento\Framework\View\result\Page
     */

    public function execute()
    {
        $resultPage = $this->resultPagefactory->create();
//        $resultPage->setActiveMenu("Magento_Backend::content_elements");
        $resultPage->getConfig()->getTitle()->prepend('Frequently Asked Questions');
        return $resultPage;
    }
}
