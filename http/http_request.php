<?php namespace http;
include_once '../connection.php';
if (!empty ($_POST)) {
    foreach ($_POST as $key => $http_field) {
        if ($key == 'post') {
            $new_post =
            [
                'post' => $http_field,
                'visible' => 0
            ];
            $conn = new \Connection('localhost', 'ps_api', 'root', '');

            $conn->executePreparedStatement($conn->insertPrepareStatement('posts', $new_post));
        }

    }
}
