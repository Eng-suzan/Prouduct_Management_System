
<?php require "inc/header.php";
session_start();
if(isset($_SESSION['success'])){
    echo "<p style='color:green;'>".$_SESSION['success']."</p>";
    unset($_SESSION['success']); 
}




?>
<div class="container content mt-4">
        <h2>login</h2>

        <form action = "core/login_validation.php" method="POST">
           

            <div class="mb-3">
                <label for="email" class="form-label">email:</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password:</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

           

            <button type="submit" class="btn btn-primary">login</button>
        </form>


    </div>

<?php require_once ('inc/footer.php');


?>

