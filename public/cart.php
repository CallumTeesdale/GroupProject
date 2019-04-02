<?php

require '../loadtemplate.php';
require "../database.php";
$title = 'Cart';
$output = loadTemplate('../templates/cart.html.php', []);
require '../templates/layout.html.php';
