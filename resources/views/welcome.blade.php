@extends('layouts.app')

@section('content')
<style>
#map {
  height: 100%;
}
div.fill {
    min-height: 100%;
    height: 100%;
}
.container {
    margin-top: -72px;
    padding-top: 72px;
}
</style>
<div class="container fill">
    <div class="row fill">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Map</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main fill">
            <div id="map"></div>
        </div>
    </div>
</div>
<script>
    
    var map;
    var markers = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 6
        });

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(pos);
            });
        }

        var fishRecords = {!! $fishRecords !!}
        _.forEach(fishRecords, function(record){
            addMarkerWithTimeout({lat: record.latitude, lng: record.longitude});
        });
    }

    function addMarkerWithTimeout(position, timeout) {
        window.setTimeout(function() {
            markers.push(new google.maps.Marker({
            position: position,
            map: map,
            animation: google.maps.Animation.DROP
            }));
        }, timeout);
        }

    function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCVOG_shY27S_mrnPzsdNlD-uM6WIBLTA&callback=initMap"></script>


@endsection