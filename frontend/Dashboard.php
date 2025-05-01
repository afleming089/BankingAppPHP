<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Dashboard</title>
</head>

<body>
    <?php
    include "./components/header.php";
    renderHeader();
    ?>
    <div id="accounts" class="container">

    </div>

</body>

<script type="module">
    import Cookie from "./utility/Cookie.js"

    const userId = Cookie.getCookie('id');

    fetch('http://localhost:81/BankingAppPHP/backend/controller/AccountController.php?id=' + userId, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Endpoint': 'allAccounts'
        }
    }).then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error(response);
    }).then(data => {
        const accountsContainer = document.getElementById('accounts');

        accountsContainer.innerHTML = data.map(account =>
            `<div class="card">
                <div class="card-body">
                    <a class="card-link" href="AccountDetails.php?id=${account.id}&nickname=${account.nickname}&balance=${account.balance}&type=${account.type}">View</a>
                    <h4 class="card-title"> ${account.nickname} </h5>
                    <h6 class="card-subtitle mb-2 text-muted">${account.id}</h6>
                    <p class="card-text">$${account.balance}</p>
                    <p class="card-text">${account.type}</p>
                </div>
            </div>`
        );
    }).catch(error => {
        console.error('Error:', error);
    })
</script>

</html>