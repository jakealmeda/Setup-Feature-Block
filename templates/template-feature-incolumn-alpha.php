<?php
/**
 * TEMPLATE NAME: Feature Incolumn-Alpha
 */

$out = '';
$classes[] = 'incolumn-alpha';		// template specific CSS sleector, change when needed

	// CATEGORIES
	$p_cats = get_the_category( $pid );
	if( $p_cats && in_array( 'post_category', $show_fields ) ) {
	    
	    // $out .= '<div class="item category label"><strong>Category:</strong></div>'; // this line can be commented or removed if not required
	    for( $z=0; $z<=( count( $p_cats ) -1 ); $z++ ) {
	        $out .= '<div class="group pre"><div class="item category"><a href="'.get_category_link( $p_cats[ $z ]->term_id ).'">'.$p_cats[ $z ]->name.'</a></div></div>';
	    }
	    
	}

	// TAGS
	$p_tags = get_the_tags( $pid );
	if( $p_tags && in_array( 'post_tag', $show_fields ) ) {
	    
	    // $out .= '<div class="item tag label"><strong>Tags:</strong></div>'; // this line can be commented or removed if not required
	    for( $w=0; $w<=( count( $p_tags ) - 1 ); $w++ ) {
	        $out .= '<div class="group pre"><div class="item tag"><a href="'.get_tag_link( $p_tags[ $w ]->term_id ).'">'.$p_tags[ $w ]->name.'</a></div></div>';
	    }
	    
	}

	// FEATURED IMAGE
	if( has_post_thumbnail( $pid ) && in_array( 'post_thumbnail', $show_fields ) ) {
	    $out .= '<div class="group card"><div class="item pic"><a href="'.get_the_permalink( $pid ).'">'.get_the_post_thumbnail( $pid, 'medium' ).'</a></div></div>';
	}

	// GROUP INFO
	//echo '<div class="group info">';
	if( in_array( 'post_title', $show_fields ) ) {
	    $out .= '<div class="group info">';
	}

		// TITLE
		if( in_array( 'post_title', $show_fields ) ) {
		    $out .= '<div class="item title"><a href="'.get_the_permalink( $pid ).'">'.get_the_title( $pid ).'</a></div>'; // don't have to validate, a post entry always has a title
		}

	    // AUTHOR | DATE
	    $author_id = get_post_field( 'post_author', $pid ); // don't have to validate, a post entry always has an author
	    $post_published_date = get_the_date( 'M d Y', $pid );
	    $outs = '';
	    if( in_array( 'post_author', $show_fields ) ) {
	        
	        // AUTHOR
	        if( in_array( 'post_author', $show_fields ) ) {
	            $outs .= '<div class="item author"><a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name' , $author_id ).'</a></div>';
	        }
	        
	        // DATE
	        if( in_array( 'post_date', $show_fields ) ) {
	            $outs .= '<div class="item date">'.$post_published_date.'</div>';
	        }
	            
	        $out .= '<div class="group spec">'.$outs.'</div>';
	    } else {

	        // DATE
	        if( in_array( 'post_date', $show_fields ) ) {
	            $outs .= '<div class="item date">'.$post_published_date.'</div>';
	        }
	            
	        $out .= '<div class="group spec">'.$outs.'</div>';
	       
	    }

		// EXCERPT
		$p_excerpt = get_the_excerpt( $pid );
		if( $p_excerpt && in_array( 'post_excerpt', $show_fields ) ) {
		    $out .= '<div class="item summary">'.$p_excerpt.'</div>';
		}

	// GROUP INFO ENDS
	//echo '</div>';
	if( in_array( 'post_title', $show_fields ) ) {
	    $out .= '</div>';
	}

// EOF