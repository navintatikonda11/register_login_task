<?php
require 'includes/helpers.php';
session_start();
session_destroy();
redirect('login.php');
