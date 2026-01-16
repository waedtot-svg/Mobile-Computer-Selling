<?php
class Order {
    private $items = []; 

    public function addItem($product, $quantity){
        $quantity = (int)$quantity;
        $this->items[] = ["product" => $product, "quantity" => $quantity];
    }

    public function getItems(){ return $this->items; }

    public function calculateTotal(){
        $total = 0;
        foreach($this->items as $item){
            $total += $item["product"]->getPrice() * $item["quantity"];
        }
        return $total;
    }
}
?>