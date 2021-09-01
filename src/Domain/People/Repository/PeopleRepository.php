<?php

namespace App\Domain\People\Repository;

use Doctrine\DBAL\Connection;
use Franzose\DoctrineBulkInsert\Query;
use DomainException;
use Slim\Factory\AppFactory;

/**
 * Repository.
 */
final class PeopleRepository
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
    
    public function import(Array &$arrPeople)
    {
       
        $return = (new Query($this->connection))->execute('tb_people', $arrPeople);
        
        
        return $return;
    }
}