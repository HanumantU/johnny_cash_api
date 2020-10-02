<?php


class Product extends Model {

    function getStockState() {
        $result = [];
        $sql = "SELECT name, stock FROM johnnysku ORDER BY stock ASC";

        try{
            $result = $this->dbh->query($sql);
        }catch (Exception $e) {
            throw new Exceptions($e->getMessage(), $e->getCode());
        }

        $rows = array();
        while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
            $r['name'] = utf8_encode($r['name']);

            $rows[] =  $r;
        }
        return $rows;
    }

    function getTopSellingProducts($data) {
        $result = array();
        // Getting parameters from URL
        if(isset($data['from_date']) && !empty($data['from_date'] && !empty($data['to_date']))) {
            $from_date = $data['from_date']." 10:30:00";
            $to_date = $data['to_date']." 10:30:00";
        }

        $sql = "SELECT jol.skuId, js.name, SUM(jol.quantity) AS TotalSellQuantity
FROM johnnyorderlog jol JOIN johnnysku js WHERE jol.skuId = js.id";

        if(!empty($from_date) && !empty($to_date)) {
            $sql .= " AND jol.time_created BETWEEN '".$from_date."' AND '".$to_date."'";
        }

        $sql .= " GROUP BY jol.skuId ORDER BY SUM(jol.quantity) DESC";

        try{
            $result = $this->dbh->query($sql);
        }catch (Exception $e) {
            throw new Exceptions($e->getMessage(), $e->getCode());
        }

        $rows = array();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    }
}