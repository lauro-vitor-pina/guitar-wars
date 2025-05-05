<?php
require_once(__DIR__ . '../../appvars.php');

require_once(__DIR__. '../../controllers/guitarwars/guitarwars_controller_list_score.php');

$result_view_model = guitarwars_controller_list_score();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars - High Scores</title>
    <style>
        img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .topscoreheader {
            text-align: center;
            font-size: 200%;
            background-color: #36407F;
            color: #FFFFFF;
        }
    </style>
</head>

<body>
    <h2>Guitar Wars - High Scores</h2>
    <p>
        Welcome, Guitar Waiors, do you have what it takes to crack the high score list ? if so,
        <a href="guitarwars_view_add_score.php">just add your score</a>.
    </p>
    <hr>
    <?php

    $i = 0;

    while ($row = mysqli_fetch_array($result_view_model['select_result'])) {

        if ($i == 0) {
            echo '<div class="topscoreheader"> Top Score : ' . $row['score'] . '</div> ';
            echo '<br/>';
        }

    ?>
        <div style="display: flex;">
            <div>
                <p>
                    <span style="color:red;"><?php echo $row['score']; ?></span>
                </p>
                <p>
                    <b>Name:</b> <span> <?php echo $row['name']; ?> </span>
                </p>
                <p>
                    <b>Date:</b>
                    <span>
                        <?php echo date('d/m/Y H:i:s', strtotime($row['date'])); ?>
                    </span>
                </p>
            </div>
            <div>
                <?php

                $screenshot =  $row['screenshot'];

                $file = '../../' . GW_IMAGE_PATH . $screenshot;

                if (is_file($file) && filesize($file) > 0) {
                    $url = URL_IMAGE_PROXY . $screenshot;
                    echo "<img src='$url'/>";
                } else {
                    echo '<p>Não verificado!<p>';
                }

                ?>

            </div>
        </div>
        <br />
    <?php
        $i++;
    }
    ?>
</body>

</html>