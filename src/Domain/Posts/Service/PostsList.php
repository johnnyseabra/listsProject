<?php

namespace App\Domain\Posts\Service;

use Doctrine\DBAL\Connection;
use App\Domain\Posts\Repository\PostsRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class PostsLists
{
    private PostsRepository $repository;
    
    private LoggerInterface $logger;
    
    
    /**
     * The constructor.
     *
     * @param PostsRepository $repository The repository
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;    
        $this->repository = new PostsRepository($this->connection);
    }
    
    
    /**
     * Import people array to database.
     *
     * @param array<mixed> $arrPosts 
     *
     * @return bool 
     */
    public function importPosts(Array $arrPosts): bool
    {
        // Import people array
        $return = $this->repository->import($arrPosts);
        
        // Logging
        return $return;
    }
    
    
    
    public function listPosts()
    {
        $arrPosts = $this->repository->findPosts();
        
        
    }
    
}