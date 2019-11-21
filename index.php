<?php
    session_start();
    $username = 'root';
    $password = '';
 
    if(!empty($_POST['email'])){
        try {

            $email_form =  addslashes($_POST['email']);
            $password_form =  addslashes($_POST['password']);       
            $conn = new PDO('mysql:host=localhost;dbname=sql_injection', $username, $password);
            $stmt = $conn->query("SELECT * FROM users WHERE email = '".$email_form."' AND password = '".$password_form."' ");
             
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $row; 
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sql injection example</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php if(isset($row) and $row == false) :?>
        <div class="title-message">
             <h1 class="colored">Credenciais incorretas!</h1>
        </div>
    <?php endif; ?>

    <?php if( isset($_SESSION['user']) and $_SESSION['user'] != null) :?>
        <div class="title-message">
             <h1 class="colorgreen">Você está logado!</h1>
        </div>
        <form  method="POST" action="logout.php">
            <button type="submit"> Sair</button>
        </form>
    <?php else: ?>   
    <h1>Login</h1>
    <form method="POST">
        <input type="text" name="email"/>
        <input type="password" name="password" />

        <button type="submit">Entrar</button>
    </form>
    <?php endif; ?>  
</body>
</html>