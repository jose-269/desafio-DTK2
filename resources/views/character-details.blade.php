@include('layout.head')
@include('layout.nav')


<div class="container my-5">
	<div class="row">
		<div class="col-md-4">
			<img src="{{$character->image}}" class="img-fluid" alt="">
		</div>
		<div class="col-md-8">
			<ul class="character-details">
				<li class="mb-2">Name: <span class="list-detail">{{$character->name}}</span></li>
				<li class="mb-2">Status: <span class="list-detail">{{$character->status}}</span></li>
				<li class="mb-2">Especie: <span class="list-detail">{{$character->species}}</span></li>
				<li class="mb-2">Origen: <span class="list-detail">{{$character->origin->name}}</span></li>
				<li class="mb-2">Creado: <span class="list-detail">{{$character->created}}</span></li>
			</ul>
		</div>
	</div>
</div>
