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
        $arr = array('NUMWRONGGUESSES' => $this->game->numWrongGuesses);
        return \PHPWS_Template::process($arr, 'hangman', 'hangmangame.tpl');
    }
}
