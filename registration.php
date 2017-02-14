<?php
try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', 'root');
    }
catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
//Vérification que le formulaire a bien été envoyé.
if(isset($_POST['envoye_donnee']))
{
    //Vérification que tous les champs sont bien remplie
    if(!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['password']) AND !empty($_POST['password2']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $email2 = htmlspecialchars($_POST['email2']);
        $password = sha1($_POST['password']);
        $password2 = sha1($_POST['password2']);
        
        // Vérification que le pseudo ne fait pas plus de 255 caractères
        $pseudolength = strlen($pseudo);
        if ($pseudolength <= 255)
        {
            //Vérification que le pseudo n'existe pas déjà en base de donnée.
            $reqpseudo = $bdd ->prepare("SELECT * FROM membres WHERE pseudo = ?");
            $reqpseudo -> execute(array($pseudo));
            $pseudoexist = $reqpseudo ->rowCount();
            if($pseudoexist == 0)
            {
                // Vérification que les 2 email correspondent bien.
                if ($email == $email2)
                {
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        // Vérification que l'email n'existe pas déjà
                        $reqmail = $bdd ->prepare("SELECT * FROM membres WHERE email = ?");
                        $reqmail->execute(array($email));
                        $mailexist=$reqmail->rowCount();
                        if ($mailexist == 0)
                        {
                            // Vérification que les deux mot de passe correspondent bien.
                            if ($password == $password2)
                            {
                                // Alors inscription du membre en base de donnée.
                               $req = $bdd->prepare('INSERT INTO membres(pseudo, email, mdp, date_inscription) VALUES(:pseudo, :email, :password, NOW())');
                               $req->execute(array(
                                    'pseudo' => $pseudo,
                                    'email' => $email,
                                    'password' => $password));
                               
                               header('Location: login_page.php');
                            }
                            else
                            {
                                $erreur = "Les deux mots de passes ne correspondent pas";
                            }
                        }
                        else
                        {
                            $erreur = "Attention cet email existe déjà";
                        }
                    }
                    else
                    {
                        $erreur = "Votre adresse email n'est pas valide";
                    }
                }
                else
                {
                    $erreur = "Les deux email ne correspondent pas";
                }
            }
            else
            {
                $erreur = "Attention ce pseudo existe déjà";
            }
        }
        else
        {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractère";
        }
    }
    else
    {
        $erreur = "tous les champs doivent être remplie";
    }
}
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Page d'inscription</title>
        </head>
        <body>
            <h1 align="center">Inscrivez vous :</h1>
            <div id="formulaire" align="center">
                <form action="registration.php" method="post">
                    <table>
                        <tr>
                            <td align="right">
                                <label for="pseudo">Pseudo :</label>
                            </td>
                            <td>
                                <input type="text" name="pseudo" placeholder="pseudo" id="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; }?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="email">Votre e-mail :</label>
                            </td>
                            <td>
                                <input type="email" name="email" placeholder="email" id="email" value="<?php if(isset($email)) { echo $email; }?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="email">Retapez votre e-mail :</label>
                            </td>
                            <td>
                                <input type="email2" name="email2" placeholder="email" id="email2" value="<?php if(isset($email2)) { echo $email2; } ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="password">Mot de passe :</label>
                            </td>
                            <td>
                                <input type="password" name="password" placeholder="passeword" id="password">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="password_1">Retaper votre mot de passe :</label>
                            </td>
                            <td>
                                <input type="password" name="password2" placeholder="password" id="password2">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="center">
                                <input type="submit" name="envoye_donnee" value="Valider">
                            </td>
                        </tr>
                    </table>
                </form>
                <br>
                <?php
                if (isset($erreur))
                {
                    echo $erreur;
                }
                ?>
            </div>
        </body>
    </html>