=== Homepuzz Button For Wordpress ===
Contributors: Homepuzz, Souany
Tags:social,sharing,css,simple,homepuzz,bookmark,share
Requires at least: 2.7
Tested up to: 2.9.1
Stable tag: 1.0.0

== Description ==

Homepuzz Button will add a Homepuzz Bookmark button to your Wordpress posts/pages. The button can be inserted manually or before or after the content automatically. There is an option for this.

Features:

1. One Click and you get the Homepuzz Button
2. Option to insert the button automatically before or after the post
3. Option to insert the button manually anywhere within the Wordpress Loop

[Demo](http://www.homepuzz.com/blog) |

== Installation ==

This plugin is easy to install like other plug-ins of Wordpress as you need to just follow the below mentioned steps:

1. Copy Folder 'homepuzz-button' from the downloaded and extracted file.

2. Paste it in 'wp-Content/plugins' folder on your Wordpress Installation 

3. Activate the plugin from Dashboard / Plugins window.

4. Now Plugin is Activated, Go to the Settings - Homepuzz section to check the options. Please refer Usage section for more details

== Usage ==

1. If you have selected 'Manual Insertion' from the Homepuzz settings page, then insert the below code in the Wordpress Loop whereever you want
if ( function_exists( 'add_homepuzz_button' ) ) {
     add_homepuzz_button();}


2. If you have selected 'Before Content' as the location of the button, which is default, then the Homepuzz button will be automatically inserted on all the posts and pages after the title and before the content.


3. If you have selected 'After Content' as the location of the button, which is default, then the Homepuzz button will be automatically inserted on all the posts and pages after the content.

4. The anchor tag has the class attribute as 'homepuzz', you can customize it with any CSS styles thru your theme template style sheet.
 
== Screenshots ==

1. Demo of this plugin is available on http://www.homepuzz.com/blog
