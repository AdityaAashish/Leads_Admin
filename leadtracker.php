<?php
session_start();

// Check if the client is logged in
if (!isset($_SESSION['client_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
require 'db.php';

// Fetch leads from the database
$stmt = $pdo->query('SELECT name, mobile_number, age, city, created_at FROM leads ORDER BY created_at DESC');
$leads = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .change-password {
            text-align: right;
        }
        .change-password a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Leads Tracker</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Age</th>
                    <th>City</th>
                    <th>Date and Time (IST)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads as $lead) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($lead['name']); ?></td>
                        <td><?php echo htmlspecialchars($lead['mobile_number']); ?></td>
                        <td><?php echo htmlspecialchars($lead['age']); ?></td>
                        <td><?php echo htmlspecialchars($lead['city']); ?></td>
                        <td><?php echo date('d-m-Y H:i:s', strtotime($lead['created_at'] . ' UTC+5:30')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="change-password">
            <a href="change_password.php">Change Password</a>
        </div>
    </div>
</body>
</html>
