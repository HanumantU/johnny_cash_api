<?php


class ProductsController extends Controller {
    function index($id = null) {
        switch ($this->get_request_method()) {
            case 'GET':
                break;
            default:
                $this->response("Request Un-recognized", 400);
        }
    }

    function top_selling_products() {
        $result = $this->Product->getTopSellingProducts($_GET);
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }

    function stock_state() {
        $result = $this->Product->getStockState();
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }
}