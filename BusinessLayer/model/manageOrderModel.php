<?php
require_once '../../libs/database.php';

class manageOrderModel{
    public $serviceID, $spID, $servicetype, $itemname, $itemprice, $itemimage;
    public $orderID, $custID, $itemquantity, $status;
    
    
    function viewAllGood(){
        $sql = "select * from service where servicetype = 'Good'";
        return DB::run($sql);
    }

    function viewAllFood(){
        $sql = "select * from service where servicetype = 'Food'";
        return DB::run($sql);
    }

    function viewAllPet(){
        $sql = "select * from service where servicetype = 'Pet'";
        return DB::run($sql);
    }

    function viewAllMedical(){
        $sql = "select * from service where servicetype = 'Medical'";
        return DB::run($sql);
    }

    //add item to the cart
    function addToCart($custID, $serviceID, $itemname, $itemprice, $itemquantity) {
        $sql = "INSERT INTO order1 (custID, serviceID, itemname, itemprice, itemquantity) VALUES (:custID, :serviceID, :itemname, :itemprice, :itemquantity)";
        $args = [':custID' => $custID, ':serviceID' => $serviceID, ':itemname' => $itemname, ':itemprice' => $itemprice, ':itemquantity' => $itemquantity];
        return DB::run($sql, $args);
    }

    //view cart
    function viewAllOrder(){
        $sql = "select * from (order1 inner join service on order1.serviceID = service.serviceID) where custID = :custID and order1.status=0";
        $args = [':custID'=>$this->custID];
        return DB::run($sql, $args);
    }

    function deleteOrder(){
        $sql = "delete from order1 where serviceID = :serviceID and custID = :custID";
        $args = [':serviceID'=>$this->serviceID, ':custID'=>$this->custID];
        return DB::run($sql,$args);
    }

    function updateOrders(){
        $sql = "update order1 set itemname=:itemname, itemprice=:itemprice, itemquantity=:itemquantity where serviceID = :serviceID and custID = :custID";
        $args = [':serviceID'=>$this->serviceID, ':custID'=>$this->custID, ':itemname'=>$this->itemname, ':itemprice'=>$this->itemprice, ':itemquantity'=>$this->itemquantity];
        return DB::run($sql,$args);
    }
    
    function getCartItem($custID, $serviceID) {
    $sql = "SELECT * FROM order1 WHERE custID = :custID AND serviceID = :serviceID";
    $args = [':custID' => $custID, ':serviceID' => $serviceID];
    return DB::run($sql, $args)->fetch();
    }

    function updateCartItem($custID, $serviceID, $quantity) {
        $sql = "UPDATE order1 SET itemquantity = :quantity WHERE custID = :custID AND serviceID = :serviceID";
        $args = [':custID' => $custID, ':serviceID' => $serviceID, ':quantity' => $quantity];
        return DB::run($sql, $args);
    }
}
?>
