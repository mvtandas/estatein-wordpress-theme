# Estatein — WordPress Theme · Development Documentation

A custom, classic-PHP WordPress theme built pixel-by-pixel from the **Estatein — Real Estate
Business Website UI Template (Dark Theme)** Figma file
(<https://www.figma.com/community/file/1314076616839640516>).

---

## 1. Approach & development process

I built a **custom classic theme** (not a block theme and not a page-builder) so the markup,
CSS and JS stay fully under my control and match the Figma 1:1. Work proceeded page by page,
each one extracted from Figma via the REST API (exact node geometry, colours, type and image
fills) and then verified against headless-browser screenshots at desktop (1600px), laptop and
mobile (390px) widths until pixel-accurate.

**Pages delivered** (all from the reference):

| Page | Template | Notes |
|------|----------|-------|
| Home | `front-page.php` | Hero (rotating SVG badge), feature strip, featured properties / testimonials / FAQ sliders, CTA |
| About Us | `page-about.php` | Our Journey + stats, Our Values, Achievements, How-it-works steps, Team, Clients |
| Properties | `archive-property.php` | "Find Your Dream Property" search + filters, listing-card slider, enquiry form |
| Property Details | `single-property.php` | Gallery slider, description + specs, Key Features, inquiry form, comprehensive pricing, FAQ |
| Services | `page-services.php` | Elevate hero, three service-category sections each with a textured CTA panel |
| Contact | `page-contact.php` | Contact strip, "Let's Connect" form, office locations, "Explore Estatein's World" gallery |

## 2. Theme architecture

`functions.php` is a thin bootstrap; every concern lives in its own file under `inc/`:

```
estatein/
├── functions.php            # bootstrap only
├── inc/
│   ├── theme-setup.php       # theme supports, nav menus, image sizes
│   ├── enqueue.php           # styles/scripts (versioned, deferred, preconnect)
│   ├── cpt.php               # custom post types + taxonomies
│   ├── acf-fields.php        # ACF field groups registered in PHP (version-controlled)
│   ├── seo.php               # meta description + Open Graph (yields to SEO plugins)
│   └── template-tags.php     # presentation helpers (price format, specs, section header)
├── template-parts/components # reusable cards, sliders, CTA, section header
├── assets/css/               # tokens → base → layout → components → responsive
└── assets/js/                # nav, slider, gallery, faq, filters, animations (GSAP)
```

**CSS** is layered with a single source of truth: `tokens.css` holds the design tokens
(colours, spacing scale, radii, type scale, the fluid `--gutter`) taken verbatim from the
Figma variables; `base → layout → components → responsive` build on top, so the whole site
restyles from one file. **No framework** — hand-written CSS keeps the payload small.

**Reusable components** — header, footer and every repeated card/slider are partials
(`get_template_part`) so the header/footer exist once and the loops stay DRY.

## 3. Content management (CPT + ACF)

Five custom post types give the client editable content without touching code:
`property`, `service`, `team_member`, `testimonial`, `faq`, plus `property_type` and
`location` taxonomies. ACF field groups (price, bedrooms/bathrooms/area, gallery, key
features, address, etc.) are **registered in PHP** so they ship with the theme and stay in
version control. All templates read through an `estatein_field()` wrapper that returns
sensible fallbacks, so pages render correctly even before any content is entered.

## 4. Responsiveness

Mobile-first overrides live in `responsive.css` at `1024px` (tablet — nav collapses to a
toggle, multi-column grids drop to 2-up) and `768px` / `480px` (mobile — single column,
full-width actions, Figma mobile type scale). Layouts use CSS grid/flex with `minmax(0,1fr)`
to avoid blow-out, and images use `aspect-ratio` + `object-fit` so the collages keep their
proportions at any width.

## 5. Performance

- Scripts are **deferred** and printed in the footer; CSS is split and dependency-ordered.
- Asset versions use `filemtime()` for safe cache-busting.
- `preconnect` resource hints for the Google Fonts origin; Urbanist loads with `display=swap`.
- Images are **lazy-loaded** (`loading="lazy"`), served through registered crop sizes
  (`estatein-property-card`, `-hero`, `-avatar`), and self-hosted where decorative.
- All theme photos are served as **WebP** (converted from PNG, q≈82): the image
  directory dropped from ~13 MB to ~3.4 MB (e.g. the hero went 3.2 MB → 300 KB) with
  no visible quality loss.
- GSAP + ScrollTrigger are **self-hosted** (no CDN) and fully gated behind
  `prefers-reduced-motion` — with motion reduced or JS off, all content is visible and static.

## 6. Accessibility

Semantic landmarks (`header`/`nav`/`main`/`footer`), a "Skip to content" link, `aria-label`
on the primary nav and the mobile toggle (`aria-expanded` / `aria-controls`), decorative SVGs
marked `aria-hidden`, focus-visible outlines, and form inputs paired with `<label>`s.

## 7. SEO

`title-tag` support, a meta-description + Open Graph/Twitter block in `inc/seo.php` that
**defers to Yoast/Rank Math** if one is active (no duplicate tags), and a clean
heading-ordered outline. Additional SEO work:

- **Structured data (JSON-LD):** a `RealEstateAgent` block sitewide and a `RealEstateListing`
  (price, beds/area, image, address) on single-property pages — eligible for rich results.
- **XML sitemap:** WordPress core `wp-sitemap.xml`, which automatically includes the custom
  post types (properties, services, team, testimonials, FAQs).
- **Favicon:** an SVG site icon is registered from the theme (a Customizer Site Icon still
  takes precedence).
- **Alt text:** content thumbnails output a meaningful `alt` (the post title); purely
  decorative images use empty `alt` so screen readers skip them.

## 8. Interactivity & forms

Vanilla-JS (no jQuery): accessible content sliders (`data-slider`), the property-detail photo
gallery (thumbnail + dots + prev/next, keyboard operable), FAQ accordion, mobile nav, and
dismissible promo banner. The Properties/Contact/inquiry forms are styled to the design;
**Contact Form 7** is the integration point for live submissions.

## 9. Tools used

- **Advanced Custom Fields** (free) — flexible content fields.
- **Contact Form 7** (free) — form handling/spam protection.
- **SQLite Database Integration** — to run the demo without a MySQL server (swap for MySQL in production).
- Self-hosted **GSAP 3.12.5** + ScrollTrigger for the premium scroll/entrance animations.

## 10. Creative enhancements (beyond the static design)

Premium GSAP entrance + scroll-reveal animations, hero parallax and animated stat count-ups,
a continuously-rotating hero badge, hover lifts on cards, and the abstract line-texture
treatment on CTA panels — all motion-safe.
