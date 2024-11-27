<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <p>Sign in to continue</p>
        <form action="loginprocess.php" method="POST">
            <input name="email_account" type="email" placeholder="hello@reallygreatsite.com" required>
            <input name="password_account" type="password" placeholder="••••••" required>
            <button type="submit">Sign up</button>
        <a href="register.php">Don't have an account?</a>
        <a href=""></a>
    </form>
</div>
</body>
</html>