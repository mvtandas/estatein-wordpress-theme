# Estatein — Custom Real-Estate WordPress Theme

A pixel-perfect, fully responsive custom WordPress theme built from the
[Estatein Real Estate UI template (Figma)](https://www.figma.com/community/file/1314076616839640516).

> Development notes, architecture and how each brief requirement is met:
> see **[DOCUMENTATION.md](DOCUMENTATION.md)**.

## What's in this repo

```
growmodo_case/
├── estatein/        ← the custom theme (this is the deliverable)
├── wp/              ← a ready-to-run WordPress install (SQLite) for the demo
├── DOCUMENTATION.md ← 1–2 page development write-up
└── README.md
```

## Requirements

- PHP **7.4+** (8.x recommended)
- WordPress **6.0+**
- Plugins: **Advanced Custom Fields**, **Contact Form 7** (both free)

---

## Option A — Run the bundled demo (fastest)

The `wp/` folder is a self-contained WordPress install using the **SQLite** drop-in, so no
MySQL is required.

```bash
# from the project root
php -S 127.0.0.1:8089 -t wp/
# then open http://127.0.0.1:8089/
```

(or, if you have WP-CLI: `wp server --host=127.0.0.1 --port=8089` from inside `wp/`.)

The theme is symlinked into `wp/wp-content/themes/estatein` and already activated, with ACF,
Contact Form 7 and demo content (properties, services, team, testimonials, FAQs) seeded.

**Admin:** `http://127.0.0.1:8089/wp-admin/`

---

## Option B — Install the theme on your own WordPress

1. Copy the **`estatein/`** folder into `wp-content/themes/`.
2. Install & activate **Advanced Custom Fields** and **Contact Form 7**.
3. **Appearance → Themes →** activate *Estatein*.
4. Visit **Settings → Permalinks** and click *Save* once (flushes CPT rewrite rules so
   `/properties/`, `/services/`, etc. resolve).
5. Create Pages for **About / Services / Contact** and assign their page templates
   (Page Attributes → Template). Set the **Home** page under *Settings → Reading*.
6. Build the **Primary** menu (Appearance → Menus): Home · About Us · Properties · Services,
   and assign it to the *Primary* + *Footer* locations. The "Contact Us" button in the header
   is part of the theme.
7. Add content via the **Properties / Services / Team / Testimonials / FAQs** post types.
   Every field has a fallback, so the site looks complete even before content is added.

## Theme structure

```
estatein/
├── functions.php          # bootstrap → inc/*
├── inc/                   # theme-setup, enqueue, cpt, acf-fields, seo, template-tags
├── header.php footer.php  # reusable shell
├── front-page.php         # Home
├── page-about.php  page-services.php  page-contact.php
├── archive-property.php   # Properties listing
├── single-property.php    # Property detail
├── template-parts/components/   # cards, sliders, CTA, section header …
└── assets/{css,js,img}    # tokens→base→layout→components→responsive; vanilla JS + self-hosted GSAP
```

## Notes

- **SQLite vs MySQL:** the demo uses the SQLite integration plugin for portability. For
  production, point `wp-config.php` at a MySQL database and remove the SQLite drop-in.
- **Forms:** the styled forms map to **Contact Form 7**; wire a CF7 form to enable live
  submissions/email.
- Tested in Chrome, Firefox, Safari and Edge across desktop, tablet and mobile widths.
