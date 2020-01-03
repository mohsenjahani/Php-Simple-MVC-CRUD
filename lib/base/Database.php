<?php
use lib\Utils\Config;

class Database extends PDO
{

    /**
     * singleton
     * @return Database
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Database();
        }
        return $inst;
    }

    public function __construct()
    {
        parent::__construct(Config::get('database.db_type').
            ':dbname='.Config::get('database.db_name').
            ';host='.Config::get('database.db_host').
            ';charset='.Config::get('database.db_charset'), Config::get('database.db_user'), Config::get('database.db_pass'));
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    }

}

