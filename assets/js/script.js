/* script */
var $ = jQuery;

/**
 * trigger the popup
 *@param int ticketId
 *@param string type, if its form type, does the necessary, else, bla, i'm tired jare.
 */
function mauvTicketTrig(ticketId,type){
	if(ticketId == "" || ticketId == 0){
		alert("An error occured, couldn't get event key");
		return;
	}
	var mauvFormData = {};
	if(type == "form"){//serialise the ish
		var mauvForm = $('form#mauv-form-ticket').serializeArray();
		var _formData = {};
		for (var i = 0; i < mauvForm.length; i++){
			_formData[mauvForm[i]['name']] = mauvForm[i]['value'];
		}
		 mauvFormData = JSON.stringify(_formData);
	}
frame = new MauvFrame({ 'eventPk' : ticketId, userFormData : mauvFormData, onSuccess : function(){}, onClose : function(){} });
//start
frame.loadMauvFrame();
}
