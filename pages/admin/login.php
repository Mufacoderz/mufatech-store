<?php
    session_start();
    include '../../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
    form {
        width: 320px;
        margin: 40px auto;
        padding: 22px;
        background: #1e1e1e;
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(0,0,0,0.4);
        font-family: Arial, sans-serif;
        color: #e4e4e4;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 6px;
        color: #cfcfcf;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #3a3a3a;
        background: #2b2b2b;
        color: #fff;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 14px;
        transition: border 0.2s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        border-color: #a260ff;
        outline: none;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #a260ff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 15px;
        font-weight: bold;
        transition: 0.2s ease;
    }

    button:hover {
        background: #8738ff;
    }
</style>



</head>
<body>

    <?php
    if(isset($_POST['login'])){
        $input = $_POST['username'];
        $password = $_POST['password'];

        //cek input ke database apakah udh sesuai atau blum dgn data yg ada
        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            $query = "SELECT * from users WHERE email = '$input'";
        } else{
            $query = "SELECT * from users WHERE username = '$input'";
        }

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                $_SESSION['username'] = $row['username'];

                header("Location: dashboard.php");
                exit();

            }
            else{
                echo "<p style='color:red'>Password Salah</p>";
            }
        }
        else{
            echo "<p style='color:red'>Email atau username tidak sesuai</p>";
        }
    }
    ?>

    <form method="post" action="">
        <label >Username atau email</label><br>
        <input type="text" name="username" placeholder="Masukkan username atau email" require><br>

        <label>Password</label><br>
        <input type="password" name="password" placeholder="Masukkan password" require><br>

        <button type="submit" name="login">Login</button>
    </form>

</body>
</html>