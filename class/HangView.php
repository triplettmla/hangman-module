<?php


class HangView {
    private $game;

    public function __construct(Hangman $game)
    {
        // TODO: save a reference to the game in a member variable
        $this->game = $game;
    }

    public function show()
    {
        // TODO return HTML from PHPWS_Tempate::process(...)
        // Template is in templates/hangmangame.tpl
        //process (assoc. array of parameters, name of project, *.tpl)

        if ($this->game->numWrongGuesses === 0 && count($this->game->usedLetter) == 0){ //Start of the game
          $hangmanImage = PHPWS_SOURCE_HTTP . 'mod/hangman/img/hang0.gif';

          $displayWord = '';
          for($eachLetter = 0; $eachLetter < strlen($this->game->word); $eachLetter++)
            $displayWord = $displayWord . '_ ';

          $displayGameStatus = '<p>Select a letter:</p>';

          $letters = range('A', 'Z');
          foreach ($letters as $letter) {
            $displayGameStatus .= '<a href="' . PHPWS_SOURCE_HTTP . 'index.php?module=hangman&action=chooseLetter&letter=' . $letter . '">' . $letter . '</a> ';
          }

        }
        elseif ($this->game->numWrongGuesses >= 6){  //End of the game
          $hangmanImage = PHPWS_SOURCE_HTTP . 'mod/hangman/img/hang6.gif';

          $displayWord = '';
          //for($eachLetter = 0; $eachLetter < strlen($this->game->word); $eachLetter++)
            //$displayWord = $displayWord . '_ '; //cycle thru letters in word to build word guessed

          $displayGameStatus = '<p>GAME OVER</p><p>The word was: ' . $this->game->word;

        }
        else { //Guessing letters
          $hangmanImage = PHPWS_SOURCE_HTTP . 'mod/hangman/img/hang' . $this->game->numWrongGuesses . '.gif';

          $guessCount = 0;
          $displayWord = '';
          for($eachLetter = 0; $eachLetter < strlen($this->game->word); $eachLetter++){
            if (in_array($this->game->word[$eachLetter], $this->game->usedLetter)){
              $displayWord .= substr($this->game->word, $eachLetter, 1) . ' ';
              $guessCount++;
            }
            else {
              $displayWord = $displayWord . '_ ';
            }
          }


          // if the length of guessed word matches word, you won
          if ($guessCount == strlen($this->game->word)){
            $displayGameStatus = '<h2>YOU WON!</h2>';
          }
          else {
            $displayGameStatus = '<p>Select a letter:</p>';
            $letters = range('A', 'Z');
            foreach ($letters as $letter) {
              if (in_array($letter, $this->game->usedLetter)) //letter already used
                $displayGameStatus .= $letter . ' ';
              else {
                $displayGameStatus .= '<a href="' . PHPWS_SOURCE_HTTP . 'index.php?module=hangman&action=chooseLetter&letter=' . $letter . '">' . $letter . '</a> ';
              }
            }
          }
        }
        $resetLink = PHPWS_SOURCE_HTTP . 'index.php?module=hangman&action=reset';
        $arr = array('IMAGE'=>$hangmanImage,
                      'DISPLAYWORD'=>$displayWord,
                      'DISPLAYGAMESTATUS'=>$displayGameStatus,
                      'RESETLINK'=>$resetLink);
        return \PHPWS_Template::process($arr, 'hangman', 'hangmangame.tpl');
    }
}
