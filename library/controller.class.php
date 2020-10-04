<?php

class Controller
{
    protected $_model;
    protected $_controller;
    protected $_action;

    public $_content_type = "application/json; charset=UTF-8";
    public $_request = array();
    private $_code = 200;

    function __construct($model, $controller, $action) {
        $this->inputs();
        $this->_controller = $controller;
        $this->_action = $action == '' ? "index" : $action;
        $this->_model = $model;
        $this->$model = new $model;
    }

    public function response($data, $status) {
        $this->_code = ($status) ? $status : 200;
        $this->set_headers();
        echo $data;
        exit;
    }

    public function get_request_method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function inputs() {

        switch ($this->get_request_method()) {
            case "GET":
                $this->_request = $this->cleanInputs($_GET);
                break;
            default:
                $this->response('', 406);
                break;
        }
    }

    private function cleanInputs($data) {
        $clean_input = array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->cleanInputs($v);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $data = trim(stripslashes($data));
            }
            $data = strip_tags($data);
            $clean_input = trim($data);
        }

        return $clean_input;
    }

    private function set_headers() {
        http_response_code($this->_code);
        header("Content-Type:" . $this->_content_type);
    }
}
