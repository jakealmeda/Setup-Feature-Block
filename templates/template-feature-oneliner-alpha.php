<?php
/**
 * TEMPLATE NAME: Feature OneLiner-Alpha
 */

$out = '';
$classes[] = 'oneliner-alpha';		// template specific CSS sleector, change when needed

	// CATEGORIES
	$p_cats = get_the_category( $pid );
	if( $p_cats && in_array( 'post_category', $show_fields ) ) {
	    
	    // $out .= '<div class="item category label"><strong>Category:</strong></div>'; // this line can be commented or removed if not required
	    for( $z=0; $z<=( count( $p_cats ) -1 ); $z++ ) {
	        $out .= '<span class="group pre"><span class="item category"><a href="'.get_category_link( $p_cats[ $z ]->term_id ).'">'.$p_cats[ $z ]->name.'</a></span></span>';
	    }
	    
	}

	// TAGS
	$p_tags = get_the_tags( $pid );
	if( $p_tags && in_array( 'post_tag', $show_fields ) ) {
	    
	    // $out .= '<div class="item tag label"><strong>Tags:</strong></div>'; // this line can be commented or removed if not required
	    for( $w=0; $w<=( count( $p_tags ) - 1 ); $w++ ) {
	        $out .= '<span class="group pre"><span class="item tag"><a href="'.get_tag_link( $p_tags[ $w ]->term_id ).'">'.$p_tags[ $w ]->name.'</a></span></span>';
	    }
	    
	}

	// GROUP INFO
	//echo '<div class="group info">';
	if( in_array( 'post_title', $show_fields ) ) {
	    $out .= '<span class="group info">';
	}

		// TITLE
		if( in_array( 'post_title', $show_fields ) ) {
		    $out .= '<span class="item title"><a href="'.get_the_permalink( $pid ).'">'.get_the_title( $pid ).'</a></span>'; // don't have to validate, a post entry always has a title
		}

		// EXCERPT
		$p_excerpt = get_the_excerpt( $pid );
		if( $p_excerpt && in_array( 'post_excerpt', $show_fields ) ) {
		    $out .= '<span class="item summary">'.$p_excerpt.'</span>';
		}

	    // AUTHOR | DATE
	    $author_id = get_post_field( 'post_author', $pid ); // don't have to validate, a post entry always has an author
	    $post_published_date = get_the_date( 'M d Y', $pid );
	    $outs = '';
	    if( in_array( 'post_author', $show_fields ) ) {
	        
	        // AUTHOR
	        if( in_array( 'post_author', $show_fields ) ) {
	            $outs .= '<span class="item author"><a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name' , $author_id ).'</a></span>';
	        }
	        
	        // DATE
	        if( in_array( 'post_date', $show_fields ) ) {
	            $outs .= '<span class="item date">'.$post_published_date.'</span>';
	        }
	            
	        $out .= '<span class="group spec">'.$outs.'</span>';
	    } else {

	        // DATE
	        if( in_array( 'post_date', $show_fields ) ) {
	            $outs .= '<span class="item date">'.$post_published_date.'</span';
	        }
	            
	        $out .= '<span class="group spec">'.$outs.'</span';
	       
	    }

	// GROUP INFO ENDS
	//echo '</div>';
	if( in_array( 'post_title', $show_fields ) ) {
	    $out .= '</span>';
	}

// EOF