# Academy — E-Learning Style Reference
> A bright studio wall. White surfaces, hairline rules, and one electric magenta marking every action and every step forward.

**Theme:** light (single theme — there is no dark variant)

This reference governs the learner-facing frontend of the credit-based art-courses platform. It is the written companion to `variables.css`, which holds the runnable token set.

The system keeps the magenta character of the original reference and rebuilds everything around it for reading and for progress. The canvas is white, surfaces separate through hairline borders and very soft shadows, and course artwork carries the only competing colour. Magenta is the single accent and it does informational work rather than decoration: it marks the primary action, the lesson a learner is currently on, and the filled portion of every progress bar. Green, amber and rose appear only to report state. Lesson prose sits in a serif at a measured width. Corners are soft, motion is short, and nothing shouts except the primary button.

## The magenta problem, and how this system solves it

`#f50db4` is the brand colour, and on white it measures 3.75:1. That is below the 4.5:1 that WCAG AA requires for text, and it is also below 4.5:1 for white text placed on top of it. Used naively it fails twice.

Because contrast is symmetric, one deeper magenta solves both cases at once. `#c40a8f` measures 5.54:1 against white, so it is safe as text on the canvas **and** safe as a button fill carrying white text.

The system therefore splits magenta into two jobs:

| Job | Token | Value | Where it goes |
|-----|-------|-------|---------------|
| Signature fill, non-text only | `--color-magenta` | `#f50db4` | Progress-bar fill, the current-lesson edge, icons, focus rings, chart marks. 3.75:1 clears the 3:1 that non-text UI requires |
| Text and text-bearing fills | `--color-magenta-ink` | `#c40a8f` | Links, accent labels, and the primary button fill with white text. 5.54:1 both ways |

Never put text on `#f50db4`, and never set body copy in it.

## Tokens — Colors

### Magenta ramp

| Name | Value | Token | Role |
|------|-------|-------|------|
| Magenta Wash | `#fff0fa` | `--color-magenta-wash` | Tinted surface behind the current lesson, enrolment panels and the certificate callout |
| Magenta Tint | `#ffe4f5` | `--color-magenta-tint` | Accent badge and chip background |
| Magenta Edge | `#ffc2e9` | `--color-magenta-edge` | Decorative border on any washed or tinted surface |
| Magenta | `#f50db4` | `--color-magenta` | The signature. Non-text fills, indicators, icons and focus rings only |
| Magenta Ink | `#c40a8f` | `--color-magenta-ink` | Links, accent text, primary button fill. 5.5:1 on white |
| Magenta Ink Hover | `#a80a7b` | `--color-magenta-ink-hover` | Hover. On light, hover goes **darker** |
| Magenta Ink Active | `#8c0866` | `--color-magenta-ink-active` | Pressed state, and accent text sitting on a washed surface |

### Ink & Neutrals

| Name | Value | Token | On white | Role |
|------|-------|-------|----------|------|
| Ink Black | `#0e0f12` | `--color-ink-black` | 19.2:1 | Headings and body text |
| Obsidian | `#1e1e24` | `--color-obsidian` | 16.6:1 | Inverted bands, footer, video letterbox |
| Graphite | `#2d2d34` | `--color-graphite` | 13.7:1 | Strong secondary labels, badge text |
| Slate | `#5c6068` | `--color-slate` | 6.3:1 | Secondary copy, metadata, captions |
| Ash | `#8e929b` | `--color-ash` | 3.1:1 | Glyphs, control borders and placeholders. Never body text |
| Fog | `#d2d4d7` | `--color-fog` | 1.6:1 | Disabled borders, inactive tracks |
| Mist | `#e4e7ed` | `--color-mist` | 1.2:1 | Default hairline borders, dividers, progress track |
| Mist Light | `#f3f5f8` | `--color-mist-light` | — | Hover surface, table headers, locked rows |
| Pure White | `#ffffff` | `--color-pure-white` | — | Canvas, card surfaces, text on dark or magenta-ink fills |

### Surfaces

| Level | Name | Value | Token | Purpose |
|-------|------|-------|-------|---------|
| 0 | Canvas | `#ffffff` | `--surface-canvas` | The page background |
| 1 | Subtle | `#f8f9fc` | `--surface-subtle` | Alternating section bands and the dashboard ground that lets white cards read as cards |
| 2 | Card | `#ffffff` | `--surface-card` | Course cards, panels, modals, popovers |
| 3 | Raised | `#f3f5f8` | `--surface-raised` | Row hover, table header bands, secondary buttons |
| — | Magenta Wash | `#fff0fa` | `--surface-magenta-wash` | Current lesson, enrolment panel, certificate callout |
| — | Inset | `#1e1e24` | `--surface-inset` | Video letterbox and player chrome, which stay dark inside a light theme |

### Borders

| Name | Value | Token | Role |
|------|-------|-------|------|
| Border Subtle | `#eef0f4` | `--border-subtle` | Dividers inside a card |
| Border Default | `#e4e7ed` | `--border-default` | Card outlines, section rules, the system default |
| Border Strong | `#d2d4d7` | `--border-strong` | Hover edges and thumbnail frames |
| Border Control | `#8e929b` | `--border-control` | Inputs, checkboxes and radios. 3.1:1, because a border that is the only indicator of a control must clear 3:1 |

### Semantic Status

Each status is a triplet of tint, border and text. Every text value clears 4.5:1 on white **and** on its own tint, so all four are safe at body size.

| State | Background | Border | Text | On white | On own tint |
|-------|-----------|--------|------|----------|-------------|
| Success | `#ecfdf5` | `#a7f3d0` | `#047857` | 5.5:1 | 5.2:1 |
| Error | `#fef2f2` | `#fecaca` | `#c31c1c` | 6.0:1 | 5.5:1 |
| Warning | `#fffbeb` | `#fde68a` | `#b45309` | 5.0:1 | 4.8:1 |
| Info | `#f5f3ff` | `#ddd6fe` | `#6d28d9` | 7.1:1 | 6.5:1 |

Info is violet rather than blue on purpose. Violet sits beside magenta on the wheel and reads as part of the family; a blue would read as a second brand competing with the accent.

### Learning State

Named for meaning, so a component never has to decide which hue represents "done".

| Name | Value | Token | Role |
|------|-------|-------|------|
| Completed | `#047857` | `--state-completed` | Finished lessons, passed quizzes, earned certificates — always with a check glyph |
| In Progress | `#c40a8f` | `--state-in-progress` | The label and title of the current lesson |
| In Progress Indicator | `#f50db4` | `--state-in-progress-fill` | The bar fill and the 3px edge marking that lesson |
| Not Started | `#8e929b` | `--state-not-started` | The glyph on an available but untouched lesson; its title stays Slate |
| Locked | `#8e929b` | `--state-locked` | The padlock glyph on gated content |
| Locked Surface | `#f3f5f8` | `--state-locked-bg` | Background of a gated row |
| Credit | `#c40a8f` | `--state-credit` | Credit balances, prices, top-up prompts |
| Credit Expiring | `#b45309` | `--state-credit-expiring` | Credits inside the expiry window — always beside the date in text |
| Progress Track | `#e4e7ed` | `--progress-track` | The unfilled portion of any bar or ring |
| Progress Fill | `#f50db4` | `--progress-fill` | The filled portion, switching to `--state-completed` at 100% |

## Tokens — Typography

Three families, each with one job.

### Poppins — interface · `--font-ui`
- **Substitute:** ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto
- **Weights:** 400, 500, 600, 700
- **Role:** Headings, navigation, buttons, badges, card titles, form labels. Weight 600 for headings and buttons, 500 for labels, 400 for supporting copy.

### Lora — lesson prose · `--font-prose`
- **Substitute:** Playfair Display, Georgia, serif
- **Weights:** 400, 500, 600
- **Role:** Long-form lesson copy and instructor pull-quotes only. Never buttons, badges or navigation.

### JetBrains Mono — numeric data · `--font-mono`
- **Substitute:** IBM Plex Mono, SF Mono, ui-monospace
- **Weights:** 400, 500
- **Role:** Tightly scoped to values that change in place: video timecodes, lesson durations in the player, credit balances and quiz scores. Tabular figures stop a running timecode jittering as digits change. This is the one surviving signature of the original reference. Everything else numeric — lesson counts, ratings, prices in prose — stays in Poppins.

### Type Scale

| Role | Size | Line Height | Tracking | Weight | Token |
|------|------|-------------|----------|--------|-------|
| caption | 12px | 1.5 | 0.15px | 500 | `--text-caption` |
| body-sm | 13px | 1.5 | — | 400 | `--text-body-sm` |
| body | 15px | 1.55 | — | 400 | `--text-body` |
| prose | 17px | 1.7 | — | 400 | `--text-prose` |
| subheading | 18px | 1.4 | -0.2px | 600 | `--text-subheading` |
| heading-sm | 22px | 1.3 | -0.4px | 600 | `--text-heading-sm` |
| heading | 32px | 1.2 | -0.6px | 600 | `--text-heading` |
| heading-lg | 44px | 1.15 | -0.88px | 700 | `--text-heading-lg` |
| display | 56px | 1.05 | -1.8px | 700 | `--text-display` |

`--text-prose` is the lesson-body size and the only step set in Lora. Below 900px the three largest steps clamp down one position, so a phone never renders 56px type.

### Reading Measure

| Name | Value | Token | Role |
|------|-------|-------|------|
| Prose measure | `68ch` | `--measure-prose` | Lesson copy column — roughly 70 characters |
| Narrow measure | `52ch` | `--measure-narrow` | Intros, empty states, single-column forms |

## Tokens — Spacing & Shapes

**Base unit:** 4px · **Density:** comfortable

### Spacing Scale

| Name | Value | Token |
|------|-------|-------|
| 4 | 4px | `--spacing-4` |
| 8 | 8px | `--spacing-8` |
| 12 | 12px | `--spacing-12` |
| 16 | 16px | `--spacing-16` |
| 20 | 20px | `--spacing-20` |
| 24 | 24px | `--spacing-24` |
| 28 | 28px | `--spacing-28` |
| 32 | 32px | `--spacing-32` |
| 40 | 40px | `--spacing-40` |
| 48 | 48px | `--spacing-48` |
| 64 | 64px | `--spacing-64` |
| 80 | 80px | `--spacing-80` |
| 112 | 112px | `--spacing-112` |

### Border Radius

| Element | Value | Token |
|---------|-------|-------|
| chips, inline tags | 8px | `--radius-sm` |
| thumbnails, video frames | 10px | `--radius-media` |
| cards, panels, modals | 14px | `--radius-cards` |
| buttons | 60px | `--radius-buttons` |
| inputs, selects | 72px | `--radius-inputs` |
| pill badges | 9999px | `--radius-pill-badge` |

### Layout

| Name | Value | Token |
|------|-------|-------|
| Page max width | 1240px | `--page-max-width` |
| Topbar height | 40px | `--topbar-height` |
| Header height | 72px | `--header-height` |
| Section gap | 80px | `--section-gap` |
| Card padding | 20px | `--card-padding` |
| Element gap | 16px | `--element-gap` |
| Grid gutter | 24px | `--grid-gutter` |
| Minimum touch target | 44px | `--touch-target-min` |

## Components

### Course Card
**Role:** Catalogue grid unit

White surface at 14px radius with a 1px `--border-default` outline and `--shadow-subtle`. A 16:9 thumbnail at 10px radius sits flush at the top, with a level pill overlaid at 12px inset on a `rgba(14,15,18,0.64)` scrim. Body block uses 20px padding: category caption at `--text-caption` in Slate, title at `--text-subheading` weight 600 in Ink Black clamped to two lines, then a metadata row at `--text-body-sm` in Slate carrying lesson count and duration. A `--border-subtle` rule separates a footer holding the credit price in `--state-credit` weight 600. On hover the card lifts to `--shadow-hover` and the border warms to `--color-magenta-edge` over 200ms. The whole card is one link; it contains no nested buttons.

### Enrolled Course Card
**Role:** Dashboard continue-learning unit

The course card with the price footer replaced by a progress block: a 6px bar at pill radius, a lessons-completed count at `--text-body-sm` in Slate, and the percentage in `--font-mono` in Ink Black. The action reads Continue rather than Enrol, and becomes Review once the bar completes.

### Progress Bar
**Role:** Completion indicator

6px tall at pill radius. Track `--progress-track`, fill `--progress-fill`, width transitioning over 400ms on the soft ease, switching to `--state-completed` at 100%. Carries `role="progressbar"` with `aria-valuenow`, and always sits beside a text percentage — the bar alone is not an accessible statement of progress.

### Module Accordion
**Role:** Curriculum outline

White panel at 14px radius with a `--border-default` outline. Each module header is a 56px-tall real `button` with `aria-expanded`, carrying the title at `--text-subheading` weight 600, a lesson count in Slate, and a chevron rotating 180 degrees when open. Open modules reveal lesson rows separated by `--border-subtle` rules.

### Lesson Row
**Role:** Curriculum line item and player sidebar item

48px minimum height, 12px horizontal padding. A 20px state glyph leads: a filled check in `--state-completed`, a play triangle in `--state-in-progress-fill`, an outline circle in `--state-not-started`, or a padlock in `--state-locked`. Title at `--text-body`, duration right-aligned in `--font-mono` at `--text-body-sm` in Slate. The current lesson takes a `--surface-magenta-wash` background with a 3px `--color-magenta` left edge and its title in `--color-magenta-ink-active`. Locked rows take `--state-locked-bg`, keep their title in Slate rather than Ash so it stays readable, are not focusable links, and state their gating in words such as an unlock-cost label.

### Lesson Content Body
**Role:** The reading surface

Lora at `--text-prose` with 1.7 leading in Ink Black, constrained to `--measure-prose`, never full-bleed. Paragraph rhythm is 24px. Headings inside content switch to Poppins. Inline links take `--color-magenta-ink` with a 1px underline offset 3px, darkening to `--color-magenta-ink-hover` on hover. Images sit at 10px radius with a Slate caption at `--text-body-sm` beneath. Blockquotes take a 3px `--color-magenta` left border on a `--surface-magenta-wash` inset.

### Video Player Frame
**Role:** Lesson media container

16:9 container at `--radius-media` on `--surface-inset`, which stays dark so letterboxing disappears into the frame and the video is not ringed in white. The controls scrim runs bottom-up from `rgba(14,15,18,0.85)` to transparent. The scrub bar reuses the progress tokens with a 12px magenta knob on hover. Timecodes are `--font-mono` in white at `--text-body-sm`. The frame spans wider than `--measure-prose` while the transcript beneath returns to the reading measure.

### Quiz Option
**Role:** Selectable answer

Full-width control at 14px radius on white with a 1px `--border-default` outline and 16px padding, at `--text-body`. Selected takes a `--color-magenta` border on `--surface-magenta-wash`. After submission a correct answer takes the success triplet with a check, an incorrect one the error triplet with a cross, and the correct-but-unchosen answer a success border on white. Feedback never relies on colour alone — the glyph and the label carry it.

### Credit Balance Chip
**Role:** Wallet indicator in the header

Pill at `--radius-pill-badge` on `--color-magenta-tint` with a 1px `--color-magenta-edge` border. A coin glyph in `--color-magenta-ink`, then the balance in `--font-mono` weight 500 in `--color-magenta-ink-active`. When any credit enters the expiry window the chip swaps to the warning triplet and the expiry date is spelled out in the adjacent tooltip and on the account page. Expiry is never communicated by colour alone.

### Badge / Pill
**Role:** Category, level and state tags

Pill radius, 4px by 12px padding, `--text-caption` weight 500. Neutral sits on `--color-mist-light` with Graphite text. Accent sits on `--color-magenta-tint` with `--color-magenta-ink-active` text. Status variants use the four semantic triplets. Badges are labels, never controls.

### Button
**Role:** Actions

44px tall at `--radius-buttons`, 24px horizontal padding, Poppins weight 600 at `--text-body`.

- **Primary** — `--color-magenta-ink` fill with white text at 5.5:1, darkening to `--color-magenta-ink-hover` on hover and lifting to `--shadow-accent`. Not the raw `#f50db4`, which cannot carry text.
- **Secondary** — white with a 1px `--border-default` outline and Ink Black text, warming to `--surface-raised`.
- **Ghost** — text-only in `--color-magenta-ink`.
- **Disabled** — `--surface-raised` fill with Ash text and no shadow.

Every button shows a 2px `--color-magenta` focus ring at 2px offset.

### Instructor Byline
**Role:** Attribution

A 40px circular avatar with a 1px `--border-default` ring, beside the name at `--text-body` weight 600 and the role at `--text-body-sm` in Slate.

### Certificate Callout
**Role:** Completion reward

`--surface-magenta-wash` panel at 14px radius with a 1px `--color-magenta-edge` border and 32px padding, centred. An award glyph in `--color-magenta`, the heading at `--text-heading-sm` in `--color-magenta-ink-active`, supporting copy in Slate held to `--measure-narrow`, and a primary button to download. Appears only at full module completion.

### Empty State
**Role:** Zero-data placeholder

Centred block at `--measure-narrow` with 64px vertical padding. A 48px Ash glyph, a heading at `--text-subheading` weight 600, one sentence of Slate body explaining what will appear here, and a single primary action. No illustration required, and no apology in the copy.

## Do's and Don'ts

### Do
- Use `--color-magenta-ink` for anything carrying or being text, and keep `#f50db4` for fills, indicators and icons
- Send hover states darker, since the canvas is light
- Reserve magenta for actions and current position, so the next step is unambiguous on any page
- Give inputs, checkboxes and radios a `--border-control` edge, because a border that is a control's only indicator must clear 3:1
- Set lesson prose at 17px with 1.7 leading and hold it to `--measure-prose`
- Pair every state colour with a glyph and a text label
- Keep monospace to timecodes, durations, credit balances and scores
- Keep the video frame dark inside the light theme, so letterboxing does not glare
- Give every interactive element a 44px minimum target and a visible 2px magenta focus ring

### Don't
- Do not put text on `#f50db4`; white on it is 3.75:1 and fails AA
- Do not set body copy, links or button labels in `#f50db4` for the same reason
- Do not use Ash for content a learner must read — it measures 3.1:1
- Do not introduce a second accent hue; magenta is the whole chromatic identity and info is deliberately violet to stay in family
- Do not signal progress, correctness or locking with colour as the only cue
- Do not rely on `--border-default` to indicate an interactive control; it measures 1.2:1 and is decorative
- Do not set navigation, buttons or badges in the serif
- Do not let lesson copy run the full page width, or drop below 16px
- Do not animate longer than 400ms, and honour `prefers-reduced-motion` everywhere

## Elevation

Three soft levels, all tinted with the ink colour rather than pure black. `--shadow-subtle` at `0 2px 8px rgba(14,15,18,0.04)` sits under resting cards. `--shadow-hover` at `0 12px 28px -6px rgba(14,15,18,0.08)` lifts a card under the cursor. `--shadow-overlay` at `0 16px 36px -8px rgba(14,15,18,0.12)` carries dropdowns, popovers and modals. The primary button alone gets `--shadow-accent` at `0 6px 20px -4px rgba(196,10,143,0.30)`, a magenta-tinted lift rather than a glow. Borders and shadows are complementary here, not alternatives: a card wears a hairline and a subtle shadow together, which keeps it legible against both the white canvas and the subtle band.

## Imagery

Course thumbnails are the primary imagery and the one place saturated colour is welcome — the artwork is the product. They render at 16:9 and 10px radius, always with a real `alt` describing the subject. Artwork on a white or near-white ground needs a 1px `--border-strong` frame so it does not dissolve into the canvas. Instructor avatars are circular at 40px in cards and 64px on course pages. Iconography is a single outline set at 1.5px stroke, sized 16px inline, 20px in lesson rows and 24px in navigation, coloured Slate at rest and `--color-magenta` when active. Decorative glyphs take `aria-hidden`. There is no stock photography of people at desks, and no illustration style competing with instructor or learner artwork.

## Layout

A 1240px maximum content width with 24px gutters, centred on the white canvas. The header is a 40px topbar above a 72px main bar carrying the logo, primary navigation, search, the credit balance chip and the account menu, with a `--border-default` bottom rule that gains `--shadow-subtle` once the page scrolls. Catalogue pages use a four-column grid on desktop, three at 1200px, two at 900px and one below 600px, with an optional 280px filter rail. Course detail pages split into a main column and a 360px sticky purchase panel that collapses beneath the content under 992px. The lesson player uses a persistent 320px curriculum sidebar beside the video and transcript; below 992px it becomes a collapsible drawer. Lesson prose always returns to `--measure-prose` whatever container holds it. Marketing sections alternate between the canvas and `--surface-subtle`, separated by `--section-gap`, halving to 48px below 768px.

## Accessibility

- Every text colour in the system except Ash clears WCAG 2.1 AA at 4.5:1 on white and on the subtle band. The lowest passing step is `--color-magenta-ink` at 5.5:1.
- `#f50db4` is non-text only. It measures 3.75:1, which clears the 3:1 required of non-text UI components, indicators and focus rings, and fails the 4.5:1 required of text.
- White text on `#f50db4` is 3.75:1 and never appears. The primary button uses `--color-magenta-ink` instead, where white reaches 5.5:1.
- Ash at 3.1:1 is approved for glyphs, control borders and placeholders only.
- Inputs and other controls whose border is their only visual boundary use `--border-control` at 3.1:1. The decorative `--border-default` at 1.2:1 is never used for that job.
- State is always carried by at least two channels: completion takes green plus a check, locking takes grey plus a padlock, quiz results take colour plus a glyph plus a label, and credit expiry takes amber plus a written date.
- Focus is visible everywhere: a 2px `--color-magenta` ring at 2px offset, never removed without a replacement.
- Targets are 44px minimum, including lesson rows and player controls.
- Accordions, tabs and progress bars use native semantics and ARIA attributes rather than styled divs.
- The page declares `color-scheme: light` so browser controls and autofill render consistently.
- Every transition is tokenised so `prefers-reduced-motion: reduce` collapses it.

## Agent Prompt Guide

**Quick Color Reference**
- canvas: `#ffffff` · subtle band: `#f8f9fc` · raised: `#f3f5f8`
- border: `#e4e7ed` · control border: `#8e929b`
- text: `#0e0f12` · secondary: `#5c6068`
- signature fill, no text on it: `#f50db4`
- links, accent text, primary button fill: `#c40a8f`, hover `#a80a7b`, white text on it
- wash: `#fff0fa` · tint: `#ffe4f5` · tint edge: `#ffc2e9`
- complete: `#047857` · warning: `#b45309` · error: `#c31c1c` · info: `#6d28d9`

**Example Component Prompts**

1. Build a course card: white surface, 14px radius, 1px `#e4e7ed` border, `0 2px 8px rgba(14,15,18,0.04)` shadow. A 16:9 thumbnail at 10px radius on top, then 20px padding holding a 12px `#5c6068` category caption, an 18px weight-600 `#0e0f12` title clamped to two lines, a 13px `#5c6068` row with lesson count and duration, and a hairline-separated footer with the credit price in `#c40a8f` weight 600. On hover raise to `0 12px 28px -6px rgba(14,15,18,0.08)` and warm the border to `#ffc2e9` over 200ms.

2. Build a primary button: 44px tall, 60px radius, 24px horizontal padding, `#c40a8f` fill with `#ffffff` text in Poppins weight 600 at 15px. On hover fill `#a80a7b` and add `0 6px 20px -4px rgba(196,10,143,0.30)`. Focus ring 2px `#f50db4` at 2px offset. Do not use `#f50db4` as the fill — white text on it fails AA.

3. Build a lesson row: 48px tall, 12px horizontal padding, a 20px leading state glyph, a 15px title and a right-aligned monospace 13px `#5c6068` duration. Completed rows take a check in `#047857`, the current row takes a `#fff0fa` background with a 3px `#f50db4` left border and its title in `#8c0866`, and locked rows take `#f3f5f8` with a padlock in `#8e929b` and a written unlock-cost label.

4. Build a progress bar: 6px tall, pill radius, `#e4e7ed` track, `#f50db4` fill animating width over 400ms, switching to `#047857` at completion. Include `role="progressbar"` with `aria-valuenow` and render the percentage as monospace text beside it.

5. Build a lesson body: Lora at 17px with 1.7 leading in `#0e0f12`, constrained to 68ch, 24px paragraph spacing, Poppins headings, inline links in `#c40a8f` underlined at 3px offset, images at 10px radius with 13px `#5c6068` captions.

6. Build a quiz option: full-width, 14px radius, white surface, 1px `#e4e7ed` border, 16px padding, 15px text. Selected takes an `#f50db4` border on a `#fff0fa` fill. After submission apply `#ecfdf5` / `#a7f3d0` / `#047857` with a check for correct, and `#fef2f2` / `#fecaca` / `#c31c1c` with a cross for incorrect.

7. Build a credit balance chip: pill radius, `#ffe4f5` fill, 1px `#ffc2e9` border, a coin glyph in `#c40a8f`, balance in JetBrains Mono weight 500 `#8c0866`. In the expiry window swap to `#fffbeb` fill, `#fde68a` border and `#b45309` text, and state the expiry date in words.

## Similar Products

- **Domestika** — Creative-course catalogue with artwork-led thumbnails, the closest reference for tone
- **Skillshare** — Class-card grid and curriculum sidebar patterns, progress carried at card level
- **Coursera** — Module accordions, lesson-row states and the sticky enrolment panel
- **Linear and Stripe light modes** — The hairline-plus-soft-shadow separation and single-accent discipline this system borrows

## Quick Start

The runnable token set lives in `variables.css` beside this document. Import it once at the top of the stylesheet chain.

```css
@import url("variables.css");
```

### Tailwind v4

```css
@theme {
  /* Magenta ramp */
  --color-magenta-wash: #fff0fa;
  --color-magenta-tint: #ffe4f5;
  --color-magenta-edge: #ffc2e9;
  --color-magenta: #f50db4;           /* non-text fills only */
  --color-magenta-ink: #c40a8f;       /* text and text-bearing fills */
  --color-magenta-ink-hover: #a80a7b;
  --color-magenta-ink-active: #8c0866;

  /* Ink & neutrals */
  --color-ink-black: #0e0f12;
  --color-obsidian: #1e1e24;
  --color-graphite: #2d2d34;
  --color-slate: #5c6068;
  --color-ash: #8e929b;
  --color-fog: #d2d4d7;
  --color-mist: #e4e7ed;
  --color-mist-light: #f3f5f8;
  --color-pure-white: #ffffff;

  /* Surfaces */
  --color-canvas: #ffffff;
  --color-subtle: #f8f9fc;
  --color-raised: #f3f5f8;

  /* Status */
  --color-success: #047857;
  --color-warning: #b45309;
  --color-error: #c31c1c;
  --color-info: #6d28d9;

  /* Type */
  --font-ui: 'Poppins', ui-sans-serif, system-ui, sans-serif;
  --font-prose: 'Lora', Georgia, serif;
  --font-mono: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, monospace;

  --text-caption: 12px;
  --text-body-sm: 13px;
  --text-body: 15px;
  --text-prose: 17px;
  --text-subheading: 18px;
  --text-heading-sm: 22px;
  --text-heading: 32px;
  --text-heading-lg: 44px;
  --text-display: 56px;

  /* Spacing */
  --spacing-4: 4px;
  --spacing-8: 8px;
  --spacing-12: 12px;
  --spacing-16: 16px;
  --spacing-20: 20px;
  --spacing-24: 24px;
  --spacing-28: 28px;
  --spacing-32: 32px;
  --spacing-40: 40px;
  --spacing-48: 48px;
  --spacing-64: 64px;
  --spacing-80: 80px;
  --spacing-112: 112px;

  /* Radius */
  --radius-sm: 8px;
  --radius-media: 10px;
  --radius-cards: 14px;
  --radius-buttons: 60px;
  --radius-inputs: 72px;
  --radius-pill-badge: 9999px;
}
```
