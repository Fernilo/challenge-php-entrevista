@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <h1 class="text-center">Listado de propiedades</h1>

                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($properties as $property)
                        <div class="col">
                            <div class="card">
                                <img src="{{ isset($property['images_list'][0]['md'])??   }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $property['title']?? 'Propiedad' }}</h5>
                                    <p class="card-text">{{ $property['description']?? 'Descripción' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
