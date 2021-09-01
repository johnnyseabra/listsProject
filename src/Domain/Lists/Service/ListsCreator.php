<?php

namespace App\Domain\Lists\Service;

use App\Domain\Lists\Data\ListsData;
use Doctrine\DBAL\Connection;
use App\Domain\Lists\Repository\ListsRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

/**
 * Service.
 */
final class ListsCreator
{
    private ListsRepository $repository;
    
    private LoggerInterface $logger;
    
    
    /**
     * The constructor.
     *
     * @param ListsRepository $repository The repository
     * @param LoggerFactory $loggerFactory The logger factory
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;    
        $this->repository = new ListsRepository($this->connection);
    }
    
    /**
     * Create a new list.
     *
     * @param array<mixed> $data The form data
     *
     * @return int The new user ID
     */
    public function createList(array $data): int
    {
       // Map data to list DTO (model)
        $list = new ListsData($data);
        
        // Insert user and get new user ID
        $listId = $this->repository->insertList($list);
        
        // Logging
        $this->logger->info(sprintf('List created successfully: %s', $listId));
        
        return $listId;
    }
    
    /**
     * Import list array to database.
     *
     * @param array<mixed> $arrList Lists Array
     *
     * @return bool 
     */
    public function importLists(Array &$arrList): bool
    {
        // Import lists array
        $return = $this->repository->import($arrList);
        
        // Logging
        
        return $return;
    }
}