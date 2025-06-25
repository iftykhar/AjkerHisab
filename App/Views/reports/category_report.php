<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-700">Expenses by Category</h1>

        <div class="mb-6">
            <canvas id="categoryChart" height="150"></canvas>
        </div>

        <a href="index.php?route=dashboard" class="text-blue-500 hover:underline">&larr; Back to Dashboard</a>
    </div>
    <!-- <form method="GET" action="index.php" class="mb-6"></form> -->
     <canvas id="categoryChart" class="my-8"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(ctx, {
            type: 'pie', // Change to 'bar' for bar chart
            data: {
                labels: <?= json_encode(array_keys($categoryData)) ?>,
                datasets: [{
                    label: 'Expense by Category',
                    data: <?= json_encode(array_values($categoryData)) ?>,
                    backgroundColor: [
                        '#f87171', '#60a5fa', '#34d399', '#fbbf24', '#a78bfa', '#f472b6',
                        '#c084fc', '#fdba74', '#6ee7b7', '#facc15'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Category-wise Expense Distribution'
                    }
                }
            }
        });
    </script>

    <script>
        const data = {
            labels: <?= json_encode(array_keys($categoryTotals)) ?>,
            datasets: [{
                label: 'Total Spent (৳)',
                data: <?= json_encode(array_values($categoryTotals)) ?>,
                backgroundColor: [
                    '#60A5FA', '#34D399', '#FBBF24', '#F87171', '#A78BFA', '#F472B6'
                ],
                borderWidth: 1
            }]
        };

        new Chart(document.getElementById('categoryChart'), {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Expense Totals by Category'
                    }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>
