<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By: MageDelight Pvt. Ltd.
 */
namespace Magebit\Faq\Model\Question;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;
    // @codingStandardsIgnoreStart
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $questionCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $questionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    // @codingStandardsIgnoreEnd
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $question) {
            $this->loadedData[$question->getId()] = $question->getData();
        }
        return $this->loadedData;
    }
}
