<?php


class OrdersController extends Controller
{
    function index($id = null) {
        switch ($this->get_request_method()) {
            default:
                $response['message'] = "URL not found.";
                $this->response(stripSlashesDeep(json_encode($response)), 404);
        }
    }

    // method to get all unpaid bills of employee
    function unpaid(){
        $result = $this->Order->getUnpaidBillOfEmployee();
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }
}