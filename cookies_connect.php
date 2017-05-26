<?php
if (!isset($_SESSION['id']) AND isset($_COOKIE['email'],$_COOKIE['password']) AND !empty($_COOKIE['email']) AND !empty($_COOKIE['password']))
{
    $reqconnect = $bdd -> prepare('SELECT * FROM member WHERE email = ? AND mdp = ?');
    $reqconnect -> execute(array($_COOKIE['email'], $_COOKIE['password']));
    $connectexist = $reqconnect->rowCount();
    if ($connectexist == 1)
    {
        $userinfo = $reqconnect -> fetch();
        $_SESSION['id']=$userinfo['id'];
        $_SESSION['pseudo']=$userinfo['pseudo'];
        $_email['email']=$userinfo['email'];
    } # code...
}
?>
