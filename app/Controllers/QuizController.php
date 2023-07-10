<?php

namespace App\Controllers;

use App\Services\QuizService;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class QuizController extends Controller
{
    /**
     * @var QuizService
     */
    private QuizService $quizService;

    public function __construct(ContainerInterface $container, QuizService $quizService)
    {
        parent::__construct($container);

        $this->quizService = $quizService;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function create(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        if (!isset($data['quiz_name']) || !isset($data['client_id']) || !isset($data['questions'])) {
            return $this->response(
                $response,
                self::STATUS_BAD_REQUEST,
                ['message' => 'Some parameters are missing, please try again.']
            );
        }

        $created = $this->quizService
            ->setName($data['quiz_name'])
            ->setClientId($data['client_id'])
            ->setQuestions($data['questions'])
            ->create();

        if (!$created) {
            return $this->response(
                $response,
                self::STATUS_BAD_REQUEST,
                ['message' => 'Something went wrong whilst trying to create a quiz for a client.']
            );
        }

        return $this->response($response, self::STATUS_OK, ['message' => 'Successfully created a quiz for a client.']);
    }
}
