@extends('layouts.app')
@section('conteudo')
<h2 class="text-center" style="margin-top: 50px">DNS - {{ $zone->domain }}</h2>
@if (session('sucesso'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('sucesso') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<div class="row">
  <div class="col-md-6 col-md-offset-0  col-sm-8 col-sm-offset-3 col-xs-12">
    <input id="filter" type="text" class="form-control col-md-6" placeholder="Buscar...">
  </div>
  <div class="col-md-6 col-md-offset-0  col-sm-8 col-sm-offset-3 col-xs-12 text-right">
    <a class="btn btn-success" href="{{ route('record.create', $zone) }}">Nova entrada</a>
  </div>
</div>
<br>
<div class="panel panel-default">
  <div class="panel-body" style="background-color: #F7F7F7; border-radius: 5px">
<table class="table  table-sm table-bordered">
  <thead class="thead-active">
    @foreach($groups as $group)
      @if(count($group->records))
        <tr>
          <th scope="col">Grupo: {{ $group->name }}</th>
          <th scope="col">Tipo</th>
          <th scope="col">TTL</th>
          <th scope="col">Prioridade</th>
          <th scope="col">Endereço</th>
          <th scope="col">Opções</th>
        </tr>
      </thead>
      <tbody id="recordTable">
          @foreach($group->records as $record)
            <tr class="table table-light">
                <td scope="row" id="nome{{$record->id}}">{{$record->name}}</td>
                <td scope="row">{{ $record->type->name }}</td>
                <td scope="row">{{$record->ttl}}</td>
                <td scope="row">{{$record->priority}}</td>
                <td scope="row" style="max-width: 580px;word-wrap: break-word;">{{$record->value}}</td>
                <td scope="row">
                  <a href="{{ route('record.edit', [$zone->id, $record]) }}">
                    <span class="fas fa-pencil-alt" style="color: #3b5998; margin-left: 5px; margin-right: 5px;"></span>
                  </a>
                  @if($record->active)
                  <a data-id="{{ $record->id }}" href="{{ route('record.active', [$zone->id, $record]) }}" class="status" style="border: none; background-color: transparent;">
                    <span class="fas fa-power-off" style="color: green" id="{{ $record->id }}"></span>
                  </a>
                  @else
                  <a data-id="{{ $record->id }}" href="{{ route('record.active', [$zone->id, $record]) }}" class="status" style="border: none; background-color: transparent; outline: none;">
                    <span class="fas fa-power-off" style="color: red" id="{{ $record->id }}"></span>
                  </a>
                  @endif
                </td>
            </tr>
          @endforeach
        @endif
      @endforeach
  </tbody>
</table>
</div>
</div>
@endsection
