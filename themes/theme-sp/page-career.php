<?php
/*
Template Name: Карьера
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
$outCountPost = 9; //9
?>

  <section class="sub-head sub-head--title">
    <div class="sub-head__wrapper">
      <div class="sub-head__bg">
        <div class="sub-head__gradient"></div>
        <div class="sub-head__image" data-reveal="elem">
          <div class="image">
            <?php $img = get_field('fon'); ?>
            <img class="lazy-img" data-src="<?= $img['url'] ?: $dir . "img/photos/sub-head-image-2_orig.png" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>">
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
    <section class="t-d-container">
      <div class="t-d-container__wrapper block-wrapper" data-reveal-container>

        <div class="t-d-container__description description" data-reveal="txt"><?php the_field('d') ?></div>

        <?php
        $current_page = 1;
        if (get_query_var('paged')) $current_page = get_query_var('paged');
        else if (get_query_var('page')) $current_page = get_query_var('page');
        $args         = array (
          //'taxonomy' => 'category',
          'posts_per_page' => $outCountPost,
          'paged'          => $current_page,
          'post_type'      => 't-vacancy',
          'post_status'    => 'publish',
        );

        $query = new WP_Query($args);
        $countView = 0;

        if ($query->have_posts()):?>
          <div class="t-d-container__m-set">
            <?php
            while ($query->have_posts()): $query->the_post(); $countView++;?>
              <div class="t-d-container__m-item" data-reveal="img">
                <a href="<?php the_permalink(); ?>" class="v-item">
                  <div class="v-item__header">
                    <?php if ($el = get_field('city')): ?>
                      <div class="v-item__location">
                        <span>
                          <img src="<?= $dir ?>img/svg/icon-location.svg" inline-svg alt="">
                        </span>
                        <span><?= $el ?></span>
                      </div>
                    <?php endif; ?>
                    <?php if ($el = get_field('type_employment')): ?>
                      <div class="v-item__time">
                        <span>
                          <img src="<?= $dir ?>img/svg/icon-time.svg" inline-svg alt="">
                        </span>
                        <span><?= $el ?></span>
                      </div>
                    <?php endif; ?>
                  </div>
                  <h3 class="v-item__title"><?= get_field('t') ?: get_the_title() ?></h3>
                  <div class="v-item__button">
                    <div class="inline-btn">
                      <span class="inline-btn__name"><?php _e('детали вакансии', 'theme-sp') ?></span>
                      <span class="inline-btn__icon">
                        <img src="<?= $dir ?>img/svg/icon-c-item.svg" inline-svg alt="">
                      </span>
                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
          </div>
        <?php
        else: ?>
          <p class="text-nomore" data-reveal="img"><?php _e('идет наполнения раздела...', 'theme-sp'); ?></p>
        <?php endif; ?>


        <div class="t-d-container__footer" data-reveal="img">
          <div class="pagination-box">

            <div class="pagination-box__result"><?php _e('Показано', 'theme-sp') ?>
              <span class="pagination-box__result-cur"><?= $countView ?></span>
              <?php _e('из', 'theme-sp') ?>
              <span class="pagination-box__result-total"><?= $query->found_posts ?></span>
            </div>

            <?php
            if (function_exists('ps_pagenavi')) {
              $pagRes = ps_pagenavi($query);
              if ($pagRes):?>
                <div class="pagination-box__pagination"><?= $pagRes ?></div>
              <?php endif;
            } ?>
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
            <input type="hidden" name="form_name" value="<?php the_field('form_t') ?>">
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