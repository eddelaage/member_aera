<?php
session_start();

try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=member_aera;charset=utf8', 'root', 'root');
    }
catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }


include_once('cookies_connect.php');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid=intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM member WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();


?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Mon profil</title>
        </head>
        <body>
            <h1 align="center">Profil de : <?php echo $userinfo['pseudo'] ?> </h1>
            <div id="formulaire" align="center">
                Votre pseudo : <?php echo $userinfo['pseudo'] ?>
                <br>
                Votre email : <?php echo $userinfo['email'] ?></br>
                <?php
                    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
                    {
                ?>
                    <a href="#">Editer mon profil / </a>
                    <a href="sign_out.php">Se deconnecter</a>
                <?php
                    }
                ?>
            </div>
        </body>
    </html>
<?php
}
?>
