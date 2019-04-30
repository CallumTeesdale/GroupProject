<?php
require '../loadtemplate.php';
session_start();
$title = 'Products';
$output = loadTemplate('adminLogin.html.php', []);
require '../templates/layout.html.php';