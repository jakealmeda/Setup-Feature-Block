<?php
/**
 * BLOCK-FEATURE
 *
 * @package      SETUP-STARTER
 * @author       Jake Almeda
 * @since        1.0.0
 * @license      GPL-2.0+
**/

$post_entry = get_field( 'pull_from' );
$pull_template = get_field( 'pull_template' );
$show_fields = get_field( 'select_fields_to_show' );

// USE TEMPLATES
ob_start();
include plugin_dir_path( __FILE__ ).'../templates/'.$pull_template[ 'value' ].'.php';
echo ob_get_clean();

/* ---------------------------------------- 
 * SORT DISPLAY
 * ------------------------------------- */
if( $out ) {

    // $classes is the default CSS selector | Add to array
    $classes[] = 'module feature';
    
    // Include CSS selectors manually entered thru wp-admin
    //if( $block[ 'className' ] ) { // this kind of checking causes errors in AWS kind of environment
    if( array_key_exists( 'className', $block ) ) {
        $classes = array_merge( $classes, explode( ' ', $block[ 'className' ] ) );
    }

    echo '<div class="'.join( ' ', $classes ).'">'.$out.'</div>'; // DIV CONTAINER

}