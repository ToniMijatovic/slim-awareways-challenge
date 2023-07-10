<?php
use App\Controllers\QuizController;
use App\Controllers\SubmissionController;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Slim Awareways Challenge');
    return $response;
});

$app->post('/quiz', QuizController::class . ':create');

$app->post('/quiz/{id}/submit', SubmissionController::class . ':create');




