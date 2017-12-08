<?php

class Hangman {
    public $word;
    public $numWrongGuesses;
    public $usedLetter;

    public function __construct($word, $numWrongGuesses, Array $usedLetter){
        // TODO: save params in member variables
        $this->word = $word;
        $this->numWrongGuesses = $numWrongGuesses;
        $this->usedLetter = $usedLetter;
    }

    public function chooseLetter($letter)
    {
        // TODO: check if the letter is in the word
        if (strpos($this->word, $letter) === false){
          // If not, increment num wrong guesses
          $this->numWrongGuesses += 1;
        }

        // Always add the letter to $usedLetters array
        $this->usedLetter[] = $letter;
    }

    // TODO: Getter/setter methods
    public function __get($property) {
      if (property_exists($this, $property)) {
        return $this->$property;
      }
    }

    public function __set($property, $value) {
      if (property_exists($this, $property)) {
        $this->$property = $value;
      }

      return $this;
    }


}
