/* script */
var $ = jQuery;
$(document).ready(function(){
function mauv_tick(ticket_id,){
	if(ticket_id == "" || ticket_id == 0){
		alert("An error occured, couldn't get event key");
		return;
	}
	var formData = {};
frame = MauvFrame({ 'eventPk' : ticket_id, userFormData : formData, onSuccess : function(){}, onClose : function(){} });
//start
frame.loadMauvFrame();
}
});