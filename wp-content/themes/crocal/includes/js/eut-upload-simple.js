jQuery(document).ready(function($) {

	"use strict";

	var eutMediaFrame;
	var eutMediaInputField;
	var eutMediaInputType;


	$(document).on("click",".eut-remove-simple-media-button",function() {
		$(this).parent().find('.eut-upload-simple-media-field').val('');
		$(this).parent().find('.eut-upload-simple-media-field').trigger('change');
	});

	$(document).on("click",".eut-upload-simple-media-button",function() {
		eutMediaInputField = $(this).parent().find('.eut-upload-simple-media-field');
		eutMediaInputType = $(this).data('media-type');

		eutMediaFrame = wp.media.frames.eutMediaFrame = wp.media({
			className: 'media-frame eut-media-frame',
			frame: 'select',
			multiple: false,
			title: crocal_eutf_upload_media_texts.modal_title,
			library: {
				type: eutMediaInputType
			},
			button: {
				text:  crocal_eutf_upload_media_texts.modal_button_title
			}
		});
		eutMediaFrame.on('select', function(){
			var mediaAttachment = eutMediaFrame.state().get('selection').first().toJSON();
			eutMediaInputField.val( mediaAttachment.url );
			eutMediaInputField.trigger('change');
		});

		eutMediaFrame.open();
	});

});