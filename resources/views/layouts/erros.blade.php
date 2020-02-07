{{-- apresentação dos erros de validação do formulário --}}
@if(count($errors) != 0)
	<div class="alert alert-danger" style="margin-top: 5px">
		@if (count($errors) == 1)
			<p><strong>ERRO: </strong></p> 
		@else
			<p><strong>ERROS: </strong></p> 
		@endif
		<ul>
			@foreach ($errors->all() as $erro)
				<li>{{ $erro }}</li>
			@endforeach
		</ul>
	</div>
@endif
{{-- apresentação dos erros de comunicação com o banco de dados --}}
@if(isset($erros_bd))
	<div class="alert alert-danger" style="margin-top: 5px">
		@foreach ($erros_bd as $erro)
			<p>{{ $erro }}</p>
		@endforeach
	</div>
@endif