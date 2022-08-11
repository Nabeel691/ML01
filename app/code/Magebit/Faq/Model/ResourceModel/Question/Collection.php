<?php

namespace Magebit\Faq\Model\ResourceModel\Question;

use Magebit\Faq\Model\Question as QuestionModel;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * Define model / resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(QuestionModel::class, QuestionResourceModel::class);
    }
}
