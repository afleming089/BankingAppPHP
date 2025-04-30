<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <form method="POST" id="login">
        <h1>Login</h1>
        <label>Username</label>
        <input id="username" type="text" name="username" required>
        <label>Password</label>
        <input id="password" type="password" name="password" required>
        <input type="submit" value="login">
    </form>
    <a href="Signup.php">Need an account? Signup here</a>
</body>

<script type="module">
    document.getElementById('login').addEventListener('submit', onSubmit);

    import Cookie from "./utility/Cookie.js"
    Cookie.clearAllCookies();

    function onSubmit(e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        fetch('http://localhost:81/BankingAppPHP/backend/controller/UserController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Endpoint': 'login'
            },
            body: JSON.stringify({
                username: username,
                password: password
            })
        }).then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error(response);
        }).then(data => {
            console.log(data);

            if (data.id) {
                document.cookie = `id=` + data.id + `; path=/`;
                document.cookie = `username=` + data.username + `; path=/`;
                document.cookie = `totalBalance=` + data.totalBalance + `; path=/`;

                window.location.href = 'Dashboard.php';
            } else {
                alert(data.message);
            }

        }).catch(error => {
            console.error('Error:', error);
            alert('Error: ' + error.message);
        });
    }
</script>

</html>