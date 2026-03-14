<?php require "inc/header.php";

?>

 <div class="container content mt-4">
        <h2>Register</h2>

        <form action = "handlers/register_handlers.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">name:</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">email:</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password:</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">confirmpassword:</label>
                <input type="password" id="confirm_password" name="confirmpassword" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">register</button>
        </form>


    </div>




<?php require_once ('inc/footer.php');


?>