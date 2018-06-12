<?php
/**
 * 
 * @author Precious Omonzejele <omonze@peepsipi.com>
 */
if(!defined('ABSPATH')){
	exit();
}
class Mauv_TinyMCE {
 
    /**
    * Constructor. Called when the plugin is initialised.
    */
    function __construct() {
 
 		if ( is_admin() ) {
		    add_action( 'init', array( &$this, 'setup_tinymce_plugin' ) );
		    add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts_css' ) );
		    add_action( 'admin_print_footer_scripts', array( &$this, 'admin_footer_scripts' ) );
		}
    }
    /**
	* Check if the current user can edit Posts or Pages, and is using the Visual Editor
	* If so, add some filters so we can register our plugin
	*/
	function setup_tinymce_plugin() {
	 
	    // Check if the logged in WordPress User can edit Posts or Pages
	    // If not, don't register our TinyMCE plugin
	    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
	        return;
	    }
	 
	    // Check if the logged in WordPress User has the Visual Editor enabled
	    // If not, don't register our TinyMCE plugin
	    /*if ( get_user_option( 'rich_editing' ) !== 'true' ) {
	        return;
	    }*/
	 
	    // Setup some filters
	    add_filter( 'mce_external_plugins', array( &$this, 'add_tinymce_plugin' ) );
	    add_filter( 'mce_buttons', array( &$this, 'add_tinymce_toolbar_button' ) );
	}
	/**
	 * Adds a TinyMCE plugin compatible JS file to the TinyMCE / Visual Editor instance
	 *
	 * @param array $plugin_array Array of registered TinyMCE Plugins
	 * @return array Modified array of registered TinyMCE Plugins
	 */
	function add_tinymce_plugin( $plugin_array ) {
		  //enqueue TinyMCE plugin script with its ID.
	    $plugin_array['mauv_shortcode'] = MAUV_PK_ASSETS_PATH. 'js/tinymce.js';
	    return $plugin_array;
	}
	/**
	 * Adds a button to the TinyMCE / Visual Editor which the user can click
	 * to insert a custom CSS class.
	 *
	 * @param array $buttons Array of registered TinyMCE Buttons
	 * @return array Modified array of registered TinyMCE Buttons
	 */
	function add_tinymce_toolbar_button( $buttons ) {
		 //register buttons with their id.
	    array_push( $buttons, 'mauvera_shortcode_btn','mauvera_shortcode_form' );
	    return $buttons;
	}
	/**
	* Enqueues CSS for TinyMCE Dashicons
	*/
	function admin_scripts_css() {
		//wp_enqueue_style( 'tinymce-custom-class', plugins_url( 'tinymce-custom-class.css', __FILE__ ) );
	}
/**
* Adds the Custom Class button to the Quicktags (Text) toolbar of the content editor
*/
function admin_footer_scripts() {
	// Check the Quicktags script is in use
	if ( ! wp_script_is( 'quicktags' ) ) {
		return;
	}
	?>
	<script type="text/javascript">
		QTags.addButton( 'mauvera_shortcode_btn', 'Mauvera ticket link shortcode', insert_mauv_btn );
		QTags.addButton( 'mauvera_shortcode_form', 'Mauvera form ticket shortcode', insert_mauv_form );
		function insert_mauv_btn() {
		    // Ask the user to enter 
		    var _ticket_id = prompt('Enter the ticket id');
		    if ( !_ticket_id ) {
		        // User cancelled - exit
		        return;
		    }
		    if (_ticket_id.length === 0) {
		        // User didn't enter anything - exit
		        return;
		    }
		    // Insert
			QTags.insertContent('[mauvera_ticket_link ticket_id= '+_ticket_id+']click to buy ticket[/mauvera_ticket_link]');
			
		}	
		function insert_mauv_form() {
		    // Ask the user to enter 
		    var _ticket_id = prompt('Enter the ticket id');
		    if ( !_ticket_id ) {
		        // User cancelled - exit
		        return;
		    }
		    if (_ticket_id.length === 0) {
		        // User didn't enter anything - exit
		        return;
		    }
		    // Insert
			QTags.insertContent('[mauvera_ticket_form ticket_id="'+_ticket_id+'" button_name = "Buy ticket"]');
			
		}
	</script>
	<?php
}
 
}
 
$mauv_tinymce = new Mauv_TinyMCE;