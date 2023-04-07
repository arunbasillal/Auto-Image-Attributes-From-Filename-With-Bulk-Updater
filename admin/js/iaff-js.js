jQuery( document ).ready( function($){

	$('#iaff-pro .iaff-settings-tab').hide();
	if (sessionStorage.getItem("iaffCurrentTab") !== null) {
		tab = sessionStorage.getItem("iaffCurrentTab");
		$(tab).show();
		$('#iaff-pro a.nav-tab').removeClass('nav-tab-active');
		$('#iaff-pro a[href="'+tab+'"].nav-tab').addClass('nav-tab-active');
	} else {
		$('#iaff-pro #iaff-basic').show();
		$('#iaff-pro a[href="#iaff-basic"].nav-tab').addClass('nav-tab-active');
	}
	$('#iaff-pro .nav-tab').on( 'click', function(e){
		e.preventDefault();
		tab = $(this).attr( 'href' );
		$('#iaff-pro .iaff-settings-tab').hide();
		$(tab).show();
		$('#iaff-pro a.nav-tab').removeClass('nav-tab-active');
		$('#iaff-pro a[href="'+tab+'"].nav-tab').addClass('nav-tab-active');
		if (typeof(Storage) !== "undefined") {
			sessionStorage.setItem("iaffCurrentTab", tab); // Store current tab in sessionStorage object
		}
	});
	
	// UI JS for the clickable tags to use custom attributes. (%filename% %posttitle% etc.)
	$( '#iaff-pro .iaff-custom-attribute-tags button' ).on( 'click', function() {
		
		$attribute       = $( this ).attr( 'data-attribute' );
		$customAttribute = $( '#text_custom_attribute_' + $attribute );
		
		var customAttributeValue    = $customAttribute.val(),
		    selectionStart          = $customAttribute[ 0 ].selectionStart,
		    selectionEnd            = $customAttribute[ 0 ].selectionEnd,
		    textToAppend            = $( this ).text().trim(),
		    newSelectionStart;

		$( '#radio_custom_attribute_' + $attribute ).prop( 'checked', true );

		// Insert structure tag at the specified position.
		$customAttribute.val( customAttributeValue.substr( 0, selectionStart ) + textToAppend + customAttributeValue.substr( selectionEnd ) );

		// Give focus back with cursor right after appended text.
		if ( $customAttribute[0].setSelectionRange ) {
			newSelectionStart = ( customAttributeValue.substr( 0, selectionStart ) + textToAppend ).length;
			$customAttribute[0].setSelectionRange( newSelectionStart, newSelectionStart );
			$customAttribute.trigger( 'focus' );
		}
	});
	
	// Check the radio button on clicking the textbox for custom attribute tags.
	$( '.text_custom_attribute' ).on( 'click input', function() {
		$attribute = $( this ).attr( 'data-attribute' );
		$( '#radio_custom_attribute_' + $attribute ).prop( 'checked', true );
	});

	// Hide attribute settings that are not selected in General Settings of Bulk Updater Settings.
	var dynamicSettings = [
		'bu_image_title',
		'bu_image_alttext',
		'bu_image_caption',
		'bu_image_description',
	];

	$.each( dynamicSettings, function( index, value ) {

		// Show or hide setting at the time of page load.
		if ( $('#iaff_settings\\['+value+'\\]' ).is( ':checked' ) == true ) {
			$('.iaff_'+value+'_settings').show();
		} else {
			$('.iaff_'+value+'_settings').hide();
		}

		// Show or hide setting when user clicks the General Setting checkboxes in Bulk Updater Settings.
		$( '#iaff_settings\\['+value+'\\]' ).click( function() {
			$('.iaff_'+value+'_settings').toggle( function() {
				if ( $('#iaff_settings\\['+value+'\\]' ).is( ':checked' ) == true ) {
					$('.iaff_'+value+'_settings').show( 400, 'linear' );
				} else {
					$('.iaff_'+value+'_settings').hide( 400, 'linear' );
				}
			});
		});
	});

	// Copy custom attributes to all attributes on clicking 'Copy to all attributes' link.
	var customAttributeInputIDEndings = [
		'title',
		'alt_text',
		'caption',
		'description',
	];

	$( '.copy-attribute-link' ).click( function( e ) {
		
		e.preventDefault();
		
		var attribute = $( this ).attr( 'data-attribute' );
		var customAttributeValue = $( '#text_custom_attribute_' + attribute ).val();

		$.each( customAttributeInputIDEndings, function( index, value ) {
			$( '#text_custom_attribute_' + value ).val( customAttributeValue );
		});

		// Saving current innerHTML to handle language translations.
		var currentTargetInnerHTML = e.target.innerHTML;
		e.target.innerHTML = $( this ).attr( 'data-copied-text' );

		setTimeout( function(){
			e.target.innerHTML = currentTargetInnerHTML;
		}, 1000);
	});
});