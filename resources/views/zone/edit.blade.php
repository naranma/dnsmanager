@extends('layouts.app')
@section('conteudo')
<div class="row justify-content-center">
	<form method="POST" action="{{ route('zone.update', $zone)  }}" class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4 col-xs-12" style="padding-top: 7%">
        <h2 class="text-center">Novo DNS</h2>
		<br>
		@include('layouts.erros')
        {{ csrf_field() }}
        @method('PUT')
		<div class="form-group">
		    <label for="">Domínio:</label>
		    <input type="text" class="form-control @error('domain') is-invalid @enderror" id="domain" placeholder="dominio.com" name="domain" value="{{ old('domain', $zone->domain) }}">
		</div>
		<div class="form-group">
            <label>Nome do arquivo:</label>
            <input type="text" class="form-control @error('file') is-invalid @enderror" id="file" placeholder="db.dominio.com" name="file" value="{{ old('file', $zone->file) }}">
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Servidor NS:</label>
                <input type="text" class="form-control @error('name_server') is-invalid @enderror" id="name_server" placeholder="ns1.dominio.com." name="name_server" value="{{ old('name_server', $zone->name_server) }}">
            </div>
            <div class="form-group col-md-6">
                <label>Email:</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="admin.dominio.com." name="email" value="{{ old('email', $zone->email) }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Refresh:</label>
                <input type="number" class="form-control @error('refresh') is-invalid @enderror" id="refresh" placeholder="10800" name="refresh" value="{{ old('refresh', $zone->refresh) }}" >
            </div>
            <div class="form-group col-md-6">
                <label>Retry:</label>
                <input type="number" class="form-control @error('retry') is-invalid @enderror" id="retry" placeholder="3600" name="retry" value="{{ old('retry', $zone->retry) }}" >
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Expire:</label>
                <input type="number" class="form-control @error('expire') is-invalid @enderror" id="expire" placeholder="604800" name="expire" value="{{ old('expire', $zone->expire) }}" >
            </div>
            <div class="form-group col-md-6">
                <label>Minimum TTL:</label>
                <input type="number" class="form-control @error('minimum') is-invalid @enderror" id="minimum" placeholder="86400" name="minimum" value="{{ old('minimum', $zone->minimum) }}" >
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">TTL:</label>
                <input type="number" class="form-control @error('ttl') is-invalid @enderror" id="ttl" placeholder="TTL" name="ttl" value="{{ old('ttl', $zone->ttl) }}">
            </div>
        </div>
		<div class="text-center">
	  		<button type="submit" class="btn btn-primary btn btn-block">Salvar</button>
	  	</div>
	</form>
</div>
@endsection
