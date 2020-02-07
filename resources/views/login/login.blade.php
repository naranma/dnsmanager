@extends('layouts.app')

@section('conteudo')
    <div class="row justify-content-center" style="margin-top: 10%">
        <div>
            <img height="100px" src="{{ asset('images/logo.png') }}">
        </div>
    </div>
	<div class="row justify-content-center">
		<div class="col-md-4 col-md-offset-4	col-sm-8 col-sm-offset-2	col-xs-12">
			@include('layouts.erros')
			<form method="POST" action="{{ route('auth') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="id_text_usuario">Usuário:</label>
					<input class="form-control" type="text" id="user" name="user" placeholder="Usuário">
				</div>
				<div class="form-group">
					<label for="id_text_senha">Senha:</label>
					<input class="form-control" type="password" id="password" name="password" placeholder="Senha">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-primary btn btn-block">Entrar</button>
				</div>
			</form>
		</div>
	</div>
@endsection
