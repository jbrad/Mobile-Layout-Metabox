<?php

/* Define the custom box */

add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );

// backwards compatible (before WP 3.0)
// add_action( 'admin_init', 'myplugin_add_custom_box', 1 );

/* Adds a box to the main column on the Post and Page edit screens */
function myplugin_add_custom_box() {
    add_meta_box( 
        'myplugin_sectionid',
        __( 'Preview Mobile Layout', 'myplugin_textdomain' ),
        'myplugin_inner_custom_box',
        'post' 
    );
    add_meta_box(
        'myplugin_sectionid',
        __( 'Preview Mobile Layout', 'myplugin_textdomain' ), 
        'myplugin_inner_custom_box',
        'page'
    );
}

/* Prints the box content */
function myplugin_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
  
  ?>
  
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js">
  </script>
  
  <script type="text/javascript">
      var windowSizeArray1 = [ "width=320,height=460",
                               "width=320,height=460,scrollbars=yes" 
                             ];
 
          $(document).ready(function(){
          $('.iPhonePortrait').click(function (event){
 
          var url = $(this).attr("href");
          var windowName = "popUp";//$(this).attr("name");
          var windowSize = windowSizeArray1[$(this).attr("rel")];
 
          window.open(url, windowName, windowSize);
 
          event.preventDefault();
 
          });
       });
  </script>
  
  <script type="text/javascript">
      var windowSizeArray2 = [ "width=460,height=320",
                               "width=460,height=320,scrollbars=yes" 
                             ];
 
          $(document).ready(function(){
          $('.iPhoneLandscape').click(function (event){
 
          var url = $(this).attr("href");
          var windowName = "popUp";//$(this).attr("name");
          var windowSize = windowSizeArray2[$(this).attr("rel")];
 
          window.open(url, windowName, windowSize);
 
          event.preventDefault();
 
          });
       });
  </script>
  
  <script type="text/javascript">
      var windowSizeArray3 = [ "width=768,height=1024",
                               "width=768,height=1024,scrollbars=yes" 
                             ];
 
          $(document).ready(function(){
          $('.iPadPortrait').click(function (event){
 
          var url = $(this).attr("href");
          var windowName = "popUp";//$(this).attr("name");
          var windowSize = windowSizeArray3[$(this).attr("rel")];
 
          window.open(url, windowName, windowSize);
 
          event.preventDefault();
 
          });
       });
  </script>
  
  <script type="text/javascript">
      var windowSizeArray4 = [ "width=1024,height=768",
                               "width=1024,height=768,scrollbars=yes" 
                             ];
 
          $(document).ready(function(){
          $('.iPadLandscape').click(function (event){
 
          var url = $(this).attr("href");
          var windowName = "popUp";//$(this).attr("name");
          var windowSize = windowSizeArray4[$(this).attr("rel")];
 
          window.open(url, windowName, windowSize);
 
          event.preventDefault();
 
          });
      });
  </script>
  
  <?php
    if ( 'publish' == $post->post_status ) {
  	$preview_link = esc_url( get_permalink( $post->ID ) );
	} else {
		$preview_link = get_permalink( $post->ID );
		if ( is_ssl() )
			$preview_link = str_replace( 'http://', 'https://', $preview_link );
		$preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ) ) );
	}
  ?>
	
  <ul>
      <li>
	      <a href="<?php echo $preview_link; ?>" rel="1" class="iPhonePortrait" >iPhone Portrait</a> (320 X 460)
	  </li>
	  <li>
	      <a href="<?php echo $preview_link; ?>" rel="1" class="iPhoneLandscape" >iPhone Landscape</a> (460 X 320)
	  </li>
	  <li>
		  <a href="<?php echo $preview_link; ?>" rel="1" class="iPadPortrait" >iPad Portrait</a> (768 X 1024)
	  </li>
	  <li>
		  <a href="<?php echo $preview_link; ?>" rel="1" class="iPadLandscape" >iPad Landscape</a> (1024 X 768)
	  </li>
  </ul>
	
  <?php 
  }

?>