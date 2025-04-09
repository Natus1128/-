window.onload=initMap;
function initMap() {
    var Station_latlng = { lat: 23.5700796, lng: 120.4920104 }; // 經緯度
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14, //放大的倍率
        center: Station_latlng //初始化的地圖中心位置
    });

    //--------下面是呼叫一個新marker------

    var marker = new google.maps.Marker({
        position: Station_latlng, //marker的放置位置
        map: map //這邊的map指的是第四行的map變數
    });
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var marker = new google.maps.Marker({
                position: pos,
                //icon:'marker.png',
                map: map
            });
            map.setZoom(17);
            map.setCenter(pos);
        });
    } else {
        // Browser doesn't support Geolocation
        alert("未允許或遭遇錯誤！");
    }

}