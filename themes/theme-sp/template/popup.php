<?php $dir = get_bloginfo("template_directory") . "/"; ?>

<div class="popup" data-popup-target="product">
  <div class="popup__wrapper block-wrapper">
    <div class="popup__content">
      <div class="popup__cross-box">
        <div class="popup__cross" data-popup-close>
          <img src="<?= $dir ?>img/svg/icon-popup-cross.svg" alt="">
        </div>
      </div>
      <h2 class="popup__title"><?= get_field('pp_product_t', 'options') ?: 'Форма обратной связи' ?></h2>
      <div class="popup__form">
        <form class="form" action="#" novalidate>
          <input type="hidden" name="form_name" value="<?= get_field('pp_product_t', 'options') ?: 'Форма обратной связи' ?> - <?php _e('Заказать товар', 'theme-sp') ?>">
          <input type="hidden" name="productTitle" value="<?= get_field('t') ?: get_the_title() ?>">
          <input type="hidden" name="productSku" value="<?php the_field('sku') ?>">
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
              <button class="button button--black" type="submit">
                <span class="button__name"><?= get_field('form_btn', 'options') ?: 'Отправить' ?></span>
                <span class="button__icon">
                  <img src="<?= $dir ?>img/svg/icon-button-orange.svg" inline-svg alt="">
                </span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="popup popup--thanks" data-popup-target="thanks">
  <div class="popup__wrapper block-wrapper">
    <div class="popup__content">
      <div class="popup__cross-box">
        <div class="popup__cross" data-popup-close>
          <img src="<?= $dir ?>img/svg/icon-popup-cross.svg" alt="">
        </div>
      </div>
      <div class="popup__logo">
        <img src="<?= $dir ?>img/svg/logo.svg" alt="">
      </div>
      <div class="popup__info">
        <h2 class="popup__title h3-title"><?php the_field('pp_alert_t', 'options'); ?></h2>
        <div class="popup__description h4-title"><?php the_field('pp_alert_d', 'options'); ?></div>
        <div class="popup__button">
          <a href="<?= home_url() ?>" class="button button--black">
            <span class="button__name"><?php _e('На главную', 'theme-sp') ?></span>
            <span class="button__icon">
              <img src="<?= $dir ?>img/svg/icon-button-orange.svg" inline-svg alt="">
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="popup popup--project" data-popup-target="project">
  <div class="popup__wrapper block-wrapper">
    <div class="popup__content">
      <div class="popup__cross-box">
        <div class="popup__cross" data-popup-close>
          <img src="<?= $dir ?>img/svg/icon-popup-cross.svg" alt="">
        </div>
      </div>
      <div class="popup__project">
        <div class="project"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal modal--video" data-modal-target="video">
  <div class="modal__wrapper block-wrapper">
    <div class="modal__content">
      <div class="modal__cross-box">
        <div class="modal__cross" data-modal-close>
          <img src="<?= $dir ?>img/svg/icon-popup-cross.svg" inline-svg alt="">
        </div>
      </div>
      <div class="modal__image-box">
        <div class="modal__video" data-modal-video></div>
      </div>
    </div>
  </div>
</div>