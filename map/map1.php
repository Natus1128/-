<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css" media="screen">
    html {
        height: 100%;
        width: 100%;
    }

    #map {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100vw;
    }

    #body {
        height: 100%;
        width: 100vw;
        position: relative;
        top: 0;
        left: 0;
    }
    </style>
</head>

<body>
    <div class="body">
        <?php
            include("C:/xampp/htdocs/appin/connMySQL.php");
            
            $sql_query = "SELECT * FROM gps";
            $result = $pdo->query('select * from gps order by time desc limit 1;');
            
            foreach($result as $row){
                $db_lon=$row['lon'];  //長的
                $db_lat=$row['lat'];  //短的
                $db_time=$row['time'];
            }
            /*echo "目前位置 : ";
            echo $db_lat;  
            echo ",";
            echo $db_lon;
            echo " 時間:";
            echo $db_time; */       
        ?>       
        <div id="map"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        var lat1 = <?=$db_lat?>; //短的
        var lng1 = <?=$db_lon?>; //長的
    function initMap() {
        var Station_latlng = { lat:lat1, lng:lng1}; // 經緯度
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14, //放大的倍率
            center: Station_latlng //初始化的地圖中心位置
        });

        //--------下面是呼叫一個新marker------

        var marker = new google.maps.Marker({
            position: Station_latlng, //marker的放置位置
            map: map //這邊的map指的是第四行的map變數
        });

    }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAq9PKzFcLylMQmpiKJ1uUNH9MU1_9r-Cw&callback=initMap">
    </script>
</body>

</html>