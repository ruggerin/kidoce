<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #mapa{
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

<div id="mapa">
</div>


<!-- Jquery Core Js -->
<script src="{{ URL::asset('ambiente/plugins/jquery/jquery.min.js')}}"></script>

<!-- Maps API Javascript -->
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCC5-US8dhMNUh6yFNd9Sw_4LqnnVT042A"></script>
<script>
var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];
var gamb="http://";

function initialize() {	
   
	var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
    var options = {
        zoom: 12,
		center: new google.maps.LatLng(-3.1349,-60.008),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);

     //InfoBox Ponto
    var infowindow = new google.maps.InfoWindow(), marker;

        if( (navigator.platform.indexOf("iPhone") != -1) 
    || (navigator.platform.indexOf("iPod") != -1)
    || (navigator.platform.indexOf("iPad") != -1))
    gambi= "maps:";
        else
    gambi= "http:";

	
   var pontos= JSON.parse('{!!json_encode($json_coordenadas)!!}') ;
   console.log(pontos);

    $.each(pontos, function(index, ponto) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(ponto.latitude, ponto.longitude),
            title: ponto.cliente,
            map: map
        });

        //InfoBox Ponto
        var infowindow = new google.maps.InfoWindow(), marker;

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                            var iwContent = 
                                            '<div style="font-size: 16px;font-weight: bold;">' +ponto.codcli+"-"+ponto.cliente + '</div>' +
                                            '<div style="	padding: 15px 15px 15px 0;">' + 
                                            ponto.fantasia  + '<br>' +
                                            ponto.enderent  +',' + ponto.numeroent+ '<br>'+
                                            ponto.bairroent	  + '<br>'+
                                            ponto.latitude+","+ponto.longitude+'<br>'+
                                            ponto.matricula+"-"+ponto.nome + '<br>'+
                                            'Vlr.Pedido: '+formatReal(ponto.vlatend)+
                                            '<br><a href="'+gambi+'//maps.google.com/maps?daddr='+ponto.latitude+','+ponto.longitude+'&amp;ll=teste">Ir até lá (google Maps)</a>'+'</div>'  
                                            ;

                    infowindow.setContent( iwContent);
                    infowindow.open(map, marker);
                }
            })(marker))
            // alert(ponto.codcli);
        });
}


function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}
	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}



function pinSymbol(color) {
    return {
        path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
        fillColor: color,
        fillOpacity: 1,
        strokeColor: '#000',
        strokeWeight: 2,
        scale: 1,
   };
}
initialize();


function getMoney( str )
{
        return parseInt( str.replace(/[\D]+/g,'') );
}
function formatReal( int )
{
        var tmp = int+'';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        return tmp;
}

</script>