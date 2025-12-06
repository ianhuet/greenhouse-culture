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
      <section class="bap-title">
        <div class="bap-title-content">
          <h1>BIODIVERSITY AMBASSADOR PROGRAMME</h1>
          <p>The <strong>Biodiversity Ambassador Programme</strong> is an environmental initiative developed by Greenhouse Culture, in association with <a rel="noreferrer noopener" href="https://greensodireland.ie/" target="_blank">Green Sod Ireland Land Trust</a> - the first of its kind in Ireland.</p>
        </div>
      </section>

      <section class="bap-hero">
        <header>
          <p>In order to protect the planet, and our own future, it is time to come together and call for action on biodiversity loss. This network creates a supportive space for all individuals to honour and protect biodiversity, to discover more about the intrinsic value of nature, and advocate for the right of all living beings. If you are interested in biodiversity and advocating for a sustainable future for all then we would love you to get in touch.</p>

          <div class="bap-quote">
            <p>"Biodiversity is our most valuable but least appreciated resource."</p>
            <cite>Edward O. Wilson</cite>
          </div>

          <p>This hub will provide you with any resources you may need, and offer a space to highlight your actions and communications throughout the year.</p>
        </header>

        <div class="bap-media">
          <div class="bap-media-video">
            <video controls poster="<?php echo get_template_directory_uri(); ?>/assets/images/bap_video_poster.jpg">
              <source src="<?php echo get_template_directory_uri(); ?>/assets/images/BAP_Why_What.mp4" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          </div>
        </div>
      </section>


      <section class="bap-tabbed-content">
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
        <h3>Biodiversity Ambassodors</h3>
        <p><a href="#">Members can login here</a> to get full access to this map, and connect with others in the biodiversity focused network.</p>
        <?php echo do_shortcode('[ambassador_map private="false"]'); ?>
      </section>

      <section class="bap-join">
        <h3>Join the Biodiversity Ambassodors</h3>

        <div class="bap-join-content">
          <div>
            <p>Becoming a Biodiversity Ambassador is about finding your voice, and your voice to help protect our wild acres, and restore safe havens where species can thrive and flourish, vital for biodiversity.</p>
            <p>The Biodiversity Ambassador Programme is a place to come together in community with likeminded people. to project and nurture our natural environment and all its biodiversity. A place where together we can deepen our connection with nature, and develop stronger interconnected relationships with all living beings.</p>
          </div>

          <form>
            <div class="form-row">
              <input type="text" name="firstname" placeholder="First Name" required>
              <input type="text" name="lastname" placeholder="Last Name" required>
            </div>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone">
            <button type="submit">Submit</button>
          </form>
        </div>
      </section>

      <section class="bap-logos">
        <p>The vision of Greenhouse Culture, as with our associates Green sod Ireland Land Trust, is where our Earth's ecosystems are thriving and flourishing. We believe together we are stronger; together we can protect our natural environment for present and future generations.</p>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ghc_bap_logos.webp" alt="Biodiversity Ambassador Programme Partners" class="logos-image" />
      </section>
</div>

  </div>
</section>

<?php
get_footer();
