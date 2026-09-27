# StraitsChain Edu — Style Reference
> A deep-water chart room for learning crypto: a dark navy canvas where a single cyan signal guides the reader through every lesson.

**Website:** www.straitschainedu.com
**Subject:** Cryptocurrency investing e-learning
**Theme:** dark

StraitsChain Edu uses a calm, deep-sea visual language: a near-black navy canvas, one electric cyan accent, and flat cards defined by thin borders instead of shadows. The look signals "crypto" to the audience while staying quiet enough for long reading sessions. Typography is Open Sans throughout, with tight tracking on large headings only; body text keeps normal spacing so lessons stay easy to read. Components are few and simple: pill buttons, bordered course cards, centered single-column forms, and a lesson layout sized for comfortable reading.

The site teaches; it does not trade. No component displays returns, yields, profit claims or live investment offers.

All tokens live in `variables.css`.

## Tokens — Colors

### Brand and surfaces

| Name | Value | Token | Role |
|------|-------|-------|------|
| Abyss Navy | `#17202e` | `--color-abyss-navy` | Page canvas and input backgrounds |
| Tide Card | `#202a3e` | `--color-tide-card` | Course cards, tiles, panels — one step lighter than the canvas |
| Deep Panel | `#1a2638` | `--color-deep-panel` | Header, footer, disclaimer strip, alternating section bands |
| Reef Border | `#2c3850` | `--color-reef-border` | Card borders, input borders, dividers |
| Spectral Cyan | `#6ae4ff` | `--color-spectral-cyan` | Hero highlight word, links, ghost button borders, focus rings, icons |
| Bone White | `#ffffff` | `--color-bone-white` | Headings, primary text, filled primary buttons |
| Ink Black | `#0b1019` | `--color-ink-black` | Text on white filled buttons and active tabs |
| Fog Gray | `#cdd0d6` | `--color-fog-gray` | Body copy and secondary text |
| Slate Muted | `#8a93a6` | `--color-slate-muted` | Captions, placeholders, meta text (course duration, dates) |

### Status

| Name | Value | Token | Role |
|------|-------|-------|------|
| Success | `#34edb3` | `--color-success` | Form success, completed lessons, correct quiz answers |
| Error | `#ff6b6b` | `--color-error` | Form errors, wrong quiz answers |
| Warning | `#ffc857` | `--color-warning` | Risk notes inside lessons, pending states |
| Info | `#6ae4ff` | `--color-info` | Tips and neutral notices |
| Price Up | `#34edb3` | `--color-price-up` | Rising values in lesson examples and charts |
| Price Down | `#ff6b6b` | `--color-price-down` | Falling values in lesson examples and charts |

Each status colour has a `-soft` token (12% opacity) used as the background of alerts and notes. Status colours are used only for status: never for decoration, headings or buttons.

### Gradients

| Name | Token | Role |
|------|-------|------|
| Horizon Glow | `--gradient-horizon-glow` | Radial blue bloom from the upper-left, behind the home hero and page headers only |
| Signal | `--gradient-signal` | Teal-to-cyan sweep for progress bar fills and 2px accent lines only |

### Contrast (on Abyss Navy `#17202e`)

| Colour | Ratio | Level |
|--------|-------|-------|
| Bone White | 16.4 : 1 | AAA |
| Fog Gray | 10.6 : 1 | AAA |
| Spectral Cyan | 11.0 : 1 | AAA |
| Slate Muted | 5.3 : 1 | AA |
| Error | 5.9 : 1 | AA |
| Ink Black on Bone White | 19.1 : 1 | AAA |

## Tokens — Typography

### Open Sans · `--font-display`
Primary typeface for headings, body, navigation and buttons.
- **Weights:** 400 body, 600 labels and buttons, 700 headings
- **Tracking:** `-0.036em` on display, `-0.02em` on headings 28px and up, `normal` on everything smaller

### Source Sans 3 · `--font-data`
Secondary typeface for tables, figures in lesson examples, badges and small labels only. Never mixed with Open Sans on the same line.
- **Weights:** 400, 600

### Type Scale

| Role | Size | Line Height | Tracking | Token |
|------|------|-------------|----------|-------|
| caption | 12px | 1.4 | normal | `--text-caption` |
| body-sm | 14px | 1.5 | normal | `--text-body-sm` |
| body | 16px | 1.65 | normal | `--text-body` |
| body-lg | 18px | 1.7 | normal | `--text-body-lg` |
| subheading | 22px | 1.36 | normal | `--text-subheading` |
| heading-sm | 28px | 1.25 | -0.02em | `--text-heading-sm` |
| heading | 28–36px | 1.2 | -0.02em | `--text-heading` |
| heading-lg | 34–56px | 1.15 | -0.02em | `--text-heading-lg` |
| display | 40–88px | 1.05 | -0.036em | `--text-display` |

Heading and display sizes use `clamp()` so they scale down on phones without extra media queries.

## Tokens — Spacing & Shapes

**Base unit:** 4px

### Spacing Scale
`4 · 8 · 12 · 16 · 20 · 24 · 32 · 40 · 60 · 80 · 120` — tokens `--spacing-4` to `--spacing-120`.

### Border Radius

| Element | Value | Token |
|---------|-------|-------|
| inputs | 8px | `--radius-inputs` |
| links | 8px | `--radius-links` |
| cards | 15px | `--radius-cards` |
| panels | 24px | `--radius-panels` |
| buttons | 80px | `--radius-buttons` |
| badges | 80px | `--radius-badges` |

### Layout

| Property | Value | Token |
|----------|-------|-------|
| Page max-width | 1200px | `--page-max-width` |
| Reading max-width | 720px | `--reading-max-width` |
| Form max-width | 480px | `--form-max-width` |
| Side gutter | 16px | `--page-gutter` |
| Section gap | 48–80px | `--section-gap` |
| Card padding | 24px | `--card-padding` |
| Element gap | 16px | `--element-gap` |

## Components

### Navigation Header
`--color-deep-panel` background, 72px height. Logo left, links centered in 14px Open Sans 400 Fog Gray (Bone White on hover and for the current page), one filled pill button right. On phones the links collapse into a simple toggle menu.

### Pill Button (Primary)
Bone White fill, Ink Black text, 14px Open Sans 600, 12px 24px padding, 80px radius. One primary button per section.

### Ghost Button (Secondary)
Transparent fill, 1px Spectral Cyan border, Spectral Cyan text, 14px Open Sans 600, 12px 24px padding, 80px radius. Sits beside a primary button as the secondary action.

### Text Link
Spectral Cyan, no underline by default, underline on hover and focus.

### Course Card
Tide Card background, `--border-hairline`, 15px radius, 24px padding, no shadow.
- Top: category badge
- Title: 20px Open Sans 700 Bone White, two lines max
- Summary: 14px Fog Gray, three lines max
- Meta row: level, number of lessons and duration in 12px Source Sans 3 Slate Muted
- Bottom: ghost button "View course"

Hover changes the border to Spectral Cyan. Cards sit in a 3-column grid that wraps to 2 and then 1.

### Category Badge
80px radius, 1px Spectral Cyan border, transparent fill, 12px Source Sans 3 600 Spectral Cyan text, 4px 12px padding.

### Tab Pill (Course Filter)
Active: Bone White fill, Ink Black text, Open Sans 600. Inactive: transparent, Fog Gray text, Open Sans 400. 80px radius, 8px 20px padding. Row scrolls horizontally on phones.

### Form
Centered, max-width 480px, inside a Tide Card panel with 24px radius and 32px padding. Strictly one field per row.
- **Label:** 14px Open Sans 600 Bone White, 8px above the field
- **Input / textarea / select:** Abyss Navy background, `--border-hairline`, 8px radius, 12px 16px padding, 16px Bone White text, Slate Muted placeholder
- **Focus:** border becomes Spectral Cyan
- **Error:** border becomes Error, message in 12px Error below the field
- **Submit:** full-width primary pill button

### Alert
16px padding, 8px radius, 1px border and `-soft` background in the matching status colour, 14px Bone White text. Used for form results and account notices.

### Lesson Page
- Breadcrumb at top
- Title in heading-lg, meta line in Slate Muted
- Body limited to `--reading-max-width`, 16–18px Fog Gray, 1.65–1.7 line height
- `h2` in heading-sm Bone White with 40px space above
- Lists with 8px gap between items
- Tables in Source Sans 3 with Reef Border row lines; price columns use Price Up / Price Down
- Lesson notes use the Alert style: Info for tips, Warning for risk points
- Previous / next lesson buttons at the bottom

### Progress Bar
8px high, Tide Card track, Signal gradient fill, 80px radius. Label above in 12px Slate Muted.

### Breadcrumb
12px Open Sans, Slate Muted items, `/` separators, current page in Fog Gray, links in Spectral Cyan.

### Stat Block
Centered, no card. Number in heading-lg Open Sans 700 Bone White, label beneath in 14px Fog Gray. Numbers come from the database (courses, lessons, categories) and never show returns or earnings.

### Risk Disclaimer Strip
Full-width Deep Panel band above the footer, 14px Slate Muted text, centered. States that the content is for education only and is not financial advice.

### Footer
Deep Panel background, Reef Border top line, 60px vertical padding. Columns for links, company details (from the database) and the newsletter form (one field + button). Copyright line at the bottom in 12px Slate Muted, with the site name linking to the home page.

## Do's and Don'ts

### Do
- Use the 80px pill radius on every button, tab and badge
- Keep cards on Tide Card with a Reef Border hairline; define depth with borders, not shadows
- Keep Spectral Cyan for links, highlight words, ghost borders, focus rings and icons
- Keep lesson text at normal letter-spacing and within 720px width
- Use the Horizon Glow only behind hero and page-header areas
- Keep forms centered with exactly one field per row
- Show a visible cyan focus state on every interactive element

### Don't
- Don't show yields, APY, returns, profit figures or "earn" promises anywhere
- Don't add new accent hues; status colours are for status only
- Don't fill large areas with cyan or the Signal gradient
- Don't use shadows, glows or blur on cards
- Don't put dark text on the dark canvas
- Don't use light surfaces for cards or panels; the only white surface is the primary button
- Don't use third-party exchange or token logos as decoration

## Surfaces

| Level | Name | Token | Purpose |
|-------|------|-------|---------|
| 0 | Canvas | `--surface-canvas` | Page background, input fields |
| 1 | Panel | `--surface-panel` | Header, footer, disclaimer strip, section bands |
| 2 | Card | `--surface-card` | Course cards, form panels, tiles |
| 3 | Action | `--surface-action` | Primary buttons and active tabs only |

## Imagery

Imagery stays minimal. Use simple line icons in Spectral Cyan (24–48px) for categories and features, and lesson diagrams drawn in the brand palette (navy background, cyan lines, Price Up / Price Down for movement). Course thumbnails, if used, sit inside cards with a 15px radius and a dark overlay so text stays readable. No stock photos of traders, cash or coins.

## Layout

Centered single column with a 1200px max-width and a 16px side gutter on phones. The home page runs: header, hero on the Horizon Glow with a display headline (one word in Spectral Cyan) and a button pair, course category tabs over a course card grid, stat blocks, the disclaimer strip, and the footer. Inner pages use a smaller page header with the breadcrumb and heading-lg title, then content. There is no horizontal scrolling at any width except the tab row.

## Agent Prompt Guide

**Quick Colour Reference**
- background: `#17202e`
- panel: `#1a2638`
- card: `#202a3e`
- border: `#2c3850`
- accent: `#6ae4ff`
- heading text: `#ffffff`
- body text: `#cdd0d6`
- muted text: `#8a93a6`
- button text on white: `#0b1019`
- success / up: `#34edb3`
- error / down: `#ff6b6b`
- warning: `#ffc857`

**Example Component Prompts**

1. Hero: `#17202e` base with `--gradient-horizon-glow` from the upper-left. Centered display headline in Open Sans 700 white, tracking -0.036em, one word in `#6ae4ff`. Below it a white pill button and a cyan ghost pill button side by side.

2. Course card: `#202a3e` background, 1px `#2c3850` border, 15px radius, 24px padding. Cyan outlined category badge, 20px white title, 14px `#cdd0d6` summary, 12px `#8a93a6` meta row in Source Sans 3, ghost "View course" button. Border turns cyan on hover.

3. Contact form: centered 480px `#202a3e` panel, 24px radius, 32px padding. One field per row: 14px white label, input on `#17202e` with 1px `#2c3850` border and 8px radius, cyan border on focus. Full-width white pill submit button.

4. Lesson body: 720px column, 17px `#cdd0d6` text at 1.7 line height, white `h2` headings, warning note box with `rgba(255, 200, 87, 0.12)` background and `#ffc857` border.
