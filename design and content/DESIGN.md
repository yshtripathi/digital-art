# BizAcademys — Design System
> Boardroom greenhouse editorial

**Website:** BizAcademys — www.bizacademys.com
**Subject:** Online e-learning materials for Business Planning & Strategy
**Theme:** light

BizAcademys uses a calm, editorial look built for people who study strategy, not just browse it. A pale sage canvas (#eef2e3) replaces sterile SaaS white and keeps long study sessions easy on the eyes. Deep Forest (#043f2e) carries the brand: headings, dark sections and stat cards, suggesting growth, stability and money. A single Strategy Lime accent (#c8f169) marks the one action that matters on each screen. Headlines are set in Fraunces, a free serif, with tight tracking, so pages read like a business journal rather than a dashboard. Body and interface text use Inter. Depth comes from color layers (sage → paper white → forest) instead of shadows. Buttons and inputs use a 4px radius; cards and large surfaces use 16px.

The mood is confident, warm and intellectual: business education without corporate coldness.

## Tokens — Colors

### Brand

| Name | Value | Token | Role |
|------|-------|-------|------|
| Pale Sage | `#eef2e3` | `--color-pale-sage` | Page canvas, light card surfaces, eyebrow backgrounds, image mats |
| Paper White | `#fcfcfc` | `--color-paper-white` | Elevated cards, navigation, footer, modals, lesson reading panel |
| Ink Black | `#000000` | `--color-ink-black` | Text on Strategy Lime, ghost button outlines, strong hairlines |
| Charcoal | `#242423` | `--color-charcoal` | Secondary text and icon fills |
| Muted Moss | `#4d5a52` | `--color-muted-moss` | Captions, meta text (duration, level, date), placeholder text |
| Deep Forest | `#043f2e` | `--color-deep-forest` | Brand primary: headings, body text, dark sections, stat cards, nav text |
| Forest Mid | `#2a6f2b` | `--color-forest-mid` | Hover and active state for forest surfaces, links on hover |
| Strategy Lime | `#c8f169` | `--color-strategy-lime` | Primary action fill, key highlights, badges |
| Lime Hover | `#b4e04a` | `--color-lime-hover` | Primary button hover |
| Lime Pressed | `#9fcc35` | `--color-lime-pressed` | Primary button active and pressed |
| Soft Line | `#cfd8c4` | `--color-soft-line` | Card borders, dividers, table rules, input borders at rest |

### Status

Status colors are for feedback only: quiz answers, form validation, completion states and notices. Never use them for decoration. Always pair them with an icon or a text label, because the success green sits close to the brand greens.

| Name | Text / Border | Surface | Token prefix | Use |
|------|---------------|---------|--------------|-----|
| Success | `#2a6f2b` | `#e3f0d6` | `--color-success` | Correct answer, lesson completed, payment confirmed |
| Error | `#b3261e` | `#fbe4e2` | `--color-error` | Wrong answer, form errors, failed payment |
| Warning | `#8a5a00` | `#fbefd5` | `--color-warning` | Credits expiring, unsaved changes |
| Info | `#1f5fa8` | `#e2ecf8` | `--color-info` | Tips, notes, neutral notices |

### Data visualization

Business Planning & Strategy materials rely on charts: market share, SWOT scoring, financial projections, break-even lines. Use these colors in this order for chart series only, never for interface elements.

| Order | Name | Value | Token |
|-------|------|-------|-------|
| 1 | Deep Forest | `#043f2e` | `--chart-1` |
| 2 | Vivid Green | `#78c51c` | `--chart-2` |
| 3 | Ledger Blue | `#3b6fb6` | `--chart-3` |
| 4 | Ochre | `#d39b2a` | `--chart-4` |
| 5 | Terracotta | `#c4623f` | `--chart-5` |
| 6 | Slate | `#6b7a8f` | `--chart-6` |

Gridlines use Soft Line (`#cfd8c4`); axis labels use Muted Moss (`#4d5a52`).

### Contrast (WCAG 2.1)

| Pair | Ratio | Result |
|------|-------|--------|
| Deep Forest on Pale Sage | 10.5:1 | AAA |
| Deep Forest on Paper White | 11.7:1 | AAA |
| Muted Moss on Pale Sage | 6.4:1 | AA |
| Ink Black on Strategy Lime | 16.2:1 | AAA |
| Paper White on Deep Forest | 11.7:1 | AAA |
| Error on Paper White | 6.4:1 | AA |
| Info on Paper White | 6.3:1 | AA |

## Tokens — Typography

### Fraunces — display and section headings · `--font-display`
- **Source:** Google Fonts (free, variable, optical size axis)
- **Fallback:** Source Serif 4, Georgia, serif
- **Weights:** 400 only
- **Used at:** 36px and above
- **Letter spacing:** -0.02em at 36px, -0.03em at 56px and 96px
- **Role:** Page titles, hero headlines, section headings, material titles on detail pages. Single weight: hierarchy comes from size, not boldness.

### Inter — body, lessons, interface · `--font-sans`
- **Source:** Google Fonts (free, variable)
- **Fallback:** system-ui, Segoe UI, Roboto, sans-serif
- **Weights:** 400 body, 500 headings below 36px and buttons, 600 navigation only
- **Role:** Everything below 36px: body copy, lesson text, lesson subheadings, buttons, forms, navigation, tables, captions.

### Type scale

Large sizes scale down on phones through `clamp()`.

| Role | Family | Weight | Size | Line height | Letter spacing | Token |
|------|--------|--------|------|-------------|----------------|-------|
| caption | Inter | 400 | 12px | 1.4 | 0.06em (uppercase only) | `--text-caption` |
| body-sm | Inter | 400 | 14px | 1.5 | 0 | `--text-body-sm` |
| body | Inter | 400 | 16px | 1.5 | 0 | `--text-body` |
| reading | Inter | 400 | 18px | 1.65 | 0 | `--text-reading` |
| heading-xs | Inter | 500 | 18px | 1.4 | 0 | `--text-heading-xs` |
| heading-sm | Inter | 500 | 22px | 1.3 | -0.005em | `--text-heading-sm` |
| heading | Fraunces | 400 | 36px (28px mobile) | 1.1 | -0.02em | `--text-heading` |
| heading-lg | Fraunces | 400 | 56px (36px mobile) | 1.05 | -0.03em | `--text-heading-lg` |
| display | Fraunces | 400 | 96px (48px mobile) | 0.95 | -0.03em | `--text-display` |

### Lesson content hierarchy

| Element | Style |
|---------|-------|
| Material title (h1) | heading-lg, Fraunces, Deep Forest |
| Chapter title (h2) | heading, Fraunces, Deep Forest |
| Section (h3) | heading-sm, Inter 500, Deep Forest |
| Sub-section (h4) | heading-xs, Inter 500, Deep Forest |
| Paragraphs, lists | reading, Inter 400, Deep Forest, max width 68ch |
| Key takeaway box | Pale Sage card, 4px Deep Forest left border, reading size |
| Tables (financials, comparisons) | body-sm, Inter, tabular numbers, Soft Line rules, header row on Pale Sage |

## Tokens — Spacing and shapes

**Base unit:** 4px · **Density:** comfortable

| Token | Value |
|-------|-------|
| `--spacing-4` | 4px |
| `--spacing-8` | 8px |
| `--spacing-12` | 12px |
| `--spacing-16` | 16px |
| `--spacing-20` | 20px |
| `--spacing-24` | 24px |
| `--spacing-32` | 32px |
| `--spacing-40` | 40px |
| `--spacing-56` | 56px |
| `--spacing-80` | 80px |
| `--spacing-120` | 120px |

### Border radius

| Element | Value | Token |
|---------|-------|-------|
| Buttons, inputs, small tags | 4px | `--radius-sm` |
| Cards, images, large surfaces | 16px | `--radius-lg` |
| Pill badges, progress bars | 9999px | `--radius-pill` |

Only these three radii exist. Never use 8px, 12px or 20px.

### Layout

| Token | Value | Use |
|-------|-------|-----|
| `--page-max-width` | 1200px | Site container |
| `--reading-max-width` | 68ch | Lesson text column |
| `--form-max-width` | 480px | Centered forms, one field per row |
| `--gutter` | 16px | Side padding on phones |
| `--section-gap` | clamp(56px, 8vw, 80px) | Vertical gap between page sections |
| `--card-padding` | clamp(16px, 2.5vw, 24px) | Card inner padding |
| `--element-gap` | 16px | Gap between related elements |

### Focus and motion

| Token | Value |
|-------|-------|
| `--focus-ring` | 2px solid Deep Forest, 2px offset |
| `--focus-ring-inverse` | 2px solid Strategy Lime, 2px offset (on dark sections) |
| `--transition` | 150ms ease |

Every interactive element shows the focus ring on `:focus-visible`. Respect `prefers-reduced-motion` by removing transitions.

## Components

### Display headline
Fraunces 400, display or heading-lg size, Deep Forest on sage or paper white. Never bold, never italic.

### Section heading
Fraunces 400 at 36px, -0.02em tracking. Turns Paper White on Deep Forest sections.

### Eyebrow label
Inter 500, 12–14px, uppercase, 0.06em tracking, Deep Forest. Sits 12px above a section heading. Example: "BUSINESS PLANNING".

### Primary button
Strategy Lime background, Ink Black text, Inter 500 16px, 12px 20px padding, 4px radius, no border. Hover: Lime Hover. Pressed: Lime Pressed. Disabled: Soft Line background, Muted Moss text, no pointer. Use once per screen, for the main action: "Buy Credits", "Start Learning", "Submit".

### Secondary button
Transparent, 1px Deep Forest border, Deep Forest text, same size and radius as the primary. Hover: Pale Sage fill. On Deep Forest sections: Paper White border and text.

### Text link
Deep Forest, underline 1px with 3px offset. Hover: Forest Mid.

### Navigation
Paper White bar, logo left, links centered or right. Inter 500 16px in Deep Forest; the active link goes to weight 600 with a 2px Strategy Lime underline.

### Material card
Paper White, 16px radius, 1px Soft Line border, no shadow. Image on top with 16px top radii, then category eyebrow, Inter 500 title at heading-sm, meta row (duration, level) in Muted Moss body-sm, and the price or credits in Deep Forest. Hover: border turns Deep Forest.

### Category card
Pale Sage, 16px radius, card padding, stroke icon in Deep Forest, Inter 500 title, one-line description in Charcoal.

### Stat card
Deep Forest background, 16px radius, Paper White figure in Inter 400 at 36px, uppercase Strategy Lime label in caption size above it.

### Progress bar
8px tall, pill radius, Soft Line track, Deep Forest fill. The percentage appears as text next to it in body-sm.

### Form field
Full width inside a centered form of at most 480px, strictly one field per row. Label above in Inter 500 14px, Deep Forest. Input: Paper White, 1px Soft Line border, 4px radius, 12px 16px padding, Inter 16px. Focus: Deep Forest border plus focus ring. Error: Error border, message below in Error color with an icon.

### Alert
Status surface color, 4px left border in the matching status color, 16px padding, 4px radius, icon + text. Text stays Deep Forest for readability; only the icon and border take the status color.

### Quiz option
Paper White, 1px Soft Line border, 4px radius, 16px padding. Selected: Deep Forest border. After submitting: correct turns Success surface and border with a check icon; wrong turns Error surface and border with a cross icon.

### Badge / tag
Pale Sage or Strategy Lime background, Ink Black text, Inter 500 12px, 2px 10px padding, 4px or pill radius. Examples: "Beginner", "New", "12 lessons".

### Footer
Deep Forest background, Paper White text, Strategy Lime for link hover. Copyright line links to the home page.

### Icon
Stroke-based, 1.5–2px weight, Deep Forest stroke, no fill. Paper White on dark sections.

## Imagery

Documentary, human photography: founders at whiteboards, teams around a planning table, notebooks with sketched plans, laptops showing charts. Warm, natural light. Never staged stock handshakes, never duotone or color overlays. Images sit inside 16px-radius frames. Diagrams inside materials (SWOT grids, business model canvases, funnels) use the chart palette and Inter labels.

## Do

- Use Deep Forest for body text on Pale Sage and Paper White
- Use Fraunces for headings at 36px and above; Inter for everything below
- Use the reading size (18px, 1.65 line height, 68ch) for lesson content
- Keep Strategy Lime for one primary action per screen
- Layer sage → paper white → forest for depth instead of shadows
- Pair every status color with an icon or label
- Show a visible focus ring on every interactive element
- Use tabular numbers (`font-variant-numeric: tabular-nums`) in financial tables

## Don't

- Don't use Inter for headlines above 36px or Fraunces below 36px
- Don't add box shadows to cards or buttons
- Don't use pure white (#ffffff) as the page background
- Don't bold Fraunces; keep Inter at 500 or below except navigation
- Don't use status colors or chart colors for decoration
- Don't mix radii beyond 4px, 16px and pill
- Don't put white text on Strategy Lime, or black text on Forest Mid

## Surfaces

| Level | Name | Value | Purpose |
|-------|------|-------|---------|
| 0 | Sage Canvas | `#eef2e3` | Page background |
| 1 | Paper White | `#fcfcfc` | Cards, navigation, modals, lesson reading panel |
| 2 | Strategy Lime | `#c8f169` | Primary actions, badges, highlights |
| 3 | Deep Forest | `#043f2e` | Dark sections, stat cards, footer |

## Fonts

Load from Google Fonts:

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
```

The full token set is in `variables.css`.
