<?php

require '../database.php';
require '../classes/DatabaseTable.php';


$databaseTable = new \classes\DatabaseTable($pdo, 'customers', 'customer_id');
if (isset($_POST['submit'])) {
    $password = $_POST['account']['password'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $_POST['account']['password'] = $hashed;
    $date=date_create($_POST['account']['customer_dob']);
    $formated = date_format($date, "Y/m/d");
    $_POST['account']['customer_dob'] = $formated;
    $account = $_POST['account'];
    $databaseTable->save($account);
    header('Location: /public/login.php');
  } else { ?>
    <div class="addFormWrapper">
    <div class="addFormTextWrapper">
    <div class="addForm">
    <form action="" method="POST">
    <label for="account[username]">username:</label>
        <input type="text" name="account[username]"/><br><br>
        <label for="account[password]">Password:</label>
        <input type="password" name="account[password]"/><br><br>
       
        <label for="account[customer_firstname]">Firstname:</label>
        <input type="text" name="account[customer_firstname]"/><br><br>
        <label for="account[customer_surname]">Surname:</label>
        <input type="text" name="account[customer_surname]"/><br><br>
        <label for="account[address_line_1]">Address Line 1:</label>
        <input type="text" name="account[address_line_1]"/><br><br>
        <label for="account[address_line_2]">Address Line 2:</label>
        <input type="text" name="account[address_line_2]"/><br><br>
        <label for="account[city]">City:</label>
        <input type="text" name="account[city]"/><br><br>
        <label for="account[postcode]">Postcode:</label>
        <input type="text" name="account[postcode]"/><br><br>
        <label for="account[customer_dob]">DOB:</label>
        <input type="date" id="start" name="product[customer_dob]" min="1900-01-01"><br><br>

        <input type="submit" name="submit" value="Create Account" />

    </form>
    </div>
  </div>
    </div>


  <?php }?>