<?php
/*
Plugin Name: Website Cool Sitemap
Plugin URI: http://wordpress.org/plugins/website-cool-sitemap/
Description: Another site-map plugin. But this one is the best: fully customizable, easy to use and free.
Version: 1.2
Author: Marco Dalprato
Author URI: http://www.marcodalprato.it
Text Domain: website-cool-sitemap
Domain Path: /languages
*/

/*  Copyright 2018 Marco Dalprato (email : marcodalprato@me.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

ob_start();  // clean every output php errors

// Stile 

add_action('wp_enqueue_scripts', 'prefix_add_my_stylesheet');
add_action('admin_enqueue_scripts', 'prefix_add_my_stylesheet');
add_action('login_enqueue_scripts', 'prefix_add_my_stylesheet');


function prefix_add_my_stylesheet() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'prefix-style', plugins_url('assets/wcs.css', __FILE__) );
    wp_enqueue_style('prefix-style', plugins_url('assets/wcs.css', __FILE__));
   
}


function website_cool_sitemap_register_options_page() {
  add_options_page('Website Cool Sitemap', 'Website Cool Sitemap', 'manage_options', 'website-cool-sitemap', 'website_cool_sitemap_options_page');
}

add_action('admin_menu', 'website_cool_sitemap_register_options_page');


function website_cool_sitemap_register_settings() {
  
   add_option( 'website_cool_sitemap_option_categories', 'Categories'); //def value
   add_option( 'website_cool_sitemap_option_pages', 'Pages'); //def value
   add_option( 'website_cool_sitemap_option_tags', 'Tags'); //def value
   add_option( 'website_cool_sitemap_hide_empty_categories', '0'); //def value
   add_option( 'website_cool_sitemap_enable_categories', '1'); //def value
   add_option( 'website_cool_sitemap_enable_pages', '1'); //def value
   add_option( 'website_cool_sitemap_enable_tags', '1'); //def value
   add_option( 'website_cool_sitemap_empty_post_text', 'No post available for this category'); //def value
   
   add_option( 'website_cool_sitemap_enable_debug', '0'); //def value
   

 
   register_setting( 'website_cool_sitemap_options_group', 'website_cool_sitemap_option_categories');

   register_setting( 'website_cool_sitemap_options_group', 'website_cool_sitemap_option_pages');
   register_setting( 'website_cool_sitemap_options_group', 'website_cool_sitemap_option_tags' );
   register_setting( 'website_cool_sitemap_options_group', 'website_cool_sitemap_hide_empty_categories' );
   register_setting( 'website_cool_sitemap_options_group', 'website_cool_sitemap_enable_categories' );
   register_setting( 'website_cool_sitemap_options_group', 'website_cool_sitemap_enable_pages' );
   register_setting( 'website_cool_sitemap_options_group', 'website_cool_sitemap_enable_tags' );
   register_setting( 'website_cool_sitemap_options_group', 'website_cool_sitemap_empty_post_text' );
  
   register_setting( 'website_cool_sitemap_options_group', 'website_cool_sitemap_enable_debug' );

}

add_action( 'admin_init', 'website_cool_sitemap_register_settings' );


 function website_cool_sitemap_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  
  
  <div class="wcs-admin-header">
        <h1>Website Cool Sitemap</h1>

        <a href="https://wordpress.org/plugins/website-cool-sitemap/#description" target="_blank">Description</a>

        <a href="https://wordpress.org/plugins/website-cool-sitemap/#reviews"  target="_blank">Reviews</a>

        <a href="https://wordpress.org/plugins/website-cool-sitemap/#installation" target="_blank">Installation</a>

        <a href="https://wordpress.org/support/plugin/website-cool-sitemap" target="_blank">Support</a>
    </div>
    
    

  
  <form method="post" action="options.php">
  <?php settings_fields( 'website_cool_sitemap_options_group' ); ?>
  
  <h3>Labels</h3>
  <p>You can edit the label customization of the shortcodes here.</p>
  
	<table class="wcs_table" >
		
		<tr>
			<td><label for="website_cool_sitemap_option_categories">Categories Title:</label></td>
			<td><input class="wcs_input"  width="48" height="48" type="text" id="website_cool_sitemap_option_categories" name="website_cool_sitemap_option_categories" value="<?php echo get_option('website_cool_sitemap_option_categories'); ?>" /></td>
		</tr>
		
		<tr>
			<td><label for="website_cool_sitemap_option_pages">Pages Title:</label></td>
			<td><input class="wcs_input" type="text" id="website_cool_sitemap_option_pages" name="website_cool_sitemap_option_pages" value="<?php echo get_option('website_cool_sitemap_option_pages'); ?>" /></td>
		</tr>
		
		<tr>
			<td><label for="website_cool_sitemap_option_tags">Tags Title:</label></td>
			<td><input class="wcs_input" type="text" id="website_cool_sitemap_option_tags" name="website_cool_sitemap_option_tags" value="<?php echo get_option('website_cool_sitemap_option_tags'); ?>" /></td>
		</tr>
		
		<tr>
			<td><label for="website_cool_sitemap_empty_post_text">Empty post for category text:</label></td>
			<td><input class="wcs_input" type="text" id="website_cool_sitemap_empty_post_text" name="website_cool_sitemap_empty_post_text" value="<?php echo get_option('website_cool_sitemap_empty_post_text'); ?>" /></td>
		</tr>
		
	</table>
	
	<hr>

	<h3>Options</h3>
	<p>Enable or disabled parts of the sitemap configuration in order to customize the user experience.</p>
  

	
	<table>
	
		<tr>
			<td><input type="checkbox" name="website_cool_sitemap_hide_empty_categories" value="1" <?php checked(1, get_option('website_cool_sitemap_hide_empty_categories'), true); ?> /></td>
			<td><label for="website_cool_sitemap_hide_empty_categories">Hide categories without posts</label></td>
		</tr>
		
		<tr>
			<td><input type="checkbox" name="website_cool_sitemap_enable_categories" value="1" <?php checked(1, get_option('website_cool_sitemap_enable_categories'), true); ?> /></td>
			<td><label for="website_cool_sitemap_enable_categories">Show categories section</label></td>
		</tr>
		
		<tr>
			<td><input type="checkbox" name="website_cool_sitemap_enable_pages" value="1" <?php checked(1, get_option('website_cool_sitemap_enable_pages'), true); ?> /></td>
			<td><label for="website_cool_sitemap_enable_pages">Show pages section</label></td>
		</tr>
		
		<tr>
			<td><input type="checkbox" name="website_cool_sitemap_enable_tags" value="1" <?php checked(1, get_option('website_cool_sitemap_enable_tags'), true); ?> /></td>
			<td><label for="website_cool_sitemap_enable_tags">Show tags section</label></td>
		</tr>
		
	</table>
	
	<hr>
	

		 
	<h3>Debug</h3>
	<p>Enable the debug in order to view statistics and informations.</p>
  
	 
	
	<table>
	
		<tr>
			<td><input type="checkbox" name="website_cool_sitemap_enable_debug" value="1" <?php checked(1, get_option('website_cool_sitemap_enable_debug'), true); ?> /></td>
			<td><label style="text-align: right;" for="website_cool_sitemap_enable_debug">Enable Debug</label></td>
		</tr>
		
	</table>
  
  
  <?php  submit_button(); ?>
  </form>
  
	
	<p>
	This plugin will allow you to post the sitemap of your website.<br>
	Using the shortcode <b>[coolsitemap]</b> on a page will prompt the pages and articles of your website.<br>
	You can customize the names for each section (Pages, Categories and Posts).<br>
	<br></p>
	
	<p>This plugin is developed by <a href="http://www.marcodalprato.it">Marco Dalprato</a>.</p>
	<p><a href="https://www.paypal.me/dalprato">Buy</a> me a coffee ;) It's help</p>
	

</div>
  
  
<?php } 


function coolsitemap(){


    $categories_title								= get_option('website_cool_sitemap_option_categories'); 
    $pages_title 									= get_option('website_cool_sitemap_option_pages'); 
	$tags_title										= get_option('website_cool_sitemap_option_tags'); 
	$hide_empty_categories 							= get_option('website_cool_sitemap_hide_empty_categories'); 	
	$debug 											= get_option('website_cool_sitemap_enable_debug'); 	
	$enable_categories 								= get_option('website_cool_sitemap_enable_categories');
	$enable_pages 									= get_option('website_cool_sitemap_enable_pages');
	$enable_tags 									= get_option('website_cool_sitemap_enable_tags');
	$website_cool_sitemap_empty_post_text 			= get_option('website_cool_sitemap_empty_post_text');
	
	
	
	$args = array(
                    "type"      => "post",      
                    "orderby"   => "name",
                    "order"     => "ASC" );
                    

   
   if($debug == "1"){
   
      echo "val categories_title = '" . $categories_title . "' <br>";
      echo "val pages_title = '" . $pages_title . "' <br>";
      echo "val tags_title = '" . $tags_title . "' <br>";
      echo "val hide_empty_categories = '" . $hide_empty_categories . "' <br>";
      echo "val enable_categories = '" . $enable_categories . "' <br>";
      echo "val enable_pages = '" . $enable_pages . "' <br>";
      echo "val enable_tags = '" . $enable_tags . "' <br>";
      echo "val website_cool_sitemap_empty_post_text = '" . $website_cool_sitemap_empty_post_text . "' <br>";    
       
   }
  
   ?>
                    
	<div class="wcs_coolsitemap">
		
		<?php if($enable_categories == "1" ) {?>
		
		<h1><?echo $categories_title;?></h1>
		
		<ul>
		
			<? foreach (get_categories($args) as $category) { 
				
				global $post;
				$args = array( 'offset'=> 1, 'category' => $category->term_id );
				
				$myposts = get_posts( $args ); 
				
				if(count($myposts) == 0 & $hide_empty_categories == "1"){
				
					continue;
				
				} // bypass this category if the are no posts and the user choose to hide it
				
				?>
			
				<h2><a class="wcs_category_title_link" href="<? echo get_category_link($category->term_id); ?>"> <? echo $category->name ;?></a></h2>
				
					<ul>
					
					<?php
					
					if(count($myposts) == 0 ){	?><p><?php echo $website_cool_sitemap_empty_post_text;?></p><?}
					
						foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
						
							<li>
								<a class="wcs_category_post_link" category_post_link href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>
						
						<?php endforeach; 
					
							wp_reset_postdata();?>
					
					</ul>

			 <? }?>
		</ul>
		
		<hr>
		
		 <? }?>
		 
		<?php if($enable_pages == "1" ) {?>
		
		<h1><?echo $pages_title;?></h1>
	
			
			<ul style="list-style-type:circle">
			<?foreach (get_pages() as $page) { ?>
			
				<h3><a class="wcs_post_title_link" href="<? echo get_page_link($page->ID);?>"><?echo $page->post_title;?><a></h3>
			
			<?}?>
			
			</ul>
	
		<hr>
		
		<?php } if($enable_tags == "1" ) {?>
		
		<h1><?echo $tags_title;?></h1>
	
			
			<ul style="list-style-type:circle">
			<? $tags = get_tags(array( 'hide_empty' => true)); 
			foreach ($tags as $tag) { ?>
				
				<h3><a class="wcs_tag_title_link" href="<? echo get_tag_link( $tag->term_id );?>"><?echo $tag->name;?><a></h3>
			
			<?}?>
			</ul>
	<?php } ?>

	
	</div>
		
<?php	} add_shortcode('coolsitemap', 'coolsitemap'); ?>