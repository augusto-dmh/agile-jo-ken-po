<div wire:poll.5s>
    <a href="{{route('home')}}" class="absolute bottom-10 right-10">
        <img src="{{asset('storage/logo.png')}}" class="h-28 w-52">
    </a>
    <div class="flex flex-col items-center mt-8">
        <h1 class="mb-4 text-2xl text-white font-pixelify">Leaderboard</h1>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Simple Mode Victories</th>
                    <th class="px-4 py-2 border-b">X2 Luck Mode Victories</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $user->simple_mode_victories }}</td>
                        <td class="px-4 py-2 border-b">{{ $user->x2_luck_mode_victories }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
