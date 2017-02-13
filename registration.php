<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Page d'inscription</title>
        </head>
        <body>
            <h1 align="center">Inscrivez vous :</h1>
            <div id="formulaire" align="center">
                <form action="inscription.php" method="post">
                    <table>
                        <tr>
                            <td align="right">
                                <label for="pseudo">Pseudo :</label>
                            </td>
                            <td>
                                <input type="text" name="pseudo" placeholder="pseudo" id="pseudo">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="email">Votre e-mail :</label>
                            </td>
                            <td>
                                <input type="email" name="email" placeholder="email" id="email">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="email">Retapez votre e-mail :</label>
                            </td>
                            <td>
                                <input type="email2" name="email2" placeholder="email" id="email2">
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
            </div>
        </body>
    </html>