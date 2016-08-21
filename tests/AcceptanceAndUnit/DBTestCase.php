<?php namespace Test\AcceptanceAndUnit;

use DB;

class DBTestCase extends \Test\TestCase
{    
    protected static $pdo;
              
    public static function setUpBeforeClass()
    {        
        parent::setUpBeforeClass();
        self::$pdo = DB::connection()->getPdo();
    }
    
    protected static function run_statement($sql)
    {
        $statement = self::$pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }   
}


