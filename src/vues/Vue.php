<?php


namespace seance\vues;

use mywishlist\controls\ControleurAccueil;

/**
 * Class VueAccueil
 * @package mywishlist\vue
 */
class Vue {

    private $tab;
    private $container;

    /**
     * VueAccueil constructor.
     * @param $tab
     * @param $container
     */
    public function __construct($tab, $container){
        $this->tab = $tab;
        $this->container = $container;
    }

    /**
     * Fonctions
     */

    /**
     * RENDER
     * @param int $select
     * @return string
     */
    public function render( int $select ) : string
    {
        $content =  "";
        switch ($select) {
            //Affichage 1 jeux
            case 0 :
            {
                $content .= $this->tab[0];
                break;
            }
            //Affichage 200 jeux
            case 1 :
            {
                $content .= $this->tab[0];
                break;
            }
        }
        $html = <<<FIN
<!DOCTYPE html>
<html>
<head>
    <title>GamesPedia</title>
</head>
<body>
$content   
</body>
</html>
FIN;
        return $html;
    }
}