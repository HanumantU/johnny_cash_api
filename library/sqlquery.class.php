<?php

class SQLQuery {
    protected $_dbHandle;
    protected $_result;
    public $dbh;

    /** Connects to database **/
    function connect($address, $account, $pwd, $name) {

        $dsn = 'mysql:dbname='.$name.';host='.$address.'';

        try {
            $this->_dbHandle = new PDO($dsn, $account, $pwd);
        } catch (PDOException $e) {
            $response['status'] = "Error";
            $response["message"] = $e->getMessage();
            echo json_encode($response);
        }

        return $this->_dbHandle;
    }

    /** Disconnects from database **/
    function disconnect() {
        $this->_dbHandle = NULL;
        return 0;
    }
}
