/* script */
var $ = jQuery;
$(document).ready(function(){
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
frame = MauvFrame({ 'eventPk' : ticketId, userFormData : formData, onSuccess : function(){}, onClose : function(){} });
//start
frame.loadMauvFrame();
}
});