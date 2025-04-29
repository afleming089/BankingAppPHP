<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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

<script>
    document.getElementById('login').addEventListener('submit', onSubmit);
    document.cookie = "id='';";
    document.cookie = "username='';";
    document.cookie = "auth=false;";

    function onSubmit(e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        fetch('http://localhost:81/BankingApp/backend/controller/UserController.php', {
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
            if (!data.auth) {
                alert('Invalid username or password');
                console.log(data);
                return;
            }

            document.cookie = "id=data.id;";
            document.cookie = "username=data.username;";
            document.cookie = "auth=data.auth;";
            window.location.href = 'Dashboard.php';
        }).catch(error => {
            console.error('Error:', error);
            alert('Error: ' + error.message);
        });
    }
</script>

</html>