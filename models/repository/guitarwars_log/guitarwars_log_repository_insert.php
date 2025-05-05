

<?php


function guitarwars_log_repository_insert(
    mysqli $dbc,
    int $id_guitarwars,
    string $date,
    string $name,
    int $score,
    ?string $screenshot,
    string $message
) {
    $query = 'INSERT INTO `tb_guitarwars_log`(`id_guitarwars`, `date`, `name`, `score`, `screenshot`, `message`) VALUES (?, ?, ?, ?, ?, ?)';

    $stmt = mysqli_prepare($dbc, $query);

    mysqli_stmt_bind_param(
        $stmt,
        'ississ',
        $id_guitarwars,
        $date,
        $name,
        $score,
        $screenshot,
        $message
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}
