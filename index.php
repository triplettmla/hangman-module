<?php

if (!defined('PHPWS_SOURCE_DIR')) {
    include '../../core/conf/404.html';
    exit();
}


\phpws\PHPWS_Core::initModClass('hangman', 'Hangman.php');
\phpws\PHPWS_Core::initModClass('hangman', 'HangView.php');


// TODO: Determine if there's a game in progress
if (isset($_SESSION["word"])){

// TODO: Load the previous state of the in-progress game
  $game = new Hangman($_SESSION["word"], $_SESSION["numWrongGuesses"], $_SESSION["usedLetter"]);

}
// TODO: Otherwise, create a new game
else {
  $_SESSION["word"] = 'BLUE'; //how will I choose a word? hard-coded for now
  $_SESSION["numWrongGuesses"] = 0;
  $_SESSION["usedLetter"] = array();


}

// TODO: Handle the requested action (for example, choosing a letter)
//if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'chooseLetter') {...}


// TODO: Show the game by rendering it using a View
$view = new HangView($game);
\Layout::add($view->show());

// \Layout::add('This is hangman. Hello world, Mitzi');
