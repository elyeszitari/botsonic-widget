<?php

namespace BotsonicWidget\Admin;

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

/**
 * Botsonic Widget TOKEN : Input.
 * Botsonic Widget logged in user load : select
*/
class Botsonic_Widget_Admin_Setting{
	
	function __construct(){
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}

	function admin_menu() {
        add_menu_page(
			__('Botsonic Widget','botsonic-widget'), 
			__('Botsonic Widget','botsonic-widget'),
			'manage_options',
			'botsonic-widget-setting-page',
			array($this,'plugin_page'),
			BOTSONIC_WIDGET_URL.'admin/assets/images/chatbot-w.png',
			67
		);
	}

	function admin_init(){
		register_setting( 'botsonic-widget-settings-option', 'botsonic_widget_token' );
        register_setting( 'botsonic-widget-settings-option', 'botsonic_widget_loggedin' );
	}

	function plugin_page() {
		?>
	        <div class="wrap">
	            <h2><?php echo esc_html__( 'Botsonic Widget Option','botsonic-widget' ); ?></h2>
	            <form action='options.php' method='post'>
		            <?php
		            	$this->save_message();
		            	settings_fields( 'botsonic-widget-settings-option' );
						do_settings_sections( 'botsonic-widget-setting-page' ); 
		            ?>
		            <table class="form-table" role="presentation">
						<tbody>
							<tr>
								<?php $botsonic_widget_token = get_option( 'botsonic_widget_token' )?get_option( 'botsonic_widget_token' ): ''; ?>
								<th scope="row" style="width: 20%;"><?php echo esc_html__('Botsonic Chatbot TOKEN : ','botsonic-widget'); ?></th>
								<td>
									<input type="text" id="botsonic_widget_token" placeholder="Xyzs-0YYY-5tDrW-ZZZ" name="botsonic_widget_token" value="<?php echo esc_attr( $botsonic_widget_token ); ?>"/>
									<label for="botsonic_widget_token"><?php echo esc_html__( 'Sample Botsonic TOKEN : abcD-123cd-456r-79dre-455df-22sse','botsonic-widget'); ?>.</label>
									<p class="description">
									<br>Log in to your Botsonic account <a href="https://app.writesonic.com/fr/signup?utm_source=botsonicwidget&utm_medium=link&utm_campaign=signup" target="_blank">[from here!]</a> to select and copy the <b>TOKEN</b> part only from Embed code (See screenshots).
									<br><br><b>Note :</b> You will need a free Botsonic Chatbot account: <a href="https://app.writesonic.com/fr/signup?utm_source=botsonicwidget&utm_medium=link&utm_campaign=signup" target="_blank">[Create one here!]</a><br/>Or copy link : https://app.writesonic.com/fr/signup?utm_source=botsonicwidget&utm_medium=link&utm_campaign=signup
									
									</p>
								</td>
							</tr>
                            <tr>
								<?php $botsonic_widget_loggedin = get_option( 'botsonic_widget_loggedin' )?get_option( 'botsonic_widget_loggedin' ): '0'; ?>
								<th scope="row" style="width: 20%;"><?php echo esc_html__('Load Chatbot only for logged in users : ','botsonic-widget'); ?></th>
								<td>
								<select id="botsonic_widget_loggedin" name="botsonic_widget_loggedin">
									<option value="0" <?php if ($botsonic_widget_loggedin == "0") echo 'selected="selected"'?>><?php _e('NO', 'botsonic-widget') ?></option>
                                    <option value="1" <?php if ($botsonic_widget_loggedin == "1") echo 'selected="selected"'?>><?php _e('YES', 'botsonic-widget') ?></option>
                                </select>
								<label for="botsonic_widget_loggedin"><?php echo esc_html__("If YES, This will Load Botsonic Chatbot only for logged in users.", 'botsonic-widget') ?>.</label>
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
    	$botsonic_widget_token = get_option( 'botsonic_widget_token' )?get_option( 'botsonic_widget_token' ):'';
        if( isset($_GET['settings-updated'])) { 
        	if($botsonic_widget_token):
			?>
	            <div class="updated notice is-dismissible"> 
	                <p><strong><?php echo esc_html__('Successfully Settings Saved.','botsonic-widget') ?></strong></p>
	            </div>
	        <?php else: ?>
	        	<div class="notice notice-error is-dismissible"> 
	                <p><strong><?php echo esc_html__('Please Enter a Valid Botsonic TOKEN. Botsonic TOKEN Field is Empty.','botsonic-widget') ?></strong></p>
	            </div>
            <?php
        	endif;
        }
    }
}

new Botsonic_Widget_Admin_Setting();

?>
