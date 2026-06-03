---
name: wordpress-site
description: Replicate a website (e.g. a Webflow/landing/event site) into a custom WordPress theme that non-developers can fully edit, with a local PHP+SQLite dev sandbox and FTP/GitHub-Actions deploy to shared/cPanel hosting (HostGator). Use when the user wants to "build/replicate/clone a site in WordPress", make a site "editable by non-devs/editors", build a custom WP theme with ACF + custom post types, set up local WP without Docker, or deploy a theme over FTP/SFTP via CI.
user-invocable: true
---

# WordPress site builder (replicate → editable theme → deploy)

A playbook for turning a reference website into a maintainable, **editor-friendly
custom WordPress theme**, developing it locally **without Docker**, and shipping
it to **PHP-only shared hosting over FTP**. Distilled from a real build (OSHC 2026,
a conference one-pager replicated from Webflow). Reference implementation:
the `wp-test` repo / `oshc-2026` theme.

## 0. Gather requirements first (these change the build)

Ask before coding — each genuinely forks the work:
1. **Where does WP run / deploy?** Local-only, existing local app, or live/staging hosting (cPanel/HostGator, Kinsta, WP Engine…).
2. **Editing approach:** custom theme + ACF (structured, locked-down — *default for "non-devs edit but can't break layout"*), Elementor (free-form, breakable), or native Gutenberg blocks.
3. **Scope:** one site, or a reusable template for future sites.
4. **ACF license:** Pro (repeaters, options pages, gallery field) vs **free** (no repeaters/options page → use **Custom Post Types** for every repeatable item + put global text on the front page).
5. **Deploy transport:** FTP/FTPS/SFTP, the target path, and whether CI deploys on push.

## 1. Extract the design

Use the Firecrawl MCP (`firecrawl_scrape`) with `formats: ["markdown","branding"]`
to pull copy + brand tokens (colors, fonts, button radii), and a
`["screenshot"]` `fullPage` pass for layout. Map repeatable content → CPTs:
speakers/people, dates, pricing, gallery, FAQ, sponsors. Rebuild **clean** CSS
from the brand tokens — do **not** copy the source platform's generated CSS.

## 2. Architecture (free-ACF friendly)

- **Custom theme**, classic PHP templates. `front-page.php` assembles
  `template-parts/sections/*.php`. Each section reads ACF with a **fallback to the
  real copy** so it never looks empty.
- **Repeatable content = CPTs** (registered in `inc/cpt.php`), each with
  `page-attributes` for drag-reorder; taxonomies for grouping (e.g. committee
  type, FAQ group). With free ACF you cannot use repeaters/options pages, so CPTs
  carry every list-with-images/ordering, and **global section text lives as ACF
  fields on the static Home page** (`page_type == front_page`).
- **Register ACF field groups in code** (`acf_add_local_field_group` in
  `inc/acf-fields.php`) so fields ship with the theme — no manual setup on the
  server. Only free field types: text, textarea, wysiwyg, image, url, email,
  date_picker, tab, message. For small bullet lists use a **textarea, one item
  per line**, split in templates.
- **Self-seed on activation** (`inc/setup-content.php`, hooked to `admin_init`,
  guarded by an option flag, only when `get_field` exists): create the Home page,
  set it as the static front page, and create the CPT content. This makes an
  **FTP-only host turnkey** — activating the theme populates the site (no wp-cli
  needed on the server). Keep one canonical data set; a `tools/seed.php` can
  delegate to the same function for CLI.
- Helpers (`inc/helpers.php`): `oshc_field($name,$default,$id)`,
  `oshc_lines($textarea)`, a CPT query helper. Bundle brand assets (logo, hero
  bg, partner strip) in `assets/img/` and use them as defaults, overridable via
  Customizer logo / ACF image fields.

## 3. Local dev sandbox — PHP + SQLite, NO Docker

When Docker is unavailable/unwanted and the host is "PHP only", run WordPress on
SQLite with PHP's built-in server. This mirrors a PHP-only host closely.

```bash
# wp-cli (raise memory or core unzip OOMs)
curl -sL https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /tmp/wp-cli.phar
WP="php -d memory_limit=1024M /tmp/wp-cli.phar"        # NOTE: zsh does NOT word-split $WP — call `php -d ... /tmp/wp-cli.phar` directly each time
php -d memory_limit=1024M /tmp/wp-cli.phar core download --path=/tmp/site --force

# SQLite drop-in (no MySQL)
cd /tmp/site/wp-content/plugins
curl -sL https://downloads.wordpress.org/plugin/sqlite-database-integration.latest-stable.zip -o s.zip && unzip -qo s.zip && rm s.zip
cp sqlite-database-integration/db.copy ../db.php
sed -i '' "s#{SQLITE_IMPLEMENTATION_FOLDER_PATH}#/tmp/site/wp-content/plugins/sqlite-database-integration#g" ../db.php
sed -i '' "s#{SQLITE_PLUGIN}#sqlite-database-integration/load.php#g" ../db.php

php -d memory_limit=1024M /tmp/wp-cli.phar config create --dbname=wp --dbuser=root --dbpass=root --skip-check --force --path=/tmp/site
php -d memory_limit=1024M /tmp/wp-cli.phar core install --url=http://127.0.0.1:8899 --title=Dev --admin_user=admin --admin_password=admin --admin_email=a@b.c --skip-email --path=/tmp/site
php -d memory_limit=1024M /tmp/wp-cli.phar plugin install advanced-custom-fields --activate --path=/tmp/site
ln -sfn /path/to/repo/wp-content/themes/THEME /tmp/site/wp-content/themes/THEME   # symlink the theme from the repo
php -d memory_limit=1024M /tmp/wp-cli.phar theme activate THEME --path=/tmp/site
php -d memory_limit=512M  /tmp/wp-cli.phar server --host=127.0.0.1 --port=8899 --path=/tmp/site   # run in background
```

Gotchas:
- **`wp core install --url=...:PORT` can store siteurl with a stray subpath.** If
  CSS/JS 404 with a weird path, fix: `wp option update siteurl http://127.0.0.1:8899` (and `home`).
- Lint every PHP file: `find . -name '*.php' -print0 | xargs -0 -n1 php -l`.
- Verify visually with the Playwright MCP (`browser_navigate` + `browser_take_screenshot fullPage`) and grep the rendered HTML for expected counts (cards, rows, FAQ items).

## 4. Deploy — GitHub Actions over FTP

- Mirror the WP layout in the repo (`wp-content/themes/THEME/`). Deploy with
  `SamKirkland/FTP-Deploy-Action@v4.3.5`, `local-dir: ./wp-content/themes/THEME/`,
  `server-dir:` the themes path **relative to the FTP root** (confirm whether the
  FTP user is chrooted to the site root or the account home).
- **Prefer plain `protocol: ftp` + `port: 21` on cPanel/HostGator.** FTPS often
  fails the passive data channel from CI (`Can't open data connection in passive
  mode: ECONNREFUSED`) due to TLS session-reuse / firewalled passive ports.
  Plain FTP avoids it. (SFTP is also robust if SSH is enabled.)
- First run uploads all; later runs sync via a server-side state file. Use a
  distinct `state-name:` per workflow if you have more than one (theme vs core)
  writing to overlapping trees. `dangerous-clean-slate: false` so WP core/config
  is never deleted.
- Secrets: `FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`. If pushing to an org
  repo fails with 403, the active `gh` account may lack write — `gh auth switch`
  to an account that has it, then `git -c credential.helper='!gh auth git-credential' push`.

## 5. Standing up WordPress on a fresh PHP-only host (no Docker/wp-cli on server)

FTP can't create a MySQL database — that step always needs cPanel (or the host's
1-click installer / Softaculous, which does everything). To automate the rest:
1. User creates DB + user (All Privileges) in cPanel; adds `DB_NAME/DB_USER/DB_PASSWORD/DB_HOST` (host usually `localhost`).
2. A manual (`workflow_dispatch`) workflow downloads WP core on the runner,
   generates `wp-config.php` from those values (fresh salts from
   `api.wordpress.org/secret-key/1.1/salt/`, pin `WP_HOME`/`WP_SITEURL`), writes a
   standard `.htaccess`, and FTPs core to the site root.
3. User finishes at `/wp-admin/install.php` (creates tables), installs ACF,
   activates the theme (which self-seeds).

## 6. cPanel / HostGator gotchas

- **"Error establishing a database connection" after a fresh install is almost
  always a missing DB grant, not a bad password.** In cPanel a MySQL *user* and
  *database* are separate; creating both is not enough — you must **"Add User To
  Database" with ALL PRIVILEGES**. Symptom: MySQL **error 1044** "Access denied
  for user '…'@'localhost' **to database** '…'" (auth succeeds, DB open fails).
  Contrast **1045** = wrong user/password, **1049** = unknown database,
  **2002** = wrong host/can't connect.
- **Diagnose DB errors with a self-deleting probe** (the CI runner can't reach the
  server's `localhost` MySQL, so test on the server over HTTP). Upload a one-file
  PHP script to the web root that token-parses the live `wp-config.php` for the
  `DB_*` constants, attempts `mysqli_connect($h,$u,$p,$d)`, prints
  `mysqli_connect_errno()`/`error()` (and the password *length*, never the value),
  then `@unlink(__FILE__)` so it removes itself after one request. Use a random
  filename and a separate FTP `state-name`.
- **Switching PHP versions in cPanel resets the enabled extension set.** After
  changing a domain's PHP version (e.g. 7.4 → 8.3 via MultiPHP Manager), WordPress
  may report *"missing the MySQL extension … mysqli."* Fix in cPanel → **Select PHP
  Version → Extensions**: enable `mysqli`, `mysqlnd`, `pdo_mysql` for the new
  version (on a dedicated server: WHM → EasyApache 4 → `ea-php83-php-mysqlnd` →
  Provision). Note `AddHandler application/x-httpd-ea-phpNN .php` lines in
  `.htaccess` pin a domain's PHP version and cascade to subdomains.
- **`wp-config.php` reflects exactly what the secret holds.** A value like
  `define('DB_PASSWORD','#')` means the secret literally is `#` — the generator
  isn't truncating. (Note users may redact secrets when pasting to you.)
- **Parent `.htaccess` cascades to subdomains.** A redirect in
  `public_html/.htaccess` applies to `public_html/sub.domain.com/` too (subdomain
  docroots sit *inside* `public_html`), causing redirect loops on subdomains.
  Scope host-specific redirects: `RewriteCond %{HTTP_HOST} ^(www\.)?maindomain\.com$ [NC]`
  before the `RewriteRule`. A redirect-to-self loop = the rule isn't excluding its
  own target / is hitting the wrong host.
- Diagnose loops with `curl -sIL -w "%{num_redirects}"`. Give each subdomain its
  own standard WordPress `.htaccess`.
- A file deployed to FTP root won't be HTTP-reachable while a catch-all redirect
  is active — fix the redirect before trying to verify.

## Deliverables checklist

- [ ] Custom theme: `style.css`, `functions.php`, `header/footer`, `front-page.php`, `index.php`, `inc/{cpt,acf-fields,helpers,setup-content}.php`, `template-parts/sections/*`, `assets/{css,js,img}`, `screenshot.png`.
- [ ] CPTs + taxonomies for every repeatable item; ACF groups in code; auto-seed.
- [ ] Local PHP+SQLite sandbox verified (screenshot matches source).
- [ ] FTP deploy workflow (+ optional core-install workflow) and a README handoff
      documenting the editor menus, server requirements (PHP + free ACF), and the
      activate-to-seed flow.
