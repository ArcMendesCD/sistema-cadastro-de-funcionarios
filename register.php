<?php
include 'config.php';

if(isset($_POST['register'])){
    $uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cpassword = md5($_POST['cpassword']);
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $employeeid = $_POST['employeeid'];

$select = $conn->prepare("SELECT * FROM users WHERE (username=:username OR email=:email)");

    
    $select->bindValue(':username', $uname, PDO::PARAM_STR);
    $select->bindValue(':email', $email, PDO::PARAM_STR);

    $select->execute();
    if(strlen($uname) <= 0 or strlen($fname) <= 0 or strlen($lname) <= 0 or strlen($email) <= 0 ){
        $alertMessage[] = "Campos obrigatórios não podem estar em branco!";
    }else{
        if($select->rowCount()>0){
            $alertMessage[] = "Nome de usúario ou E-mail já existentes!";
        }else{
            if($password != $cpassword){
                $alertMessage[] = 'Senha de confirmação não bate!';
            }else{
                $insert = $conn->prepare('INSERT INTO users (username,first_name,last_name,password,email,phone,employee_id) VALUES(:username,:first_name,:last_name,:password,:email,:phone,:employee_id)');
    
                $insert->bindValue(':username', $uname, PDO::PARAM_STR);
                $insert->bindValue(':first_name', $fname, PDO::PARAM_STR);
                $insert->bindValue(':last_name', $lname, PDO::PARAM_STR);
                $insert->bindValue(':password', $password, PDO::PARAM_STR);
                $insert->bindValue(':email', $email, PDO::PARAM_STR);
                $insert->bindValue(':phone', $phone, PDO::PARAM_STR);
                $insert->bindValue(':employee_id', $employeeid, PDO::PARAM_STR);
            
                $result = $insert->execute();
    
                $successMessage[] = 'Usúario registrado com sucesso!';
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
    <title>Register</title>
</head>
<body>
    <div class="registerContainer">
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

            <label for="fname">Primeiro Nome:</label>
            <input type="text" id="fname" name="fname" placeholder="Primeiro Nome..." require>

            <label for="lname">Ultimo Nome:</label>
            <input type="text" id="lname" name="lname" placeholder="Ultimo Nome..." require>
            
            <label for="employeeid">ID do Funcionário:</label>
            <input type="text" id="employeeid" name="employeeid" placeholder="ID..." require>

            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" placeholder="E-mail..." require>

            <label for="phone">Celular:</label>
            <input type="text" pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" id="phone" name="phone" placeholder="XX XXXXX-XXXX...">
        
            <label for="password">Senha:</label>
            <input type="password" class="password" id="password" name="password" placeholder="Senha..." require>

            <label for="cpassword">Confirmar Senha:</label>
            <input type="password" class="cpassword" id="cpassword" name="cpassword" placeholder="Confirmar Senha..." require>

            <input type="submit" name="register" value="REGISTRAR COLABORADOR" class="submit">
        </form>

    </div>
</body>
</html>