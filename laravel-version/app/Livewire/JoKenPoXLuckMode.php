<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;

class JoKenPoXLuckMode extends Component
{
    public $hands;
    public $dices;
    public $player;
    public $ia;
    public $resultText;
    public $isContinueTime;
    public $firstRoundWinner;

    #[Computed]
    public function playerLifeTaken() {
        if (!$this->player['life']) return 0;

        return $this->player['life']['initial'] - $this->player['life']['current'];
    }

    #[Computed]
    public function iaLifeTaken() {
        if (!$this->ia['life']) return 0;

        return $this->ia['life']['initial'] - $this->ia['life']['current'];
    }

    #[Computed]
    public function showHands() {
        return $this->player['hand'] && $this->ia['hand'];
    }

    #[Computed]
    public function showDices() {
        return $this->firstRoundWinner;
    }

    public function mount() {
        $this->hands = [
            'rock' => asset('storage/hands/rock.png'),
            'paper' => asset('storage/hands/paper.png'),
            'scissors' => asset('storage/hands/scissors.png'),
        ];
        $this->dices = [
            'initial' => asset('storage/dices/initial.png'),
            '1' => asset('storage/dices/1.gif'),
            '2' => asset('storage/dices/2.gif'),
            '3' => asset('storage/dices/3.gif'),
            '4' => asset('storage/dices/4.gif'),
            '5' => asset('storage/dices/5.gif'),
            '6' => asset('storage/dices/6.gif'),
        ];
        $this->player = [
            'hand' => null,
            'life' => [
                'initial' => 5,
                'current' => 5,
            ],
            'dice' => null,
        ];
        $this->ia = [
            'hand' => null,
            'life' => [
                'initial' => 5,
                'current' => 5,
            ],
            'dice' => null,
        ];
        $this->isContinueTime = false;
    }

    public function playFirstRound($playerChoice)
    {
        $this->player['hand'] = $this->hands[$playerChoice];
        $iaChoice = array_rand($this->hands);
        $this->ia['hand'] = $this->hands[$iaChoice];

        if ($playerChoice === $iaChoice) {
            $this->resultText = 'Draw!';
        } else {
            switch ($playerChoice) {
                case 'rock':
                    if ($iaChoice === 'scissors') {
                        $this->resultText = 'Player won first round';
                        $this->firstRoundWinner = $this->player['hand'];
                    } else {
                        $this->resultText = 'IA won first round';
                        $this->firstRoundWinner = $this->ia['hand'];
                    }
                    break;
                case 'paper':
                    if ($iaChoice === 'rock') {
                        $this->resultText = 'Player won first round';
                        $this->firstRoundWinner = $this->player['hand'];
                    } else {
                        $this->resultText = 'IA won first round';
                        $this->firstRoundWinner = $this->ia['hand'];
                    }
                    break;
                case 'scissors':
                    if ($iaChoice === 'paper') {
                        $this->resultText = 'Player won first round';
                        $this->firstRoundWinner = $this->player['hand'];
                    } else {
                        $this->resultText = 'IA won first round';
                        $this->firstRoundWinner = $this->ia['hand'];
                    }
            }
        }
    }

    public function playSecondRound() {
        $playerDiceNumber = random_int(1, 6);
        $iaDiceNumber = random_int(1, 6);

        $this->player['dice'] = $this->dices[$playerDiceNumber];
        $this->ia['dice'] = $this->dices[$iaDiceNumber];

        if ($this->firstRoundWinner === $this->player['hand']) {
            if ($playerDiceNumber > $iaDiceNumber) {
                $this->resultText = 'Player attacked and damaged IA';
                $this->removeLife($this->ia['hand']);
            } else if ($playerDiceNumber < $iaDiceNumber) {
                $this->resultText = 'IA defended himself against player attack';
            } else {
                $this->resultText = 'Draw!';
                return;
            }
        } else if ($this->firstRoundWinner === $this->ia['hand']) {
            if ($playerDiceNumber > $iaDiceNumber) {
                $this->resultText = 'Player defended himself against IA attack';
            } else if ($playerDiceNumber < $iaDiceNumber) {
                $this->resultText = 'IA attacked and damaged player';
                $this->removeLife($this->player['hand']);
            } else {
                $this->resultText = 'Draw!';
                return;
            }
        }

        $this->isContinueTime = true;
    }

    public function continueGame() {
        $this->isContinueTime = false;
        $this->player['dice'] = null;
        $this->ia['dice'] = null;
        $this->firstRoundWinner = null;
        $this->resultText = '';
    }

    public function removeLife($hand) {
        $hand === $this->player['hand']
        ? ($this->player['life']['current'] -= 1)
        : ($this->ia['life']['current'] -= 1);
    }

    public function retry() {
        $this->player['life']['current'] = $this->player['life']['initial'];
        $this->ia['life']['current'] = $this->ia['life']['initial'];
        $this->resultText = '';
    }

    public function render()
    {
        return view('livewire.jo-ken-po-x-luck-mode');
    }
}
