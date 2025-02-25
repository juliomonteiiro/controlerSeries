<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
            <img class="me-3" src="{{  $serie->cover ? asset('storage/' . $serie->cover) : asset('storage/series_cover/candy.png') }}" 
                style="height: 50px"
                alt="Capa da série" 
                class="img-thumbnail">
            @auth <a href="{{ route('seasons.index', $serie->id) }}"> @endauth
                {{ $serie->nome }}
            @auth </a> @endauth
            </div>

            @auth
            <span class="d-flex">
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">
                    E
                </a>

                <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        X
                    </button>
                </form>
            </span>
            @endauth
        </li>
        @endforeach
    </ul>
</x-layout>
