$(function() {
    ymaps.ready(function() {
        $('.tab-map .tab').each(function() {
            var $cont = $(this);

            var map = new ymaps.Map($cont.find('.frame')[0], {
                center: [55.74954, 37.621587],
                zoom: 10,
                behaviors: [],
                controls: [],
            });

            var collection = new ymaps.GeoObjectCollection();
            map.geoObjects.add(collection);

            var addrsCount = 0;
            var balloons = [];
            $cont.find('.adr').each(function() {
                addrsCount++;
                var $addr = $(this);

                var coords = [$addr.data('lat'), $addr.data('lng')];
                var placemark = new ymaps.Placemark(coords);

                collection.add(placemark);

                var balloon = new ymaps.Balloon(
                    map,
                    {
                        closeButton: false
                    }
                );
                balloons.push(balloon);
                balloon.options.setParent(map.options);
                balloon.setData({
                    content: $addr[0].outerHTML
                });
                balloon.open(coords);

                // Всплывание баллуна по клику
                (function(balloon) {
                    balloon.events.add('click', function() {
                        $.each(balloons, function() {
                            var cBalloon = this;
                            var zIndex = cBalloon === balloon ? 10000 : 1000;
                            cBalloon.options.set({
                                zIndex: zIndex
                            });
                        });
                    });
                })(balloon);

                map.setCenter(coords);
            });

            if(addrsCount > 1) {
                map.setBounds(collection.getBounds(), {
                    zoomMargin: 200
                });
            }
        });
    });
});