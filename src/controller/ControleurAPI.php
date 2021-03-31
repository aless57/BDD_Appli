<?php
namespace seance\controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use seance\model\Commentaire;
use seance\model\Game;
use seance\model\Platform;
use seance\model\User;
use seance\vues;
class ControleurAPI {
    private $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function generateObjAPI(Request $rq, Response $rs, $args) {
        try {
            $listeJeu = Game::select("id","name","alias","deck","description","original_release_date")->where('id','=',(int) $args['id'])->firstOrFail();
            array_walk_recursive($listeJeu, function(&$v) { $v = strip_tags($v); });
            $array['game'] = $listeJeu;
            $lesPlatform = Game::select("id","name","alias","deck","description","original_release_date")->where('id','=',(int) $args['id'])->first()->platforms()->get();
            $arrayPlatform = array();
            foreach ($lesPlatform as $platform){
                array_walk_recursive($platform, function(&$v) { $v = strip_tags($v); });
                $arrayPlatform[] = array("id"=>$platform->id , "nom"=>$platform->name, "alias"=>$platform->alias,"abbreviation"=>$platform->abbreviation);
            }
            $array['platforms'] = $arrayPlatform;
            $url_jeuCommentaire = $this->container->router->pathFor("affichageCommentaireJeu", ['id' => $args['id']]);
            $array['links'] = array("comments" => array("href" =>$url_jeuCommentaire));
            $tableau = json_encode($array, JSON_UNESCAPED_SLASHES);
            $vue = new vues\Vue([$tableau], $this->container);
            $rs->getBody()->write($vue->render(0));
        }
        catch (\Exception $e){
            $rs = $rs->withJson(['error' => 'Jeu introuvable'],404);
        }
        return $rs;
    }

    public function affichageJeux(Request $rq, Response $rs, $args) {
        $page = $rq->getQueryParam('page',1);
        $row = Game::count();
        $listeJeux = Game::select("id","name","alias","deck")->offset(200*($page-1))->limit(200)->get();
        foreach ($listeJeux as $lejeu){
            $url_jeu = $this->container->router->pathFor("affichageUnJeu", ['id' => $lejeu->id]);
            $lejeu["links"]=array("self"=>array("href" => $url_jeu));
        }
        if($page==1){
            $url_pagenext = $this->container->router->pathFor("affichage200Jeu", ['id' => $lejeu->id]);
            $pagePlus = $page + 1 ;
            $url_pagenext = $url_pagenext . "?page=" . $pagePlus;
            $links = array("next" => array("href" => $url_pagenext));
        }elseif ($page * 200 >= $row){
            $url_pageprev = $this->container->router->pathFor("affichage200Jeu", ['id' => $lejeu->id]);
            $pageMoins = $page - 1;
            $url_pageprev = $url_pageprev . "?page=" . $pageMoins;
            $links = array("prev" => array("href" => $url_pageprev));
        }
        else{
            $url_pagenext = $this->container->router->pathFor("affichage200Jeu", ['id' => $lejeu->id]);
            $pagePlus = $page + 1 ;
            $url_pagenext = $url_pagenext . "?page=" . $pagePlus;

            $url_pageprev = $this->container->router->pathFor("affichage200Jeu", ['id' => $lejeu->id]);
            $pageMoins = $page - 1;
            $url_pageprev = $url_pageprev . "?page=" . $pageMoins;

            $links = array("prev" => array("href" => $url_pageprev), "next" => array("href" => $url_pagenext));
        }

        if($listeJeux->count() ==0){
            $rs = $rs->withJson(['error' => 'Page inconnue'],404);
        }else{
            $array = ["games" => $listeJeux, "links" => $links];
            $tableau = json_encode($array, JSON_UNESCAPED_SLASHES);
            $vue = new vues\Vue([$tableau], $this->container);
            $rs->getBody()->write($vue->render(1));
        }
        return $rs;
    }

    public function affichageCommentaireJeu(Request $rq, Response $rs, $args) {
        $listeCommentaires = Commentaire::select("id","title","content","created_at","fk_email")->where('fk_idjeu',"=", (int) $args['id'])->get();
        if($listeCommentaires->count() ==0){
            $rs = $rs->withJson(['error' => 'Page inconnue'],404);
        }else{
            foreach ($listeCommentaires as $commentaire){
                $nameUserCommentaire = User::where("email","=",$commentaire->fk_email)->first();
                $array["$nameUserCommentaire->nom"] = array($commentaire);
            }
            $tableau = json_encode($array, JSON_FORCE_OBJECT);
            $vue = new vues\Vue([$tableau], $this->container);
            $rs->getBody()->write($vue->render(0));
        }
        return $rs;
    }

    public function affichageCharacterJeu(Request $rq, Response $rs, $args) {
        try {
            $lesCharacters = Game::find($args['id'])->characters()->get();
            $array = [];
            foreach ($lesCharacters as $character){
                 $array["characters"][]= array("character" => array("id"=>$character->id,"name"=>$character->name));
            }
            if($array==[]){
                $array["characters"] = [];
            }
            $tableau = json_encode($array, JSON_UNESCAPED_SLASHES);
            $vue = new vues\Vue([$tableau], $this->container);
            $rs->getBody()->write($vue->render(0));

        }catch (\Exception $e){
            $rs = $rs->withJson(['error' => 'Jeu introuvable'],404);
        }
        return $rs;
    }

    public function injecterCommentaire(Request $rq, Response $rs, $args)
    {
        $post = $rq->getParsedBody();
        if (isset($post['commentaire'])) {
            try {
                $title = filter_var($post['commentaire']['content']);
                $content = filter_var($post['commentaire']['content']);
                $created_at = filter_var($post['commentaire']['created_at']);
                $fk_email = filter_var($post['commentaire']['fk_email']);


                $commentaire = new Commentaire();
                $commentaire->title = $title;
                $commentaire->content = $content;
                $commentaire->created_at = $created_at;
                $commentaire->fk_email = $fk_email;
                $commentaire->fk_idjeu = $args['id'];

                if (User::where('email',"=",$fk_email)->count() != 0){
                    $commentaire->save();
                    $rs->write(json_encode($commentaire, JSON_PRETTY_PRINT));
                    return $rs->withStatus(201)->withHeader('Location','/api/comments'.$args['id']);
                }else{
                    $rs = $rs->withJson(['error' => 'Email inconnue'], 403);
                    return $rs;
                }

            } catch (ModelNotFoundException $e) {
                $rs = $rs->withJson(['error' => 'Pas de user'], 404);
                return $rs;
            }
        }else{
            $rs = $rs->withJson(['error' => 'Pas de commentaire'], 400);
            return $rs;
        }
    }

}