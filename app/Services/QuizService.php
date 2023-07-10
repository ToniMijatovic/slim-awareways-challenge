<?php

namespace App\Services;

use App\Models\Quiz;

class QuizService extends Service
{
    private ClientService $clientService;

    private string $name;
    private array $questions;
    private Quiz $quiz;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function setId(int $id): Service
    {
        $this->quiz = Quiz::where('id', $id)->first();

        return parent::setId($id);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param int $clientId
     * @return $this
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
     * @param array $questions
     * @return $this
     */
    public function setQuestions(array $questions): self
    {
        foreach ($questions as $questionData) {
            $question = new QuestionService();

            $question
                ->setText($questionData['text'])
                ->setType($questionData['type']);

            if (isset($questionData['question_id'])) {
                $question->setId($questionData['question_id']);
            }

            if (isset($questionData['answers'])) {
                $question->setAnswers($questionData['answers']);
            }

            if (isset($questionData['terms'])) {
                $question->setTerms($questionData['terms']);
            }

            if (isset($questionData['topics'])) {
                $question->setTopics($questionData['topics']);
            }

            if (isset($questionData['allocations'])) {
                $question->setAllocations($questionData['allocations']);
            }

            $this->questions[] = $question;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getQuestions(): array
    {
        return $this->questions;
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

        $quiz = Quiz::updateOrCreate(['id' => $this->id ?? null], [
            'name' => $this->name,
            'client_id' => $this->getClientId()
        ]);

        if (!$quiz->save()) {
            return false;
        }

        $this->setId($quiz->id);

        foreach ($this->questions as $question) {
            $question
                ->setQuizId($this->id)
                ->create();
        }

        return true;
    }
}
