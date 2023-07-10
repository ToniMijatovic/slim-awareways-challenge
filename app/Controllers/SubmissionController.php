<?php

namespace App\Controllers;

use App\Services\SubmissionService;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class SubmissionController extends Controller
{
    private SubmissionService $submissionService;

    public function __construct(ContainerInterface $container, SubmissionService $submissionService)
    {
        parent::__construct($container);
        $this->submissionService = $submissionService;
    }

    public function create(Request $request, Response $response, $args): Response
    {
        $id = $args['id'] ?? false;
        $data = $request->getParsedBody();

        if (!$id || !isset($data['client_id']) || !isset($data['date']) || !isset($data['answers'])) {
            return $this->response(
                $response,
                self::STATUS_BAD_REQUEST,
                ['message' => 'Some parameters are missing, please try again.']
            );
        }

        $created = $this->submissionService
            ->setQuizId($id)
            ->setClientId($data['client_id'])
            ->setDate($data['date'])
            ->setAnswers($data['answers'])
            ->create();

        if (!$created) {
            return $this->response(
                $response,
                self::STATUS_BAD_REQUEST,
                ['message' => 'Something went wrong whilst creating your submission, please try again.']
            );
        }

        return $this->response($response, self::STATUS_OK, ['message' => 'Successfully created a quiz for a client.']);
    }
}
