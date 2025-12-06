<?php
/**
 * Template Name: Ambassadors Page
 */

get_header();
?>

<section class="ambassador-page">
  <div class="container">
    <div class="breadcrumbs-wrap">
      <?php do_action('greenhouseculture_breadcrumb_options_hook'); ?>
    </div>

    <div class="container bap-box">
      <section class="bap-title">
        <div class="bap-title-content">
          <h1>BIODIVERSITY AMBASSADOR PROGRAMME</h1>
          <p>The <strong>Biodiversity Ambassador Programme</strong> is an environmental initiative developed by Greenhouse Culture, in association with <a rel="noreferrer noopener" href="https://greensodireland.ie/" target="_blank">Green Sod Ireland Land Trust</a> - the first of its kind in Ireland.</p>
        </div>
      </section>

      <?php
      while (have_posts()) {
        the_post();
        the_content();
      }
      ?>
</div>

  </div>
</section>

<?php
get_footer();
