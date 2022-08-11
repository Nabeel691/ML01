<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Question extends AbstractExtensibleModel implements QuestionInterface, IdentityInterface
{
    const CACHE_TAG = 'Magebit_Faq_module_Question';

    protected function _construct()
    {
        $this->_init(ResourceModel\Question::class);
        $this->setIdFieldName('id');
    }

    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId(): ?int
    {
        return $this->getData(self::ID);
    }

    public function getQuestion(): string
    {
        return $this->getData(self::QUESTION);
    }

    public function getAnswer(): string
    {
        return $this->getData(self::ANSWER);
    }

    public function getStatus(): string
    {
        return $this->getData(self::STATUS);
    }

    public function getPosition(): string
    {
        return $this->getData(self::POSITION);
    }

    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setQuestion(string $question): QuestionInterface
    {
        return $this->setData(self::QUESTION, $question);
    }

    public function setAnswer(string $answer): QuestionInterface
    {
        return $this->setData(self::ANSWER, $answer);
    }

    public function setStatus(string $status): QuestionInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    public function setPosition(int $position): QuestionInterface
    {
        return $this->setData(self::POSITION, $position);
    }
}
