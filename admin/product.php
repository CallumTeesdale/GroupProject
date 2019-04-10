<?php

require '../database.php';
require 'DBTable.php';


	$date = new DateTime();

if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('INSERT INTO  games (game_title, game_description, game_text, age_rating, price, platform, publisher, developer, release_date, metacritic_score, quantity, trailer_link, code)
  VALUES (:game_title, :game_description, :game_text, :age_rating, :price, :platform, :publisher, :developer, :release_date, :metacritic_score, :quantity, :trailer_link, :code)');

  $values = [
    'game_title' => $_POST['game_title'],
		'game_description' => $_POST['game_description'],
    'game_text' => $_POST['game_text'],
    'age_rating' => $_POST['age_rating'],
    'price' => $_POST['price'],
    'platform' => $_POST['platform'],
    'publisher' => $_POST['publisher'],
    'developer' => $_POST['developer'],
    'release_date' => $date->format('Y-m-d'),
    'metacritic_score' => $_POST['metacritic_score'],
    'quantity' => $_POST['quantity'],
    'trailer_link' => $_POST['trailer_link'],
    'code' => $_POST['code']
	];

	$stmt->execute($values);
	echo 'Game ' . $_POST['game_title'] . ' added';

}
else {
?>
<form action="product.php" method="POST">
	<label>Game Title:</label>
	<input type="text" name="game_title" /><br><br>

  <label>Game Description:</label>
  <textarea name="game_description" rows="5" cols="40"></textarea><br><br>

  <label>Game Text:</label>
  <textarea name="game_text" rows="5" cols="40"></textarea><br><br>

  <label>Age Rating:</label>
  <input type="radio" name="age_rating"
    <?php if (isset($age_rating) && $age_rating=="female") echo "checked";?>
        value="3+">3+
  <input type="radio" name="age_rating"
    <?php if (isset($age_rating) && $age_rating=="male") echo "checked";?>
        value="7+">7+
  <input type="radio" name="age_rating"
    <?php if (isset($age_rating) && $age_rating=="other") echo "checked";?>
        value="12+">12+
  <input type="radio" name="age_rating"
    <?php if (isset($age_rating) && $age_rating=="other") echo "checked";?>
        value="18+">15+
  <input type="radio" name="age_rating"
    <?php if (isset($age_rating) && $age_rating=="other") echo "checked";?>
        value="18+">18+
<br><br>

<label>Price:</label>
<input type="text" name="price" /><br><br>

<label>Platform:</label>
<input type="text" name="platform" /><br><br>

<label>Publisher:</label>
<input type="text" name="publisher" /><br><br>

<label>Developer:</label>
<input type="text" name="developer" /><br><br>

<label>Release Date:</label>
<input type="date" id="start" name="trip-start"
       value="2019-01-01"
       min="2000-01-01" max="2022-12-31"><br><br>

<label>Metacritic Score:</label>
<input type="text" name="metacritic_score" /><br><br>

<label>Quantity:</label>
<input type="text" name="quantity" /><br><br>

<label>Trailer Link:</label>
<input type="text" name="trailer_link" /><br><br>

<label>Unique Code:</label>
<input type="text" name="code" /><br><br>


	<input type="submit" name="submit" value="Add" />
</form>
<?php
}
?>
