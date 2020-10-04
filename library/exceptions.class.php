<?php


class Exceptions extends Exception
{
    public $statusCode;

    public function __construct($status, $message = null, $code = 0) {
        $this->statusCode = $status;
        parent::__construct($message, $code);
    }

    public function __toString() {
        parent::__toString();
        header("Content-Type:application/json; charset=UTF-8");
        http_response_code($this->code);
        $response['code'] = $this->code;
        $response["message"] = $this->message;
        echo json_encode($response);
    }
}