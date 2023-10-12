<?php

class Bingo
{
    private $card;

    private $pickedBingoPairs;

    private $newBingoPair;

    private $allBingoPairsPicked = false;

    public function getCard()
    {
        $this->generateBingoCard();
        return $this->card;
    }

    public function getPickedBingoPairs()
    {
        $this->generateBingoPair();
        return $this->pickedBingoPairs;
    }

    public function getNewBingoPair()
    {
        return $this->newBingoPair;
    }

    public function getAllBingoPairsPicked()
    {
        return $this->allBingoPairsPicked;
    }

    private function generateBingoCard()
    {
        $bingoPairs = json_decode(file_get_contents('../resources/json/bingoPairs.json'), true);
        $letters = array_keys($bingoPairs);
        foreach ($letters as $letter) {
            for ($i = 0; $i < 5; $i++) {
                $randomIndex = rand(0, count($bingoPairs[$letter]) - 1);
                $randomNumber = $bingoPairs[$letter][$randomIndex];
                $this->card[$letter][] = $randomNumber;
                array_splice($bingoPairs[$letter], $randomIndex, 1);
            }
        }
    }

    private function generateBingoPair()
    {
        $this->newBingoPair = '';

        // Get initial values of already picked bingo pairs and all bingo pairs
        $pickedBingoPairs = json_decode(file_get_contents('../resources/json/pickedBingoPairs.json'), true);
        $bingoPairs = json_decode(file_get_contents('../resources/json/bingoPairs.json'), true);
        $this->pickedBingoPairs = $pickedBingoPairs;
        $exhaustedLetters = [];
        // Create an array to check which bingo pairs are available for picking
        foreach ($bingoPairs as $letter => $numbers) {
            $availableBingoPairs[$letter] = array_values(array_diff($numbers, $pickedBingoPairs[$letter]));
            if (count($availableBingoPairs[$letter]) === 0) {
                $exhaustedLetters[] = $letter;
            }
        }
        // Check if all bingo pairs have already been picked
        if (count($exhaustedLetters) === 5) {
            $this->allBingoPairsPicked = true;
            return;
        }

        // Get a random available letter, get a new random letter if no numbers are available for the randomed letter
        $letters = array_keys($bingoPairs);
        do {
            $randomLetterIndex = rand(0 ,4);
            $randomLetter = $letters[$randomLetterIndex];
        } while (count($availableBingoPairs[$randomLetter]) <= 0);

        // Get a random number for the letter
        $randomIndex = rand(0, count($availableBingoPairs[$randomLetter]) - 1);
        $randomNumber = $availableBingoPairs[$randomLetter][$randomIndex];
        $this->pickedBingoPairs[$randomLetter][] = $randomNumber;
        $this->newBingoPair = $randomLetter . $randomNumber;

        // Update file contents for picked bingo pairs
        file_put_contents('../resources/json/pickedBingoPairs.json', json_encode($this->pickedBingoPairs));
        return;
    }

    public function resetBingo()
    {
        $emptyBingoPairs = [
            'B' => [],
            'I' => [],
            'N' => [],
            'G' => [],
            'O' => []
        ];
        file_put_contents('../resources/json/pickedBingoPairs.json', json_encode($emptyBingoPairs));
    }
}
