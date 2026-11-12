=== Galaxy Movies — Streaming Arrivals & Departures ===
Contributors: galaxymovies
Tags: streaming, netflix, movies, tv, embed
Requires at least: 6.0
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Embed daily-updated "new on" and "leaving" lists for 20 US streaming services, plus a monthly churn stat card — via shortcode or block.

== Description ==

Galaxy Movies tracks daily catalog changes across US streaming services. This plugin embeds its free widgets on your posts and pages so readers always see what's arriving and leaving — no account, no API key, no manual updates.

**Two widgets:**

* **New & leaving** — daily list of arrivals, announced releases, and departures for one streaming service (Netflix, Hulu, Max, Disney+, Prime Video, Apple TV, Tubi, Peacock, Paramount+, Starz, AMC+, MGM+, Crunchyroll, Discovery+, Plex, Kanopy, Shudder, Pluto TV, The Roku Channel, Criterion Channel).
* **Monthly churn card** — arrivals vs departures summary stat, updated monthly.

**Usage:**

Shortcode:

    [galaxy provider="netflix" theme="dark" kind="changes" height="380"]

Or insert the "Galaxy Movies" block and pick service, theme, and height in the sidebar.

**Attributes:**

* `provider` — service key (see list above). Ignored when `kind="churn"`.
* `theme` — `dark` (default) or `light`, to match your site's palette.
* `kind` — `changes` (default) or `churn`.
* `height` — pixels, clamped 200–900 (default 380).

Widgets carry a small "Powered by Galaxy Movies" link — that's the deal for the free data.

== External services ==

This plugin embeds iframes served from galaxymovies.app (https://www.galaxymovies.app). When a visitor views a page containing a widget, their browser loads the iframe content directly from galaxymovies.app — a standard HTTP request carrying no user data. Nothing is stored server-side, no API keys or accounts are required, and no plugin data leaves your site.

== Installation ==

1. Upload the plugin (Plugins → Add New → Upload, or unzip into `wp-content/plugins/`).
2. Activate it.
3. Add the shortcode or block to any post or page.

== Frequently Asked Questions ==

= Does it need an API key or account? =
No. The widgets read Galaxy Movies' public feeds.

= How current is the data? =
Provider lists update daily; the churn card updates monthly.

= Does it work with page builders / classic editor? =
Anywhere shortcodes render. The block is for the block editor.

= Which countries does it cover? =
The widgets list US catalog changes only.

== Screenshots ==

1. The "new & leaving" widget on a post — dark theme.
2. The same widget — light theme.
3. The monthly churn card.
4. Block sidebar settings (service, theme, height).

== Changelog ==

= 1.0.0 =
* Initial release: `[galaxy]` shortcode and server-rendered block.
