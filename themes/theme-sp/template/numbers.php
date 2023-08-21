<?php
$dir = get_bloginfo("template_directory") . "/";
if(is_front_page())
  $title = get_field('num_t') ?: 'Fado в цифрах';
else $title = get_field('t')?: get_the_title();
?>
<section class="numbers-container">
  <div class="numbers-container__wrapper block-wrapper">
    <h1 class="numbers-container__title h2-title" data-reveal="txt"><?= $title ?></h1>
    <?php if ($el = get_field('num_d')): ?>
      <div class="numbers-container__description description" data-reveal="txt"><?= $el ?></div>
    <?php endif; ?>
    <?php $el = get_field('num_list');
    if ($el) { ?>

      <ul class="numbers-container__number-box" data-number-box data-reveal="txt">
        <?php foreach ($el as $n => $it) {
          $n++; ?>
          <li class="numbers-container__number-item" data-number-hover-button="<?= $n ?>">
            <div class="number-item">
              <div class="number-item__number" data-number-item="<?= $it['num'] ?: 0 ?>">0</div>
              <div class="number-item__caption"><?= $it['t'] ?></div>
            </div>
          </li>
        <?php } ?>
      </ul>

      <div class="numbers-container__image-box" data-reveal="img">   
        <?php foreach ($el as $n => $it) {
          $n++; ?>
          <div class="numbers-container__image<?php if ($n < 2) echo ' active' ?>" data-number-hover-target="<?= $n ?>">
            <div class="image image--h100">
              <?php $img = $it['img']; ?>
              <img data-src="<?= $img['url'] ?: $dir . "" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>" class="lazy-img">
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</section>     