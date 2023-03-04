
	@include('layout.head')
	@include('layout.nav')
    <body class="antialiased">
        

				<div class="container my-5">
					<form method="GET" action="{{ route('index') }}" class="mb-4">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6 mb-3">
									<select class="form-select" name="origin" aria-label="Default select example">
										<option selected value="">Origen</option>
										@foreach ($origins as $origin)
										<option value="{{$origin}}">{{$origin}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6 mb-3">
									<select class="form-select" name="status" aria-label="Default select example">
										<option selected value="">Status</option>
										@foreach ($statuses as $status)
										<option value="{{$status}}">{{$status}}</option>
										@endforeach
									</select>

								</div>
							</div>
						</div>
						<div class="col-12 text-center">
							<button type="submit" class="btn btn-rym">Filtrar</button>
						</div>
					</form>
					<div class="row">

						@foreach ($characters as $character)
						<div class="col-md-4 mb-3">
							<div class="card h-100" >
								<a href="{{route('character.details', ['id' => $character->id])}}">
									<img src="{{ $character->image }}" class="card-img-top" alt="...">
								</a>
								<div class="card-body h-100 d-flex flex-column">
									<h5 class="card-title fw-bold">{{ $character->name }}</h5>
									<div class="d-flex justify-content-around">
										@php
											$origin = $character->origin;
										@endphp
										<p class="car-text">{{ $origin->name }}</p>
										<p class="car-text">{{ $character->status }}</p>

									</div>
									<div class="mt-auto">
										<a href="{{route('character.details', ['id' => $character->id])}}" class="btn btn-rym w-100">Go somewhere</a>
									</div>
								</div>
							</div>
						</div>
						@endforeach		
						
					</div>
					<div class="col-12">
						<div class="d-flex flex-column justify-content-center mt-4">
							{!! $characters->links('pagination::bootstrap-5') !!}
						</div>
					</div>
				</div>

        </div>
    </body>
</html>
