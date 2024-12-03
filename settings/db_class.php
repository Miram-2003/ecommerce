<?php
// Database credentials
require('db_cred.php');

/**
 * @version 1.1
 */
class db_connection
{
    // Properties
    public $db = null;
    public $results = null;

    // Connect to the database
    function db_connect()
    {
        // Establish connection
        $this->db = mysqli_connect(SERVER, USERNAME, PASSWD, DATABASE);

        // Test the connection
        if (mysqli_connect_errno()) {
            error_log("Database connection failed: " . mysqli_connect_error());
            return false;
        }
        return true;
    }

    // Get the active database connection
    function db_conn()
    {
        // Connect if not already connected
        if ($this->db === null) {
            $this->db_connect();
        }

        // Test connection
        if ($this->db === null) {
            error_log("Database connection is null.");
            return false;
        }

        return $this->db;
    }

    // Execute a query
    function db_query($sqlQuery)
    {
        // Ensure the connection is active
        if (!$this->db_connect()) {
            error_log("Query execution failed: No active database connection.");
            return false;
        }

        // Run the query
        $this->results = mysqli_query($this->db, $sqlQuery);

        if ($this->results === false) {
            error_log("Query execution failed: " . mysqli_error($this->db));
            return false;
        }

        return true;
    }

    // Fetch a single record
    function db_fetch_one($sql)
    {
        // Run the query
        if (!$this->db_query($sql)) {
            return false;
        }

        // Return the first record
        return mysqli_fetch_assoc($this->results);
    }

    // Fetch all records
    function db_fetch_all($sql)
    {
        // Run the query
        if (!$this->db_query($sql)) {
            return false;
        }

        // Return all records
        return mysqli_fetch_all($this->results, MYSQLI_ASSOC);
    }

    // Count rows in a query result
    function db_count()
    {
        // Check if results are set
        if ($this->results == null) {
            return false;
        }

        return mysqli_num_rows($this->results);
    }
}
