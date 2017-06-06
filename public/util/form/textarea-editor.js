$(function(){

	$('div.textarea-group').each(function(){

		var textarea;
		var el = this;
		var init = false;
		var id = $('textarea', el).attr('id');

		var getStatus = function(){
			return $('input:hidden', el).val();
		}

		var setStatus = function($value){
			$('input:hidden', el).val($value);
		}

		var addHTML = function(){
			textarea = new nicEditor({
				iconsPath: $('textarea', el).data('icons-url'),
				fullPanel: true,
			}).panelInstance(id);
		};

		var removeHTML = function(){

			var nicInstance = nicEditors.findEditor(id);
			var content = nicInstance.getContent();

			// 
			textarea.removeInstance(id);
			textarea = null;

	        // strip html tags
			var regex = /(<([^>]+)>)/ig
			var result = content.replace(regex, "");
	        $('textarea', el).val(result);
		};

		//
		var addMarkdown = function(){
			textarea = new SimpleMDE({
				element: document.getElementById(id),
				spellChecker: false,
				status: false,
			});
		};

		var removeMarkdown = function(){
			textarea.toTextArea();
			textarea = null;
		};

		var removeAll = function(){
			switch(getStatus()){
				case 'html':
					removeHTML();
					break;

				case 'markdown':
					removeMarkdown()
					break;
			}
		}

		var activeLink = function(btn){
			$('a[data-editor]').removeAttr('style');

			$(btn).css({
				color: '#333',
				cursor: 'default',
				'text-decoration': 'none',
				'font-weight': 'bold',
			});
		};

		//
		$('a[data-editor]').on('click tap', function(){

			if(init == false){
				setStatus('');
			}

			if(init && getStatus() == $(this).data('editor')){
				return false;
			}

			if(init == false || confirm('A formatação do texto será perdida com a alteração do editor, deseja continuar?')){
				
				//
				var type = $(this).data('editor');

				//
				removeAll();
				setStatus(type);
				activeLink(this);
				init = true;

				//
				switch(type) {
				    case 'html':
				    	addHTML();
				        break;

				    case 'markdown':
				        addMarkdown();
				        break;
				}

			}

			//
			return false;
		});

		//
		$('a[data-editor="'+getStatus()+'"]', el).click();
	});	




	// $('textarea[data-editor-html=1]').each(function(){
	// 	new nicEditor({
	// 		iconsPath: $(this).data('icons-url'),
	// 		fullPanel: true
	// 	}).panelInstance($(this).attr('id'));
		
	// });

});
