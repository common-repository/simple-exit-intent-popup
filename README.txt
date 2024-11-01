=== Simple Exit Intent Popup ===
Contributors: @oxwalor 
Donate link: https://www.htag.com.au/account
Tags: exit intent popup, timed delay popup
Requires at least: 5.0.1
Tested up to: 5.7.2
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Lighwheight exit intent / time delay popup that entices guest users to take an action on your site i.e. sign up.

== Description ==

Free plugin that shows a customisable CTA popup on Exit Intent i.e. when a guest user is about to abandon your site.

FEATURE SUMMARY:

- Free now and forever - no hidden costs, no trials, no third party signups, no limits on features
- Exit Intent mode to show popup when user navigates close to window edge
- Time Delay mode to show popup after a configurable time dalay
- Configurable time delay setting (seconds)
- Configurable cookie setting (days) to optionally show the popup only once a day or once in a few days
- Customisable popup wording with multilingual support
- Option to show the popup only once per session
- Customisable colour scheme
- Uses your theme's font styling so the look and feel is consistent with the rest of your site
- Lightweight code has no impact on page load times

== Installation ==

1. Install from Wordpress 
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to plugin sesttings to configure popup parameters and wording

== Frequently Asked Questions ==

= Is the popup shown to logged in users?  =

No, the popup is only shown to guest users.

= Does exit intent detection work on mobile devices? =

No, exit intent mode will only work on desktop browsers. If majority of your site traffic is from mobile devices, use timed delay mode.

= Will the plugin slow down my site? =

No, the plugin loads its' resources in an an optimal way that does not impact page load times.

== Screenshots ==

1. `/assets/screenshot-1.png` Popup variant 1
2. `/assets/screenshot-2.png` Popup variant 2
3. `/assets/screenshot-3.png` Plugin Settings Page

== Changelog ==

= 1.0.0 =
* Initial Release

= 1.0.2 =
* Readme update

= 1.0.2 =
* Tested with Wordpress 5.2

= 1.0.3 =
* Latest Wordpress Version Bump

== Upgrade Notice ==

= 1.0.0 =
* Initial Release

= 1.0.2 =
* Readme update

= 1.0.2 =
* Compatibility with Wordpress 5.2

= 1.0.3 =
* Latest Wordpress Version Bump

== Plugin Options ==

* Time Delay Popup - If checked, the popup will show after the delay option time. If uncheked, popup will show when a visitor moves their cursor above the document window, showing exit intent. Leave this unchecked for Exit Intent behavior.
* Delay (in seconds) - The time, in seconds, until the popup activates and begins watching for exit intent. If mode is set to Time Delay Popup, this will be the time until the popup shows.
* Show once per session - If checked, the popup will only show once per browser session. If false and Cookie Expiry is set to 0, the popup will show multiple times in a single browser session.
* Cookie Expiry (in days) - The number of days to set the cookie for. A cookie is used to track if the popup has already been shown to a specific visitor. If the popup has been shown, it will not show again until the cookie expires. A value of 0 will always show the popup.