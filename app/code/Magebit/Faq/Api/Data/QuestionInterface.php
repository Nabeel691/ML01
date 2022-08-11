<?php

namespace Magebit\Faq\Api\Data;

interface QuestionInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID = 'id';
    const QUESTION = 'question';
    const ANSWER = 'answer';
    const STATUS = 'status';
    const POSITION = 'position';
    const UPDATED_AT = 'updated_at';

    /**
     * @return ?int
     */
    public function getId(): ?int;

    /**
     * @return string
     */
    public function getQuestion(): string;

    /**
     * @return string
     */
    public function getAnswer(): string;

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * Get created at
     *
     * @return string
     */
    public function getPosition(): string;

    /**
     * Get created at
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * @param string $question
     * @return QuestionInterface
     */
    public function setQuestion(string $question): QuestionInterface;

    /**
     * @param string answer
     * @return QuestionInterface
     */
    public function setAnswer(string $answer): QuestionInterface;

    /**
     * @param string $status
     * @return QuestionInterface
     */
    public function setStatus(string $status): QuestionInterface;

    /**
     * Get created at
     *
     * @param int $position
     * @return QuestionInterface
     */
    public function setPosition(int $position): QuestionInterface;

}
