$(document).ready(function () {
    let userLat = localStorage.getItem('lat'),
        userLng = localStorage.getItem('lng');

    $('.pharmacy_item').each(function () {
        let pharmLat = $(this).data('lat'),
            pharmLng = $(this).data('lng');

        let rad = function(x) {
            return x * Math.PI / 180;
        };

        let getDistance = function(p1, p2) {
            let R = 6378137; // Earth’s mean radius in meter
            let dLat = rad(p2.lat - p1.lat),
                dLong = rad(p2.lng - p1.lng),
                a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(rad(p1.lat)) * Math.cos(rad(p2.lat)) *
                    Math.sin(dLong / 2) * Math.sin(dLong / 2);
            let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)),
                d = R * c;
            return d; // returns the distance in meter
        };

        let distance = Math.round(getDistance({lat:userLat, lng:userLng}, {lat:pharmLat, lng:pharmLng}));
        if (distance > 500){
            $(this).remove()
        } else {
            $($(this).data('distance')).html(distance + ' M away')
        }
    });
});
