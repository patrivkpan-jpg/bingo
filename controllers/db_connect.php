<?php

class DatabaseConnection 
{

    protected $connection;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "bingo";

        // Create a connection
        $this->connection = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
}

?>