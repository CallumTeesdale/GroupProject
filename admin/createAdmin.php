<?php
require '../loadtemplate.php';
session_start();
$title = 'Products';
$output = loadTemplate('createAdmin.html.php', []);
require '../templates/layout.html.php';