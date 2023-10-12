<?php

require_once('db_connect.php');

class BingoModel extends DatabaseConnection
{
    public function getBingoGames()
    {
        $sql = "SELECT * FROM history";

        $result = $this->connection->query($sql);
        $return = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $return[] = $row;
            }
            echo json_encode($return);
        } else {
            echo "0 results";
        }
        $this->connection->close();
    }

    public function insertBingoGame($name, $startedAt, $numberOfTurns)
    {
        $ended_at = date('Y-m-d h:i:s');
        $stmt = $this->connection->prepare('INSERT INTO history (player, started_at, ended_at, number_of_turns) VALUES (?, ?, ?, ?)');
        $stmt->bind_param("sssd", $name, $startedAt, $ended_at, $numberOfTurns);

        // Set parameters and execute the statement
        $stmt->execute();

        echo "New record inserted successfully";

        // Close statement and connection
        $stmt->close();
        $this->connection->close();
    }
}

