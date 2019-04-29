<?php
require '../loadtemplate.php';
session_start();
$title = 'Products';
$output = loadTemplate('editProduct.html.php', []);
require '../templates/layout.html.php';