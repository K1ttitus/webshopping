<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างบัญชี</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
<div class="register-container">
        <h1>Create new Account</h1>
        <p>Already Registered? <a href="login.php">Login</a></p>
        <form action="registerprocess.php" method="POST">
            <input name="username_account" type="text" placeholder="Name" required>
            <input name="email_account" type="email" placeholder="hello@reallygreatsite.com" required>
            <input name="password_account1" type="password" placeholder="Password" required>
            <input name="password_account2" type="password" placeholder="Confirm Password" required>
            <button type="submit">Sign up</button>
        <a href="login.php">Already have an account</a>
    </form>
</body>
</html>