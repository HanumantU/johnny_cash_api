<?php


class OrdersController extends Controller {
    function index($id = null) {
        switch ($this->get_request_method()) {
            default:
                throw new Exceptions("Request Un-recognized");
        }
    }

    // method to get all unpaid bills of employee
    function unpaid(){
        $result = $this->Order->getUnpaidBillOfEmployee();
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }
}