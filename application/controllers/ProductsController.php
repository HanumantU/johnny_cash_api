<?php

class ProductsController extends Controller {
    function index($id = null) {
        switch ($this->get_request_method()) {
            case 'GET':
                $result = $this->Product->getProducts($id);
                $this->response(stripSlashesDeep(json_encode($result)), 200);
                break;
            default:
                throw new Exceptions("Request Un-recognized");
        }
    }

    function topSellingProducts() {
        $data['from_date'] = !empty($_GET['fromdate']) ? date('Y-m-d', strtotime($_GET['fromdate'])) : NULL;
        $data['to_date'] = !empty($_GET['todate']) ? date('Y-m-d', strtotime($_GET['todate'])) : NULL;

        $result = $this->Product->getTopSellingProducts($data);
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }

    function stockState() {
        $result = $this->Product->getStockState();
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }
}