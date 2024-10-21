<div class="absolute flex flex-col px-12 transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
    <a href="{{route('home')}}" class="absolute top-[-250px] right-[-575px]">
        <img src="{{asset('storage/logo.png')}}" class="h-28 w-52">
    </a>
    <div class="flex items-center justify-center">
    </div>
    <div class="flex justify-center">
        <div class="relative player-wrapper">
            <div class="absolute px-8 py-4 transform border-4 rounded-full w-80 top-56 border-green-50 left-[350px]">
                <p class="my-1 text-lg text-white font-pixelify">
                    Player
                </p>
                <div class="flex gap-1">
                    @for($i = 0; $i < $player['life']['current']; $i++)
                    <img src="{{asset('storage/heart.png')}}" class="w-6 h-5 float">
                    @endfor
                    @for($i = 0; $i < $this->playerLifeTaken; $i++)
                    <img src="{{asset('storage/heart.png')}}" class="w-6 h-5 float filter brightness-0">
                    @endfor
                </div>
            </div>
            <div class="relative flex items-center justify-center transform rotate-90 player-hand-wrapper w-72 h-72 top-64 right-48">
                @if($this->showHands) <img src="{{ $player['hand'] }}" wire:loading.class="fade-out" class="absolute object-contain w-auto h-auto player-hand hand"/> @endif
                @if($this->showDices) <img src="{{ $player['dice'] ?: $dices['initial'] }}" class="absolute w-28 h-28 top-72"/> @endif
            </div>
        </div>

        <div class="relative ia-wrapper">
            <div class="absolute px-8 py-4 transform border-4 rounded-full w-80 bottom-72 border-green-50 right-96">
                <p class="my-1 text-lg text-white font-pixelify">
                    IA
                </p>
                <div class="flex gap-1">
                    @for($i = 0; $i < $ia['life']['current']; $i++)
                    <img src="{{asset('storage/heart.png')}}" class="w-6 h-5 float">
                    @endfor
                    @for($i = 0; $i < $this->iaLifeTaken; $i++)
                    <img src="{{asset('storage/heart.png')}}" class="w-6 h-5 float filter brightness-0">
                    @endfor
                </div>
            </div>
            <div class="relative flex items-center justify-center transform -rotate-90 left-32 bottom-40 ia-hand-wrapper w-72 h-72">
                @if($this->showHands) <img src="{{ $ia['hand'] }}" wire:loading.class="fade-out" class="absolute object-contain w-auto h-auto ia-hand hand"/> @endif
                @if($this->showDices) <img src="{{ $ia['dice'] ?: $dices['initial'] }}" class="absolute w-28 h-28 top-72"/> @endif
            </div>
        </div>
    </div>

    <div class="absolute flex justify-between px-8 py-4 m-auto mt-8 border-4 border-green-500 rounded-full left-[400px] top-[300px] w-80 jokenpo-btns-wrapper">
        <button type="button" wire:click="playFirstRound('rock')" @if($player['life']['current'] < 1 || $ia['life']['current'] < 1 || $this->showDices) disabled @endif class="w-16 h-16 rock-btn">
            <img src="{{ asset('storage/hands/player/rock.png') }}" alt="Rock" class="inline-block w-full h-full">
        </button>
        <button type="button" wire:click="playFirstRound('paper')" @if($player['life']['current'] < 1 || $ia['life']['current'] < 1 || $this->showDices) disabled @endif class="w-16 h-16 paper-btn">
            <img src="{{ asset('storage/hands/player/paper.png') }}" alt="Paper" class="inline-block w-full h-full">
        </button>
        <button type="button" wire:click="playFirstRound('scissors')" @if($player['life']['current'] < 1 || $ia['life']['current'] < 1 || $this->showDices) disabled @endif class="w-16 h-16 scissors-btn">
            <img src="{{ asset('storage/hands/player/scissors.png') }}" alt="Scissors" class="inline-block w-full h-full">
        </button>
    </div>

    <div class="flex flex-col items-center mt-8 mr-32">
        <div class="py-2 text-center result-wrapper">
            <p
            @class([
                'font-pixelify',
                'text-lg',
                'text-lightgreen' => $resultText === 'Player won first round' || $resultText === 'Player attacked and damaged IA' || $resultText === 'Player defended himself against IA attack',
                'text-lightcoral' => $resultText === 'IA won first round' || $resultText === 'IA attacked and damaged player' || $resultText === 'IA defended himself against player attack',
                'text-yellow' => $resultText === 'Draw!',
                'w-60'
                ])
                wire:loading.class="fade-out"
            >
                @if($player['life']['current'] > 1 && $ia['life']['current'] > 1)
                    {{ $resultText }}
                @else
                    @if($winnerFirstRound && $winnerFirstRound === $player['hand'] && !($pausedTime === 'continue'))
                        <p class='text-lg text-white font-pixelify'>Roll the dice to hit the AI!</p>
                    @elseif($winnerFirstRound && $winnerFirstRound === $ia['hand'] && !($pausedTime === 'continue'))
                        <p class='text-lg text-white font-pixelify'>Roll the dice to defend yourself against AI!</p>
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
