<?
namespace Ambitious\Core\Database;

use PDO;
// Singleton to connect db.
class ConnectDb
{
// Hold the class instance.
    private static $instance = null;
    private $conn;

// The db connection is established in the private constructor.
    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$_SERVER['DATABASE_HOST']};
dbname={$_SERVER['DATABASE_NAME']}", $_SERVER['DATABASE_USER'], $_SERVER['DATABASE_PASSWORD'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));

    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ConnectDb();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}