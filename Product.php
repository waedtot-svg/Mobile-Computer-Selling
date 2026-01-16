<?php
class Product {
    private $id;
    private $name;
    private $price;
    private $stock;
    private $warranty;

    public function __construct($id, $name, $price, $stock, $warranty = "No warranty") {
        $this->id = $id;
        $this->name = $name;
        $this->price = (float)$price;
        $this->stock = (int)$stock;
        $this->warranty = $warranty;
    }

    public function getId(){ return $this->id; }
    public function getName(){ return $this->name; }
    public function getPrice(){ return $this->price; }
    public function getStock(){ return $this->stock; }
    public function getWarranty(){ return $this->warranty; }

    public function updateStock($qty){
        $qty = (int)$qty;
        $this->stock -= $qty;
    }

    public function isAvailable($qty){
        return $this->stock >= (int)$qty;
    }

    public static function fromArray($arr){
        return new Product($arr['id'], $arr['name'], $arr['price'], $arr['stock'], $arr['warranty'] ?? "No warranty");
    }

    public function toArray(){
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "price"=>$this->price,
            "stock"=>$this->stock,
            "warranty"=>$this->warranty
        ];
    }
}
?>