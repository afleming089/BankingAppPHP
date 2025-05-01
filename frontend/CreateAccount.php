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
    <form method="POST" id="createAccount">
        <h1>Create Account</h1>
        <label>Nickname</label>
        <input id="nickname" type="text" name="nickname" required>
        <label>Initial Balance</label>
        <input id="balance" type="number" name="balance" required>
        <label>Account Type</label>
        <select id="accountType" name="accountType">
            <option value="Checking">Checking</option>
            <option value="Savings">Savings</option>
            <option value="Loan">Loan</option>
        </select>
        <input type="submit" value="Create Account">
    </form>
</body>

<script type="module">
    import Cookie from "./utility/Cookie.js"

    const userId = Cookie.getCookie('id');
    document.getElementById('createAccount').addEventListener('submit', createAccount);

    function createAccount(e) {
        e.preventDefault();

        fetch('http://localhost:81/BankingAppPHP/backend/controller/AccountController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Endpoint': 'createAccount'
            },
            body: JSON.stringify({
                id: userId,
                nickname: document.getElementById('nickname').value,
                balance: document.getElementById('balance').value,
                accountType: document.getElementById('accountType').value
            })
        }).then(response => {
            if (response.ok) {
                return response;
            }
        }).then(data => {
            console.log(data);
            alert(data);
        })
    }
</script>

</html>