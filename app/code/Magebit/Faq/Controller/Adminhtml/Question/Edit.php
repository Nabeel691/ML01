<?php
declare(strict_types=1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Api\Data\QuestionInterfaceFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Setup\Exception;

class Edit extends Action
{
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        QuestionInterfaceFactory $questionInterfaceFactory,
        QuestionRepositoryInterface $questionRepositoryInterface
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->questionInterfaceFactory = $questionInterfaceFactory;
        $this->questionRepositoryInterface = $questionRepositoryInterface;
        parent::__construct($context);
    }

    /**
     * Edit action
     *
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info(json_encode($id));

        // 2. Initial checking
        if ($id) {
            try {
                $model = $this->questionRepositoryInterface->getById((int)$id);
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(__('This FAQ no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Faq Question'));
        return $resultPage;
    }
}
