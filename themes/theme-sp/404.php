<?php
$dir = get_bloginfo("template_directory") . "/";
get_header();
?>

  <section class="head-404">
    <div class="head-404__wrapper block-wrapper">
      <h1 class="head-404__title" data-reveal="txt">404</h1>
      <div class="head-404__description" data-reveal="txt">
        <p><?php _e('Упс! Такої сторінки на існує.','theme-sp') ?></p>
      </div>
      <div class="head-404__button" data-reveal="img">
        <a href="<?= pll_home_url() ?>" class="button button--black">
          <span class="button__name"><?php _e('На головну','theme-sp') ?></span>
          <span class="button__icon">
            <img src="<?= $dir ?>img/svg/icon-button-orange.svg" inline-svg alt="">
          </span>
        </a>
      </div>
    </div>
  </section>

<?php
get_footer();
