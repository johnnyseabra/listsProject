<?php

namespace App\Action\Accounts;

use App\Domain\Accounts\Service\AccountsCreator;
use Doctrine\DBAL\Connection;
/**
 * Action.
 */
final class AccountsImportAction
{

    private AccountsCreator $accountsCreator;
    
    /**
     * The constructor.
     *
     */
    public function __construct()
    {
        
    }
    
    /**
     * Action.
     *
     * @param array $arrAccounts Accounts array
     *
     * @return bool The response
     */
    public function __invoke(Array &$arrAccounts, Connection $connection): bool
    {
        
        $this->accountsCreator = new AccountsCreator($connection);
        
        //Importing array 
        $return = $this->accountsCreator->importAccounts($arrAccounts, $connection);
        
        return $return;
    }
}