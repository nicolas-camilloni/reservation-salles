<?php session_start() ?>

<!DOCTYPE html>

<html>

<head>
    <title>Reservation Salles - Inscription</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include("header.php"); ?>
    <main>
        <section class="cmid formimg">
            <?php
            if (isset($_SESSION["login"])) 
            {
                echo "<section id=\"fdeco\"><p>Bonjour " . $_SESSION["login"] . ", vous êtes déjà connecté impossible de s'inscrire.<br /></p>";
                ?>
                <form action="index.php" method="post">
                    <input name="deco" value="Deconnexion" type="submit" />
                </form>
            <?php
                echo "</section>";
            } 
            else 
            {
                ?>
                    <section class="left">
                        <img src="img/arbre.png">
                    </section>
                    <section class="mid cpageform">
                    <article class="titleform">
                    <p>Inscription</p>
                    </article>
                    <form action="inscription.php" method="post">
                        <section class="cform">
                            <label>Identifiant</label>
                            <input type="text" name="login" required>
                            <label>Mot de passe</label>
                            <input type="password" name="mdp" required>
                            <label>Confirmation du mot de passe</label>
                            <input type="password" name="mdpval" required>
                            <br />
                            <input type="submit" value="S'inscrire" name="valider">
                        </section>
                    </form>
                    <?php

                    if ( isset($_POST["valider"]) )
                    {
                        $login = $_POST["login"];
                        $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT, array('cost' => 12));
                        $connexion = mysqli_connect("localhost", "root", "", "reservationsalles");
                        $requete3 = "SELECT login FROM utilisateurs WHERE login = '$login'";
                        $query3 = mysqli_query($connexion, $requete3);
                        $resultat3 = mysqli_fetch_all($query3);

                        if (!empty($resultat3)) 
                        {
                        ?>
                            <p class="pincorrect">Cet identifiant est déjà prit.</p>
                        <?php
                        }
                        elseif ($_POST["mdp"] != $_POST["mdpval"]) 
                        {
                        ?>
                            <p class="pincorrect">Attention ! Mots de passe différents.</p>
                        <?php
                        }
                        else 
                        {
                            $requete = "INSERT INTO utilisateurs (login, password) VALUES ('$login','$mdp')";
                            $query = mysqli_query($connexion, $requete);
                            header('Location:connexion.php');
                        }
                    }
                    ?>
                    </section>
            <section class="right">
                <img src="img/arbre.png">
            </section>
            <?php
                }
                ?>
        </section>
    </main>
<?php include("footer.php"); ?>
</body>

</html>
