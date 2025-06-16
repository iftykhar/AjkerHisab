<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense List</title>
</head>
<body>
    <h2>Your Expenses</h2>
    <ul>
    <?php foreach ($expenses as $exp): ?>
        <li><?= htmlspecialchars($exp['date']) ?> - <?= htmlspecialchars($exp['title']) ?> - ৳<?= htmlspecialchars($exp['amount']) ?></li>
    <?php endforeach; ?>
    </ul>
    <a href="index.php?route=dashboard">Back</a>

</body>
</html>