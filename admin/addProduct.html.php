<?php

require '../database.php';
require '../classes/DatabaseTable.php';


$databaseTable = new \classes\DatabaseTable($pdo, 'games', 'game_id');



if (isset($_POST['submit'])&& $_SESSION['is_staff']==true) {
  $date=date_create($_POST['product']['release_date']);
  $formated = date_format($date, "Y/m/d");
  $_POST['product']['release_date'] = $formated;
  $image = file_get_contents($_FILES['game_image']['tmp_name']);
  $_POST['product']['game_image'] = $image;
  $product=$_POST['product'];
  $databaseTable->save($product);
	header('Location: /admin/products.php');

}
else {
?>
<div class="addFormWrapper">
  <div class="addFormTextWrapper">
    <div class="addForm">
      <div class="addFormWrap">
<form action="" method="POST" enctype="multipart/form-data">
	<label>Game Title:</label>
	<input type="text" name="product[game_title]" />

  <label>Game Description:</label>
  <textarea name="product[game_description]" rows="5" cols="40"></textarea>

  <label>Game Text:</label>
  <textarea name="product[game_text]" rows="5" cols="40"></textarea>

  <label>Age Rating:</label>
  <label>3+
  <input type="radio" name="product[age_rating]"
    <?php if (isset($age_rating) && $age_rating=="other") echo "checked";?> value="3+">
      </label>
      <label>7+
  <input type="radio" name="product[age_rating]"<?php if (isset($age_rating) && $age_rating=="other") echo "checked";?>value="7+">
        </label>
      <label>12+
  <input type="radio" name="product[age_rating]" <?php if (isset($age_rating) && $age_rating=="other") echo "checked";?> value="12+">
        </label>
        <label>16+
  <input type="radio" name="product[age_rating]"<?php if (isset($age_rating) && $age_rating=="other") echo "checked";?>value="18+">
        </label>
        <label>18+
  <input type="radio" name="product[age_rating]"<?php if (isset($age_rating) && $age_rating=="other") echo "checked";?>value="18+">
  </label>

<label>Price:</label>
<input type="text" name="product[price]" />

<label>Platform:</label>
<input type="text" name="product[platform]" />

<label>Publisher:</label>
<input type="text" name="product[publisher]" />

<label>Developer:</label>
<input type="text" name="product[developer]" />

<label>Release Date:</label>
<input type="date" id="start" name="product[release_date]"
       value="2019-01-01"
       min="2000-01-01" max="2022-12-31">

<label>Metacritic Score:</label>
<input type="text" name="product[metacritic_score]" />

<label>Quantity:</label>
<input type="text" name="product[quantity]" />

<label>Trailer Link:</label>
<input type="text" name="product[trailer_link]" /><br><br>

<label>Unique Code:</label>
<input type="text" name="product[code]" /><br><br>

<label>Product Image:</label>
<input type="file" name="game_image" accept="*/image" />


	<input type="submit" name="submit" value="Add" />
</form>
</div>
</div>
</div>
</div>
<?php
}
?>
