<?php
/**
 * Plugin Name: Setup Feature Blocks
 * Description: Utilizing ACF, we add custom Gutenburg blocks
 * Version: 1.0
 * Author: Jake Almeda
 * Author URI: http://smarterwebpackages.com/
 * Network: true
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action( 'genesis_setup', 'setup_feature_custom_block', 15 );
function setup_feature_custom_block() {

	$acf_field_group_name = 'Feature Pull Block';

	// DELETE IF ENABLING THE PLUGIN FOR A SPECIFIC SUBSITE IS DISCOVERED
	if( get_current_blog_id() != 6 )
		RETURN;

    // validate if ACF plugin is installed and active
    if( ! class_exists('ACF') ) {

    	// Plugin not found | Show warning message in the target hook
    	add_action( 'genesis_entry_content', 'setup_starter_get_acf_please', 100 );

    } else {

	    // check if ACF field group required is present and active
	    if( ! setup_is_field_group_exists( $acf_field_group_name ) ) {

	    	// No required field group | Show warning message in the target hook
	    	// Guide: https://www.billerickson.net/building-gutenberg-block-acf/
	    	add_action( 'genesis_entry_content', 'setup_starter_add_acf_field_group', 100 );

	    } else {
	    	/*
			// get custom field
			$relations = get_post_meta( get_the_ID(), 'acf_field_group_named', TRUE );

			// don't forget to declare the global variable which will be passed to the templates
			foreach( $relations as $pid ) {

				$out .= setup_starter_get_template( $template_dir, $template );

			}
			*/

			/**
			 JAKE: ADD A VALIDATION IF FIELDS ARE PRESENT
			 +++++++++++++++++++++++++++++++++++++++++++
			 +++++++++++++++++++++++++++++++++++++++++++
			 +++++++++++++++++++++++++++++++++++++++++++
			 +++++++++++++++++++++++++++++++++++++++++++
			*/
			
			// include files
			$include_dir = plugin_dir_path( __FILE__ ).'inc';
			$inc_these_files = setup_starter_pull_files( $include_dir );
			foreach ( $inc_these_files as $inc_the_file ) {
				include_once $include_dir.'/'.$inc_the_file;
			}

	    }

	}
	
}

// include all files in the INC folder but get rid of the dots that scandir() picks up in Linux environments
if( !function_exists( 'setup_starter_pull_files' ) ) {

	function setup_starter_pull_files( $directory ) {
		
		// get all files inside the directory but remove unnecessary directories
		$ss_plug_dir = array_diff( scandir( $directory ), array( '..', '.' ) );
		
		foreach ($ss_plug_dir as $value) {
			
			// combine directory and filename
			$file = $directory.'/'.$value;
			
			// get details of the file
			$filepath = pathinfo( $file );
			
			// filter files to include
			if( $filepath['extension'] == 'php' ) {
				$out[] = $value;
			}

		}

		// Return an array of files (without the directory)
		return $out;

	}
	
}

// PULL TEMPLATE FILES
if( !function_exists( 'setup_starter_list_all_templates' ) ) {

	function setup_starter_list_all_templates() {
		
		// set directory
		$tar_dir = plugin_dir_path( __FILE__ )."templates";
		
		// get an array of files from $tar_dir
		$dir_file = setup_starter_pull_files( $tar_dir );
		foreach ($dir_file as $d_file) {
		
			// get the tokens
			$tokens = token_get_all( file_get_contents( $tar_dir.'/'.$d_file ) );

			foreach($tokens as $token) {
			    
			    //if($token[0] == T_COMMENT || $token[0] == T_DOC_COMMENT) {
			    if( $token[0] == T_DOC_COMMENT ) {

			    	// remove unnecessary characters
			        $t_name = trim( str_replace( '*', '', str_replace( '/', '', $token[1] ) ) );
			        
			    }

			}

			// split the line to get the template name from "TEMPLATE NAME: Feature Display All"
			$et_name = explode( ':', $t_name );

			// trim( $et_name[0] ) contains "TEMPLATE NAME"
			// trim( $et_name[1] ) contains the actual template name
			// $d_file is the PHP file
			$out[] = array( $d_file => trim( $et_name[1] ) );

		}

		return $out;

	}

}

// display message to get ACF
if( !function_exists( 'setup_starter_get_acf_please' ) ) {

	function setup_starter_get_acf_please() {

		echo 'Please install/activate the required <a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank">Advanced Custom Fields (ACF)</a> plugin.';
	
	}	

}

// display message if specific ACF field group is missing
if( !function_exists( 'setup_starter_add_acf_field_group' ) ) {

	function setup_starter_add_acf_field_group() {

		echo '<p>Please create/active the ACF field group '.strtoupper( $acf_field_group_name ).' and follow the details based on the screenshot below</p>
				<p>Add here JAKE!</p>';

	}

}

// validate if specific ACF field group exists
if( !function_exists( 'setup_is_field_group_exists' ) ) {

	function setup_is_field_group_exists( $value, $type='post_title' ) {

	    $exists = false;

	    if( $field_groups = get_posts( array( 'post_type'=>'acf-field-group' ) ) ) {
	        
	        foreach( $field_groups as $field_group ) {
	            
	            if( strtolower( $field_group->$type ) == strtolower( $value ) ) {
	                $exists = true;
	            }
	        
	        }

	    }

	    return $exists;

	}

}

// GET CONTENTS OF THE TEMPLATE FILE
/*if( !function_exists( 'setup_starter_get_template' ) ) {
    
    function setup_starter_get_template( $template_dir, $filename ) {
        
    	$d_file = plugin_dir_path( __FILE__ ).str_replace( '/', '', $template_dir ).'/'.$filename.'.php';

        if( file_exists( $d_file ) ) {

	        ob_start();
	        include $d_file;
	        return ob_get_clean();

	    } else {

	    	return 'No such file in target directory.';

	    }

    }
    
    //include get_stylesheet_directory().'/partials/setup_starter_templates/'.$filename.'.php';
    
}*/
