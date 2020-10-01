<?php


class Exceptions extends \Exception {

    public function __construct($message = null, $code = 0) {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        parent::__toString();
        header("Content-Type:application/json; charset=UTF-8");
        $response['code'] = $this->code;
        $response["message"] = $this->message;
        echo json_encode($response);
    }
}