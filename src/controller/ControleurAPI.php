<?php
namespace seance\controller;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use seance\vues;
class ControleurAPI {
    private $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function generateObjAPI(Request $rq, Response $rs, $args) {
        $listeJeu = Game::where('id','=',(int) $args['id'])->firstOrFail();
        $tableau = json_encode($listeJeu, JSON_FORCE_OBJECT);
        $vue = new Vue([], $this->container);
        //echo "eho";

        $rs->getBody()->write($vue->render(0));
        //$rs->getBody()->write("28");
        return $rs;
    }
}