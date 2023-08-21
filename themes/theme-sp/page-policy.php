<?php
/*
Template Name: Политика конфиденциальности
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();

get_header();
?>

  <main class="main main--etc">

    <?php breadcrumb($h1); ?>

    <section class="t-d-container">
      <div class="t-d-container__wrapper block-wrapper">
        <h1 class="t-d-container__title t-d-container__title_sm" data-reveal="txt"><?= $h1 ?></h1>
        <?php $el = get_field('d');
        if($el){ ?>
        
          <?php foreach($el as $it) { ?>
            <div class="t-d-container__block">
              <h2 class="t-d-container__subtitle" data-reveal="txt"><?= $it['t'] ?></h2>
              <div class="t-d-container__description description" data-reveal="txt"><?= $it['d'] ?></div>
            </div>
          <?php }  ?>
          
        <?php }  ?>
      </div>
    </section>

    <?php require_once get_template_directory() . '/template/subscribe.php' ?>
  </main>

<?php
get_footer();