<?php

$user = json_decode($_COOKIE["user"], true);
if (!$user) {
    header("Location:index.php?invalid=Please login first!");
}
