<?php
/*
Template Name: новина
Template Post Type: post
*/
$dir       = get_bloginfo("template_directory") . "/";
$h1        = get_field('t') ?: get_the_title();
$id        = get_the_ID();
$ancestors = get_field('cat_pCareer', 'options') ?: pll_get_post(189); // page Career 189
get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors) ?>

    <section class="vacancy-container">
      <div class="vacancy-container__wrapper block-wrapper">
        <h1 class="vacancy-container__title h2-title" data-reveal="txt"><?= $h1 ?></h1>

        <div class="vacancy-container__tagline" data-reveal-container>
          <?php if ($el = get_field('city')): ?>
            <div class="vacancy-container__location" data-reveal="img">
              <span>
                <img src="<?= $dir ?>img/svg/icon-location.svg" inline-svg alt="">
              </span>
              <span><?= $el ?></span>
            </div>
          <?php endif; ?>

          <?php if ($el = get_field('type_employment')): ?>
            <div class="vacancy-container__time" data-reveal="img">
              <span>
                <img src="<?= $dir ?>img/svg/icon-time.svg" inline-svg alt="">
              </span>
              <span><?= $el ?></span>
            </div>
          <?php endif; ?>

          <div class="vacancy-container__socials-list" data-reveal="img">
            <span><?php _e('Поделиться', 'theme-sp') ?>:</span>
            <ul class="socials-list">
              <li class="socials-list__item">
                <a href="viber://forward?text=<?php the_permalink(); ?> <?= $h1 ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-viber.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="https://telegram.me/share/url?url=<?php the_permalink(); ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-telegram.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="whatsapp://send?text=<?php the_permalink(); ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-whatsapp.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php the_permalink(); ?>&p[title]=<?= $h1 ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-facebook.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="https://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?= $h1; ?>&amp;hashtags=my_hashtag" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-twitter.svg" inline-svg alt="">
                </a>
              </li>
              <li class="socials-list__item">
                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?= $h1; ?>&summary=&source=<?php bloginfo('name'); ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-linkedin.svg" inline-svg alt="">
                </a>
              </li>
            </ul>

          </div>
        </div>

        <?php $el = get_field('list');
        if ($el) { ?>

          <?php foreach ($el as $it) { ?>
            <div class="vacancy-container__term vacancy-term" data-reveal-container>
              <h2 class="vacancy-term__title" data-reveal="txt"><?= $it['t'] ?></h2>
              <div class="vacancy-term__info">
                <?php if ($it['d']): ?>
                  <div class="vacancy-term__description description" data-reveal="txt"><?= $it['d'] ?></div>
                <?php endif; ?>
                <?php $elCh = $it['list'];
                if ($elCh) { ?>
                  <div class="vacancy-term__list" data-reveal="txt">
                    <ul class="list">
                      <?php foreach ($elCh as $itCh) { ?>
                        <li class="list__item"><?= $itCh['t'] ?></li>
                      <?php } ?>
                    </ul>
                  </div>
                <?php } ?>
              </div>
            </div>
          <?php } ?>

        <?php } ?>

      </div>
    </section>

    <section class="form-container bg">
      <div class="form-container__wrapper block-wrapper">
        <h2 class="form-container__title h2-title h2-title--orange" data-reveal="txt"><?php the_field('form_t', $ancestors) ?></h2>
        <div class="form-container__description description description--white" data-reveal="txt"><?php the_field('form_d', $ancestors) ?></div>

        <div class="form-container__form" data-reveal="elem">
          <form class="form" action="#" novalidate>
            <input type="hidden" name="form_name" value="<?php the_field('form_t', $ancestors) ?> - <?= $h1 ?>">
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

            <div class="form__file form-input">
              <div class="file-field">
                <div class="file-field__wrapper">
                  <div class="file-field__name">
                    <div class="file-field__file-name" data-def="<?= get_field('form_cv', 'options') ?: 'CV' ?>"><?= get_field('form_cv', 'options') ?: 'CV' ?></div>
                    <div class="file-field__type">.doc.pdf</div>
                  </div>
                  <div class="file-field__button file-field__button_upload">
                    <img src="<?= $dir ?>img/svg/icon-file-upload.svg" alt="">
                  </div>
                  <div class="file-field__button file-field__button_delete">
                    <img src="<?= $dir ?>img/svg/icon-file-delete.svg" alt="">
                  </div>
                </div>
              </div>
              <input name="file[]" class="file-field__default-btn file-input _file _required" type="file" accept=".doc,.docx,.pdf" hidden>
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