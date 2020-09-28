<?php


class Order extends Model {
    function getUnpaidBillOfEmployee($data) {

        // Query will give unpaid bills of employee(not consider their paid amount).
        $sql1 = "select jol.employeeId, je.name, SUM(jol.totalPrice) as TotalUnpaidBill from johnnyorderlog jol JOIN johnnyemployee je WHERE jol.employeeId = je.id AND jol.paidInBox is NULL GROUP BY jol.employeeId";
        $result = $this->dbh->query($sql1);
        $arrUnpaidBill = $result->fetchAll(PDO::FETCH_ASSOC);

        // Query to get total paid amount of employee.
        $sql2 = "select jpl.employeeId, je.name, SUM(jpl.amount) as TotalPaidBill from johnnypaymentlog jpl JOIN johnnyemployee je where jpl.employeeId = je.id GROUP BY jpl.employeeId";
        $result = $this->dbh->query($sql2);
        $arrPaidBill = $result->fetchAll(PDO::FETCH_ASSOC);

        $finalUnpaidBill = array();
        foreach($arrUnpaidBill as $key => $eachUnpaidBill) {
            foreach ($arrPaidBill as $eachPaidBill) {
                if($eachUnpaidBill['employeeId'] == $eachPaidBill['employeeId']) {
                    $finalUnpaidBill[$key]['id'] = $eachUnpaidBill['employeeId'];
                    $finalUnpaidBill[$key]['name'] = utf8_encode($eachUnpaidBill['name']);
                    $finalUnpaidBill[$key]['FinalUnpaidBill'] = ($eachUnpaidBill['TotalUnpaidBill'] - $eachPaidBill['TotalPaidBill']);
                }
            }
        }

        return $finalUnpaidBill;
    }
}