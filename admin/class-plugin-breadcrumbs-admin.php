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

	public function true_options() {
		global $true_page;
		add_options_page( __('Breadcrumbs', 'breadcrumbs'),
			__('Breadcrumbs', 'breadcrumbs'),
			'manage_options',
			'breadcrumbs',
			array($this, 'true_option_page'));
	}
	public function true_option_page(){

		?><div class="wrap">
		<h2><?php _e('Breadcrumbs', 'breadcrumbs') ?></h2>
		<form method="post" enctype="multipart/form-data" action="options.php" id="bc-form">
			<?php
			settings_fields('true_options'); // меняем под себя только здесь (название настроек)
			do_settings_sections('breadcrumbs');
			?>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
		</div><?php
	}
	public function true_validate_settings($input) {
		foreach($input as $k => $v) {
			$valid_input[$k] = trim($v);

			/* Вы можете включить в эту функцию различные проверки значений, например
			if(! задаем условие ) { // если не выполняется
				$valid_input[$k] = ''; // тогда присваиваем значению пустую строку
			}
			*/
		}
		return $valid_input;
	}
	function true_option_settings() {
		// Присваиваем функцию валидации ( true_validate_settings() ). Вы найдете её ниже
		register_setting( 'true_options', 'true_options', array($this, 'true_validate_settings') ); // true_options

		// Добавляем секцию
		add_settings_section( 'true_section_1', __('Settings'), '', 'breadcrumbs' );

		// Создадим текстовое поле в первой секции
//		$true_field_params = array(
//			'type'      => 'text', // тип
//			'id'        => 'my_text',
//			'desc'      => __('This code must be inserted on the page where the breadcrumbs should be.', 'breadcrumbs'), // описание
//			'label_for' => 'my_text' // позволяет сделать название настройки лейблом (если не понимаете, что это, можете не использовать), по идее должно быть одинаковым с параметром id
//		);
//		add_settings_field( 'my_text_field', __('Text'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		// Создадим текстовое поле в первой секции
		$true_field_params = array(
			'type'      => 'shortcode', // тип
			'id'        => 'my_shortcode',
			'desc'      => __('This code must be inserted on the page where the breadcrumbs should be.', 'breadcrumbs'), // описание
			'label_for' => 'my_shortcode' // позволяет сделать название настройки лейблом (если не понимаете, что это, можете не использовать), по идее должно быть одинаковым с параметром id
		);
		add_settings_field( 'my_shortcode_field', __('Shortcode'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		// Создадим радио-кнопку
		$true_field_params = array(
			'type'      => 'radio',
			'id'      => 'my_radio',
			'vals'		=> array( 'left' => __('Left'), 'center' => __('Center'), 'right' => __('Right'))
		);
		add_settings_field( 'my_radio', __('Position'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		// Создадим чекбокс
		$true_field_params = array(
			'type'      => 'checkbox',
			'id'        => 'show_home_link',
			'desc'      => __('Show home link', 'breadcrumbs')
		);
		add_settings_field( 'show_home_link_field', __('Home Page', 'breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		// Создадим чекбокс
		$true_field_params = array(
			'type'      => 'checkbox',
			'id'        => 'show_on_home',
			'desc'      => __('Show breadcrumbs on the home page', 'breadcrumbs')
		);
		add_settings_field( 'show_on_home_field', '', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

		// Создадим чекбокс
		$true_field_params = array(
			'type'      => 'checkbox',
			'id'        => 'show_current',
			'desc'      => __('Show title of current page', 'breadcrumbs')
		);
		add_settings_field( 'show_current_field', __('Current Page', 'breadcrumbs'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );

        $true_field_params = array(
            'type'      => 'text', // тип
            'id'        => 'bc_sep',
            'desc'      => __('Enter a delimiter character.', 'breadcrumbs'),
            'label_for' => 'bc_sep'
        );
        add_settings_field( 'bc_sep_field', __('Separator'), array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );


//		// Создадим textarea в первой секции
//		$true_field_params = array(
//			'type'      => 'textarea',
//			'id'        => 'my_textarea',
//			'desc'      => 'Пример большого текстового поля.'
//		);
//		add_settings_field( 'my_textarea_field', 'Большое текстовое поле', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_1', $true_field_params );
//
//		// Добавляем вторую секцию настроек
//
//		add_settings_section( 'true_section_2', 'Другие поля ввода', '', 'breadcrumbs' );
//
//		// Создадим чекбокс
//		$true_field_params = array(
//			'type'      => 'checkbox',
//			'id'        => 'my_checkbox',
//			'desc'      => 'Пример чекбокса.'
//		);
//		add_settings_field( 'my_checkbox_field', 'Чекбокс', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );
//
//		// Создадим выпадающий список
//		$true_field_params = array(
//			'type'      => 'select',
//			'id'        => 'my_select',
//			'desc'      => 'Пример выпадающего списка.',
//			'vals'		=> array( 'val1' => 'Значение 1', 'val2' => 'Значение 2', 'val3' => 'Значение 3')
//		);
//		add_settings_field( 'my_select_field', 'Выпадающий список', array($this, 'true_option_display_settings'), 'breadcrumbs', 'true_section_2', $true_field_params );


	}
	public function true_option_display_settings($args) {
		extract( $args );
		include(plugin_dir_path(__FILE__).'settings.php');

	}

}


