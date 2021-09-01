<?php

namespace App\Action\PeopleBelongs;

use App\Domain\PeopleBelongs\Service\PeopleBelongsCreator;
use Doctrine\DBAL\Connection;
/**
 * Action.
 */
final class PeopleBelongsImportAction
{

    private PeopleBelongsCreator $peopleBelongsCreator;
    
    /**
     * The constructor.
     *
     * @param PeopleBelongsCreator $peopleCreator The service
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
    public function __invoke(Array &$arrPeopleBelongs, Connection $connection): bool
    {
        
        $this->peopleBelongsCreator = new PeopleBelongsCreator($connection);
        
        //Importing array 
        $return = $this->peopleBelongsCreator->importPeopleBelongs($arrPeopleBelongs, $connection);
        
        return $return;
    }
}