<?php

class Ecommerce_Mega_Store_Customizer_Notify {

	private $config = array(); // Declare $config property
	
	private $ecommerce_mega_store_recommended_actions;
	
	private $recommended_plugins;
	
	private static $instance;
	
	private $ecommerce_mega_store_recommended_actions_title;
	
	private $ecommerce_mega_store_recommended_plugins_title;
	
	private $dismiss_button;
	
	private $ecommerce_mega_store_install_button_label;
	
	private $ecommerce_mega_store_activate_button_label;
	
	private $ecommerce_mega_store_deactivate_button_label;

	
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Ecommerce_Mega_Store_Customizer_Notify ) ) {
			self::$instance = new Ecommerce_Mega_Store_Customizer_Notify;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	
	public function setup_config() {

		global $ecommerce_mega_store_customizer_notify_recommended_plugins;
		global $ecommerce_mega_store_customizer_notify_ecommerce_mega_store_recommended_actions;

		global $ecommerce_mega_store_install_button_label;
		global $ecommerce_mega_store_activate_button_label;
		global $ecommerce_mega_store_deactivate_button_label;

		$this->ecommerce_mega_store_recommended_actions = isset( $this->config['ecommerce_mega_store_recommended_actions'] ) ? $this->config['ecommerce_mega_store_recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->ecommerce_mega_store_recommended_actions_title = isset( $this->config['ecommerce_mega_store_recommended_actions_title'] ) ? $this->config['ecommerce_mega_store_recommended_actions_title'] : '';
		$this->ecommerce_mega_store_recommended_plugins_title = isset( $this->config['ecommerce_mega_store_recommended_plugins_title'] ) ? $this->config['ecommerce_mega_store_recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$ecommerce_mega_store_customizer_notify_recommended_plugins = array();
		$ecommerce_mega_store_customizer_notify_ecommerce_mega_store_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$ecommerce_mega_store_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->ecommerce_mega_store_recommended_actions ) ) {
			$ecommerce_mega_store_customizer_notify_ecommerce_mega_store_recommended_actions = $this->ecommerce_mega_store_recommended_actions;
		}

		$ecommerce_mega_store_install_button_label    = isset( $this->config['ecommerce_mega_store_install_button_label'] ) ? $this->config['ecommerce_mega_store_install_button_label'] : '';
		$ecommerce_mega_store_activate_button_label   = isset( $this->config['ecommerce_mega_store_activate_button_label'] ) ? $this->config['ecommerce_mega_store_activate_button_label'] : '';
		$ecommerce_mega_store_deactivate_button_label = isset( $this->config['ecommerce_mega_store_deactivate_button_label'] ) ? $this->config['ecommerce_mega_store_deactivate_button_label'] : '';

	}

	
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'ecommerce_mega_store_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'ecommerce_mega_store_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'ecommerce_mega_store_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'ecommerce_mega_store_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}

	
	public function ecommerce_mega_store_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'ecommerce-mega-store-customizer-notify-css', get_template_directory_uri() . '/core/includes/customizer-notice/css/ecommerce-mega-store-customizer-notify.css', array());

		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		wp_add_inline_script( 'plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'updates' );

		wp_enqueue_script( 'ecommerce-mega-store-customizer-notify-js', get_template_directory_uri() . '/core/includes/customizer-notice/js/ecommerce-mega-store-customizer-notify.js', array( 'customize-controls' ));
		wp_localize_script(
			'ecommerce-mega-store-customizer-notify-js', 'ecommercemegastoreCustomizercompanionObject', array(
				'ajaxurl'            => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'base_path'          => admin_url(),
				'activating_string'  => __( 'Activating', 'ecommerce-mega-store' ),
			)
		);

	}

	
	public function ecommerce_mega_store_plugin_notification_customize_register( $wp_customize ) {

		
		require_once get_template_directory() . '/core/includes/customizer-notice/ecommerce-mega-store-customizer-notify-section.php';

		$wp_customize->register_section_type( 'Ecommerce_Mega_Store_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new Ecommerce_Mega_Store_Customizer_Notify_Section(
				$wp_customize,
				'ecommerce-mega-store-customizer-notify-section',
				array(
					'title'          => $this->ecommerce_mega_store_recommended_actions_title,
					'plugin_text'    => $this->ecommerce_mega_store_recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}

	
	public function ecommerce_mega_store_customizer_notify_dismiss_recommended_action_callback() {

		global $ecommerce_mega_store_customizer_notify_ecommerce_mega_store_recommended_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */ 

		if ( ! empty( $action_id ) ) {
			
			if ( get_option( 'ecommerce_mega_store_customizer_notify_show' ) ) {

				$ecommerce_mega_store_customizer_notify_show_ecommerce_mega_store_recommended_actions = get_option( 'ecommerce_mega_store_customizer_notify_show' );
				switch ( $_GET['todo'] ) {
					case 'add':
						$ecommerce_mega_store_customizer_notify_show_ecommerce_mega_store_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$ecommerce_mega_store_customizer_notify_show_ecommerce_mega_store_recommended_actions[ $action_id ] = false;
						break;
				}
				update_option( 'ecommerce_mega_store_customizer_notify_show', $ecommerce_mega_store_customizer_notify_show_ecommerce_mega_store_recommended_actions );

				
			} else {
				$ecommerce_mega_store_customizer_notify_show_ecommerce_mega_store_recommended_actions = array();
				if ( ! empty( $ecommerce_mega_store_customizer_notify_ecommerce_mega_store_recommended_actions ) ) {
					foreach ( $ecommerce_mega_store_customizer_notify_ecommerce_mega_store_recommended_actions as $ecommerce_mega_store_lite_customizer_notify_recommended_action ) {
						if ( $ecommerce_mega_store_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$ecommerce_mega_store_customizer_notify_show_ecommerce_mega_store_recommended_actions[ $ecommerce_mega_store_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$ecommerce_mega_store_customizer_notify_show_ecommerce_mega_store_recommended_actions[ $ecommerce_mega_store_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					update_option( 'ecommerce_mega_store_customizer_notify_show', $ecommerce_mega_store_customizer_notify_show_ecommerce_mega_store_recommended_actions );
				}
			}
		}
		die(); 
	}

	
	public function ecommerce_mega_store_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */

		if ( ! empty( $action_id ) ) {

			$ecommerce_mega_store_lite_customizer_notify_show_recommended_plugins = get_option( 'ecommerce_mega_store_customizer_notify_show_recommended_plugins' );

			switch ( $_GET['todo'] ) {
				case 'add':
					$ecommerce_mega_store_lite_customizer_notify_show_recommended_plugins[ $action_id ] = false;
					break;
				case 'dismiss':
					$ecommerce_mega_store_lite_customizer_notify_show_recommended_plugins[ $action_id ] = true;
					break;
			}
			update_option( 'ecommerce_mega_store_customizer_notify_show_recommended_plugins', $ecommerce_mega_store_lite_customizer_notify_show_recommended_plugins );
		}
		die(); 
	}

}
