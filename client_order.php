<?php

session_start();
if (isset($_SESSION["code-verified"])) {
    echo 'Success entering into the client panel!';
} else {
    header("location: index.php");
}