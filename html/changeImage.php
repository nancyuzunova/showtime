<?php
    if(isset($_GET['change']) && ($_GET['change'] == "profile" || $_GET['change'] == "cover")){
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            if ($_FILES['file']['type'] == "image/jpeg") {
                $allowedSize = 1024 * 1024 * 7; // 7 MB
                if ($_FILES['file']['size'] <= $allowedSize) {
                    //create a folder for each user
                    if (isset($userId)) {
                        $folder = "../uploads/" . $userId . "/";
                    }
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }

                    $editor = new ImageEditor();
                    $filename = $folder . $_FILES['file']['name'] . date("Y-m-d H-i-s") . ".jpg";
                    move_uploaded_file($_FILES['file']['tmp_name'], $filename);

                    $change = "profile";
                    if (isset($_GET['change'])) {
                        $change = $_GET['change'];
                    }
                    if ($change == "cover") {
                        if (isset($userData['cover_image']) && file_exists($userData['cover_image'])) {
                            unlink($userData['cover_image']);
                        }
                        $editor->resizeImage($filename, $filename, 1500, 1500);
                    } else {
                        if (isset($userData['profile_image']) && file_exists($userData['profile_image'])) {
                            unlink($userData['profile_image']);
                        }
                        $editor->resizeImage($filename, $filename, 1500, 1500);
                    }

                    if (file_exists($filename)) {
                        if ($change == "cover") {
                            $query = "update users set cover_image = '$filename' where user_id = $userId";
                            $_POST['is_cover_image'] = 1;
                        } else {
                            $query = "update users set profile_image = '$filename' where user_id = $userId";
                            $_POST['is_profile_image'] = 1;
                        }
                        $connection = new Connection();
                        $connection->write($query);

                        //create a post
                        $post = new Post();
                        $post->createPost($userId, $_POST, $filename);

                        header("Location: profile.php");
                        die();
                    }
                }
            }
        }
    }
