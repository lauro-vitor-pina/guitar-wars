<?php
require_once(__DIR__ . '../../appvars.php');
require(__DIR__ . '../../controllers/guitarwars_controller_add_score.php');

$result_view_model = guitarwars_controller_add_score();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars - Add Your High Score</title>
</head>

<body>

    <?php if ($result_view_model['insert_result']) { ?>

        <p>Thanks for adding your new high score!</p>

        <p>
            <strong>Name:</strong> <?php echo $result_view_model['name']; ?> <br />
            <strong>Score:</strong> <?php echo $result_view_model['score']; ?> <br />
            <strong>Screenshot:</strong> <br />
            <img src="<?php echo '../' . GW_IMAGE_PATH . $result_view_model['screenshot_name']; ?>" alt="image">
        </p>
        <p>
            <a href="guitarwars_view_list_score.php">&lt;&lt; Back to high scores</a>
        </p>

    <?php } else { ?>

        <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2>Guitar Wars - Add Your High Score</h2>

            <hr>

            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $result_view_model['name']; ?>">
            </div>
            <br>

            <div>
                <label for="score">Score:</label>
                <input type="number" name="score" min="0" value="<?php echo $result_view_model['score']; ?>">
            </div>
            <br>

            <div>
                <label for="screenshot">Screenshot:</label>
                <input type="file" id="screenshot" name="screenshot" value="<?php echo $result_view_model['screenshot']; ?>" />
            </div>

            <hr>

            <input type="submit" name="submit" value="Add">
        </form>

        <?php

        if (!empty($result_view_model['message'])) {
            echo '<span style="color:red;">' . $result_view_model['message'] . '</span>';
        }

        ?>


    <?php } ?>


</body>

</html>