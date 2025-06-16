<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense create</title>
</head>
<body>
    <h2>Add New Expense</h2>
    <form method="post" action="index.php?route=expense-store">
        <input type="text" name="title" placeholder="Title"><br>
        <input type="number" name="amount" placeholder="Amount"><br>
        <input type="date" name="date"><br>
        <button type="submit">Save</button>
    </form>
    <a href="index.php?route=dashboard">Back</a>

</body>
</html>