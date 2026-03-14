    <?php


    function validate_reg($name,$email,$password,$confirmpassword){

    if(empty($name) || empty($email) || empty($password) || empty($confirmpassword)){
    return "All fields are required";
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    return "Invalid email";
    }

    if(!strlen($password)>=6&&strlen($password)>=20){
    return "Password must be at least 6 characters";
    }

    if($password !== $confirmpassword){
    return "Passwords do not match";
    }
    }

   
    ?>


