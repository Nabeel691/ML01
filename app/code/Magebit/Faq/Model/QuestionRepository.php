<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionInterfaceFactory;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterfaceFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Model\ResourceModel\Question as ResourceQuestion;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Question repository
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var ResourceQuestion
     */
    private $resource;
    /**
     * @var QuestionCollectionFactory
     */
    private $collectionFactory;
    /**
     * @var QuestionFactory
     */
    private $questionFactory;
    /**
     * @var QuestionInterfaceFactory
     */
    private $questionInterfaceFactory;
    /**
     * @var questionSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @param ResourcePost $resource
     * @param QuestionFactory $questionFactory
     * @param QuestionInterfaceFactory $questionInterfaceFactory
     * @param QuestionCollectionFactory $collectionFactory
     * @param QuestionSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceQuestion                      $resource,
        QuestionFactory                       $questionFactory,
        QuestionInterfaceFactory              $questionInterfaceFactory,
        QuestionCollectionFactory             $collectionFactory,
        QuestionSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface      $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->questionInterfaceFactory = $questionInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }
    /**
     * @param int $questionId
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $questionId): bool
    {
        return $this->delete($this->getById($questionId));
    }

    /**
     * @param QuestionInterface $question
     * @return bool
     */
    public function delete(QuestionInterface $question): bool
    {
        try {
            $this->resource->delete($question);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the question: %1', $exception->getMessage())
            );
        }
        return true;
    }

    /**
     * @param int $questionId
     * @return QuestionInterface
     */
    public function getById(int $questionId): QuestionInterface
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $questionId);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('The question with the "%1" ID doesn\'t exist.', $questionId));
        }

        return $question;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function save(QuestionInterface $question): QuestionInterface
    {
        try {
            $this->resource->save($question);
        } catch (LocalizedException $exception) {
            throw new CouldNotSaveException(
                __('Could not save the question: %1', $exception->getMessage()),
                $exception
            );
        } catch (\Throwable $exception) {
            throw new CouldNotSaveException(
                __('Could not save the question: %1', __('Something went wrong while saving the question.')),
                $exception
            );
        }
        return $question;
    }
}
