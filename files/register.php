<?php
if(isset($_SESSION['uid'])){    
    $url=$config['base_url']."index.php?action=profile";
    echo "<script>window.location='".$url."'</script>";
}

$error="";

$num1=rand(1,5);
$num2=rand(1,5);
$ans=$num1+$num2;

if(isset($_POST['btnRegister'])){
 
 $username=$_POST['txtUsername'];
 $username=filter_var($username, FILTER_SANITIZE_STRING);

 //email sanitization
 $email=$_POST['txtEmail'];
 $email=filter_var($email, FILTER_SANITIZE_EMAIL);

 //email validation
 if ($_POST['txtEmail']!=$email) {
    $error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! Your email address contained invalid characters </div>";              
}else{

    //password hash
    $password=$_POST['txtPassword'];
    $password=md5($password);

    $confPassword=$_POST['txtConfPassword'];
    $confPassword=md5($confPassword);

    //default role assigned to customers
    $role=0;

    //for captcha
    $captcha=$_POST['numCaptcha'];
    $captchaCheck=$_POST['num1']+$_POST['num2'];

    //check availability of username
    $chkUsername=new User();
    $resUsername=$chkUsername->availableUsername($username,0);
    if ($resUsername==0) {

        //check availability of email
        $chkEmail=new User();
        $resEmail=$chkEmail->availableEmail($email,0);

        if ($resEmail==0) {

            //check password mismatch
            if($password==$confPassword){

                //check captcha
                if($captcha == $captchaCheck){

                    //register
                    $user=new User();
                    $result=$user->register($username, $email, $password, $role);
                    if($result===true){
                        //success
                        $error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! Your account was created. </div>";
                    }else{
                        //error messages
                        $error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! some thing went wrong. </div>";
                    }
                }else{
                    $error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! You entered the wrong captcha.</div>";     
                }
            }else{
                $error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! There was a password mismatch.</div>"; 
            }
        }else{    
            $error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! That email is already taken.</div>"; 
        }
    }else{
        $error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! That username is already taken.</div>"; 
    }
}
}
?>
<div class="row black title-container">
    Register
    <p class="title-note">Create an account!</p>
</div>
<div class="row content white content-side">
    <div  class="row">
        <?php echo $error;?>
        <form class="col s12" method="POST" action="">
            <div class="input-field">
                <input name="txtUsername" type="text" class="validate">
                <label for="username">Username</label>
            </div>
            <div class="input-field">
                <input name="txtEmail" type="email" class="validate">
                <label for="email">Email</label>
            </div>
            <div class="input-field">

                <input name="txtPassword" type="password" class="validate">
                <label for="password">Password</label>
            </div>
            <div class="input-field">
                <input name="txtConfPassword" type="password" class="validate">
                <label for="password">Confirm Password</label>
            </div>
            <p class="captcha">
                <?php
                echo $num1." + ".$num2." = ?";
                ?>
            </p>
            <div class="input-field row">
                <input id="numCaptcha" name="numCaptcha" type="number" class="validate" required>
                <input name="num1" value="<?php echo $num1;?>" type="number" hidden required>
                <input name="num2" value="<?php echo $num2;?>" type="number" hidden required>
                <label for="number">Solve the equation. Prove you are not a robot.</label>
            </div>
            <div class="input-field">
                <button name="btnRegister" class="btn btn-black waves-effect waves-light right rose" type="submit">Sign me up!</button>
            </div>
        </form>
    </div>
</div>
