<?php
/**
* Loading scripts in Footer for lighter loading time and better SEO .
*/
class Wp_Botsonic_Free{

	/**
   * [$_instance]
   * @var null
  */
  private static $_instance = null;

  /**
   * [instance] Initializes a singleton instance
   * @return [Wp_Botsonic_Free]
  */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }
	
	function __construct(){
    add_action( 'init', [ $this, 'i18n' ] );
    add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
   * [i18n] Load Text Domain
   * @return [void]
  */
  public function i18n() {
    load_plugin_textdomain( 'wp-botsonic-free', false, dirname( plugin_basename( WP_BOTSONIC_FREE_ROOT ) ) . '/languages/' );
  }

  public function init() {
  	// Plugins Required File
  	$this->includes();

    //add settings in plugin action
    add_filter('plugin_action_links_'.WP_BOTSONIC_FREE_BASE,function($links){
      $link = sprintf("<a href='%s'>%s</a>",esc_url(admin_url('admin.php?page=wp-botsonic-free-setting-page')),__('Settings','wp-botsonic-free'));

      array_push($links,$link);

      return $links;
    });

  	if(wp_botsonic_free_get_token()){
		//echo "-->".wp_botsonic_free_get_loggedin();
  		if (wp_botsonic_free_get_loggedin() == "1") {
			if (is_user_logged_in()){
				add_action( 'wp_footer', [ $this, 'wp_botsonic_free_footer_scirpt_render' ] );
			}else{
			}

  		}else{
			add_action( 'wp_footer', [ $this, 'wp_botsonic_free_footer_scirpt_render' ] );
		}
	}
				
  } //END init
  public function includes() {
    require_once ( WP_BOTSONIC_FREE_PATH . 'admin/admin-init.php' );
  }

 	public function wp_botsonic_free_footer_scirpt_render(){
 		?>
    <!-- WP Botsonic loader Plugin-->
	<script>
		(function (w, d, s, o, f, js, fjs) {
			w["botsonic_widget"] = o;
			w[o] =
			  w[o] ||
			  function () {
				(w[o].q = w[o].q || []).push(arguments);
			  };
			(js = d.createElement(s)), (fjs = d.getElementsByTagName(s)[0]);
			js.id = o;
			js.src = f;
			js.async = 1;
			fjs.parentNode.insertBefore(js, fjs);
		  })(window, document, "script", "Botsonic", "https://widget.writesonic.com/CDN/botsonic.min.js");
		  Botsonic("init", {
			serviceBaseUrl: "https://api.botsonic.ai",
			token: "<?php echo wp_botsonic_free_get_token(); ?>",
		  });
      </script>

 		<?php
 	}

}

Wp_Botsonic_Free::instance();
