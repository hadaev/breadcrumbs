<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Breadcrumbs
 * @subpackage Breadcrumbs/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Breadcrumbs
 * @subpackage Breadcrumbs/public
 * @author     Your Name <email@example.com>
 */
class Breadcrumbs_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Breadcrumbs    The ID of this plugin.
	 */
	private $Breadcrumbs;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $Breadcrumbs       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Breadcrumbs, $version ) {

		$this->Breadcrumbs = $Breadcrumbs;
		$this->version = $version;
		add_shortcode( 'breadcrumbs', array($this, 'breadcrumbs_frontend'));

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Breadcrumbs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Breadcrumbs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->Breadcrumbs, plugin_dir_url( __FILE__ ) . 'css/plugin-breadcrumbs-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Breadcrumbs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Breadcrumbs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->Breadcrumbs, plugin_dir_url( __FILE__ ) . 'js/plugin-breadcrumbs-public.js', array( 'jquery' ), $this->version, false );

	}

	public function breadcrumbs_frontend($atts){
		$atts = shortcode_atts( array(
			'position' => 'left',
			'show_home_link' => 1,
			'show_current' => 1,
		), $atts, 'breadcrumbs' );

		$breadcrumbs_code = '';

		$className = 'bc-display-flex bc-flex-justify-content-'.$atts['position'];
		$show_home_link = $atts['show_home_link'];
		$show_current = $atts['show_current'];
		$bg_sep= '';
		$true_options = get_option('true_options');
		$sep = $true_options['bc_sep'];
		$show_on_home = $true_options['show_on_home']?1:0;

		if ($sep){
			$bc_sep_selector ='.bc-sep{color: '. $true_options['bc_color_sep'] .';}';
		}else if($true_options['bc_check_sep']){
			$bg_sep = 'bc-bg-sep';
			$bc_bg_sep_selector = '
				.bc-bg-sep .bc-item:before,
				.bc-bg-sep .bc-current:before{
					border-left: 16px solid '. $true_options['bc_color_sep'] .';
				}
				.bc-bg-sep .bc-item, 
				.bc-bg-sep .bc-current{
					border-right: 2px solid '. $true_options['bc_color_sep'] .';
					background-color: '. $true_options['bc_color_bg'] .';
				}
				.bc-bg-sep .bc-item:after, 
				.bc-bg-sep .bc-current:after{
					border-left: 16px solid '. $true_options['bc_color_bg'] .';
				}
				';
		}

		if ($true_options['bc_color']) $bc_item_selector = '.bc-item a{color:'. $true_options['bc_color'] .';}';
		if ($true_options['bc_color_current']) $bc_current_selector = '.bc-current{color:'. $true_options['bc_color_current'] .';}';

		$breadcrumbs_code .= '<style>' . $bc_sep_selector .' ' . $bc_bg_sep_selector .' ' . $bc_item_selector .' ' . $bc_current_selector . '</style>';

		$text_home = $true_options['bc_text_home']?$true_options['bc_text_home']:__('Home');
		$text_search = $true_options['bc_text_search']?$true_options['bc_text_search']:__('Search Results for', 'Breadcrumbs');
		$text_tag = $true_options['bc_text_tag']?$true_options['bc_text_tag']:__('Posts Tagged', 'Breadcrumbs');
		$text_author = $true_options['bc_text_author']?$true_options['bc_text_author']:__('Author Articles', 'Breadcrumbs');
		$text_404 = $true_options['bc_text_404']?$true_options['bc_text_404']:__('Error', 'Breadcrumbs');
		$text_paged = $true_options['bc_text_pagination']?$true_options['bc_text_pagination']:__('Page');
		$text_cpage = $true_options['bc_text_comment']?$true_options['bc_text_comment']:__('Comments Page', 'Breadcrumbs');

			/* === settings === */
			$before_text = "<span class='bc-text'>";
			$after_text = "</span>";
			$text['home'] = $text_home;
			$text['category'] = '%s';
			$text['search'] = $before_text . $text_search . $after_text . " <span class='bc-search'>%s</span>";
			$text['tag'] = $before_text . $text_tag . $after_text . " <span class='bc-tag'>%s</span>";
			$text['author'] = $before_text . $text_author . $after_text . " <span class='bc-author'>%s</span>";
			$text['404'] = $before_text . $text_404 . $after_text ." <span class='bc-404'>404</span>";
			$text['page'] = $before_text . $text_paged . $after_text ." <span class='bc-page'>%s</span>";
			$text['cpage'] = $before_text . $text_cpage . $after_text . " <span class='bc-cpage'>%s</span>";

			$wrap_before = '<ul class="bc bc-list-item '. $className .' '. $bg_sep.'">';
			$wrap_after = '</ul><!-- .breadcrumbs -->';


			$sep_before = '<li class="bc-sep">';
			$sep_after = '</li>';

			$before = '<li class="bc-current"><span class="bc-no-active">';
			$after = '</span></li>';
			/* === End Settings === */

			global $post;
			$home_url = home_url('/');
			$link_before = '<li class="bc-item">';
			$link_after = '</li>';
			$link_in_before = '<span>';
			$link_in_after = '</span>';
			$link = $link_before . '<a href="%1$s">' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
			$frontpage_id = get_option('page_on_front');
			$parent_id = ($post) ? $post->post_parent : '';
			$sep = ' ' . $sep_before . $sep . $sep_after . ' ';
			$home_link = $link_before . '<a href="' . $home_url . '" class="bc-home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;

			if (is_home() || is_front_page()) {
				if ($show_on_home) $breadcrumbs_code .= $wrap_before . $home_link . $wrap_after;
			} else {
				$breadcrumbs_code .= $wrap_before;
				if ($show_home_link) $breadcrumbs_code .= $home_link;

				if ( is_category() ) {
					$cat = get_category(get_query_var('cat'), false);
					if ($cat->parent != 0) {
						$cats = get_category_parents($cat->parent, TRUE, $sep);
						$cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
						$cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $link_before . '<a$1>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
						if ($show_home_link) $breadcrumbs_code .= $sep;
						$breadcrumbs_code .= $cats;
					}
					if ( get_query_var('paged') ) {
						$cat = $cat->cat_ID;
						$breadcrumbs_code .= $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
					} else {
						if ($show_current) $breadcrumbs_code .= $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
					}

				} elseif ( is_search() ) {
					if (have_posts()) {
						if ($show_home_link && $show_current) $breadcrumbs_code .= $sep;
						if ($show_current) $breadcrumbs_code .= $before . sprintf($text['search'], get_search_query()) . $after;
					} else {
						if ($show_home_link) $breadcrumbs_code .= $sep;
						$breadcrumbs_code .= $before . sprintf($text['search'], get_search_query()) . $after;
					}

				} elseif ( is_day() ) {
					if ($show_home_link) $breadcrumbs_code .= $sep;
					$breadcrumbs_code .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
					$breadcrumbs_code .= sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
					if ($show_current) $breadcrumbs_code .= $sep . $before . get_the_time('d') . $after;

				} elseif ( is_month() ) {
					if ($show_home_link) $breadcrumbs_code .= $sep;
					$breadcrumbs_code .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
					if ($show_current) $breadcrumbs_code .= $sep . $before . get_the_time('F') . $after;

				} elseif ( is_year() ) {
					if ($show_home_link && $show_current) $breadcrumbs_code .= $sep;
					if ($show_current) $breadcrumbs_code .= $before . get_the_time('Y') . $after;

				} elseif ( is_single() && !is_attachment() ) {
					if ($show_home_link) $breadcrumbs_code .= $sep;
					if ( get_post_type() != 'post' ) {
						$post_type = get_post_type_object(get_post_type());
						$slug = $post_type->rewrite;
						$breadcrumbs_code .= sprintf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
						if ($show_current) $breadcrumbs_code .= $sep . $before . get_the_title() . $after;
					} else {
						$cat = get_the_category();
						$cat = $cat[0];
						if ($cat){
							$cats = get_category_parents( $cat->term_id, true, $sep);
							if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
							$cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $link_before . '<a$1>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
							$breadcrumbs_code .= $cats;
						}

						if ( get_query_var('cpage') ) {
							$breadcrumbs_code .= $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
						} else {
							if ($show_current) $breadcrumbs_code .= $before . get_the_title() . $after;
						}
					}

					// custom post type
				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_tag() ) {
					$post_type = get_post_type_object(get_post_type());
					if ( get_query_var('paged') ) {
						$breadcrumbs_code .= $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
					} else {
						if ($show_current) $breadcrumbs_code .= $sep . $before . $post_type->label . $after;
					}

				} elseif ( is_attachment() ) {
					if ($show_home_link) $breadcrumbs_code .= $sep;
					$parent = get_post($parent_id);
					$cat = get_the_category($parent->ID);
					$cat = $cat[0];
					if ($cat) {
						$cats = get_category_parents( (int) $cat, TRUE, $sep);
						$cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $link_before . '<a$1>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
						$breadcrumbs_code .= $cats;
					}
					if ($parent_id !== 0)$breadcrumbs_code .= sprintf($link, get_permalink($parent), $parent->post_title);
					if ($show_current) $breadcrumbs_code .= $sep . $before . get_the_title() . $after;

				} elseif ( is_page() && (!$parent_id) ) {
					if ($show_current) $breadcrumbs_code .= $sep . $before . get_the_title() . $after;

				} elseif ( is_page() && $parent_id ) {
					if ($show_home_link) $breadcrumbs_code .= $sep;
					if ($parent_id != $frontpage_id) {
						$breadcrumbs = array();
						while ($parent_id) {
							$page = get_post($parent_id);
							if ($parent_id != $frontpage_id) {
								$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
							}
							$parent_id = $page->post_parent;
						}
						$breadcrumbs = array_reverse($breadcrumbs);
						for ($i = 0; $i < count($breadcrumbs); $i++) {
							$breadcrumbs_code .= $breadcrumbs[$i];
							if ($i != count($breadcrumbs)-1) $breadcrumbs_code .= $sep;
						}
					}
					if ($show_current) $breadcrumbs_code .= $sep . $before . get_the_title() . $after;

				} elseif ( is_tag() ) {
					if ( get_query_var('paged') ) {
						$tag_id = get_queried_object_id();
						$tag = get_tag($tag_id);
						$breadcrumbs_code .= $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
					} else {
						if ($show_current) $breadcrumbs_code .= $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
					}

				} elseif ( is_author() ) {
					global $author;
					$author = get_userdata($author);
					if ( get_query_var('paged') ) {
						if ($show_home_link) $breadcrumbs_code .= $sep;
						$breadcrumbs_code .= sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
					} else {
						if ($show_home_link && $show_current) $breadcrumbs_code .= $sep;
						if ($show_current) $breadcrumbs_code .= $before . sprintf($text['author'], $author->display_name) . $after;
					}

				} elseif ( is_404() ) {
					if ($show_home_link && $show_current) $breadcrumbs_code .= $sep;
					if ($show_current) $breadcrumbs_code .= $before . $text['404'] . $after;

				} elseif ( has_post_format() && !is_singular() ) {
					if ($show_home_link) $breadcrumbs_code .= $sep;
					$breadcrumbs_code .= get_post_format_string( get_post_format() );
				}

				$breadcrumbs_code .= $wrap_after;

			}
			return $breadcrumbs_code;
	}

}
