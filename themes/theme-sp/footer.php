<?php
$dir = get_bloginfo("template_directory") . "/"; ?>

<footer class="footer">
  <div class="footer__wrapper block-wrapper" data-reveal="elem">
    <div class="footer__content">

      <div class="footer__block">
        <div class="footer__logo">
          <a href="<?= $dir ?>index.html">
            <?php $img = get_field('f_logo', 'options'); ?>
            <img src="<?= $img['url'] ?: $dir . "img/svg/logo.svg" ?>" alt="<?= $img['alt'] ?: $img['name'] ?: get_the_title() ?>">
          </a>
        </div>
        <div class="footer__description"><?php the_field('f_d', 'options') ?></div>
        <?php if ($el = get_field('f_download_file', 'options')): ?>
          <div class="footer__button">
            <a href="<?= $el ?>" class="inline-btn" download>
              <span class="inline-btn__name"><?= get_field('f_download_t', 'options') ?: 'Скачать прайс' ?></span>
              <span class="inline-btn__icon">
                <img src="<?= $dir ?>img/svg/icon-button-download.svg" inline-svg alt="">
              </span>
            </a>
          </div>
        <?php endif; ?>
      </div>

      <div class="footer__block">
        <h3 class="footer__title"><?php the_field('f_navT', 'options') ?></h3>
        <?php $el = get_field('f_nav', 'options');
        if ($el) { ?>
          <ul class="footer__list">
            <?php foreach ($el as $n => $it) { ?>
              <?php if ($it['link']):
                $url = $it['link']['url'] ?: '#';
                $title = $it['link']['title'] ?: 'link';
                $target = $it['link']['target'] ? ' target="_blank"' : ''; ?>
                <li class="footer__list-item">
                  <a href="<?= $url ?: '#' ?>"<?= $target ?>><?= $title ?></a>
                </li>
              <?php endif ?>
            <?php } ?>
          </ul>
        <?php } ?>
      </div>

      <div class="footer__block">
        <h3 class="footer__title"><?php the_field('f_navRT', 'options') ?></h3>
        <?php $el = get_field('f_navR', 'options');
        if ($el) { ?>
          <ul class="footer__list">
            <?php foreach ($el as $n => $it) { ?>
              <?php if ($it['link']):
                $url = $it['link']['url'] ?: '#';
                $title = $it['link']['title'] ?: 'link';
                $target = $it['link']['target'] ? ' target="_blank"' : ''; ?>
                <li class="footer__list-item">
                  <a href="<?= $url ?: '#' ?>"<?= $target ?>><?= $title ?></a>
                </li>
              <?php endif ?>
            <?php } ?>
          </ul>
        <?php } ?>
      </div>

      <div class="footer__block">
        <h3 class="footer__title"><?php the_field('f_cont_t', 'options') ?></h3>
        <?php if ($el = get_field('f_cont_tel', 'options')): ?>
          <?php
          $tel     = $el;
          $telLink = preg_replace("/[^+\d]/", "", $tel);
          ?>
          <div class="footer__contact">
            <a href="tel:<?= $telLink ?>"><?= $tel ?></a>
            <div class="footer__contact-info"><?php the_field('f_cont_telT', 'options') ?></div>
          </div>
        <?php endif; ?>
        <?php if ($el = get_field('f_cont_email', 'options')): ?>
          <div class="footer__contact">
            <a href="mailto:<?= $el ?>"><?= $el ?></a>
          </div>
        <?php endif; ?>
        <div class="footer__socials-list">
          <ul class="socials-list">
            <?php if ($el = get_field('f_cont_instagram', 'options')): ?>
              <li class="socials-list__item">
                <a href="<?= $el ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-instagram.svg" inline-svg alt="">
                </a>
              </li>
            <?php endif; ?>
            <?php if ($el = get_field('f_cont_facebook', 'options')): ?>
              <li class="socials-list__item">
                <a href="<?= $el ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-facebook.svg" inline-svg alt="">
                </a>
              </li>
            <?php endif; ?>
            <?php if ($el = get_field('f_cont_youtube', 'options')): ?>
              <li class="socials-list__item">
                <a href="<?= $el ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-youtube.svg" inline-svg alt="">
                </a>
              </li>
            <?php endif; ?>
            <?php if ($el = get_field('f_cont_linkedin', 'options')): ?>
              <li class="socials-list__item">
                <a href="<?= $el ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-linkedin.svg" inline-svg alt="">
                </a>
              </li>
            <?php endif; ?>
            <?php if ($el = get_field('f_cont_telegram', 'options')): ?>
              <li class="socials-list__item">
                <a href="<?= $el ?>" target="_blank">
                  <img src="<?= $dir ?>img/svg/icon-social-telegram.svg" inline-svg alt="">
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

      <div class="footer__block">
        <div class="footer__scroll-to-top">
          <a href="#top" class="scroll-to-top">
            <img class="scroll-to-top__circle" src="<?= get_field('f_top', 'options')?: "{$dir}img/svg/scroll-to-top-circle.svg" ?>" inline-svg alt="">
            <img class="scroll-to-top__arrow" src="<?= $dir ?>img/svg/scroll-to-top-arrow.svg" inline-svg alt="">
          </a>
        </div>
      </div>

    </div>
    <div class="footer__copyright copyright">
      <div class="copyright__description"><?php the_field('f_copy', 'options') ?></div>
      <?php $link = get_field('f_policy', 'options');
      if ($link) {
        $url = $link['url'] ?: '#';
        $title = $link['title'] ?: 'LINK';
        $target = $link['target'] ? ' target="_blank"' : '';
        ?>
        <div class="copyright__link">
          <a href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
        </div>
        <?php
      } ?>
      <div class="copyright__increate">
        <span>by:</span>
        <a href="https://in-create.com/" target="_blank">
          <img src="<?= $dir ?>img/svg/increate.svg" alt="">
        </a>
      </div>
    </div>
  </div>
</footer>

<?php require_once get_template_directory() . '/template/popup.php' ?>
<script>
  let dir = "<?= $dir ?>";
  let messageEmpty = "<?php _e('Обязательное поле', 'theme-sp') ?>",
    messageIncorrect = "<?php _e('Некорректные данные', 'theme-sp') ?>",
    messageIncorrectFile = "<?php _e('Неверный формат файла', 'theme-sp') ?>",
    messageChooseFile = "<?php _e('Добавить CV', 'theme-sp') ?>";
</script>

<?php wp_footer(); ?>

<?php require_once get_template_directory() . '/template/micro-seo.php' ?>
</div><!--bodyWr-->
</body>
</html>