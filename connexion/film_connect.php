<?php

include 'pdo_connect.php';


$array_titre = [];
$array_genre = [];
$array_distributeur = [];  //Les tableaux vides que l'on va remplire de nos resultats de queries pour ensuite pourvoir les display dans le html à l'aide d'une boucle
$array_projection = [];
$array_id = [];
$array_avis = [];




if (isset($_POST['add_review'])) {   // si on clique sur 'ajouter', on ajoute l'avis dans la colone qui correspond à l'id de notre user qu'on a récupéré dans un GET

    $host = 'localhost';
    $dbname = 'cinema';
    $username = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$dbname";


    $conn = new PDO($dsn, $username, $password);

    $queryAvis = 'UPDATE historique_membre SET avis =  "' . $_POST['avis'] . '" WHERE id_film = ' . $_GET['id'];
    $res = $conn->prepare($queryAvis);


    if ($res->execute()) {

        header('location:membership.php?id=' . $_GET['id'] . '&success=1');
    } else {

        header('location:membership.php?id=' . $_GET['id'] . '&failed=1');
    }
}
if (isset($_POST['find']) && !empty($_POST['genre']) or !empty($_POST['distributeur']) or !empty($_POST['titre']) or !empty($_POST['projection'])) {


    $titre = $_POST['titre'];
    $genre = $_POST['genre'];
    $distributeur = $_POST['distributeur'];
    $projection = $_POST['projection'];




    $sqlquery = "SELECT film.titre, g.nom, d.nom, film.date_debut_affiche, id_film

    FROM film  
    
    LEFT JOIN genre AS g   ON  film.id_genre = g.id_genre
    LEFT JOIN distrib AS d ON  film.id_distrib = d.id_distrib
    
    WHERE film.titre LIKE '%$titre%'                                                   
    AND (g.nom = '$genre' OR '$genre' = '')
    AND (d.nom LIKE '%$distributeur%' OR '$distributeur' = '')
    AND (film.date_debut_affiche = '$projection' OR '$projection' = '')";


    $res = $conn->prepare($sqlquery);



    if ($res->execute() && $res->rowCount() > 0) {
        foreach ($res as $row) {
            array_push($array_id, $row['id_film']);
            array_push($array_titre, $row[0]);      // je push les resultats de ma query dans des tableaux vides qui correspondent
            array_push($array_genre, $row[1]);
            array_push($array_distributeur, $row[2]);
            array_push($array_projection, $row[3]);
        }
    } else {


        echo "Désolé nous n'avons trouvé aucun résultat pour cette recherche";
    }
}
