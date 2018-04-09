<?php

function __autoload($className)
{
    $path = __DIR__."/system/{$className}.php";

    require_once $path;
}

function isLoggedInAdmin() {
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
        return true;
    }
    return false;
}



/**
 * @param $path
 */
function redirect($path)
{
    header("Location: {$path}");
    exit;
}



/**
 * @param $data
 * @return array
 */
function isValidAddAdministrator($data)
{
    $errors = [
        'username' => [],
        'password' => [],
        'email'    => [],
    ];

    //TODO Add validation for all fields

    return $errors;
}

/**
 * @param $errors
 * @return bool
 */
function checkForErrors($errors)
{
    $flag = true;
    foreach ($errors as $error) {
        if (!empty($error)) {
            $flag = false;
        }
    }

    return $flag;
}


function insertAdministrator($data, $conn)
{
    $username   = mysqli_real_escape_string($conn, $data['username']);
    $password   = mysqli_real_escape_string($conn, $data['password']);
    $email      = mysqli_real_escape_string($conn, $data['email']);

    $query = "
        INSERT INTO users
        SET 
        `username` = '{$username}',
        `password` = '{$password}',
        `email`    = '{$email}'
    ";

    mysqli_query($conn, $query);

    echo '<pre>';
    var_dump(mysqli_error($conn));
    echo '</pre>';

}

function getUsers($conn)
{
    $query = "SELECT * FROM users";

    $result = mysqli_query($conn, $query);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }


    echo '<pre>';
    var_dump(mysqli_error($conn));
    echo '</pre>';

    return $users;
}


/**
 * @param $username
 * @param $conn
 * @return array|null
 */
function getUserByUsername($username, $conn)
{
    $username = mysqli_real_escape_string($conn, $username);

    $query = "
        SELECT * FROM users
        WHERE users.username = '{$username}'
        LIMIT 1
    ";

    $queryResult = mysqli_query($conn, $query);

    $result = null;
    if ($queryResult) {
        $result = mysqli_fetch_assoc($queryResult);
    }
    
    
    echo '<pre>';
    var_dump(mysqli_error($conn)); 
    echo '</pre>';
    return $result;
}

function getUserById($id, $conn)
{
    $id = mysqli_real_escape_string($conn, $id);

    $query = "
        SELECT * FROM users
        WHERE users.id = {$id};
    ";

    $resultset = mysqli_query($conn, $query);

    if ($resultset) {
        $result = mysqli_fetch_assoc($resultset);
    }

    return $result;
}

function deleteUserById($id, $conn)
{
    $id = mysqli_real_escape_string($conn, $id);
    $query = "DELETE FROM users Where users.id = {$id}";

    $result = mysqli_query($conn, $query);
    return  mysqli_num_rows($result);
}

function updateAdministrator($data, $conn)
{

    $data['username'] = mysqli_real_escape_string($conn, $data['username']);
    $data['email'] = mysqli_real_escape_string($conn, $data['email']);
    $data['id']    = mysqli_real_escape_string($conn, $data['id']);

    $query = "
        UPDATE users
        SET
        `username` = '{$data['username']}',
        `email`    = '{$data['email']}'
        Where `id` = {$data['id']}
     ";

    $result = mysqli_query($conn, $query);
    echo '<pre>';
    var_dump(mysqli_error($conn)); 
    echo '</pre>';
    return mysqli_num_rows($result);
}


function createCategory($data, $conn)
{
    $name   = mysqli_real_escape_string($conn, $data['name']);
    $description   = mysqli_real_escape_string($conn, $data['description']);


    $query = "
        INSERT INTO movies_categories
        SET 
        `title` = '{$name}',
        `description` = '{$description}'
    ";

    mysqli_query($conn, $query);

    echo '<pre>';
    var_dump(mysqli_error($conn));
    echo '</pre>';
}

function getCategories($conn)
{
    $query = "SELECT * FROM movies_categories";

    $result = mysqli_query($conn, $query);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }


    echo '<pre>';
    var_dump(mysqli_error($conn));
    echo '</pre>';

    return $users;
}

