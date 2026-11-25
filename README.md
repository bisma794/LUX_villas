# LUX Website — Frontend + CMS v2 (Laravel)

LUX VILLA DUBAI — built from the Figma file **"landing pages"**
(https://www.figma.com/design/SyvllLA7Cr43Izqflndtp2/landing-pages).
Same layout, same style, same copy as Figma. **v2 adds a full CMS:**
every visible word on the site lives in the database — no hardcoded
text in the frontend views. Pages are built by calling reusable global
sections, in any order, from the admin panel.

## Stack

- Laravel Framework **12.72.0** (PHP 8.3), Blade + Tailwind CSS 4 (Vite)
- SQLite database (`database/database.sqlite`, included in the ZIP already seeded)

## Run locally

```bash
composer install
npm install
npm run build
php artisan serve
# open http://127.0.0.1:8000
```

First time / fresh database (reproduces the whole site, including all
pages, sections, settings and the admin user):

```bash
php artisan migrate:fresh --seed
```

## Admin — login

Admin panel: **http://127.0.0.1:8000/admin** (redirects to `/admin/login`).

The admin user is created by the seeder (`LuxContentSeeder`) from
environment variables — **the login page never shows any credentials**:

- `ADMIN_EMAIL` (default `admin@luxvilla.ae`)
- `ADMIN_PASSWORD` (default `LuxAdmin!2026`)

Change them before going live, e.g. in `.env`:

```env
ADMIN_EMAIL=admin@luxvilla.ae
ADMIN_PASSWORD=choose-a-strong-password
```

then run `php artisan migrate:fresh --seed` again (or update the user in
the admin database). The seeded password is a bcrypt hash; the plain
password is never stored anywhere in the project.

## CMS model

| Table | Purpose |
|---|---|
| `settings` | Global site text: site name, logo, header button, header nav items (JSON), footer about/disclaimer/copyright/explore links (JSON), contact phone, WhatsApp label, city, social URLs. Edited at **Admin → Settings**. Rendered in the header/footer on every page. |
| `sections` | One reusable content block. Columns: `key` (unique slug, e.g. `home_hero`), `name`, `type`, `content` (JSON), `is_global`, `status` (published/draft). Editing a section updates **every** page that calls it. |
| `pages` | A page: `title`, `slug`, `path` (URL without leading slash; empty = home `/`), `status` (published/draft), `seo_title`, `seo_description`. |
| `page_section` | Pivot: which sections a page calls, and in which order (`sort_order`). |

Section `content` JSON uses common keys — `eyebrow`, `heading_html`
(HTML allowed: `<span class="script">word</span>` for the italic word,
`<br>` for a line break), `subtext`, `image`, `image_alt`, `image_side`,
`button_text`, `button_link`, `button2_text`, `button2_link`,
`breadcrumb` — plus type-specific keys: `items[]` (cards/listings),
`blocks[]` (SEO text), `faqs[]`, `steps[]` (quiz stepper), `tabs[]` /
`panels` (tabbed sections), `fields[]` / `search_fields` (forms),
`sidebar[]` (listing sidebar cards), `mortgage` (calculator defaults),
`gallery` / `trend_bars` / `trend_stats` / `similar` / `amenities`.

Section types (31): hero, search_filter, cards_3col, text_image,
numbers_3col, communities_grid, listings, blog_cards, article_grid,
testimonials, advisor_band, seo_text, faq, register_interest,
stats_strip, how_we_work, listing_rows, listing_detail, gallery,
overview, amenities, price_trend, property_types, project_header,
project_detail, mortgage_calculator, stepper_quiz, map_view,
community_guide, promo_band, page_intro, text_block. Each type has one
renderer in `resources/views/sections/{type}.blade.php`; the frontend
renders any page with the single view `resources/views/pages/dynamic.blade.php`.

## How to create a dynamic page and call sections

1. **Admin → Pages → + New Page.** Fill in title, slug, URL path
   (e.g. `summer-offer` → the page lives at `/summer-offer`), status
   Published, SEO title. Save.
2. On the page edit screen, under **"Page builder"**, pick a section
   from the **"Call a section from the library"** dropdown and click
   **+ Add Section**. Repeat for every block the page needs.
3. Reorder with the **↑ / ↓** buttons, remove with **✕**. The order
   here is the order on the live page.
4. Open the URL — the page renders immediately. Draft pages are hidden
   from the site; publish them from the same screen.
5. A demo of this already exists: **/test-cms-page** ("Test CMS Page"),
   built from 3 existing global sections (Home hero, Advisor band, FAQ).

## How global edit works

**Admin → Sections → Edit** any section. The edit screen shows which
pages use it ("Used by N page(s)"). Change the heading, text, button,
image or the advanced JSON (lists, FAQs, steps, tabs, sidebar,
mortgage) and save — every page calling that section shows the new
content at once, with no other change needed. Example verified on
17 Nov 2026: editing the Advisor band heading updated Home, About and
the test page simultaneously (Blog does not use that section, so it was
correctly unchanged); the edit was then reverted.

Images: the section form has a dropdown of the bundled photo library
(`public/images/`, 26 Unsplash photos) **and** an upload field — uploads
go to `storage/app/public/uploads/` (served at `/storage/uploads/...`,
symlink created with `php artisan storage:link`).

## No hardcoded text — proof

All page copy lives in `database/seeders/LuxContentSeeder.php` and the
`sections` / `settings` tables. The old static Blade page files were
deleted; the frontend renders only from the database. Check it:

```bash
php artisan lux:check-hardcoded
# OK: no Figma copy is hardcoded in frontend Blade views
```

It scans `views/pages`, `views/sections`, `views/partials` and the
layout for Figma copy phrases (headings, prices, the Bahria Town
disclaimer, agent names…). One honest exception: a few structural
template words that belong to a section's markup (e.g. "Search",
"Next →", "Call" buttons, "Price Trend" chart label) live in the
section partials by design — every piece of page copy (headings,
paragraphs, prices, FAQs, SEO text, footer) comes from the database.

## Routes (all 11 Figma frames — URLs unchanged)

| Page (Figma frame) | URL |
|---|---|
| Lux Home Page | `/` |
| Lux About US | `/about` |
| Lux Villa for selling | `/villas-for-sale` |
| Buy Listing Details | `/listing/the-valley-prime-location` |
| Lux Project Details page | `/projects/golf-vale-emaar-south` |
| AI Villa Assessment | `/ai-villa-assessment` |
| Enquiry | `/enquiry` |
| Blog | `/blog` |
| Communities Main page | `/communities` |
| Communities inner page | `/communities/the-valley` |
| Project | `/projects` |

Any other published page created in admin is served by the catch-all
dynamic route (`/{path}`) — e.g. `/test-cms-page`. Header/footer
navigation and breadcrumbs link between all pages.

## Design tokens used

- Body font: **Source Sans 3** Regular 22px / 29px line-height, colour `#10221C`
  (verified from Figma)
- Headings: large serif display type, dark green-black, with one word in
  script/italic serif (e.g. "Dubai", "advise", "confidence")
- Colours verified from Figma: white `#FFFFFF`, body/dark text `#10221C`,
  dark banner/footer/sections `#0E1A14`
- Primary buttons: solid tan/gold pill, white text + arrow; secondary/active
  tabs: dark green/black pills; WhatsApp button: bright green `#25D366`
- Eyebrows: small-caps, letter-spaced labels

## Approximations (Figma did not expose these values — unchanged from v1)

1. **Tan/gold button hex — approximate.** The browser inspection sampled the
   button *text* layer, not the button rectangle, so the exact hex was never
   captured. This build uses **`#B9975B`** (warm tan/gold, visually close to
   the Figma buttons). If the exact hex is sampled in Figma later, change the
   `--color-tan` value in `resources/css/app.css` (and the `.btn-tan` rule)
   — one place, whole site updates.
2. **Heading serif font — approximate.** The heading font *name* was not
   captured from the Figma panels. This build uses **Playfair Display**
   (Google Fonts) as the closest elegant serif, with Georgia as fallback.
   If Figma's font name is confirmed later, swap it in
   `resources/views/layouts/app.blade.php` + `resources/css/app.css`.
3. **Home header nav.** The Home hero at low zoom appeared to show a shorter
   nav ("Home Why Invest Blogs Our Projects Other") than the other pages.
   This build uses the **full nav everywhere** for consistency:
   HOME · VILLAS · BUY · SELL · MAINTENANCE · COMMUNITIES · COMPANIES ·
   PROJECTS · ABOUT US.

## Notes kept exactly as in Figma (do not "fix" without Babar's say-so)

- **Bahria Town copy kept as-is.** The Figma SEO/disclaimer block and the
  Communities inner enquiry card read "Enquire about Bahria Town Dubai"
  (on a page about The Valley Dubai), and the disclaimer says
  "DISCLAIMER: It Is Not Official Bahria Town Dubai Website…". This looks
  like copy carried over from a separate Bahria Town design in the same file,
  but Babar confirmed: keep the Figma copy as-is, no changes. It is now
  editable in the CMS (SEO text section `global_seo`, Valley hero
  `valley_hero`) — change it there if Babar ever says so.
- **Repeated placeholder cards kept as-is** — e.g. the AED 4,000,000 listing
  rows, the same three Fairway/Maple/Nara cards on Home and Project, and the
  same three blog articles repeated on the Blog page.
- **"Offplan Villa For Sale" body copy** talks about "apartments" in Figma;
  kept verbatim.
- **Mortgage calculator:** Figma defaults — property AED 45,000,000,
  30% down (AED 13,500,000), loan AED 31,500,000, 25 years, 3.75%,
  displayed result **AED 165,550/month** (as shown in Figma). The calculator
  recomputes live when the user changes any input.
- **Payment plan** "20% Down, 80% Over 4 Years / Handover est. 2029" was
  seen in the file's top-level layers (Palm Jebel Ali / BT content), NOT
  inside the 11 LUX frames, so it was **not** applied to the LUX pages.
  The LUX project example is Golf Vale Emaar South, starting
  AED 1,099,888, handover 2030 Q1.

## Interactive bits (frontend-only, no backend)

- Search/filter forms and Buy/Rent/Off-plan + Villas/Town Houses tabs
  (client-side tab switching; forms submit as GET to the listing pages)
- FAQ accordion on every page (click to open)
- 5-step AI Villa Assessment and 5-step Enquiry questionnaire
  (client-side stepper: select an option, Next/Back, final shortlist
  summary exactly as in Figma, including "No Exact Matches In The
  Current List")
- Mortgage calculator (client-side, Figma defaults above)

## Images

Figma assets were **not** downloadable (the Figma MCP needs edit access;
the browser inspection returned no files). All photos are similar
free luxury-villa / Dubai photos from **Unsplash** (`images.unsplash.com`),
downloaded locally into `public/images/` — no hotlinking, no screenshots
used as implementation. Files: villa-night, villa-modern, villa-pool,
villa-pool-dusk, villa-sunset, house-exterior, house-facade, house-white,
townhouse, living, interior-lux, interior-2, interior-3, kitchen,
apartment, dubai-skyline, dubai-marina, dubai-towers, beach, garden,
family-park, pool-hotel, report-hand, avatar-woman, avatar-man,
avatar-woman2, agent. Photographers are the original Unsplash contributors
for those photo IDs; replace any image with the real Figma asset whenever
it becomes available.

## Screenshots

v2 screenshots (puppeteer-core, 1440px viewport), checked visually, are in
`screenshots/` as small JPGs under 500 KB each:
`lux-home-v2.jpg`, `lux-about-v2.jpg`, `lux-villas-for-selling-v2.jpg`,
`lux-listing-details-v2.jpg`, `lux-project-details-v2.jpg`,
`lux-ai-assessment-v2.jpg`, `lux-enquiry-v2.jpg`, `lux-blog-v2.jpg`,
`lux-communities-main-v2.jpg`, `lux-communities-inner-v2.jpg`,
`lux-project-v2.jpg`, `lux-test-cms-page-v2.jpg`,
`lux-cms-dashboard-v2.jpg`, `lux-cms-pages-v2.jpg`,
`lux-cms-page-builder-v2.jpg`, `lux-cms-sections-v2.jpg`,
`lux-cms-section-edit-v2.jpg`. The v1 screenshots are kept alongside
(`lux-*-v1.jpg`). Note: in full-page captures the sticky header can
appear once mid-page — a screenshot-stitching artefact, not a site
defect; in a real browser the header stays pinned at the top.

## Verification (17 Nov 2026, CMS v2)

- `php artisan migrate:fresh --seed` clean — reproduces 12 pages
  (11 Figma + `/test-cms-page` demo), 44 sections (38 global), 17
  settings, 1 admin user
- `php artisan lux:check-hardcoded` passes — no Figma copy in Blade
- `npm run build` passes (Vite 7.3.8, Tailwind 4)
- `php artisan serve` locally — **all 11 original URLs + `/test-cms-page`
  return HTTP 200**; `/admin` redirects to `/admin/login` (302), login
  page returns 200 and shows no credentials
- Admin login works (seeded admin user); dashboard, pages list, sections
  list and settings all return 200
- Dynamic page test: `/test-cms-page` created in admin from 3 existing
  global sections (Home hero, Advisor band, FAQ) — renders 200 with all
  three sections, no code change
- Global-edit test: Advisor band heading changed in admin → the new
  heading appeared on Home, About and the test page (all pages using it);
  Blog correctly unchanged (it does not use that section); edit reverted
  afterwards and the original heading verified back on Home
- v2 frontend screenshots compared visually with the v1 screenshots —
  same sections, order, copy, images and layout on every page
