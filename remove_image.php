<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    remove();

    function remove(){
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $query = "DELETE FROM preferiti WHERE user_id = '$userid' AND image_id = '$id'";
        $res = mysqli_query($conn, $query);

        if ($res) {
            if (mysqli_affected_rows($conn) > 0) {
                echo json_encode(array('ok' => true));
            } else {
                echo json_encode(array('ok' => false, 'error' => 'No rows affected'));
            }
        } else {
            echo json_encode(array('ok' => false, 'error' => mysqli_error($conn)));
        }
        mysqli_close($conn);
    }
?>