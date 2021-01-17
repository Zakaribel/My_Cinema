<?php

include 'pdo_connect.php';

$resAvis = [];

if (isset($_GET['id'])) {

    $query = $conn->query("SELECT * FROM abonnement");
    $allAbo = $query->fetchAll();

    $getMovies = $conn->query('SELECT * FROM film');


    if (isset($_POST['addHistory'])) {

        $sql = $conn->prepare("INSERT INTO historique_membre (id_membre,id_film,date) VALUES (?,?,?)");
        if ($sql->execute(array($_GET['id'], $_POST['add_history'], date("Y-m-d H:i:s")))) {
            header('location:membership.php?id=' . $_GET['id']);
        }
    }


    if (isset($_POST['historique'])) {


        $query_history = "SELECT film.titre,historique_membre.id_film

        FROM film 

        LEFT JOIN historique_membre on film.id_film = historique_membre.id_film 

        WHERE historique_membre.id_membre = " . $_GET['id'] . " order by historique_membre.date DESC";


        $history_prepare = $conn->prepare($query_history);



        if ($history_prepare->execute() && $history_prepare->rowCount() > 0) {

            $resAvis = $history_prepare->fetchAll();
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
    $sqlquery = "SELECT fiche_personne.id_perso AS 'id', fiche_personne.nom AS 'nom', 
                 fiche_personne.prenom AS 'prenom', abonnement.nom AS 'nom_abo'  
                 
             FROM fiche_personne

             LEFT JOIN  membre ON fiche_personne.id_perso = membre.id_fiche_perso 
             LEFT JOIN abonnement ON membre.id_abo = abonnement.id_abo 
             
             WHERE fiche_personne.id_perso = " . $_GET['id'];



    $res = $conn->prepare($sqlquery);
    $query = $res->execute();
    $resultQuery = $res->fetchAll();


    if ($query && $res->rowCount() > 0) {


        $resultat["id"] = $resultQuery[0]['id'];
        $resultat["nom"] = $resultQuery[0]["nom"];
        $resultat['prenom'] = $resultQuery[0]['prenom'];
        $resultat['abonnement'] = $resultQuery[0]['nom_abo'];
    }
}
