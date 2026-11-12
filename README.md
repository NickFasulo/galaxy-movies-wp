# galaxy-movies-wp

WordPress plugin wrapping [Galaxy Movies](https://www.galaxymovies.app)' `/embed/*` widgets in a `[galaxy]` shortcode + Gutenberg block. Built for the wordpress.org plugin directory (GPL-2.0+).

## Layout

- `galaxy-movies-embeds/` — the plugin (what gets zipped and uploaded)
  - `galaxy-movies-embeds.php` — header, shortcode, block registration
  - `readme.txt` — wordpress.org readme format
  - `license.txt` — GPLv2
  - `block/` — server-rendered block (no build step)
- `scripts/package.sh` — builds `dist/galaxy-movies-embeds.zip` for the wp.org upload

## Usage

```
[galaxy provider="netflix" theme="dark" kind="changes" height="380"]
```

- `provider` — one of ~20 US services (netflix, hulu, disney-plus, max, apple-tv, tubi, …); unknown keys render an HTML comment for visitors + a notice for editors
- `theme` — `dark` | `light`
- `kind` — `changes` | `churn` (churn ignores `provider`)
- `height` — px, clamped 200–900

## Submitting

1. `scripts/package.sh` → `dist/galaxy-movies-embeds.zip`
2. wordpress.org → Developers → Add Your Plugin → upload the zip → review (days)
3. On approval: `svn co` the plugin repo, commit `trunk/` + `assets/` (icon-256, banner-1544x500, screenshots — reuse `public/icons` + a backdrop render from the main repo, no new art pipeline)
4. Releases: bump `Stable tag` in `readme.txt` + `GME_VERSION` in the plugin file, tag in SVN
