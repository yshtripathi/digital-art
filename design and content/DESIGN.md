# [Website Name] — Style Reference
> Editorial posters for learning. A full-bleed color-block e-learning site where lime headlines sit on cobalt walls, white course cards float over bone-canvas pages, and pill-shaped navs glide across maroon fields.

**Theme:** mixed

[Website Name] keeps a full-volume color-block voice for its marketing pages — each homepage section is a saturated wall of lime, cobalt, or maroon — while the pages where people actually learn and buy (catalog, course detail, dashboard, cart, checkout) sit on calm Bone Canvas with white course cards. A recurring chartreuse green is the brand's single action accent. Typography is one geometric sans (Inter) set extra-bold with tight negative tracking at display sizes, giving headlines a compressed, poster-like weight. Shapes are rounded: nav bars and buttons are pills, cards are soft lozenges, and only form inputs keep a modest 8px corner. The result reads as bold editorial spreads for marketing and clear, scannable cards for learning.

## Tokens — Colors

| Name | Value | Token | Role |
|------|-------|-------|------|
| Voltage Lime | `#d2e823` | `--color-voltage-lime` | Primary action buttons ("Enroll", "Add to cart", "Top up"), highlighted headlines, accent surfaces — always with Midnight Ink text (11.44:1) |
| Cobalt Signal | `#2665d6` | `--color-cobalt-signal` | Full-bleed section backgrounds (categories, learning paths), link accents — white text 5.36:1 |
| Bordeaux Maroon | `#780016` | `--color-bordeaux-maroon` | Full-bleed FAQ and deep sections — white text 11.6:1, Lilac Whisper 7.28:1 |
| Midnight Ink | `#1e2330` | `--color-midnight-ink` | Primary text, icon fills, dark UI outlines — 14.12:1 on Bone Canvas |
| Plaster White | `#ffffff` | `--color-plaster-white` | Course cards, button text, pill nav background |
| Bone Canvas | `#f3f3f1` | `--color-bone-canvas` | Page background for catalog, course detail, dashboard, cart and checkout |
| Cement Gray | `#adadad` | `--color-cement-gray` | Muted card backgrounds, disabled surfaces — background only, never text |
| Slate Mute | `#676b5f` | `--color-slate-mute` | Secondary text: duration, lesson count, meta — 5.46:1 on white |
| Carbon | `#222222` | `--color-carbon` | Deep button text and borders for inverted controls |
| Lilac Whisper | `#e9c0e9` | `--color-lilac-whisper` | Decorative borders, soft accent washes, Expert level tag |
| Indigo Abyss | `#061492` | `--color-indigo-abyss` | Deep card surfaces, Advanced level tag — white text 13.79:1 |
| Forest Depth | `#254f1a` | `--color-forest-depth` | Bordered cards, Beginner level tag — white text 9.49:1 |
| Saffron | `#d6a337` | `--color-saffron` | Card accent backgrounds, star ratings, "Most popular" badge — Midnight Ink text 6.84:1 |
| Success *(new)* | `#1f7a3a` | `--color-success` | Completed lessons, payment success — 5.38:1 on white |
| Error *(new)* | `#c0262d` | `--color-error` | Form errors, payment failed — 5.9:1 on white |
| Progress Track *(new)* | `#e4e4df` | `--color-progress-track` | Unfilled part of progress bars |

**Contrast rules (checked)**
- Lime is a background or a headline colour on dark/blue — never text on white or Bone Canvas (1.37:1).
- Lime on Cobalt is 3.91:1: use it only for bold headlines 24px and up; body text on Cobalt is white.
- Cement Gray and Saffron are backgrounds and icons, not text colours on light surfaces.

## Tokens — Typography

### Inter — Primary brand typeface · `--font-primary`
- **Fallback:** system-ui, Noto Sans JP (Japanese)
- **Weights:** 400, 500, 700, 800
- **Sizes:** 12px, 14px, 16px, 18px, 20px, 24px, 28px, 51px, 56px, 80px
- **Line height:** 1.0–1.5
- **Letter spacing:** -0.043em at 80px, -0.024em at 56px, -0.020em at 24–28px, -0.010em at 16px, normal at 12–14px
- **Role:** Used everywhere from nav to 80px display headlines. Weight 700–800 at large sizes with negative letter-spacing creates the compressed, poster-like headline voice.

### Arial — System fallback only · `--font-arial`
- **Weights:** 400
- **Role:** Fallback rendering only; not a designed choice.

### Type Scale

| Role | Size | Line Height | Letter Spacing | Token |
|------|------|-------------|----------------|-------|
| caption | 12px | 1.5 | — | `--text-caption` |
| body-sm | 14px | 1.5 | -0.28px | `--text-body-sm` |
| body | 16px | 1.5 | -0.16px | `--text-body` |
| subheading | 20px | 1.31 | -0.4px | `--text-subheading` |
| heading-sm | 24px | 1.2 | -0.48px | `--text-heading-sm` |
| heading | 28px | 1.2 | -0.56px | `--text-heading` |
| heading-lg | 51px | 1.06 | -1.22px | `--text-heading-lg` |
| display-alt | 56px | 1.06 | -1.34px | `--text-display-alt` |
| display | 80px | 1 | -3.44px | `--text-display` |

On mobile, display sizes step down: 80px → 44px, 56px → 36px, 51px → 32px.

## Tokens — Spacing & Shapes

**Density:** comfortable

### Spacing Scale

| Name | Value | Token |
|------|-------|-------|
| 4 | 4px | `--spacing-4` |
| 8 | 8px | `--spacing-8` |
| 10 | 10px | `--spacing-10` |
| 14 | 14px | `--spacing-14` |
| 16 | 16px | `--spacing-16` |
| 18 | 18px | `--spacing-18` |
| 20 | 20px | `--spacing-20` |
| 22 | 22px | `--spacing-22` |
| 24 | 24px | `--spacing-24` |
| 26 | 26px | `--spacing-26` |
| 40 | 40px | `--spacing-40` |
| 48 | 48px | `--spacing-48` |
| 64 | 64px | `--spacing-64` |
| 65 | 65px | `--spacing-65` |
| 128 | 128px | `--spacing-128` |
| 216 | 216px | `--spacing-216` |

### Border Radius

| Element | Value |
|---------|-------|
| nav | 1000px |
| tags | 9999px |
| feature cards | 32px |
| course cards | 24px |
| thumbnails / accordion rows | 16px |
| pills | 1000px |
| inputs | 8px |
| buttons | 9999px |

### Layout

- **Page max-width:** 1280px
- **Section gap:** 80px (48px on mobile)
- **Card padding:** 24px
- **Element gap:** 16px

## Components

### Floating Pill Navigation
**Role:** Primary site navigation

White rounded pill floating over the first section. Background #ffffff, radius 1000px, height ~64px, horizontal padding ~32px. Logo on left in Midnight Ink (#1e2330). Links: Courses · Categories · About · Contact in 14–15px Inter 500. Right side: EN/JA switcher, credits balance chip, cart icon with count, ghost "Log in" + filled black "Sign up" (#000000, white text, 9999px radius). On mobile collapses to logo + hamburger drawer.

### Lime Primary Button
**Role:** Main call-to-action

Filled chartreuse button. Background #d2e823, text #1e2330, radius 9999px, padding 18px 22px, Inter 700 at 16px. Used for "Enroll now", "Add to cart", "Top up credits". Hover darkens to #b8c91b. Focus: `--focus-ring`.

### Black Sign-Up Button
**Role:** Secondary action

Background #000000, text #ffffff, radius 9999px, padding 12px 20px, Inter 500 at 14–15px. Used in the nav and as the secondary button on course cards.

### Ghost Text Button
**Role:** Tertiary inline action

Text-only, #1e2330, Inter 500 at 14–15px. Used for "Log in", "View curriculum". Hover adds underline.

### Course Card *(new)*
**Role:** Course in catalog and homepage grids

White card on Bone Canvas, radius 24px, padding 16px, no shadow — 1px #e4e4df border, hover border #1e2330. 16:9 thumbnail radius 16px. Category eyebrow 12px Inter 700 uppercase in Slate Mute. Title 20px Inter 700, max 2 lines. Meta row: level tag · duration · lessons (14px Slate Mute). Star rating in Saffron. Footer: price in credits (24px Inter 700) + lime "Enroll" pill.

### Level Tag *(new)*
**Role:** Course difficulty

Pill, 12px Inter 700, padding 4px 10px. Beginner → Forest Depth bg / white · Intermediate → Cobalt bg / white · Advanced → Indigo Abyss bg / white · Expert → Lilac Whisper bg / Midnight Ink.

### Course Detail Hero *(new)*
**Role:** Top of a course page

Full-bleed Cobalt band: breadcrumb and 51px white title, short promise, rating, level tag, duration. Right column: sticky white purchase card (radius 32px, padding 24px) with level selector, credits price, lime "Add to cart" and black "Buy credits".

### Curriculum Accordion Row *(new)*
**Role:** Modules and lessons

White row on Bone Canvas, radius 16px, padding 20px, 1px #e4e4df border. Module title Inter 700 18px; lessons list with play/lock icon, title (16px 500) and duration (14px Slate Mute). Chevron rotates 180° on expand.

### Progress Bar *(new)*
**Role:** Learner progress in dashboard

8px tall, radius 9999px, track #e4e4df, fill Voltage Lime with a 1px Midnight Ink outline, % label in 14px Inter 700.

### Credits Pricing Card *(new)*
**Role:** Top-up bundles

White card radius 32px, padding 32px. Credits amount 56px Inter 800, price in 16px Slate Mute, lime "Top up" button. Recommended bundle sits on a Saffron card with a black "Most popular" pill.

### Dark Outlined Card
**Role:** Feature or FAQ card

Background #780016 (maroon) or #061492, text #ffffff, radius 32px, padding 24px. Thin 1px border in #e9c0e9 or #254f1a. Used for FAQ items and "Why [Website Name]" feature blocks.

### Bordered Accent Card
**Role:** Highlighted content block

Border 2px in #e9c0e9 (pink) or #254f1a (forest), radius 32px, padding 24–32px, background #ffffff or section color. Used for "What you'll learn" and certificate callouts.

### Text Input Field
**Role:** Form input

Full border 1px #676b5f, radius 8px, padding 12px 16px, min height 44px. Label above in 14px Inter 500. Placeholder #676b5f. Focus border #1e2330 + `--focus-ring`. Error: border and message in #c0262d.

### Section Heading Block
**Role:** Display headline

80px or 56px Inter 800, letter-spacing -0.043em or -0.024em, line-height 1.0–1.06. Color matches section: Midnight Ink on lime, Voltage Lime on blue, Lilac Whisper on maroon. Word-wraps in 2-line editorial stacks.

### Course Search Group *(replaces Handle Input Group)*
**Role:** Hero search

White pill container with a search icon, text input ("What do you want to learn?") and a lime "Search" button on the right. Sits under the homepage headline.

### FAQ Accordion Row
**Role:** Expandable question item

Full-width row inside maroon section. Background slightly lighter maroon, radius 16px, padding 20–24px. Question in #ffffff Inter 500 at 16–18px. White chevron rotates 180° on expand. Optional 1px Lilac Whisper border.

### Top Banner Strip
**Role:** Promotional announcement bar

Full-width strip above the nav. Background Voltage Lime, text #1e2330 in Inter 500 at 13–14px ("Get bonus credits on top-ups over $500"). Close (×) button on the right.

## Do's and Don'ts

### Do
- Use Voltage Lime (#d2e823) as the single primary action color; always with Midnight Ink text
- Set display headlines at 56–80px Inter 800 with negative letter-spacing (-0.024em to -0.043em)
- Use full-bleed color sections on Home, About and course detail hero; keep catalog, dashboard, cart and checkout on Bone Canvas with white cards
- Use pill radius (9999px) for all buttons and tags; 8px only for inputs
- Show level, duration, lessons and credits price on every course card
- Give every clickable element a visible focus ring (`--focus-ring`)
- Pair each section's background with one contrasting text color — Midnight Ink on lime, white (or large lime headlines) on blue, Lilac Whisper on maroon

### Don't
- Don't use box-shadow for depth — separation comes from color contrast and 1px borders
- Don't use lime as text on white or Bone Canvas, or Cement Gray / Saffron as text
- Don't use CTA colors other than #d2e823 — avoid blue, maroon, or pink buttons
- Don't apply tight negative letter-spacing below 18px
- Don't put loud color bands inside dashboard, cart or checkout flows
- Don't center body paragraphs — left-aligned, max ~520px measure
- Don't use square or small-radius buttons
- Don't add gradients to backgrounds, buttons, or text

## Surfaces

| Level | Name | Value | Purpose |
|-------|------|-------|---------|
| 0 | Bone Canvas | `#f3f3f1` | Base page background (catalog, dashboard, checkout) |
| 1 | Plaster White | `#ffffff` | Pill nav, course cards, inputs |
| 2 | Color Section Band | `#d2e823` | Hero and call-to-action bands |
| 3 | Color Section Band Alt | `#2665d6` | Categories, learning paths, course detail hero |
| 4 | Deep Section Band | `#780016` | FAQ and footer depth sections |
| 5 | Cement Overlay | `#adadad` | Muted overlays and disabled cards |

## Elevation

The system avoids drop shadows. Depth comes from full-bleed color contrast — a white pill nav on a lime field, a white course card on Bone Canvas with a 1px border, a maroon card on a slightly lighter maroon. No box-shadow, no blur, no glow.

## Imagery

Photography is candid and professional: real people planning, presenting and collaborating in modern workplaces, natural light, medium distance. Subjects sit in contained rounded frames beside text, never full-bleed. Course thumbnails follow one 16:9 template: section-color background, short course title, category icon. Iconography is minimal outlined glyphs in Midnight Ink or Lilac Whisper. Always provide localized `alt` text.

## Layout

Full-bleed color sections stacked vertically on the homepage (lime hero → cobalt categories → white featured courses → maroon FAQ). Inside each band, a max-width 1280px centered column. Hero is a 2-column split: oversized headline, supporting paragraph and course search on the left; a contained learner photo on the right. Catalog is a filter sidebar + 3/2/1-column course card grid on Bone Canvas. Course detail is a cobalt hero with a sticky purchase card, then curriculum and FAQ. Vertical rhythm is 80px desktop / 48px mobile with hard color cuts between sections.

## Agent Prompt Guide

Quick Color Reference:
- text: #1e2330 (Midnight Ink)
- secondary text: #676b5f (Slate Mute)
- background: #f3f3f1 (Bone Canvas) for learning pages, or section-specific full-bleed colors
- surface/card: #ffffff (Plaster White)
- border: #e4e4df for cards, #e9c0e9 (Lilac Whisper) for decorative outlines
- accent / primary action: #d2e823 (Voltage Lime) with #1e2330 text
- success / error: #1f7a3a / #c0262d

Example Component Prompts:

1. Create a Primary Action Button: #d2e823 background, #1e2330 text, 9999px radius, 18px 22px padding, Inter 700 16px. Label "Enroll now".

2. Create a floating white pill navigation: #ffffff background, 1000px radius, ~64px height, 32px horizontal padding. Left: "[Website Name]" wordmark in 20px Inter 700, #1e2330. Center: Courses, Categories, About, Contact in 14px Inter 500. Right: EN/JA switcher, cart icon, ghost "Log in" + black "Sign up" pill.

3. Create a course card: white, 24px radius, 1px #e4e4df border, 16px padding. 16:9 thumbnail with 16px radius, uppercase category eyebrow in #676b5f, 20px Inter 700 title (2 lines max), meta row with a Forest Depth "Beginner" pill, "6h 30m · 24 lessons", Saffron stars, footer with "450 credits" in 24px Inter 700 and a lime "Enroll" pill.

4. Create a maroon FAQ section: full-bleed #780016. Centered headline "Questions? Answered" in 56px Inter 800, color #e9c0e9, letter-spacing -1.34px. Below: 4 accordion rows, slightly lighter maroon, 16px radius, 20–24px padding, 1px #e9c0e9 border, white 18px question text, white chevron.

5. Create a top announcement banner: full-width, #d2e823, padding 12px 16px. Centered 13px Inter 500 text in #1e2330: "Get **bonus credits** on top-ups over $500", × close on the right.

## Type System Rules

Inter is the only designed typeface (Noto Sans JP covers Japanese). Display sizes (51–80px) use weight 800 with -0.024em to -0.043em letter-spacing; subheadings (20–28px) use 700 with -0.013em to -0.020em; body (14–18px) uses 400–500 with -0.010em to normal tracking. Never below 12px. Line-heights collapse at display sizes (1.0–1.06) and breathe at body sizes (1.31–1.50).

## Section Color Rotation

Marketing pages cycle lime → blue → maroon with neutral white/Bone Canvas sections between. Each section pairs its background with one text accent: Midnight Ink on lime, white (large lime headlines) on blue, Lilac Whisper on maroon. Learning and purchase pages stay on Bone Canvas.

## Similar Brands

- **Duolingo** — Saturated color sections, a single lime-green action accent and pill CTAs for learning
- **Skillshare** — Bold marketing bands with calm, card-based course browsing
- **Headspace** — Flat color bands, playful rounded shapes, one warm accent
- **Masterclass** — Editorial, oversized headlines over course imagery
- **Loom** — Vivid full-bleed sections with pill navigation

## Quick Start

### CSS Custom Properties

See `variables.css` in this folder for the full `:root` block (colors, learning states, typography, spacing, radii, focus ring, surfaces).

### Tailwind v4

```css
@theme {
  /* Colors */
  --color-voltage-lime: #d2e823;
  --color-cobalt-signal: #2665d6;
  --color-bordeaux-maroon: #780016;
  --color-midnight-ink: #1e2330;
  --color-plaster-white: #ffffff;
  --color-bone-canvas: #f3f3f1;
  --color-cement-gray: #adadad;
  --color-slate-mute: #676b5f;
  --color-carbon: #222222;
  --color-lilac-whisper: #e9c0e9;
  --color-indigo-abyss: #061492;
  --color-forest-depth: #254f1a;
  --color-saffron: #d6a337;
  --color-success: #1f7a3a;
  --color-error: #c0262d;
  --color-progress-track: #e4e4df;

  /* Typography */
  --font-primary: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Noto Sans JP", sans-serif;

  /* Typography — Scale */
  --text-caption: 12px;
  --text-body-sm: 14px;
  --text-body: 16px;
  --text-subheading: 20px;
  --text-heading-sm: 24px;
  --text-heading: 28px;
  --text-heading-lg: 51px;
  --text-display-alt: 56px;
  --text-display: 80px;

  /* Border Radius */
  --radius-lg: 8px;
  --radius-2xl: 16px;
  --radius-3xl: 28px;
  --radius-3xl-2: 32px;
  --radius-3xl-3: 40px;
  --radius-full: 64px;
  --radius-full-2: 99px;
  --radius-full-3: 1000px;
}
```
