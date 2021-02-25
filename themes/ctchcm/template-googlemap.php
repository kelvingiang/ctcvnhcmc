 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAV4v2qSBuCA1Rn7NPd09exwP4smcjW_g&callback=initMap" type="text/javascript"></script>
<!--<script type="text/javascript" 
        src="http://maps.googleapis.com/maps/api/js?sensor=false&language=en">
</script>-->
<script type="text/javascript">
    var map;
    function initialize() {
        var myLatlng = new google.maps.LatLng(10.726117, 106.720169);
        var myOptions = {
            zoom: 16,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("google-map"), myOptions);
        // Biến text chứa nội dung sẽ được hiển thị
        var text;
        text = "<b style='color:red' " +
                "style='text-align:center;'>越南台灣商會聯合總會胡志明市分會</b>" +
                "<p style='margin-top:7px'>No. 107 Ton Dat Tien, Tan Phu Ward, District 7, HCMC, Viet Nam</p>";
        var infowindow = new google.maps.InfoWindow(
                {content: text,
                    size: new google.maps.Size(100, 50),
                    position: myLatlng
                });
        infowindow.open(map);
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: "Mightway vn"
        });
    }
</script>
<div id="google-map" style="position: relative; z-index: 28 ; height: 350px;  width: 100%; margin: 0 auto ; margin: 10px 0 ;  "></div>
