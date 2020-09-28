<?php


class OrdersController extends Controller {
    function index($id = null) {
        switch ($this->get_request_method()) {
            case 'GET':
                break;
            default:
                $this->response("Request Un-recognized", 400);
        }
    }

    // method to get all unpaid bills of employee
    function unpaid(){
        $result = $this->Order->getUnpaidBillOfEmployee($_GET);
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }
}