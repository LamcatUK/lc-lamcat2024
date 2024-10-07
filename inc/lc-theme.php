<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

require_once LC_THEME_DIR . '/inc/lc-utility.php';
require_once LC_THEME_DIR . '/inc/lc-blocks.php';


add_filter('theme_page_templates', 'child_theme_remove_page_template');
function child_theme_remove_page_template($page_templates)
{
    // unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/fullwidthpage.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    unset($page_templates['page-templates/blank.php'], $page_templates['page-templates/empty.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    return $page_templates;
}
add_action('after_setup_theme', 'remove_understrap_post_formats', 11);
function remove_understrap_post_formats()
{
    remove_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));
}

// Remove unwanted SVG filter injection WP
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');

/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts()
{
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');

    wp_dequeue_script('understrap-scripts');
    wp_deregister_script('understrap-scripts');
}
add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);

// Remove comment-reply.min.js from footer
function remove_comment_reply_header_hook()
{
    wp_deregister_script('comment-reply');
}
add_action('init', 'remove_comment_reply_header_hook');

add_action('admin_menu', 'remove_comments_menu');
function remove_comments_menu()
{
    remove_menu_page('edit-comments.php');
}


if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        array(
            'page_title'     => 'Site-Wide Settings',
            'menu_title'    => 'Site-Wide Settings',
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
        )
    );
}

function widgets_init()
{

    register_nav_menus(array(
        'primary_nav' => __('Primary Nav', 'lc-lamcat2024'),
        'footer_menu1' => __('Footer Menu 1', 'lc-lamcat2024'),
        'footer_menu2' => __('Footer Menu 2', 'lc-lamcat2024'),
    ));

    unregister_sidebar('hero');
    unregister_sidebar('herocanvas');
    unregister_sidebar('statichero');
    unregister_sidebar('left-sidebar');
    unregister_sidebar('right-sidebar');
    unregister_sidebar('footerfull');
    unregister_nav_menu('primary');

    add_theme_support('disable-custom-colors');
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => 'Blue',
                'slug'  => 'blue-400',
                'color' => '#4f8cad',
            ),
            array(
                'name'  => 'Grey 400',
                'slug'  => 'grey-400',
                'color' => '#767676',
            ),
        )
    );
}
add_action('widgets_init', 'widgets_init', 11);

//Custom Dashboard Widget
// add_action('wp_dashboard_setup', 'register_lc_dashboard_widget');
function register_cb_dashboard_widget()
{
    wp_add_dashboard_widget(
        'lc_dashboard_widget',
        'Lamcat',
        'lc_dashboard_widget_display'
    );
}

function lc_dashboard_widget_display()
{
?>
    <div style="display: flex; align-items: center; justify-content: space-around;">
        <img style="width: 50%;"
            src="<?= get_stylesheet_directory_uri() . '/img/lc-full.jpg'; ?>">
        <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
            href="mailto:hello@lamcat.co.uk/">Contact</a>
    </div>
    <div>
        <p><strong>Thanks for choosing Lamcat!</strong></p>
        <hr>
        <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
        <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
    </div>
<?php
}

// remove discussion metabox
function cc_gutenberg_register_files()
{
    // script file
    wp_register_script(
        'cc-block-script',
        get_stylesheet_directory_uri() . '/js/block-script.js', // adjust the path to the JS file
        array('wp-blocks', 'wp-edit-post')
    );
    // register block editor script
    register_block_type('cc/ma-block-files', array(
        'editor_script' => 'cc-block-script'
    ));
}
add_action('init', 'cc_gutenberg_register_files');

function understrap_all_excerpts_get_more_link($post_excerpt)
{
    if (is_admin() || ! get_the_ID()) {
        return $post_excerpt;
    }
    return $post_excerpt;
}

//* Remove Yoast SEO breadcrumbs from Revelanssi's search results
add_filter('the_content', 'wpdocs_remove_shortcode_from_index');
function wpdocs_remove_shortcode_from_index($content)
{
    if (is_search()) {
        $content = strip_shortcodes($content);
    }
    return $content;
}


function lc_theme_enqueue()
{
    $the_theme = wp_get_theme();
    // wp_enqueue_style('lightbox-stylesheet', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), $the_theme->get('Version'));
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox-plus-jquery.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_script('lightbox-scripts', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array(), $the_theme->get('Version'), true);
    // wp_enqueue_style('aos-style', "https://unpkg.com/aos@2.3.1/dist/aos.css", array());
    // wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true);

    wp_enqueue_style('swiper-style', "https://unpkg.com/swiper/swiper-bundle.min.css", array());
    wp_enqueue_script('swiper-script', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);

    wp_deregister_script('jquery');
    // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.3.min.js', array(), null, true);
    // wp_enqueue_script('parallax', get_stylesheet_directory_uri() . '/js/parallax.min.js', array('jquery'), null, true);

}
add_action('wp_enqueue_scripts', 'lc_theme_enqueue');


add_shortcode('contact_button', 'lc_contact_button');

function lc_contact_button()
{
    ob_start();
?>
    <svg class="link-arrow-path" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.7 29.7">
        <g id="link-arrow-path" data-name="Layer 1">
            <polyline class="cls-1" points=".71 1 28.7 1 28.7 29" />
            <line class="cls-1" x1="28.7" y1="1" x2=".71" y2="29" />
        </g>
    </svg>
    <svg class="circle-path" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <path id="circle-path" d="
            M 50, 50
            m -37, 0
            a 37,37 0 1,1 74,0
            a 37,37 0 1,1 -74,0"></path>
        </defs>
    </svg>
    <a href="/contact-us/" class="link mouse-target">
        <svg class="link-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
            <use xlink:href="#link-arrow-path"></use>
        </svg>
        <span class="container-link-circle">
            <span class="circle-anim">
                <svg class="link-circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <text>
                        <textPath xlink:href="#circle-path" text-anchor="start">
                            contact us • contact us • contact us •
                        </textPath>
                    </text>
                </svg>
            </span>
        </span>
    </a>
<?php
    return ob_get_clean();
}

function lc_work_nav()
{
?>
    <div class="work-nav pt-5 mb-5" id="workNav">
        <hr>
        <?php
        $next_post_obj  = get_adjacent_post('', '', true);
        if ($next_post_obj) {
            $next_post_ID   = isset($next_post_obj->ID) ? $next_post_obj->ID : '';
            $next_post_link = get_permalink($next_post_ID);
        ?>
            <h3 class="fs-400">Next Project</h3>
            <a href="<?php echo $next_post_link; ?>" rel="next"
                class="next">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="mb-0"><?= get_the_title($next_post_ID) ?></h2>
                        <div class="category text-muted fs-400 fw-400">
                            <?php
                            $post_terms = get_the_terms($next_post_ID, 'work-type');
                            $next_post_categories = array();
                            foreach ($post_terms as $term) {
                                $next_post_categories[] = $term->name;
                            }
                            echo implode(', ', $next_post_categories);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="subtitle fs-500">
                            <?= get_field('subtitle', $next_post_ID) ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php
        }
        ?>
    </div>
<?php

}

function lc_short_work_nav()
{
?>
    <div class="work-nav--short hidden" id="workNavBar">
        <?php
        $previous_post_obj = get_adjacent_post('', '', false);
        if ($previous_post_obj) {
            $previous_post_ID   = isset($previous_post_obj->ID) ? $previous_post_obj->ID : '';
            $previous_post_link = get_permalink($previous_post_ID);
        ?>
            <a class="link-prev" href="<?= $previous_post_link ?>" title="previous"></a>
        <?php
        } else {
            echo '<div></div>';
        }
        ?>
        <div><?= get_the_title() ?></div>
        <?php
        $next_post_obj  = get_adjacent_post('', '', true);
        if ($next_post_obj) {
            $next_post_ID   = isset($next_post_obj->ID) ? $next_post_obj->ID : '';
            $next_post_link = get_permalink($next_post_ID);
        ?>
            <a class="link-next" href="<?= $next_post_link ?>" title="next"></a>
        <?php
        } else {
            echo '<div></div>';
        }
        ?>
    </div>
<?php
}
