<?php
$accountId = $_GET['id'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Account Details</title>
</head>


<body>
    <?php
    include "./components/header.php";
    renderHeader();
    ?>

    <div class="card">
        <div id="accountContainer" class="card-body">
            <button class="btn btn-primary" onclick="window.location.href='Dashboard.php'">Back</button>
        </div>
    </div>

</body>

<script type="module">
    import Cookie from "./utility/Cookie.js"

    const userId = Cookie.getCookie('id');
    const accountId = <?php echo $accountId; ?>;

    fetch(`http://localhost:81/BankingAppPHP/backend/controller/AccountController.php?id=${userId}&accountId=${accountId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Endpoint': 'account'
        }
    }).then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error(response);
    }).then(data => {
        const accountsContainer = document.getElementById('accountContainer');

        accountsContainer.innerHTML = `
            <h4 class="card-title">${data.nickname}</h4>
            <h6 class="card-subtitle mb-2 text-muted">${data.id}</h6>
            <p class="card-text">$${data.balance}</p>
            <p class="card-text">${data.type}</p>
            <hr class="card-subtitle mb-2 text-muted" />`;
        // <h6>Transactions</h6>
        // <ul id="transactions" class="list-group">
        //     <li class="list-group-item"></li>
        //     <li class="list-group-item"></li>
        // </ul>
    })
</script>

</html>