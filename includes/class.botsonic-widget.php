<?php
/**
* Loading scripts in Footer for lighter loading time and better SEO .
*/
class Botsonic_Widget{

	/**
   * [$_instance]
   * @var null
  */
  private static $_instance = null;

  /**
   * [instance] Initializes a singleton instance
   * @return [Botsonic_Widget]
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
    load_plugin_textdomain( 'botsonic-widget', false, dirname( plugin_basename( BOTSONIC_WIDGET_ROOT ) ) . '/languages/' );
  }

  public function init() {
  	// Plugins Required File
  	$this->includes();

    //add settings in plugin action
    add_filter('plugin_action_links_'.BOTSONIC_WIDGET_BASE,function($links){
      $link = sprintf("<a href='%s'>%s</a>",esc_url(admin_url('admin.php?page=botsonic-widget-setting-page')),__('Settings','botsonic-widget'));

      array_push($links,$link);

      return $links;
    });

  	if(botsonic_widget_get_token()){
		//echo "-->".botsonic_widget_get_loggedin();
  		if (botsonic_widget_get_loggedin() == "1") {
			if (is_user_logged_in()){
				add_action( 'wp_footer', [ $this, 'botsonic_widget_footer_scirpt_render' ] );
			}else{
			}

  		}else{
			add_action( 'wp_footer', [ $this, 'botsonic_widget_footer_scirpt_render' ] );
		}
	}
				
  } //END init
  public function includes() {
    require_once ( BOTSONIC_WIDGET_PATH . 'admin/admin-init.php' );
  }

 	public function botsonic_widget_footer_scirpt_render(){
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
			token: "<?php echo botsonic_widget_get_token(); ?>",
		  });
      </script>

 		<?php
 	}

}

Botsonic_Widget::instance();
