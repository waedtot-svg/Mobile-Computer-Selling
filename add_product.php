<?php
require_once "Product.php";
session_start();

if(!isset($_SESSION["userID"])){
    header("Location: login.php");
    exit;
}

if(!isset($_SESSION["products"]) || !is_array($_SESSION["products"])){
    $_SESSION["products"] = [];
}

$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = trim($_POST["id"] ?? "");
    $name = trim($_POST["name"] ?? "");
    $price = (float)($_POST["price"] ?? 0);
    $stock = (int)($_POST["stock"] ?? 0);
    $warranty = trim($_POST["warranty"] ?? "");

    if($id !== "" && $name !== "" && $price > 0 && $stock >= 0){
        $p = new Product($id, $name, $price, $stock, $warranty);
        $_SESSION["products"][$id] = $p->toArray();

        header("Location: main_process_sale.php");
        exit;
    } else {
        $error = "Please fill all fields correctly.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Product</title></head>
<body>
<h2>Add New Product</h2>

<form method="post">
    <input type="text" name="id" placeholder="Product ID" required><br><br>
    <input type="text" name="name" placeholder="Product Name" required><br><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br><br>
    <input type="number" name="stock" placeholder="Stock" required><br><br>
    <input type="text" name="warranty" placeholder="Warranty"><br><br>

    <button type="submit">Add Product</button>
</form>

<?php if($error): ?>
<p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<a href="main_process_sale.php">Back to Sales</a> |
<a href="logout.php">Logout</a>
</body>
</html>
