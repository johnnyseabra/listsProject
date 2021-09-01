<?php

namespace App\Action\Posts;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

final class PostsFilterAction
{
    /**
     * @var PhpRenderer
     */
    private $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $this->renderer->setLayout('layout.php');

        return $this->renderer->render($response, 'showPosts.php', ['name' => 'Hello World']);
    }
}