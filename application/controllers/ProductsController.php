<?php


class ProductsController extends Controller {
    function index($id = null) {
        switch ($this->get_request_method()) {
            case 'GET':
                $result = $this->Product->getProducts($id);
                $this->response(stripSlashesDeep(json_encode($result)), 200);
                break;
        }
    }

    function topSellingProducts() {
        // extracting require data from GET.
        $data['from_date'] = !empty($_GET['fromdate']) ? $_GET['fromdate'] : NULL;
        $data['to_date'] = !empty($_GET['todate']) ? $_GET['todate'] : NULL;

        $result = $this->Product->getTopSellingProducts($data);

        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }

    function stockState() {
        $result = $this->Product->getStockState();
        $this->response(stripSlashesDeep(json_encode($result)), 200);
    }
}