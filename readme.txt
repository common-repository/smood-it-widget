=== Plugin Name ===
Contributors: potomak
Donate link: http://github.com/smoodit/api
Tags: mood, smood, smile, emoticon, social, network, share, emotion
Requires at least: 2.0.2
Tested up to: 2.9
Stable tag: 0.2

Do you want to know how people feel about your posts? This plugin adds a Smood it widget at the end of every blog post.

== Description ==

Do you want to know how people feel about your posts? This plugin adds a [Smood it widget](http://smood.it/widget) at the end of every blog post.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `smoodit.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

Smood it widget plugin by default adds a little widget at the bottom of every post and page, you can add more widgets using the `smoodit_widget($permalink)` helper.

Example:

`<?php smoodit_widget("http://myblog.com/brand-new-post") ?>`

== Changelog ==

= 0.2 =
* Smood it widget helper

= 0.1 =
* Smood it widget content hook

== Upgrade Notice ==

= 0.2 =
You can include a Smood it widget almost everywhere by calling the `smoodit_widget($permalink)` helper

= 0.1 =
Initial release