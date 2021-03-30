<?php

// question 1
// Le résultat est donné sous forme d'objet ("{...}")
// uniquement si le tag JSON_FORCE_OBJECT est utilisé ou
// que le tableau une synthax "key => value"

// question 2
//dans l'url
//$paramValue = $app->request()->get('paramName');  quetqueryparam
//$paramValue = $app->request()->post('paramName');
//dans le corps de l'appli
//$post = $rq->getParsedBody()
//$get = $rs->getParsedBody()

// question 3
//class CustomHandler {
  //  public function __invoke($request, $response, $exception) {
    //    return $response
      //      ->withStatus(500)
        //    ->withHeader('Content-Type', 'text/html')
          //  ->write('Something went wrong!');
    //}
//}

?>