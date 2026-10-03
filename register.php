<?php
$pesan = "";
$tipePesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($name) || empty($email) || empty($password)) {
        $pesan = "Semua field wajib diisi.";
        $tipePesan = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan = "Format email tidak valid.";
        $tipePesan = "error";
    } else {
        $file = "users.json";

        if (!file_exists($file)) {
            file_put_contents($file, "[]");
        }

        $data = file_get_contents($file);
        $users = json_decode($data, true);

        if (!is_array($users)) {
            $users = [];
        }

        $emailTerdaftar = false;

        foreach ($users as $user) {
            if (strtolower($user["email"]) === strtolower($email)) {
                $emailTerdaftar = true;
                break;
            }
        }

        if ($emailTerdaftar) {
            $pesan = "Email sudah terdaftar. Silakan gunakan email lain.";
            $tipePesan = "error";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $users[] = [
                "name" => $name,
                "email" => $email,
                "password" => $passwordHash
            ];

            file_put_contents(
                $file,
                json_encode($users, JSON_PRETTY_PRINT)
            );

            $pesan = "Registrasi berhasil. Silakan login.";
            $tipePesan = "success";

            $name = "";
            $email = "";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f2f2f2;display:flex;justify-content:center;align-items:center;min-height:100vh;margin:0}
        .container{background:white;width:350px;padding:30px;border-radius:10px;box-shadow:0 5px 20px rgba(0,0,0,.1)}
        h2{text-align:center;margin-bottom:25px}
        label{display:block;margin-bottom:5px}
        input{width:100%;padding:10px;margin-bottom:15px;box-sizing:border-box;border:1px solid #ccc;border-radius:5px}
        button{width:100%;padding:10px;border:none;border-radius:5px;background:#2563eb;color:white;cursor:pointer}
        button:hover{background:#1d4ed8}
        .pesan{padding:10px;margin-bottom:15px;border-radius:5px}
        .error{background:#fee2e2;color:#991b1b}
        .success{background:#dcfce7;color:#166534}
        .link{text-align:center;margin-top:15px}.link a{color:#2563eb;text-decoration:none}
    </style>
</head>
<body>
<div class="container">
    <h2>Registrasi</h2>

    <?php if ($pesan !== ""): ?>
        <div class="pesan <?= htmlspecialchars($tipePesan) ?>">
            <?= htmlspecialchars($pesan) ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name"
               value="<?= htmlspecialchars($name ?? "") ?>"
               placeholder="Masukkan nama">

        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?= htmlspecialchars($email ?? "") ?>"
               placeholder="Masukkan email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password"
               placeholder="Masukkan password">

        <button type="submit">Daftar</button>
    </form>

    <div class="link">
        Sudah punya akun?
        <a href="login.php">Login</a>
    </div>
</div>
</body>
</html>
