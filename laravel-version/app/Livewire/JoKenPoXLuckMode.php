<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class JoKenPoXLuckMode extends Component
{
    public $playerHand;
    public $iaHand;
    public $resultText;
    public $hands;
    public $initialPlayerLife;
    public $initialIaLife;
    public $playerLife;
    public $iaLife;
    public $winnerFirstRound;
    public $rollDiceTime;
    public $diceRolledByPlayer;
    public $diceRolledByIa;
    public $diceBeforeRolling;
    public $continueTime;

    #[Computed]
    public function playerLifeTaken() {
        return $this->initialPlayerLife - $this->playerLife;
    }

    #[Computed]
    public function iaLifeTaken() {
        return $this->initialIaLife - $this->iaLife;
    }

    public function mount() {
        $this->hands = [
            'rock' => asset('storage/rock.png'),
            'paper' => asset('storage/paper.png'),
            'scissors' => asset('storage/scissors.png'),
        ];
        $this->initialPlayerLife = 5;
        $this->initialIaLife = 5;
        $this->playerLife = $this->initialPlayerLife;
        $this->iaLife = $this->initialIaLife;
        $this->diceBeforeRolling = asset('storage/dice-first-frame.png');
    }

    public function playFirstRound($playerChoice)
    {
        $this->playerHand = $this->hands[$playerChoice];
        $iaChoice = array_rand($this->hands);
        $this->iaHand = $this->hands[$iaChoice];

        if ($playerChoice === $iaChoice) {
            $this->resultText = 'Draw!';
        } else {
            $this->rollDiceTime = true;

            switch ($playerChoice) {
                case 'rock':
                    if ($iaChoice === 'scissors') {
                        $this->resultText = 'Player won first round';
                        $this->winnerFirstRound = $this->playerHand;
                        return;
                    }
                    $this->resultText = 'IA won first round';
                    $this->winnerFirstRound = $this->iaHand;
                break;
                case 'paper':
                    if ($iaChoice === 'rock') {
                        $this->resultText = 'Player won first round';
                        $this->winnerFirstRound = $this->playerHand;
                        return;
                    }
                    $this->resultText = 'IA won first round';
                    $this->winnerFirstRound = $this->iaHand;
                break;
                case 'scissors':
                    if ($iaChoice === 'paper') {
                        $this->resultText = 'Player won first round';
                        $this->winnerFirstRound = $this->playerHand;
                        return;
                    }
                    $this->resultText = 'IA won first round';
                    $this->winnerFirstRound = $this->iaHand;
                break;
            }
        }
    }

    public function playSecondRound() {
        $playerDiceNumber = random_int(1, 6);
        $iaDiceNumber =   random_int(1, 6);

        $this->diceRolledByPlayer = asset('storage/dice-' . $playerDiceNumber . '.gif');
        $this->diceRolledByIa = asset('storage/dice-' . $iaDiceNumber . '.gif');

        if ($this->winnerFirstRound === $this->playerHand) {
            if ($playerDiceNumber > $iaDiceNumber) {
                $this->resultText = 'Player attacked and damaged IA';
                $this->removeLife($this->iaHand);
            } else if ($playerDiceNumber < $iaDiceNumber) {
                $this->resultText = 'IA defended himself against player attack';
            } else {
                $this->resultText = 'Draw!';
                return;
            }
        } else if ($this->winnerFirstRound === $this->iaHand) {
            if ($playerDiceNumber > $iaDiceNumber) {
                $this->resultText = 'Player defended himself against IA attack';
            } else if ($playerDiceNumber < $iaDiceNumber) {
                $this->resultText = 'IA attacked and damaged player';
                $this->removeLife($this->playerHand);
            } else {
                $this->resultText = 'Draw!';
                return;
            }
        }

        $this->continueTime = true;
    }

    public function continueGame() {
        $this->rollDiceTime = false;
        $this->continueTime = false;
        $this->diceRolledByPlayer = null;
        $this->diceRolledByIa = null;
        $this->winnerFirstRound = null;
        $this->resultText = '';
    }

    public function removeLife($hand) {
        $hand === $this->playerHand
        ? ($this->playerLife -= 1)
        : ($this->iaLife -= 1);
    }

    public function retry() {
        $this->playerLife = $this->initialPlayerLife;
        $this->iaLife = $this->initialIaLife;
        $this->resultText = '';
    }

    public function render()
    {
        return view('livewire.jo-ken-po-x-luck-mode');
    }
}
