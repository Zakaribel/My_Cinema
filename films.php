<?php include 'connexion/film_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background-color:lavender;">

    <header> <a href="index.php" style="text-decoration: none;font-size:larger;color:black;font-weight:bolder;background-color:lightgray">Accueil</a> </header>

    <form method="POST" style="text-align: center;">

        <b> le titre du film :</b> <input type="text" name="titre"><br><br>
        <b> Entre le genre du film :</b> <input type="text" name="genre"><br><br>
        <b>Entre le distributeur du film :</b> <input type="text" name="distributeur"><br><br>
        <b> Entrez une date de projection <I>(exemple : 1990-01-01 )</I>:</b> <input type="text" name="projection"><br><br>

        <input type="submit" name="find" value="Rechercher">

        <hr />


        <table style="width: 100%;">

            <tr style="height: 70px;">
                <th style="background-color: #4CAF50;color: white;"> Titre : </th>
                <th style="background-color: #4CAF50;color: white;"> Genre : </th>
                <th style="background-color: #4CAF50;color: white;"> Distributeur :</th>
                <th style="background-color: #4CAF50;color: white;"> Date de projection :</th>
            </tr>

            <?php


            for ($i = 0; $i < count($array_titre); $i++) {

                echo "<tr>" .

                    '<td style="height:50px;border:2px solid black;">' . '<center>' .   $array_titre[$i]  . '</center>' . '</td>' .
                    '<td style="height:50px;border:2px solid black;">' . '<center>' . $array_genre[$i] . '</center>' . '</td>' .
                    '<td style="height:50px;border:2px solid black;">' . '<center>' . $array_distributeur[$i] . '</center>' . '</td>' .
                    '<td style="height:50px;border:2px solid black;">' . '<center>' . $array_projection[$i] . '</center>' . '</td>' .

                    "</tr>";
            }

            ?>








        </table>

    </form>
</body>

</html>