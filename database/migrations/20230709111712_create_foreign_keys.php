<?php
use Phinx\Migration\AbstractMigration;

class CreateForeignKeys extends AbstractMigration
{
    public function change()
    {
        // Add foreign key to 'quiz' table
        $this->table('quiz')
            ->addForeignKey('client_id', 'client', 'id')
            ->update();

        // Add foreign key to 'question' table
        $this->table('quiz_questions')
            ->addForeignKey('quiz_id', 'quiz', 'id')
            ->addForeignKey('question_id', 'question', 'id')
            ->update();

        // Add foreign key to 'question-answers' table
        $this->table('question_answers')
            ->addForeignKey('question_id', 'question', 'id')
            ->addForeignKey('answer_id', 'answer', 'id')
            ->update();

        // Add foreign keys to 'allocation' table
        $this->table('allocation')
            ->addForeignKey('question_id', 'question', 'id')
            ->addForeignKey('term_id', 'term', 'id')
            ->addForeignKey('topic_id', 'topic', 'id')
            ->update();

        // Add foreign keys to 'submission' table
        $this->table('submission')
            ->addForeignKey('quiz_id', 'quiz', 'id')
            ->addForeignKey('client_id', 'client', 'id')
            ->update();

        // Add foreign keys to 'user_answer' table
        $this->table('user_answers')
            ->addForeignKey('submission_id', 'submission', 'id')
            ->addForeignKey('question_id', 'question', 'id')
            ->addForeignKey('answer_id', 'answer', 'id')
            ->addForeignKey('term_id', 'term', 'id')
            ->addForeignKey('topic_id', 'topic', 'id')
            ->update();
    }
}
