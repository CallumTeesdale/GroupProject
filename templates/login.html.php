<?php
require "../database.php";
if (isset($_POST['submit'])) {
  $stmt = $pdo->prepare('SELECT * FROM customers WHERE username = :username');
  $criteria = [
  'username' => $_POST['username']
  ];
  $stmt->execute($criteria);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if(password_verify($_POST['password'], $result['password'])){
    $_SESSION['logged_in'] = true;
    $_SESSION['customer_id'] = $result['customer_id'];
    $_SESSION['username'] = $result['username'];
    session_write_close();
  }
}
if (!isset($_SESSION['logged_in'])) {?>
<div class="title">
  <h1>Login</h1>
</div>

<form class="login-form" action="" method="post">
<input type="search" placeholder="Username" id="search" name="username" class="search"><br><br><br>
<input type="password" placeholder="Password" id="search" name="password" class="search"><br><br><br>
<input type="submit" name="submit" value="Login" /><br><br><br>
<a href="../public/createAccount.php">Create Account</a>
</form>
<?php }else{?>
  <div class="title">
    <h1> Welcome <?=$_SESSION['username']?></h1>
  </div>
  <ul class="admin">
      <li class="products">
      <a href="../public/account.php">

        <h1>account</h1>

      </a>
      </li>
      <a href="../public/orders.php">
      <li class="users">
      <h1>orders</h1>
      </li>
      </a>

      <a href="../public/login.php?action=signout">
      <li class="orders">
        <h1>signout</h1>
      </li>
      </a>
    </ul>

<?php } 
if (!empty($_GET["action"])) {
  switch ($_GET["action"]) {
    case "signout":
    session_destroy();
    header('Location: /public/index.php');
    break;
  }
}

?>

