# OSHC 2026 — WordPress site

A custom WordPress theme that replicates the **8th Omani Society of Hematology
Conference (OSHC 2026)** one-page website (Muscat, Oman · Oct 8–10, 2026) and
makes every section editable by non-developers.

- **Theme:** `wp-content/themes/oshc-2026/`
- **Staging:** https://dev.omanishc.com
- **Requires on the server:** PHP 8.0+, WordPress 6.4+, and the **free**
  [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/)
  plugin. No Node, Docker, page builder, or paid plugin needed.

## How content is edited (for non-developers)

Everything is managed from the normal WordPress admin:

| What | Where in wp-admin |
|------|-------------------|
| All section text (hero, stats, welcome, CME, register, venue, contact, etc.) | **Pages → Home** (fields grouped in tabs) |
| Logo | **Appearance → Customize → Site Identity → Logo** (falls back to the bundled logo) |
| Organizing & Scientific committee | **Committee** (set each one's *Committee Type*) |
| Speakers | **Faculty** |
| Important dates | **Important Dates** |
| Registration fees | **Pricing Tiers** |
| Photo gallery | **Gallery** (set each photo as the *Featured Image*) |
| FAQ | **FAQs** (group with *FAQ Groups*) |

Add / edit / delete items, and drag to reorder (the *Order* attribute). Bios on
committee/faculty cards open in a pop-up.

## Deployment (automatic)

Pushing to `main` triggers `.github/workflows/deploy.yml`, which uploads the
theme to the server over **FTPS** using the repo secrets `FTP_SERVER`,
`FTP_USERNAME`, `FTP_PASSWORD`. Only changed files are synced after the first run.

### First-time WordPress install on dev (one-time)

The dev subdomain starts empty (no WP core/database). To stand it up:

1. **cPanel → MySQL Databases:** create a database + user, add the user to the
   DB with **All Privileges**. Note the DB name, user, password, and host
   (HostGator host is usually `localhost`).
2. **Repo → Settings → Secrets → Actions:** add `DB_NAME`, `DB_USER`,
   `DB_PASSWORD`, `DB_HOST` (alongside the existing `FTP_*` secrets).
3. **Actions → "Install WordPress core on dev" → Run workflow.** This uploads
   WordPress core + a generated `wp-config.php` + `.htaccess` to the dev root.
4. Visit **https://dev.omanishc.com/wp-admin/install.php** and complete the
   one-screen install (site title + admin user). This creates the tables.

### Then activate the theme

5. In wp-admin: install & activate **Advanced Custom Fields** (free).
6. **Appearance → Themes → activate "OSHC 2026."**
   On the next admin page load the theme **auto-creates the Home page, sets it
   as the front page, and fills in the committee, dates, pricing, and FAQ
   content** — so the site is live and populated immediately. Everything it
   creates is ordinary editable content.

### Important: parent `.htaccess` redirect

`public_html/.htaccess` (the primary domain) redirects everything to
`/conference`. Because cPanel subdomains live *inside* `public_html`, that rule
cascades onto `dev.omanishc.com` and causes a redirect loop. Scope it to the
main domain only by adding a host condition before the redirect:

```apache
RewriteCond %{HTTP_HOST} ^(www\.)?omanishc\.com$ [NC]
RewriteCond %{REQUEST_URI} !^/conference(/|$)
RewriteRule ^.*$ /conference [L,R=301]
```

## Local development (optional, this machine only)

A throwaway PHP + SQLite sandbox (no MySQL/Docker) lives at `/tmp/oshc-wp` and
serves the symlinked theme. It is **not** part of what ships to the server.

```
php -S 127.0.0.1:8899 …            # served via wp-cli `server`
tools/seed.php                      # wp eval-file tools/seed.php  (manual seed)
```

`tools/` is a dev helper and is excluded from deployment.
