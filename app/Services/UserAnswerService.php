<?php

namespace App\Services;

use App\Models\UserAnswer;

class UserAnswerService extends Service
{
    private int $submissionId;
    private int $questionId;
    private int $answerId;
    private int $termId;
    private int $topicId;

    /**
     * @return int
     */
    public function getSubmissionId(): int
    {
        return $this->submissionId;
    }

    /**
     * @param int $submission_id
     * @return $this
     */
    public function setSubmissionId(int $submission_id): self
    {
        $this->submissionId = $submission_id;
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
     * @param int $question_id
     * @return $this
     */
    public function setQuestionId(int $question_id): self
    {
        $this->questionId = $question_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getAnswerId(): int
    {
        return $this->answerId;
    }

    /**
     * @param int $answer_id
     * @return $this
     */
    public function setAnswerId(int $answer_id): self
    {
        $this->answerId = $answer_id;
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
     * @param int $term_id
     * @return $this
     */
    public function setTermId(int $term_id): self
    {
        $this->termId = $term_id;
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
     * @param int $topic_id
     * @return $this
     */
    public function setTopicId(int $topic_id): self
    {
        $this->topicId = $topic_id;
        return $this;
    }

    /**
     * @return bool
     */
    public function create(): bool
    {
        if (!isset($this->questionId)) {
            return false;
        }

        $createArray = [
            'submission_id' => $this->submissionId,
            'question_id' => $this->questionId,
        ];

        if (isset($this->termId) && isset($this->topicId)) {
            $createArray = [...$createArray, 'term_id' => $this->termId, 'topic_id' => $this->topicId];
        } else {
            $createArray = [...$createArray, 'answer_id' => $this->answerId];
        }

        $userAnswer = new UserAnswer($createArray);

        return $userAnswer->save();
    }
}
