<?php session_start(); ?>
<?php require_once('connections/dbconnection.php'); ?>

<?php

    if(isset($_POST['submit']) && isset($_FILES['image'])){

        echo "File submitted! <br>";

        $image_name = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $error = $_FILES['image']['error'];
        $tmp_name = $_FILES['image']['tmp_name'];

        if($error === 0){
            if($image_size > 12500000){
                echo "Sorry! your file is too large.";
            }else{

                $img_ex = pathinfo($image_name, PATHINFO_EXTENSION); //function to take file extension
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if(in_array($img_ex_lc, $allowed_exs)){

                    $new_img_name = uniqid("IMG-",true) . "." . $img_ex_lc;
                    $img_upload_path =  'uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    //Insert into the database

                    $query = "INSERT INTO files(file_name)
                              VALUES('$new_img_name')";

                    $result = mysqli_query($connection, $query);

                    if($result){
                        echo "Successfully uploaded to the Database.";
                    }else{
                        echo "Uploading failed!";
                    }

                }else{
                    echo "You can not upload files of this type!";
                }

            }
        }else{
            echo "Unknown error occured!";
        }

    }else{
        echo "Failed to Upload!";
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files Uploads</title>
</head>

<body>

    <form action="index.php" method="POST" enctype="multipart/form-data">

        <input type="file" name="image">
        <input type="submit" name="submit">

    </form>

    <a href="view.php"><h1>View Uploads</h1></a>

</body>

</html>

<?php mysqli_close($connection); ?>