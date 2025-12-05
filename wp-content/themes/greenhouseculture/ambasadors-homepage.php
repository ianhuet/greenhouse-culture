<?php
/**
 * Template Name: Ambassadors Homepage
 */

get_header();
?>

<section class="ambassador-page">
  <div class="container">
    <div class="breadcrumbs-wrap">
      <?php do_action('greenhouseculture_breadcrumb_options_hook'); ?>
    </div>

    <div class="container bap-box">
      <h1>BIODIVERSITY AMBASSADOR PROGRAMME</h1>
      <section class="bap-hero">
        <header>
          <p><em>The <strong>Biodiversity Ambassador Programme</strong> is an environmental initiative developed by Greenhouse Culture, in association with <a rel="noreferrer noopener" href="https://greensodireland.ie/" target="_blank">Green Sod Ireland Land Trust</a> - the first of its kind in Ireland.</em></p>

          <p>In order to protect the planet, and our own future, it is time to come together and call for action on biodiversity loss. This network creates a supportive space for all individuals to honour and protect biodiversity, to discover more about the intrinsic value of nature, and advocate for the right of all living beings. If you are interested in biodiversity and advocating for a sustainable future for all then we would love you to get in touch.</p>

          <p>This hub will provide you with any resources you may need, and offer a space to highlight your actions and communications throughout the year.</p>
        </header>

        <div class="bap-media">
          <div class="bap-media-video">
            <!-- <video controls poster="<?php echo get_template_directory_uri(); ?>/assets/images/BAP_Why_What_poster.jpg"> -->

            <video controls>
              <source src="<?php echo get_template_directory_uri(); ?>/assets/images/BAP_Why_What.mp4" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          </div>

          <h3>WHY WE DO WHAT WE DO</h3>
          <div class="bap-ambassadors">
            <div class="media-box"></div>
            <div class="media-box"></div>
            <div class="media-box"></div>
          </div>
        </div>
      </section>

      <section class="tabbed-content">
        <div class="tabs">
          <button class="tab active" data-tab="ideas">Ideas</button>
          <button class="tab" data-tab="facts">Facts</button>
          <button class="tab" data-tab="resources">Resources</button>
        </div>

        <div class="tab-panels">
          <div class="tab-panel active" id="ideas">
            <div class="content-image">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bap_ideas.jpg" alt="Ideas">
            </div>
            <div class="content-list">
              <ul>
                <li>Share your biodiversity projects and initiatives</li>
                <li>Collaborate with other ambassadors on conservation efforts</li>
                <li>Submit your success stories and case studies</li>
                <li>Connect with local communities and organizations</li>
              </ul>
              <button class="read-more">Read More</button>
            </div>
          </div>

          <div class="tab-panel" id="facts">
            <div class="content-image">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bap_facts.jpg" alt="Facts">
            </div>
            <div class="content-list">
              <ul>
                <li>Ireland is home to over 30,000 species of wildlife</li>
                <li>Native hedgerows support up to 600 plant species</li>
                <li>One-third of bee species in Ireland are threatened</li>
                <li>Peatlands store 75% of Ireland's soil carbon</li>
              </ul>
              <button class="read-more">Read More</button>
            </div>
          </div>

          <div class="tab-panel" id="resources">
            <div class="content-image">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bap_resources.jpg" alt="Resources">
            </div>
            <div class="content-list">
              <ul>
                <li>Download educational materials and guides</li>
                <li>Access biodiversity monitoring tools</li>
                <li>View training videos and webinars</li>
                <li>Get templates for action plans and reports</li>
              </ul>
              <button class="read-more">Read More</button>
            </div>
          </div>
        </div>
      </section>

      <section class="bap-location-map">
        <?php echo do_shortcode('[ambassador_map]'); ?>
      </section>

      <section class="bap-logos">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ghc_bap_logos.webp" alt="Biodiversity Ambassador Programme Partners" class="logos-image" />
      </section>
</div>

  </div>
</section>

<?php
get_footer();
