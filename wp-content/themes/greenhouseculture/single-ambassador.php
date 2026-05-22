<?php

get_header();

$slug = get_query_var('ambassador_profile');
$user = get_user_by('slug', $slug);

if (!$user || !in_array('ambassador', (array) $user->roles)) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part('404');
    get_footer();
    return;
}

$display_name = $user->display_name ?: $user->user_login;
$nick_name = get_user_meta($user->ID, 'nickname', true) ?: $display_name;

$avatar_url = function_exists('ghc_get_ambassador_avatar_url')
    ? ghc_get_ambassador_avatar_url($user->ID)
    : '';
$website = $user->user_url;
$bio = get_user_meta($user->ID, 'ambassador_bio', true) ?: $user->description;
$projects = get_user_meta($user->ID, 'ambassador_projects', true);
$user_tags = get_user_meta($user->ID, 'ambassador_tags', true) ?: [];
$user_support = get_user_meta($user->ID, 'ambassador_support', true) ?: [];

$categories = function_exists('ghc_get_categories') ? ghc_get_categories() : [];
$support_options = function_exists('ghc_get_support_options') ? ghc_get_support_options() : [];

$grouped_tags = [];
foreach ($categories as $category) {
    $matched = [];
    foreach ($category['subcategories'] as $subcategory) {
        $value = $category['slug'] . ':' . sanitize_title($subcategory);
        if (in_array($value, $user_tags)) {
            $matched[] = $subcategory;
        }
    }
    if (!empty($matched)) {
        $grouped_tags[] = [
            'name' => $category['name'],
            'items' => $matched,
        ];
    }
}

$support_labels = [];
foreach ($support_options as $option) {
    if (in_array(sanitize_title($option), $user_support)) {
        $support_labels[] = $option;
    }
}
?>

<section id="content" class="site-content posts-container single-ambassador">
    <div class="container">
        <div class="row">
            <div class="breadcrumbs-wrap">
                <?php do_action('greenhouseculture_breadcrumb_options_hook'); ?>
            </div>
            <section class="bap-title">
                <div class="bap-title-content">
                    <h1>BIODIVERSITY AMBASSADOR</h1>
                </div>
            </section>
            <div class="col-md-8 content-area">
                <article class="ambassador-profile">
                    <header class="ambassador-profile__header">
                        <h1 class="ambassador-profile__name"><?php echo esc_html($display_name); ?></h1>

                        <?php if ($avatar_url): ?>
                            <div class="ambassador-profile__header-avatar">
                                <img class="ambassador-profile__avatar"
                                     src="<?php echo esc_url($avatar_url); ?>"
                                     alt="<?php echo esc_attr($display_name); ?>">
                            </div>
                        <?php endif; ?>

                        <div class="ambassador-profile__header-info">
                            <?php if (!empty($grouped_tags)): ?>
                                <div>
                                    <h2>Ambassador Role</h2>
                                    <div class="ambassador-profile__categories">
                                        <?php foreach ($grouped_tags as $group): ?>
                                            <div class="ambassador-profile__category-group">
                                                <h3 class="ambCategory" data-category="<?php echo esc_attr(sanitize_title($group['name'])); ?>"><?php echo esc_html($group['name']); ?></h3>
                                                <p class="ambassador-profile__tags"><?php echo implode(' ', array_map(function($item) { return '<span>' . esc_html($item) . '</span>'; }, $group['items'])); ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($support_labels)): ?>
                                <div class="ambassador-profile__support">
                                    <h2>Support Offered</h2>
                                    <p class="ambassador-profile__tags ambassador-profile__tags--alt"><?php echo implode(' ', array_map(function($item) { return '<span>' . esc_html($item) . '</span>'; }, $support_labels)); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </header>

                    <?php if ($bio): ?>
                        <section class="ambassador-profile__section">
                            <h2>About</h2>
                            <div class="ambassador-profile__text">
                                <?php echo wpautop(esc_html($bio)); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php if ($projects): ?>
                        <section class="ambassador-profile__section">
                            <h2>Projects &amp; Initiatives</h2>
                            <div class="ambassador-profile__text">
                                <?php echo wpautop(esc_html($projects)); ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <section class="ambassador-profile__section ambassador-profile__contacts">
                        <?php if ($website): ?>
                            <p><?php echo file_get_contents(get_theme_file_path('assets/icons/globe.svg')); ?> <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($website); ?></a></p>
                        <?php endif; ?>
                        <p><?php echo file_get_contents(get_theme_file_path('assets/icons/mail.svg')); ?> <a href="mailto:<?php echo esc_attr($user->user_email); ?>"><?php echo esc_html($user->user_email); ?></a></p>
                    </section>
                </article>
            </div>
            <aside class="col-md-4 ambassador-profile__sidebar"></aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
