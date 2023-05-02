<?php 

class database {
    private $connection;
    private $host;
    private $username;
    private $password;
    private $database;

    function __construct($host, $username, $password, $database) {
        // Connect to database
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->connection = pg_connect("host=$host dbname=$database user=$username password=$password") or die("Could not connect to database");
    }


    function query($query) {
        // Execute query
        /* $query = "SELECT * FROM table" */
        $result = pg_query($this->connection, $query);
        return $result;
    }

    function fetch($result) {
        // Fetch result
        /* $result = query($query) */
        $row = pg_fetch_assoc($result);
        return $row;
    }

    function close() {
        // Close connection
        pg_close($this->connection);
    }

    function drop_table($table) {
        // Drop table
        /* $table = "table" */
        $query = "DROP TABLE IF EXISTS $table";
        $result = $this->query($query);
        return $result;
    }

    function create_table($table, $columns) {
        // Create table
        /* $columns = "column1 type1, column2 type2, ..." */
        $query = "CREATE TABLE IF NOT EXISTS $table ($columns)";
        $result = $this->query($query);
        return $result;
    }

    function insert($table, $columns, $values) {
        // Insert into table
        /* $columns = "column1, column2, ..." */
        /* $values = "value1, value2, ..." */
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        $result = query($query);
        return $result;
    }

    function select($table, $columns, $where) {
        // Select from table
        /* $columns = "column1, column2, ..." */
        /* $where = "column = value" */
        $query = "SELECT $columns FROM $table WHERE $where";
        $result = query($query);
        return $result;
    }

    function prepare_execute($query, $params) {
        // Prepare and execute query with parameters
        $stmt = pg_prepare($this->connection, "", $query);
        if (!$stmt) {
            // Error handling for failed query preparation
            return false;
        }
        // Execute query with cleaned parameters
        $result = pg_execute($this->connection, "", $params);
        if (!$result) {
            // Error handling for failed query execution
            return false;
        }
        return $result;
    }
    

    function update($table, $set, $where) {
        // Update table
        /* $set = "column1 = value1, column2 = value2, ..." */
        /* $where = "column = value" */
        $query = "UPDATE $table SET $set WHERE $where";
        $result = query($query);
        return $result;
    }

    function delete($table, $where) {
        // Delete from table
        /* $where = "column = value" */
        $query = "DELETE FROM $table WHERE $where";
        $result = query($query);
        return $result;
    }

    function isTableNotEmpty($table) {
        $result = $this->query("SELECT * FROM $table");
        return (pg_num_rows($result) > 0);
    }

    function initPhpSession() : bool{
        if (!session_id()) {
            session_start();
            session_regenerate_id();
            return true;
        }
    }
}

// require_once "config.php";
// $database = new database($host, $username, $password, $database);

?>