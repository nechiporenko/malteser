jQuery(document).ready(function ($) {
    function startGoogleMap() {
        var map = $('#map');
        if ($.inViewport(map)) {//якщо блок з мапою відразу на екрані
            initGoogleMap();//вмикаємо скрипти Гугл мапс
        } else {//якщо ні
            $(window).bind('scroll', checkInView); //відстежуємо скрол
        }

        function checkInView() {//коли промотали до секції з мапою
            if ($.inViewport(map)) {
                $(window).unbind('scroll', checkInView);//вимикаємо відстежування скролу
                initGoogleMap();//вмикаємо скрипти Гугл мапс
            }
        };
    }

    function initGoogleMap() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBpYpmMgxF28K2lXOxV8n7pZYD8OyH2zjk&v=3.exp&sensor=false&' +
				'callback=gmap_draw';

        window.gmap_draw = function () {
            var map_lating = new google.maps.LatLng(50.449754, 30.431529),
                map_options = {
                    zoom: 17,
                    center: map_lating,
                    panControl: false,
                    zoomControl: true,
                    scrollwheel: false,
                    streetViewControl: false,
                    scaleControl: true,
                    mapTypeId: google.maps.MapTypeId.ROAD
                },
                map = new google.maps.Map(document.getElementById('map'), map_options),
                marker = new google.maps.Marker({
                    position: map_lating,
                    icon: "/wp-content/themes/malteser/img/location.png",
                    map: map
                }),
                info = new google.maps.InfoWindow({
                    content: '<span class="g-subtitle">МСД</div>'
                });

            google.maps.event.addListener(marker, 'mouseover', function () {
                info.open(map, marker);
            });

            google.maps.event.addListener(marker, 'mouseout', function () {
                info.close(map, marker);
            });

            google.maps.event.addDomListener(window, 'resize', function () {
                var center = map.getCenter();
                google.maps.event.trigger(map, 'resize');
                map.setCenter(center);
            });
        };

        document.body.appendChild(script);
    };

    if ($('#map').length) {
        startGoogleMap();
    };
});