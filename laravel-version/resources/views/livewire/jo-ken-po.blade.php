<div style="display: flex; flex-direction: column; padding: 0 50px">
    <div style="display: flex; justify-content: center">
        <div class="player-wrapper" style="position: relative">
            <p style="position: absolute; left: 50%; transform: translateX(-50%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white; font-size: 20px;">
                Player
            </p>
            <div class="player-hand-wrapper" style="width: 300px; height: 300px; transform: rotate(90deg); display: flex; justify-content: center; align-items: center;">
                <img @if($playerHand) src="{{ $playerHand }}" @endif class="player-hand hand" style="width: 75%; height: 75%;" />
            </div>
        </div>

        <div class="player-wrapper" style="position: relative">
            <p style="position: absolute; left: 50%; transform: translateX(-50%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white; font-size: 20px;">
                IA
            </p>
            <div class="ia-hand-wrapper" style="width: 300px; height: 300px; transform: rotate(-90deg); display: flex; justify-content: center; align-items: center;">
                <img @if($iaHand) src="{{ $iaHand }}" @endif class="ia-hand hand" style="width: 75%; height: 75%;" />
            </div>
        </div>
    </div>

    <div class="jokenpo-btns-wrapper" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 50px">
        <button type="button" wire:click="play('rock')" class="rock-btn">rock</button>
        <button type="button" wire:click="play('paper')" class="paper-btn">paper</button>
        <button type="button" wire:click="play('scissors')" class="scissors-btn">scissors</button>
    </div>

    <div class="result-wrapper" style="display: flex; justify-content: center">
        <p
        @style([
            'font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif',
            'font-size: 20px',
            'color: lightgreen' => $resultText === 'Player won!',
            'color: lightcoral' => $resultText === 'IA won!',
            'color: yellow' => $resultText === 'Draw!',
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
