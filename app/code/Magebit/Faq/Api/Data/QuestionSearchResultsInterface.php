<?php

namespace Magebit\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get post list.
     *
     * @return QuestionInterface[]
     */
    public function getItems(): array;

    /**
     * Set post list.
     *
     * @param QuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
