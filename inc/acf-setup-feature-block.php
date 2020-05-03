<?php

/* ############################################
 * # REGISTER CUSTOM BLOCK categor ------------------------> RENAME THIS FUNCTION SO AS NOT TO CREATE CONFLICT
 * ######################################### */
function setup_starter_register_block_categories( $categories ) {
    return array_merge(
        array(
            array(
                'slug' => 'setup_starter',
                'title' => __( 'Setup Starter', 'mydomain' ),
                //'icon'  => 'wordpress',
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories', 'setup_starter_register_block_categories', 10, 2 );


/* ############################################
 * # REGISTER CUSTOM BLOCKS ------------------------> RENAME THIS FUNCTION SO AS NOT TO CREATE CONFLICT
 * ######################################### */
function setup_starter_register_custom_blocks() {

    $blocks = array(
        'feature' => array(
            'name'              => 'feature_pull_block',
            'title'             => __('Feature Pull Block'),
            'render_template'   => plugin_dir_path( __FILE__ ).'../blocks/block-feature-pull-setup-starter.php',
            'category'          => 'setup_starter',
            'icon'              => 'list-view',
            'mode'              => 'edit',
            'keywords'          => array( 'feature', 'highlight', 'pull' ),
        ),
        
    ); //echo $blocks[ 'feature']['render_template'];
       /*
        'logs' => array(
            'name'              => 'log',
            'title'             => __('Log'),
            'render_template'   => 'partials/blocks/block-log-setup-starter.php',
            'category'          => 'setup_starter',
            'icon'              => 'list-view',
            'mode'              => 'edit',
            'keywords'          => array( 'update', 'log' ),
        ),
        */

    // Bail out if function doesn’t exist or no blocks available to register.
    if ( !function_exists( 'acf_register_block_type' ) && !$blocks ) {
        return;
    }
    
    // this loop is broken, how do we register multiple blocks in one go?
    // Register all available blocks.
    foreach ($blocks as $block) {
        acf_register_block_type( $block );
    }
  
}

// Initiates Advanced Custom Fields.
add_action( 'acf/init', 'setup_starter_register_custom_blocks' );
