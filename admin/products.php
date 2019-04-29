<?php
require '../loadtemplate.php';
session_start();
$title = 'Products';
$output = loadTemplate('productList.html.php', []);
require '../templates/layout.html.php';