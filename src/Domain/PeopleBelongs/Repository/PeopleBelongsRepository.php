<?php

namespace App\Domain\PeopleBelongs\Repository;

use Doctrine\DBAL\Connection;
use Franzose\DoctrineBulkInsert\Query;
use DomainException;
use Slim\Factory\AppFactory;

/**
 * Repository.
 */
final class PeopleBelongsRepository
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
    
    public function import(Array &$arrPeopleBelongs)
    {
       
        $return = (new Query($this->connection))->execute('tb_people_belongs', $arrPeopleBelongs);
        
        
        return $return;
    }
}