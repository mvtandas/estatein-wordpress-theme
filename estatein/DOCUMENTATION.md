# Estatein Theme — Development Documentation

> Assessment deliverable: a custom WordPress theme converting the *Real Estate Business
> Website UI Template – Dark Theme (Estatein)* Figma template into a responsive,
> accessible, performance-minded WordPress site.

## 1. Approach & technical choices

**Classic PHP theme, not a block/FSE theme.** The deployment target is the candidate’s
existing **cPanel** hosting (standard Apache/PHP/MySQL). A classic template-hierarchy
theme uploads as a zip, activates without a build step, and is the most predictable on
shared hosting — while also better showcasing core WordPress skills the brief asks for
(the Loop, template hierarchy, hooks, `get_template_part`).

**Design-token-first CSS.** Every color, space, radius, and type size is a CSS custom
property in `assets/css/tokens.css`, seeded from the Estatein spec and refined against the
exact Figma variables (pulled via the **Figma Dev Mode MCP** `get_variable_defs`). The
rest of the CSS references tokens only — so the theme can be recolored or rescaled in one
file, and fidelity to Figma is a matter of matching variables rather than chasing hexes.

**Modular `functions.php`.** The bootstrap only wires up focused includes under `inc/`
(`theme-setup`, `enqueue`, `cpt`, `acf-fields`, `seo`, `template-tags`). Each concern is
isolated and easy to review.

**Reusable components.** Header, footer, and every repeated UI unit (property/service/
team/post cards, testimonial, FAQ item, section header, CTA banner) are
`template-parts/components/*` rendered with `get_template_part()`, keeping templates thin.

## 2. Content model (CPTs + ACF)

Custom post types (`inc/cpt.php`): **Property, Service, Team Member, Testimonial, FAQ**,
plus `property_type` and `property_location` taxonomies for filtering.

ACF field groups (`inc/acf-fields.php`) are **registered in PHP** (not just the DB) so the
content structure ships with the theme and reproduces on any install — no manual re-entry
after a cPanel deploy. ACF JSON sync points at `acf-json/` so UI-authored changes are
captured in version control too. Key groups:

- **Property Details** — price, status, featured flag, beds/baths/area, address, gallery,
  repeatable key features.
- **Team Member** — role, email, LinkedIn.
- **Testimonial** — rating, author role.
- **Theme Settings** (ACF options page) — phone, email, office address, social links;
  consumed by header/footer/contact.

> Trade-off noted: CPTs live in the theme for assessment simplicity. For a production site
> expected to survive theme switches, they would move to a small companion plugin.

## 3. Forms

**Contact Form 7** powers the contact page and the single-property inquiry form. Chosen
over a hand-rolled handler because it is battle-tested, mail-reliable on cPanel, spam-
add-on friendly, and client-editable. The theme styles CF7 output to match the dark UI.
A no-JS path is preserved (the form posts normally).

## 4. Responsiveness

Mobile-first CSS with breakpoints at **1024px** (3→2 column grids), **768px** (→1 column;
nav collapses into an accessible toggle panel), and **480px** (full-width buttons, tighter
gutters). Fluid type, `max-width:100%` media, `aspect-ratio` on cards, and CSS Grid/Flex
throughout.

## 5. Accessibility

- Skip-to-content link; single `<main>` landmark; semantic header/nav/footer.
- Mobile menu toggle uses `aria-expanded` / `aria-controls`; closes on Escape.
- FAQ uses native `<details>/<summary>` (keyboard + SR support for free); JS only adds
  single-open behavior.
- Visible `:focus-visible` rings via the brand color; `screen-reader-text` utility for
  context-only labels (e.g. “View Details *{property title}*”).
- Star ratings exposed via `role="img"` + descriptive `aria-label`.
- `prefers-reduced-motion` disables transitions/animations.

## 6. SEO

- `add_theme_support('title-tag')` + clean separator.
- `inc/seo.php` outputs a derived meta description and Open Graph / Twitter tags, and
  **stands down automatically** if Yoast or Rank Math is active (no duplicate tags).
- Semantic headings, descriptive link text, image `alt`, clean permalinks, CPT archives.

## 7. Performance

- Stylesheets split into cascade-ordered files, enqueued with `filemtime` cache-busting in
  dev and theme-version busting in production.
- Theme scripts are footer-loaded and **deferred** via a `script_loader_tag` filter.
- Images use `loading="lazy"` and WordPress responsive `srcset`; tailored crop sizes
  (`estatein-property-card/-hero/-avatar`).
- Google Fonts limited to Urbanist with `display=swap` + `preconnect` resource hints.

## 8. Deployment to cPanel

1. In cPanel, ensure a WordPress install exists (Softaculous “WordPress” installer, or
   manual). PHP 8.x recommended.
2. **Appearance → Themes → Add New → Upload Theme** → `estatein.zip` → Activate.
3. **Plugins → Add New**: install & activate **Advanced Custom Fields** and
   **Contact Form 7**.
4. **Tools → Import → WordPress**: import the provided `estatein-content.xml` (WXR) to
   recreate demo properties, services, team, testimonials, FAQs, pages, and menus.
5. **Settings → Reading**: set the static front page. **Settings → Permalinks**: choose
   *Post name* and save (flushes CPT rewrite rules).
6. **Appearance → Menus**: assign Primary + Footer menus. Fill **Theme Settings**.
7. Create the Contact Form 7 form(s); confirm the shortcode title used in
   `page-contact.php` / `single-property.php`.

## 9. Testing performed

- Cross-viewport rendering (desktop / tablet / mobile) compared against the Figma frames.
- Functional: nav + mobile toggle, FAQ accordion, testimonial slider, property filters &
  pagination, CF7 submission, internal links, 404.
- `WP_DEBUG` enabled during development to keep the theme notice-free.
- Lighthouse review for performance / SEO / accessibility.

## 10. Possible enhancements (beyond the brief)

- Map embed + geolocation on property detail.
- Saved-search / favorites with a logged-in user area.
- Schema.org `RealEstateListing` structured data for richer search results.
- A companion plugin for the CPTs to decouple content from the theme.
