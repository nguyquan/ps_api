<?php

class Connection {

    /* @var $conn PDO  */
    protected $conn;
    protected $host;
    protected $db;
    protected $user;
    protected $pass;

   // private $prepared;

    function __construct($host, $db, $user, $pass)
    {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        try {
            $this->conn = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';', $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo 'ERROR: '.$e->getMessage();
        }
    }

    /**
     * Prepare SQL Statement to be executed
     *
     * @param $table String The name of the table to be updated
     * @param $kvp Array - Associative An array of columns with corresponding values to be updated/set in the db
     * @return PDOStatement The prepared PDO Statement
     */
    function insertPrepareStatement($table, $kvp)
    {
        try {
            $prepared = $this->conn->prepare("INSERT INTO $table (".key($kvp).") VALUES(:post)");
            $prepared->bindParam(":post", $kvp['post']);

            return $prepared;

        } catch (PDOException $e) {
            echo 'ERROR: '. $prepared->queryString .$e->getMessage();
        }
    }

    /**`
     * Execute the given prepared statement
     *
     * @param PDOStatement $prepared
     */
    function executePreparedStatement(PDOStatement $prepared)
    {
        $prepared->execute();
    }

}