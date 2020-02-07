@extends('layouts.app')
@section('conteudo')
@include('layouts.erros')
<div class="row justify-content-center">
	<form method="POST" action="{{ route('record.update', [$zone, $record]) }}" class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-2 col-xs-12" style="padding-top: 7%">
        <h2 class="text-center">Editar Entrada DNS - {{ $zone->domain }}</h2>
		<br>
        {{ csrf_field() }}
        @method('PUT')
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Nome:</label>
                <input type="text" class="form-control" id="name" value="{{ old('name',$record->name) }}" name="name">
            </div>
			<div class="form-group col-md-6">
				<label for="">Tipo:</label>
				<select type="text" class="form-control" name="record_type_id" id="record_type">
                    @foreach ($types as $type)
                        <option {{ old('record_type_id', $record->type->id) == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
				</select>
			</div>
        </div>
        <div class="row">
			<div class="form-group  col-md-6">
					<label for="">TTL:</label>
					<input type="number" class="form-control" id="ttl" value="{{ old('ttl', $record->ttl) }}" name="ttl">
			</div>
            <div class="form-group  col-md-6" id="priority_div" style="display: none;">
                    <label for="">Prioridade:</label>
                    <input type="number" class="form-control" id="priority" value="{{ old('priority', $record->priority) }}" name="priority">
            </div>

        </div>
            <div class="form-group">
                <label for="">Grupo:</label>
                <select type="text" class="form-control" name="record_group_id" id="record_group_id">
                    <option value="">Selecione</option>
                    @foreach($groups as $group)
                        <option {{ old('record_group_id', $record->group->id) == $group->id ? 'selected' : '' }} value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
        </div>

		<div class="form-group">
			<label>Endereço:</label>
			<input type="text" class="form-control" id="value" value="{{ old('value', $record->value) }}" name="value" class="value">
        </div>

		<div class="text-center">
	  		<button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('zone.show', $zone) }}" class="btn btn-primary">Cancelar</a>
	  	</div>
	</form>
</div>
@endsection
