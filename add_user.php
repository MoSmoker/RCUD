<?php
    $title = 'Add';
    $name = '';
    $email = '';
    $mobile = '';
    $password = '';
    $button_title = "Save";
    include_once('db.php');
    if(isset($_GET["action"]) && $_GET["action"]=="edit"){
        $id = $_GET['id'];
        $edit_sql = "SELECT * FROM `users` WHERE id=$id";
        $user = mysqli_query($connection, $edit_sql);
        if($user){
            $title = 'Update';
            $current_user = $user->fetch_assoc();
            $name = $current_user['name'];
            $email = $current_user['Email'];
            $mobile = $current_user['Mobile'];
            $password = $current_user['password'];
            $button_title = "Update";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/icon.js"></script>
    <title>Users_app</title>
</head>
<body>
    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between">
                <h2><?php echo $title; ?> user</h2>
                <div><a href="test.php"><i data-feather="corner-down-left"></i></a></div>
            </div>
            <form action="test.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name" value="<?php echo $name; ?>" autocomplete="false">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="email" value="<?php echo $email; ?>" autocomplete="false">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input type="tel" class="form-control" placeholder="Enter phone number" name="mobile" value="<?php echo $mobile; ?>" autocomplete="false">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Enter password" name="password" value="<?php echo $password; ?>" autocomplete="false">
                </div>
                <?php
                    if(isset($_GET['id'])){?>
                        <input type="hidden" name='id' value="<?php echo $_GET['id'];?>">
                <?php }
                ?>
                <input type="submit" class="btn btn-primary" value="<?php echo $button_title; ?>" name="save">
            </form>
        </div>
    </div>
    <script>
        feather.replace();
    </script>
</body>
</html>