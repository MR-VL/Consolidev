<?php

// Mock the Database class for testing purposes
class Database
{
    private $host;
    private $dbname;
    private $user;
    private $password;

    public function __construct($host, $dbname, $user, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function getConnection()
    {
        try {
            return new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
        } catch (PDOException $e) {
            throw $e; // Re-throw the exception for testing
        }
    }
}

// Test helper function
function testassert($condition, $message, $expectedToFail = false)
{

    if ($condition) {
        echo "<p style='color: green;'>[PASS] $message</p>\n";
    } else {
        echo "<p style='color: red;'>[FAIL] $message</p>\n";
    }

}

// Test cases
function testDatabaseConnectionSuccess()
{
    echo "<h3>Running Database Connection Test</h3>\n";

    // Use mock environment variables
    putenv("DB_HOST=localhost");
    putenv("DB_USER=root");
    putenv("DB_PASSWORD=");
    putenv("DB_NAME=consolidev");

    $database = new Database(
        getenv('DB_HOST'),
        getenv('DB_NAME'),
        getenv('DB_USER'),
        getenv('DB_PASSWORD')
    );

    try {
        $connection = $database->getConnection();
        testassert($connection !== null, "Database connection should work.");
    } catch (PDOException $e) {
        testassert(false, "Unexpected exception: " . $e->getMessage());
    }
}


// Run the tests
testDatabaseConnectionSuccess();

