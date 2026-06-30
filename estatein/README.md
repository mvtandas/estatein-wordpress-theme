# Estatein — Custom WordPress Theme

A custom, responsive WordPress theme built from the **“Real Estate Business Website UI
Template – Dark Theme” (Estatein)** Figma template. Classic PHP theme (template
hierarchy — no FSE), so it deploys cleanly to standard cPanel/LAMP hosting.

- **Dark UI**, violet `#703BF7` accent, Urbanist typeface
- Custom post types: **Property, Service, Team Member, Testimonial, FAQ**
- **ACF**-backed flexible content (field groups registered in PHP → travel with the theme)
- **Contact Form 7** for contact + property-inquiry forms
- Accessible (skip link, ARIA, keyboard nav, `prefers-reduced-motion`), SEO-ready
  (title-tag, meta description, Open Graph), and performance-minded (deferred JS,
  lazy images, `srcset`, font preconnect).

## Requirements

- WordPress ≥ 6.0, PHP ≥ 7.4
- Plugins: **Advanced Custom Fields** (free) and **Contact Form 7**

## Local development

```bash
# from the WordPress install root
cd wp-content/themes
git clone <this-repo> estatein

# create the contact form + activate plugins
wp plugin install advanced-custom-fields contact-form-7 --activate
wp theme activate estatein

# (re)generate permalinks so CPT URLs work
wp rewrite structure '/%postname%/' --hard
wp rewrite flush --hard

# serve
wp server   # http://localhost:8080
```

### Suggested content setup

1. **Settings → Reading**: set a static front page (uses `front-page.php` automatically).
2. Create pages **About**, **Services**, **Contact** and assign the matching page
   templates (Page Attributes → Template).
3. Add a few **Properties** (mark some *Featured*), **Services**, **Team Members**,
   **Testimonials**, **FAQs**.
4. **Theme Settings** (ACF options page): phone, email, address, social links.
5. **Appearance → Menus**: build the *Primary* and *Footer* menus.
6. **Contact Form 7**: create a form named `Contact form 1` (and optionally
   `Property Inquiry`); update the shortcode title in `page-contact.php` /
   `single-property.php` if you name them differently.

## File map

| Path | Responsibility |
|------|----------------|
| `functions.php` | Bootstrap; requires the `inc/` modules |
| `inc/theme-setup.php` | Theme supports, menus, image sizes, widgets |
| `inc/enqueue.php` | Versioned styles/scripts, defer, font preconnect |
| `inc/cpt.php` | Custom post types + taxonomies |
| `inc/acf-fields.php` | ACF field groups (PHP) + `acf-json` sync |
| `inc/seo.php` | Meta description + Open Graph/Twitter tags |
| `inc/template-tags.php` | Presentation helpers (price, specs, section header) |
| `header.php`, `footer.php` | Shared shell |
| `front-page.php` | Home |
| `archive-property.php`, `single-property.php` | Property listing + detail |
| `page-about.php`, `page-services.php`, `page-contact.php` | Page templates |
| `template-parts/components/*` | Reusable UI (cards, slider, FAQ, CTA…) |
| `assets/css/*` | `tokens → base → layout → components → responsive` |
| `assets/js/*` | `nav`, `faq`, `slider`, `filters` |

## Design tokens

All colors, spacing, type, and radii live as CSS custom properties in
`assets/css/tokens.css`. They are seeded from the Estatein spec and refined against the
exact Figma variables via the Figma Dev Mode MCP (`get_variable_defs`). Nothing else
hard-codes a hex value — restyle the whole theme by editing tokens.

## Deploy to cPanel

See `DOCUMENTATION.md` → *Deployment*.
