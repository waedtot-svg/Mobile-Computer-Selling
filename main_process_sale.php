<?php
require_once "Product.php";
require_once "Order.php";
require_once "OrderManager.php";
session_start();

if(!isset($_SESSION["userID"])){
    header("Location: login.php");
    exit;
}

if(!isset($_SESSION["products"]) || empty($_SESSION["products"])){
    $_SESSION["products"] = [
        "P001" => ["id"=>"P001","name"=>"Laptop hp","price"=>2000,"stock"=>10,"warranty"=>"2 years"],
        "P002" => ["id"=>"P002","name"=>"Laptop mac","price"=>1200,"stock"=>8,"warranty"=>"1 year"],
        "P003" => ["id"=>"P003","name"=>"Laptop Dell","price"=>1000,"stock"=>12,"warranty"=>"3 years"],
        "P004" => ["id"=>"P004","name"=>"iPhone 16 pro max","price"=>1500,"stock"=>2,"warranty"=>"1 year"],
        "P005" => ["id"=>"P005","name"=>"samsung","price"=>1000,"stock"=>16,"warranty"=>"2 years"],
        "P006" => ["id"=>"P006","name"=>"iPhone 14","price"=>1100,"stock"=>8,"warranty"=>"1 year"],
    ];
}

$productArrays = $_SESSION["products"];

$products = [];
foreach($productArrays as $id => $arr){
    $products[$id] = Product::fromArray($arr);
}

$message = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $order = new Order();

    $quantities = $_POST["quantities"] ?? [];
    foreach($quantities as $id => $qty){
        $qty = (int)$qty;
        if($qty > 0 && isset($products[$id])){
            if(!$products[$id]->isAvailable($qty)){
                $message .= "Not enough stock for {$products[$id]->getName()} (requested $qty, available {$products[$id]->getStock()})\n";
                continue;
            }
            $order->addItem($products[$id], $qty);
        }
    }

    $manager = new OrderManager();
    ob_start();
    $manager->processOrder($order);
    $message .= ob_get_clean();

    foreach($products as $id => $p){
        $productArrays[$id] = $p->toArray();
    }
    $_SESSION["products"] = $productArrays;
}
?>
<!DOCTYPE html>
<html>
<head><title>Process Sale</title></head>
<body>
<h2>Welcome <?php echo htmlspecialchars($_SESSION["userID"]); ?></h2>
<a href="add_product.php">➕ Add Product</a> | <a href="logout.php">Logout</a>

<h3>Process Sale</h3>
<form method="post">
<?php foreach($products as $id => $p): ?>
    <p>
        <?php echo htmlspecialchars($p->getName()); ?>
        ($<?php echo htmlspecialchars($p->getPrice()); ?>) -
        Stock: <?php echo htmlspecialchars($p->getStock()); ?> -
        Warranty: <?php echo htmlspecialchars($p->getWarranty()); ?><br>
        Quantity: <input type="number" name="quantities[<?php echo htmlspecialchars($id); ?>]" value="0" min="0">
    </p>
<?php endforeach; ?>
    <button type="submit">Confirm Sale</button>
</form>

<?php if($message): ?>
<h3>Result:</h3>
<pre><?php echo htmlspecialchars($message); ?></pre>
<?php endif; ?>
</body>
</html>
