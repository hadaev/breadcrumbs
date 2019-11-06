<?php
$true_page = 'breadcrumbs';
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Breadcrumbs
 * @subpackage Breadcrumbs/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Breadcrumbs
 * @subpackage Breadcrumbs/admin
 * @author     Your Name <email@example.com>
 */
class Breadcrumbs_Admin {

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
	 * @param      string    $Breadcrumbs       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
//	public $true_page;
	public function __construct( $Breadcrumbs, $version ) {

		$this->Breadcrumbs = $Breadcrumbs;
		$this->version = $version;
		add_action( 'admin_init', array($this, 'true_option_default') );
		add_action( 'admin_init', array($this, 'true_option_settings') );
		add_action( 'admin_menu', array($this, 'true_options') );

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->Breadcrumbs, plugin_dir_url( __FILE__ ) . 'css/plugin-breadcrumbs-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->Breadcrumbs, plugin_dir_url( __FILE__ ) . 'js/plugin-breadcrumbs-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function true_option_default(){
		$add_option = [];
	    $add_option['bc_position'] = 'left';
	    $add_option['show_home_link'] = 'on';
	    $add_option['show_current'] = 'on';
	    $add_option['bc_check_sep'] = 'on';
	    $add_option['bc_color_sep'] = '#ffffff';
	    $add_option['bc_color_bg'] = '#eeeeee';
	    $add_option['bc_color_current'] = '#757575';
	    $add_option['bc_color'] = '#007bff';
		add_option('true_options', $add_option);
    }

	public function true_options() {
		global $true_page;
		add_options_page( __('Breadcrumbs', 'Breadcrumbs'),
			__('Breadcrumbs', 'Breadcrumbs'),
			'manage_options',
			'breadcrumbs',
			array($this, 'true_option_page'));
	}
	public function true_option_page(){

		?><div class="wrap">
		<h2><?php _e('Breadcrumbs', 'Breadcrumbs') ?></h2>
		<form method="post" enctype="multipart/form-data" action="options.php" id="bc-form">
			<?php
			settings_fields('true_options');
			do_settings_sections('breadcrumbs');
			?>
            <span class="description">"*" - <?php _e('Options with * are transmitted using the shortcode', 'Breadcrumbs')?></span>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
		</div><?php
	}
	public function true_validate_settings($input) {
		foreach($input as $k => $v) {
			$valid_input[$k] = trim($v);

			/*
			if(! valid ) {
				$valid_input[$k] = '';
			}
			*/
		}
		return $valid_input;
	}
	function true_option_settings() {
		register_setting( 'true_options', 'true_options', array($this, 'true_validate_settings') ); // true_options

		add_settings_section( 'true_section_1', __('Settings'), '', 'breadcrumbs' );

		$true_field_params = array(
			'type'      => 'shortcode',
			'id'        => 'bc_shortcode',
			'desc'      => __('This code must be inserted on the page where the breadcrumbs should be.', 'Breadcrumbs').' '.__('Example', 'Breadcrumbs') . ': do_shortcode("[breadcrumbs]")',
			'label_for' => 'bc_shortcode'
		);
		add_settings_field( 'bc_shortcode_field', __('Shortcode'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		$true_field_params = array(
			'type'      => 'radio',
			'id'      => 'bc_position',
			'vals'		=> array( 'left' => __('Left'), 'center' => __('Center'), 'right' => __('Right'))
		);
		add_settings_field( 'bc_position', __('Position').'*', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		$true_field_params = array(
			'type'      => 'checkbox',
			'id'        => 'show_home_link',
			'desc'      => __('Show home link', 'Breadcrumbs').'*'
		);
		add_settings_field( 'show_home_link_field', __('Home Page', 'Breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		$true_field_params = array(
			'type'      => 'checkbox',
			'id'        => 'show_on_home',
			'desc'      => __('Show breadcrumbs on the home page', 'Breadcrumbs')
		);
		add_settings_field( 'show_on_home_field', '', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		$true_field_params = array(
			'type'      => 'checkbox',
			'id'        => 'show_current',
			'desc'      => __('Show title of current page', 'Breadcrumbs').'*'
		);
		add_settings_field( 'show_current_field', __('Current Page', 'Breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		add_settings_section( 'true_section_2', __('Display', 'Breadcrumbs'), '', 'breadcrumbs' );

		$true_field_params = array(
			'type'      => 'text',
			'id'        => 'bc_sep',
			'desc'      => __('Enter your delimiter character or enable the default delimiter', 'Breadcrumbs'),
			'label_for' => 'bc_sep'
		);
		add_settings_field( 'bc_sep_field', __('Separator'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'checkbox',
			'id'        => 'bc_check_sep',
			'desc'      => __('Default delimiter', 'Breadcrumbs'),
            'checked'   => 'on'
		);
		add_settings_field( 'bc_check_sep_field', '', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'color',
			'id'        => 'bc_color_bg',
			'desc'      => __('Default Separator Background Color', 'Breadcrumbs'),
			'label_for' => 'bc_color_bg'
		);
		add_settings_field( 'bc_color_bg_field', '', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'color',
			'id'        => 'bc_color_sep',
			'desc'      => __('Choose the color of the separator', 'Breadcrumbs'),
			'label_for' => 'bc_color_sep'
		);
		add_settings_field( 'bc_color_sep_field', '', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );


		$true_field_params = array(
			'type'      => 'color',
			'id'        => 'bc_color',
			'desc'      => __('Choose link color', 'Breadcrumbs'),
			'label_for' => 'bc_color'
		);
		add_settings_field( 'bc_color_field', __('Links'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'color',
			'id'        => 'bc_color_current',
			'desc'      => __('Choose the color of the current link', 'Breadcrumbs'),
			'label_for' => 'bc_color_current'
		);
		add_settings_field( 'bc_color_current_field', '', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'text',
			'id'        => 'bc_text_home',
			'desc'      => __('Enter the link text, by default "Home"', 'Breadcrumbs'),
			'label_for' => 'bc_text_home'
		);
		add_settings_field( 'bc_text_home_field', __('Home link text', 'Breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'text',
			'id'        => 'bc_text_search',
			'desc'      => __('Enter the text for the search results page, the default is "Search Results for"', 'Breadcrumbs'),
			'label_for' => 'bc_text_search'
		);
		add_settings_field( 'bc_text_search_field', __('Text for the search page', 'Breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'text',
			'id'        => 'bc_text_tag',
			'desc'      => __('Enter the text for the tag page, the default is "Posts Tagged"', 'Breadcrumbs'),
			'label_for' => 'bc_text_tag'
		);
		add_settings_field( 'bc_text_tag_field', __('Text for tag page', 'Breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'text',
			'id'        => 'bc_text_author',
			'desc'      => __('Enter the text for the author’s page, by default "Author articles"', 'Breadcrumbs'),
			'label_for' => 'bc_text_author'
		);
		add_settings_field( 'bc_text_author_field', __('Text for author page', 'Breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'text',
			'id'        => 'bc_text_404',
			'desc'      => __('Enter the text for page 404, the default is "Error"', 'Breadcrumbs'),
			'label_for' => 'bc_text_404'
		);
		add_settings_field( 'bc_text_404_field', __('Text for page 404', 'Breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'text',
			'id'        => 'bc_text_pagination',
			'desc'      => __('Enter the text of the pagination page, the default is "Page"', 'Breadcrumbs'),
			'label_for' => 'bc_text_pagination'
		);
		add_settings_field( 'bc_text_pagination_field', __('Pagination Page Text', 'Breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

		$true_field_params = array(
			'type'      => 'text',
			'id'        => 'bc_text_comment',
			'desc'      => __('Enter text for the comment page, the default is "Comments page"', 'Breadcrumbs'),
			'label_for' => 'bc_text_comment'
		);
		add_settings_field( 'bc_text_comment_field', __('Text for the comment page', 'Breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );

	}
	public function true_option_display_settings($args) {
		extract( $args );
		include(plugin_dir_path(__FILE__).'settings.php');

	}

}


