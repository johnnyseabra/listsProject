<?php

namespace App\Action\Posts;

use App\Domain\Posts\Service\PostsCreator; 
use Doctrine\DBAL\Connection;
/**
 * Action.
 */
final class PostsImportAction
{

    private PostsCreator $postsCreator;
    
    /**
     * The constructor.
     *
     */
    public function __construct()
    {
        
    }
    
    /**
     * Action.
     *
     * @param array $arrPosts Posts array
     *
     * @return bool The response
     */
    public function __invoke(Array &$arrPosts, Connection $connection): bool
    {
        
        $this->postsCreator = new PostsCreator($connection);
        
        //Importing array 
        $return = $this->postsCreator->importPosts($arrPosts, $connection);
        
        return $return;
    }
}