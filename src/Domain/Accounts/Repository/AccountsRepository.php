<?php

namespace App\Domain\Accounts\Repository;

use Doctrine\DBAL\Connection;
use Franzose\DoctrineBulkInsert\Query;
use DomainException;
use Slim\Factory\AppFactory;

/**
 * Repository.
 */
final class AccountsRepository
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
    
    public function import(Array &$arrAccounts)
    {
       
        $return = (new Query($this->connection))->execute('tb_accounts', $arrAccounts);
        
        
        return $return;
    }
}