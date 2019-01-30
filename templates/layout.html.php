<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/stylesheet.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
</head>
<body class= main>

<header>

<img  src="img/logo.png" height="90"alt="logo" class="logo">
<input type="checkbox" id="nav-toggle" class="nav-toggle">
<form class="search-form" action="" method="post">
  <input type="search" placeholder="search" id="search" name="search" class="search">
  <button type="submit" value="search"> <i class="fa fa-search"></i> </button>
</form>

<nav>
  <ul>

    <li><a href="index.php">Home</a>
    <li><a href="">Games</a>
    <li><a href="">Consoles</a>
    <li><a href="">Cart</a>
    <li><a href="login.php">Login</a>


  </ul>
</nav>

<label for="nav-toggle" class="nav-toggle-label">

<span></span>

</label>

</header>
<?=$output?>
</body>
<footer>
<div class="copyright">
  &copy; Northampton Gaming 2019

</div>
</footer>
