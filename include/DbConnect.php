<?php

/**
 * Handling database connection
 *
 * @author Ravi Tamada
 */
class DbConnect {

    private $conn;

    function __construct() {
        
    }

    function connect() {
        include_once dirname(__FILE__) . '/config.php';

        // Connecting to mysql database
        $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD,DB_NAME);
        $this->conn = $connection;
		//mysqli_query($this->conn,"set names 'utf8'");
		//$this->conn->set_charset("utf8");
		//mysqli_set_charset($this->conn,"utf8");


        // returing connection resource
        return $this->conn;
    }

}

?>