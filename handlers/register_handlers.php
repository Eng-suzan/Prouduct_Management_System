<?php
require "../core/reg.validations.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
      
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['confirmpassword']);

    $error = validate_reg($name, $email, $password, $confirmpassword);
    if(isset($error)){
        echo $error;
        exit;
    }


    $file = "../core/users.json";

    
    if(file_exists($file)){
        $users = json_decode(file_get_contents($file), true);
        if(!is_array($users)) $users = [];
    } else {
        $users = [];
    }

 foreach($users as $user){
        if($user['email'] === $email){
            $_SESSION['error'] = "Email already exists!";
            header("Location: ../register.php");
            exit;
        }
    }
    $newId = 1;
    if(!empty($users)){
        $ids = array_column($users, 'id');
        if(!empty($ids)){
            $newId = max($ids) + 1;
        }
    }

    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $new_user = [
        "id" => $newId,
        "name" => $name,
        "email" => $email,
        "password" => $passwordHash
    ];

    $users[] = $new_user;

    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

    header("Location: ../login.php");
    exit;
}
?>