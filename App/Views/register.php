<form method="POST" action="?route=register">
    <input name="name" placeholder="Name" required>
    <input name="email" placeholder="Email" required>
    <input name="password" placeholder="Password" type="password" required>
    <input name="confirm_password" placeholder="Confirm Password" type="password" required>
    <button type="submit">Register</button>
</form>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
