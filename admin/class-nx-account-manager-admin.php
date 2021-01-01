<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://newexsoft.com
 * @since      1.0.0
 *
 * @package    Nx_Account_Manager
 * @subpackage Nx_Account_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nx_Account_Manager
 * @subpackage Nx_Account_Manager/admin
 * @author     NewEx Soft <newexsoft26@gmail.com>
 */
class Nx_Account_Manager_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->nxam_admin_menu_hook();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'query-ui' );
		wp_enqueue_style( $this->plugin_name . '_nx-account-manager-boot', plugin_dir_url( __FILE__ ) . 'css/nx-account-manager-boot.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '_nx-account-manager-date-picker', plugin_dir_url( __FILE__ ) . 'css/nx-account-manager-date-picker.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '_nx-account-manager-sidebar', plugin_dir_url( __FILE__ ) . 'css/nx-account-manager-sidebar.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '_nx-account-manager-datatable', plugin_dir_url( __FILE__ ) . 'css/nx-account-manager-datatable.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '_nx-account-manager-alertify', plugin_dir_url( __FILE__ ) . 'css/nx-account-manager-alertify.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name . '_nx-account-manager-admin', plugin_dir_url( __FILE__ ) . 'css/nx-account-manager-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		//wp_enqueue_script( $this->plugin_name . '_nx-account-manager-min', plugin_dir_url( __FILE__ ) . 'js/nx-account-manager-min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '_nx-account-manager-boot', plugin_dir_url( __FILE__ ) . 'js/nx-account-manager-boot.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '_nx-account-manager-proper', plugin_dir_url( __FILE__ ) . 'js/nx-account-manager-proper.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '_nx-account-manager-datatable', plugin_dir_url( __FILE__ ) . 'js/nx-account-manager-datatable.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '_nx-account-manager-alertify', plugin_dir_url( __FILE__ ) . 'js/nx-account-manager-alertify.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '_nx-account-manager-datatable-print-btn', plugin_dir_url( __FILE__ ) . 'js/nx-account-manager-datatable-print-btn.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '_nx-account-manager-datatable-print', plugin_dir_url( __FILE__ ) . 'js/nx-account-manager-datatable-print.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nx-account-manager-admin.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name.'_ajax', plugin_dir_url( __FILE__ ) . 'js/nx-account-manager-ajax.js', array( 'jquery' ), $this->version, true );
		wp_localize_script( $this->plugin_name.'_ajax','nx_account_manager_ajax_url', admin_url('admin-ajax.php')); 

	}


	public function nxam_admin_menu_hook(){
		
		add_action( "admin_menu", array( $this, "nxam_menu" ));
		
	}

    public function nxam_menu(){

        $parent_slug = 'nx_account_manager';
		$capability = 'manage_options';
		$icon = 'dashicons-buddicons-buddypress-logo';
					
		add_menu_page( 'Account Manage', 'Account Manage', $capability, $parent_slug, array( $this, 'account_manage_cb' ), $icon, 15 );
		add_submenu_page( '', 'Account', 'Account', $capability, 'nx_account', array( $this, 'account_cb'), '' );
		add_submenu_page( '', 'Single', 'Single', $capability, 'nx_single', array( $this, 'single_cb'), '' );
		add_submenu_page( '', 'Members', 'Members', $capability, 'nx_members', array( $this, 'members_cb'), '' );
		add_submenu_page( '', 'Single Member', 'Single Member', $capability, 'nx_single_member', array( $this, 'single_member_cb'), '' );

    }
    
    public function account_manage_cb(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/account-manager.php';
	}
	
	public function account_cb(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/account.php';
	}
	
	public function single_cb(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/single.php';
	}
	
	public function members_cb(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/members.php';
	}
	
	public function single_member_cb(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/single-member.php';
	}


}
