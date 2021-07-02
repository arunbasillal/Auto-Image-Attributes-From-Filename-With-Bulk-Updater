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
	var $availableAttributeTags = $( '#iaff-pro .iaff-custom-attribute-tags button' );
	var $customAttribute        = $( '.text_custom_attribute' );
	
	// Check the radio button on clicking the textbox.
	$customAttribute.on( 'click input', function() {
		$attribute = $( this ).attr( 'data-attribute' );
		$( '#radio_custom_attribute_' + $attribute ).prop( 'checked', true );
	} );

	$availableAttributeTags.on( 'click', function() {
		
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
	} );
});