<?php

namespace App\Domain\People\Service;

use Doctrine\DBAL\Connection;
use App\Domain\People\Repository\PeopleRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class PeopleCreator
{
    private PeopleRepository $repository;
    
    private LoggerInterface $logger;
    
    
    /**
     * The constructor.
     *
     * @param PeopleRepository $repository The repository
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;    
        $this->repository = new PeopleRepository($this->connection);
    }
    
    
    /**
     * Import people array to database.
     *
     * @param array<mixed> $arrPeople People Array
     *
     * @return bool 
     */
    public function importPeople(Array &$arrPeople): bool
    {
        // Import people array
        $return = $this->repository->import($arrPeople);
        
        // Logging
        return $return;
    }
}