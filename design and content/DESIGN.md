# Art Courses Platform — Style Reference
> Premium illustration and spatial art education — burnished gold hairlines on bone-white vellum

**Theme:** light

The Art Courses platform is a quiet luxury of typographic restraint: a vast off-white vellum, a single high-contrast Bodoni voice, and a thread of burnished gold that hairlines every educational moment. The system behaves like a high-end art-book spread — no shadows, no gradients, no rounded corners, no filled buttons — only the architecture of type, generous white space, and vertical rules dividing course objects. Color appears as gold punctuation (borders on titles, rules beneath section headers, thin lines under links) rather than as fill, and the lone dark surface (#0a0a0a) reads as a gallery wall, not as a UI mode. All interactive elements are text-driven: ghost links, bracketed call-to-action markers like `{ ENROLL NOW }`, and pagination arrows at page corners. The page is a long horizontal editorial scroll divided into discrete exhibition rooms for each course category, each introduced by a serif italic section title with a gold underline.

## Course Categories

The platform is structured around five primary disciplines, acting as the main taxonomy and section dividers:
- **Japanese Architecture & Spatial Art**
- **Food & Culinary Illustration**
- **Fashion Illustration & Styling**
- **Botanical & Nature Illustration**
- **Travel & Cultural Illustration**

## Tokens — Colors

| Name | Value | Token | Role |
|------|-------|-------|------|
| Vellum White | `#f6f6f6` | `--color-vellum-white` | Page canvas — the warm off-white that grounds every section, never pure #ffffff so type never feels clinical |
| Paper | `#ffffff` | `--color-paper` | Card and section surfaces — course grids, curriculum panels, inset blocks sitting one shade above the vellum canvas |
| Gallery Ink | `#0a0a0a` | `--color-gallery-ink` | Dark sections (Masterclass block, footer band) and deepest typographic emphasis — reads as letterpress black, not screen black |
| Letterpress Black | `#000000` | `--color-letterpress-black` | Body copy, navigation text, icons, all hairlines and borders, pagination marks — the structural ink of the system |
| Silver Wash | `#b3b3b3` | `--color-silver-wash` | Muted surface for secondary hero panels and quiet tonal breaks — used sparingly as a gallery-shadow gray |
| Burnished Gold | `#bc9c5c` | `--color-burnished-gold` | Section header underlines, link hover rules, decorative title borders — the only chromatic voice in the system, applied as 1px strokes and inline rules, never as fill |

## Tokens — Typography

### BodoniSvntytwoITCStd-Book — Primary voice
- **Substitute:** Bodoni Moda, Bodoni 72, Playfair Display
- **Weights:** 400
- **Sizes:** 12px, 14px, 16px, 18px, 22px, 42px
- **Line height:** 0.95 (display), 1.25 (running text)
- **Role:** Primary voice — every editorial moment. 42px with line-height 0.95 for the cinematic display headline (the tight leading lets the tall Bodoni capitals lock together as a single typographic object). 22px for section openers. 18px and 16px for course descriptions and instructor bios. 14px and 12px for navigation, captions, and fine print.

### BodoniSvntytwoITCStd-BookIt — Editorial italics
- **Substitute:** Bodoni Moda Italic, Playfair Display Italic
- **Weights:** 400
- **Sizes:** 16px, 22px, 42px
- **Line height:** 1.25
- **Role:** Editorial italics for the signature flourish — brand wordmark, italic category titles like *Botanical & Nature Illustration*, and quiet poetic asides. The italic is used as ornament, not emphasis.

### Arial — System utility
- **Substitute:** Helvetica, Inter, system-ui
- **Weights:** 400, 700
- **Sizes:** 12px, 14px
- **Line height:** 1.25
- **Role:** System utility for pagination counters (2/5), course durations (4 Weeks), syllabus labels, form inputs, and metadata. Arial sits beside Bodoni as a quiet functional label — the contrast between high-contrast serif and neutral sans is the only typographic tension the system permits.

### Type Scale

| Role | Size | Line Height | Letter Spacing | Token |
|------|------|-------------|----------------|-------|
| caption | 12px | 1.25 | — | `--text-caption` |
| body-sm | 14px | 1.25 | — | `--text-body-sm` |
| body | 16px | 1.25 | — | `--text-body` |
| subheading | 22px | 1.25 | — | `--text-subheading` |
| heading | 42px | 0.95 | — | `--text-heading` |

## Tokens — Spacing & Shapes

**Base unit:** 8px
**Density:** spacious

### Spacing Scale

| Name | Value | Token |
|------|-------|-------|
| 8 | 8px | `--spacing-8` |
| 16 | 16px | `--spacing-16` |
| 24 | 24px | `--spacing-24` |
| 32 | 32px | `--spacing-32` |
| 40 | 40px | `--spacing-40` |
| 48 | 48px | `--spacing-48` |
| 64 | 64px | `--spacing-64` |
| 80 | 80px | `--spacing-80` |
| 128 | 128px | `--spacing-128` |

### Border Radius
All elements (tags, cards, inputs, buttons) strictly use **0px** radius.

### Layout
- **Page max-width:** 1280px
- **Section gap:** 48px
- **Card padding:** 40px
- **Element gap:** 20px

## Components

### Top Bar Navigation
**Role:** Primary site navigation
Single horizontal row, transparent over the vellum canvas. Logo monogram on the far left. Far right carries the platform wordmark with the italic subtitle beneath, followed by a thin-line user icon and a hamburger menu icon. No background fill, no border, no shadow.

### Hero Headline Block
**Role:** Opening editorial statement
Left-aligned text block, 40% page width. Headline in Bodoni 42px, line-height 0.95. Sub-headline paragraph in Bodoni 16px. Followed by a bracketed call-to-action: `{ EXPLORE COURSES }`. The opposite ~60% holds a large illustrative plate showcasing student work or a masterclass preview.

### Section Title with Gold Rule
**Role:** Category divider heading
Centered text in italic Bodoni 22px, #000000, followed by a 1px horizontal rule in #bc9c5c (Burnished Gold). Appears above each course category (e.g., *Japanese Architecture & Spatial Art*). The gold rule signals a new curriculum room.

### Three-Column Course Grid
**Role:** Course catalog showcase
Three equal columns separated by 1px vertical rules in #000000. Each column has 40px internal padding and a #ffffff surface. Course covers sit centered; the grid acts as the gallery wall for the curriculum.

### Course Preview Plate
**Role:** Individual course object
Centered illustration or architectural photo with 24px top margin from the column rule. No card shadow, no hover zoom — interaction is implied by the artwork itself.

### Ghost Link / Editorial CTA
**Role:** Outlined action
Text link in Bodoni 14px with 1px bottom border. Hover states swap the border color and text to #bc9c5c (Burnished Gold). The bracketed variant — `{ ENROLL NOW }` — wraps the label in literal curly braces.

### Featured Masterclass Brand Block
**Role:** Branded section separator
Full-bleed horizontal band with a #0a0a0a (Gallery Ink) surface. Left half holds a richly colored master illustration; right half centers the masterclass title in Bodoni 42px, white, with metadata in Arial 12px beneath.

### Section Header Tab
**Role:** In-grid category label
Inline label split across the grid: the active category (e.g. *Food & Culinary Illustration*) in italic Bodoni 22px #000000, inactive categories in roman Bodoni at 40% opacity. 1px #bc9c5c underline only on the active label.

## Do's and Don'ts

### Do
- Use Burnished Gold (#bc9c5c) only as 1px strokes. Never as a fill.
- Use #f6f6f6 as the base canvas, not #ffffff, to keep the print-catalogue register.
- Separate three-column course grids with 1px #000000 vertical rules.
- Express primary actions like `{ ENROLL NOW }` or `{ VIEW SYLLABUS }` as text with a hairline bottom border or in brackets.

### Don't
- Do not introduce drop-shadows, blurs, or glow effects.
- Do not round any corner. Course previews, inputs, and buttons keep 0px radius.
- Do not use any secondary accent color outside of the single gold.

## Elevation
No shadows. Elevation is communicated through tonal layering of the neutrals (#f6f6f6 → #ffffff → #b3b3b3 → #0a0a0a → #000000) and 1px hairline rules.

## Imagery
Showcase two distinct image modes: (1) fine-art illustration and architectural plates presented at large scale with no framing or overlay; (2) precise student work/tools photography on pure white. Both treated as museum objects. 

## Agent Prompt Guide

**Example Component Prompts**

1. **Category Grid** — Section title *Botanical & Nature Illustration* centered in italic Bodoni 22px, followed by a full-width 1px #bc9c5c rule. Three equal columns on a #ffffff surface, separated by 1px #000000 vertical rules. Each column has 40px internal padding and a centered course artwork plate.
2. **Hero Block** — Headline "Master the Art of Space." in Bodoni 42px. Action: `{ ENROLL NOW }` in Bodoni 14px with a 1px #000000 bottom border.

## Editorial Conventions

Signature devices to preserve:
1. **The bracketed action**: `{ ENROLL NOW }`, `{ VIEW SYLLABUS }`
2. **The inline category trio**: Active category (*Travel & Cultural Illustration*) italicized with gold underline, inactive categories roman at 40% opacity.
3. **The Art Déco gold rule**: Every category introduction gets a 1px #bc9c5c horizontal rule beneath the title.

## Quick Start
*(CSS and Tailwind variables remain consistent with the core palette and type scale)*
