@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="text-center mb-3">Listado de propiedades</h1>

            @if ($properties)
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($properties as $property)
                        <div class="col">
                            <a href="{{ route('propiedades.show', $property['id']) }}">
                                <div class="card">
                                    <img src="{{ isset($property['images_list'][0]['md'])?  $property['images_list'][0]['md'] :  asset('storage/images/default.png')}}" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $property['title']?? 'Propiedad' }}</h5>
                                        <p class="card-text">{{ $property['description'] ? substr($property['description'], 0, 100) : 'Descripción' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-3">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="row">
                    <div class="col">
                        <p class="text-center fs-4">No hay propiedades disponibles</p>                            
                    </div>
                </div>
            @endif
        </div>
    </div>
 
@endsection
