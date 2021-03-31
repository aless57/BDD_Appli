# BDD_Appli
BDD Application S4 SI2 DEMANGE GALENTE HUNG-KUNG-SOW NOEL SAINT-DIZIER

Configuration :
> Slim 3.*
> 
> PHP >=7.3|^7.2.34
> 
> Fakerphp/faker ^1.13

composer install 

Configuration DataBase :
- driver=mysql
- username=root
- password=
- host=localhost
- database=gamesdb
- charset=utf8
- collation=utf8_unicode_ci
- extension=pdo_mysql

> Ne pas oublier d'ajouter les tables contenues dans le fichier /src/TP/ressources.sql
> et https://arche.univ-lorraine.fr/mod/resource/view.php?id=428597

#Sujet des séances
- Séance 1 : /src/1.php & /src/pagination/index.php
- Séance 2 : /src/2.php
- Séance 3 : /src/3.php
- Séance 4 : /src/4.php & /src/TP/ressources.sql
- Séance 5 & 6 : index.php & /src/controller/ControleurAPI.php & /src/vues/Vue.php


#Préparation des séances (/src)
- Préparation séance 2 : prepaSeance2.php
- Préparation séance 3 : prepaSeance3.php
- Préparation séance 4 : prepaSeance4.php
- Préparation séance 5-6 : prepaSeance5et6.php

##Modeles disponibles (/src/model)
- Annonce.php
- Categorie.php
- Character.php
- Commentaire.php
- Company.php
- Game.php
- Game_rating.php
- Genre.php
- Photo.php
- Platform.php
