<?php
require '../loadtemplate.php';
session_start();
$title = 'Home';
$output = loadTemplate('../templates/game.html.php', []);
require '../templates/layout.html.php';
