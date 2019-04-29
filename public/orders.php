<?php
require '../loadtemplate.php';
session_start();
$title = 'Home';
$output = loadTemplate('../templates/orders.html.php', []);
require '../templates/layout.html.php';
