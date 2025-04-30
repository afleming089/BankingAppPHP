<?php
include "./components/header.php";
renderHeader();

?>
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
        console.log(data);
    }).catch(error => {
        console.error('Error:', error);
    })
</script>