<?php
class PaymentProcessor {
    public function processPayment($amount){
        $amount = (float)$amount;
        echo "Processing payment of $$amount...\n";
        return true; 
    }
}
?>