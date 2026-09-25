# Mandala — Style Reference
> Cream paper under a deep indigo sky — a single sheet of eggshell paper, one calm band of indigo, and a flat eight-fold mandala that feels printed, not designed.

**Theme:** light
**Use:** online self-help e-learning materials

Roles and recommendations are interpreted from the original poster system and adjusted for a learning website. HTML examples are reconstructions, not source components.

The Mandala system reads as a printed meditation card translated to the web. The canvas is a warm eggshell cream (#fbf5e7), never clinical white — every default surface carries that paper warmth. A single full-bleed deep indigo band (#27308a) opens the first screen and acts as the calm anchor of the brand, while a deep coffee-brown band (#3d2800) carries level lists and footer content. Typography uses a geometric display face (Space Grotesk) that swings from a large display headline with tight tracking down to 14-17px body, then jumps to positively tracked uppercase eyebrows for navigation and captions. Long reading text is set in Inter. Controls are flat pill shapes, the material grid is a sharp-cornered hairline grid, and color is rationed: most screens stay cream and monochrome, letting indigo and saffron appear only on the hero and inside the mandala illustration. The circle is the recurring motif — in the mandala, the pill buttons, the rosette bullets and the progress marks.

## Tokens — Colors

| Name | Value | Token | Role |
|------|-------|-------|------|
| Deep Indigo | `#27308a` | `--color-deep-indigo` | Full-bleed hero backgrounds and the one section that needs to stand out — the single saturated colour of the system, calm rather than loud |
| Coffee Bean | `#3d2800` | `--color-coffee-bean` | Dark level-list and footer bands, headings on cream, wordmark — a warm near-black that reads as ink |
| Saffron | `#f29e0c` | `--color-saffron` | Mandala ring, rosette bullets, progress fill — the warm counterweight to indigo. Illustration and decoration only, never text on cream |
| Eggshell Cream | `#fbf5e7` | `--color-eggshell-cream` | Page canvas, card surfaces, grid background, text on dark bands — the warm default that replaces white everywhere |
| Ink Black | `#000000` | `--color-ink-black` | Body text, hairline dividers, form borders, mandala line work, icons, focus ring on cream |
| Sand Tint | `#ece2cb` | `--color-sand-tint` | Secondary surface, disabled fills, alternate rows — the sibling of cream when a block needs separation |
| Mocha | `#604106` | `--color-mocha` | Hairline divider on the Coffee Band only. A line colour, never a surface |

### Contrast notes
- Ink Black on Eggshell Cream and Eggshell Cream on Coffee Bean or Deep Indigo all pass WCAG AA for body text
- Saffron on cream does not pass for text or for focus outlines. Use it for fills and illustration only
- Focus outline: Ink Black on cream surfaces, Eggshell Cream on indigo and coffee surfaces

## Tokens — Typography

### Space Grotesk — Display and interface face · `--font-display`
- **Source:** Google Fonts (free)
- **Weights:** 400, 500
- **Sizes:** 10px, 12px, 14px, 24px, 40-64px (heading), 56-144px (display)
- **Line height:** 1.00 (display), 0.95 (heading), 1.20 (title and 10-12px labels)
- **Letter spacing:** -0.06em on display, -0.05em on heading, -0.03em on title, +0.022em at 12px, +0.05em at 10px
- **Role:** Headlines, navigation, buttons, eyebrows, card titles. The tracking swing from tight display to widened micro labels is the typographic signature

### Inter — Reading face · `--font-body`
- **Source:** Google Fonts (free)
- **Weights:** 400, 500
- **Sizes:** 16px, 17px
- **Line height:** 1.60
- **Letter spacing:** -0.01em to -0.02em
- **Role:** Material descriptions, lesson text, policy pages and every long paragraph. Self-help content is read slowly — Inter keeps it quiet and comfortable

### System sans-serif — Utility text · `--font-system`
- **Weights:** 400
- **Sizes:** 12px
- **Line height:** 1.20
- **Role:** Timestamps, small badges, form helper text

### Japanese
Both stacks fall back to Noto Sans JP. On `lang="ja"` pages, tracking resets to 0 and line height opens up (display 1.15, heading 1.25, body 1.8) so kanji never collide. This override lives in `variables.css`.

### Type Scale

| Role | Family | Weight | Size | Line Height | Letter Spacing | Token |
|------|--------|--------|------|-------------|----------------|-------|
| micro | Space Grotesk | 400 | 10px | 1.2 | 0.05em | `--text-micro` |
| eyebrow | Space Grotesk | 400 | 12px | 1.2 | 0.022em | `--text-eyebrow` |
| caption | Space Grotesk | 400 | 14px | 1.41 | -0.02em | `--text-caption` |
| body-sm | Inter | 400 | 16px | 1.6 | -0.02em | `--text-body-sm` |
| body | Inter | 400 | 17px | 1.6 | -0.01em | `--text-body` |
| title | Space Grotesk | 500 | 24px | 1.2 | -0.03em | `--text-title` |
| heading | Space Grotesk | 500 | 40-64px | 0.95 | -0.05em | `--text-heading` |
| display | Space Grotesk | 400 | 56-144px | 1 | -0.06em | `--text-display` |

## Tokens — Spacing & Shapes

**Density:** compact on controls, generous around reading text

### Spacing Scale

| Name | Value | Token |
|------|-------|-------|
| 5 | 5px | `--spacing-5` |
| 7 | 7px | `--spacing-7` |
| 8 | 8px | `--spacing-8` |
| 10 | 10px | `--spacing-10` |
| 16 | 16px | `--spacing-16` |
| 17 | 17px | `--spacing-17` |
| 23 | 23px | `--spacing-23` |
| 24 | 24px | `--spacing-24` |
| 32 | 32px | `--spacing-32` |
| 48 | 48px | `--spacing-48` |
| 57 | 57px | `--spacing-57` |
| 78 | 78px | `--spacing-78` |
| 80 | 80px | `--spacing-80` |
| 104 | 104px | `--spacing-104` |
| 112 | 112px | `--spacing-112` |
| 200 | 200px | `--spacing-200` |

### Border Radius

| Element | Value | Token |
|---------|-------|-------|
| cards | 0px | `--radius-cards` |
| material covers | 0px | `--radius-media` |
| buttons | 99px | `--radius-buttons` |
| pills | 99px | `--radius-pills` |
| tags | 99px | `--radius-tags` |
| text inputs, selects | 99px | `--radius-inputs` |
| textareas | 24px | `--radius-textarea` |
| icon badges, rosettes | 50% | `--radius-circle` |

### Layout

| Name | Value | Token |
|------|-------|-------|
| Section gap | 57-78px, fluid | `--section-gap` |
| Card padding | 16-24px, fluid | `--card-padding` |
| Element gap | 10-16px, fluid | `--element-gap` |
| Page gutter | 16-78px, fluid | `--page-gutter` |

Reading columns for material descriptions and policy pages are capped at 68ch. Bands themselves stay full-bleed.

## Components

### Indigo Hero Band
**Role:** Opening screen of the home page

Full-bleed #27308a band, at least 80vh on desktop and auto height on phones. Logo top-left. Navigation links (HOME, E-LEARNING MATERIALS, ABOUT US, CONTACT US) in cream at 12px, uppercase, tracked +0.022em, top-right. The mandala illustration sits centred or right of centre. The headline sits bottom-left in cream at display size, with a 12px cream eyebrow 32px above it (SELF-HELP E-LEARNING MATERIALS). The primary pill button sits under the headline.

### Primary Pill Button
**Role:** Main action — e.g. BROWSE MATERIALS, BUY CREDITS

Eggshell Cream pill on indigo or coffee, Coffee Bean pill with cream text on cream surfaces. 99px radius, padding 8px 16px, minimum height 44px. Contains an optional 32×32 circular badge (cream on dark surfaces, Coffee Bean on cream) holding a miniature saffron rosette, the label in 12px uppercase tracked +0.022em, and a right-arrow glyph. No shadow. Hover swaps fill and text colours; focus shows the surface's focus ring.

### Secondary Pill Button
**Role:** Less important actions — e.g. VIEW DETAILS, CANCEL

Transparent fill, 1px Ink Black border on cream (1px cream border on dark bands), same size and type as the primary pill. Hover fills with Sand Tint on cream.

### Top Navigation Bar
**Role:** Global navigation

Transparent. Logo left, links right, 24px between items. Items are 12px Space Grotesk, uppercase, tracked +0.022em, Ink Black on cream and Eggshell Cream on indigo. The current page gets a 6px saffron dot under the label — the only active decoration. Below 992px the links collapse behind a round 44×44 menu button that opens a full-screen cream panel with links at title size.

### Eggshell Content Section
**Role:** Default body surface

Full-bleed #fbf5e7 background. No border, no shadow, no radius. Vertical padding uses `--section-gap`, horizontal padding uses `--page-gutter`. Headings in Coffee Bean at heading size. Body in Ink Black, Inter, 17px, capped at 68ch.

### Material Card
**Role:** One e-learning material in a listing

Zero radius, cream background, 1px Ink Black hairline on all sides. Cover image on top at 4:3, zero radius, edge to edge. Below it, padded with `--card-padding`: a 12px uppercase category eyebrow, the material title at title size in Coffee Bean, a two-line Inter summary at 16px, and a footer row with the level count and the credit price from the database, separated from the summary by a hairline. The whole card is one link. Hover swaps the background to Sand Tint — no lift, no shadow.

### Material Grid
**Role:** Listing of e-learning materials

Three columns on desktop, two from 768px, one below 576px. Gap 0 — each card's hairlines compose the grid lines, so neighbouring borders collapse to 1px. Sits inside an Eggshell Content Section with the page gutter on both sides.

### Coffee Level Band
**Role:** Dark inverted band for the levels of a material, a learning path, or the footer

Full-bleed #3d2800 background. Heading at heading size, weight 500, Eggshell Cream. Intro text in cream at 14-16px. 48px between the heading block and the rows below.

### Level Row
**Role:** One level inside the Coffee Level Band

Three-column row: level number on the left (12px cream, uppercase, tracked), level title in the centre (17px cream), status or credit cost on the right (12px cream). Minimum row height 44px, rows separated by a 1px Mocha hairline. Unlocked levels show a filled saffron rosette before the title; locked levels show an outline rosette in cream.

### Rosette Bullet
**Role:** List marker and small decorative mark

An eight-petal rosette, 10-12px, drawn as a flat saffron shape. Replaces round bullets in feature lists and policy pages. At 16-24px it can act as a section divider centred between blocks.

### Section Caption
**Role:** Eyebrow above a heading

10-12px Space Grotesk, uppercase, tracked +0.022em to +0.05em. Coffee Bean on cream, Eggshell Cream on indigo and coffee. Sits 32px above the heading it labels.

### Form Field
**Role:** Inputs on contact, sign-in, checkout and newsletter forms

Label above in 12px uppercase Coffee Bean. Input: cream fill, 1px Ink Black border, 99px radius, 44px minimum height, 16px Inter text, padding 10px 16px. Textareas use a 24px radius. Placeholder in Mocha. Error state keeps the pill shape, switches the border to 2px Coffee Bean, and shows the message below in 12px with a small outline rosette. Focus shows the Ink Black focus ring.

### Progress Mark
**Role:** Learner progress through a material

A row of small circles, one per level: saffron fill for completed, Ink Black outline for the rest. For long materials, a 6px pill track in Sand Tint with a saffron fill.

### Mandala Illustration
**Role:** Hero centrepiece graphic

Flat eight-fold mandala: eight rounded Eggshell Cream outer petals, a saffron ring of pointed inner petals, and a black-and-cream concentric line centre. Pure flat shapes, no gradients, no shadows. Scale about 60% of hero height on desktop and full content width on phones. It may rotate very slowly (one turn per 120s) and stops completely under `prefers-reduced-motion`. It is decorative, so it takes `aria-hidden="true"` and no alt text.

### Footer Wordmark
**Role:** Closing identity lockup

The website name in Eggshell Cream at 14px, top-left of the Coffee Band footer, 48px top padding, with the small saffron rosette before it. No rules, no background.

## Do's and Don'ts

### Do
- Use #fbf5e7 as the default canvas for every body section. Pure white is a violation of the paper-warm system — including inside buttons and badges
- Reserve #27308a for full-bleed bands. Never use it as a small button fill, chip or link colour
- Give every button, tag and text input the 99px pill radius. Round forms are the system's recurring motif
- Use tight negative tracking on display and heading sizes. Positive tracking belongs only on 10-12px eyebrows and captions
- Use the hairline grid for material listings. Zero gap, 1px black dividers, no card shadows
- Anchor every section with cream, sand, coffee or indigo as the surface
- Set long self-help text in Inter at 17px, 1.6 line height, max 68ch
- Keep touch targets at 44px minimum
- Mark the mandala and rosettes `aria-hidden="true"` — they are decoration

### Don't
- Don't use drop shadows anywhere. The system reads as flat printed matter
- Don't use saffron for text or focus outlines on cream — it fails contrast
- Don't set body text larger than 17px. Hierarchy comes from the jump between small body and large headings
- Don't use 0px radius on buttons or inputs, and don't round cards or material covers
- Don't introduce a new accent hue. The chromatic vocabulary is exactly three: Indigo, Coffee, Saffron
- Don't put more than one mandala illustration on a page. Small rosettes are fine; a second large mandala dilutes the hero
- Don't place a button on a surface of the same hue
- Don't animate the mandala when the user prefers reduced motion

## Surfaces

| Level | Name | Value | Token | Purpose |
|-------|------|-------|-------|---------|
| 0 | Hero Indigo | `#27308a` | `--surface-hero-indigo` | Full-bleed first screen of the home page |
| 1 | Eggshell Canvas | `#fbf5e7` | `--surface-eggshell-canvas` | Default body surface for every page |
| 2 | Sand Tint | `#ece2cb` | `--surface-sand-tint` | Alternate blocks, card hover, disabled fills |
| 3 | Coffee Band | `#3d2800` | `--surface-coffee-band` | Level lists and footer, inverted type surface |

## Elevation

The system is deliberately flat. No drop shadows, no glows, no raised surfaces. Hierarchy comes from surface colour (cream → sand → coffee → indigo), type scale and the negative space of full-bleed bands. Modals and dropdowns sit on cream with a 1px Ink Black border instead of a shadow, over a Coffee Bean backdrop at 60% opacity.

## Imagery

Brand imagery is graphic, not photographic: the flat mandala in the hero, small rosettes as bullets and dividers, and simple line icons. Material cover images come from the database and are shown inside 0-radius frames with a 1px hairline so they sit on the grid like printed plates. Icons are minimal geometric line marks at 1.5px stroke in Ink Black or cream. The overall feel is a printed meditation card — bold flat shapes, calm colour and one warm burst of saffron.

## Layout

Full-bleed bands with no max-width container on the band itself; content inside uses the page gutter, and reading text is capped at 68ch. The home page opens with the Indigo Hero Band, then alternates cream sections with one Coffee Level Band, and closes with the coffee footer. Inner pages start directly on cream with a heading block (eyebrow + heading) instead of the indigo hero. Vertical rhythm is 57-78px between sections. Listings use the hairline Material Grid. Breakpoints: 576px, 768px, 992px, 1200px.

## Agent Prompt Guide

**Quick Color Reference**
- canvas: #fbf5e7 (Eggshell Cream)
- secondary surface: #ece2cb (Sand Tint)
- surface dark: #3d2800 (Coffee Bean)
- hero band: #27308a (Deep Indigo)
- text primary: #000000 (Ink Black)
- headings on cream: #3d2800 (Coffee Bean)
- text on dark: #fbf5e7 (Eggshell Cream)
- accent illustration: #f29e0c (Saffron)
- primary action: Coffee Bean pill on cream, Eggshell Cream pill on dark

**Example Component Prompts**
1. Build a full-bleed hero band: #27308a background. Flat eight-fold mandala on the right (eight #fbf5e7 rounded petals, #f29e0c inner petal ring, #000000-and-#fbf5e7 concentric centre, 60% of hero height, `aria-hidden="true"`). Logo top-left. Four uppercase nav links (HOME, E-LEARNING MATERIALS, ABOUT US, CONTACT US) top-right at 12px Space Grotesk tracked +0.022em, #fbf5e7. Bottom-left: 12px cream eyebrow, display headline in cream, and a cream pill button reading BROWSE MATERIALS.
2. Build a material grid: #fbf5e7 background, 3 columns on desktop, 2 from 768px, 1 below 576px, gap 0, 1px #000000 hairlines, zero radius. Each card: 4:3 cover image, 12px uppercase category eyebrow, 24px Space Grotesk title in #3d2800, two-line 16px Inter summary, hairline, then level count left and credit price right. Hover fills the card with #ece2cb.
3. Build a level band: full-bleed #3d2800 background. Heading in #fbf5e7 Space Grotesk 500 at heading size, tracking -0.05em, line-height 0.95. Intro in cream at 16px. Below: level rows with a 12px uppercase level number, 17px title and 12px credit cost, minimum height 44px, separated by 1px #604106 hairlines, with a saffron rosette on unlocked levels.
4. Build a contact form: labels in 12px uppercase #3d2800, pill inputs with #fbf5e7 fill, 1px #000000 border, 99px radius, 44px height, 16px Inter text; textarea with 24px radius; a #3d2800 pill submit button with cream text. Errors below each field in 12px.
5. Build a footer: full-bleed #3d2800 band, website name in cream at 14px with a small saffron rosette before it, links in 12px uppercase cream, copyright line in 12px cream, all separated by 1px #604106 hairlines.

## Quick Start

### CSS Custom Properties

```css
:root {
  --color-deep-indigo: #27308a;
  --color-coffee-bean: #3d2800;
  --color-saffron: #f29e0c;
  --color-eggshell-cream: #fbf5e7;
  --color-ink-black: #000000;
  --color-sand-tint: #ece2cb;
  --color-mocha: #604106;

  --font-display: 'Space Grotesk', 'Noto Sans JP', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --font-body: 'Inter', 'Noto Sans JP', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
  --font-system: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;

  --text-micro: 10px;
  --leading-micro: 1.2;
  --tracking-micro: 0.05em;
  --text-eyebrow: 12px;
  --leading-eyebrow: 1.2;
  --tracking-eyebrow: 0.022em;
  --text-caption: 14px;
  --leading-caption: 1.41;
  --tracking-caption: -0.02em;
  --text-body-sm: 16px;
  --leading-body-sm: 1.6;
  --tracking-body-sm: -0.02em;
  --text-body: 17px;
  --leading-body: 1.6;
  --tracking-body: -0.01em;
  --text-title: 24px;
  --leading-title: 1.2;
  --tracking-title: -0.03em;
  --text-heading: clamp(40px, 6vw, 64px);
  --leading-heading: 0.95;
  --tracking-heading: -0.05em;
  --text-display: clamp(56px, 11vw, 144px);
  --leading-display: 1;
  --tracking-display: -0.06em;

  --font-weight-regular: 400;
  --font-weight-medium: 500;

  --spacing-5: 5px;
  --spacing-7: 7px;
  --spacing-8: 8px;
  --spacing-10: 10px;
  --spacing-16: 16px;
  --spacing-17: 17px;
  --spacing-23: 23px;
  --spacing-24: 24px;
  --spacing-32: 32px;
  --spacing-48: 48px;
  --spacing-57: 57px;
  --spacing-78: 78px;
  --spacing-80: 80px;
  --spacing-104: 104px;
  --spacing-112: 112px;
  --spacing-200: 200px;

  --section-gap: clamp(57px, 7vw, 78px);
  --card-padding: clamp(16px, 2vw, 24px);
  --element-gap: clamp(10px, 1.2vw, 16px);
  --page-gutter: clamp(16px, 5vw, 78px);

  --radius-cards: 0px;
  --radius-media: 0px;
  --radius-inputs: 99px;
  --radius-textarea: 24px;
  --radius-tags: 99px;
  --radius-pills: 99px;
  --radius-buttons: 99px;
  --radius-circle: 50%;

  --border-hairline: 1px solid var(--color-ink-black);
  --border-hairline-dark: 1px solid var(--color-mocha);

  --surface-hero-indigo: #27308a;
  --surface-eggshell-canvas: #fbf5e7;
  --surface-sand-tint: #ece2cb;
  --surface-coffee-band: #3d2800;

  --focus-ring: 2px solid var(--color-ink-black);
  --focus-ring-dark: 2px solid var(--color-eggshell-cream);
  --focus-offset: 3px;
}

:root:lang(ja) {
  --tracking-display: 0;
  --tracking-heading: 0;
  --tracking-title: 0;
  --tracking-caption: 0;
  --tracking-body-sm: 0;
  --tracking-body: 0;
  --leading-display: 1.15;
  --leading-heading: 1.25;
  --leading-body: 1.8;
}
```

### Fonts

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Space+Grotesk:wght@400;500&family=Noto+Sans+JP:wght@400;500&display=swap" rel="stylesheet">
```

### Tailwind v4

```css
@theme {
  --color-deep-indigo: #27308a;
  --color-coffee-bean: #3d2800;
  --color-saffron: #f29e0c;
  --color-eggshell-cream: #fbf5e7;
  --color-ink-black: #000000;
  --color-sand-tint: #ece2cb;
  --color-mocha: #604106;

  --font-display: 'Space Grotesk', 'Noto Sans JP', ui-sans-serif, system-ui, sans-serif;
  --font-body: 'Inter', 'Noto Sans JP', ui-sans-serif, system-ui, sans-serif;

  --text-micro: 10px;
  --text-eyebrow: 12px;
  --text-caption: 14px;
  --text-body-sm: 16px;
  --text-body: 17px;
  --text-title: 24px;
  --text-heading: clamp(40px, 6vw, 64px);
  --text-display: clamp(56px, 11vw, 144px);

  --radius-pill: 99px;
  --radius-textarea: 24px;
}
```
