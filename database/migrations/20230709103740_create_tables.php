<?php

use Phinx\Migration\AbstractMigration;

class CreateTables extends AbstractMigration
{
    public function change()
    {
        // Create 'quiz' table
        $quizTable = $this->table('quiz');
        $quizTable->addColumn('name', 'string')
            ->addColumn('client_id', 'integer')
            ->create();

        // Create 'client' table
        $clientTable = $this->table('client');
        $clientTable
            ->addColumn('name', 'string')
            ->create();

        // Create 'question' table
        $questionTable = $this->table('question');
        $questionTable
            ->addColumn('text', 'string')
            ->addColumn('type', 'string')
            ->create();

        $questionQuizTable = $this->table('quiz_questions');

        $questionQuizTable->addColumn('quiz_id', 'integer')
            ->addColumn('question_id', 'integer')
            ->create();

        // Create 'answer' table
        $answerTable = $this->table('answer');
        $answerTable
            ->addColumn('text', 'string')
            ->addColumn('is_correct', 'boolean', ['null' => true])
            ->create();

        $questionAnswerTable = $this->table('question_answers');
        $questionAnswerTable->addColumn('question_id', 'integer')
            ->addColumn('answer_id', 'integer')
            ->create();

        // Create 'term' table
        $termTable = $this->table('term');
        $termTable
            ->addColumn('text', 'string')
            ->create();

        // Create 'topic' table
        $topicTable = $this->table('topic');
        $topicTable
            ->addColumn('text', 'string')
            ->create();

        // Create 'allocation' table
        $allocationTable = $this->table('allocation');
        $allocationTable->addColumn('question_id', 'integer')
            ->addColumn('term_id', 'integer')
            ->addColumn('topic_id', 'integer')
            ->create();

        // Create 'submission' table
        $submissionTable = $this->table('submission');
        $submissionTable->addColumn('quiz_id', 'integer')
            ->addColumn('client_id', 'integer')
            ->addColumn('date', 'date')
            ->create();

        // Create 'user_answer' table
        $userAnswerTable = $this->table('user_answers');
        $userAnswerTable->addColumn('submission_id', 'integer')
            ->addColumn('question_id', 'integer')
            ->addColumn('answer_id', 'integer', ['null' => true])
            ->addColumn('term_id', 'integer', ['null' => true])
            ->addColumn('topic_id', 'integer', ['null' => true])
            ->create();
    }
}
