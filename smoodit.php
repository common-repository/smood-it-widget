<?php
/**
  * @package Smood_it
  * @author Giovanni Cappellotto
  * @version 0.2
  */
/*
Plugin Name: Smood it
Plugin URI: http://smood.it/
Description: Do you want to know how people feel about your posts? This plugin adds a <a href="http://smood.it/widget">Smood it widget</a> at the end of every blog post.
Author: Giovanni Cappellotto
Version: 0.2
Author URI: http://www.focustheweb.com
*/

function smoodit_widget($permalink)
{
  return <<<EOSTR
<div id="smoodit-widget">
  <iframe frameborder="0" allowTransparency="true" width="185" height="30" src="http://smood.it/widget/sw?url=$permalink" style="border:none; overflow:hidden; width:185px; height:30px;"></iframe>
</div>
EOSTR;
}

function smoodit_widget_display($content)
{
  // this is where we'll display the smoodit widget

  $options['page'] = get_option('smoodit_widget_on_pages');
  $options['post'] = get_option('smoodit_widget_on_posts');

  if ( (is_single() && $options['post'] != 'false') || (is_page() && $options['page'] != 'false') )
  {
    $permalink = get_permalink();
    
    $widget_box = smoodit_widget($permalink);

    return $content . $widget_box;
  } else {
    return $content;
  }
}

function smoodit_widget_style()
{
  // this is where we'll style our box
  echo <<<EOSTR
<style type="text/css">
#smoodit-widget {}
</style>
EOSTR;
}

function smoodit_widget_settings()
{
  // this is where we'll display our admin options
  $options_page = get_option('smoodit_widget_on_pages');
  $options_post = get_option('smoodit_widget_on_posts');
  
  if ($options_page != 'checked' && $options_page != 'false' && $options_post != 'checked' && $options_post != 'false')
  {
    $default_str = '<p>Smood it Widget is on by default. If you want to turn it off just click on <em>Save changes</em></p>';
  }
  
  if ($_POST['action'] == 'update')
  {
    $_POST['show_pages'] == 'on' ? update_option('smoodit_widget_on_pages', 'checked') : update_option('smoodit_widget_on_pages', 'false');
    $_POST['show_posts'] == 'on' ? update_option('smoodit_widget_on_posts', 'checked') : update_option('smoodit_widget_on_posts', 'false');
    $message = '<div id="message" class="updated fade"><p><strong>Options Saved</strong></p></div>';
  }

  $options_page = get_option('smoodit_widget_on_pages');
  $options_post = get_option('smoodit_widget_on_posts');

  echo <<<EOSTR
<div class="wrap">
  $message
  <div id="icon-options-general" class="icon32"><br /></div>
  <h2>Smood it Widget Settings</h2>
  
  <form method="post" action="">
    <input type="hidden" name="action" value="update" />

    <h3>When to Display Smood it Widget</h3>
    $default_str
    <input name="show_pages" type="checkbox" id="show_pages" $options_page /> Pages<br />
    <input name="show_posts" type="checkbox" id="show_posts" $options_post /> Posts<br />
    <br />
    <input type="submit" class="button-primary" value="Save Changes" />
  </form>
</div>
EOSTR;
}

function smoodit_widget_admin_menu()
{
  // this is where we add our plugin to the admin menu
  add_options_page('Smood it widget', 'Smood it widget', 9, basename(__FILE__), 'smoodit_widget_settings');
}

add_action('the_content', 'smoodit_widget_display');
add_action('admin_menu', 'smoodit_widget_admin_menu');
add_action('wp_head', 'smoodit_widget_style');

?>
