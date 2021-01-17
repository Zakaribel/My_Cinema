<?php

include 'film_connect.php';



$sql = "SELECT * FROM `historique_membre` WHERE id_film =" . $_GET['film'] . " AND avis is not null";
$res = $conn->query($sql);
$URI = $_SERVER['REQUEST_URI'];

if (isset($_POST['add_review'])) {
    $updateSQL = $conn->query('UPDATE historique_membre SET avis = "' . $_POST['avis'] . '" where id_membre = ' . $_GET['user'] . ' and id_film = ' . $_GET['film']);
    header('location:' . $URI);
}
