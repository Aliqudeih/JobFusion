<?php
session_start();


session_unset();
session_destroy();

header("Location: page4.php");
exit();
