# JadeMind Academy — Design System
> Calm jade on a night-market canvas. Serious about money, easy on beginners.

**Website:** www.jademind-academy.com
**Product:** Stock market e-learning for beginners — 10 categories, 80 courses, English and Japanese
**Theme:** dark
**Tokens file:** `variables.css` (single source of truth — this document explains how to use it)

JadeMind Academy teaches the stock market to people who have never placed a trade. The design has to do two jobs at once: look trustworthy enough for a subject about money, and feel calm enough that a beginner is not intimidated. The answer is a near-black canvas with a faint green undertone, a single jade accent that carries the brand, and a gold chart line reserved for market data. Headings use Playfair Display, a high-contrast serif that gives an editorial, "financial journal" voice; everything functional uses Inter. Market colours (gain green, loss red) are semantic only and never used as decoration, so a learner always knows that green-and-red means price movement.

## Brand Principles

1. **Clarity before luxury.** Every lesson, price and level must be readable at a glance. Contrast is never sacrificed for mood.
2. **Jade means JadeMind.** Jade is the brand accent: primary buttons, links, focus rings, progress, the Beginner level.
3. **Green and red mean the market.** Gain and loss colours appear only on price moves, charts and P&L examples.
4. **Gold is for charts.** The gold gradient belongs to chart lines and data highlights, never to buttons or text blocks.
5. **Honest teaching.** No promises of returns, no "get rich" imagery. Education, not investment advice.

## Tokens — Colors

### Surfaces

| Name | Value | Token | Role |
|------|-------|-------|------|
| Ink | `#070b0a` | `--color-ink` / `--surface-page` | Page canvas, footer — near-black with a faint jade undertone |
| Deep | `#0b1311` | `--color-deep` / `--surface-card` | Course cards, category tiles, contained blocks |
| Panel | `#111b18` | `--color-panel` / `--surface-panel` | Inputs, dropdowns, lesson reading area, curriculum list |
| Raised | `#16221f` | `--color-raised` / `--surface-raised` | Hover state of cards, active curriculum row, modals |

### Lines

| Name | Value | Token | Role |
|------|-------|-------|------|
| Line | `#1c2a26` | `--color-line` | Hairline card and table borders, dividers |
| Line Strong | `#2b3b36` | `--color-line-strong` | Input borders, icon wells, hovered card border |
| Line Muted | `#3f524c` | `--color-line-muted` | Disabled borders, chart grid lines |

### Text

| Name | Value | Token | Role |
|------|-------|-------|------|
| Faint | `#7f918b` | `--color-text-faint` | Placeholders, timestamps, fine print (passes 4.5:1 on Ink and Panel) |
| Soft | `#a3b3ad` | `--color-text-soft` | Nav links, card meta (duration, lectures), helper text |
| Muted | `#c4d0cc` | `--color-text-muted` | Secondary paragraphs, course summaries |
| Text | `#e3ebe8` | `--color-text` | Default body and lesson text |
| White | `#ffffff` | `--color-white` | Headings, prices, active nav |

### Brand

| Name | Value | Token | Role |
|------|-------|-------|------|
| Jade | `#5fb49c` | `--color-jade` | Primary button fill, links, focus ring, progress bar, Beginner badge |
| Jade Bright | `#8fd6c0` | `--color-jade-bright` | Hover state of jade elements |
| Jade Deep | `#2f7d69` | `--color-jade-deep` | Pressed state; filled backgrounds that carry white text |
| Jade Tint | `rgba(95,180,156,.12)` | `--color-jade-tint` | Selected filter, active curriculum row, info notes |
| Gold | `#d9b56a` | `--color-gold` | Chart highlights, Intermediate badge, star ratings |
| Copper | `#cc9166` | `--color-copper` | Advanced badge, category eyebrows |
| Gold Gradient | `--gradient-gold` | `--gradient-gold` | Hero chart line only |
| Jade Gradient | `--gradient-jade` | `--gradient-jade` | Progress and completion accents only |

### Market (semantic only)

| Name | Value | Token | Role |
|------|-------|-------|------|
| Gain | `#4ade80` | `--color-gain` | Rising price, bullish candle, positive P&L |
| Loss | `#f0616d` | `--color-loss` | Falling price, bearish candle, negative P&L, form errors |
| Flat | `#a3b3ad` | `--color-flat` | Unchanged price |
| Warning | `#e8b04b` | `--color-warning` | Risk notices, "not investment advice" disclaimer icon |

Each has a `-tint` token at 12% for soft backgrounds (e.g. `--color-gain-tint`).

### Skill Levels

The course data uses Beginner, Beginner to Intermediate, Intermediate and Advanced.

| Level | Colour | Tint |
|-------|--------|------|
| Beginner | `--level-beginner` (Jade) | `--level-beginner-tint` |
| Beginner to Intermediate | `--level-beginner` (Jade) | `--level-beginner-tint` |
| Intermediate | `--level-intermediate` (Gold) | `--level-intermediate-tint` |
| Advanced | `--level-advanced` (Copper) | `--level-advanced-tint` |

## Tokens — Typography

### Playfair Display — display serif · `--font-display`
- **Weights:** 400, 500, 600
- **Used for:** hero headline, section titles, course title on the detail page, large stat numbers, prices on the detail page
- **Rule:** only at 28px and above. Never for body, buttons or labels.
- **Japanese fallback:** Noto Serif JP (included in the token)

### Inter — UI and reading sans · `--font-body`
- **Weights:** 300, 400, 500, 600, 700
- **Used for:** body, lessons, nav, buttons, forms, card titles, meta, badges
- **Japanese fallback:** Noto Sans JP (included in the token)

### Mono · `--font-mono`
- Used for ticker symbols, formulas (P/E, RSI) and code in the Algo & Quantitative Trading courses.

All fonts load from Google Fonts through the `@import` at the top of `variables.css`.

### Type Scale

Sizes marked *fluid* use `clamp()` so they shrink on phones without media queries.

| Role | Family | Weight | Size | Line Height | Token |
|------|--------|--------|------|-------------|-------|
| eyebrow | Inter | 600, uppercase | 13px, +0.06em | 1.2 | `--text-eyebrow` |
| caption | Inter | 400 | 13px | 1.4 | `--text-caption` |
| small | Inter | 400–500 | 14px | 1.5 | `--text-small` |
| body | Inter | 400 | 16px | 1.6 | `--text-body` |
| reading | Inter | 400 | 18px | 1.7 | `--text-reading` |
| lead | Inter | 300–400 | 20px | 1.5 | `--text-lead` |
| subheading | Inter | 500–600 | 22px | 1.3 | `--text-subheading` |
| heading-sm | Playfair | 500 | 28–36px *fluid* | 1.2 | `--text-heading-sm` |
| heading | Playfair | 500 | 32–48px *fluid* | 1.15 | `--text-heading` |
| display | Playfair | 400 | 40–72px *fluid*, +0.01em | 1.05 | `--text-display` |

Japanese text: remove positive letter-spacing and keep line height at 1.7 or more.

## Tokens — Spacing, Shape, Layout

**Spacing scale (4px base):** 4, 8, 12, 16, 20, 24, 32, 40, 48, 64, 96, 128 → `--space-*`

| Name | Value | Token |
|------|-------|-------|
| Page max width | 1200px | `--page-max-width` |
| Reading width | 70ch | `--reading-max-width` |
| Form width | 480px | `--form-max-width` |
| Side gutter | 16px → 32px *fluid* | `--page-gutter` |
| Section gap | 64px → 128px *fluid* | `--section-gap` |
| Card padding | 24px | `--card-padding` |
| Card gap | 24px | `--card-gap` |

| Element | Radius | Token |
|---------|--------|-------|
| Buttons, inputs, badges, filter pills | 9999px | `--radius-pill` |
| Cards, lesson panels, modals | 12px | `--radius-card` |
| Tables, thumbnails, tooltips | 8px | `--radius-md` |
| Small chips, nav underline | 4px | `--radius-sm` |

**Elevation:** no drop shadows. Depth comes from surface steps (Ink → Deep → Panel → Raised) and hairline borders. `--shadow-ring` is a 1px light ring for icon wells; `--shadow-focus` is the jade focus ring for every interactive element.

**Motion:** `--transition-fast` (150ms) for hover and colour; `--transition-base` (250ms) for sliders and accordions. Respect `prefers-reduced-motion`.

## Components

### Header
Fixed bar on `--surface-page` with a bottom hairline. Logo left, category menu and pages centre, language switch (EN / JP), cart and Sign in on the right. Nav links in Soft, White when active, jade 2px underline on hover. On phones the menu collapses behind a single menu button.

### Primary Button
Jade fill, Ink text, 14–15px Inter 500, padding 12px 24px, pill radius. Hover: Jade Bright. Pressed: Jade Deep with white text. Focus: `--shadow-focus`. Use for the single most important action on a screen (Enrol, Checkout, Subscribe).

### Secondary Button
Transparent, 1px Jade border, Jade text, same size as primary. Hover: Jade Tint background. Use on course cards (Add to Cart, View Course) so a grid does not fill up with solid buttons.

### Ghost Button
Transparent, 1px Line Strong border, Text colour. For Sign in, Cancel, Previous/Next lesson.

### Category Tile
Deep surface, 12px radius, hairline border, 24px padding. Copper eyebrow with the course count ("8 courses"), category name in 22px Inter 600 White, one-line description in Soft. Hover: Raised surface and Line Strong border. Grid: 5 columns desktop, 2 tablet, 1 phone.

### Course Card
Deep surface, 12px radius, hairline border.
- Top: thumbnail at 16:9, 8px radius top corners.
- Eyebrow: category name in Copper.
- Title: 18px Inter 600 White, two lines max.
- Meta row in Soft, 14px: duration · lectures · language.
- Level badge (see below).
- Footer: price in 20px Inter 700 White (strike-through old price in Faint when discounted), Secondary Button on the right.
- Grid: 4 columns desktop, 2 tablet, 1 phone, `--card-gap` between.

### Level Badge
Pill, 12px Inter 600, padding 4px 10px, text in the level colour on its tint background. Always shows the word (Beginner / Intermediate / Advanced) — colour is never the only signal.

### Price Display (course detail)
Price in Playfair 36px White, currency symbol in Inter 20px Soft. Currency follows the visitor's selection (USD, JPY, HKD from the product data). Discount shown as a Jade Tint pill.

### Course Detail Header
Two columns on desktop, stacked on phones. Left: breadcrumbs, category eyebrow, Playfair title, summary in Muted 20px, meta row, level badge. Right: sticky Panel card with thumbnail, price, Primary Button, what's included list.

### Curriculum List
Panel surface, 12px radius. Each row: lesson number in Faint mono, title in Text, duration right-aligned in Soft, hairline divider. Current lesson row: Jade Tint background with a 3px jade left edge. Completed rows show a jade check icon.

### Progress Bar
6px tall, pill radius, track in Line, fill in `--gradient-jade`. Label above in 13px Soft ("12 of 48 lectures").

### Lesson Reading Area
Panel surface, 12px radius, 32–48px padding, text at `--text-reading` in Text colour, max width `--reading-max-width`. H2/H3 in Inter 600 White (Playfair only for the lesson title). Key terms in White 600. Formulas and tickers in mono on a Raised chip.

### Callout Notes (inside lessons)
Left border 3px + tint background, 16px padding, 8px radius:
- **Tip** — Jade
- **Example** — Gold
- **Risk** — Warning
- **Mistake to avoid** — Loss

### Market Chart Card (hero and lessons)
Deep surface, 12px radius. Line charts use `--gradient-gold` for the stroke. Candlesticks use Gain and Loss fills. Grid lines in Line Muted at 50% opacity, axis labels in Faint 12px. Always labelled "Illustrative chart" — never real live prices presented as advice.

### Stat Display
Number in Playfair 40px White, caption in 14px Soft below. Use only real figures from the database (course count, lecture count, categories).

### Forms (sign in, register, contact, checkout)
Centred column at `--form-max-width`, one field per row. Label above in 14px Inter 500 Muted. Input: Panel fill, 1px Line Strong border, pill radius, 12px 20px padding, Text colour, Faint placeholder. Focus: Jade border + `--shadow-focus`. Error: Loss border with 13px Loss message below. Submit is a full-width Primary Button.

### Newsletter Strip
Centred, Deep surface band. Heading in Playfair, one email field and one Primary Button stacked on phones.

### Disclaimer Strip
Shown in the footer and on every course detail page: Warning icon + 13px Soft text stating the content is for education only and is not investment advice. Text comes from the language file.

### Footer
Ink surface, top hairline. Columns: brand + short line, Categories, Company pages, Policies, Contact (from the database). Bottom row: copyright linking to the home page, language switch.

## Do's and Don'ts

### Do
- Use Jade for the brand and every primary interaction.
- Keep gain green and loss red strictly for market movement and errors.
- Use Playfair only at 28px and above; Inter for everything else.
- Set lesson text at 18px / 1.7 on the Panel surface, max 70ch wide.
- Show the level word on every badge, not colour alone.
- Keep every text colour at 4.5:1 contrast or better — Faint is the lowest allowed.
- Use one Primary Button per screen; use Secondary Buttons on repeated cards.
- Use the fluid tokens so hero and headings work at 360px wide.
- Test every page with Japanese text as well as English.

### Don't
- Don't use Gain green as a brand colour or on buttons — learners will read it as "price up".
- Don't use the gold gradient outside charts.
- Don't add drop shadows; use surface steps and hairlines.
- Don't use pure white for long lesson text — use Text (`#e3ebe8`).
- Don't show headlines like "guaranteed profits", "double your money" or lifestyle imagery of wealth.
- Don't copy another brand's layout, logos or product screenshots.
- Don't put two form fields side by side.

## Imagery

- Abstract, calm market visuals: simplified candlesticks, line charts, order books, drawn in the token colours.
- Category illustrations as simple line icons in Soft or Jade, 1.5px stroke, inside a 48px pill icon well with `--shadow-ring`.
- Course thumbnails: dark background, one clear chart or concept graphic, course title optional.
- Photography, if used: real learners at desks or laptops, slightly desaturated. No trading-floor clichés, cash piles, sports cars or "Lambo" imagery.

## Layout

- Max width 1200px, centred, fluid side gutter.
- **Home:** hero (headline + short subtext + Primary Button, illustrative chart card on the right; stacked on phones) → category grid (10 tiles) → featured courses → "How learning works" (3 steps) → stats from the database → newsletter → footer with disclaimer.
- **Category page:** title and description, level filter pills (All / Beginner / Intermediate / Advanced), course grid.
- **Course page:** detail header with sticky price card → what you'll learn → curriculum list → description → related courses.
- **Lesson page:** curriculum sidebar on the left (drawer on phones), reading area on the right, progress bar at top, Previous / Next ghost buttons at bottom.
- One continuous Ink canvas; sections separated by `--section-gap`, occasional Deep bands for the newsletter and stats.

## Voice and Copy

- Plain words first, jargon second: "a share is a small piece of a company" before "equity".
- Short sentences, active voice, second person.
- Every risk topic states the risk plainly.
- Buttons use verbs: "Start course", "Add to cart", "Continue lesson".
- Same meaning in English and Japanese; never machine-shorten Japanese labels to fit a design.
