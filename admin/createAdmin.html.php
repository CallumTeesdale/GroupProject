<?php

require '../database.php';
require '../classes/DatabaseTable.php';


$databaseTable = new \classes\DatabaseTable($pdo, 'staff', 'staff_id');
if (isset($_POST['submit']) && $_SESSION['is_staff']==true) {
    $password = $_POST['account']['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $_POST['account']['password'] = $hashed;
    $account = $_POST['account'];
    $databaseTable->save($account);
    header('Location: /admin/admin.php');
  } else { ?>
    <div class="addFormWrapper">
    <div class="addFormTextWrapper">
    <div class="addForm">
    <form action="" method="POST">
    <label for="account[username]">username:</label>
        <input type="text" name="account[username]"/><br><br>
        <label for="account[password]">Password:</label>
        <input type="password" name="account[password]"/><br><br>      
        <input type="hidden" name="account[is_staff]" value="1"/><br><br>
        <input type="submit" name="submit" value="Create Account" />

    </form>
    </div>
  </div>
    </div>


  <?php }?>