<?php


class ProductsController extends Controller {
    function index($id = null) {
        switch ($this->get_request_method()) {
            case 'GET':
                $result = $this->Product->getProducts($id);
                $this->response(stripSlashesDeep(json_encode($result)), 200);
                break;
            default:
                $this->response("Request Un-recognized", 400);
        }
    }

    function topSellingProducts() {
        $data['from_date'] = !empty($_GET['fromdate']) ? date('Y-m-d', strtotime($_GET['fromdate'])) : NULL;
        $data['to_date'] = !empty($_GET['todate']) ? date('Y-m-d', strtotime($_GET['todate'])) : NULL;

        $result = $this->Product->getTopSellingProducts($data);

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

    function stockState() {
        $result = $this->Product->getStockState();

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