# Learning Platform — Design System
> A calm, focused place to learn anything online

**Themes:** light (default) + dark · **Token sources:** `variables.css` (CSS) and `tokens.json` (W3C Design Tokens) — keep them in sync. This document explains how to use them; if a value here ever disagrees with `variables.css`, the CSS is correct.

**Scope:** a general e-learning platform for any subject — technology and programming, business, creative skills, science and math, languages, health, test prep and school curricula. Components are subject-neutral; subject-specific needs (code blocks, formulas, project galleries) are covered as optional components.

The platform should feel like a quiet, well-lit study room: a warm off-white canvas, generous whitespace, and **the course content as the hero** — video, readings, diagrams, code or projects. The UI stays calm and neutral so learners can concentrate. Headlines use a friendly serif (Fraunces) for an approachable, editorial voice; everything functional uses a highly readable sans (Source Sans 3). A single terracotta color marks the actions that matter — *Enroll*, *Buy*, *Continue lesson* — so learners always know where to go next.

## Principles

1. **Content first.** Lessons, videos and course thumbnails are the main visual content. Chrome stays quiet around them.
2. **One clear next step.** Every screen has at most one primary (terracotta) button.
3. **Readable for long sessions.** 16px minimum UI text, 18px lesson text, 70-character line length, dark mode.
4. **Accessible by default.** All text pairs meet WCAG 2.2 AA; everything is keyboard-reachable with a visible focus ring. Learners of every age and ability use the platform.
5. **Progress is visible.** Learners should always see how far they are through a course, module and lesson.
6. **Subject-neutral.** No component assumes a specific subject; subject categories are expressed only through tags and thumbnails.

---

## Color

Use **semantic tokens** (`--color-text`, `--color-primary`…) in components. The `--palette-*` values exist only for reference and rare one-offs. Dark mode swaps semantic values automatically.

### Surfaces & text

| Token | Light | Dark | Use |
|---|---|---|---|
| `--color-bg-canvas` | `#fbf8f3` | `#14110f` | Page background |
| `--color-bg-surface` | `#ffffff` | `#1c1917` | Cards, inputs, modals |
| `--color-bg-muted` | `#f4efe7` | `#292524` | Tags, sidebar, table stripes |
| `--color-bg-inverse` | `#1c1917` | `#0c0a09` | Hero band, video player chrome, footer |
| `--color-overlay` | `rgba(20,17,15,.6)` | `rgba(0,0,0,.7)` | Modal backdrop, caption over image |
| `--color-border` | `#e6dfd3` | `#3a3430` | Card borders, dividers (decorative) |
| `--color-border-strong` | `#cfc5b4` | `#57504a` | Section dividers, table header rule |
| `--color-border-input` | `#8f877d` | `#7a716a` | Inputs, checkboxes, radios (≥3:1) |
| `--color-text` | `#1c1917` | `#f5f0e8` | Headings, body |
| `--color-text-secondary` | `#57534e` | `#d6cfc4` | Descriptions, supporting copy |
| `--color-text-muted` | `#6f6862` | `#a8a097` | Metadata, captions, timestamps |
| `--color-text-inverse` | `#fbf8f3` | `#f5f0e8` | Text on inverse surfaces |

### Actions

| Token | Light | Dark | Use |
|---|---|---|---|
| `--color-primary` | `#c2410c` | `#fb923c` | Primary buttons: Enroll, Buy, Continue, Submit |
| `--color-primary-hover` | `#9a3412` | `#fdba74` | Hover / pressed |
| `--color-text-on-primary` | `#ffffff` | `#1c1917` | Label on primary buttons |
| `--color-primary-subtle` | `#fff4ed` | `#3b2418` | Current lesson row, selected plan |
| `--color-accent` | `#3730a3` | `#a5b4fc` | Links, active nav item |
| `--color-accent-subtle` | `#eef2ff` | `#25234a` | Active nav background |
| `--color-focus-ring` | `#4f46e5` | `#a5b4fc` | Keyboard focus outline |

### Status

| Token | Light | Dark | Use |
|---|---|---|---|
| `--color-success` / `-subtle` | `#15803d` / `#ecfdf3` | `#4ade80` / `#12291b` | Correct answer, lesson completed, payment OK |
| `--color-warning` / `-subtle` | `#b45309` / `#fffbeb` | `#fbbf24` / `#2e2410` | Assignment due soon, subscription expiring |
| `--color-error` / `-subtle` | `#b91c1c` / `#fef2f2` | `#f87171` / `#331616` | Wrong answer, form error, upload failed |
| `--color-info` / `-subtle` | `#1d4ed8` / `#eff6ff` | `#60a5fa` / `#152238` | Tips, announcements, live-class notices |

Never rely on color alone — pair status colors with an icon (✓ ✕ ⚠ ℹ) and text.

### Learning & categories

| Token | Use |
|---|---|
| `--color-progress-track` / `--color-progress-fill` | Progress bars and rings (fill is success green) |
| `--color-rating` | Star icons only (graphic contrast ≥3:1) — never text |
| `--color-disabled-bg` / `--color-disabled-text` | Disabled controls only — never readable content |
| `--color-cat-{technology,business,creative,science,language,health}-{bg,fg}` | Subject category tags on course cards; each fg/bg pair ≥4.5:1 in both themes |

**Subject category mapping** (map any sub-subject to its nearest group; add new pairs only after checking ≥4.5:1 contrast):

| Tag | Hue | Covers |
|---|---|---|
| `technology` | Indigo | Programming, data, IT, cloud, AI, cybersecurity |
| `business` | Stone | Management, finance, marketing, entrepreneurship, productivity |
| `creative` | Terracotta | Design, art, music, photography, writing, video |
| `science` | Green | Math, physics, chemistry, biology, engineering, test prep |
| `language` | Pink | Language learning, communication, literature |
| `health` | Teal | Fitness, nutrition, mental health, medicine, personal development |

### Verified contrast (WCAG 2.2)

| Pair | Light | Dark |
|---|---|---|
| Text on canvas | 16.5:1 | 16.6:1 |
| Secondary text on canvas/surface | 7.2:1 | 11.3:1 |
| Muted text on canvas / on muted bg | 5.2:1 / 4.8:1 | 6.8:1 / 5.9:1 |
| Label on primary button | 5.2:1 | 7.7:1 |
| Primary as text on canvas | 4.9:1 | 7.7:1 |
| Accent link on canvas | 9.4:1 | 8.8:1 |
| Status colors on their subtle bg | 4.8–6.2:1 | 6.0–9.1:1 |
| Input border on surface (needs 3:1) | 3.5:1 | 3.7:1 |
| Rating star on white (needs 3:1) | 3.2:1 | — |

---

## Typography

| Family | Token | Role |
|---|---|---|
| **Fraunces** (serif) | `--font-display` | Headings from 20px up, course titles, hero. Gives a friendly, editorial voice. |
| **Source Sans 3** (sans) | `--font-body` | All UI, body, lesson text, buttons, forms, captions. Wide language support (Latin, Greek, Cyrillic, Vietnamese). |
| **JetBrains Mono** | `--font-mono` | Code blocks and inline code, durations (`12:48`), video timestamps, data values. |

Load from Google Fonts (see header of `variables.css`). Weights: 400 regular, 600 semibold, 700 bold.

**Other scripts:** for courses in Arabic, Hindi, Chinese, Japanese, etc., append a matching Noto family to `--font-body` and `--font-display` (e.g. `'Noto Sans Devanagari'`) and set `lang` on the content so the right glyphs load. Prefer a sans heading for scripts without a serif match. **Math:** render formulas with KaTeX or MathJax; they inherit `--color-text`.

### Type scale

All sizes use `rem` so they respect the learner's browser font setting. The three largest steps are fluid (`clamp`) and shrink on phones automatically.

| Role | Token | Size | Line height | Family / weight | Use |
|---|---|---|---|---|---|
| caption | `--text-caption` | 12px | 1.4 | Sans 400 | Image credits, legal, timestamps |
| small | `--text-small` | 14px | 1.5 | Sans 400 | Card metadata, helper text, tags |
| body | `--text-body` | 16px | 1.6 | Sans 400 | Default UI and body |
| body-lg | `--text-body-lg` | 18px | 1.7 | Sans 400 | **Lesson content**, course descriptions |
| label | `--text-body` | 16px | 1.25 | Sans 600 | Buttons, form labels, tabs |
| eyebrow | `--text-caption` | 12px | 1.4 | Sans 600, uppercase, `--tracking-wide` | "MODULE 2", section labels |
| subheading | `--text-subheading` | 18px | 1.4 | Sans 600 | Sidebar module names, list headers |
| heading-sm | `--text-heading-sm` | 20px | 1.35 | Serif 600 | Course card title, h4 |
| heading | `--text-heading` | 24px | 1.3 | Serif 600 | Section titles, h3 |
| heading-lg | `--text-heading-lg` | 28→36px | 1.2 | Serif 600 | h2 |
| display | `--text-display` | 36→56px | 1.1 | Serif 700, `--tracking-tight` | h1, course page title |
| hero | `--text-hero` | 44→72px | 1.05 | Serif 700, `--tracking-tight` | Homepage hero only |

---

## Spacing, layout & shape

**Spacing** — 4px base: `--space-1` (4) · `2` (8) · `3` (12) · `4` (16) · `5` (20) · `6` (24) · `8` (32) · `10` (40) · `12` (48) · `16` (64) · `20` (80) · `24` (96). Don't use values outside the scale.

| Layout token | Value | Use |
|---|---|---|
| `--container-max` | 1280px | Page container |
| `--container-padding` | 16→32px (fluid) | Side gutters — never below 16px |
| `--reading-max` | 70ch | Max width of lesson text and articles |
| `--sidebar-width` | 320px | Curriculum sidebar in the lesson player |
| `--header-height` | 64px | Sticky top nav |
| `--section-gap` | 48→96px (fluid) | Between page sections |
| `--card-padding` | 20px | Inside cards |
| `--grid-gap` | 24px | Between cards in grids |
| `--touch-target` | 44px | Minimum height/width of any tappable control |

### Breakpoints

CSS variables can't be used inside `@media`, so write the values directly:

| Name | Min width | Layout changes |
|---|---|---|
| (base) | 0 | 1-column course grid, curriculum as a bottom drawer, hamburger nav |
| `sm` | 40rem (640px) | 2-column course grid |
| `md` | 48rem (768px) | Full nav visible, 2-column footer |
| `lg` | 64rem (1024px) | 3-column grid, curriculum sidebar docked beside video |
| `xl` | 80rem (1280px) | 4-column grid, container reaches max width |

### Radius

| Token | Value | Use |
|---|---|---|
| `--radius-sm` / `--radius-tag` | 4px | Tags, badges, checkboxes |
| `--radius-md` / `--radius-button` / `--radius-input` | 8px | Buttons, inputs, dropdowns |
| `--radius-lg` / `--radius-card` | 12px | Course cards, video player, thumbnails |
| `--radius-xl` / `--radius-modal` | 16px | Modals, lightbox, hero media |
| `--radius-full` / `--radius-pill` | 9999px | Avatars, progress bars, filter chips |

### Elevation

| Token | Use |
|---|---|
| `--shadow-card` (`sm`) | Resting course cards |
| `--shadow-card-hover` (`md`) | Card hover lift (with `translateY(-2px)`) |
| `--shadow-dropdown` (`md`) | Menus, popovers, date pickers |
| `--shadow-modal` (`lg`) | Modals, image lightbox |

### Z-index

`--z-dropdown` 1000 · `--z-sticky` 1100 (header, mini player) · `--z-overlay` 1200 · `--z-modal` 1300 · `--z-toast` 1400 · `--z-tooltip` 1500.

### Motion

| Token | Value | Use |
|---|---|---|
| `--duration-fast` | 120ms | Hover, press, checkbox |
| `--duration-base` | 200ms | Dropdowns, accordions, tabs |
| `--duration-slow` | 320ms | Modals, drawers, progress bar fill |
| `--ease-standard` | `cubic-bezier(.2,0,0,1)` | Almost everything |
| `--ease-emphasized` | `cubic-bezier(.3,0,0,1.2)` | Celebrations: lesson complete, badge earned |
| `--ease-exit` | `cubic-bezier(.4,0,1,1)` | Elements leaving the screen |

Durations drop to 0 automatically under `prefers-reduced-motion: reduce`.

### Media aspect ratios

`--aspect-video` 16/9 · `--aspect-course-thumb` 16/10 · `--aspect-portrait` 4/5 (project galleries, instructor portraits) · `--aspect-avatar` 1/1.

---

## Components

### Buttons

| Variant | Style | Use |
|---|---|---|
| **Primary** | `--color-primary` fill, `--color-text-on-primary` label, hover `--color-primary-hover` | The one main action per view: Enroll, Buy, Continue lesson, Submit assignment |
| **Secondary** | `--color-bg-surface` fill, 1px `--color-border-strong`, `--color-text` label, hover `--color-bg-muted` | Preview course, Add to wishlist, Download resources |
| **Ghost** | Transparent, `--color-text-secondary` label, hover `--color-bg-muted` | Toolbar actions, Cancel, Skip |
| **Link** | `--color-accent`, underline on hover | Inline navigation |
| **Destructive** | `--color-error` fill, white label | Cancel subscription, Delete submission (always confirm) |

All buttons: `--radius-button`, label typography (16px / 600), padding `--space-3 --space-5`, min-height `--touch-target`, transition `--duration-fast`. Sizes: small (36px, 14px label — desktop toolbars only), default (44px), large (52px, hero). Disabled: `--color-disabled-bg` + `--color-disabled-text`, `cursor: not-allowed`. Loading: keep width, replace label with spinner + `aria-busy="true"`.

### Top navigation
Sticky, `--header-height`, `--color-bg-surface` with 1px `--color-border` bottom, `--z-sticky`. Left: logo. Center (≥md): search input. Right: Browse, My Learning, avatar menu; logged-out shows a secondary "Log in" and primary "Start learning". Active link: `--color-accent` text on `--color-accent-subtle`. Below `md`: hamburger opening a full-height drawer.

### Hero
Two options: (a) full-bleed photo of people learning with `--color-overlay` gradient and inverse text, or (b) `--color-bg-inverse` band with copy left and a product preview (lesson player screenshot or course card collage) right. Include a prominent search field ("What do you want to learn?") and popular subject chips beneath it. Hero typography, one primary + one secondary button, trust line below in `--text-small` (e.g. "12,000 students · 4.8 ★ average").

### Course card
The most important component.
- `--color-bg-surface`, 1px `--color-border`, `--radius-card`, `--shadow-card`; hover `--shadow-card-hover` + `translateY(-2px)`.
- Thumbnail at `--aspect-course-thumb`, `object-fit: cover`, top corners rounded. Optional overlay badge top-left ("New", "Bestseller") using a tag.
- Body (`--card-padding`): category tag → title (heading-sm, max 2 lines) → instructor name (small, `--color-text-secondary`) → meta row (small, `--color-text-muted`: rating ★ 4.8 (1,204) · 12 lessons · `3h 20m` in mono).
- Footer: price (subheading; strike-through old price in `--color-text-muted`) or, if enrolled, a progress bar with "45% complete".
- The whole card is one link (`<a>` wrapping or stretched link); wishlist heart is a separate button.

### Category tag / badge
`--radius-tag`, padding `--space-1 --space-2`, caption size 600 weight, category `-bg` / `-fg` tokens. Status badges use `--color-*-subtle` background with the matching status color text.

### Progress bar & ring
Height 8px, `--radius-full`, track `--color-progress-track`, fill `--color-progress-fill`, width animates with `--duration-slow`. Always paired with a text label ("7 of 12 lessons"). Use `role="progressbar"` with `aria-valuenow/min/max`. Ring variant (40px) for dashboard course tiles.

### Lesson player page
- **≥lg:** lesson content (video, reading, slides, interactive exercise or quiz) left, curriculum sidebar right at `--sidebar-width`, sticky under the header.
- **<lg:** video full width on top, tabs below (Overview · Curriculum · Resources · Q&A); curriculum opens as a bottom drawer.
- **Video player:** `--aspect-video`, `--radius-lg`, `--color-bg-inverse` chrome, controls with 44px targets, visible captions toggle, playback speed, and a sticky mini-player on scroll (`--z-sticky`).
- Below the video: lesson title (heading), "Mark complete" secondary button, primary "Next lesson →".
- Lesson text column max `--reading-max`, body-lg typography.

### Curriculum sidebar
Modules are accordions (subheading, with "3/5" count in muted). Lesson rows: 44px min-height, icon (▶ video · 📄 reading · ✎ assignment · ? quiz), title (small), duration (mono, muted), and state:
- **Completed:** ✓ in `--color-success`.
- **Current:** `--color-primary-subtle` background, 3px `--color-primary` left border, `aria-current="step"`.
- **Locked:** 🔒 icon, `--color-text-muted`, not clickable, with a tooltip explaining why.

### Quiz
Question in heading-sm; answer options are full-width selectable cards (`--radius-md`, 1px `--color-border-input`, 44px+ height). Selected: 2px `--color-accent` border + `--color-accent-subtle`. After submit: correct → `--color-success-subtle` + ✓ + explanation; incorrect → `--color-error-subtle` + ✕ + explanation. Use real radio/checkbox inputs under the hood.

### Assignment submission
Dropzone: 2px dashed `--color-border-input`, `--radius-lg`, `--color-bg-muted`; drag-over switches to `--color-primary` border + `--color-primary-subtle`. Show accepted formats (PDF, DOCX, images, ZIP, links) and max size. Alternative inputs: rich-text answer, link to repository, or audio/video recording. After submission show status badge: Submitted · Graded (score) · Needs revision, with instructor feedback in an info alert.

### Project gallery (optional — creative, design, portfolio courses)
Masonry or grid of `--aspect-portrait` tiles, click opens a lightbox (`--shadow-modal`, `--color-overlay` backdrop, arrow-key navigation, Esc to close). Credit the learner under each tile in caption text.

### Code block (optional — technology, data, science courses)
`--color-bg-muted` background, 1px `--color-border`, `--radius-md`, padding `--space-4`, mono typography, `overflow-x: auto`. Header row with language label (eyebrow) and a "Copy" ghost button that confirms with a toast. Inline code: `--color-bg-muted`, `--radius-sm`, padding `0 --space-1`, 0.9em mono. Syntax colors must meet 4.5:1 on the code background in both themes.

### Live session card
For webinars, live classes and office hours. Date block (day number in heading, month in eyebrow) on the left; title, instructor, time with timezone (mono) on the right. Status badge: Upcoming (info) · Live now (error color with pulsing dot, static under reduced motion) · Recording available (success). Primary "Join" button appears 10 minutes before start.

### Discussion / Q&A thread
Question card: avatar 32px, author + role badge ("Instructor", "TA"), relative time (muted), body text, upvote count, reply count. Replies are indented with a 2px `--color-border` left rule. Accepted answer: `--color-success-subtle` background with ✓ "Answered by instructor". Include lesson timestamp links (mono, accent color) that seek the video.

### Instructor card
Avatar 64px (`--radius-full`), name (subheading), headline / expertise (small, secondary), stats row (learners · courses · rating), short bio clamped to 3 lines, link to profile. Optionally show credentials (certifications, institution).

### Pricing card
`--radius-card`, `--card-padding` × 1.5. Plan name (eyebrow), price (display-sized number + small "/month"), feature list with ✓ in `--color-success`, full-width button. Recommended plan: 2px `--color-primary` border, "Most popular" badge, primary button; others use secondary buttons.

### Rating
Stars 16px in `--color-rating` (empty stars in `--color-border-strong`), numeric value next to them ("4.8"), review count in muted. Provide `aria-label="Rated 4.8 out of 5"`.

### Form inputs
`--color-bg-surface`, 1px `--color-border-input`, `--radius-input`, padding `--space-3 --space-4`, body text, min-height `--touch-target`. Label above (label typography), helper text below (small, muted). Focus: `--focus-ring`. Error: border `--color-error` + error message with icon, linked via `aria-describedby`. Never use placeholder as the label.

### Alerts & toasts
Alert: `--color-*-subtle` background, 4px left border in the status color, icon + title + text. Toast: `--color-bg-inverse`, inverse text, `--radius-md`, `--shadow-dropdown`, bottom-center on mobile / bottom-right on desktop, `--z-toast`, auto-dismiss after 5s (not for errors), `role="status"`.

### Certificate & achievements
Certificate preview on `--color-bg-surface` with a `--color-border-strong` double rule, Fraunces title, learner name in display size. Achievement badge unlock uses `--ease-emphasized` and a short scale-in; skip the animation under reduced motion.

### Empty states
Simple illustration or icon (max 200px), heading-sm, one sentence in secondary text, and one primary action ("Browse courses").

---

## Imagery

- **Content is the imagery.** Course thumbnails, lesson screenshots, diagrams and learner projects carry the visuals.
- Course thumbnails: consistent `--aspect-course-thumb`, one clear subject per image, no text baked into images (titles live in HTML for accessibility and translation).
- Photography: real, diverse learners and instructors in natural settings — avoid generic stock clichés (lightbulbs, graduation caps).
- Instructor photos: natural light, square crops, consistent background treatment.
- Diagrams and charts: flat, using semantic tokens; label directly instead of relying on color legends.
- Always set `alt` text that conveys the teaching point ("Bar chart: revenue doubled from 2022 to 2024"); decorative images use `alt=""`.
- Serve responsive images (`srcset`, WebP/AVIF) and `loading="lazy"` below the fold — catalog pages are image-heavy.
- Credit third-party or learner work in a caption (`--text-caption`, muted).

---

## Accessibility checklist

- [ ] Text pairs use the semantic tokens above (all verified AA). Don't invent new gray text colors.
- [ ] Every interactive element shows `--focus-ring` on `:focus-visible`.
- [ ] Tap targets ≥ `--touch-target` (44px).
- [ ] Status is conveyed with icon + text, not color alone.
- [ ] Videos have captions and transcripts; audio descriptions for demos where possible.
- [ ] All images, diagrams and charts have meaningful `alt` text; decorative images use `alt=""`.
- [ ] Readings and PDFs are also available as accessible HTML; formulas are screen-reader friendly (MathML via KaTeX/MathJax).
- [ ] Timed quizzes offer extended-time settings.
- [ ] Forms have visible labels and errors linked with `aria-describedby`.
- [ ] Animations respect `prefers-reduced-motion` (handled by the duration tokens).
- [ ] Page works at 200% zoom and 320px width without horizontal scrolling.
- [ ] Theme follows the OS and can be toggled with `data-theme` on `<html>`.

---

## Do's and Don'ts

### Do
- Use `--color-primary` for exactly one main action per screen.
- Use Fraunces for headings (20px+) and Source Sans 3 for everything else.
- Set lesson content in body-lg with `max-width: var(--reading-max)`.
- Let course content and thumbnails carry the color; keep UI neutral.
- Map every course to one of the six subject category tags.
- Show progress (bars, "7 of 12", checkmarks) wherever a learner is mid-course.
- Use semantic tokens in components so dark mode works automatically.
- Use mono for durations and timestamps so numbers align in lists.

### Don't
- Don't use terracotta for decoration, headings or large backgrounds — it means "act here".
- Don't use `--color-disabled-text` or `--color-border`/`--color-border-strong` for readable text.
- Don't use Fraunces below 20px or for buttons, forms, or long paragraphs.
- Don't hard-code hex values or px font sizes in components.
- Don't put text inside thumbnail images.
- Don't stack shadows beyond `--shadow-lg` or add shadows to flat elements like tags.
- Don't auto-play video with sound.
- Don't remove focus outlines.

---

## Quick start

```html
<!doctype html>
<html lang="en">  <!-- add data-theme="dark" or "light" to force a theme -->
<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Source+Sans+3:wght@400;600;700&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/design/variables.css">
</head>
```

```css
body {
  margin: 0;
  background: var(--color-bg-canvas);
  color: var(--color-text);
  font-family: var(--font-body);
  font-size: var(--text-body);
  line-height: var(--leading-body);
}

h1, h2, h3, h4 { font-family: var(--font-display); font-weight: var(--font-weight-semibold); }
h1 { font-size: var(--text-display); line-height: var(--leading-display); letter-spacing: var(--tracking-tight); font-weight: var(--font-weight-bold); }
h2 { font-size: var(--text-heading-lg); line-height: var(--leading-heading-lg); }
h3 { font-size: var(--text-heading); line-height: var(--leading-heading); }

a { color: var(--color-accent); }
a:hover { color: var(--color-accent-hover); }

:focus-visible { outline: none; box-shadow: var(--focus-ring); }

.container {
  max-width: var(--container-max);
  margin-inline: auto;
  padding-inline: var(--container-padding);
}

.btn-primary {
  display: inline-flex; align-items: center; justify-content: center; gap: var(--space-2);
  min-height: var(--touch-target);
  padding: var(--space-3) var(--space-5);
  border: 0; border-radius: var(--radius-button);
  background: var(--color-primary); color: var(--color-text-on-primary);
  font: var(--font-weight-semibold) var(--text-body) / 1.25 var(--font-body);
  cursor: pointer;
  transition: background-color var(--duration-fast) var(--ease-standard);
}
.btn-primary:hover { background: var(--color-primary-hover); }

.course-card {
  background: var(--color-bg-surface);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-card);
  box-shadow: var(--shadow-card);
  overflow: hidden;
  transition: box-shadow var(--duration-base) var(--ease-standard), transform var(--duration-base) var(--ease-standard);
}
.course-card:hover { box-shadow: var(--shadow-card-hover); transform: translateY(-2px); }
.course-card img { width: 100%; aspect-ratio: var(--aspect-course-thumb); object-fit: cover; display: block; }

.progress { height: 8px; border-radius: var(--radius-full); background: var(--color-progress-track); overflow: hidden; }
.progress > span { display: block; height: 100%; background: var(--color-progress-fill); transition: width var(--duration-slow) var(--ease-standard); }

.course-grid { display: grid; gap: var(--grid-gap); grid-template-columns: 1fr; }
@media (min-width: 40rem) { .course-grid { grid-template-columns: repeat(2, 1fr); } }
@media (min-width: 64rem) { .course-grid { grid-template-columns: repeat(3, 1fr); } }
@media (min-width: 80rem) { .course-grid { grid-template-columns: repeat(4, 1fr); } }
```

### Tailwind v4

Import the tokens and map the semantic ones into the theme. Theme names must differ from the source variable names (e.g. `--color-ok: var(--color-success)`), otherwise the variable would reference itself.

```css
@import "tailwindcss";
@import "./design/variables.css";

@theme inline {
  --color-canvas: var(--color-bg-canvas);
  --color-surface: var(--color-bg-surface);
  --color-muted: var(--color-bg-muted);
  --color-ink: var(--color-text);
  --color-ink-secondary: var(--color-text-secondary);
  --color-ink-muted: var(--color-text-muted);
  --color-brand: var(--color-primary);
  --color-brand-hover: var(--color-primary-hover);
  --color-link: var(--color-accent);
  --color-line: var(--color-border);
  --color-ok: var(--color-success);
  --color-warn: var(--color-warning);
  --color-danger: var(--color-error);
  --color-notice: var(--color-info);

  --font-serif: var(--font-display);
  --font-sans: var(--font-body);
  --font-code: var(--font-mono);

  --radius-tile: var(--radius-card);
  --radius-control: var(--radius-button);
  --shadow-raised: var(--shadow-card);
}
```

Then use classes like `bg-canvas text-ink font-serif rounded-tile bg-brand hover:bg-brand-hover text-danger`.

---

## Rebranding

The palette is a starting point. To change brand color, update `--color-primary`, `--color-primary-hover`, `--color-primary-subtle(-border)` and `--color-text-on-primary` in **all three theme blocks** of `variables.css` and in `tokens.json`, then re-check contrast: label on primary ≥4.5:1, primary as text on canvas ≥4.5:1.
