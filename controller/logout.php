<?php
session_start();
session_destroy();

header("location:../layout/login.php");