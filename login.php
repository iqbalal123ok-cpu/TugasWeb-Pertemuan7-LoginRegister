<?php
session_start();

$pesan = "";
$tipePesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {
        $pesan = "Email dan password wajib diisi.";
        $tipePesan = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan = "Format email tidak valid.";
        $tipePesan = "error";
    } else {
        $file = "users.json";

        if (!file_exists($file)) {
            $pesan = "Data pengguna belum tersedia.";
            $tipePesan = "error";
        } else {
            $data = file_get_contents($file);
            $users = json_decode($data, true);
            $userDitemukan = false;

            if (is_array($users)) {
                foreach ($users as $user) {
                    if (strtolower($user["email"]) === strtolower($email)) {
                        $userDitemukan = true;

                        if (password_verify($password, $user["password"])) {
                            $_SESSION["logged_in"] = true;
                            $_SESSION["user_name"] = $user["name"];
                            $_SESSION["user_email"] = $user["email"];

                            header("Location: dashboard.php");
                            exit;
                        } else {
                            $pesan = "Password salah.";
                            $tipePesan = "error";
                        }

                        break;
                    }
                }
            }

            if (!$userDitemukan && $pesan === "") {
                $pesan = "Email belum terdaftar.";
                $tipePesan = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .link{text-align:center;margin-top:15px}.link a{color:#2563eb;text-decoration:none}
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>

    <?php if ($pesan !== ""): ?>
        <div class="pesan <?= htmlspecialchars($tipePesan) ?>">
            <?= htmlspecialchars($pesan) ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?= htmlspecialchars($email ?? "") ?>"
               placeholder="Masukkan email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password"
               placeholder="Masukkan password">

        <button type="submit">Login</button>
    </form>

    <div class="link">
        Belum punya akun?
        <a href="register.php">Daftar</a>
    </div>
</div>
</body>
</html>
