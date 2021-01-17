<?php
include 'connexion/membership_connect.php';
?>


<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Détails membre</title>

</head>

<body style="background-color:lavender;">

    <header> <a href="index.php" style="text-decoration: none;font-size:larger;color:black;font-weight:bolder;background-color:lightgray">Accueil</a> </header>


    <div class="container">
        <?php
        if (isset($_GET['success'])) {
            echo "<div class='alert alert-success' role='alert'>
            Abonnement modifié aves succès le sanng
        </div>";
        }
        ?>

        <form method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="email" disabled class="form-control" id="nom" aria-describedby="emailHelp" value=<?= $resultat['nom'] ?>>
            </div>
            <div class="form-group">
                <label for="prenom">prenom</label>
                <input type="email" disabled class="form-control" id="prenom" aria-describedby="emailHelp" value=<?= $resultat['prenom'] ?>>
            </div>
            <div class="form-group">
                <label for="nom_abo">Abonnement actuel ^^</label>
                <input type="email" disabled class="form-control" id="nom_abo" aria-describedby="emailHelp" value=<?= $resultat['abonnement'] ?>>
            </div>
            <div class="form-group">
                <label for="abonnements">Changer l'abonnement mdrr</label>
                <select name="new_abo" class="form-control" id="abonnements">

                    <?php
                    for ($i = 0; $i < count($allAbo); $i++) {
                        echo "<option value='" . $allAbo[$i]['id_abo'] . "'>" . $allAbo[$i]['nom'] . "</option>";
                    }
                    ?>

                    <option value="0">SUPPRIMER</option>
                </select>
                <br>
                <input type='submit' name="update" class="btn-primary" value="Appliquer" />
                <input type='submit' name="historique" class="btn-primary" value="Voir historique des films vus par le membre" />
            </div>
        </form>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <?php

                if (isset($_POST['historique'])) {

                    echo "<h3 style='text-decoration:underline'>Derniers films vus par l'utilisateur :</h3>" . "<br><br>";
                    echo "<ul>";


                    for ($i = 0; $i < count($resAvis); $i++) {
                        echo "<li class='list-group-item list-group-item-action list-group-item-success'><b>" . $resAvis[$i]['titre'] . "</b><a style='float: right;' href='reviews.php?user=" . $_GET['id'] . "&film=" . $resAvis[$i]['id_film'] . "'>Afficher les avis</a></li>";
                    }
                    echo "</ul>";
                }
                ?>
            </div>
            <div class="col-lg-6 col-xs-12">
                <form method="post" action="">
                    <b> Ajouter un film à l'historique</b>
                    <select name="add_history">

                        <?php

                        foreach ($getMovies as $value) {
                            echo "<option value='" . $value['id_film'] . "'>" . $value['titre'] . "</option>";
                        }

                        ?>

                    </select>
                    <input type="submit" value="Ajouter" class="btn btn-primary" name="addHistory">
                </form>
            </div>
        </div>
    </div>
</body>

</html>