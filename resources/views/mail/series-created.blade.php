@component('mail::message')

# {{ $nomeSerie }} foi criada.

A série {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemp }} episódios foi criada com sucesso.

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $idSerie)])

Ver séries

@endcomponent

@endcomponent