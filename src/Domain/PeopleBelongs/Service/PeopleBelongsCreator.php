<?php

namespace App\Domain\PeopleBelongs\Service;

use Doctrine\DBAL\Connection;
use App\Domain\PeopleBelongs\Repository\PeopleBelongsRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class PeopleBelongsCreator
{
    private PeopleBelongsRepository $repository;
    
    private LoggerInterface $logger;
    
    
    /**
     * The constructor.
     *
     * @param PeopleBelongsRepository $repository The repository
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;    
        $this->repository = new PeopleBelongsRepository($this->connection);
    }
    
    
    /**
     * Import people array to database.
     *
     * @param array<mixed> $arrPeopleBelongs 
     *
     * @return bool 
     */
    public function importPeopleBelongs(Array &$arrPeopleBelongs): bool
    {
        // Import people array
        $return = $this->repository->import($arrPeopleBelongs);
        
        // Logging
        return $return;
    }
}