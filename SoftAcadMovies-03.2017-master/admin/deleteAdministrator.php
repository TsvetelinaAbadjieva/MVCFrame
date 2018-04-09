<?php
session_start();
require_once 'common/functions.php';
require_once 'common/db.php';

if (!isLoggedInAdmin()) {
    redirect('login.php');
}

$db = DB::getInstance();

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ((int)$id <= 0) {
    redirect('administratorsListing.php');
}

$where = [
    'id' => $id
];
$user = $db->getOne('users', $where);

if (empty($user)) {
    redirect('administratorsListing.php');
}


$where = [
    'id' => $id
];
$result = $db->delete('users', $where);

redirect('administratorsListing.php');




