<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Database {
  
  // DB Params
  private $host;
  private $db_name;
  private $username;
  private $password;
  private $connection;
  private $port;
  // Constructor
  public function __construct(){
    $this->username = $_ENV['USERNAME'];
    $this->password = $_ENV['PASSWORD'];
    $this->db_name = $_ENV['DBNAME'];
    $this->host = $_ENV['HOST'];
    $this->port = $_ENV['PORT'];
  }
  
  // DB Connect
  public function connect() {
    $this->connection = null;
    $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";
      try { 
        $this->connection = new PDO($dsn, $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } 
      catch(PDOException $error) {
          echo 'Connection Error: ' . $error->getMessage();
      }
    return $this->connection;
  }
}

?>