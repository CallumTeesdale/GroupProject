<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="../public/styles/styles.css" />
    <link rel="icon" type="image/png" href="../public/img/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../public/img/favicon-16x16.png" sizes="16x16" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.search input[type="text"]').on("keyup input", function() {
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("/templates/backend-search.php", {
                        term: inputVal
                    }).done(function(data) {
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });
            $(document).on("click", ".result p", function() {
                $(this).parents(".search").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
</head>

<body class=main>


    <header>

        <a href="index.php" class="logo"> <img src="../public/img/logo.png" height="90" alt="logo" class="logo"></a>

        <input type="checkbox" id="nav-toggle" class="nav-toggle">

        <div class="search">
            <form class="search-form" action="../public/search.php" method="post">
                <input type="text" autocomplete="off" placeholder="Search..." name="term"/>
                <button type="submit" value="search"> <i class="fa fa-search"></i> </button>
                <div class="result"></div>
            </form>
        </div>
        <nav>
            <ul>

                <li><a href="index.php">Home</a>
                <li><a href="">Games</a>
                <li><a href="">Consoles</a>
                <li><a href="cart.php">Cart</a>
                <li><a href="login.php">Login</a>


            </ul>
        </nav>

        <label for="nav-toggle" class="nav-toggle-label">

            <span></span>

        </label>

    </header>

    <body>
        <?= $output ?>

    </body>
    <footer>
        <div class="copyright">
            &copy; Northampton Gaming 2019

            <a href="admin.php">Admin page</a>

        </div>
    </footer>