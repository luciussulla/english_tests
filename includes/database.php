<?php
  require_once('config.php'); 

  class MySQLDatabase {
    private $connection

    public function __construct() {
      $this->open_connection(); 
    }

    public function open_connection() {
      $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME); 
      if(!$this->connection) {
        die("Database connection failed: " . 
        mysqli_connect_error() . " (" .
        mysqli_connect_errno() . ")"
      ); 
      }
    }

    public function close_connection() {
      if(isset($this->connection)) {
        mysqli_close($this->connection); 
        unset($this->connection); 
      }
    }

    public escape_value($string) {
      return mysqli_real_escape_string($this->connection, $string); 
    }   

    public affected_rows() {
      return mysqli_affected_rows($connection); 
    }
  }
  $database = new MySQLDatabase(); 

?>