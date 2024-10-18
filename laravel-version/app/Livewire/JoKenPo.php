<?php

namespace App\Livewire;

use Livewire\Component;

class JoKenPo extends Component
{
    public $playerHand;
    public $iaHand;
    public $resultText;
    public $hands;

    public function mount() {
        $this->hands = [
            'rock' => asset('storage/rock.png'),
            'paper' => asset('storage/paper.png'),
            'scissors' => asset('storage/scissors.png'),
        ];
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
                    $this->resultText = $iaChoice === 'scissors' ? 'Player won!' : 'IA won!';
                    break;
                case 'paper':
                    $this->resultText = $iaChoice === 'rock' ? 'Player won!' : 'IA won!';
                    break;
                case 'scissors':
                    $this->resultText = $iaChoice === 'paper' ? 'Player won!' : 'IA won!';
                    break;
            }
        }
    }

    public function render()
    {
        return view('livewire.jo-ken-po');
    }
}
