<?php

namespace App\Action\Posts;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use App\Domain\Posts\Service\PostsLists;
use Doctrine\DBAL\Connection;

final class PostsShowAction
{
    /**
     * @var PhpRenderer
     */
    private $renderer;
    
    private $posts;
    
    private $connection;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->posts = NULL;
        
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        
        $this->renderer->setLayout('layout.php');
 
       // $this->posts = new PostsLists($this->connection);
        
        return $this->renderer->render($response, 'showPosts.php', ['name' => 'Hello World']);
    }
}