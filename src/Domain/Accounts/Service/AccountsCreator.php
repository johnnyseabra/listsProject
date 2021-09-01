<?php

namespace App\Domain\Accounts\Service;

use Doctrine\DBAL\Connection;
use App\Domain\Accounts\Repository\AccountsRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class AccountsCreator
{
    private AccountsRepository $repository;
    
    private LoggerInterface $logger;
    
    
    /**
     * The constructor.
     *
     * @param AccountsRepository $repository The repository
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;    
        $this->repository = new AccountsRepository($this->connection);
    }
    
    
    /**
     * Import people array to database.
     *
     * @param array<mixed> $arrAccounts 
     *
     * @return bool 
     */
    public function importAccounts(Array &$arrAccounts): bool
    {
        // Import people array
        $return = $this->repository->import($arrAccounts);
        
        // Logging
        return $return;
    }
}