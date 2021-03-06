<?php
/**
 * Created by PhpStorm.
 * User: pauleherman
 * Date: 13/02/2018
 * Time: 10:43
 */
?>

<?php

require_once ('db-init.php');

if (isset($_POST['formok']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    //Condition pour vérifier que les champs ne sont pas vides
    if (!empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['mail2']) && !empty($_POST['mdp']) && !empty($_POST['mdp2']))
    {
        //Condition pour vérifier que le pseudo ne dépasse pas 255 caractères
        $pseudolen = strlen($pseudo);
        if ($pseudolen <= 255)
        {
            //Condition pour vérifier que les 2 adresses mails sont bien les mêmes
            if ($mail == $mail2)
            {
                //Condition avec FILTER_VALIDATE_EMAIL pour vérifier que c'est bien une addresse mail
                if (filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    //Condition pour vérifier que les 2 mots de passe sont bien les mêmes
                    if ($mdp !== $mdp2)
                    {
                        $emptiness = "Vos mots de passe ne correspondent pas";
                    }
                }
                else
                {
                    $emptiness = "Votre adresse mail n'est pas valide";
                }
            }
            else
            {
                $emptiness = "Vos addresses mail ne correspondent pas";
            }
        }
        else
        {
            $emptiness = "Votre pseudo ne doit pas dépasser 255 caractères !!";
        }
    }
    else
    {
        $emptiness = "Remplissez tous les champs !! ";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <form method="post" action="">
            <table>
                <tr>
                    <td>
                        <label for="pseudo">Pseudo :</label>
                    </td>
                    <td>
                        <input id="pseudo" type="text" placeholder="Pseudo" name="pseudo" value="<?php if (isset($pseudo)) {echo $pseudo}?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mail">Mail :</label>
                    </td>
                    <td>
                        <input id="mail" type="email" placeholder="Mail" name="mail">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mail2">Mail de confirmation :</label>
                    </td>
                    <td>
                        <input id="mail2" type="email" placeholder="Mail de confirmation" name="mail2">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mdp">Mot de passe :</label>
                    </td>
                    <td>
                        <input id="mdp" type="password" placeholder="Mot de passe" name="mdp">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mdp2">Mot de passe :</label>
                    </td>
                    <td>
                        <input id="mdp2" type="password" placeholder="Confirmer le mdp" name="mdp2">
                    </td>
                </tr>
            </table>
            <input type="submit" value="GO" name="formok">
        </form>

        <?php
        if (isset($emptiness))
        {
            echo $emptiness;
        }
        ?>

    </div>
</body>
</html>
