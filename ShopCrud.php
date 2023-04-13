<?php
class ShopCrud{

    private $crud;

    function __construct($crud){
        $this->crud = $crud;
    }

    function create_product($name, $discription, $price, $img_location){
        
        $sql = "INSERT INTO products(name, discription, price, image_location) VALUES
        (:name,:discription , :price, :img_location)";
        $values = array(":name"=>$name,":discription"=>$discription ,":price"=>$price, ":img_location"=>$img_location);
        $this->crud->createRow($sql, $values);
    }
    
    function read_all_products() {
        $sql = "SELECT * FROM products";
        $result= $this->crud->readMultipleRows($sql);
        return $result;
    }

    function read_products_by_id($id_array){
        $sql = "SELECT * FROM products WHERE";
        $values = array();
        foreach($id_array as $key => $id) {
            if (substr($sql,-5) == "WHERE"){
                $sql = $sql .  ' id=:id_' . $key;

            } else {
                $sql = $sql . ' OR id=:id_' . $key;
            }
            $values[':id_' . $key] = $id;
        }
        $result= $this->crud->readMultipleRows($sql, $values);
        return $result;
    }
    
    function read_products_top5(){
        $sql = "SELECT p.id, p.name, p.discription, p.price, p.image_location, SUM(ol.amount) as total
        FROM products p LEFT JOIN order_line ol ON p.id = ol.product_id 
        LEFT JOIN orders o ON o.id=ol.order_id 
        WHERE ADDDATE(o.time, INTERVAL 1 WEEK) >= '".date("Y-m-d") ."' 
        GROUP BY p.id 
        ORDER BY total DESC
        LIMIT 5";
    
        return $this->crud->readMultipleRows($sql);
    }
    
    function create_order($user_id,$time,$product_ids,$amounts){
        
        /* create order*/
        $sql = "INSERT INTO orders(user_id, time) VALUES (:user_id, :time)";
        $values = array( ":user_id" => $user_id,":time" => $time);
        $order_id = $this->crud->createRow($sql, $values);
        
        /* add the products to the order*/
        $sql = "INSERT INTO order_line(product_id, order_id, amount) VALUES ";
        $values = array();
        foreach ($product_ids as $product_id) {
            if (substr($sql,-7) != "VALUES "){
                $sql = $sql . " , ";
            }
            $sql = $sql . "(:product_id" . $product_id  .", :order_id" . $product_id . ", :amount" . $product_id . ")";

            $values[":product_id" . $product_id] = $product_id;
            $values[":order_id" . $product_id] = $order_id;
            $values[":amount" . $product_id] =  $amounts[$product_id];

        }
        echo $sql . "<br>";
        var_dump($values);echo "<br>";
        $this->crud->createRow($sql, $values);
        
    }
}
?>