<?php
 require_once __DIR__."./vendor/autoload.php";
 /**
  * Currently index is being used for CardGames
  */
 use CardGame\Game;

 $game = (new Game('FrenchCard'))->start();

 echo '<pre>';print_R($game);


?>