/* script to handle the tinymce for the wp*/
(function() {
    tinymce.create('tinymce.plugins.MauvShortcode', {
        init : function(ed, url) {
            // Register buttons - trigger above command when clicked
             ed.addButton('mauvera_shortcode_btn', {title : 'Insert mauvera ticket button/link shortcode', cmd : 'mauvera_insert_btn_shortcode', image: mauvimagesrc.path + 'icon.png' });
           ed.addButton('mauvera_shortcode_form', {title : 'Insert mauvera form ticket shortcode', cmd : 'mauvera_insert_form_shortcode', image: mauvimagesrc.path + 'icon.png' });
        
				ed.addCommand('mauvera_insert_btn_shortcode', function() {
					var ticket_id = prompt('Enter the ticket id');
					if(!ticket_id){ return; }
					if(ticket_id.length === 0){//nothing was put in
						return;
					}
                    selected = tinyMCE.activeEditor.selection.getContent();

                    if( selected ){
                        //If text is selected when button is clicked
                        //Wrap shortcode around it.
                        content =  '[mauvera_ticket_link ticket_id="'+ticket_id+'"]'+selected+'[/mauvera_ticket_link]';
                    }else{
                        content =  '[mauvera_ticket_link ticket_id="'+ticket_id+'"]click to buy ticket[/mauvera_ticket_link]';
                    }

                    tinymce.execCommand('mceInsertContent', false, content);
                });
		
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

        },
		/**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'Mauvera shortcode buttons',
                author : 'Precious Omonze',
                authorurl : '',
                infourl : 'https://github.com/preyous/mauvera-wp-plugin',
                version : "1.0"
            };
        }
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('mauv_shortcode', tinymce.plugins.MauvShortcode);
		
})();	
