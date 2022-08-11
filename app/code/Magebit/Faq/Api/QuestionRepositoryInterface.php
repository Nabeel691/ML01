<?php

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;

interface QuestionRepositoryInterface
{
    /**
     * Delete Question.
     *
     * @param QuestionInterface $question
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(QuestionInterface $question): bool;

    /**
     * Delete Question by ID.
     *
     * @param int $questionId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $questionId): bool;

    /**
     * Retrieve question.
     *
     * @param int $questionId
     * @return QuestionInterface
     * @throws LocalizedException
     */
    public function getById(int $questionId): QuestionInterface;

    /**
     * Retrieve questions matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PostSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Save question.
     *
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws LocalizedException
     */
    public function save(QuestionInterface $question): QuestionInterface;
}
