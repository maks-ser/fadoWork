<?php
/*
Template Name: Карта - где купить
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();

?>

    <main class="main main--etc">
        <?php breadcrumb($h1, $ancestors); ?>

        <section class="map-container">
            <div class="map-container__wrapper block-wrapper" data-main>
                <h1 class="map-container__title h2-title" data-reveal="txt"><?= $h1 ?></h1>

                <div class="map-container__map-box" data-reveal-container>

                    <div class="map-container__select-box">

                        <div class="map-container__select">
                            <div class="map-container__select-name" data-reveal="img"><?= get_field('t2') ?: 'Выберите область' ?></div>

                            <?php $areas = get_field('list');
                            if ($areas) { ?>
                                <div class="select region-select" data-reveal="img">
                                    <div class="select__select-box">
                                        <div class="select__options-container">
                                            <div class="select__options-wrapper">
                                                <?php foreach ($areas as $nArea => $area) { ?>
                                                    <div class="select__option" data-area="area<?= $nArea ?>" data-toggle-area="area<?= $nArea ?>">
                                                        <span class="select__name"><?= $area['area'] ?></span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="select__selected">
                                            <span class="select__name"><?= get_field('t2') ?: 'Выберите область' ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                        <div class="map-container__select">
                            <div class="map-container__select-name" data-reveal="img"><?= get_field('t3') ?: 'Выберите город' ?></div>
                            <?php
                            if ($areas) { ?>
                                <div class="select city-select" data-reveal="img">
                                    <div class="select__select-box">
                                        <div class="select__options-container">
                                            <div class="select__options-wrapper">
                                                <?php foreach ($areas as $nArea => $area) { ?>
                                                    <?php $cities = $area['cities'];
                                                    if ($cities) { ?>

                                                        <?php foreach ($cities as $nCity => $city) { ?>
                                                            <div class="select__option" data-city="area<?= $nArea ?>city<?= $nCity ?>" data-toggle-city="area<?= $nArea ?>">
                                                                <span class="select__name"><?= $city['city'] ?></span>
                                                            </div>
                                                        <?php } ?>

                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="select__selected">
                                            <span class="select__name"><?= get_field('t3') ?: 'Выберите город' ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="map-container__map" data-reveal="img">
                        <div class="pc-map">
                            <script defer src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
                            <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_iylpgMK0k0Ww184AeS-fyQF33uqTcVY"></script>
                            <div class="pc-map__bl" id="map" data-lat="<?= str_replace(',', '.', get_field('map_center_lat') ?: '50.430023993154') ?>" data-lng="<?= str_replace(',', '.', get_field('map_center_lng') ?: '30.661536299999998') ?>"></div>

                            <?php
                            if ($areas) {
                                $id        = 1;
                                $locations = [];
                                ?>
                                <?php foreach ($areas

                                               as $nArea => $area) { ?>
                                <?php $cities = $area['cities'];
                            if ($cities) { ?>
                                <?php foreach ($cities

                                               as $nCity => $city) { ?>
                                <?php $points = $city['list'];
                            if ($points) { ?>
                                <?php foreach ($points

                                               as $point) {
                                $lat         = str_replace(',', '.', $point['map']['lat'] ?: '50.430023993154');
                                $lng         = str_replace(',', '.', $point['map']['lng'] ?: '30.661536299999998');
                                $locations[] = [$id, $lat, $lng];
                                ?>
                                <div class="map-info" data-mark="<?= $id++ ?>" data-lat="<?= $lat ?>" data-lng="<?= $lng ?>">
                                    <div class="map-info__cross" data-mark-close>
                                        <img src="<?= $dir ?>img/svg/icon-popup-cross.svg" alt="">
                                    </div>
                                    <h4 class="map-info__title"><?= $point['company'] ?></h4>
                                    <div class="map-info__contact-box">
                                        <div class="map-info__contact"><?= $point['address'] ?></div>
                                        <?php $tels = $point['tels'];
                                        if ($tels) { ?>
                                            <?php foreach ($tels as $tel) {
                                                $tel     = $tel['tel'];
                                                $telLink = preg_replace("/[^+\d]/", "", $tel);
                                                ?>
                                                <div class="map-info__contact">
                                                    <a href="tel:<?= $telLink ?>"><?= $tel ?></a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                                <script>
                                    var locations = [<?php foreach ($locations as $it) { ?>
                                        [<?= $it[0] ?>, <?= $it[1] ?>, <?= $it[2] ?>],
                                        <?php } ?>];
                                </script>
                            <?php } ?>

                        </div>
                    </div>

                </div>

                <div class="map-container__city-box">
                    <h2 class="map-container__city-title" data-reveal="txt"><?= get_field('t1') ?: 'Торговые точки' ?></h2>


                    <?php
                    if ($areas) {
                        $id = 1; ?>
                        <?php foreach ($areas as $nArea => $area) { ?>
                            <?php $cities = $area['cities'];
                            if ($cities) { ?>
                                <div data-cont-area="area<?= $nArea ?>" class="js-area _choose">
                                    <?php foreach ($cities as $nCity => $city) { ?>
                                        <div class="map-container__city _choose js-city" data-reveal-container data-cont-city="area<?= $nArea ?>city<?= $nCity ?>">
                                            <div class="map-city">
                                                <h3 class="map-city__title" data-reveal="txt"><?= $city['city'] ?></h3>
                                                <div class="map-city__table">

                                                    <div class="map-city__row" data-reveal="txt">
                                                        <div class="map-city__col"><?php _e('Компания', 'theme-sp') ?></div>
                                                        <div class="map-city__col"><?php _e('Адрес', 'theme-sp') ?></div>
                                                        <div class="map-city__col"><?php _e('Контакты', 'theme-sp') ?></div>
                                                        <div class="map-city__col"><?php _e('Сайт', 'theme-sp') ?></div>
                                                    </div>

                                                    <?php $points = $city['list'];
                                                    if ($points) { ?>

                                                        <?php foreach ($points as $point) {
                                                            $lat = str_replace(',', '.', $point['map']['lat'] ?: '50.430023993154');
                                                            $lng = str_replace(',', '.', $point['map']['lng'] ?: '30.661536299999998'); ?>
                                                            <div class="map-city__row js-point" data-reveal="txt" data-map-info="<?= $id . ',' . $lat . ',' . $lng ?>">
                                                                <div class="map-city__col"><?= $point['company'] ?></div>
                                                                <div class="map-city__col"><?= $point['address'] ?></div>
                                                                <div class="map-city__col">
                                                                    <?php $tels = $point['tels'];
                                                                    if ($tels) { ?>
                                                                        <?php foreach ($tels as $tel) {
                                                                            $tel     = $tel['tel'];
                                                                            $telLink = preg_replace("/[^+\d]/", "", $tel);
                                                                            ?>
                                                                            <a href="tel:<?= $telLink ?>"><?= $tel ?></a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                    <?php if ($point['email']): ?>
                                                                        <a href="mailto:<?= $point['email'] ?>"><?= $point['email'] ?></a>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="map-city__col">
                                                                    <?php $sites = $point['sites'];
                                                                    if ($sites) { ?>
                                                                        <?php foreach ($sites as $site) {
                                                                            $siteLink  = $site['site'];
                                                                            $siteTitle = str_replace(['http://', 'https://'], "", $siteLink);
                                                                            ?>
                                                                            <a href="<?= $siteLink ?>" target="_blank"><?= $siteTitle ?></a>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <?php $id++;
                                                        } ?>

                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                </div>

            </div>
        </section>

        <?php require_once get_template_directory() . '/template/subscribe.php' ?>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $("[data-toggle-area]").click(function (e) {
                e.preventDefault();
                let _this = $(this);
                let _thisArea = _this.data('area');
                let _citysToggle = $('[data-toggle-city="'+_thisArea+'"]');

                _citysToggle.show(0);
                $('[data-toggle-city]').not(_citysToggle).hide(0);
            });

            var map = $('#map');
            if (map.length) {

                let mainInfo = $("[data-main]");
                let areaAll = $("[data-cont-area]");
                let cityAll = $("[data-cont-city]");
                let dir_url = "<?= $dir ?>";
                let chooseLocation = [];
                let $Lat = parseFloat(map.data('lat'));
                let $Lng = parseFloat(map.data('lng'));

                function choosePoints(){
                    let pointsArea = $('.js-area._choose');
                    let points = pointsArea.find('.js-city._choose');

                    $('[data-mark-close]').trigger('click');
                    if (points.length) {
                        chooseLocation = [];
                        let choosePoint = points.find('.js-point');
                        if(choosePoint.length){
                            choosePoint.each(function () {
                                let arrItem = $(this).data('map-info')
                                chooseLocation.push(arrItem.split(','));
                            });
                            initMap(chooseLocation[0][1], chooseLocation[0][2], chooseLocation);
                        } else{
                            //initMap(locations[0][1], locations[0][2], locations);
                            alert("<?php _e('Пошук не дав результату, спропуйте вибрати інше місто','theme-sp') ?>");
                        }
                    }
                    else{
                        //initMap(locations[0][1], locations[0][2], locations);
                        alert("<?php _e('Пошук не дав результату, спропуйте вибрати інше місто','theme-sp') ?>");
                    }
                }

                $("[data-area]").click(function (e) {
                    e.preventDefault();
                    // let defSelectCity = $('[data-city-def-title]');
                    // let defText = defSelectCity.data('city-def-title');
                    // defSelectCity.text(defText);
                    // console.log(defText, ' def TEXT');
                    mainInfo.addClass('_loading');
                    let _this = $(this);
                    let areaSelect = _this.data('area');
                    let areaChoose = areaAll.filter("[data-cont-area='" + areaSelect + "']");
                    areaAll.not(areaChoose).slideUp().removeClass('_choose');
                    areaChoose.slideDown().addClass('_choose');

                    choosePoints();

                    setTimeout(function () {
                        mainInfo.removeClass('_loading');
                    }, 1000);
                });

                $("[data-city]").click(function (e) {
                    e.preventDefault();
                    mainInfo.addClass('_loading');
                    let _this = $(this);
                    let citySelect = _this.data('city');
                    let cityChoose = cityAll.filter("[data-cont-city='" + citySelect + "']");
                    cityAll.not(cityChoose).slideUp().removeClass('_choose');
                    cityChoose.slideDown().addClass('_choose');

                    choosePoints()

                    setTimeout(function () {
                        mainInfo.removeClass('_loading');
                    }, 1000);
                });

                initMap($Lat, $Lng, locations);

                function initMap(lat, lng, locations) {

                    var ID = document.getElementById('map');
                    if (!ID) return;

                    var par = $('.pc-map');

                    const map = new google.maps.Map(ID, {
                        zoom             : 5,
                        center           : new google.maps.LatLng(lat, lng),
                        styles           : [
                            {
                                "featureType" : "administrative",
                                "elementType" : "all",
                                "stylers"     : [
                                    {
                                        "visibility" : "on"
                                    },
                                    {
                                        "saturation" : -100
                                    },
                                    {
                                        "lightness" : 20
                                    }
                                ]
                            },
                            {
                                "featureType" : "road",
                                "elementType" : "all",
                                "stylers"     : [
                                    {
                                        "visibility" : "on"
                                    },
                                    {
                                        "saturation" : -100
                                    },
                                    {
                                        "lightness" : 40
                                    }
                                ]
                            },
                            {
                                "featureType" : "water",
                                "elementType" : "all",
                                "stylers"     : [
                                    {
                                        "visibility" : "on"
                                    },
                                    {
                                        "saturation" : -10
                                    },
                                    {
                                        "lightness" : 30
                                    }
                                ]
                            },
                            {
                                "featureType" : "landscape.man_made",
                                "elementType" : "all",
                                "stylers"     : [
                                    {
                                        "visibility" : "simplified"
                                    },
                                    {
                                        "saturation" : -60
                                    },
                                    {
                                        "lightness" : 10
                                    }
                                ]
                            },
                            {
                                "featureType" : "landscape.natural",
                                "elementType" : "all",
                                "stylers"     : [
                                    {
                                        "visibility" : "simplified"
                                    },
                                    {
                                        "saturation" : -60
                                    },
                                    {
                                        "lightness" : 60
                                    }
                                ]
                            },
                            {
                                "featureType" : "poi",
                                "elementType" : "all",
                                "stylers"     : [
                                    {
                                        "visibility" : "off"
                                    },
                                    {
                                        "saturation" : -100
                                    },
                                    {
                                        "lightness" : 60
                                    }
                                ]
                            },
                            {
                                "featureType" : "transit",
                                "elementType" : "all",
                                "stylers"     : [
                                    {
                                        "visibility" : "off"
                                    },
                                    {
                                        "saturation" : -100
                                    },
                                    {
                                        "lightness" : 60
                                    }
                                ]
                            }
                        ],
                        disableDefaultUI : true
                    });

                    const markers = [];

                    for (var i = 0; i < locations.length; i++) {

                        var title = locations[i][0],
                                lat = locations[i][1],
                                lng = locations[i][2];

                        var marker = new google.maps.Marker({
                            position  : new google.maps.LatLng(lat, lng),
                            map       : map,
                            animation : google.maps.Animation.DROP,
                            icon      : {
                                url    : dir_url + "img/map-marker.svg",
                                size   : new google.maps.Size(20, 25),
                                origin : new google.maps.Point(0, 0),
                                anchor : new google.maps.Point(20, 12.5)
                            },
                            optimized : false,
                            title     : title.toString(),
                        });

                        marker.addListener('click', marFun);

                        markers.push(marker);

                    }

                    function marFun() {
                        let markAll = par.find('[data-mark]');
                        let mark = markAll.filter('[data-mark="' + this.title + '"]');
                        let cordLat = parseFloat(mark.data('lat'));
                        let cordLng = parseFloat(mark.data('lng'));
                        map.setCenter(new google.maps.LatLng(cordLat, cordLng));

                        map.setZoom(17);

                        let labelOnMap = par.find('div[title="' + this.title + '"]');

                        markAll.not(mark).removeClass('active');

                        setTimeout(function () {
                            let labCord = labelOnMap[0].getBoundingClientRect();
                            let parCord = par[0].getBoundingClientRect();

                            let cordX = labCord.x - parCord.x;
                            let cordY = labCord.y - parCord.y;

                            mark.css({
                                'left' : cordX,
                                'top'  : cordY + 20,
                            });

                            mark.addClass('active').css({
                                'top' : cordY,
                            });
                        }, 400);

                    }

                    new MarkerClusterer(map, markers, {
                        styles : [{
                            url        : dir_url + "img/map-marker.svg",
                            width      : 20,
                            height     : 25,
                            fontFamily : "Gilroy",
                            textSize   : 12,
                            textColor  : "#fff",
                            //color: #00FF00,
                        }]
                    });


                    map.addListener('dragstart', function () {
                        par.find('.map-info').removeClass('active');
                        par.find('#markerLayer img').removeClass('active');
                    });

                    var myoverlay = new google.maps.OverlayView();
                    myoverlay.draw = function () {
                        this.getPanes().markerLayer.id = 'markerLayer';
                    };
                    myoverlay.setMap(map);

                    $(document).on('click', '[data-post]', function () {
                        let _this = $(this);
                        let _thisId = _this.data('post');
                        let markAll = par.find('[data-mark]');
                        let mark = markAll.filter('[data-mark="' + _thisId + '"]');
                        let cordLat = parseFloat(mark.data('lat'));
                        let cordLng = parseFloat(mark.data('lng'));
                        map.setCenter(new google.maps.LatLng(cordLat, cordLng));
                        map.setZoom(17);

                        markAll.not(mark).removeClass('active');
                        setTimeout(function () {
                            par.find('div[title="' + _thisId + '"]').trigger('click');
                        }, 200);
                    });

                    $(document).on('click', '[data-mark-close]', function () {
                        let _this = $(this);
                        _this.parent().removeClass('active');
                    });

                }
            }
        });
    </script>
<?php
get_footer();

