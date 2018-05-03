<?php
/**
 * Adds a shortcode
 */

function ews_tab_shortcode( $atts ) {
    extract( shortcode_atts( array(
        'parent' => '',
        'type' => 'service_tab',
        'perpage' => 4
    ), $atts ) );
    $output = '<div class="ewscontainer"><div><ul class="nav nav-pills">';

	global $wpdb;
	$sort_col = $wpdb->get_results( "SELECT option_value FROM {$wpdb->prefix}options WHERE option_name = 'myplugin_option_name'", ARRAY_A );

		$args = array(
        'post_parent' => $parent,
        'post_type' => $type,
        'posts_per_page' => $perpage,
        'order'   => $sort_col['0']['option_value']
    );
    $ews_tab_query = new  WP_Query( $args );
	$i = 1;
    while ( $ews_tab_query->have_posts() ) : $ews_tab_query->the_post();
		
        $output .= '<li id="ews_tab'. $i .'"><a data-toggle="pill" href="#tab'. $i .'">'. get_the_title(). '</a></li>';
		$i++;
    endwhile;
    wp_reset_query();
    $output .= '</ul></div><div class="tab-content">';

    $ews_tab_query = new  WP_Query( $args );
	$i = 1;
    while ( $ews_tab_query->have_posts() ) : $ews_tab_query->the_post();
	$id = get_the_ID();
	$meta = get_post_meta( $id );

	        $output .= '<div id="tab'.$i.'" class="tab-pane fade"><h2>'. $meta[tab_heading][0] . '</h2>
						<p>'. $meta[tab_sub_heading][0] . '</p>';
			
			//$cats = get_the_category( $id );
			$cats = get_the_terms( $id, 'service_listings' );
			
			foreach ( $cats as $cat ){
				$parent = $cat->parent;
				if ( $parent=='0' ) {
					$term = $cat->term_id;
					$sub = sub_category( $term, $id );
					$subc = sub_categories( $term, $id );
					$ser = ews_services( $term, $id );
					$output .= '<div class="col-sm-6 ews_tab"><h3>'. $cat->name .'</h3><ul class="includes">'. $ser .'</ul></div>'; 	
				}
			}

			$output .= '</div>';

			$i++;
    endwhile;
    wp_reset_query();

$output .= '</div>';
    return $output;
}
add_shortcode('ews_tab', 'ews_tab_shortcode');


function sub_category( $atts, $id ) {
	$ewssub = $atts;
	$id1 = $id;
	$subcats = get_the_terms( $id1, 'service_listings' );
	//print_r($subcats);
	$subcategory = '';
	$jas = array();
	$i = '0';
		foreach ( $subcats as $subcat ){
			$parent = $subcat->parent;
			if ( $parent==$ewssub ) {
				$jas[$i] = $subcat->name;
				//$subcategory .= '<li>' . $subcat->name . '</li>';
				//$subcategory = '1';
				
			}
			$i++;
		}
		return $jas;
	}

function sub_categories( $subterm, $id ) {
	$subterms = $subterm;
	$ids = $id;
	$terms = get_terms( array(
    'taxonomy' => 'service_listings',
    'hide_empty' => false,
	) );
	$output = '';
	//$abc = sub_category($subterms, $ids);
	//$length = count($abc);
	$j = '0';
	foreach ( $terms as $term ){
	
		$parent = $term->parent;
				if ( $parent==$subterms ) {
					//for($i=0; $i<$length; $i++)
					//{
						//if ( $parent == $abc[$i] ) {
							//$output .= '<li class="include">' . $term->name . '</li>';
							$service_all[$j] = $term->name;
						//}
						//else {
						//	$output .= '<li class="notinclude">' . $term->name . '</li>';
						//}
					//}
				}
				$j++;
	}
	return $service_all;
	//return $output;
}

function ews_services( $qwer, $id) {
	$uio = $qwer;
	$kl = $id;
	$ews_selected = sub_category($uio, $kl);
	$ews_all = sub_categories( $uio, $kl);
	$output = '';
	foreach ($ews_all as $search_item)
	{
		if (in_array($search_item, $ews_selected))
		{
			$output .= '<li class="include">' . $search_item . '</li>';
			
		}
		else{
		$output .= '<li class="notinclude">' . $search_item . '</li>';
		}
	}
	return $output;
}