<?php
$db = new mysqli('127.0.0.1', 'root', '', 'food');

if($db->connect_errno) {
    die('Error');
}


