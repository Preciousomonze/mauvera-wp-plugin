<?php
/**
 * The file handling the shortcode conversion 
 *
 * For more info about wordpress shortcode https://codex.wordpress.org/Shortcode_API
 * @author Precious Omonzejele <omonze@peepsipi.com>
 */
if(!defined('ABSPATH')){
	exit();
}
//the external src function isn't being recognised for some reason

/**
 * Handles the mauvera link shortcode
 *
 * @param array $atts
 * @param string $content
 * @return string
 */
function mauv_link_shortcode($atts,$content = null){
	$content = isset($content) ? trim($content) : 'Click to buy ticket';
	$a = shortcode_atts(array(
		'id' => '','class' =>'mauv-btn-feel','ticket_id' => 0
	),$atts,'mauvera_ticket_link');
	$result = '<a href="#mauv-open" id="'.$a['id'].'" class="'.$a['class'].'" onclick="mauvTicketTrig('.$a['ticket_id'].',\'link\')">'.$content.'</a>';
	return $result;
}
add_shortcode('mauvera_ticket_link','mauv_link_shortcode');
/**
 * Handles the mauvera form shortcode
 *
 * @param array $atts
 * @param string $content
 * @return string
 */
 
function mauv_form_shortcode($atts,$content = null){
	$content = isset($content) ? trim($content) : 'Click to buy ticket';
	$a = shortcode_atts(array(
		'class' =>'','ticket_id' => 0, 'button_name' => 'Buy ticket'
	),$atts,'mauvera_ticket_form');
	$result = '
	<form id="mauv-form-ticket" class="'.$a['class'].' mauv-form-ticket">
	<input type="text" name="first_name" class="mauv-input form-control" required autocomplete" placeholder="First Name *">
	<input type="text" name="last_name" class="mauv-input form-control" required autocomplete" placeholder="Last Name *">
	<input type="email" name="email" class="mauv-input form-control" required autocomplete" placeholder="Email address *">
	<input type="tel" name="phone_number" class="mauv-input form-control" required autocomplete" placeholder="Phone number *">
	<button type="submit" class="mauv-form-btn">'.$a['button_name'].'</button>
	</form>
	
	<script type="text/javascript">
$(document).ready(function(){
	$("form#mauv-form-ticket").submit(function(e){
		e.preventDefault();
		mauvTicketTrig('.$a['ticket_id'].',"form");
	});
});
	</script>
	';
	return $result;
}
add_shortcode('mauvera_ticket_form','mauv_form_shortcode');