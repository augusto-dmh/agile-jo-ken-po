<?php

namespace App\Livewire;

use Livewire\Component;

class JoKenPo extends Component
{
    public $playerHand;
    public $iaHand;
    public $resultText;
    public $hands;
    public $playerLife;
    public $iaLife;

    public function mount() {
        $this->hands = [
            'rock' => asset('storage/rock.png'),
            'paper' => asset('storage/paper.png'),
            'scissors' => asset('storage/scissors.png'),
        ];
        $this->playerLife = 5;
        $this->iaLife = 5;
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
        $this->playerLife = 5;
        $this->iaLife = 5;
        $this->resultText = '';
    }

    public function render()
    {
        return view('livewire.jo-ken-po');
    }
}
