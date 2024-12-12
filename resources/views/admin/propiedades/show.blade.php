@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
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
            <ul>
                <li>País: {{$property['country']}}</li>
                <li>Provincia: {{$property['state']}}</li>
                <li>Ciudad: {{$property['city']}}</li>
                <li>Barrio: {{$property['neighborhood']}}</li>
                <li>Link youtube: {{$property['link_youtube']}}</li>
                <li>Link 360: {{$property['link_360']}}</li>
                <li>Metros totales: {{$property['total_meters']}}</li>
                <li>Metros cubiertos: {{$property['covered_meters']}}</li>
                <li>Precio: {{$property['for_sale_price']}}</li>
                <li>Contacto: {{$property['user']['phone_whatsapp']?? $property['user']['email']}}</li>
            </ul>

            <div id="map"></div>
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