<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form method="POST" id="signup">
        <h1>Signup</h1>
        <label>Username</label>
        <input id="username" type="text" name="username" required>
        <label>Password</label>
        <input id="password" type="password" name="password" required>
        <input type="submit" value="signup">
    </form>
</body>

<script>
    document.getElementById('signup').addEventListener('submit', onSubmit);


    function onSubmit(e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        fetch('http://localhost:81/BankingApp/backend/controller/UserController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
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
            console.log('Success:', data);
        })
    }
</script>

</html>