<?php

use seance\model\Game;
use seance\model\Character;
use \seance\model\Company;
use seance\model\User;
use seance\model\Commentaire;
use Illuminate\Database\Capsule\Manager as DB;

require '../vendor/autoload.php';

$config = ['settings' => [
    'displayErrorDetails' => true,
]];

$db = new \Illuminate\Database\Capsule\Manager();
$db->addConnection(parse_ini_file('../conf/conf.ini'));
$db->setAsGlobal();
$db->bootEloquent();
echo "<h1> TD 4 BDD Application </h1>\n\n";
echo "<br>";
echo "<br>";

echo "<h2> Programmer un script php qui crée 2 utilisateurs, 3 commentaires par utilisateurs, tous concernant le jeu 12342. </h2>";
/*
// PARTIE 1 
$user1 = new User();
$user2 = new User();

$user1->nom = "Balosto";
$user1->prenom = "Patrick";
$user1->email = "balostopatoch@gmail.com";
$user1->adress = "13 allée de la libération, Los Santos 69999";
$user1->tel = "0677552198";
$user1->birthDate = date("28/11/2020");

$user2->nom = "Lafrode";
$user2->prenom = "Julien";
$user2->email = "tarienvu@gmail.com";
$user2->adress = "13 impasse des inconnues, Narbonnes 11100";
$user2->tel = "0677587598";
$user2->birthDate = date("29/11/2020");

$user1->save();
$user2->save();

$commentaire1user1 = new Commentaire();
$commentaire2user1 = new Commentaire();
$commentaire3user1 = new Commentaire();

$commentaire1user2 = new Commentaire();
$commentaire2user2 = new Commentaire();
$commentaire3user2 = new Commentaire();

$commentaire1user1->title = "Com1User1";
$commentaire2user1->title = "Com2User1";
$commentaire3user1->title = "Com3User1";

$commentaire1user2->title = "Com1User2";
$commentaire2user2->title = "Com2User2";
$commentaire3user2->title = "Com3User2";

$commentaire1user1->content = "nul";
$commentaire2user1->content = "nul";
$commentaire3user1->content = "nul";

$commentaire1user2->content = "nul";
$commentaire2user2->content = "nul";
$commentaire3user2->content = "nul";

$commentaire1user1->fk_email = "balostopatoch@gmail.com";
$commentaire2user1->fk_email = "balostopatoch@gmail.com";
$commentaire3user1->fk_email = "balostopatoch@gmail.com";

$commentaire1user2->fk_email = "tarienvu@gmail.com";
$commentaire2user2->fk_email = "tarienvu@gmail.com";
$commentaire3user2->fk_email = "tarienvu@gmail.com";

$commentaire1user1->fk_idjeu = 12342;
$commentaire2user1->fk_idjeu = 12342;
$commentaire3user1->fk_idjeu = 12342;

$commentaire1user2->fk_idjeu = 12342;
$commentaire2user2->fk_idjeu = 12342;
$commentaire3user2->fk_idjeu = 12342;

$commentaire1user1->save();
$commentaire2user1->save();
$commentaire3user1->save();

$commentaire1user2->save();
$commentaire2user2->save();
$commentaire3user2->save();
*/
// PARTIE 2

// Boucle pour user
/*
$faker = Faker\Factory::create("fr_FR");

for($i =0; $i <25000 ; $i++){
    $u =new User();
    $u ->nom = $faker->lastName();
    $u -> prenom = $faker->firstName();
    $uEmail = $u->prenom .$u->nom."@".$faker->freeEmailDomain();
    $u -> email = $uEmail;
    $u -> tel = $faker->phoneNumber();
    $u -> birthDate = $faker ->date($format = 'Y-m-d', $max = 'now');
    $u->save();

    for($i =0; $i <10 ; $i++){
        $commentaire = new Commentaire();
        $commentaire->title = $faker->word();
        $commentaire->content = $faker -> text();
        $commentaire->fk_email = $uEmail;
        $commentaire->fk_idjeu = random_int(1, 47978);
        $commentaire->save();
    }
    

}*/

echo "<h2> Lister les commentaires d'un utilisateur donné, afficher la date du commentaire de façon lisible, ordonnés par date décroissante </h2>\n\n";
echo "<br>";
echo "<br>";

echo "Pour Gérard Natalie : <br>\n\n";

$commentairesNatalie = User::where("id","=",1)->get()->commentaires();

foreach ($commentairesNatalie as $com){
    echo "Titre : $com->title Content : $com->content Date de création : $com->created_at <br>\n";
}



