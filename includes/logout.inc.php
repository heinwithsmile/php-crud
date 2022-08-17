<?php

session_start();
unset($_SESSION['uid']);
unset($_SESSION['uemail']);

header("Location: ../login.php");
