<?php if ( is_active_sidebar( 'alertmessage' ) ) : ?>
	<aside class="alertmessage-wrapper text-center bg-warning pt-2 pb-2"><?php dynamic_sidebar( 'alertmessage' ); ?></aside>
<?php else : ?>
	<!-- This content shows up if there are no widgets defined in the backend. -->				
	<div class="alert help show-for-sr">
		<p><?php _e( 'To display a warning reused throughout the site, activate Widgets > Widgets - Alert Message.', 'understrap' );  ?></p>
	</div>
<?php endif; ?>