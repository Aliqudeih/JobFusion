<?php
session_start();


session_unset();
session_destroy();

header("Location: home0.php");
exit();
