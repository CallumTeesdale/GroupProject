<?php
require "../database.php";
if (isset($_POST['submit'])) {
  $stmt = $pdo->prepare('SELECT * FROM staff WHERE username = :username');
  $criteria = [
  'username' => $_POST['username']
  ];
  $stmt->execute($criteria);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if(password_verify($_POST['password'], $result['password'])){
    $_SESSION['logged_in'] = true;
    $_SESSION['staff_id'] = $result['staff_id'];
    $_SESSION['username'] = $result['username'];
    $_SESSION['is_staff'] = $result['is_staff'];
    session_write_close();
  }
}
if (!isset($_SESSION['logged_in'])&&!isset($_SESSION['is_staff'])) {?>
<div class="title">
  <h1>Login</h1>
</div>

<form class="login-form" action="" method="post">
<input type="search" placeholder="Username" id="search" name="username" class="search"><br><br><br>
<input type="password" placeholder="Password" id="search" name="password" class="search"><br><br><br>
<input type="submit" name="submit" value="Login" /><br><br><br>
</form>
<?php }else{?>
    <div class="title">
    <h1> Welcome [username]</h1>
  </div>



    <ul class="admin">
      <li class="products">
      <a href="/admin/products.php">

        <h1>Products</h1>

      </a>
      </li>
      <a href="../admin/createAdmin.php">
      <li class="users">
      <h1>Create Staff</h1>
      </li>
      </a>

      <a href="../public/orders.php">
      <li class="orders">
        <h1>Orders</h1>
      </li>
      </a>

      <a href="../admin/admin.php?action=signout">
      <li class="vacant">
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

