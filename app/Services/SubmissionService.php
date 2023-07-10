<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Submission;
use App\Models\Term;
use App\Models\Topic;

class SubmissionService extends Service
{
    private int $quizId;
    private ClientService $clientService;
    private string $date;
    private array $answers;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @param int $clientId
     * @return self
     */
    public function setClientId(int $clientId): self
    {
        $this->clientService->setId($clientId);

        return $this;
    }

    /**
     * @return int
     */
    private function getClientId(): int
    {
        return $this->clientService->getId();
    }

    /**
     * @return int
     */
    public function getQuizId(): int
    {
        return $this->quizId;
    }

    /**
     * @param mixed $quizId
     * @return self
     */
    public function setQuizId(int $quizId): self
    {
        $this->quizId = $quizId;

        return $this;
    }

    /**
     * @return mixed
     * @return string
     */
    public function getDate(): string
    {
        return $this->quizId;
    }

    /**
     * @param string $date
     * @return self
     */
    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param $answers
     * @return $this
     */
    public function setAnswers($answers): self
    {
        foreach ($answers as $answerData) {
            $answer = new UserAnswerService();
            $answer->setQuestionId($answerData['question_id']);
            if (isset($answerData['term_id']) && isset($answerData['topic_id'])) {
                $termExists = Term::existsById($answerData['term_id']);
                $topicExists = Topic::existsById($answerData['topic_id']);
                if ($termExists && $topicExists) {
                    $answer->setTermId($answerData['term_id'])
                        ->setTopicId($answerData['topic_id']);
                }
            } else {
                if (Answer::existsById($answerData['answer_id'])) {
                    $answer->setAnswerId($answerData['answer_id']);
                }
            }
            $this->answers[] = $answer;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function create(): bool
    {
        $exists = $this->clientService->exists($this->getClientId());

        if (!$exists) {
            return false;
        }

        $submission = new Submission([
            'quiz_id' => $this->quizId,
            'client_id' => $this->getClientId(),
            'date' => $this->date
        ]);

        if ($submission->save()) {
            $this->setId($submission->id);

            foreach ($this->answers as $answer) {
                $answer->setSubmissionId($this->id)
                    ->create();
            }
        }

        return true;
    }
}
