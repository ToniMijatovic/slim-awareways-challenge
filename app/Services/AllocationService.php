<?php

namespace App\Services;

use App\Models\Allocation;

class AllocationService
{
    private int $questionId;
    private int $termId;
    private int $topicId;
    private int $termIndex;
    private int $topicIndex;

    /**
     * @return int
     */
    public function getTopicIndex(): int
    {
        return $this->topicIndex;
    }

    /**
     * @param int $topicIndex
     * @return AllocationService
     */
    public function setTopicIndex(int $topicIndex): self
    {
        $this->topicIndex = $topicIndex;

        return $this;
    }

    /**
     * @return int
     */
    public function getTermIndex(): int
    {
        return $this->termIndex;
    }

    /**
     * @param int $termIndex
     * @return AllocationService
     */
    public function setTermIndex(int $termIndex): self
    {
        $this->termIndex = $termIndex;

        return $this;
    }

    /**
     * @return int
     */
    public function getTopicId(): int
    {
        return $this->topicId;
    }

    /**
     * @param int $topicId
     * @return AllocationService
     */
    public function setTopicId(int $topicId): self
    {
        $this->topicId = $topicId;

        return $this;
    }

    /**
     * @return int
     */
    public function getTermId(): int
    {
        return $this->termId;
    }

    /**
     * @param int $termId
     * @return AllocationService
     */
    public function setTermId(int $termId): self
    {
        $this->termId = $termId;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    /**
     * @param int $questionId
     * @return AllocationService
     */
    public function setQuestionId(int $questionId): self
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * @return void
     */
    public function create(): void
    {
        Allocation::updateOrCreate([
            'question_id' => $this->questionId,
            'term_id' => $this->termId,
            'topic_id' => $this->topicId
        ]);
    }

}
