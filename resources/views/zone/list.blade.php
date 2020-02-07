@extends('layouts.app')
@section('conteudo')
    <div class="row" style="margin-top: 30%">
        @foreach ($zones as $zone)
            <div class="col-md-4 mb-4">
                <a href="{{ route('zone.show', $zone) }}">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-text text-center">{{ $zone->domain }}</h4>
                    </div>
                    </div>
                </a>
            </div>
        @endforeach
	</div>
@endsection
