<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class JoKenPo extends Component
{
    public $hands;
    public $player;
    public $ia;
    public $resultText;

    #[Computed]
    public function playerLifeTaken() {
        return $this->player['initialLife'] - $this->player['currentLife'];
    }

    #[Computed]
    public function iaLifeTaken() {
        return $this->ia['initialLife'] - $this->ia['currentLife'];
    }

    public function mount() {
        $this->hands = [
            'player' => [
                'rock' => asset('storage/hands/player/rock.png'),
                'paper' => asset('storage/hands/player/paper.png'),
                'scissors' => asset('storage/hands/player/scissors.png'),
            ],
            'ia' => [
                'rock' => asset('storage/hands/ia/rock.png'),
                'paper' => asset('storage/hands/ia/paper.png'),
                'scissors' => asset('storage/hands/ia/scissors.png'),
            ],
        ];
        $this->player = [
            'hand' => null,
            'initialLife' => 5,
            'currentLife' => 5,
        ];
        $this->ia = [
            'hand' => null,
            'initialLife' => 5,
            'currentLife' => 5,
        ];
        $this->resultText = '';
    }

    public function play($playerChoice)
    {
        $this->player['hand'] = $this->hands['player'][$playerChoice];
        $iaChoice = array_rand($this->hands['ia']);
        $this->ia['hand'] = $this->hands['ia'][$iaChoice];

        if ($playerChoice === $iaChoice) {
            $this->resultText = 'Draw!';
        } else {
            switch ($playerChoice) {
                case 'rock':
                    if ($iaChoice === 'scissors') {
                        $this->resultText = 'Player won!';
                        $this->removeLife($this->ia);
                        return;
                    }
                    $this->resultText = 'IA won!';
                    $this->removeLife($this->player);
                    break;
                case 'paper':
                    if ($iaChoice === 'rock') {
                        $this->resultText = 'Player won!';
                        $this->removeLife($this->ia);
                        return;
                    }
                    $this->resultText = 'IA won!';
                    $this->removeLife($this->player);
                    break;
                case 'scissors':
                    if ($iaChoice === 'paper') {
                        $this->resultText = 'Player won!';
                        $this->removeLife($this->ia);
                        return;
                    }
                    $this->resultText = 'IA won!';
                    $this->removeLife($this->player);
                    break;
            }
        }
    }

    public function removeLife(&$entity) {
        $entity['currentLife'] -= 1;
    }

    public function retry() {
        $this->player['currentLife'] = $this->player['initialLife'];
        $this->ia['currentLife'] = $this->ia['initialLife'];
        $this->resultText = '';
    }

    public function render()
    {
        return view('livewire.jo-ken-po');
    }
}
