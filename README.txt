=== Breadcrumbs ===
Contributors: hadal3000
Tags: breadcrumb, topic path, bread crumb, navigation
Requires at least: 1.0.1
Tested up to: 5.2
Stable tag: 5.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Admin panel to configure and display breadcrumbs navigation.

== Description ==

This plugin gives you the ability to easily customize the breadcrumbs navigation, their display, colors, additional text and separator. Using the shortcode, you can easily add breadcrumbs to any page, either through the editor or directly into the code.
In the shortcode field, just click and the code will be copied. It is automatically generated when you select the items - "position" and "current page", which makes it even more flexible for display on different pages.
Using these options, you can select:
* Location of breadcrumbs
* Show on home page
* Display the Home link
* Show title to current page
You can use your own delimiter character, or leave it by default. It is also possible to select the color of breadcrumbs navigation links, separator and current page.
You can also easily change the link text of the main page, and additional text to the pages: search, tags, author’s page, 404, comments page and pagination pages.

= Examples =
**Default**<br />
Template Tag<br />
`
<?php echo do_shortcode('[breadcrumbs position="left" show_home_link=1 show_current=1]'); ?>
`
Output sample<br />
`
<ul class="bc bc-list-item bc-display-flex bc-flex-justify-content-left bc-bg-sep">
    <li class="bc-item">
        <a href="https://project.loc/" class="bc-home">
            <span>Home</span>
        </a>
    </li>
    <span class="bc-sep"></span>
     <li class="bc-item">
        <a href="https://project.loc/flexible/">
            <span>Blog</span>
        </a>
     </li>
     <span class="bc-sep"></span>
     <li class="bc-current">
        <span class="bc-no-active">Post</span>
     </li>
 </ul>
`

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to settings and configure the plugin
4. Copy the shortcode and put it into your templates using the code `<?php echo do_shortcode('[breadcrumbs position="left" show_home_link=1 show_current=1]'); ?>` or paste it into the editor of your post or page

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.0 =
* Opening to the public.

