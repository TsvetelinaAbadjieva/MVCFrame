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
    redirect('moviesListing.php');
}

$where = [
    'id' => $id
];
$image = $db->getOne('movies_images', $where);


if (empty($image)) {
    redirect('moviesListing');
}


$where = [
    'id' => $id
];
$result = $db->delete('movies_images', $where);

redirect('movieImages.php?id='.$image['movies_id']);



