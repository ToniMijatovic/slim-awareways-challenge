<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\QuestionAnswer;

class AnswerService extends Service
{
    private int $questionId;
    private string $text;
    private bool $isCorrect;

    /**
     * @param int $id
     * @return $this
     */
    public function setQuestionId(int $id): self
    {
        $this->questionId = $id;

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
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param bool $isCorrect
     * @return $this
     */
    public function setIsCorrect(bool $isCorrect): self
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsCorrect(): bool
    {
        return $this->isCorrect;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return void
     */
    public function create(): void
    {
        if ($this->questionId) {
            $answer = Answer::updateOrCreate(['id' => $this->id ?? null], [
                'text' => $this->text,
                'is_correct' => $this->isCorrect ?? true
            ]);

            if ($answer) {
                $this->setId($answer->id);
                QuestionAnswer::updateOrCreate(['question_id' => $this->questionId, 'answer_id' => $this->id]);
            }
        }
    }

}
