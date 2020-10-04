<?php

class ProductsController extends Controller
{
    function index($id = null) {
        switch ($this->get_request_method()) {
            default:
                $response['message'] = "URL not found.";
                $this->response(stripSlashesDeep(json_encode($response)), 404);
        }
    }

    function topSellingProducts() {
        if(isset($_GET['fromdate']) && isset($_GET['todate'])) {
            if (preg_match("#((\d{2,4}-\d{1,2}-\d{1,2})|(\d{1,2}-\d{1,2}-\d{2,4}))#ims", $_GET['fromdate'])) {
                $data['from_date'] = date('Y-m-d', strtotime($_GET['fromdate']));
            } else {
                throw new Exceptions(400, "Invalid Date format for `fromdate`", NULL);
            }

            if (preg_match("#(\d{2,4}-\d{1,2}-\d{1,2})#ims", $_GET['todate'])) {
                $data['to_date'] = date('Y-m-d', strtotime($_GET['todate']));
            } else {
                throw new Exceptions(400, "Invalid Date format for `todate`", NULL);
            }
        }

        $result = $this->Product->getTopSellingProducts($data);
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }

    function stockState() {
        $result = $this->Product->getStockState();
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }
}