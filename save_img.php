<?php
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    img();

    function img (){
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

        $userid = mysqli_real_escape_string($conn, $userid);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $tags = mysqli_real_escape_string($conn, $_POST['tags']);
        $views = mysqli_real_escape_string($conn, $_POST['views']);
        $downloads = mysqli_real_escape_string($conn, $_POST['downloads']);
        $likes = mysqli_real_escape_string($conn, $_POST['likes']);
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $query = "SELECT * FROM preferiti WHERE user_id = '$userid' AND image_id = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));
            exit;
        }

        $query = "INSERT INTO preferiti(user_id, image_id, content) VALUES('$userid','$id', JSON_OBJECT('id', '$id', 'tags', '$tags', 'views', '$views', 'downloads', '$downloads', 'likes', '$likes', 'user', '$user', 'image', '$image', 'name', '$name'))";
        error_log($query);
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }
?>
