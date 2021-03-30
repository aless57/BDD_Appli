<?php
namespace seance\controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use seance\model\Game;
use seance\vues;
class ControleurAPI {
    private $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function generateObjAPI(Request $rq, Response $rs, $args) {
        $listeJeu = Game::select("id","name","alias","deck","description","original_release_date")->where('id','=',(int) $args['id'])->firstOrFail();
        $tableau = json_encode($listeJeu, JSON_FORCE_OBJECT);
        $vue = new vues\Vue([$tableau], $this->container);

        $rs->getBody()->write($vue->render(0));
        return $rs;
    }

    public function affichageJeux(Request $rq, Response $rs, $args) {
        $page = false;
        if($_GET != null){
            $page = $_GET['page'];
        }
        if(!$page || $page==1){
            $listeJeux = Game::select("id","name","alias","deck")->limit(200)->get();
            $pagePlus = $page + 1;
            $pageMoins = $page - 1;
            $links = array("next" => array("href" => "/api/games?page={$pagePlus}"));
        }elseif ($page==240){
            $listeJeux = Game::select("id","name","alias","deck")->limit(200)->get();
            $pagePlus = $page + 1;
            $pageMoins = $page - 1;
            $links = array("prev" => array("href" => "/api/games?page={$pageMoins}"));
        }
        else{
            $listeJeux = Game::select("id","name","alias","deck")->offset(200*($page-1))->limit(200)->get();
            $pagePlus = $page + 1 ;
            $pageMoins = $page - 1;
            $links = array("prev" => array("href" => "/api/games?page={$pageMoins}"), "next" => array("href" => "/api/games?page={$pagePlus}"));
        }
        $array = ["games" => $listeJeux, "links" => $links];
        $tableau = json_encode($array, JSON_UNESCAPED_SLASHES);
        $vue = new vues\Vue([$tableau], $this->container);
        $rs->getBody()->write($vue->render(1));
        return $rs;
    }

}