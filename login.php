<?php
require_once "AuthenticationManager.php";
session_start();

$msg = "";
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    $auth = new AuthenticationManager();
    $user = $auth->validateCredentials($email, $password);

    if($user){
        session_regenerate_id(true);
        $_SESSION["userID"] = $user->getId();
        header("Location: main_process_sale.php");
        exit;
    } else {
        $msg = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<form method="post">
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
<p style="color:red;"><?php echo htmlspecialchars($msg); ?></p>


</p>
</body>
</html>
