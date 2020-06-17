
- Harita üzerinde bir noktaya tıklayarak marker ekleme işlemi yapıldı.
- Marker eklerken bir popup penceresinde bize Başlık ve Açıklama inputları çıkmalı, bu bilgileri girip kaydet diyeceğiz ve marker ekleme işlem yapıldı.
- Mouse ile kaydedilmiş bir marker'ın üzerine geldiğimizde Başlık metni marker üzerinde görünüyor olmalı.
- Mouse ile kaydedilmiş bir marker'ın üzerine tıklandığında popup tekrar açılmalı ve düzenleme işlemi yapabilir.
- Sayfa refresh olduğunda kaydedilen markerlar tekrar yüklenmeli. 
- Single-page application olacak, yani tüm işlemler sayfa yenilenmeden tek pencerede yürüyecek.

Harita olarak Leaflet (https://leafletjs.com) kullanılıyor.
Backend olarak Laravel kullanıldı.

### Installation ###
* `cd projectname`
* `composer install`
* `php artisan key:generate`
* Create a database and inform *.env*
* `php artisan migrate --seed` to create and populate tables
* `php artisan vendor:publish` to publish filemanager
* `php artisan serve` to start the app on http://localhost:8000/

### Include ###

* [HTML5 Boilerplate](http://html5boilerplate.com) for front architecture
* [Bootstrap](http://getbootstrap.com) for CSS and jQuery plugins
* [Font Awesome](http://fortawesome.github.io/Font-Awesome) for the nice icons
* [Leaflet](https://leafletjs.com) for map
