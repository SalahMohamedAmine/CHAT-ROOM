<?php
session_start();


if(isset($_SESSION['name']))
{
    header("Location: room.php");
    exit();
}
include 'init.php';
include  $tpl."header.php";
$err=array();
if($_SERVER['REQUEST_METHOD']=='POST')
{


    if(isset($_POST['login']))
    {
        $name=$_POST['user'];
        $pass=$_POST['password'];
        $checkk = checkUser($name);
        //$insert=insertUser($name,$pass);
        if ($checkk == 1) {
            $_SESSION['name'] = $name;
            header("Location: room.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>This User Is dosen t exist</div>";
        }
    }else
    {
        //get data
        $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $email=filter_var($_POST['Email'],FILTER_SANITIZE_EMAIL);
        $pass=$_POST['password'];
        $passH=sha1($pass);

        //insert data
        $stmt=$con->prepare("INSERT into users (name,Email,password) VALUES(?,?,?)");
        $stmt->execute(array($name,$email,$passH));
        $nb= $stmt->rowCount();
        echo $nb;
        if($nb==1)
        {

        }else
        {
            $err[]="efze";
        }
    }
}
include  $tpl."header.php";

?>

<div class="container formulaire">
    <h2 class="text-center">
        <div>
            <span class="active" data-class="login">Login</span> | <span data-class="signup">Sign up</span>
        </div>
    </h2>
    <form class="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div class="form-group">
            <input type="text" name="user" class="form-control" placeholder="Name" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password">
        </div>
        <input type="submit" value="Login" class="btn btn-primary btn-block" name=login>
    </form>

    <form class="signup selected" method="POST" action="<?php echo  $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Name" autocomplete="off">
        </div>

        <div class="form-group">
            <input type="email" name="Email" class="form-control" placeholder="Email" autocomplete="off">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password">
        </div>
        <input type="submit" value="Signup" class="btn btn-primary btn-block" name="signup">
    </form>
</div>

<div class="container">
    <?php foreach ($err as $errors) {
        echo "<div class='alert alert-danger text-center'>".$errors." </div>";
    } ?>
</div>

<?php
include $tpl.'footer.php';

?>
