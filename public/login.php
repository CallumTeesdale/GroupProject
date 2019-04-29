<?php
session_start();
require '../loadtemplate.php';
$title = 'Login';
$output = loadTemplate('../templates/login.html.php', []);
require '../templates/layout.html.php';
