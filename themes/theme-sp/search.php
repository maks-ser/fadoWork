<?php
$dir = get_bloginfo("template_directory") . "/";
$h1  = get_field('h1') ?: get_the_title();

get_header();
?>
  <main class="main main--etc">
    <?php breadcrumb(__('Поиск', 'theme-sp')); ?>

    <section class="t-d-container">
      <div class="t-d-container__wrapper block-wrapper">
        <h1 class="t-d-container__title t-d-container__title_sm" data-reveal="txt"><?php _e('Результат поиска', 'theme-sp'); ?> : <?= get_search_query() ?></h1>

        <?php if (have_posts()) : ?>


          <?php
          while (have_posts()) :the_post(); ?>
            <div class="t-d-container__block">
              <h2 class="t-d-container__subtitle" data-reveal="txt">
                <a href="<?php the_permalink(); ?>" style="text-decoration: underline;"><?= get_field('h1') ?: get_the_title(); ?></a>
              </h2>
            </div>
          <?php endwhile; ?>

          <?php if (function_exists('ps_pagenavi')) {
            echo ps_pagenavi();
          } ?>

        <?php else : ?>
          <div class="t-d-container__block">
            <div class="t-d-container__description description">
              <p><?php _e('за вашим запросом ничего не найдено...', 'theme-sp') ?></p>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();