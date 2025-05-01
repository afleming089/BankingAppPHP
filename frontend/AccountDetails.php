<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Account</title>
</head>


<body>
    <?php
    include "./components/header.php";
    renderHeader();
    $id = $_GET['id'];
    $nickname = $_GET['nickname'];
    $balance = $_GET['balance'];
    $type = $_GET['type'];
    ?>

    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary" onclick="window.location.href='Dashboard.php'">Back</button>
            <h4 class="card-title"> <?php echo $nickname ?> </h4>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $id ?></h6>
            <p class="card-text">$<?php echo $balance ?></p>
            <p class="card-text"><?php echo $type ?></p>
            <hr class="card-subtitle mb-2 text-muted" />
            <h6>Transactions</h6>
            <ul id="transactions" class="list-group">
                <li class="list-group-item"></li>
                <li class="list-group-item"></li>
            </ul>
        </div>

    </div>

</body>

</html>