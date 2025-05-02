<?php

require(__DIR__ . '../../controllers/guitarwars_controller_remove_score.php');

$view_model_result = guitarwars_controller_remove_score();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars - Remove a High Score</title>
</head>

<body>
    <h1>Guitar Wars - Remove a High Score</h1>

    <?php if ($view_model_result['delete_result'] == false) { ?>

        <p>Are you sure you want to delete the following high score?</p>

        <p>
            <b>Name:</b>
            <span><?php echo $view_model_result['name']; ?></span>
        </p>

        <p>
            <b>Date:</b>
            <span><?php echo $view_model_result['date']; ?></span>
        </p>

        <p>
            <b>Score:</b>
            <span><?php echo $view_model_result['score']; ?></span>
        </p>

        <form action="guitarwars_view_remove_score.php" method="post">

            <p>
                <input type="radio" name="confirm" value="Yes" <?php echo $view_model_result['confirm'] == 'Yes' ? 'checked' : '' ?> /> Yes
                <input type="radio" name="confirm" value="No" <?php echo $view_model_result['confirm'] == 'No' ? 'checked' : '' ?> /> No
            </p>

            <p>
                <input type="submit" value="Submit" name="submit">
            </p>

            <input type="hidden" name="id" value="<?php echo $view_model_result['id']; ?>">
            <input type="hidden" name="name" value="<?php echo $view_model_result['name']; ?>">
            <input type="hidden" name="date" value="<?php echo $view_model_result['date']; ?>">
            <input type="hidden" name="score" value="<?php echo $view_model_result['score']; ?>">
            <input type="hidden" name="screenshot" value="<?php echo $view_model_result['screenshot']; ?>">
        </form>

    <?php } else {
        echo '<p> The high score of ' . $view_model_result['score'] . ' for ' . $view_model_result['name'] . ' was successfully removed.</p>';
    } ?>


    <a href="guitarwars_view_admin.php">&lt;&lt;Back to admin Page</a>
</body>

</html>