<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class JoKenPo extends Component
{
    public $playerHand;
    public $iaHand;
    public $resultText;
    public $hands;
    public $initialPlayerLife = 5;
    public $initialIaLife = 5;
    public $playerLife;
    public $iaLife;

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
    }

    public function play($playerChoice)
    {
        $this->playerHand = $this->hands[$playerChoice];
        $iaChoice = array_rand($this->hands);
        $this->iaHand = $this->hands[$iaChoice];

        if ($playerChoice === $iaChoice) {
            $this->resultText = 'Draw!';
        } else {
            switch ($playerChoice) {
                case 'rock':
                    if ($iaChoice === 'scissors') {
                        $this->resultText = 'Player won!';
                        $this->removeLife($this->iaHand);
                        return;
                    }
                    $this->resultText = 'IA won!';
                    $this->removeLife($this->playerHand);
                break;
                case 'paper':
                    if ($iaChoice === 'rock') {
                        $this->resultText = 'Player won!';
                        $this->removeLife($this->iaHand);
                        return;
                    }
                    $this->resultText = 'IA won!';
                    $this->removeLife($this->playerHand);
                break;
                case 'scissors':
                    if ($iaChoice === 'paper') {
                        $this->resultText = 'Player won!';
                        $this->removeLife($this->iaHand);
                        return;
                    }
                    $this->resultText = 'IA won!';
                    $this->removeLife($this->playerHand);
                break;
            }
        }
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
        return view('livewire.jo-ken-po');
    }
}
