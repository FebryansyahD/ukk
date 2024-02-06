<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>

<body>
    <?php
    if (isset($_GET['login_failed'])) {
        if ($_GET['login_failed'] == "true") { ?>
            <div class="alert alert-success" role="alert">
                Masukkan username dan password yang sesuai
            </div>
        <?php } ?>
        <?php
    }
    ?>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="process.php" method="post">
                    <h2>KasirKita</h2>
                    <div class="inputbox">
                        <input type="text" id="username" name="username" required>
                        <label for="username">Username</label>
                    </div>

                    <div class="inputbox">
                        <input type="password" id="pw" name="password" required>
                        <label for="pw">Password</label>
                    </div>

                    <button type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>