/* script to handle the tinymce for the wp*/
jQuery(document).ready(function($) {
//form
    tinymce.create('tinymce.plugins.mauv_form_shortcode', {
        init : function(ed, url) {
        
                // Register command for when button is clicked
                ed.addCommand('mauvera_insert_form_shortcode', function() {
					var ticket_id = prompt('Enter the ticket id');
					if(!ticket_id){ return; }
					if(ticket_id.length == 0){//nothing was put in
						return;
					}
                    content =  '[mauvera_ticket_form ticket_id="'+ticket_id+'" button_name = "Buy ticket"]';
                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
            ed.addButton('mauvera_shortcode_form', {title : 'Insert mauvera form ticket shortcode', cmd : 'mauvera_insert_form_shortcode', image: url + '/assets/images/icon.png' });
        }   
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('mauv_shortcode_form', tinymce.plugins.mauv_form_shortcode);
});