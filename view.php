<?php session_start(); ?>
<?php require_once('connections/dbconnection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploads</title>
    <link rel="stylesheet" href="css/main.css" >
</head>

<body class="body">
    <a href="index.php">
        <h1>
            <- Back </h1>
    </a>

    <?php

        $query = "SELECT * FROM files";

        $result = mysqli_query($connection, $query);

        if($result){

            while($record = mysqli_fetch_array($result)){

                ?>

                <div class="image">
                    <img src="uploads/<?=$record['file_name'] ?>">
                </div>

                <?php

            }

        }

    ?>

</body>

</html>

<?php mysqli_close($connection); ?>