<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Transaction</title>
</head>


<body>
    <?php
    include "./components/header.php";
    renderHeader();
    ?>
    <div class="container">
        <form id="transactionForm" class="form-group">
            <label for="deposit">Deposit</label>
            <input class="form-control" checked type="radio" id="deposit" name="transactionType" value="deposit">
            <label for="withdraw">Withdraw</label>
            <input class="form-control" type="radio" id="withdraw" name="transactionType" value="withdraw">

            <label for="amount">Amount:</label>
            <input class="form-control" type="number" id="amount" name="amount" min="0" step="0.01">

            <label for="accountSelect">Account:</label>
            <select class="form-control" id="accountSelect" name="accountSelect">
            </select>

            <button class="btn btn-primary mt-3">Submit</button>
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
        const accountSelect = document.getElementById('accountSelect');
        accountSelect.innerHTML = data.map(account =>
            `<option id="${account.id}" value="${account.id}">${account.nickname}</option>`
        );
    }).catch(error => {
        console.error('Error:', error);
    })

    document.getElementById('transactionForm').addEventListener('submit', createAccount);

    function createAccount(e) {
        e.preventDefault();
        const accountId = document.getElementById('accountSelect').value;

        fetch('http://localhost:81/BankingAppPHP/backend/controller/AccountController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Endpoint': 'transaction'
            },
            body: JSON.stringify({
                accountId: accountId,
                amount: document.getElementById('amount').value,
                transactionType: document.querySelector('input[name="transactionType"]:checked')?.value
            })
        }).then(response => {
            if (response.ok) {
                return response.json();
            }
        }).then(data => {
            window.location.href = `AccountDetails.php?id=${accountId}`;
        })
    }
</script>

</html>