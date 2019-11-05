@extends('layout')
@section('style')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
       
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
      #mapid { height: 500px; width:auto;}
    </style>
    @endsection
@section('content')
    <div id="row" class="col-md-12" >
      <div id="mapid" class="col-md-12" >
      </div>
    </div>
    <div class="col-md-12" >
      <div class="row">
        <input type="hidden" id="value-lat" name="value-lat" value="0">
        <input type="hidden" id="value-lng" name="value-lng" value="0">
        
      </div>
    </div>
    @endsection
@section('script')
    <script>
     var nLocation = '<table class="popup-table">\
     <tr class="popup-table-row">\
      <th class="popup-table-header">Başlık:</th>\
      <td class="popup-table-data"><input id="value-title" name="value-title" class="popup-input" type="text" /></td>\
     </tr>\
     <tr class="popup-table-row">\
      <th class="popup-table-header">Açıklama:</th>\
      <td class="popup-table-data"><input id="value-description" name="value-description"  class="popup-input" type="text" /></td>\
     </tr>\
     </table>\
     <input onclick="insertLocation()" class="btn btn-primary btn-submit" type="submit" value="Kaydet">';
      function popupMaker(){

      }
      var mymap = L.map('mapid').setView([41.07, 28.99], 2);
      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	    maxZoom:18,
	    id: 'mapbox.satellite',
	    accessToken: 'pk.eyJ1IjoibXNhaXRrcmJsayIsImEiOiJjanp3b2dkbWswMDQ4M2NtbTVvZXI5bmhlIn0.eQZw-XO4cvzOBEUPt9BRlQ'
      }).addTo(mymap);
      var markers = new L.LayerGroup().addTo(mymap);
      var popup = L.popup();

    function onMapClick(e) {
      var popup = L.popup()
    .setLatLng(e.latlng)
    .setContent(nLocation)
    .openOn(mymap);
      // e.latlng.lat.toString() +','+ e.latlng.lng.toString() 
      //var marker = L.marker([41.07, 28.99]).addTo(markers);
      document.getElementById("value-lat").value=e.latlng.lat;
      document.getElementById("value-lng").value=e.latlng.lng;
      console.log(e.latlng);
    }
    
      mymap.on('click', onMapClick);
      
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      function updateData(){
        markers.clearLayers();
        $.ajax({
           type:'GET',
           url:'/ajaxLocationRequest',
           success:function(data){
            for(var k in data) {
              if(true){
                console.log(data[k]);
                var marker = L.marker([data[k].lat, data[k].lng]).addTo(markers); 
                var uLocation = '<table class="popup-table">\
                  <tr class="popup-table-row">\
                   <th class="popup-table-header">Başlık:</th>\
                   <td class="popup-table-data"><input id="value-title" name="value-title" class="popup-input" type="text" value="'+data[k].title+'" /></td>\
                  </tr>\
                  <tr class="popup-table-row">\
                   <th class="popup-table-header">Açıklama:</th>\
                   <td class="popup-table-data"><input id="value-description" name="value-description"  class="popup-input" type="text" value="'+data[k].description+'" /></td>\
                  </tr>\
                </table>\
                <input type="hidden" id="value-id" name="value-id" value="'+data[k].id+'">\
                <input onclick="updateLocation()" class="btn btn-primary btn-submit" type="submit" value="Güncelle">';
                marker.bindPopup(uLocation);

              }
            }
           }
        });
      }
      $(document).ready(function(){
          updateData();
	    });
      function insertLocation(){
        var title = document.getElementById("value-title");
        var description = document.getElementById("value-description");
        var lat = document.getElementById("value-lat");
        var lng = document.getElementById("value-lng");
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        console.log(title.value);
        $.ajax({
                    /* the route pointing to the post function */
                    url: '/ajaxLocationRequest',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {
                      _token: CSRF_TOKEN, message:$(".getinfo").val(),
                      title:title.value, 
                      description:description.value,
                      lat:lat.value,
                      lng:lng.value
                      },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                        $(".writeinfo").append(data.msg); 
                    }
                });
        mymap.closePopup();
        updateData();
      }
      function updateLocation(){
        var title = document.getElementById("value-title");
        var description = document.getElementById("value-description");
        var id = document.getElementById("value-id");
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        console.log(title.value);
        $.ajax({
                    /* the route pointing to the post function */
                    url: '/ajaxUpdateLocationRequest',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {
                      _token: CSRF_TOKEN, message:$(".getinfo").val(),
                      title:title.value, 
                      description:description.value,
                      id:id.value
                      },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) { 
                        $(".writeinfo").append(data.msg); 
                    }
                });
        mymap.closePopup();
        updateData();
      }
      $("#btnSearch").click(function(){
        searchData();
	    });
      function searchData(){
        markers.clearLayers();
        var title = document.getElementById("value-search");
        $.ajax({
           type:'POST',
           url:'/ajaxsearchLocationRequest',
           data: { title:title.value},
           dataType: 'JSON',
           success:function(data){
            for(var k in data) {
              if(true){
                var marker = L.marker([data[k].lat, data[k].lng]).addTo(markers); 
                var uLocation = '<table class="popup-table">\
                  <tr class="popup-table-row">\
                   <th class="popup-table-header">Başlık:</th>\
                   <td class="popup-table-data"><input id="value-title" name="value-title" class="popup-input" type="text" value="'+data[k].title+'" /></td>\
                  </tr>\
                  <tr class="popup-table-row">\
                   <th class="popup-table-header">Açıklama:</th>\
                   <td class="popup-table-data"><input id="value-description" name="value-description"  class="popup-input" type="text" value="'+data[k].description+'" /></td>\
                  </tr>\
                </table>\
                <input type="hidden" id="value-id" name="value-id" value="'+data[k].id+'">\
                <input onclick="updateLocation()" class="btn btn-primary btn-submit" type="submit" value="Güncelle">';
                marker.bindPopup(uLocation);

              }
            }
           }
        });
      }

    </script>
    @endsection
    