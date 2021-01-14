<?php
if (isset($_GET['id'])) {
    $host = 'localhost';
    $dbname = 'cinema';
    $username = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$dbname";


    $conn = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $query = $conn->query("SELECT * FROM abonnement");
    $allAbo = $query->fetchAll();
    $array_titre = [];



    if (isset($_POST['historique'])) {


        $query_history = "SELECT titre 
        FROM film 
        left join historique_membre on film.id_film = historique_membre.id_film 
        WHERE historique_membre.id_membre = " . $_GET['id'];


        $history_prepare = $conn->prepare($query_history);
        $history_prepare->execute();



        if ($history_prepare && $history_prepare->rowCount() > 0) {


            $array_titre = $history_prepare->fetchAll();
          
        } else {

            echo "Désolé nous n'avons trouvé aucun résultat pour cette recherche";
        }
    }

    if (isset($_POST['update'])) {
        $queryUpdate = 'UPDATE membre SET id_abo =  "' . $_POST['new_abo'] . '" WHERE id_fiche_perso = ' . $_GET['id'];
        $update_prepare = $conn->prepare($queryUpdate);
        $update_prepare->execute();
        header('location:membership.php?id=' . $_GET['id'] . '&success=1');
    }
    $resultat = [];
    $sqlquery = "SELECT fiche_personne.id_perso as 'id', fiche_personne.nom as 'nom', 

             fiche_personne.prenom as 'prenom', abonnement.nom as 'nom_abo'  
             FROM fiche_personne
             left join membre on fiche_personne.id_perso = membre.id_fiche_perso 
             left join abonnement on membre.id_abo = abonnement.id_abo 
             
             where fiche_personne.id_perso = " . $_GET['id'];



    $res = $conn->prepare($sqlquery);
    $query = $res->execute();
    $resultQuery = $res->fetchAll();

    if ($query) {
        if ($res->rowCount() > 0) {


            $resultat["id"] = $resultQuery[0]['id'];
            $resultat["nom"] = $resultQuery[0]["nom"];
            $resultat['prenom'] = $resultQuery[0]['prenom'];
            $resultat['abonnement'] = $resultQuery[0]['nom_abo'];
        }
    }
}

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

<body>
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
                <input type='submit' name="update" class="btn-primary" value="Modifier" />
                <input type='submit' name="historique" class="btn-primary" value="Voir historique des films vus par le membre" />

            </div>
        </form>

    </div>

    <div class="container">


        <?php
        
        if(isset($_POST['historique'])){

            echo "<h3 style='text-decoration:underline'>Derniers films vus par l'utilisateur :</h3>"."<br><br>";
        }
        for ($i = 0; $i < count($array_titre); $i++) {

            echo

            "<tr>" .

                "<I> <b><td>" . $array_titre[$i]['titre']. '<br><br>'  .'</td><b></I>' .

                "</tr>" ;
        }

        ?>


    </div>






</body>

</html>