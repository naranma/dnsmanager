@extends('layouts.app')
@section('conteudo')
<div class="row justify-content-center">
	<form method="POST" action="{{ route('record.store', $zone) }}" class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4 col-xs-12" style="padding-top: 7%">
        <h2 class="text-center">Nova entrada DNS para {{ $zone->domain }}</h2>
		<br>
		@include('layouts.erros')
        {{ csrf_field() }}

        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Nome:</label>
                <input type="text" class="form-control" id="name" placeholder="Nome" name="name" value="{{ old('name') }}">
            </div>
			<div class="form-group col-md-6">
				<label for="">Tipo:</label>
				<select type="text" class="form-control" name="record_type_id" id="record_type">
                    <option value=""></option>
                    @foreach ($types as $type)
                      <option {{ old('record_type_id') == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
				</select>
			</div>
        </div>

        <div class="row">
			<div class="form-group col-md-6">
				<label for="">TTL:</label>
                <input type="number" class="form-control" id="ttl" placeholder="TTL" name="ttl" value="{{ old('ttl') }}">
			</div>

            <div class="form-group col-md-6" id="priority_div" style="display: none;">
                    <label for="">Prioridade:</label>
                    <input type="number" class="form-control" id="priority" value="{{ old('priority') }}" name="priority">
            </div>
        </div>

		<div class="form-group">
			<label for="">Grupo:</label>
			<button type="button" style="border: none; background-color: transparent; outline: none;" data-toggle="modal" data-target="#exampleModal">
			  <span class="fas fa-plus" style="color: green"></span>
			</button>
		    <select type="text" class="form-control" name="record_group_id" id="record_group_id">
		    	<option value=""></option>
		    	@foreach($groups as $group)
		    		<option {{ old('record_group_id') == $group->id ? 'selected' : '' }} value="{{ $group->id }}">{{ $group->name }}</option>
		    	@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Endereço:</label>
            <input type="text" class="form-control" id="value" placeholder="Endereço" name="value" value="{{ old('value') }}">
		</div>

		<div class="text-center">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('zone.show', $zone) }}" class="btn btn-primary">Cancelar</a>
        </div>
	</form>
</div>
@endsection
