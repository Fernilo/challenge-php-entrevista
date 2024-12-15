@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-9">
            <div id="carouselExampleIndicators" class="carousel slide mb-3" style="height: 600px; width: 100%; overflow: hidden;" data-bs-ride="true">
                <div class="carousel-indicators">
                    @foreach ($property['images_list'] as $i => $image)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}" @if ($i === 0)  class="active" @endif  aria-current="true" aria-label="{{'Slide '. $i}}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($property['images_list'] as $i => $image)
                        <div class="carousel-item img-fluid @if ($i === 0) active @endif">
                            <img src="{{$image['md']}}" class="d-block w-100" style="height: auto; max-height: 800px;" alt="{{$image['title']}}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
            <h3>{{$property['title']}}</h3>
            <p>
                {{$property['description']}}
            </p>
            <div id="map"></div>
        </div>
        <div class="col-3">
            <h5 class="fw-bold">Información adcional:</h5>
            <ul class="list-group">
                <li class="list-group-item fw-semibold">País: {{$property['country']}}</li>
                <li class="list-group-item fw-semibold fw-semibold">Provincia: {{$property['state']}}</li>
                <li class="list-group-item fw-semibold">Ciudad: {{$property['city']}}</li>
                <li class="list-group-item fw-semibold">Barrio: {{$property['neighborhood']}}</li>
                <li class="list-group-item fw-semibold">Link youtube: {{$property['link_youtube']}}</li>
                <li class="list-group-item fw-semibold">Link 360: {{$property['link_360']}}</li>
                <li class="list-group-item fw-semibold">Metros totales: {{$property['total_meters']}}</li>
                <li class="list-group-item fw-semibold">Metros cubiertos: {{$property['covered_meters']}}</li>
                <li class="list-group-item fw-semibold">Precio: {{$property['for_sale_price']}}</li>
                <li class="list-group-item fw-semibold">Contacto: {{$property['user']['phone_whatsapp']?? $property['user']['email']}}</li>
            </ul>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Consultar sobre esta propiedad
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Complete los campos requeridos *</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('propiedades.sendMessage') }}" method="post">
                @csrf
                    <div class="modal-body">
                        <input type="hidden" name="property_id" value="{{$property['id']}}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Mensaje *</label>
                            <textarea name="body" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enviar consulta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @vite(['resources/css/map-styles.css'])
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}"></script>
    <script>
        function initMap() {
            var propertyLocation = { lat: {{ $property['geo']['lat'] }}, lng: {{ $property['geo']['lon'] }} };
    
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: propertyLocation
            });
    
            var marker = new google.maps.Marker({
                position: propertyLocation,
                map: map,
                title: 'Ubicación'
            });
        }
    
        google.maps.event.addDomListener(window, 'load', initMap);

    </script>
@endsection