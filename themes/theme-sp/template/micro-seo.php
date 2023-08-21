<?php
$dir = get_bloginfo("template_directory") . "/";
if( !get_field('seo_microseo', 'options') ):
  $email        = get_field('seo_email', 'options');
  $tel          = get_field('seo_tel', 'options');
  $city         = get_field('seo_city', 'options');
  $street       = get_field('seo_street', 'options');
  $postalCode   = get_field('seo_postalCode', 'options');
  $social       = get_field('seo_social', 'options');
  $openingHours = get_field('seo_openingHours', 'options');
  $lat          = get_field('seo_map_lat', 'options');
  $lng          = get_field('seo_map_lng', 'options');
  ?>
  <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "<?php bloginfo('name') ?>",
  "description": "<?php bloginfo('description') ?>",
  "url": "<?php echo get_site_url(null, '/') ?>",
  "logo": "<?= get_field('logo', 'options') ?: "{$dir}img/logo.svg" ?>",
  "image": [
    "<?= get_field('logo', 'options') ?: "{$dir}img/logo.svg" ?>"
  ],
  "address": {
    "@type": "PostalAddress"<?php if ($city) { ?>,
    "addressLocality": "<?= $city ?>"<?php }
    if ($street) { ?>,
    "streetAddress": "<?= $street ?>"<?php }
    if ($postalCode) { ?>,
    "postalCode": "<?= $postalCode ?>"<?php } ?>
  }<?php if ($email) { ?>,
  "email": "mailto:<?= $email ?>"<?php }
    if ($tel) { ?>,
  "telephone": "<?= $tel ?>"<?php }
    if ($social) { ?>,
  "sameAs": [<?php foreach ($social as $n => $it) { ?>"<?= $it['url'] ?>"<?= ++$n < count($social) ? ',' : '' ?><?php } ?>]<?php } ?>
  <?php if ($openingHours) { ?>,
  "contactPoint": [
    {
      "@type": "ContactPoint",
      "hoursAvailable": [<?php foreach ($openingHours as $n => $it) { ?>"<?= $it['t'] ?>"<?= ++$n < count($openingHours) ? ',' : '' ?><?php } ?>]
    }
  ]<?php } else { ?>,
  "contactPoint": [
    {
      "@type": "ContactPoint",
      "hoursAvailable": "mo-fr 9:00-18:00"
    }
  ]
  <?php } ?>
}
</script>
<?php endif; ?>