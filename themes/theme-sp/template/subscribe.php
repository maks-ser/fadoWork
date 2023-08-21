<?php $dir = get_bloginfo("template_directory") . "/"; ?>
<section class="subscribe-block">
  <div class="subscribe-block__wrapper block-wrapper" data-reveal="elem">
    <form class="subscribe-block__form" action="#" novalidate>
      <input type="hidden" name="form_name" value="<?= get_field('form_subscribe_t', 'options') ?: 'Подписуйся на наши новости и будь вкурсе специальных предложений' ?>">
      <div class="subscribe-block__icon">
        <img src="<?= $dir ?>img/svg/icon-subscribe-block.svg" inline-svg alt="">
      </div>
      <h2 class="subscribe-block__title h4-title h4-title--white"><?= get_field('form_subscribe_t', 'options') ?: 'Подписуйся на наши новости и будь вкурсе специальных предложений' ?></h2>
      <div class="subscribe-block__input subscribe-input form-input">
        <input name="email" class="subscribe-input__input _email _required" placeholder="<?= get_field('form_subscribe_email', 'options') ?: 'Введите ваш Email' ?>" type="email">
        <button class="subscribe-input__button" type="submit">
          <img src="<?= $dir ?>img/svg/icon-button-subscribe.svg" inline-svg alt="">
        </button>
        <div class="failure">
          <span class="failure__text"></span>
        </div>
      </div>
    </form>
  </div>
</section>