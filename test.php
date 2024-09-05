<?php 
include_once('db.php');
$action = false;
echo "PHP script started.";
if(isset($_GET["action"]) && $_GET["action"]=="del"){
    $id = $_GET['id'];
    $del_sql = "DELETE FROM `users` WHERE id=$id";
    $res_del = mysqli_query($connection, $del_sql);
    if(!$res_del){
        die(mysqli_error($connection));
    }
    else{
        $action = "del";
    }
}
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    if($_POST['save'] == 'Save'){
        $save_user = "INSERT INTO `users`(`name`, `Email`, `password`,`Mobile`) VALUES ('$name','$email','$password','$mobile')";
    }else{
        $id = $_POST['id'];
        $save_user = "UPDATE `users` SET `name` = '$name', `Email` = '$email', `Mobile` = '$mobile', `password` = '$password' WHERE id=$id";
    }
    $conn_res = mysqli_query($connection, $save_user);
    if(!$conn_res){
        die(mysqli_error($connection));
    }
    else{
        if($_POST['id']){
            $action = "edit";
        }
        else{
            $action = "added";
        }
    }
}
$users_sql = "SELECT * FROM `users`";
$all_users = mysqli_query($connection, $users_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/toastr.css">
    <script src="js/main.js"></script>
    <title>Users_app</title>
</head>
<body>
    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between mb-2">
                <h2>Users</h2>
                <div><a href="add_user.php"><i data-feather="user-plus"></i></a></div>
            </div>
            <hr>
            <table class = "table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile number</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($user=$all_users->fetch_assoc())
                            {?>
                                <tr>
                                    <td>
                                        <?php echo $user['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $user['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $user['Email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $user['Mobile']; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-evenly">
                                            <button style="border: none; background: none; padding: 0; margin: 0;" onclick="confirm_delete(<?php echo $user['id']; ?>)">
                                                <i class="text-danger" data-feather="trash-2"></i>
                                            </button>
                                            <button style="border: none; background: none; padding: 0; margin: 0;" onclick="confirm_edit(<?php echo $user['id']; ?>)">
                                            <i class="text-primary" data-feather="edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/toastr.js"></script>
    <script src="js/icon.js"></script>
    <?php
        if($action != false){
            if($action === "added"){?>
                <script>
                    show_add();
                </script>
            <?php
                }elseif($action === "del"){?>
                    <script>
                        show_del();
                    </script>
            <?php
                }elseif($action === "edit"){?>
                    <script>
                       show_edit();
                    </script>
            <?php
            }
        }
        
    ?>
    <script>
        feather.replace();
        function confirm_delete(id){
            let del = confirm("Delete user?");
            console.log(del);
            if(del == true){
                window.location.href="test.php?action=del&id=" + id;
            }
        }
        function confirm_edit(id){
                window.location.href="add_user.php?action=edit&id=" + id;
        }
    </script>
</body>
</html>