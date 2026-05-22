<?php
/**
 * Template Name: Ambassadors Homepage
 */

get_header();
?>

<section class="ambassador-homepage">
  <div class="container">
    <div class="breadcrumbs-wrap">
      <?php do_action('greenhouseculture_breadcrumb_options_hook'); ?>
    </div>

    <div class="container bap-box">
      <section class="bap-title">
        <div class="bap-title-content">
          <h1>BIODIVERSITY AMBASSADOR PROGRAMME</h1>
          <p>The <strong>Biodiversity Ambassador Programme</strong> is an environmental initiative developed by Greenhouse Culture, in association with <a rel="noreferrer noopener" href="https://greensodireland.ie/" target="_blank">Green Sod Ireland Land Trust</a> — the first of its kind in Ireland.</p>
        </div>
      </section>

      <section class="bap-hero">
        <header>
          <?php the_content() ?>
        </header>

        <div class="bap-media">
          <div class="bap-media-video" data-youtube-id="xH57NaCZtto">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bap_video_poster.jpg" alt="Video thumbnail" class="bap-youtube-poster">
          </div>
          <p class="bap-media-video-caption"><strong>Why we do what we do</strong> ~ introducing the Biodiversity Ambassadors</p>
        </div>
      </section>


      <section class="bap-tabbed-content">
        <div class="tabs">
          <button class="tab active" data-tab="facts">Facts</button>
          <button class="tab" data-tab="ideas">Ideas</button>
          <button class="tab" data-tab="community">Community</button>
        </div>

        <div class="tab-panels">
          <div class="tab-panel active" id="facts">
            <div class="content-image">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bap_ideas.jpg" alt="Facts">
            </div>
            <div class="content-list">
              <ul>
                <li>Globally, monitored wildlife populations have declined by 73% since 1970, and around one million species face extinction.</li>
                <li>Ireland reflects this crisis in our own hedgerows, bogs, and fields.</li>
                <li>90% of Ireland’s EU-protected habitats have ‘bad’ or ‘inadequate’ conservation status.</li>
                <li>One third of Ireland’s 98 bee species are threatened with extinction</li>
                <li>54 of Ireland’s 211 bird species (26%) are now Red-listed for conservation concern</li>
              </ul>
              <a class="read-more" href="/biodiversity-ambassador-programme/facts-actions-ideas">Read More</a>
            </div>
          </div>

          <div class="tab-panel" id="ideas">
            <div class="content-image">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bap_facts.jpg" alt="Ideas">
            </div>
            <div class="content-list">
              <ul>
                <li>Small changes that make an immediate difference - no planning required.</li>
                <li>Project that need a bit of preparation or coordination.</li>
                <li>Ideas for those ready to mobilise others and engage institutions.</li>
                <li>Advocacy ideas on making biodiversity part of public discourse.</li>
              </ul>
              <a class="read-more" href="/biodiversity-ambassador-programme/facts-actions-ideas/#bap-ideas">Read More</a>
            </div>
          </div>

          <div class="tab-panel" id="community">
            <div class="content-image">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bap_resources.jpg" alt="Community">
            </div>
            <div class="content-list">
              <p>Ordinary people are proving that citizen-led action can restore biodiversity, these initiatives started with local concern and grew into measurable success:</p>
              <ul>
                <li>Abbeyleix Bog, Ireland</li>
                <li>Oslo Pollinator Passage, Norway</li>
                <li>Utrecht Bee Stops, Netherlands</li>
                <li>The Burren, Ireland</li>
                <li>Gökova Bay, Turkey</li>
              </ul>
              <a class="read-more" href="/biodiversity-ambassador-programme/ideas-facts-resources/">Read More</a>
            </div>
          </div>
        </div>
      </section>

      <section class="bap-location-map">
        <h3>Biodiversity Ambassadors</h3>
        <?php echo do_shortcode('[ambassador_map private="false"]'); ?>
      </section>

      <section class="bap-join">
        <h3>Greenhouse Culture Newsletter</h3>

        <div class="bap-join-content">
          <div>
            <p>We warmly invite you to stay connected as the programme evolves. Sign up for our newsletter to receive updates on the Biodiversity Ambassador Programme, Greenhouse Culture projects, new resources, and ways to engage with us.</p>
            <p>Join a growing community of people who care about restoring balance, protecting wild places, and honouring the rich web of life we all depend on.</p>
          </div>

          <?php echo do_shortcode('[kit_signup]'); ?>
        </div>
      </section>

      <section class="bap-logos">
        <p>The vision of Greenhouse Culture, as with our associates Green sod Ireland Land Trust, is where Earth's ecosystems are thriving and flourishing. We believe together we are stronger; together we can protect our natural environment for present and future generations.</p>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ghc_bap_logos.webp" alt="Biodiversity Ambassador Programme Partners" class="logos-image" />
      </section>
</div>

  </div>
</section>

<?php
get_footer();
