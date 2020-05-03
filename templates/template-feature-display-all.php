<?php
/**
 * TEMPLATE NAME: Feature Display All
 */

$out = '';

//echo '<div class="module feature">';

    // POST ID
    if( in_array( 'post_id', $show_fields ) ) {
        $out .= '<div class="item post-id"><strong>Post ID:</strong> '.$pid.'</div>';
    }

    // FEATURED IMAGE
    if( has_post_thumbnail( $pid ) && in_array( 'post_thumbnail', $show_fields ) ) {
        $out .= '<div class="item pic"><strong>Featured Image:</strong> <a href="'.get_the_permalink( $pid ).'">'.get_the_post_thumbnail( $pid, 'thumbnail' ).'</a></div>';
    }
    
    // TITLE
    if( in_array( 'post_title', $show_fields ) ) {
        $out .= '<div class="item title"><strong>Title:</strong> <a href="'.get_the_permalink( $pid ).'">'.get_the_title( $pid ).'</a></div>'; // don't have to validate, a post entry always has a title
    }
    
    // POST-NAME (SLUG)
    if( in_array( 'post_name', $show_fields ) ) {
        $out .= '<div class="item post-name"><strong>Post Name (Slug):</strong> '.get_post_field( 'post_name', $pid ).'</div>';
    }
    
    // AUTHOR
    $author_id = get_post_field( 'post_author', $pid ); // don't have to validate, a post entry always has an author
    $outs = '';
    if( in_array( 'post_author', $show_fields ) ) {
        
        // name
        $outs .= '<div class="item author-name"><a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name' , $author_id ).'</a></div>';
        
        // avatar
        if( in_array( 'post_author_avatar', $show_fields ) ) {
            $outs .= '<div class="item author-gravatar"><a href="'.get_author_posts_url( $author_id ).'"><img src="'.get_avatar_url( $author_id ).'" /></a></div>';
        }
        
        // user description
        if( in_array( 'post_author_desc', $show_fields ) ) {
            $outs .= '<div class="item author-description">'.get_the_author_meta( 'user_description', $author_id ).'</div>';
        }
            
        $out .= '<div class="item author">'.$outs.'</div>';
    }
    
    // WP-CONTENT
    $wp_content = get_the_content( NULL, FALSE, $pid );
    if( $wp_content && in_array( 'post_content', $show_fields ) ) {
        
        $out .= '<div class="item wp-content"><strong>WP-Content:</strong> '.$wp_content.'</div>';
        
    }
    
    // POST PUBLISHED DATE
    $post_published_date = get_the_date( 'd M Y h:i:s A', $pid );
    if( $post_published_date && in_array( 'post_date', $show_fields ) ) {
        
        $out .= '<div class="item published_timestamp"><strong>Date Published:</strong> '.$post_published_date.'</div>';
        // OR SEPARATE DATE AND TIME
        /*$out .= '<div class="published_timestamp">
                <div class="item date published">Date: '.get_the_date( 'd M Y', $pid ).'</div>
                <div class="item time published">Time: '.get_the_date( 'h:i:s A', $pid ).'<div>
            </div>';*/
            
    }
    
    // POST MODIFIED DATE
    $post_modified_date = get_the_modified_date( 'd M Y h:i:s A', $pid );
    if( $post_modified_date && in_array( 'post_modified', $show_fields ) ) {
        
        $out .= '<div class="item modified_timestamp"><strong>Date Modified:</strong> '.$post_modified_date.'</div>';
        // OR SEPARATE DATE AND TIME
        /*$out .= '<div class="modified_timestamp">
                <div class="item date modified">Date: '.get_the_modified_date( 'd M Y', $pid ).'</div>
                <div class="item time modified">Time: '.get_the_modified_date( 'h:i:s A', $pid ).'<div>
            </div>';*/
        
    }
    
    // EXCERPT
    $p_excerpt = get_the_excerpt( $pid );
    if( $p_excerpt && in_array( 'post_excerpt', $show_fields ) ) {
        
        $out .= '<div class="item excerpt"><strong>Excerpt:</strong> '.$p_excerpt.'</div>';
        
    }
    
    // CATEGORIES
    $p_cats = get_the_category( $pid );
    if( $p_cats && in_array( 'post_category', $show_fields ) ) {
        
        $out .= '<div class="item category label"><strong>Category:</strong></div>'; // this line can be commented or removed if not required
        for( $z=0; $z<=( count( $p_cats ) -1 ); $z++ ) {
            $out .= '<div class="item category"><a href="'.get_category_link( $p_cats[ $z ]->term_id ).'">'.$p_cats[ $z ]->name.'</a></div>';
        }
        
    }
    
    // TAGS
    $p_tags = get_the_tags( $pid );
    if( $p_tags && in_array( 'post_tag', $show_fields ) ) {
        
        $out .= '<div class="item tag label"><strong>Tags:</strong></div>'; // this line can be commented or removed if not required
        for( $w=0; $w<=( count( $p_tags ) - 1 ); $w++ ) {
            $out .= '<div class="item tag"><a href="'.get_tag_link( $p_tags[ $w ]->term_id ).'">'.$p_tags[ $w ]->name.'</a></div>';
        }
        
    }
    
    // POST TYPE
    $p_type = get_post_type( $pid );
    if( $p_type && in_array( 'post_type', $show_fields ) ) {
        
        $out .= '<div class="item posttype"><strong>Post Type:</strong> '.ucfirst( $p_type ).'</div>'; // PHP function ucfirst (upper case first letter)
        
    }
    
    // ########################### CUSTOM FIELDS

    // CUSTOM FIELD
    $item_link = get_post_meta( $pid, 'link', TRUE );
    if( $item_link ) {
        $out .= '<div class="item link"><a href="'.$item_link.'" target="_blank">'.$item_link.'</a></div>';
    }
    
    // CUSTOM DESCRIPTION
    $item_description = get_post_meta( $pid, 'description', TRUE );
    if( $item_description ) {
        $out .= '<div class="item description">'.$item_description.'</div>';
    }
    
    // CUSTOM PIC
    $item_pic = get_post_meta( $pid, 'pic', TRUE );
    if( ! empty( $item_pic ) ) {
        $out .= '<div class="item pic">'.wp_get_attachment_image( $item_pic[ 'ID' ], 'medium' ).'</div>';
    }

//echo '</div>';
// EOF