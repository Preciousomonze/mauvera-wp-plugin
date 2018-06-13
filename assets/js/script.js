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
	var formData = {};
	if(type == "form"){//serialise the ish
		var mauvForm = $('form#mauv-form-ticket').serialiseArray();
		var _formData = {};
  for (var i = 0; i < mauvForm.length; i++){
    _formData[mauvForm[i]['name']] = mauvForm[i]['value'];
  }
  var formData = _formData;
	}
//chibuzor, i guess this is where the issue is coming from, adjust, thanks :), if what you did isn't easily explainable, comment them, 
frame = new MauvFrame({ 'eventPk' : ticketId, userFormData : formData, onSuccess : function(){}, onClose : function(){} });
//start
frame.loadMauvFrame();
}

/**
 * for some reason, serialiseArray didnt work, and when trying to update jquery and add migrate, weird issue
 * @pram string value
 */
function mauvSerialiseToJson(value){
	var result = '';
}