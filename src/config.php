<?php



const HOST = 'localhost';

const USERNAME = 'nextutdp_uzr';

const PASSWORD = '6amGrJET8HRgmLgc';

const DATABASENAME = 'nextutdp_bdd';

private $conn;

/**
 * PHP implicitly takes care of cleanup for default connection types.
 * So no need to worry about closing the connection.
 *
 * Singletons not required in PHP as there is no
 * concept of shared memory.
 * Every object lives only for a request.
 *
 * Keeping things simple and that works!
 */
function __construct()
{
    $this->conn = $this->getConnection();
}

/**
 * If connection object is needed use this method and get access to it.
 * Otherwise, use the below methods for insert / update / etc.
 *
 * @return \mysqli
 */
public function getConnection()
{
    $conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

    if (mysqli_connect_errno()) {
        trigger_error("Problem with connecting to database.");
    }

    $conn->set_charset("utf8");
    return $conn;
}

/**
 * If you wish to use PDO use this function to get a connection instance
 *
 * @return \PDO
 */
public function getPdoConnection()
{
    $conn = FALSE;
    try {
        $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DATABASENAME;
        $conn = new \PDO($dsn, self::USERNAME, self::PASSWORD);
        $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\Exception $e) {
        exit("PDO Connect Error: " . $e->getMessage());
    }
    return $conn;
}

?>


