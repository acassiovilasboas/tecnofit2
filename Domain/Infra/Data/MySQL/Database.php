<?php
namespace Domain\Services\Infra\Data\MySQL;

use \PDO;
use \PDOException;

const HOST = 'localhost';
const DBNAME = 'tecnofit';
const CHARSET = 'utf8';
const USER = 'acassio';
const PASSWORD = 'toor';

class Database
{
    private static $instance;

    private function __construct() {}

    public static function getInstance(): ?PDO
    {
        if (!isset(self::$instance)) {
            try {
                $options = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                    PDO::ATTR_PERSISTENT => TRUE
                );
                self::$instance = new PDO(
                    "mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";",
                    USER,
                    PASSWORD,
                    $options
                );
                self::$instance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
                self::$instance->setAttribute(
                    PDO::ATTR_ORACLE_NULLS,
                    PDO::NULL_EMPTY_STRING
                );
            } catch (PDOException $e) {
               return null;
            }
        }
        return self::$instance;
    }
}