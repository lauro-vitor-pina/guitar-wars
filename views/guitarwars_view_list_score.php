<?php
require_once(__DIR__ . '../../appvars.php');
require(__DIR__ . '../../controllers/guitarwars_controller_list_score.php');

$result_view_model = guitarwars_controller_list_score();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars - High Scores</title>
</head>

<body>
    <h2>Guitar Wars - High Scores</h2>
    <p>
        Welcome, Guitar Waiors, do you have what it takes to crack the high score list ? if so,
        <a href="guitarwars_view_add_score.php">just add your score</a>.
    </p>
    <hr>
    <?php while ($row = mysqli_fetch_array($result_view_model['result_select'])) { ?>
        <div style="display: flex;">
            <div >
                <p>
                    <span style="color:red;"><?php echo $row['score']; ?></span>
                </p>
                <p>
                    <b>Name:</b> <span> <?php echo $row['name']; ?> </span>
                </p>
                <p>
                    <b>Date:</b>
                    <span>
                        <?php
                        echo date('d/m/Y H:i:s', strtotime($row['date']));
                        ?>
                    </span>
                </p>
            </div>
            <div>
                <?php

                $file = '../' . GW_IMAGE_PATH . $row['screenshot'];

                if (is_file($file) && filesize($file) > 0) {
                    echo "<img src='$file'  /> ";
                } else {
                    echo '<p>Não verificado!<p>';
                }

                ?>

            </div>
        </div>
        <br />
    <?php } ?>
</body>

</html>