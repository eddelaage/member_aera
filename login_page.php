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
//Vérification que le formulaire a bien été envoyé.
if(isset($_POST['envoye_donnee_connect']))
{
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $passwordconnect = sha1($_POST['passwordconnect']);
    if(!empty($_POST['emailconnect']) AND (!empty($_POST['passwordconnect'])))
    {
        $reqconnect = $bdd -> prepare('SELECT * FROM member WHERE email = ? AND mdp = ?');
        $reqconnect -> execute(array($emailconnect, $passwordconnect));
        $connectexist = $reqconnect->rowCount();
        if ($connectexist == 1)
        {
            if (isset($_POST["rememberme"]))
            {
                setcookie("email", $emailconnect, time()+365*24*3600, null, null, false, true);
                setcookie("password", $passwordconnect, time()+365*24*3600, null, null, false, true); # code...
            }
            $userinfo = $reqconnect -> fetch();
            $_SESSION['id']=$userinfo['id'];
            $_SESSION['pseudo']=$userinfo['pseudo'];
            $_email['email']=$userinfo['email'];
            header("Location: profil.php?id=".$_SESSION['id']);
        }
        else
        {
            $erreur = "Mauvais pseudo ou mot de passe";
        }
    }
    else
    {
        $erreur = "Tous les chmamps doivent être remplies";
    }
}
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Page de connexion</title>
        </head>
        <body>
            <h1 align="center">Connectez-vous :</h1>
            <div id="formulaire" align="center">
                <form action="login_page.php" method="post">
                    <table>
                        <tr>
                            <td align="right">
                                <label for="pseudo">email :</label>
                            </td>
                            <td>
                                <input type="email" name="emailconnect" placeholder="email" id="email">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="password">Mot de passe :</label>
                            </td>
                            <td>
                                <input type="password" name="passwordconnect" placeholder="passeword" id="password">
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <label>Se souvenir de moi</label>
                                <input type="checkbox" name="rememberme">
                            </td>
                            <td align="center">
                                <input type="submit" name="envoye_donnee_connect" value="Valider">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                if(isset($erreur))
                {
                    echo $erreur;
                }
                ?>
            </div>
        </body>
    </html>
