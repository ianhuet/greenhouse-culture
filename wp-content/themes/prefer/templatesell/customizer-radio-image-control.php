<?php
/**
 * Radio Image Custom Control
 * Prefer 1.0.0
 */
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a imags in customizer
 */
if( ! class_exists( 'Prefer_Radio_Image_Control' ) ) {

    class Prefer_Radio_Image_Control extends WP_Customize_Control {
        
        public $type = 'radio-image';

        public function render_content() {
            
            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <div id="input_<?php echo esc_attr( $this->id ); ?>" class="image">
                <?php 
                foreach ( $this->choices as $value => $label ) : 
                    ?>                
                    <label for="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>">
                        <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>" <?php esc_url( $this->link() ); checked( $this->value(), $value ); ?>>
                        <img src="<?php echo esc_url( $label ); ?>"/>
                    </label>
                    <?php 
                endforeach; 
                ?>
            </div>
            <?php
        }
    }
}