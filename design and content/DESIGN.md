# KnowledgeCademy — Style Reference
> Ink on white. Tight grotesk headlines, flat surfaces, hairline borders, one violet accent and dark bands for the technical moments. Restraint as authority.

**Theme:** light, with full-bleed dark sections
**Tokens:** `variables.css` (single source of truth; this document explains how to use them)

## Brand and Content

KnowledgeCademy offers bilingual (English / Japanese) study materials for professionals building job-ready technology skills, from fundamentals to advanced practice. The tone is practical, calm and professional.

### Categories

| # | Title | title_jp | Slug | Icon idea (line art) |
|---|-------|----------|------|----------------------|
| 1 | Software Development & Engineering | ソフトウェア開発-エンジニアリング | `software-development-engineering` | Code brackets `</>` |
| 2 | Data, Automation & AI | データ、自動化、AI | `data-automation-ai` | Connected nodes / spark |
| 3 | IT Infrastructure, Cloud & Security | ITインフラ、クラウド、セキュリティ | `it-infrastructure-cloud-security` | Server stack with shield |
| 4 | Product Design, UX & Digital Experience | プロダクトデザイン、UX、デジタル体験 | `product-design-ux-digital-experience` | Pen tool / cursor |
| 5 | DevOps, Agile & Technology Leadership | DevOps、アジャイル、テクノロジーのリーダーシップ | `devops-agile-technology-leadership` | Loop / pipeline arrows |

### Study Materials (18)

| Category | Materials |
|----------|-----------|
| 1 | Programming Fundamentals · Web Application Development · Software Testing & Code Quality |
| 2 | Data Analysis Fundamentals · Business Automation & Scripting · AI Tools & Practical Applications |
| 3 | IT Infrastructure Fundamentals · Cloud Computing Essentials · DevOps & CI/CD Foundations · Cybersecurity & Risk Management |
| 4 | UX Design Foundations & User Research · UI Design Systems & Prototyping · Product Thinking & Digital Strategy · Interaction Design & Experience Optimization |
| 5 | DevOps Principles & CI/CD Implementation · Agile & Scrum Project Management · Cloud-Native Deployment & Infrastructure Automation · Technology Leadership & Engineering Management |

### Content Facts That Shape the Design

- **Bilingual.** Every title, summary and description has a `_jp` version. All type rules must work for Japanese (see Japanese Typography).
- **Long titles.** Several titles run 45+ characters ("Cloud-Native Deployment & Infrastructure Automation", 「テクノロジー-リーダーシップ＆エンジニアリング-マネジメント」). Card titles use modest sizes and a 2-line clamp; display sizes are for the hero only.
- **Empty fields.** `skill_level`, `duration` and `lectures` are currently empty. Do not design badges or meta rows that depend on them; render a meta item only when its value exists.
- **Three price columns.** `price`, `price_jp`, `price_hk` — show the value for the active locale exactly as stored. Never hardcode prices or discounts.
- **One image per material** (`storage/photos/products/{id}.webp`). Always guard with a file-exists check and fall back to the placeholder described in Imagery.

## Tokens — Colors

| Name | Value | Token | Role |
|------|-------|-------|------|
| Canvas | `#ffffff` | `--color-canvas` | Page background, cards, inputs |
| Wash | `#f7f7f7` | `--color-wash` | Image placeholders, table stripes, quiet panels |
| Obsidian Ink | `#010110` | `--color-obsidian-ink` | Text, primary buttons, strong borders, icons |
| Carbon | `#111117` | `--color-carbon` | Dark section background |
| Graphite | `#22222a` | `--color-graphite` | Cards inside dark sections, code blocks |
| Fog | `#73737c` | `--color-fog` | Muted text on light surfaces (4.7:1 on white) |
| Mist | `#a1a1aa` | `--color-mist` | Muted text on dark surfaces (Fog is too dim on Graphite) |
| Ash | `#d9d9d9` | `--color-ash` | Dividers, decorative dot pattern, disabled fills |
| Iris Pulse | `#635bff` | `--color-iris-pulse` | The single accent (see Accent Rules) |
| Iris Deep | `#4b44d6` | `--color-iris-deep` | Hover / pressed state of Iris elements |
| Deep Teal | `#072723` | `--color-deep-teal` | Artwork only, never UI |

### State Colors

Used only for feedback: form validation, payment and top-up results, alerts. Never decorative.

| State | Text / icon | Background | Tokens |
|-------|-------------|------------|--------|
| Success | `#16794a` | `#e9f6ef` | `--color-success`, `--color-success-wash` |
| Error | `#c4323c` | `#fcecee` | `--color-error`, `--color-error-wash` |
| Warning | `#9a5b00` | `#fdf3e1` | `--color-warning`, `--color-warning-wash` |
| Info | `#635bff` | `#ffffff` + hairline | `--color-iris-pulse` |

### Accent Rules

Iris Pulse is allowed in exactly these places:
- Announcement bar fill (only when there is real announcement copy; otherwise omit the bar)
- Link hover color and the active nav underline
- Focus ring (`--focus-ring`)
- Chart strokes and progress fills
- Info alerts

Never use it as a primary button fill, body text color or large background.

## Tokens — Typography

| Family | Token | Use | Load from |
|--------|-------|-----|-----------|
| Space Grotesk | `--font-display` | Headlines 26px and up, hero, section titles | Google Fonts, weights 400 / 500 |
| Inter | `--font-body` | Body, UI, nav, buttons, card titles | Google Fonts, weights 400 / 500 / 700 |
| Noto Sans JP | fallback in both stacks | All Japanese glyphs | Google Fonts, weights 400 / 500 / 700 |
| System mono | `--font-mono` | Category eyebrows, code samples | Not loaded (system) |

```html
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Noto+Sans+JP:wght@400;500;700&family=Space+Grotesk:wght@400;500&display=swap" rel="stylesheet">
```

Space Grotesk and Inter have no Japanese glyphs, so Japanese text falls through to Noto Sans JP automatically; Latin words inside Japanese text stay in the Latin face.

### Type Scale

| Role | Family | Weight | Size token | Size |
|------|--------|--------|------------|------|
| caption | Inter | 400 | `--text-caption` | 12px |
| body-sm | Inter | 400 | `--text-body-sm` | 14px |
| body | Inter | 400 | `--text-body` | 16px |
| body-lg | Inter | 400 | `--text-body-lg` | 18px (hero subtext) |
| subheading / card title | Inter | 500 | `--text-subheading` | 20px |
| heading-sm | Space Grotesk | 500 | `--text-heading-sm` | 26px |
| heading | Space Grotesk | 500 | `--text-heading` | 28 → 38px |
| heading-lg | Space Grotesk | 500 | `--text-heading-lg` | 36 → 56px |
| display | Space Grotesk | 500 | `--text-display` | 42 → 76px (hero only) |

Latin tracking: `--tracking-display` / `--tracking-heading` -0.03em, `--tracking-body` -0.02em. Labels in caps use `--tracking-label` +0.06em.

### Japanese Typography

`variables.css` switches tokens automatically under `:root:lang(ja)`, so pages must set `<html lang="ja">` for the Japanese locale:
- All negative tracking resets to `0` (tight tracking makes kana and kanji collide).
- Line heights open up: body 1.85, headings 1.4, display 1.3.
- Never use `text-transform: uppercase` or letter-spaced caps for Japanese labels; the eyebrow style becomes plain 12px text.
- Allow line breaks at natural points; use `word-break: keep-all` only for Latin-heavy titles, never for full Japanese sentences.

## Tokens — Spacing, Shape, Layout

- **Spacing scale (4px base):** 4, 8, 12, 16, 20, 24, 32, 40, 48, 64, 80 (`--spacing-*`).
- **Radii:** icons 2px (`--radius-icon`), cards, images and inputs 8px (`--radius-card`), buttons and tags 100px (`--radius-pill`). No other values.
- **Borders:** hairline `--border-hairline` for cards and dividers, `--border-strong` for inputs and ghost buttons, `--border-on-dark` inside dark sections.
- **Layout:** max width 1200px, side gutter 16–24px (`--page-gutter`), section gap 56–80px (`--section-gap`), card padding 24px, grid gap 24px.
- **Grids:** material cards 3 columns ≥ 1024px, 2 columns ≥ 640px, 1 column below. Category cards 3 + 2 on desktop, 1 column on mobile.
- **Motion:** 150ms ease for color and border changes, 250ms for image zoom. Respect `prefers-reduced-motion`.

## Elevation

No shadows anywhere. Hierarchy comes from tone shifts and hairlines:
- Light: Canvas card with hairline border on Canvas or Wash.
- Dark: Graphite card on Carbon section.

## Components

### Announcement Bar
Full-width Iris Pulse band above the nav. 13px Inter 500 white, centered, padding 10px 24px. Optional right-side pill link: transparent, 1px white border, 6px 14px padding. Render only when real announcement text exists.

### Navigation Bar
White, hairline bottom border, height 64px. Logo left. Links in 15px Inter 400 Ink; active link gets a 2px Iris underline. Right side: language switch (EN / JA as text links), login as a ghost pill, register as the primary pill. On mobile the links collapse into a full-width sheet with one link per row.

### Primary Button
Ink fill, white 15px Inter 500, padding 12px 20px, pill radius, optional → arrow with 6px gap. Hover: background `--color-graphite`. Focus: `--focus-ring`. One primary button per view section.

### Ghost Button
Transparent, `--border-strong`, Ink text, same size as primary. Hover: fills Ink, text turns white. On dark sections: white border and text, hover fills white with Ink text.

### Text Link
Ink, no underline. Hover: Iris Pulse with a 1px underline. Directional links end with →.

### Hero
Two columns on desktop, stacked on mobile. Left: small mono eyebrow, display headline, 18px Fog subtext, primary + ghost buttons. Right: abstract artwork (Deep Teal / Carbon washes with thin line-art) or a clean preview of a material card. Headline stays within 3 lines at desktop.

### Category Card (dark section)
Carbon section, centered heading-lg in white. Cards: Graphite, 8px radius, 24–32px padding, `--border-on-dark`. Top: 40px line-art icon (1.5px stroke, `#8a8a94`). Title in 20px Inter 500 white, summary in 14px Mist with a 3-line clamp, then a white "View materials →" text link. Hover: border becomes `rgba(255,255,255,.32)` and the arrow shifts 4px right. Categories are told apart by icon and title, never by extra colors.

### Material Card
White, hairline border, 8px radius, overflow hidden.
- Image: 3:2 ratio, `object-fit: cover`; placeholder (Wash + category icon) when the file is missing.
- Body (24px padding): category eyebrow in 12px mono Fog with label tracking (plain text in Japanese), title in 20px Inter 500 with a 2-line clamp, summary in 14px Fog with a 3-line clamp.
- Footer: hairline top border, price for the active locale on the left, ghost "View" pill on the right.
- Meta items (level, duration, lectures) appear only when the field has a value.
- Hover: border turns Ink, image scales to 1.03.

### Material Detail
Two columns on desktop: left holds title (heading-lg), summary, description; right holds a sticky purchase card (price, primary button, available meta items). Description sections separated by hairlines, 16px body at comfortable line length (max 70ch; Japanese max 40em).

### Code / Technical Block
Graphite background, 8px radius, 16–20px padding, 14px `--font-mono` in `#e6e6ea`. Use for technical examples in descriptions; never for decoration.

### Forms
Centered, max width 440px, one field per row. Label 14px Inter 500 above the input. Input: white, `--border-strong`, 8px radius, 12px 14px padding, 16px text. Focus: `--focus-ring`. Error: border and message in `--color-error`, message 13px below the field. Full-width primary button at the end.

### Alerts
8px radius, 12px 16px padding, state wash background, 1px border in the state color at 30% opacity, state-colored icon and bold lead-in, body text in Ink.

### Footer
White, dotted Ash pattern at 20% opacity across the top area, four link columns (headings 14px Inter 700 Ink, links 14px Fog, 10px row gap), bottom row with copyright linking to the home page and the language switch. Company details come from the database only.

## Imagery

- Editorial and calm: abstract washes, thin geometric line art, isometric diagrams in near-black on Graphite.
- Material images should be clean and on-topic for technology (screens, diagrams, abstract networks). Avoid busy stock photos with baked-in title text.
- The images currently in `public/storage/photos/products/` come from a previous trading project ("The Day Trading Blueprint", etc.) and must be replaced before launch.
- Icons: outlined, 1.5px stroke, 16–20px in UI, 40px on category cards, same color as surrounding text.

## Do's and Don'ts

### Do
- Use Space Grotesk for every heading 26px and above; Inter for everything else.
- Keep display sizes for the hero; use 20–26px for card and list titles.
- Set `lang="ja"` on the Japanese locale so the Japanese type tokens apply.
- Keep primary buttons Ink; keep Iris for the listed accent uses only.
- Use hairlines and tone shifts for separation.
- Guard every image with a placeholder.

### Don't
- Don't use negative tracking or tight line-heights on Japanese text.
- Don't add accent colors per category; use icons.
- Don't add shadows, gradients on UI, or radius values beyond 2 / 8 / 100px.
- Don't use Fog for body text on dark sections; use Mist.
- Don't show empty meta badges, placeholder prices or invented promotions.
- Don't use state colors decoratively.

## Agent Prompt Guide

Quick reference: text `#010110`, background `#ffffff`, muted `#73737c` (light) / `#a1a1aa` (dark), accent `#635bff` (links, focus, announcements only), primary action `#010110`, dark bands `#111117` with `#22222a` cards.

1. **Hero:** white background, max-width 1200px. Mono eyebrow 12px Fog. Headline Space Grotesk 500, `--text-display`, Ink, `--tracking-display`, `--leading-display`. Subtext Inter 18px Fog. Primary Ink pill + ghost pill.
2. **Category section:** full-bleed Carbon, centered Space Grotesk heading in white. Five Graphite cards (3 + 2), each with a 40px line-art icon, 20px Inter 500 white title, 14px Mist summary, white "View materials →" link.
3. **Material grid:** 3-column grid of white cards with hairline borders, 3:2 image, mono category eyebrow, 20px title clamped to 2 lines, 14px Fog summary clamped to 3 lines, footer with locale price and ghost "View" pill.
4. **Form page:** centered 440px column, one field per row, 8px inputs with Ink border, Iris focus ring, error text in `#c4323c`, full-width Ink pill submit.
