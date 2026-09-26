# BizAcademys — Design System
> Boardroom greenhouse editorial

**Website:** BizAcademys — www.bizacademys.com
**Subject:** Online e-learning materials for business and marketing skills: digital marketing, sales and negotiation, entrepreneurship and business growth, personal branding and communication, social media and influencer marketing, content creation and copywriting, customer relationships and retention, e-commerce and online selling, marketing analytics and tools, career and freelancing skills
**Theme:** light

BizAcademys uses a calm, editorial look built for people who study business and marketing, not just browse it. A pale sage canvas (#eef2e3) replaces sterile SaaS white and keeps long study sessions easy on the eyes. Deep Forest (#043f2e) carries the brand: headings, dark sections and stat cards, suggesting growth, stability and money. A single Strategy Lime accent (#c8f169) marks the one action that matters on each screen. Headlines are set in Fraunces, a free serif, with tight tracking, so pages read like a business journal rather than a dashboard. Body and interface text use Inter. Depth comes from color layers (sage → paper white → forest) instead of shadows. Buttons, inputs and small controls use a 12px radius; cards, panels and large surfaces use 16px.

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

Status colors are for feedback only: quiz answers, form validation, completion states and notices. Never use them for decoration. Always pair them with an icon or a text label. Success uses a blue-leaning emerald (`#08735a`) so it never matches Forest Mid (`#2a6f2b`) or any other brand green.

| Name | Text / Border | Surface | Token prefix | Use |
|------|---------------|---------|--------------|-----|
| Success | `#08735a` | `#dff2e7` | `--color-success` | Correct answer, lesson completed, payment confirmed |
| Error | `#b3261e` | `#fbe4e2` | `--color-error` | Wrong answer, form errors, failed payment |
| Warning | `#8a5a00` | `#fbefd5` | `--color-warning` | Credits expiring, unsaved changes |
| Info | `#1f5fa8` | `#e2ecf8` | `--color-info` | Tips, notes, neutral notices |

### Data visualization

Business and marketing materials rely on charts: campaign results, conversion funnels, sales targets, audience growth, market share. Use these colors in this order for chart series only, never for interface elements.

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
| Success on Paper White | 5.7:1 | AA |
| Success on Success surface | 5.0:1 | AA |
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
| Buttons, inputs, small tags, header controls, dropdown rows | 12px | `--radius-sm` |
| Cards, images, large surfaces | 16px | `--radius-lg` |
| Pill badges, progress bars | 9999px | `--radius-pill` |

Only these three radii exist. Never use 4px, 8px or 20px.

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
Inter 500, 12–14px, uppercase, 0.06em tracking, Deep Forest. Sits 12px above a section heading. Example: "DIGITAL MARKETING".

### Primary button
Strategy Lime background, Ink Black text, Inter 500 16px, 12px 20px padding, 12px radius, no border. Hover: Lime Hover. Pressed: Lime Pressed. Disabled: Soft Line background, Muted Moss text, no pointer. Use once per screen, for the main action: "Buy Credits", "Start Learning", "Submit".

### Secondary button
Transparent, 1px Deep Forest border, Deep Forest text, same size and radius as the primary. Hover: Pale Sage fill. On Deep Forest sections: Paper White border and text.

### Text link
Deep Forest, underline 1px with 3px offset. Hover: Forest Mid.

### Logo
The logo image (`assets/images/logo.webp`) sits at the left of the header at 44px tall (34px on small phones).

### Navigation
Sticky single-row header, 72px tall (64px below 1200px). At the top of the page it is a full-width Paper White bar with a Soft Line bottom border. Once the page scrolls it turns into a floating bar: centered, page width (1200px max, 16px side gutters), 60px tall, 24px from the top, with a Soft Line border, 16px radius and a soft forest shadow. Its dropdowns then open 8px below it with all corners rounded. Logo left, links centered (Categories, About Us, Contact Us), account area right. The language control shows the flag of the current language. Links are Inter 500 15px in Deep Forest, never wrapping, with a faint forest tint on hover; the active link goes to weight 600 with a 3px Strategy Lime underline. Categories open a two-column dropdown panel ending in a Deep Forest "see all" bar. The right side holds a language and currency control, then Log In and Create Account for guests, or a Strategy Lime credits control and an avatar menu for members, then a cart button with a lime count badge. Every header control uses the 12px radius; only the count badge is a pill. Below 1200px the links move into a right-side menu sheet.

### Dropdown panel
Drops from the bottom edge of the header, attached to it: Paper White, 1px Soft Line border, 3px Strategy Lime top border, square top corners and 16px bottom corners, 16–24px padding. Floating panels are the one exception to the no-shadow rule: they carry a soft forest shadow (`0 20px 40px -12px rgba(4, 63, 46, 0.28)`) so they stand out from the page. Section labels are uppercase caption text in Muted Moss. Rows are Inter 500 14px with a Pale Sage hover; selected chips turn Strategy Lime.

### Side sheet
Menu and cart slide in from the right, up to 420px wide, over a 45% Deep Forest veil. Paper White body, a Soft Line rule under the title row, and a Pale Sage footer holding the actions.

### Material card
Paper White, 16px radius, 1px Soft Line border, no shadow. Image on top with 16px top radii, then category eyebrow, Inter 500 title at heading-sm, meta row (duration, level) in Muted Moss body-sm, and the price or credits in Deep Forest. Hover: border turns Deep Forest.

### Category card
Pale Sage, 16px radius, card padding, stroke icon in Deep Forest, Inter 500 title, one-line description in Charcoal.

### Stat card
Deep Forest background, 16px radius, Paper White figure in Fraunces 400 at heading size (36px, 28px mobile, -0.02em tracking, tabular numbers), uppercase Strategy Lime label in Inter 500 caption size above it.

### Progress bar
8px tall, pill radius, Soft Line track, Deep Forest fill. The percentage appears as text next to it in body-sm.

### Form field
Full width inside a centered form of at most 480px, strictly one field per row. Label above in Inter 500 14px, Deep Forest. Input: Paper White, 1px Soft Line border, 12px radius, 12px 16px padding, Inter 16px. Focus: Deep Forest border plus focus ring. Error: Error border, message below in Error color with an icon.

### Alert
Status surface color, 4px left border in the matching status color, 16px padding, 12px radius, icon + text. Text stays Deep Forest for readability; only the icon and border take the status color.

### Quiz option
Paper White, 1px Soft Line border, 12px radius, 16px padding. Selected: Deep Forest border. After submitting: correct turns Success surface and border with a check icon; wrong turns Error surface and border with a cross icon.

### Badge / tag
Pale Sage or Strategy Lime background, Ink Black text, Inter 500 12px, 2px 10px padding, 12px or pill radius. Examples: "Beginner", "New", "12 lessons".

### Footer
Two layers. A Paper White newsletter card (16px radius, Soft Line border, soft forest shadow) sits across the edge between the Pale Sage page and the Deep Forest footer. It holds the eyebrow, a Fraunces heading, a short lead, and an email field with the primary button beside it (stacked on phones). On wide screens a small bar chart grows beside it when it scrolls into view, with a Deep Forest trend line and a lime goal dot. The success message is a Success-surface notice with a check icon. Behind the card, a Strategy Lime sheet of the same size tilts out (about 1.6°) from under its bottom-right corner as the card scrolls into view, and a softly fading Deep Forest dot grid drifts slowly behind its top-left corner.

The Deep Forest footer has 16px top corners and three columns:
1. The logo on a Paper White tile and company details (name, email, address from the `miscs` table), each with a lime icon on a faint tile
2. Quick links
3. Policies

Column labels are uppercase lime caption text. Links are Paper White at 82% opacity, turning Strategy Lime on hover with a short lime dash sliding in. The bottom row holds the copyright line (linked to the home page) and the payment methods image on a Paper White tile. Columns fade up in sequence as they scroll into view.

### Page banner (breadcrumb)
Every inner page opens with a Deep Forest panel set 16px below the header, page width, 16px radius, at least 280px tall. No photo or video: depth comes from a soft lime glow top right, a Forest Mid glow bottom left and a faint drifting dot grid top left. The breadcrumb trail sits on a translucent glass strip (12px radius), with a home icon on the first link, small chevrons between links and the current page in Strategy Lime. The page title below it is Fraunces heading-lg in Paper White. On the right, a large faint growth chart animates on load: bars rise, a lime trend line draws in, and a lime goal dot pops, then pulses slowly. Pages without a title use a compact version with only the trail and no chart. On phones the chart shrinks behind the text.

### Notification toast
Stacked at the top right, 12px below the header (400px wide, full width on phones), sliding in from the right. Paper White card, 1px Soft Line border, 16px radius and a soft forest shadow. A 40px status tile (12px radius) holds the icon on the status surface color: a check for success, an exclamation mark for errors. Beside it sit an uppercase caption label in the status color, the message in Inter 15px Deep Forest, and a close button. Success toasts close by themselves after 5 seconds, with a lime timer bar shrinking along the bottom; hovering or focusing pauses it. Error toasts carry a 4px Error left border and stay until closed. Styles live in `public/css/style.css`.

### Cookie banner
A floating bar fixed 16px above the bottom of the screen, stretched to page width (1200px max, 16px gutters), sliding up shortly after the page loads. Paper White, 1px Soft Line border, 3px Strategy Lime top border, 16px radius and a soft forest shadow. One row: a Deep Forest icon tile with a lime cookie icon, the title (Inter 500 18px) and intro with the policy link, then Customize (text button), Only essentials (secondary) and Accept all (primary). Customize expands a panel inside the bar with one Pale Sage card per cookie category: title, a switch (Deep Forest track and lime knob when on; the essentials switch is locked), description and an expandable cookie list. Save settings sits bottom right. On tablets the actions wrap under the text; on phones everything stacks and the buttons go full width.

### Back-to-top button
Fixed bottom right, 48px, Deep Forest with a lime arrow, 12px radius. It appears after 320px of scrolling, and a lime bar along its bottom edge shows how far down the page the reader is.

### Icon
Stroke-based, 1.5–2px weight, Deep Forest stroke, no fill. Paper White on dark sections.

## Imagery

Documentary, human photography: founders at whiteboards, marketers reviewing campaign dashboards, sales conversations, creators filming or writing content, laptops showing charts. Warm, natural light. Never staged stock handshakes, never duotone or color overlays. Images sit inside 16px-radius frames. Diagrams inside materials (sales funnels, customer journeys, content calendars, SWOT grids) use the chart palette and Inter labels.

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
- Don't add box shadows to cards or buttons (only floating dropdown panels, the scrolled header, the footer newsletter card, the cookie banner and notification toasts carry a shadow)
- Don't use pure white (#ffffff) as the page background
- Don't bold Fraunces; keep Inter at 500 or below except navigation
- Don't use status colors or chart colors for decoration
- Don't mix radii beyond 12px, 16px and pill
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

The full token set lives at the top of `public/css/style.css`, followed by the base and component styles.
