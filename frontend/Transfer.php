<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Transfer</title>
</head>


<body>
    <?php
    include "./components/header.php";
    renderHeader();
    ?>

    <div class="container">
        <form id="transferForm" class="form-group">
            <label for="fromAccount">From Account:</label>
            <select id="fromAccount" class="form-control">
            </select>
            <label for="toAccount">To Account:</label>
            <select id="toAccount" class="form-control">
            </select>
            <label for="amount">Amount:</label>
            <input type="number" id="amount" class="form-control" placeholder="Enter amount">
            <button type="submit" id="transferButton" class="btn btn-primary mt-3">Transfer</button>
        </form>
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
        const fromAccount = document.getElementById('fromAccount');
        fromAccount.innerHTML = data.map(account =>
            `<option id="${account.id}" value="${account.id}">${account.nickname}</option>`
        );
        const toAccount = document.getElementById('toAccount');
        toAccount.innerHTML = data.map(account =>
            `<option id="${account.id}" value="${account.id}">${account.nickname}</option>`
        );
    })

    document.getElementById('transferForm').addEventListener('submit', transferAccountMoney);

    function transferAccountMoney(e) {
        e.preventDefault();
        const fromAccount = document.getElementById('fromAccount').value;
        const toAccount = document.getElementById('toAccount').value;

        fetch('http://localhost:81/BankingAppPHP/backend/controller/AccountController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Endpoint': 'transfer'
            },
            body: JSON.stringify({
                fromAccount: fromAccount,
                toAccount: toAccount,
                amount: document.getElementById('amount').value,
            })
        }).then(response => {
            if (response.ok) {
                return response.json();
            }
        }).then(data => {
            alert(data.message);
            window.location.href = `AccountDetails.php?id=${toAccount}`;
        })
    }
</script>

</html>