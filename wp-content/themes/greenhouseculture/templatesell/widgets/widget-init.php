<?php

if ( ! function_exists( 'greenhouseculture_load_widgets' ) ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function greenhouseculture_load_widgets() {

        // Highlight Post.
        register_widget( 'Greenhouseculture_Featured_Post' );

        // Author Widget.
        register_widget( 'Greenhouseculture_Author_Widget' );

		// Social Widget.
        register_widget( 'Greenhouseculture_Social_Widget' );
    }
endif;
add_action( 'widgets_init', 'greenhouseculture_load_widgets' );


