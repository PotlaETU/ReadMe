<x-layout>
    <h1>Page personnel de {{$user->name}}</h1>
    <div class="container">
        @auth
        @if (Auth::user()->id === $user->id)
            <div class="container">
                <h2>Mes lectures en cours</h2>
                <div>
                    @forelse($user->lectures as $story)
                        <div class="card">
                            <p>{{$story->titre}}</p>
                            <p>{{$story->pitch}}</p>
                            <img src="{{$story->image}}"/>
                            <a href="{{route("storys.show", $story)}}">Voir l'histoire</a>
                        </div>
                    @empty
                        <p>Pas de lecture en cours</p>
                    @endforelse
                </div>
            </div>
        @endif
        @endauth
        <div class="container">
            <h2>Ses histoires</h2>
            @forelse($user->mesHistoires as $story)
                <div class="card">
                    <img src="{{$story->image}}" alt="Image histoire"/>
                    <p>{{$story->titre}}</p>
                    <p>{{$story->pitch}}</p>
                    <p>{{$story->active ? "Active" : "Non active"}}</p>
                    <a href="{{route("storys.show", $story)}}">Voir l'histoire</a>
                </div>
            @empty
                <p>Aucune histoire créées.</p>
            @endforelse
        </div>
        <div>
        <h2>Ses lectures terminées</h2>
            @if ($user->lectures->isNotEmpty())
                <ul>
                    @foreach ($user->terminees as $histoire)
                        <li>
                            <strong>{{ $histoire->titre }}</strong>
                            <p>Nombre de lectures terminées : {{ $histoire->pivot->nombre}}</p>
                            <a href="{{route("storys.show", $histoire)}}">Voir l'histoire</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Aucune histoire lue pour le moment.</p>
            @endif
        </div>
        <div>
            <h2>Ses avis</h2>
            @if ($user->avis->isNotEmpty())
                <ul>
                    @foreach ($user->avis as $avis)
                        <li>
                            <strong>{{ $avis->histoire->titre }}</strong>
                            <p>{{ $avis->contenu}}</p>
                            <a href="{{route("storys.show", $avis->histoire)}}">Voir l'histoire</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Aucune avis donné.</p>
            @endif
        </div>
    </div>
</x-layout>