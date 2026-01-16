<?php
require_once "PaymentProcessor.php";

class OrderManager {
    public function processOrder($order){
        $total = $order->calculateTotal();
        echo "Total: $$total\n";

        $payment = new PaymentProcessor();
        if($payment->processPayment($total)){
            foreach($order->getItems() as $item){
                $item["product"]->updateStock($item["quantity"]);
            }
            echo "Sale completed successfully!\n";
            return true;
        }
        echo "Payment failed!\n";
        return false;
    }
}
?>