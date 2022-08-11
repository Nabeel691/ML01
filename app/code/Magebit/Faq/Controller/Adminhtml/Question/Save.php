<?php
declare(strict_types=1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Api\Data\QuestionInterfaceFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    protected $dataPersistor;
    protected $questionInterfaceFactory;

    protected $questionRepositoryInterface;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        QuestionInterfaceFactory $questionInterfaceFactory,
        QuestionRepositoryInterface $questionRepositoryInterface
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->questionInterfaceFactory = $questionInterfaceFactory;
        $this->questionRepositoryInterface = $questionRepositoryInterface;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info(json_encode($data));
        if ($data) {
            $id = $this->getRequest()->getParam('id');
            if (!$id) {
                $model = $this->questionInterfaceFactory->create();
                $model->setData($data);
            } else {
                $model = $this->questionRepositoryInterface->getById($id);
            }
            try {
                $this->questionRepositoryInterface->save($model);
                if (!$model->getId() && $id) {
                    $this->messageManager->addErrorMessage(__('This Add new FAQ form no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }

                $this->messageManager->addSuccessMessage(__('You saved the Faq.'));
                $this->dataPersistor->clear('faqquestionform');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the faq form.'));
            }

            $this->dataPersistor->set('faqquestionform', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
