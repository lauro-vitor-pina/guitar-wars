<?php

require_once(__DIR__ . '../../controllers/guitarwars/guitarwars_controller_aprove_score.php');
require_once(__DIR__ . '../../appvars.php');

$result = guitarwars_controller_aprove_score();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars - Approve Score</title>
</head>

<body>
    <h2>Guitar Wars - Approve Score</h2>

    <?php

    if (!empty($result['message'])) {
        echo '<p style="color:red;">' . $result['message'] . '</p>';
    }

    if ($result['result_approve']) {
        echo '<p style="color:green;">The register has been approved!</p>';
    }

    ?>


    <?php if ($result['result_select_by_id'] != null && $result['result_approve'] == false) { ?>

        <p>Are you sure you want to approve the following high Score?</p>

        <?php $row = $result['result_select_by_id'][0]; ?>
        <p>
            <b>Name:</b> <?php echo $row['name']; ?>
        </p>
        <p>
            <b>Date:</b> <?php echo $row['date']; ?>
        </p>
        <p>
            <b>Score:</b> <?php echo $row['score']; ?>
        </p>
        <p>
            <b>Screenshot:</b>
        </p>
        <p>
            <img src="<?php echo URL_IMAGE_PROXY . $row['screenshot']; ?>" alt="" width="400">
        </p>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <p>
                <input type="radio" name="confirm" value="yes"> Yes
                <input type="radio" name="confirm" value="no"> No
            </p>
            <p>
                <input type="submit" value="Submit" name="submit">
            </p>
        </form>

    <?php } ?>


    <a href="admin.php">&lt;&lt;Back to admin Page</a>
</body>

</html>