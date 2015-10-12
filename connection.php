<?php

class Connection {

    /* @var $conn PDO  */
    public static $conn;
    protected $host;
    protected $db;
    protected $user;
    protected $pass;

    private $prepared;

    function __construct($host, $db, $user, $pass)
    {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->pass = $pass;
        try {
            self::$conn = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';', $user, $pass);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    public function insertPrepareStatement($table, $kvp)
    {
        $prepared_string = 'INSERT INTO '.$table.' (';
        $bind_params = '';
        $prepared = null;

        for ($i = 0; $i < count($kvp); $i++) {
            $prepared_string .= key($kvp);
            $bind_params .= ':'.key($kvp);
            if ($i != count($kvp) - 1) {
                $prepared_string .= ', ';
                $bind_params .= ', ';
            }

            next($kvp);
        }
        $prepared_string .= ') VALUES('.$bind_params.')';
        reset($kvp);

        try {
            // Now bind the parameters to query
            var_dump(self::$conn);
            $prepared = self::$conn->prepare($prepared_string);
            for ($i = 0; $i < count($kvp); $i++) {

                $prepared->bindParam(':' . key($kvp), $kvp[key($kvp)]);
                next($kvp);
            }
        } catch (PDOException $e) {
            echo 'ERROR: '. $e->getCode().$e->getMessage();
        }

        return $prepared;
    }

    /**`
     * Execute the given prepared statement
     *
     * @param PDOStatement $prepared
     */
    public function executePreparedStatement(PDOStatement $prepared)
    {
        $prepared->execute();
    }

}