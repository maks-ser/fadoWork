<?php
/*
Template Name: Контакты
*/
$dir       = get_bloginfo("template_directory") . "/";
$ancestors = get_ancestors(get_the_ID(), 'page');
$h1        = get_field('t') ?: get_the_title();
$department = get_field('dep');
get_header();
?>

  <main class="main main--etc">
    <?php breadcrumb($h1, $ancestors); ?>

    <section class="contact-container">

        <div class="contact-container__wrapper block-wrapper" data-reveal-container>
            <h1 class="contact-container__title h2-title" data-reveal="txt"><?= $h1 ?></h1>
            <div class="contact-container__box">
                <?php if ($el = get_field('tel')): ?>
                    <?php
                    $tel = $el;
                    $telLink = preg_replace("/[^+\d]/", "", $tel);
                    ?>
                    <div class="contact-container__contact" data-reveal="txt">
                        <a href="tel:<?= $telLink ?>"><?= $tel ?></a>
                        <div class="contact-container__contact-info"><?php the_field('telT') ?></div>
                    </div>
                <?php endif; ?>
                <?php if ($el = get_field('email')): ?>
                    <div class="contact-container__contact" data-reveal="txt">
                        <a href="mailto:<?= $el ?>"><?= $el ?></a>
                    </div>
                <?php endif; ?>
                <div class="contact-container__socials-list" data-reveal="txt">
                    <ul class="socials-list">
                        <?php $link = get_field('instagram');
                        if ($link) { ?>
                            <li class="socials-list__item">
                                <a href="<?= $link ?>" target="_blank">
                                    <img src="<?= $dir ?>img/svg/icon-social-instagram.svg" inline-svg alt="">
                                </a>
                            </li>
                        <?php } ?>
                        <?php $link = get_field('facebook');
                        if ($link) { ?>
                            <li class="socials-list__item">
                                <a href="<?= $link ?>" target="_blank">
                                    <img src="<?= $dir ?>img/svg/icon-social-facebook.svg" inline-svg alt="">
                                </a>
                            </li>
                        <?php } ?>
                        <?php $link = get_field('youtube');
                        if ($link) { ?>
                            <li class="socials-list__item">
                                <a href="<?= $link ?>" target="_blank">
                                    <img src="<?= $dir ?>img/svg/icon-social-youtube.svg" inline-svg alt="">
                                </a>
                            </li>
                        <?php } ?>
                        <?php $link = get_field('linkedin');
                        if ($link) { ?>
                            <li class="socials-list__item">
                                <a href="<?= $link ?>" target="_blank">
                                    <img src="<?= $dir ?>img/svg/icon-social-linkedin.svg" inline-svg alt="">
                                </a>
                            </li>
                        <?php } ?>
                        <?php $link = get_field('telegram');
                        if ($link) { ?>
                            <li class="socials-list__item">
                                <a href="<?= $link ?>" target="_blank">
                                    <img src="<?= $dir ?>img/svg/icon-social-telegram.svg" inline-svg alt="">
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php
                foreach($department as $item => $dep) { ?>

                    <div class="contact-container__box mx__contact" data-reveal-container>
                        <div class="mx__contact-block left" data-reveal="txt">
                            <h2 class="title_d"><?php echo $dep['d_name'] ?></h2>
                            <p class="contact__bold">
                                <?php echo $dep['job'] ?>
                            </p>
                            <?php if(!empty($dep['name'])) { ?>
                                <p >
                                    <?php  echo $dep['name'] ?>
                                </p>
                           <?php }?>
                            <?php if ($tels = $dep['phones'] ): ?>
                                <?php
                                foreach($tels as $ph) {
                                    $telLink = preg_replace("/[^+\d]/", "", $ph['phone']); ?>
                                    <p>
                                        <?php echo $ph['phone'] ?>
                                    </p>
                                <?php }  ?>
                            <?php endif; ?>
                            <?php if ($email = $dep['email'] ): ?>
                                <p class="red_t"><a href="mailto:<?= $email ?>"><?= $email ?></a></p>
                            <?php endif; ?>
                        </div>
                        <div class="mx__contact-block center" data-reveal="txt">

                            <p class="contact__bold">
                                Час роботи
                            </p>
                            <?php if($wday = $dep['wday']) { ?>
                                <p >
                                    <?php  echo esc_html($wday) ?>
                                </p>
                            <?php }?>
                            <?php if ($weekend1 = $dep['weekend1'] ): ?>
                                <p >
                                    <?php  echo esc_html($weekend1) ?>
                                </p>
                            <?php endif; ?>
                            <?php if ($weekend2 = $dep['weekend2'] ): ?>
                                <p >
                                    <?php  echo esc_html($weekend2) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="mx__contact-block right" data-reveal="txt">

                            <p class="contact__bold">
                                Адреса
                            </p>
                            <?php if($address = $dep['address']) { ?>
                                <p >
                                    <?php  echo esc_html($address) ?>
                                </p>
                            <?php }?>

                        </div>

                    </div>


               <? }  ?>

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
            <div class="form__textarea textarea">
              <textarea name="textarea" class="textarea__input" placeholder="<?= get_field('form_textarea', 'options') ?: 'Кратко опишите ваш запрос' ?>"></textarea>
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