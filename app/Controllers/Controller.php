<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Slim\Psr7\Response;

abstract class Controller
{
    const STATUS_OK = 200;
    const STATUS_BAD_REQUEST = 400;

    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function response(Response $response, int $status = 200, array $data = null): Response
    {
        $body = $response->getBody();
        $body->write(json_encode($data));

        return $response
            ->withHeader("Content-Type", "application/json")
            ->withStatus($status)
            ->withBody($body);
    }
}
