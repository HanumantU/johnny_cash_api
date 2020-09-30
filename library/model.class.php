<?php
class Model extends SQLQuery {
	protected $_model;
	public $dbh;

	function __construct() {

        $this->dbh = $this->connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
		$this->_model = get_class($this);
	}

	function __destruct() {
        $this->disconnect();
	}
}
