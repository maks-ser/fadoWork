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
                                                    <div class="select__option" data-area="area<?= $nArea ?>" data-toggle-area="area<?= $nArea ?>" data-area-name="<?= $area['area'] ?>">
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
                        <?php
                        $company_all = [];
                        $company_unique = [];

                        ?>
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
                                                            <div class="select__option"
                                                                 data-city="area<?= $nArea ?>city<?= $nCity ?>"
                                                                 data-toggle-city="area<?= $nArea ?>"
                                                                 data-city-name="<?= $city['city'] ?>"
                                                                 data-company-city="area<?= $nArea ?>city<?= $nCity ?>"
                                                                 data-company-area="<?= $nArea ?>"
                                                            >
                                                                <span class="select__name"><?= $city['city'] ?></span>
                                                                <?php
                                                                $list_items = $city['list'];

                                                                if($list_items) {

                                                                    foreach ($list_items as $mitem => $mvalue) {
                                                                        $trim = $mvalue['company'];
                                                                        $cityId = "area$nArea.city$nCity";
                                                                        $compId = "area$nArea.city$nCity.comp$mitem";
                                                                        $company_all[$trim][] = [
                                                                            'cityName' => $city['city'],
                                                                            'cityInd' => $cityId,
                                                                            'areaInd' => $nArea,
                                                                            'address' => trim($mvalue['address']),
                                                                            'companyId' => $compId,
                                                                        ];
                                                                        if(!in_array(($trim), $company_unique )) {
                                                                            $company_unique[] = $trim;
                                                                        }
                                                                    }
                                                                }
                                                                ?>
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


                        <!--              Select company-->
                        <div class="map-container__select m-company">
                            <div class="map-container__select-name" data-reveal="img"> <?php echo _e('Выберите компанию','theme-sp' ) ?> </div>
                            <?php
                            if ($areas) { ?>
                                <div class="select address-select" data-reveal="img">
                                    <div class="select__select-box">
                                        <div class="select__options-container">
                                            <div class="select__options-wrapper">
                                                <?php
                                                foreach($company_all as $company => $list) { ?>

                                                    <div class="select__option"
                                                         data-name="<?php echo $company ?>" >
                                                        <span class="select__name"><?php echo _e($company, 'theme-sp') ?></span>
                                                    </div>
                                                <?php  }   ?>
                                            </div>
                                        </div>
                                        <div class="select__selected">
                                            <span class="select__name"><?php echo _e('Выберите компанию', 'theme-sp') ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="map-container__map" data-reveal="img">
<!--                        карта-->
                        <div class="pc-map">
                            <script defer src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
                            <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_iylpgMK0k0Ww184AeS-fyQF33uqTcVY"></script>
                            <div class="pc-map__bl" id="map" data-lat="<?= str_replace(',', '.', get_field('map_center_lat') ?: '50.430023993154') ?>" data-lng="<?= str_replace(',', '.', get_field('map_center_lng') ?: '30.661536299999998') ?>"></div>

                            <?php
                            if ($areas) {
                                $id        = 1;
                                $locations = [];
                                ?>
                                <?php foreach ($areas as $nArea => $area) { ?>
                                <?php $cities = $area['cities'];
                            if ($cities) { ?>
                                <?php foreach ($cities  as $nCity => $city) { ?>
                                <?php $points = $city['list'];
                            if ($points) {
                            foreach ($points as $point) {
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
<!--text AREA - CITY - COMPANY-->
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

                                                        <?php foreach ($points as $mitem => $point) {
                                                            $lat = str_replace(',', '.', $point['map']['lat'] ?: '50.430023993154');
                                                            $lng = str_replace(',', '.', $point['map']['lng'] ?: '30.661536299999998'); ?>
                                                            <div class="map-city__row js-point _choose js-company" data-reveal="txt"
                                                                 data-map-info="<?= $id . ',' . $lat . ',' . $lng ?>"
                                                                 data-comp-city1="area<?= $nArea ?>city<?= $nCity ?>"
                                                                 data-comp-area="area<?php echo $nArea ?>"
                                                                 data-comp-city="<?php echo trim($city['city']) ?>"
                                                                 data-comp-name="<?php echo trim($point['company']) ?>"
                                                                 data-comp="<?php echo "area$nArea.city$nCity.comp$mitem" ?>
"
                                                            >
                                                                <div class="map-city__col" ><?= $point['company'] ?></div>
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
            const areaNameDef = $(".region-select .select__selected .select__name").text().trim();
            const cityNameDef = $(".city-select .select__selected .select__name").text().trim();
            const compNameDef = $(".address-select .select__selected .select__name").text().trim();
            let selectsWithAreaAll = $("[data-area]")
            // let selectsWithAreaAll1 = $("[data-toggle-area]")
            let selectsWithCityAll = $("[data-city]")
            const $companyAll = []
            let $companyElems = $(".map-container__city-box .js-company")


            // $companyAll собираю
            for(let ind = 0; ind < $companyElems.length; ind++) {
                let companyName = $companyElems[ind].dataset.compName.trim()
                let companyArea = $companyElems[ind].dataset.compArea.trim()
                let companyCity = $companyElems[ind].dataset.compCity.trim()
                let companyId = $companyElems[ind].dataset.comp.trim()

                let dataComp = {
                    "name" : companyName,
                    "city": companyCity,
                    "area": companyArea,
                    "compId": companyId,
                }
                $companyAll.push(dataComp)
            }
            console.log($companyAll)
//  Select по регионам\областям
            selectsWithAreaAll.click(function (e) {
                e.preventDefault();
                let companiesSelect = $('.address-select .select__options-container .select__option')
                //если в выбраном селекте компании стоит дефолтное значение
                let compNameNow = $(".address-select .select__selected .select__name").text().trim()
                let cityNameNow = $(".city-select .select__selected .select__name").text().trim()

                let _this = $(this);
                let _thisArea = _this.data('area');
                let _citysToggle = $('[data-toggle-city="'+_thisArea+'"]'); //находим селект городов и скрываем
                let accComp = []

                //mx ======================================================
                function filterByArea($comp, searchArea, accum) {
                    for(let i = 0; i< $comp.length; i++) {

                        if($comp[i].area == searchArea) {
                            accum.push( $comp[i])
                        }
                    }
                    return accum
                }
                filterByArea($companyAll, _thisArea, accComp)
                companiesSelect.hide(0).each(function( index ) {
                    let nameComp = $( this ).data('name')
                    for(let i = 0; i < accComp.length; i++) {
                        let  nameCompCity = accComp[i].name
                        if(nameCompCity === nameComp) {
                            $(this).show(0)
                        }
                    }
                })

                if(compNameDef === compNameNow) {
                    $('[data-toggle-city]').show(0).not(_citysToggle).hide(0);
                }else{
                    let compNames = []
                        let filterName = accComp.filter(function (el) {
                            return el.name === compNameNow
                        })
                        if(filterName.length) {
                            // debugger
                            $('[data-toggle-city]').hide(0);
                            _citysToggle.each(function( index, elem ) {

                            let cityName = String(elem.dataset.cityName)

                            for(let i = 0; i < filterName.length; i++) {
                                let nameCompCity = String(filterName[i].city)

                                // console.log('companiesSelect.nameComp => ', nameComp)
                                if (nameCompCity === cityName ) {
                                    $(this).show(0)
                                    compNames.push(filterName[i].name)

                                    console.log('$(this) => ', $(this))
                                    return compNames
                                }
                            }
                        })
                        if(!compNames.includes(compNameNow)) {
                            $(".address-select .select__selected .select__name").html(compNameDef)
                        }

                    }

                    // $('[data-toggle-city]').show(0).not(filtredCities).hide(0);
                }

            });




            var map = $('#map');
            if (map.length) {

                let mainInfo = $("[data-main]");
                let areaAll = $("[data-cont-area]"); //mx !!!!!!!!!!!!! где используется
                let cityAll = $("[data-cont-city]"); //all cities text info
                let compTextBlockAll = $("[data-comp-city1]");
                let compElems = $(".js-company"); //все компании текстовый блок

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
                        let selectCompanyNameText = $(".m-company .select__selected .select__name").text().trim()
                        if (compNameDef !== selectCompanyNameText) {
                            choosePoint.filter("[data-comp-name='"+selectCompanyNameText+"']")
                            console.log('choosePoint => ', choosePoint)
                        }
                        if(choosePoint.length){

                            choosePoint.each(function () {
                                let arrItem = $(this).data('map-info')
                                    chooseLocation.push(arrItem.split(','));
                            });
                            initMap(chooseLocation[0][1], chooseLocation[0][2], chooseLocation);
                        } else{

                            alert("<?php _e('Пошук не дав результату, спропуйте вибрати інше місто','theme-sp') ?>");
                        }
                    }
                    else{

                        alert("<?php _e('Пошук не дав результату, спропуйте вибрати інше місто','theme-sp') ?>");
                    }
                }

                selectsWithAreaAll.click(function (e) {
                    e.preventDefault();
                    let defSelectCity = $('[data-city-def-title]');
                    let defText = defSelectCity.data('city-def-title');
                    defSelectCity.text(defText);
                    // console.log(defText, ' def TEXT');



                    mainInfo.addClass('_loading');
                    let _this = $(this);
                    //работаем с текстовым блоком
                    let areaSelect = _this.data('area');
                    let areaChoose = areaAll.filter("[data-cont-area='" + areaSelect + "']");
                    areaAll.not(areaChoose).slideUp().removeClass('_choose');
                    areaChoose.slideDown().addClass('_choose');

                    choosePoints();

                    setTimeout(function () {
                        mainInfo.removeClass('_loading');
                    }, 1000);
                });
// choose city select
                $("[data-city]").click(function (e) {
                    e.preventDefault();
                    let companiesSelect = $('.address-select .select__options-container .select__option')
                    let companiesSelectSelected = $('.address-select .select__options-container .select__option').text().trim()
                    let compSelectNow = $('.address-select .select__selected .select__name').text().trim()
                    mainInfo.addClass('_loading');



                    let _this = $(this);

                    let citySelect = _this.data('city');
                    // console.log('cityAll => ', cityAll) //все города тестовый блок
                    let chooseArea = _this.data('toggle-city')

                    selectsWithAreaAll.hide(0)
                    let currentArea = selectsWithAreaAll.filter('[data-area="'+chooseArea+'"]')
                    currentArea.show(0)
                    let cityChoose = cityAll.filter("[data-cont-city='" + citySelect + "']");


                    cityAll.not(cityChoose).slideUp().removeClass('_choose');
                    cityChoose.slideDown().addClass('_choose');

                    let companies = []

                    cityChoose.find('.js-company').each(function( index, elem ) {
                        console.log('elem', elem)
                        console.log('dataset.compName', elem.dataset.compName)
                        companies.push(elem.dataset.compName)
                        // console.log('elem.data(compName) =>', elem.data('compName'))
                        return companies
                    })
                    // console.log('companies => ', companies)
                    let compSelectSelected = [];
                    // companiesSelect.hide(0)
                    let companiesSelectCurrent = []
                    if(compNameDef === compSelectNow) {
                        // debugger
                        companiesSelect.hide(0).each(function( index ) {
                            let data = $( this ).data('name')
                            if(companies.includes(data)) {
                                console.log('companies =>', companies)
                                $(this).show(0)
                                compSelectSelected.push(data)
                                return compSelectSelected
                            }else {
                                console.log('else 522 str =>' , data, 'not include =>', companies)
                            }


                        })
                    }else {

                        companiesSelect.filter(function(index, el) {
                            // debugger
                            console.log('el =>', el)
                            if(String(compSelectNow) === String(el.dataset.name)) {
                                console.log('else', '$(this) =>', $(this))
                                $(this).show(0)
                            }
                        })
                    }

                    choosePoints()

                    setTimeout(function () {
                        mainInfo.removeClass('_loading');
                    }, 1000);
                });
//mx company select
                $("[data-name]").click(function (e) {
                    e.preventDefault();
                    let compSelectNow = $('.address-select .select__selected .select__name').text().trim();
                    let areaSelectNow = $('.region-select .select__selected .select__name').text().trim();
                    let citySelectNow = $('.city-select .select__selected .select__name').text().trim();
                    let _this = $(this);
                    let _compName = _this.data('name').trim();

                    let compTarget = compTextBlockAll.filter("[data-comp-name='"+ _compName +"']"); //фильтую текстовый блок, нахожу по названию компании

                    compElems.show(0).not(compTarget).hide(0) //скрываю все компании кроме с названием выбраной
                    let areasIds = []; //Нахожу в текстовом блоке данные для селекта area
                    let cityIds = []; //Нахожу в текстовом блоке данные для селекта city select
                    let cityTextBlocks = [];
                    compTarget.each(function(index, el){
                        let _this = $(this)
                        _this.show(0)
                        let cityTextBlock = _this.parents("[data-cont-city]");

                        if(!cityIds.includes(cityTextBlock.data('contCity').trim())) {
                            cityIds.push(cityTextBlock.data('contCity'))
                        }
                        cityTextBlocks.push( cityTextBlock)
                        let area = cityTextBlock.parent()
                        if(!areasIds.includes(area.data('contArea').trim()))
                        areasIds.push(area.data('contArea').trim())
                    })

                    // areasIds = [...new Set(areasIds)]//фильтрую что бы не повторялись айдишники
                    // cityIds = [...new Set(cityIds)] //фильтрую что бы не повторялись айдишники
                    selectsWithCityAll.hide(0) //all selects hide
                    selectsWithAreaAll.hide(0)
                    console.log('cityIds => ', cityIds)
                    let selectsWithCityFilter = []
                    cityIds.forEach(function (el) {
                        let elTarget = selectsWithCityAll.filter("[data-city='"+el+"']").show(0)
                        selectsWithCityFilter.push(elTarget)
                        return selectsWithCityAll
                    })
                    areasIds.forEach(function (el) {
                        selectsWithAreaAll.filter("[data-area='"+el+"']").show(0);
                    })
                    // и текстовый блок настраиваю
                    cityAll.not(cityTextBlocks).slideUp().removeClass('_choose');
                    for(let i=0; i < cityTextBlocks.length; i++) {
                        cityTextBlocks[i].slideDown().addClass('_choose');
                    }
                    // if( cityNameDef !== citySelectNow) {
                    //     cityIds.forEach(function (el) {
                    //        let elTarget = selectsWithCityAll.filter("[data-city='"+el+"']").show(0)
                    //         selectsWithCityFilter.push(elTarget)
                    //         return selectsWithCityAll
                    //     })
                    // }else {
                    //     // if(areaSelectNow !== areaNameDef) {
                    //     //     selectsWithAreaAll
                    //     // }
                    //     let target = selectsWithCityAll.filter("[data-city-name='"+citySelectNow+"']").show(0)
                    //     console.log('Если значение города не дефаулт');
                    //
                    // }
                    console.log('cityIds =>', cityIds)
                    console.log('areasIds =>', areasIds)
                    console.log('selectsWithCityAll =>', selectsWithCityAll)
                    console.log('selectsWithCityFilter =>', selectsWithCityFilter)


                    function chooseCompanyPoints(){
                        let pointsArea = $('.js-area._choose');

                        let points = pointsArea.find('.js-city._choose');

                        $('[data-mark-close]').trigger('click');
                        if (points.length) {
                            chooseLocation = [];
                            let choosePoint = points.find('.js-point');
                            let selectCompanyNameText = $(".m-company .select__selected .select__name").text().trim()

                            if (compNameDef !== selectCompanyNameText) {
                                choosePoint.filter("[data-comp-name='"+selectCompanyNameText+"']")
                                console.log('selectCompanyNameText => ', selectCompanyNameText)
                            }
                            if(choosePoint.length){

                                choosePoint.each(function () {
                                    let arrItem = $(this).data('map-info')
                                    chooseLocation.push(arrItem.split(','));
                                });
                                initMap(chooseLocation[0][1], chooseLocation[0][2], chooseLocation);
                            } else{

                                alert("<?php _e('Пошук не дав результату, спропуйте вибрати інше місто','theme-sp') ?>");
                            }
                        }
                        else{

                            alert("<?php _e('Пошук не дав результату, спропуйте вибрати інше місто','theme-sp') ?>");
                        }
                    }
                    chooseCompanyPoints()
                    setTimeout(function () {
                        mainInfo.removeClass('_loading');
                    }, 1000);

                })


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