<?php

include 'config.php';

if(isset($_POST['login'])){
    $uname = $_POST['uname'];
    $password = md5($_POST['password']);

    if(strlen($uname) <= 0 or strlen($password) <= 0){
        $alertMessage[] = "Campos obrigatórios não podem estar em branco!";
    }else{

        $select = $conn->prepare("SELECT * FROM users WHERE username=:username");
        $select->bindValue(':username', $uname, PDO::PARAM_STR);
        $select->execute();

        $data = $select->fetch(PDO::FETCH_ASSOC);

        if ($data == false){
            $alertMessage[] = 'Usúario não encontrado!';
        }else{
            if($password == $data['password'] and $data['user_type'] == 'Admin'){
                $_SESSION['fname'] = $data['first_name'];
                $_SESSION['lname'] = $data['last_name'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['password'] = $data['password'];
                $successMessage[] = "User found!";
                header('Location: register.php');
				exit;
            }else{
                $alertMessage[] = "Senha Incorreta ou Usúario sem permissão!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/styles.css">
    <link rel="stylesheet" href="Styles/formStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="loginContainer">
        <?php
        if(isset($alertMessage)){
            foreach($alertMessage as $alertMessage)
            echo '<div class="alertMessage" onclick="this.remove()">
            <span>'.$alertMessage.'</span>
        </div>';
        }
        ?>
        <?php
        if(isset($successMessage)){
            foreach($successMessage as $successMessage)
            echo '<div class="successMessage" onclick="this.remove()">
            <span>'.$successMessage.'</span>
        </div>';
        }
        ?>
        <img src="/assets/logo.png" width="160">
        <span class="titulo">Sistema de Cadastro de Funcionários</span>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">

            <label for="uname">Nome de Usúario:</label>
            <input type="text" id="uname" name="uname" placeholder="Usúario..." require>

            <label for="password">Senha:</label>
            <input type="password" class="password" id="password" name="password" placeholder="Senha..." require>

            <input type="submit" name="login" value="FAZER LOGIN" class="submit">
        </form>

    </div>
</body>
</html>