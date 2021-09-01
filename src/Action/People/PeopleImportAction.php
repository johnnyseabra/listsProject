<?php

namespace App\Action\People;

use App\Domain\People\Service\PeopleCreator;
use Doctrine\DBAL\Connection;
/**
 * Action.
 */
final class PeopleImportAction
{

    private PeopleCreator $peopleCreator;
    
    /**
     * The constructor.
     *
     * @param PeopleCreator $peopleCreator The service
     */
    public function __construct()
    {
        
    }
    
    /**
     * Action.
     *
     * @param array $arrPeople People array
     *
     * @return bool The response
     */
    public function __invoke(Array &$arrPeople, Connection $connection): bool
    {
        
        $this->peopleCreator = new PeopleCreator($connection);
        
        //Importing array 
        $return = $this->peopleCreator->importPeople($arrPeople, $connection);
        
        return $return;
    }
}