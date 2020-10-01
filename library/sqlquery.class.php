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
            $this->_dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exceptions($e->getMessage());
        }
        return $this->_dbHandle;
    }

    /** Disconnects from database **/
    function disconnect() {
        $this->_dbHandle = NULL;
        return 0;
    }
}
//
//class Exception {
//
//    $error_code;
//    $error_msg;
//
//
//}