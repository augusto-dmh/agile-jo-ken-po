<div class="flex flex-col px-12">
    <div class="flex justify-center">
        <div class="relative player-wrapper">
            <p class="absolute font-sans text-lg text-white transform -translate-x-1/2 left-1/2">
                Player
            </p>
            <div class="flex items-center justify-center transform rotate-90 player-hand-wrapper w-72 h-72">
                <img @if($playerHand) src="{{ $playerHand }}" @endif class="w-3/4 player-hand hand h-3/4" />
            </div>
        </div>

        <div class="relative player-wrapper">
            <p class="absolute font-sans text-lg text-white transform -translate-x-1/2 left-1/2">
                IA
            </p>
            <div class="flex items-center justify-center transform -rotate-90 ia-hand-wrapper w-72 h-72">
                <img @if($iaHand) src="{{ $iaHand }}" @endif class="w-3/4 ia-hand hand h-3/4" />
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-12 mt-8 jokenpo-btns-wrapper">
        <button type="button" wire:click="play('rock')" class="text-black bg-gray-100 rounded shadow rock-btn hover:bg-gray-200">rock</button>
        <button type="button" wire:click="play('paper')" class="text-black bg-gray-100 rounded shadow paper-btn hover:bg-gray-200">paper</button>
        <button type="button" wire:click="play('scissors')" class="text-black bg-gray-100 rounded shadow scissors-btn hover:bg-gray-200">scissors</button>
    </div>

    <div class="flex justify-center mt-8 result-wrapper">
        <p
        @class([
            'font-sans',
            'text-lg',
            'text-lightgreen' => $resultText === 'Player won!',
            'text-lightcoral' => $resultText === 'IA won!',
            'text-yellow' => $resultText === 'Draw!',
            ])
        class="resultText"
        >
            {{ $resultText }}
        </p>
    </div>
</div>

@script
<script>
    const jokenpoBtns = Array.from(document.querySelector('.jokenpo-btns-wrapper').children);

    const playerHand = document.querySelector('.player-hand');
    const iaHand = document.querySelector('.ia-hand');

    jokenpoBtns.forEach((button) => {
        button.addEventListener('click', () => {
            toggleHands();
        });
    });

    function toggleHands() {
        playerHand.classList.toggle('fade-out');
        iaHand.classList.toggle('fade-out');
    }
</script>
@endscript
