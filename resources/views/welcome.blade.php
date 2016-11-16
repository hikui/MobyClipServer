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
    var fishRecords = {!! $fishRecords !!}

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 6
        });

        var infowindow = new google.maps.InfoWindow();
        var markers = [];
        var addMarkerWithTimeout = function(record, timeout) {
            window.setTimeout(function() {
                var position = {lat: record.latitude, lng: record.longitude};
                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    animation: google.maps.Animation.DROP
                });
                markers.push(marker);
                marker.addListener('click', function() {
                    infowindow.setContent(record.fish_type.name);
                    infowindow.open(map, marker);
                });
            }, timeout);
        }

        var clearMarkers = function() {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            markers = [];
        }

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
        _.forEach(fishRecords, function(record){
            addMarkerWithTimeout(record);
        });
    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCVOG_shY27S_mrnPzsdNlD-uM6WIBLTA&callback=initMap"></script>


@endsection