<?php

require(__DIR__ . '../../controllers/guitarwars_controller_admin.php');

$view_model_result = guitarwars_controller_admin();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars - Admin</title>
</head>

<body>
    <h1>Guitar Wars - High Scores Administration</h1>
    <p>Below a list of all Guitar Wars High scores. Use this page to remove scores as needed.</p>
    <hr>
    <table>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Score</th>
            <th>Screenshot</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($view_model_result['select_result'])) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['score']; ?></td>
                <td><?php echo $row['screenshot'] ?? '-'; ?></td>
                <td>
                    <?php
                    $query_string  =
                        'id=' . $row['id'] . '&amp;' .
                        'name=' . $row['name'] . '&amp;' .
                        'date=' . $row['date'] . '&amp;' .
                        'score=' . $row['score'] . '&amp;' .
                        'screenshot=' . $row['screenshot'];
                    ?>
                    <a href="guitarwars_view_remove_score.php?<?php echo $query_string; ?>">
                        Remove
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>