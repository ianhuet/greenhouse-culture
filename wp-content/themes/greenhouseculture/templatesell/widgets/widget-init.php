<?php

if ( ! function_exists( 'prefer_load_widgets' ) ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function prefer_load_widgets() {

        // Highlight Post.
        register_widget( 'Prefer_Featured_Post' );

        // Author Widget.
        register_widget( 'Prefer_Author_Widget' );
		
		// Social Widget.
        register_widget( 'Prefer_Social_Widget' );
    }
endif;
add_action( 'widgets_init', 'prefer_load_widgets' );


