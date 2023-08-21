<?php
/*
Template Name: Тех. - Обучение
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <section class="sub-head sub-head--title">
    <div class="sub-head__wrapper">
      <div class="sub-head__bg">
        <div class="sub-head__gradient"></div>
        <div class="sub-head__image" data-reveal="elem">
          <div class="image">
            <?php $img = get_field('fon'); ?>
            <img data-src="<?= $img['url'] ?: $dir . "img/photos/sub-head-image-2_orig.png" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
          </div>
        </div>
      </div>
      <div class="sub-head__content" data-reveal-container>
        <div class="sub-head__info">
          <?php breadcrumbSub($h1, $ancestors) ?>
          <h1 class="sub-head__title h2-title h2-title--white" data-reveal="txt"><?= $h1 ?></h1>
        </div>
      </div>
    </div>
  </section>

  <main class="main main--sub">
    <section class="training-container">
      <div class="training-container__wrapper block-wrapper">
        <div class="training-container__block">
          <?php if ($el = get_field('b_d')): ?>
            <div class="training-container__info">
              <div class="training-container__description description" data-reveal="txt">
                <?= $el ?>
              </div>
            </div>
          <?php endif; ?>
          <?php $el = get_field('b_list');
          if ($el) { ?>
            <div class="training-container__set" data-reveal-container>
              <?php foreach ($el as $it) { ?>
                <div class="training-container__item training-item" data-reveal="txt">
                  <div class="training-item__date">
                    <span><?= $it['date'] ?></span>
                  </div>
                  <div class="training-item__term-box">
                    <div class="training-item__term training-item__time">
                      <span>
                        <img src="<?= $dir ?>img/svg/icon-time.svg" alt="">
                      </span>
                      <span><?= $it['time'] ?></span>
                    </div>
                    <div class="training-item__term training-item__time">
                      <span>
                        <img src="<?= $dir ?>img/svg/icon-location.svg" alt="">
                      </span>
                      <span><?= $it['city'] ?></span>
                    </div>
                  </div>
                  <div class="training-item__info">
                    <h3 class="training-item__title h4-title h4-title--bold"><?= $it['t'] ?></h3>
                    <?php $elCh = $it['list'];
                    if ($elCh) { ?>
                      <ul class="training-item__list list">
                        <?php foreach ($elCh as $itCh) { ?>
                          <li class="list__item"><?= $itCh['t'] ?></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                    <?php $btn= $it['btn'];
                    if ($btn) {
                      ?>
                      <div class="training-item__button">
                        <a href="#form-anchor" class="inline-btn">
                          <span class="inline-btn__name"><?= $btn ?></span>
                          <span class="inline-btn__icon">
                            <img src="<?= $dir ?>img/svg/icon-button-training.svg" inline-svg alt="">
                          </span>
                        </a>
                      </div>
                      <?php
                    } ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          <?php } ?>
        </div>


        <div class="training-container__block">
          <h2 class="training-container__title h2-title" data-reveal="txt"><?php the_field('b2_t') ?></h2>
          <?php if ($el = get_field('b2_d')): ?>
            <div class="training-container__info">
              <div class="training-container__description description" data-reveal="txt">
                <?= $el ?></div>
            </div>
          <?php endif; ?>
          <?php $el = get_field('b2_list');
          if ($el) { ?>
            <div class="training-container__set" data-reveal-container>
              <?php foreach ($el as $n => $it) {
                $n++;
                $num = $n % 2;
                if ($num === 1): ?>
                  <div class="training-container__piece-box">
                <?php endif; ?>
                <div class="training-container__piece" data-reveal="txt">
                  <div class="training-container__piece-icon">
                    <?php $img = $it['img']; ?>
                    <img src="<?= $img['url'] ?: $dir . "img/svg/icon-piece-t-1.svg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>">
                  </div>
                  <div class="training-container__piece-name"><?= $it['t'] ?></div>
                </div>
                <?php if ($num < 1 || count($el) === $n): ?></div> <?php endif; ?>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <section class="form-container bg" id="form-anchor">
      <div class="form-container__wrapper block-wrapper">
        <h2 class="form-container__title h2-title h2-title--orange" data-reveal="txt"><?php the_field('form_t') ?></h2>
        <div class="form-container__description description description--white" data-reveal="txt"><?php the_field('form_d') ?></div>
        <div class="form-container__form" data-reveal="elem">

          <form class="form" action="#" novalidate>
            <input type="hidden" name="form_name" value="<?php the_field('form_t') ?> - <?= $h1 ?>">
            <div class="form__input form-input">
              <input name="name" class="form-input__input _required" placeholder="<?= get_field('form_name', 'options') ?: 'Имя' ?>" type="text">
              <div class="failure">
                <span class="failure__text"></span>
              </div>
            </div>
            <div class="form__input form-input">
              <input name="surname" class="form-input__input _required" placeholder="<?= get_field('form_surname', 'options') ?: 'Фамилия' ?>" type="text">
              <div class="failure">
                <span class="failure__text"></span>
              </div>
            </div>
            <div class="form__input form-input">
              <input name="email" class="form-input__input _email _required" placeholder="<?= get_field('form_email', 'options') ?: 'Email' ?>" type="email">
              <div class="failure">
                <span class="failure__text"></span>
              </div>
            </div>
            <div class="form__input form-input">
              <input name="tel" class="form-input__input _tel _required" placeholder="<?= get_field('form_tel', 'options') ?: '+ (380) ___ ___ ___' ?>" type="tel">
              <div class="failure">
                <span class="failure__text"></span>
              </div>
            </div>

            <?php $el = get_field('form_course_list', 'options');
            if ($el) { ?>
              <div class="form__select">
                <input type="hidden" name="course" value="" data-input-option>
                <div class="select training-select">
                  <div class="select__select-box">
                    <div class="select__options-container">
                      <div class="select__options-wrapper">
                        <?php foreach ($el as $n => $it) { ?>
                          <div class="select__option" data-option="<?= $it['t'] ?>">
                            <span class="select__name"><?= $it['t'] ?></span>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="select__selected" data-option-choose="<?= get_field('form_course_t', 'options') ?: '-Выбор курса-' ?>">
                      <span class="select__name"><?= get_field('form_course_t', 'options') ?: '-Выбор курса-' ?></span>
                    </div>
                  </div>
                </div>
              </div>
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  let _oldVal = $("[data-input-option]").val();
                  if (_oldVal.length) {
                    $("[data-option='" + _oldVal + "']").trigger('click');
                  }
                  $("[data-option]").click(function (e) {
                    e.preventDefault();
                    let _this = $(this);
                    let _val = _this.data('option');
                    $("[data-input-option]").val(_val);
                  });
                });
              </script>
            <?php } ?>

            <div class="form__footer">
              <?php if ($el = get_field('form_policy', 'options')): ?>
                <div class="form__checkbox">
                  <label class="checkbox">
                    <span class="checkbox__name"><?= $el ?></span>
                    <input class="checkbox__box _checkbox _required" type="checkbox" checked>
                    <span class="checkbox__mark"></span>
                  </label>
                </div>
              <?php endif; ?>
              <div class="form__button">
                <button class="button button--ni button--hover-w" type="submit">
                  <span class="button__name"><?= get_field('form_btn', 'options') ?: 'Отправить' ?></span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();