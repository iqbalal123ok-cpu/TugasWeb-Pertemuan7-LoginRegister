<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f2f2f2;margin:0}
        .navbar{background:#2563eb;color:white;padding:15px 30px;display:flex;justify-content:space-between;align-items:center}
        .navbar h2{margin:0}
        .logout{background:white;color:#2563eb;padding:8px 15px;border-radius:5px;text-decoration:none}
        .container{max-width:700px;margin:50px auto;padding:20px}
        .card{background:white;padding:30px;border-radius:10px;box-shadow:0 5px 20px rgba(0,0,0,.1)}
        .card h1{margin-top:0}
        .info{background:#f3f4f6;padding:15px;border-radius:5px;margin-top:20px}
    </style>
</head>
<body>
<div class="navbar">
    <h2>Dashboard</h2>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="container">
    <div class="card">
        <h1>
            Selamat Datang,
            <?= htmlspecialchars($_SESSION["user_name"]) ?>!
        </h1>

        <p>Anda berhasil login ke dalam sistem.</p>

        <div class="info">
            <strong>Informasi Akun</strong>

            <p>
                Nama:
                <?= htmlspecialchars($_SESSION["user_name"]) ?>
            </p>

            <p>
                Email:
                <?= htmlspecialchars($_SESSION["user_email"]) ?>
            </p>
        </div>
    </div>
</div>
</body>
</html>
