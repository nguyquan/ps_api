<?php
/**
 * Created by PhpStorm.
 * User: anthonyguertin
 * Date: 10/8/15
 * Time: 9:45 PM
 */
include_once('./connection.php');


$conn = new Connection('localhost', 'ps_api', 'root', '');
$test = array
(
    'post' => 'Newest Test',
    'visible' => 1


);
$conn->executePreparedStatement($conn->insertPrepareStatement('posts', $test));