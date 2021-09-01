<?php

namespace App\Domain\Lists\Repository;

use App\Domain\Lists\Data\ListsData;
use Doctrine\DBAL\Connection;
use Franzose\DoctrineBulkInsert\Query;
use DomainException;
use Slim\Factory\AppFactory;

use PDO;

/**
 * Repository.
 */
final class ListsRepository
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
    
    public function import(Array &$arrLists)
    {
        
       
        $return = (new Query($this->connection))->execute('tb_lists', $arrLists);
        
        
        return $return;
    }
}