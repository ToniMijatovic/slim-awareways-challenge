<?php

namespace App\Services;

use App\Enums\QuestionTypeEnum;
use App\Models\Question;
use App\Models\QuizQuestion;

class QuestionService extends Service
{
    private int $quizId;
    private string $text;
    private string $type;
    private array $answers;
    private array $terms;
    private array $topics;
    private array $allocations;

    /**
     * @param int $quizId
     * @return self
     */
    public function setQuizId(int $quizId): self
    {
        $this->quizId = $quizId;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuizId(): int
    {
        return $this->quizId;
    }

    /**
     * @param string $text
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = QuestionTypeEnum::from($type)->name;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param $answers
     * @return self
     */
    public function setAnswers($answers): self
    {
        foreach ($answers as $answerData) {
            $answer = new AnswerService();
            $answer->setText($answerData['text']);
            if (isset($answerData['answer_id'])) {
                $answer->setId($answerData['answer_id']);
            }
            if (isset($answerData['is_correct'])) {
                $answer->setIsCorrect($answerData['is_correct']);
            }
            $this->answers[] = $answer;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * @param $terms
     * @return self
     */
    public function setTerms($terms): self
    {
        foreach ($terms as $termData) {
            $term = new TermService();
            $term->setText($termData['text']);

            if (isset($termData['term_id'])) {
                $term->setId($termData['term_id']);
            }

            $this->terms[] = $term;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getTerms(): array
    {
        return $this->terms;
    }

    /**
     * @param $topics
     * @return self
     */
    public function setTopics($topics): self
    {
        foreach ($topics as $topicData) {
            $topic = new TopicService();
            $topic->setText($topicData['text']);

            if (isset($topicData['topic_id'])) {
                $topic->setId($topicData['topic_id']);
            }

            $this->topics[] = $topic;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getTopics(): array
    {
        return $this->topics;
    }

    /**
     * @param $allocations
     * @return self
     */
    public function setAllocations($allocations): self
    {
        foreach ($allocations as $allocationData) {
            $allocation = new AllocationService();
            $allocation
                ->setTermIndex($allocationData['term_index'])
                ->setTopicIndex($allocationData['topic_index']);
            $this->allocations[] = $allocation;
        }

        return $this;
    }

    /**
     * @return void
     */
    public function createDragAndDrop(): void
    {
        $termsData = [];
        $topicsData = [];

        foreach ($this->terms as $term) {
            $termsData[] = $term->create();
        }

        foreach ($this->topics as $topic) {
            $topicsData[] = $topic->create();
        }

        foreach ($this->allocations as $allocation) {
            $termIndex = $allocation->getTermIndex();
            $topicIndex = $allocation->getTopicIndex();
            if (isset($termsData[$termIndex]) && isset($topicsData[$topicIndex])) {
                $termId = $termsData[$termIndex]['id'] ?? false;
                $topicId = $topicsData[$topicIndex]['id'] ?? false;
                $allocation
                    ->setQuestionId($this->id)
                    ->setTermId($termId)
                    ->setTopicId($topicId)
                    ->create();
            }
        }
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $question = Question::updateOrCreate(['id' => $this->id ?? null], [
            'text' => $this->text,
            'type' => $this->type
        ]);

        if ($question) {
            $this->setId($question->id);
            QuizQuestion::updateOrCreate(['quiz_id' => $this->quizId, 'question_id' => $this->id]);

            if ($this->type === QuestionTypeEnum::DRAG_AND_DROP->name) {
                $this->createDragAndDrop();
            } else {
                foreach ($this->answers as $answer) {
                    $answer
                        ->setQuestionId($this->id)
                        ->create();
                }
            }

        }
    }
}
