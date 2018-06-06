<?php
/**
 * The file handling the measurement feature in the order page in dashboard
 * I'm talking like this or typing like this cause i'm tired, no vex :(
 * you shaa understand what i mean.
 * 
 * @author Precious Omonzejele <omonze@peepsipi.com>
 */
if(!defined('ABSPATH')){
	exit();
}
//start enqeueing
if(!function_exists('adm_pk_order_css_enqueue')){
    function adm_pk_order_css_enqueue() {        
        wp_enqueue_style( 'adm_pk_css-order-style',ADM_PK_ASSETS_PATH.'css/order_style.css');
    }
    }
    add_action( 'admin_enqueue_scripts', 'adm_pk_order_css_enqueue' );
//emails

/** 
 * Adds custom css style to the order email header 
 */  
function adm_pk_add_css_to_emails() {
?>
<style type="text/css">
 /*.adm-cloth-type{
  font-weight: 500;font-size: 15px;text-transform: uppercase;text-shadow: 0px 1px 1px rgba(0,0,0,0.2);
 }*/
.adm-unit{
  font-weight: 700;font-size: 16px;text-transform: uppercase;text-shadow: 0px 1px 1px rgba(0,0,0,0.2);
}
.adm-arrow-img{
  width:24px; position: relative;top: 3px;
}
.adm-m-value-holder{
  font-weight:600;font-size: 16px;background-color: #ffffff;box-shadow: 1px 2px 2px 1px rgba(0,0,0,0.2);padding: 2px 5px; margin-right: 6px;
}
.adm-m-value{
  font-weight: 600;margin-left: 3px;font-size: 17px;
 }
.adm-little-title-head{
  font-weight: 500;font-size: 15px;text-transform: uppercase;text-shadow: 0px 1px 1px rgba(0,0,0,0.2);margin: 15px 0 5px 0 !important;
 }
</style>
<?php
}  
add_action( 'woocommerce_email_header', 'adm_pk_add_css_to_emails' );

/**
 * adds the measurement meta to the email
 * @hooked to action woocommerce_order_item_meta_end
 */
function adm_pk_add_to_order_item_meta($item_id, $item, $order){
	$measurement_vals = wc_get_order_item_meta($item_id,'_measurements');
	$measurement_unit = wc_get_order_item_meta($item_id,'_measurement_unit');
  $cloth_type = wc_get_order_item_meta($item_id,'_cloth_type');
  $list_array = array(
    'Measurement Unit'=>$measurement_unit,
  //  'Cloth Type'=>$cloth_type,
    'Measurements'=>'<ul>'.$measurement_vals.'</ul>'
  );
  echo "<ul>";
  foreach($list_array as $title=>$value){
    echo "<li>".$title.": ".$value."</li>";
  }
  echo "</ul>";
}

/**
 * Add to the email header, so we only enable the item metas to show for admin
 */
function adm_pk_add_order_email_instructions( $order, $sent_to_admin ) {
  if($sent_to_admin != false){// add the order item filter only when the mail is sent to the admin
add_action('woocommerce_order_item_meta_end','adm_pk_add_to_order_item_meta',10,3);
  }
  else{
    remove_action('woocommerce_order_item_meta_end','adm_pk_add_to_order_item_meta',10);    
  }
}
add_action('woocommerce_email_before_order_table','adm_pk_add_order_email_instructions',1,2);
