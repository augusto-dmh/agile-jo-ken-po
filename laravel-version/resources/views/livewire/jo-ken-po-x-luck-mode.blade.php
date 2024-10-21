<div class="absolute flex flex-col px-12 transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
    <div class="flex items-center justify-center">
    </div>
    <div class="flex justify-center">
        <div class="relative player-wrapper">
            <div class="absolute transform -translate-x-1/2 left-1/2">
                <p class="font-sans text-lg text-center text-white">
                    Player
                </p>
                <div class="flex gap-2">
                    @for($i = 0; $i < $player['life']['current']; $i++)
                    <i class="text-red-500 fas fa-heart float" wire:loading.class="fade-out"></i>
                    @endfor
                    @for($i = 0; $i < $this->playerLifeTaken; $i++)
                    <i class="text-black fas fa-heart" wire:loading.class="fade-out"></i>
                    @endfor
                </div>
            </div>
            <div class="relative flex items-center justify-center transform rotate-90 player-hand-wrapper w-72 h-72">
                @if($this->showHands) <img src="{{ $player['hand'] }}" wire:loading.class="fade-out" class="w-3/4 player-hand hand h-3/4"/> @endif
                @if($this->showDices) <img src="{{ $player['dice'] ?: $dices['initial'] }}" class="absolute w-28 h-28 top-72"/> @endif
            </div>
        </div>

        <div class="relative ia-wrapper">
            <div class="absolute transform -translate-x-1/2 left-1/2">
                <p class="font-sans text-lg text-center text-white">
                    IA
                </p>
                <div class="flex gap-2">
                    @for($i = 0; $i < $ia['life']['current']; $i++)
                    <i class="text-red-500 fas fa-heart float" wire:loading.class="fade-out"></i>
                    @endfor
                    @for($i = 0; $i < $this->iaLifeTaken; $i++)
                    <i class="text-black fas fa-heart" wire:loading.class="fade-out"></i>
                    @endfor
                </div>
            </div>
            <div class="relative flex items-center justify-center transform -rotate-90 ia-hand-wrapper w-72 h-72">
                @if($this->showHands) <img src="{{ $ia['hand'] }}" wire:loading.class="fade-out" class="w-3/4 ia-hand hand h-3/4"/> @endif
                @if($this->showDices) <img src="{{ $ia['dice'] ?: $dices['initial'] }}" class="absolute w-28 h-28 top-72"/> @endif
            </div>
        </div>
    </div>

    <div class="flex w-full max-w-2xl gap-10 m-auto mt-8 jokenpo-btns-wrapper">
        <button type="button" wire:click="playFirstRound('rock')" @if($player['life']['current'] < 1 || $ia['life']['current'] < 1 || $this->showDices) disabled @endif class="w-full text-black bg-gray-100 rounded shadow rock-btn hover:bg-gray-200">rock</button>
        <button type="button" wire:click="playFirstRound('paper')" @if($player['life']['current'] < 1 || $ia['life']['current'] < 1 || $this->showDices) disabled @endif class="w-full text-black bg-gray-100 rounded shadow paper-btn hover:bg-gray-200">paper</button>
        <button type="button" wire:click="playFirstRound('scissors')" @if($player['life']['current'] < 1 || $ia['life']['current'] < 1 || $this->showDices) disabled @endif class="w-full text-black bg-gray-100 rounded shadow scissors-btn hover:bg-gray-200">scissors</button>
    </div>

    <div class="flex flex-col items-center mt-8">
        <div class="py-2 text-center result-wrapper">
            <p
            @class([
                'font-sans',
                'text-lg',
                'text-lightgreen' => $resultText === 'Player won first round' || $resultText === 'Player attacked and damaged IA' || $resultText === 'Player defended himself against IA attack',
                'text-lightcoral' => $resultText === 'IA won first round' || $resultText === 'IA attacked and damaged player' || $resultText === 'IA defended himself against player attack',
                'text-yellow' => $resultText === 'Draw!',
                ])
                wire:loading.class="fade-out"
            >
                @if($player['life']['current'] > 1 && $ia['life']['current'] > 1)
                    {{ $resultText }}
                @else
                    @if($winnerFirstRound && $winnerFirstRound === $player['hand'] && !($pausedTime === 'continue'))
                        <p class='font-sans text-lg text-white'>Roll the dice to hit the AI!</p>
                    @elseif($winnerFirstRound && $winnerFirstRound === $ia['hand'] && !($pausedTime === 'continue'))
                        <p class='font-sans text-lg text-white'>Roll the dice to defend yourself against AI!</p>
                    @else
                        {{$player['life']['current'] < 1 && 'IA won the game.'}}
                        {{$ia['life']['current'] < 1 && 'Player won the game.'}}
                    @endif
                @endif

            </p>
        </div>
        @if($player['life']['current'] < 1 || $ia['life']['current'] < 1)
            <button type="button" wire:click="retry" class="px-4 py-3 mt-5 text-3xl font-medium text-gray-900 bg-white border border-gray-200 rounded-full me-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <i class="fas fa-redo"></i>
            </button>
        @endif
        @if($this->showDices && !$isContinueTime)
            <button type="button" wire:click="playSecondRound()" class="px-4 py-3 mt-5 text-2xl font-medium text-gray-900 bg-white border border-gray-200 rounded-full me-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <i class="fas fa-dice"></i>
            </button>
        @endif
        @if($isContinueTime)
            <button type="button" wire:click="continueGame()" class="px-4 py-3 mt-5 text-2xl font-medium text-gray-900 bg-white border border-gray-200 rounded-full me-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <i class="fas fa-arrow-right"></i> Continue
            </button>
        @endif
    </div>

</div>
