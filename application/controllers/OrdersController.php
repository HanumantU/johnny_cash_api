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
        $result = $this->Order->getUnpaidBillOfEmployee();

        if(empty($result)){
            $response["message"] = "Data Not Found";
            $response['status_code'] = 404;
            $response['data'] = json_encode($response);
        }else{
            $response["message"] = "Success";
            $response['status_code'] = 200;
            $response['data'] = stripSlashesDeep(json_encode($result));
        }

        $this->response($response['data'], $response['status_code']);
    }
}