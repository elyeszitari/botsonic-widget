<?php

namespace WpBotsonicFree\Admin;

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

/**
 * WP BOTSONIC FREE TOKEN : Input.
 * WP BOTSONIC FREE logged in user load : select
*/
class Wp_Botsonic_Free_Admin_Setting{
	
	function __construct(){
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	function admin_menu() {
        add_menu_page(
			__('WP Botsonic Free','wp-botsonic-free'), 
			__('WP Botsonic Free','wp-botsonic-free'),
			'manage_options',
			'wp-botsonic-free-setting-page',
			array($this,'plugin_page'),
			WP_BOTSONIC_FREE_URL.'admin/assets/images/chatbot-w.png',
			67
		);
	}

	function admin_init(){
		register_setting( 'wp-botsonic-free-settings-option', 'wp_botsonic_free_token' );
        register_setting( 'wp-botsonic-free-settings-option', 'wp_botsonic_free_loggedin' );
	}

	function plugin_page() {
		?>
	        <div class="wrap">
	            <h2><?php echo esc_html__( 'Wp Botsonic Free Option','wp-botsonic-free' ); ?></h2>
	            <form action='options.php' method='post'>
		            <?php
		            	$this->save_message();
		            	settings_fields( 'wp-botsonic-free-settings-option' );
						do_settings_sections( 'wp-botsonic-free-setting-page' ); 
		            ?>
		            <table class="form-table" role="presentation">
						<tbody>
							<tr>
								<?php $wp_botsonic_free_token = get_option( 'wp_botsonic_free_token' )?get_option( 'wp_botsonic_free_token' ): ''; ?>
								<th scope="row" style="width: 20%;"><?php echo esc_html__('Botsonic Chatbot TOKEN : ','wp-botsonic-free'); ?></th>
								<td>
									<input type="text" id="wp_botsonic_free_token" placeholder="Xyzs-0YYY-5tDrW-ZZZ" name="wp_botsonic_free_token" value="<?php echo esc_attr( $wp_botsonic_free_token ); ?>"/>
									<label for="wp_botsonic_free_token"><?php echo esc_html__( 'Sample Botsonic TOKEN : abcD-123cd-456r-79dre-455df-22sse','wp-botsonic-free'); ?>.</label>
									<p class="description">
									<br>Log in to your Botsonic account <a href="https://app.writesonic.com/fr/signup?utm_source=wpbotsonicfree&utm_medium=link&utm_campaign=signup" target="_blank">[from here!]</a> to select and copy the <b>TOKEN</b> part only from Embed code (See screenshots).
									<br><br><b>Note :</b> You will need a free Botsonic Chatbot account: <a href="https://app.writesonic.com/fr/signup?utm_source=wpbotsonicfree&utm_medium=link&utm_campaign=signup" target="_blank">[Create one here!]</a><br/>Or copy link : https://app.writesonic.com/fr/signup?utm_source=wpbotsonicfree&utm_medium=link&utm_campaign=signup
									
									</p>
								</td>
							</tr>
                            <tr>
								<?php $wp_botsonic_free_loggedin = get_option( 'wp_botsonic_free_loggedin' )?get_option( 'wp_botsonic_free_loggedin' ): '0'; ?>
								<th scope="row" style="width: 20%;"><?php echo esc_html__('Load Chatbot only for logged in users : ','wp-botsonic-free'); ?></th>
								<td>
								<select id="wp_botsonic_free_loggedin" name="wp_botsonic_free_loggedin">
									<option value="0" <?php if ($wp_botsonic_free_loggedin == "0") echo 'selected="selected"'?>><?php _e('NO', 'wp-botsonic-free') ?></option>
                                    <option value="1" <?php if ($wp_botsonic_free_loggedin == "1") echo 'selected="selected"'?>><?php _e('YES', 'wp-botsonic-free') ?></option>
                                </select>
								<label for="wp_botsonic_free_loggedin"><?php echo esc_html__("If YES, This will Load Botsonic Chatbot only for logged in users.", 'wp-botsonic-free') ?>.</label>
								</td>
							</tr>
						</tbody>
					</table>
					<div>
						<?php submit_button(); ?>
					</div>
	        	</form>
	        </div>
        <?php 
    }

    function save_message() {
    	$wp_botsonic_free_token = get_option( 'wp_botsonic_free_token' )?get_option( 'wp_botsonic_free_token' ):'';
        if( isset($_GET['settings-updated'])) { 
        	if($wp_botsonic_free_token):
			?>
	            <div class="updated notice is-dismissible"> 
	                <p><strong><?php echo esc_html__('Successfully Settings Saved.','wp-botsonic-free') ?></strong></p>
	            </div>
	        <?php else: ?>
	        	<div class="notice notice-error is-dismissible"> 
	                <p><strong><?php echo esc_html__('Please Enter a Valid Botsonic TOKEN. Botsonic TOKEN Field is Empty.','wp-botsonic-free') ?></strong></p>
	            </div>
            <?php
        	endif;
        }
    }
}

new Wp_Botsonic_Free_Admin_Setting();

?>
