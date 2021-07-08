<?php

$server="localhost";
$login="root";
$pass="";

try{
    $connexion=new PDO("mysql:host=$server;dbname=development;charest=utf8",$login,$pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connexion à la base de donnée development est reussi <br>";
    echo "jointure reussi exo 2 reussi<br>";
    echo "jointure exo 1 reussi<br>";
    echo "affiche de nombre de framworks qui ont un languages reussi<br>";
    echo "exo 4 Afficher les langages ayant plus de 3 frameworks reussi";
    echo "<h3 style='background-color:red; text-align:center;'>exercice 1</h3>";
    //jointure externe recupere les fraweworks et leurs correspondance dans languages et les languages sans framworks"
    $jointure_ext="SELECT frameworks.name,languages.name
    FROM frameworks 
    RIGHT JOIN languages
    ON frameworks.languagesId = languages.id";
    $requette1=$connexion->prepare($jointure_ext);
    $requette1->execute();
    $resultat2=$requette1->fetchAll();
    echo "<pre>";
    print_r($resultat2);
    echo "</pre>";

    echo "<h3 style='background-color:red; text-align:center;'>exercice 2</h3>";
//jointure interne recupere les fraweworks et leurs correspondance dans languages seulement
    $jointure_int="SELECT frameworks.name,languages.name
    FROM frameworks
    INNER JOIN languages
    ON frameworks.languagesId = languages.id
    ";//une jointure interne on lie deux table entre elles ici on affiche les comm et leurs auteurs 
    $requette=$connexion->prepare($jointure_int);
    $requette->execute();
    $resultat=$requette->fetchAll();
    echo "<pre>";
    print_r($resultat);
    echo "</pre>";

    echo "<h3 style='background-color:red; text-align:center;'>exercice 3</h3>";

    $sqlcode="SELECT COUNT(name)FROM frameworks";
    $requette3=$connexion->prepare($sqlcode);
    $requette3->execute();
    $resultat3=$requette3->fetchAll();
    echo "<pre>";
    print_r($resultat3);

    echo "<h3 style='background-color:red; text-align:center;'>exercice 4</h3>";
    $jointure_externe="SELECT languages.name
    FROM languages 
    RIGHT JOIN frameworks
    ON frameworks.languagesId = languages.id
    GROUP BY languages.name
    HAVING COUNT(frameworks.languagesId)>3";
    $requette5=$connexion->prepare($jointure_externe);
    $requette5->execute();
    $resultat5=$requette5->fetchAll();
    echo "<pre>";
    print_r($resultat5);
    echo "</pre>";
}catch(PDOException $e){
    echo "erreur".$e->getMessage();
}
?>