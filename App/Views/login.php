<form method="POST" action="?route=login">
    <input name="email" placeholder="Email" required>
    <input name="password" placeholder="Password" type="password" required>
    <button type="submit">Login</button>
</form>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
