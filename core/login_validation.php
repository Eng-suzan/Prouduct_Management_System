    <?php

    session_start();

    if($_SERVER['REQUEST_METHOD'] === "POST"){

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($password)){
    echo "Email and password required";
    exit();
    }
  
        $file = "users.json";
    if(!file_exists($file)){
    echo "No users found";
    exit();
    }
        $users = json_decode(file_get_contents($file), true);
    if(!$users){
    $users = [];
    }

    foreach($users as $user){

    if($user['email'] === $email &&password_verify($password, $user['password'])){
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user'] = $user['name'];

    header("Location: ../index.php");
    exit();

    }

    }

    echo "Invalid email or password";

    }