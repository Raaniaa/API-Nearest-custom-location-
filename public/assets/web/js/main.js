$(document).ready(function () {
    /**
     * Her set hidden input value in body to
     * current Customer latitude and longitude
     */
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function (position) {
            let lat = $('input.latitude'),
                lng = $('input.longitude');
            lat.val(parseFloat(position.coords.latitude));
            lng.val(parseFloat(position.coords.longitude));
            localStorage.setItem('lat', lat.val());
            localStorage.setItem('lng', lng.val());
        });
    } else {
        alert('Geolocation is not supported by this browser')
    }
});
