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
});