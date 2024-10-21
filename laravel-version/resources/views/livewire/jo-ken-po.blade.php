<div class="absolute flex flex-col px-12 transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
    <a href="{{route('home')}}" class="absolute top-[-250px] right-[-575px]">
        <img src="{{asset('storage/logo.png')}}" class="h-28 w-52">
    </a>
    <div class="flex items-center justify-center">
    </div>
    <div class="flex justify-center">
        <div class="relative player-wrapper">
            <div class="absolute px-8 py-4 transform border-4 rounded-full w-80 top-56 border-green-50 left-[350px]">
                <p class="my-1 text-lg text-center text-white font-pixelify">
                    Player
                </p>
                <div class="flex gap-1">
                    @for($i = 0; $i < $player['currentLife']; $i++)
                    <img src="{{asset('storage/heart.png')}}" class="w-6 h-5 float">
                    @endfor
                    @for($i = 0; $i < $this->playerLifeTaken; $i++)
                    <img src="{{asset('storage/heart.png')}}" class="w-6 h-5 float filter brightness-0">
                    @endfor
                </div>
            </div>
            <div class="relative flex items-center justify-center transform rotate-90 player-hand-wrapper w-72 h-72 top-64 right-48">
                @if($player['hand']) <img src="{{ $player['hand'] }}" wire:loading.class="fade-out" class="object-contain w-auto h-auto player-hand hand"/> @endif
            </div>
        </div>

        <div class="relative ia-wrapper">
            <div class="absolute px-8 py-4 transform border-4 rounded-full w-80 bottom-72 border-green-50 right-96">
                <p class="my-1 text-lg text-center text-white font-pixelify">
                    IA
                </p>
                <div class="flex gap-1">
                    @for($i = 0; $i < $ia['currentLife']; $i++)
                    <img src="{{asset('storage/heart.png')}}" class="w-6 h-5 float">
                    @endfor
                    @for($i = 0; $i < $this->iaLifeTaken; $i++)
                    <img src="{{asset('storage/heart.png')}}" class="w-6 h-5 float filter brightness-0">
                    @endfor
                </div>
            </div>
            <div class="relative flex items-center justify-center transform -rotate-90 ia-hand-wrapper w-72 h-72 left-32 bottom-40">
                @if($ia['hand']) <img src="{{ $ia['hand'] }}" wire:loading.class="fade-out" class="object-contain w-auto h-auto ia-hand hand"/> @endif
            </div>
        </div>
    </div>

    <div class="absolute flex justify-between px-8 py-4 m-auto mt-8 border-4 border-green-500 rounded-full left-[400px] top-[300px] w-80 jokenpo-btns-wrapper">
        <button type="button" wire:click="play('rock')" @if($player['currentLife'] < 1 || $ia['currentLife'] < 1) disabled @endif class="w-16 h-16 rock-btn">
            <img src="{{ asset('storage/hands/player/rock.png') }}" alt="Rock" class="inline-block w-full h-full">
        </button>
        <button type="button" wire:click="play('paper')" @if($player['currentLife'] < 1 || $ia['currentLife'] < 1) disabled @endif class="w-16 h-16 paper-btn">
            <img src="{{ asset('storage/hands/player/paper.png') }}" alt="Paper" class="inline-block w-full h-full">
        </button>
        <button type="button" wire:click="play('scissors')" @if($player['currentLife'] < 1 || $ia['currentLife'] < 1) disabled @endif class="w-16 h-16 scissors-btn">
            <img src="{{ asset('storage/hands/player/scissors.png') }}" alt="Scissors" class="inline-block w-full h-full">
        </button>
    </div>

    <div class="flex flex-col items-center mt-8 mr-32">
        <div class="py-2 text-center result-wrapper">
            <p
            @class([
                'font-pixelify',
                'text-lg',
                'text-lightgreen' => $resultText === 'Player won!',
                'text-lightcoral' => $resultText === 'IA won!',
                'text-yellow' => $resultText === 'Draw!',
                'w-60',
                'font-pixelify'
                ])
                wire:loading.class="fade-out"
            >
                {{ $resultText }}
            </p>
        </div>
        @if($player['currentLife'] < 1 || $ia['currentLife'] < 1)
            <button type="button" wire:click="retry" class="px-4 py-3 mt-5 text-3xl font-medium text-gray-900 bg-white border border-gray-200 rounded-full me-2 focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                <i class="fas fa-redo"></i>
            </button>
        @endif
    </div>
</div>
