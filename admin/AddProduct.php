<?php
require '../loadtemplate.php';
session_start();
$title = 'Products';
$output = loadTemplate('addProduct.html.php', []);
require '../templates/layout.html.php';