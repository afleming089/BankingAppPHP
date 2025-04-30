<?php
include "./components/header.php";
renderHeader();

?>
<script>
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    const userId = getCookie('id');

    console.log(userId);
    fetch('http://localhost:81/BankingApp/backend/controller/AccountController.php?id=${userId}', {
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