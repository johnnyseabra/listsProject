<?php

namespace App\Console;

use PDO;
use Doctrine\DBAL\Connection;
use Faker\Factory;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Action\Lists\ListsImportAction;
use App\Action\People\PeopleImportAction;
use App\Action\PeopleBelongs\PeopleBelongsImportAction;
use App\Action\Posts\PostsImportAction;
use App\Action\Accounts\AccountsImportAction;

/**
 * Command.
 */
final class GenerateData extends Command
{
    private Connection $connection;
    
    /**
     * The constructor.
     *
     * @param PDO $pdo The database connection
     * @param string|null $name The name
     */
    public function __construct(Connection $connection)
    {
        parent::__construct();
        $this->connection = $connection;
    }
    
    
    protected function configure(): void
    {
        parent::configure();
        
        $this->setName('generateData');
        $this->setDescription('A sample command');
    }
    
    /**
     * Executes the operation
     * {@inheritDoc}
     * @see \Symfony\Component\Console\Command\Command::execute()
     * @param InputInterface $input
     * @param OutputInterface $output
     * @todo Move fake logic to Factory layer
     * @todo Truncate tables and reset serials before fill the tables
     * 
     * @return int
     */
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //Fake array list
        $arrListNames = array(
            "Brazil", //Divisible by 7
            "Politicians", //Divisible by 11
            "UN", //Divisible by 13
            "Europe", //Divisible by 17
            "Asia", //Divisible by 19
            "Geopolytics", //Pair
            "Enviroment and Climate" //Odd
        );
        
        $arrLists = array();
        
        for($l = 0; $l < count($arrListNames); $l++)
        {
            $arrLists[$l]['name'] = $arrListNames[$l];
        }
        
        //Inserting lists
        $returnLists = new ListsImportAction;
        $returnLists($arrLists, $this->connection);
        
        //Counting rows inserted
        $countLists = count($arrLists);
        unset($arrLists);
        $output->writeln(sprintf('<info>' . $countLists . ' Lists Inserted!</info>'));
        
        
        
        
        
        //Workaround to control account ID
        $countAccounts = 0;
        $countPeople = 0;
        $countPeopleBelongs = 0;
        $countPosts = 0;
        
        for($i = 1; $i <= 2500; $i++)
        {
            
            //Fake user list (1000 users)
            $arrPeople = array();
            $arrPeopleBelongs = array();
            $arrPosts = array();
            $arrAccounts = array();
            
            $faker = Factory::create();
            
            
            //Assembly people array
            $arrPeople[]['name'] = $faker->name(); 
            
            //A little workaround to generate associations between list and people
            $peopleBelongs = array();
            if($i % 7 == 0)
            {
                $peopleBelongs['list'] = 1;
                $peopleBelongs['people'] = $i;
                
                $arrPeopleBelongs[] = $peopleBelongs;
                $countPeopleBelongs++;
            }
            if($i % 11 == 0)
            {
                $peopleBelongs['list'] = 2;
                $peopleBelongs['people'] = $i;
                
                $arrPeopleBelongs[] = $peopleBelongs;
                $countPeopleBelongs++;
            }
            if($i % 13 == 0)
            {
                $peopleBelongs['list'] = 3;
                $peopleBelongs['people'] = $i;
                
                $arrPeopleBelongs[] = $peopleBelongs;
                $countPeopleBelongs++;
            }
            if($i % 17 == 0)
            {
                $peopleBelongs['list'] = 4;
                $peopleBelongs['people'] = $i;
                
                $arrPeopleBelongs[] = $peopleBelongs;
                $countPeopleBelongs++;
            }
            if($i % 19 == 0)
            {
                $peopleBelongs['list'] = 5;
                $peopleBelongs['people'] = $i;
                
                $arrPeopleBelongs[] = $peopleBelongs;
                $countPeopleBelongs++;
            }
            if($i % 2 == 0)
            {
                $peopleBelongs['list'] = 6;
                $peopleBelongs['people'] = $i;
                
                $arrPeopleBelongs[] = $peopleBelongs;
                $countPeopleBelongs++;
            }
            if($i % 2 != 0)
            {
                $peopleBelongs['list'] = 7;
                $peopleBelongs['people'] = $i;
                
                $arrPeopleBelongs[] = $peopleBelongs;
                $countPeopleBelongs++;
            }
            //Garbage collector
            unset($peopleBelongs);
            //End of workaround
            
            
            //Assembly account array
            for($k = 1; $k <= 4; $k++)
            {
                
                $account = array();
                if($k % 2 == 1)
                {
                    $account["social_network"] = 1; //Twitter ID at database
                    
                }
                else
                {
                    $account["social_network"] = 2; //Facebook ID at database
                }
                
                $account["profile_link"] = "https://profile.example/" . $faker->bothify('#?#?#?##');
                $account["people"] = $i;
                
                $arrAccounts[] = $account;
                
                
                $post = array();
                //Mounting post array
                for($j = 0; $j < 1000; $j++)
                {
                    $post['text'] = $faker->sentence();
                    $post['date'] = $faker->date();
                    $post['link'] = "https://post.example/" . $faker->bothify('#?#?#?##');
                    $post['account'] = $countAccounts + 1;
                    
                    $arrPosts[] = $post;
                    
                    //Garbage collector
                    unset($post);
                    $countPosts++;
                    
                }
                unset($account);
                $countAccounts++;
            }
            
            //Inserting people
            $returnPeople = new PeopleImportAction;
            $returnPeople($arrPeople, $this->connection);
            
            //Counting rows inserted
            unset($arrPeople);

            
            //Inserting PeopleBelongs (relationships between people and lists
            $returnPeopleBelongs = new PeopleBelongsImportAction();
            $returnPeopleBelongs($arrPeopleBelongs, $this->connection);
            
            //Counting rows inserted
            unset($arrPeopleBelongs);
            
            //Inserting Accounts
            $returnAccounts = new AccountsImportAction();
            $returnAccounts($arrAccounts, $this->connection);
            unset($arrAccounts);
            
            //Inserting Posts
            $returnPosts = new PostsImportAction();
            $returnPosts($arrPosts, $this->connection);
            unset($arrPosts);
            
            
            //Garbage collector
            unset($faker);
            gc_collect_cycles();
            gc_mem_caches();
            $output->writeln(sprintf('<info>' . $i . ' - People Array Inserted</info>'));
        }
        
        
        $output->writeln(sprintf('<info>Fake data imported sucessfully!</info>'));
        $output->writeln(sprintf('<info>' . $countPeople . ' People Inserted!</info>'));
        $output->writeln(sprintf('<info>' . $countPeopleBelongs . ' Relations List-People Inserted!</info>'));
        $output->writeln(sprintf('<info>' . $countAccounts . ' Social Networks Accounts Inserted!</info>'));
        $output->writeln(sprintf('<info>' . $countPosts . ' Posts Inserted!</info>'));
        
        // The error code, 0 on success
        return 0;
    }
}