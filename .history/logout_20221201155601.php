<?php
session_start();

if(isset($_COOKIE['username'])){

    // destroy session data
    destroy_session_and_data();
    

    // unset all cookie
    if(isset($_COOKIE['login']) or isset($_COOKIE['username'])){
        setcookie('login','',time()-10);
        setcookie('username','',time()-10);
        setcookie('userid','',time()-10);
        setcookie('is_admin','',time()-10);
        setcookie('rememberme','',time()-10);
    }

    header("location:login.php");

}else{
    // back to login page
    header("location:index.php");
}



function destroy_session_and_data(){
    
    unset($_SESSION['username']);
    unset($_SESSION['products']);
    unset($_SESSION['login']);
    $_SESSION = array();
    session_unset();
    // setcookie(session_name(),'',time() - 2592000,'/');
    session_destroy();
    
}


?>