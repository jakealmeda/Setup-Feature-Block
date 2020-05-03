<?php

/**
 * SETUP FEATURE BLOCK
 * This file will populate the options for varried ACF fields
 */


// TEMPLATE DROPDOWN SELECT
if( ! function_exists( 'setup_starter_acf_pull_template' ) ) {
    
    function setup_starter_acf_pull_template( $field ) {
        
        // check available templates using main file
        foreach( setup_starter_list_all_templates() as $the_file ) {

            foreach ($the_file as $key => $value) {

                // $key is the filename while the $value is the template name
                // do not include the template without proper heading
                if( $value ) {
                    $fielder[ pathinfo( $key, PATHINFO_FILENAME ) ] = $value;
                }

            }

        }

        // sort the array alphabetically
        asort( $fielder );

        // include the array of templates to the choices
        $field['choices'] = $fielder;
        
        if( is_array($choices) ) {
            
            foreach( $choices as $choice ) {
                $field['choices'][ $choice ] = $choice;
            }
            
        }
        
        // return the field
        return $field;

    }
    
}

// POPULATE CHECKBOXES
if( ! function_exists( 'setup_starter_acf_populate_checkboxes' ) ) {
    
    function setup_starter_acf_populate_checkboxes( $field ) {

        // https://toolset.com/documentation/user-guides/custom-content/standard-wordpress-fields/

        $field['default_value'] = array( 'post_title' => 'Title', );
        
        $field['choices'] = array(
            'post_id'                   => 'ID', // done
            'post_author'               => 'Author Name', // done
            'post_author_avatar'        => 'Author Avatar', // done
            'post_author_desc'          => 'Author Description', // done
//            post_date_gmt
            'post_content'              => 'Content', // done
            'post_title'                => 'Title', // done
            'post_excerpt'              => 'Excerpt', // done
//            'post_status'               => 'Post Status',
//            comment_status
//            ping_status
//            post_password
            'post_name'                 => 'Post Name (Slug)', // done
//            to_ping
//            pinged
            'post_date'                 => 'Date Published', // done
            'post_modified'             => 'Date Modified', // done
//            post_modified_gmt
//            post_content_filtered
//            post_parent
//            guid
//            menu_order
            'post_type'                 => 'Post Type', // done
//            post_mime_type
//            comment_count
//            filter
            'post_thumbnail'            => 'Featured Image', // done
            'post_category'             => 'Category', // done
            'post_tag'                  => 'Tags', // done
        );
        

        // custom field
        // get_post_custom()

        if( is_array($choices) ) {
            
            foreach( $choices as $choice ) {
                $field['choices'][ $choice ] = $choice;
            }
            
        }
        
        // return the field
        return $field;
        
    }
    
}

// load if is_admin only
if( is_admin() ) {
    add_filter('acf/load_field/name=pull_template', 'setup_starter_acf_pull_template'); // TEMPLATE
    add_filter('acf/load_field/name=select_fields_to_show', 'setup_starter_acf_populate_checkboxes'); // TEMPLATE
}

