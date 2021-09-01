<?php

namespace App\Action\Lists;

use App\Domain\Lists\Service\ListsCreator;
use Doctrine\DBAL\Connection;
use Slim\App;
use PDO;
/**
 * Action.
 */
final class ListsImportAction
{

    private ListsCreator $listsCreator;
    
    /**
     * The constructor.
     *
     * @param ListsCreator $listsCreator The service
     */
    public function __construct()
    {
        
    }
    
    /**
     * Action.
     *
     * @param array $arrLists Lists array
     *
     * @return bool The response
     */
    public function __invoke(Array &$arrLists, Connection $connection): bool
    {
        
        $this->listsCreator = new ListsCreator($connection);
        //Importing array 
        $return = $this->listsCreator->importLists($arrLists, $connection);
        
        return $return;
    }
}