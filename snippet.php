<?php
/*** 
 * Staff profiles snippet
 * @author Jeremy Heminger j.heminger13@gmail.com
 * @version 1.0.0
 * @binding Wordpress 4.x 
 * 
 * Add this to functions.php to display multiple plrofiles
 * @param array $args
 *    - accordion boolean (default false)
 *    - title string if accordion true, title of section
 *    - cat int the POST category ID
 *    - size string a class to set the width of the cell based on grid
 */
add_shortcode('jah_staff_profiles','jah_staff_profiles');
function jah_staff_profiles($args) {

  $accordion = isset($args['accordion']) ? $args['accordion'] : false;
  if(false !== $accordion) {
    $title = isset($args['title']) ? $args['title'] : false;
    if(false === $title)return "'title' is a required field" ;
  }

  $cat = isset($args['cat']) ? $args['cat'] : false;
  if(false === $cat)return "'cat' is a required field";

  $size = isset($args['size']) ? 'col-md-'.$args['size'] : '';

  
  $posts = get_posts(array(
    'category'=>$cat
    ) 
  );

  $return = '';

  if(false !== $accordion) $return = '<h3 class="showhidden">'.$title.'</h3><div class="ahidden">';
  
  foreach ($posts as $key => $value) {
      $th_id = get_post_thumbnail_id($value->ID); 
      $return .= '<div class="fltleft staff_profile '.$size.'">';
        if(false !== $th_id) {
            $img = wp_get_attachment_image_src( $th_id, 'full' );
            $return .= '<img src="'.$img[0].'" />';
        }
        $return .= '<h3>'.$value->post_title.'</h3>';
        $return .= $value->post_content;
      $return .='</div>';
  }
  
  if(false !== $accordion) $return .= '</div>';
  
  $return .= '<div class="clear"></div>';
  
  return $return;
}
