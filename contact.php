<?php 

session_start();
require_once('inc/header.php'); 
 require_once('inc/nav.php'); 


if(!isset($_SESSION['messages'])){
    $_SESSION['messages'] = [];
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if($name && $email && $message){
        
        $_SESSION['messages'][] = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'time' => date('Y-m-d H:i:s')
        ];

        $success = "Your message has been sent!";
    } else {
        $error = "All fields are required!";
    }
}
?>

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>


<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-8 mx-auto">
                <?php if(isset($success)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                <?php elseif(isset($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form action="" method="post" class="form border my-2 p-3">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="7"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Send" class="btn btn-success">
                    </div>
                </form>

                <?php if(!empty($_SESSION['messages'])): ?>
                    <h4 class="mt-4">Previous Messages:</h4>
                    <ul class="list-group">
                        <?php foreach(array_reverse($_SESSION['messages']) as $msg): ?>
                            <li class="list-group-item">
                                <strong><?= htmlspecialchars($msg['name']) ?> (<?= htmlspecialchars($msg['email']) ?>)</strong>
                                <p><?= htmlspecialchars($msg['message']) ?></p>
                                <small class="text-muted"><?= $msg['time'] ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>