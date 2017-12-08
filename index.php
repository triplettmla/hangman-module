<?php

if (!defined('PHPWS_SOURCE_DIR')) {
    include '../../core/conf/404.html';
    exit();
}


\phpws\PHPWS_Core::initModClass('hangman', 'Hangman.php');
\phpws\PHPWS_Core::initModClass('hangman', 'HangView.php');

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reset') {
  unset($_SESSION["word"]);
}

// TODO: Determine if there's a game in progress
if (isset($_SESSION["word"])){

// TODO: Load the previous state of the in-progress game
  $game = new Hangman($_SESSION["word"], $_SESSION["numWrongGuesses"], $_SESSION["usedLetter"]);

}
// TODO: Otherwise, create a new game
else {
  $wordFile = PHPWS_SOURCE_DIR . 'mod/hangman/inc/hangwords.txt';
  $wordList = file($wordFile);

  $_SESSION["word"] = trim(strtoupper($wordList[rand(0, count($wordList)-1)])); //how will I choose a word? hard-coded for now
  $_SESSION["numWrongGuesses"] = 0;
  $_SESSION["usedLetter"] = array();
  $game = new Hangman($_SESSION["word"], $_SESSION["numWrongGuesses"], $_SESSION["usedLetter"]);
}

// TODO: Handle the requested action (for example, choosing a letter)
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'chooseLetter') {
  $game->chooseLetter($_REQUEST['letter']);
  $_SESSION["numWrongGuesses"] = $game->numWrongGuesses;
  $_SESSION["usedLetter"] = $game->usedLetter;
}


// TODO: Show the game by rendering it using a View
$view = new HangView($game);
\Layout::add($view->show());

// \Layout::add('This is hangman. Hello world, Mitzi');
