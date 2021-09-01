<?php

namespace App\Domain\Posts\Repository;

use Doctrine\DBAL\Connection;
use Franzose\DoctrineBulkInsert\Query;
use DomainException;
use Slim\Factory\AppFactory;
use App\Domain\User\Data\PostsViewData;

/**
 * Repository.
 */
final class PostsRepository
{
    private Connection $connection;
    
    /**
     * The constructor.
     *
     * @param Connection $connection Doctrine connection
     */
    public function __construct(Connection $connection)
    {
       $this->connection = $connection;
    }
    
    
    /**
     * 
     * 
     */
    
    public function import(Array &$arrPosts)
    {
       
        $return = (new Query($this->connection))->execute('tb_posts', $arrPosts);
        
        
        return $return;
    }
    
    /**
     * Find users.
     *
     * @return PostsViewData[] A list of users
     */
    public function findPosts(): array
    {
        $query = $this->connection->newSelect('mv_posts');
        
        $query->select(
            [
                'people_name',
                'social_network',
                'profile_link',
                'post_date',
                'post_text',
                'post_link',
                'lists',
            ]
            )->setFirstResult(0)
            ->setMaxResults(100);
        
        // Add more "use case specific" conditions to the query
        // ...
        
        $rows = $query->execute()->fetchAll('assoc') ?: [];
        
        // Convert to list of objects
        return $this->hydrator->hydrate($rows, PostsViewData::class);
    }
}