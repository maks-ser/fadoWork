<?php
/*
Template Name: партнерам - Диллерам
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors) ?>

    <?php require_once get_template_directory() . '/template/numbers.php' ?>

    <section class="p2-container">
      <div class="p2-container__wrapper block-wrapper">
        <h2 class="p2-container__title h2-title" data-reveal="txt"><?php the_field('b2_t') ?></h2>
        <div class="p2-container__info" data-reveal="txt">
          <?php $el = get_field('b2_list');
          if ($el) { ?>
            <ul class="list">
              <?php foreach ($el as $it) { ?>
                <li class="list__item"><?= $it['t'] ?></li>
              <?php } ?>
            </ul>
          <?php } ?>
        </div>
        <?php $el = get_field('b2_list1');
        if ($el) { ?>
          <div class="p2-container__piece-box" data-reveal-container>
            <?php foreach ($el as $it) { ?>
              <div class="p2-container__piece" data-reveal="txt">
                <div class="p2-container__piece-icon">
                  <?php $img = $it['img']; ?>
                  <img src="<?= $img['url'] ?: $dir . "img/svg/icon-piece-d-1.svg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>">
                </div>
                <div class="p2-container__piece-caption"><?= $it['t'] ?></div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </section>

    <section class="r1-container bg">
      <div class="r1-container__wrapper block-wrapper">
        <h2 class="r1-container__title h2-title h2-title--orange" data-reveal="txt"><?php the_field('b3_t') ?></h2>
        <div class="r1-container__info">
          <div class="r1-container__description description description--gray" data-reveal="txt"><?php the_field('b3_d') ?></div>
        </div>
        <?php if ($el = get_field('b3_d1')): ?>
          <div class="r1-container__description description description--gray" data-reveal="txt"><?= $el ?></div>
        <?php endif; ?>
        <div class="r1-container__image-box" data-reveal="img">
          <div class="ar-image">
            <?php $img = get_field('b3_img'); ?>
            <img data-src="<?= $img['url'] ?: $dir . "img/photos/random-image-3.jpg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
          </div>
        </div>
        <?php $link = get_field('b3_btn');
        if ($link) {
          $url    = $link['url'] ?: '#';
          $title  = $link['title'] ?: __('Подробнее', 'theme-sp');
          $target = $link['target'] ? ' target="_blank"' : '';
          ?>
          <div class="r1-container__button" data-reveal="img">
            <a href="<?= $url ?>" class="button button--hover-w" <?= $target ?>>
              <span class="button__name"><?= $title ?></span>
              <span class="button__icon">
                <img src="<?= $dir ?>img/svg/icon-button-white.svg" inline-svg alt="">
              </span>
            </a>
          </div>
        <?php } ?>
      </div>
    </section>

    <section class="r2-container">
      <div class="r2-container__wrapper block-wrapper">
        <h2 class="r2-container__title h2-title" data-reveal="txt"><?php the_field('b4_t') ?></h2>
        <div class="r2-container__info">
          <?php if ($el = get_field('b4_d')): ?>
            <div class="r2-container__description description" data-reveal="txt"><?= $el ?></div>
          <?php endif; ?>
          <?php $el = get_field('b4_list');
          if ($el) { ?>
            <div class="r2-container__list" data-reveal="txt">
              <ul class="list">
                <?php foreach ($el as $it) { ?>
                  <li class="list__item"><?= $it['t'] ?></li>
                <?php } ?>
              </ul>
            </div>
          <?php } ?>
        </div>
        <div class="r2-container__image-box" data-reveal="img">
          <div class="image">
            <?php $img = get_field('b4_img'); ?>
            <img data-src="<?= $img['url'] ?: $dir . "img/photos/random-image-4.jpg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
          </div>
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