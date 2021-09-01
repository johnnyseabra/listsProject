<?php

namespace App\Domain\Lists\Data;

use Selective\ArrayReader\ArrayReader;

/**
 * Data Model.
 */
final class ListsData
{
    
    public $id= null;
    
    public $name = null;
    
    /**
     * The constructor.
     *
     * @param array $data The data
     */
    public function __construct(array $data = [])
    {
        $reader = new ArrayReader($data);
        
        $this->id = $reader->findInt('id');
        $this->name = $reader->findString('name');
    }

}