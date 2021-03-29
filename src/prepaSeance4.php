<?php

// Le type DateTime représente une date avec une heure. 
// La paricularité est que ces objets se modifie eux-memes quand une méthode de modification est appelées (modify, setDate etc...)

// Comment s'installe Faker ?
// --> Faker s'installe a travers le composer. Il suffit d'ajouter en ligne de commande : composer require fakerphp/faker

$faker = Faker\Factory::create();

// Creation d'une adresse américaine
$faker->addProvider(new Faker\Provider\en_US\Address($faker));

$faker->dateTime("2017/02/16 16:15");
