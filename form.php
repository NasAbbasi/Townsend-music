<?php
session_start();
if(empty($_SESSION['token'])){
    $_SESSION['token'] = bin2hex(random_bytes(32));
    $_SESSION['token_expire'] = time() + 3600;
}

$formData = !empty($_SESSION['data']) ? $_SESSION['data'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/validation.js"></script>

    <div class="content">
        <div class="card" id="formCard">
            <div class="card-header">Contact Form</div>
            <div class="card-body">
                <form method="post" action="action.php">
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= isset($formData['name']) ? $formData['name'] : '' ?>">
                        <div class="alert alert-danger d-none" id="nameErr"></div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= isset($formData['phone']) ? $formData['phone'] : '' ?>">
                        <div class="alert alert-danger d-none" id="phoneErr"></div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="john@company.com" value="<?= isset($formData['email']) ? $formData['email'] : '' ?>">
                        <div class="alert alert-danger d-none" id="emailErr"></div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" rows="3" name="message"><?= isset($formData['message']) ? $formData['message'] : '' ?></textarea>
                        <div class="alert alert-danger d-none" id="messageErr"></div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter" value="1" <?= isset($formData['newsletter']) && $formData['newsletter'] == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label" for="newsletter">Newsletter</label>
                    </div>
                    <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                </form>

                <?php if(isset($_SESSION['errors'])){ ?>
                    <div class="alert alert-danger"><?= $_SESSION['errors'] ?></div>
                <?php } ?>

                <?php if(isset($_SESSION['final_status'])){ ?>
                    <div class="alert alert-success"><?= $_SESSION['final_status'] ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
