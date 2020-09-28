<?php


class Product extends Model {
    function getStockState() {

        $sql = "Select name, stock from johnnysku Order by stock ASC";
        $result = $this->dbh->query($sql);
        $rows = array();
        while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
            $r['name'] = utf8_encode($r['name']);
            $rows[] =  json_encode($r);
        }

        return $rows;
    }

    function getTopSellingProducts($data) {

        // Getting parameters from URL
        if(isset($data['fromdate']) && !empty($data['fromdate'] && !empty($data['todate']))) {
            $from_date = $data['fromdate']." 10:30:00";
            $to_date = $data['todate']." 10:30:00";
        }

        $sql = "SELECT js.name, jol.skuId, SUM(jol.quantity) AS TotalSellQuantity
FROM johnnyorderlog jol JOIN johnnysku js WHERE jol.skuId = js.id";

        if(!empty($from_date) && !empty($to_date)) {
            $sql .= " AND jol.time_created BETWEEN '".$from_date."' AND '".$to_date."'";
        }

        $sql .= " GROUP BY jol.skuId ORDER BY SUM(jol.quantity) DESC";

        $result = $this->dbh->query($sql);
        $rows = array();
        while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] =  json_encode($r);
        }

        return $rows;
    }
}