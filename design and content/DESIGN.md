# Craft Courses — Style Reference
> A dark studio wall with one yellow price tag: black canvas, white type, white cards pinned up like sketch sheets, and a single craft-yellow button that says "get this one".

**Theme:** dark
**Website:** Craft Courses (www.craft-course.com)
**Tokens file:** `design and content/variables.css` is the source of truth. This document explains how to use it.

## Website profile

Craft Courses sells self-paced craft and creative study materials: digital guides a learner buys, downloads or opens, and works through on their own. It is not a school. Nothing is attended live, and there are no classes, tutors or schedules.

- **What is sold:** study guides, learning materials and self-study resources, grouped by category and split into levels. Customer-facing copy never says "e-learning materials"; vary the synonyms instead.
- **Languages:** English and Japanese. Every font stack falls back to Noto Sans JP so Japanese text keeps the same weight and rhythm.
- **Currencies:** JPY, USD and HKD, switched from the header.
- **Company details:** the company name, email and address come from the database only. The company phone number is not shown anywhere.
- **Content rules:** `design and content/Content.md` governs all wording, labels, messages and policy pages.

## Design direction

The page canvas is black, like a studio wall at night. Content sits on white or sketch-paper cards with 30px corners that read as sheets pinned to that wall. Material cover images carry the colour, so the interface stays monochrome. Craft Yellow (#fff050) is the only interface colour and marks the one main action on each page. Headlines are set large in Bricolage Grotesque for a confident poster feel. Everything else (navigation, body copy, buttons, forms, prices and footer) uses Manrope.

Keep it simple: flat surfaces, no shadows, no gimmick widgets and no extra partials or scripts unless a page needs them.

## Tokens — Colors

| Name | Value | Token | Role |
|------|-------|-------|------|
| Studio Black | `#000000` | `--color-studio-black` | Page canvas, text on light cards and on the yellow button |
| Canvas White | `#ffffff` | `--color-canvas-white` | Main text on black, card surfaces, logo and nav text |
| Graphite | `#595959` | `--color-graphite` | Muted text **on white or sketch-paper cards only** (7:1 on white). Never on black |
| Pencil Grey | `#a3a3a3` | `--color-pencil-grey` | Muted text on the black canvas: captions, metadata, footer copy (8.6:1 on black) |
| Chalk Line | `#dddddd` | `--color-chalk-line` | Hairline borders and dividers on light cards |
| Sketch Paper | `#f5f5f5` | `--color-sketch-paper` | Soft card surface, input fills, policy page cards |
| Craft Yellow | `#fff050` | `--color-craft-yellow` | **Main action colour.** One main button per page, focus ring, small highlighted icons |
| Craft Yellow Deep | `#f2e03a` | `--color-craft-yellow-deep` | Hover and pressed state of the yellow button |
| Indigo Wash | `#dfe3ff` | `--color-indigo-wash` | Tinted surface behind material covers, empty states and the newsletter card |
| Iris Glaze | `#bec8ff` | `--color-iris-glaze` | Stronger tint for hero image frames and image placeholders |
| Error | `#ff6b6b` | `--color-error` | Error text and borders on black |
| Error Ink | `#b42318` | `--color-error-ink` | Error text and borders on white cards |
| Success | `#5fd38d` | `--color-success` | Success text on black |
| Success Ink | `#1e7a45` | `--color-success-ink` | Success text on white cards |

### Semantic aliases

Components use these aliases rather than raw colour names, so the palette can change in one place.

| Alias | Points to |
|-------|-----------|
| `--color-bg` | Studio Black |
| `--color-text` | Canvas White |
| `--color-text-muted-dark` | Pencil Grey |
| `--color-text-on-light` | Studio Black |
| `--color-text-muted-light` | Graphite |
| `--color-border-dark` | `rgba(255,255,255,0.18)` |
| `--color-border-light` | Chalk Line |
| `--color-primary` / `--color-primary-hover` | Craft Yellow / Craft Yellow Deep |
| `--color-on-primary` | Studio Black |

## Tokens — Typography

### Bricolage Grotesque — display · `--font-display`
- Loaded from Google Fonts at weight 400 (add 600 only if a heading truly needs it).
- Used **only at 32px and above**: hero headline, page titles, section headings and big statements.
- Never used for nav, buttons, prices, form labels or body text.
- Line height 1.0–1.2, no extra letter spacing.

### Manrope — interface and body · `--font-body`
- Loaded from Google Fonts at weights 200, 400, 500 and 700.
- 400–500 for body and nav, 700 for button labels, prices and emphasised labels, 200 only for large, light secondary text (18px and above).
- Line height 1.44–1.67.

### Noto Sans JP — Japanese fallback
- Loaded from Google Fonts at 400, 500 and 700, and sits second in both stacks.

### Type scale

| Role | Family | Size | Line height | Token |
|------|--------|------|-------------|-------|
| caption | Manrope | 12px | 1.5 | `--text-caption` |
| body-sm | Manrope | 14px | 1.5 | `--text-body-sm` |
| body-lg | Manrope | 16px | 1.67 | `--text-body-lg` |
| subheading | Manrope | 18px | 1.5 | `--text-subheading` |
| subheading-lg | Manrope | 20px | 1.44 | `--text-subheading-lg` |
| heading-sm | Manrope 700 | 24px | 1.42 | `--text-heading-sm` |
| heading | Bricolage | 32–40px | 1.2 | `--text-heading` |
| heading-lg | Bricolage | 36–60px | 1.15 | `--text-heading-lg` |
| display | Bricolage | 40–100px | 1.0 | `--text-display` |
| display-xl | Bricolage | 48–140px | 1.0 | `--text-display-xl` |

The heading and display sizes use `clamp()`, so they shrink on phones and never overflow at 375px wide. Body text stays between 14px and 20px. Nothing is set below 12px.

## Tokens — Spacing, layout and shape

**Density:** comfortable.

- **Spacing scale:** 5, 10, 15, 20, 30, 40, 50, 60, 80, 100, 120px (`--spacing-*`).
- **Page max width:** 1200px (`--page-max-width`), with a 16–40px side gutter (`--page-gutter`).
- **Section gap:** 50–80px (`--section-gap`).
- **Card padding:** 20–30px (`--card-padding`).
- **Element gap:** 10px (`--element-gap`).
- **Form width:** 480px max (`--form-max-width`).

| Element | Radius | Token |
|---------|--------|-------|
| Tags, level badges | 4px | `--radius-tags` |
| Inputs, selects | 10px | `--radius-inputs` |
| Small buttons | 10px | `--radius-buttons-sm` |
| Buttons | 20px | `--radius-buttons` |
| Cards, modals, image frames | 30px | `--radius-cards` |

Buttons are never fully round pills.

## Surfaces and elevation

| Level | Token | Value | Use |
|-------|-------|-------|-----|
| 0 | `--surface-canvas` | `#000000` | Every page background |
| 1 | `--surface-card` | `#ffffff` | Material cards, forms, detail panels |
| 1 | `--surface-card-soft` | `#f5f5f5` | Policy text, order tables, input fills |
| 2 | `--surface-wash` | `#dfe3ff` | Cover backdrops, newsletter card, empty states |
| 3 | `--surface-glaze` | `#bec8ff` | Hero image frame, image placeholders |

- **Cards:** flat, no shadow.
- **Modals:** backdrop `--overlay-backdrop` (black at 70%).
- **Focus:** `--focus-ring` (a black gap, then a 2px yellow ring) on every link, button, input and card link.
- **Motion:** `--transition-fast` (160ms) for hover colour changes and `--transition-base` (240ms) for small lifts. Respect `prefers-reduced-motion`.

## Components

### Header
Black bar at full width, content inside the 1200px column. The Craft Courses wordmark sits on the left in Manrope 700, white. Nav links are in Manrope 15px / 500: Home, About Us, Study Materials, Contact Us. On the right are the language and currency switchers as small ghost buttons, then the account and cart links. On phones the nav collapses behind a menu button into a full-screen black panel.

### Buttons
- **Primary (yellow):** Craft Yellow fill, black Manrope 700 text at 15–16px, 20px radius, 14px × 28px padding. Hover goes to Craft Yellow Deep. Only one per view: Add to Cart, Checkout, Pay Now, Send Message or Subscribe.
- **Ghost:** transparent, 1px white border, white Manrope 700 text, 10px radius. It fills white with black text on hover. Used for secondary actions such as View Details, Log In and the switchers.
- **Dark on light:** a black fill with white text, for secondary actions inside white cards.

### Hero
An asymmetric split. The left side holds a Bricolage display headline in white, a short Manrope 18px intro in Pencil Grey and one yellow button to the study materials. The right side holds a cover collage in an Iris Glaze frame with a 30px radius. There is no full-bleed photograph.

### Category tile
A white card with a 30px radius, the category image on an Indigo Wash backdrop, the category name in Manrope 700 at 20px (black), and a count or short line in Graphite. The whole tile is one link. Categories come from the database; nothing is hard-coded.

### Material card
A white card with a 30px radius. It holds:
- The cover image in a 4:3 frame with a 20px radius. If the file is missing, show an Iris Glaze placeholder.
- A category tag (4px radius, Sketch Paper fill, 12px Manrope 500).
- The title in Manrope 700 at 18px, black, clamped to two lines.
- A row with the price in Manrope 700 at 20px and a small dark "View Details" button.

Use a 3-column grid on desktop, 2 on tablet and 1 on phone, with a 20–30px gap.

### Material detail
On desktop, two columns: the cover in an Iris Glaze frame on the left, and a white detail card on the right. The card holds the title (Bricolage heading-lg), the category tag, level tabs or selector, the price and the single yellow Add to Cart button. Below them come the description, what is covered by level, and a delivery note. Long text sits in a Sketch Paper card, never directly on black.

### Level badge
A 4px radius and Manrope 12px / 700 in uppercase. All levels use black text on Sketch Paper. The active or selected level uses black text on Craft Yellow.

### Forms (login, register, forgot password, contact, checkout)
A single white card, centred, 480px max, with a 30px radius. Each field has its own row; fields never sit side by side, and that includes password and confirm password. Labels are Manrope 14px / 500 in black. Inputs have a Sketch Paper fill, a 1px Chalk Line border and a 10px radius; on focus they get a white fill, a black border and `--focus-ring`. Error text is Error Ink at 13–14px under the field. The form ends with one full-width yellow submit button.

### Policy pages (Terms, Privacy, Refund, Delivery)
The page title is Bricolage on black. The body sits in one Sketch Paper card with a 30px radius and a text column of about 760px max. Section headings are Manrope 700 at 20px and body text is Manrope 16px / 1.67, both in black. Sections are numbered and set apart with Chalk Line dividers.

### Cart, checkout, orders and dashboard
Tables and summaries sit in white cards. Row dividers are Chalk Line. Prices are Manrope 700. The order total row has a Sketch Paper fill. Status labels are text badges (Paid, Pending, Refunded) in Graphite on Sketch Paper, not coloured pills.

### FAQ row
No card: each row is transparent on black with a bottom border in `--color-border-dark`. The question is Manrope 18–20px / 500 in white, with a chevron on the right. The answer is Pencil Grey at 16px.

### Newsletter
An Indigo Wash card with a 30px radius, a black Bricolage heading, one email field and a yellow Subscribe button. The success message is the exact text from Content.md.

### Footer
The footer is the one full-width light surface: a Sketch Paper (#f5f5f5) sheet with 30px rounded top corners, sitting on the black page. Text is black, and muted text is Graphite.

- **Top row:** on the left, the logo, a one-line intro, and the company name, email and address from the database (no phone number). On the right, the newsletter as a black card with a yellow label and a yellow Subscribe button. The success message appears under the form after a valid submit, and the form stays in place.
- **Link row:** four columns (Study Guides with up to four categories, Company, Account and Policies). They become 2 × 2 on tablets and phones.
- **Base row:** the copyright line (linked to the home page), the payment image and a square back-to-top button.

Hovers match the header: simple colour changes only. Links go from Graphite to black, the back-to-top button's outline turns black, and Subscribe uses the normal yellow button hover.

## Imagery
Material covers and category images carry all the colour on the site. Frame them in rounded containers (20–30px radius) on Indigo Wash or Iris Glaze. Every image has a placeholder frame, so pages still render cleanly with no image files present. No full-bleed hero photography and no stock photos of people. Icons are flat, line-style and white; only small highlighted icons use Craft Yellow.

## Do's and don'ts

### Do
- Use Craft Yellow for the one main action per view, the focus ring and small highlighted icons.
- Keep every page on the black canvas and use white or sketch-paper cards to separate content.
- Put long reading text (policies, descriptions, forms and tables) inside light cards.
- Use Bricolage only at 32px and above, and Manrope for everything else.
- Use Pencil Grey for muted text on black and Graphite for muted text on white.
- Use the 30px radius on all cards, modals and image frames.
- Check every page at 375px wide: no horizontal scroll and a 16px minimum gutter.

### Don't
- Don't add new accent colours for the interface. Error and success colours are only for form and system messages.
- Don't use yellow for secondary buttons, backgrounds or large decorative fills.
- Don't add box shadows to cards or buttons.
- Don't use Graphite (#595959) text on the black canvas.
- Don't use fully round pill buttons.
- Don't set text below 12px or body text above 20px.
- Don't alternate section backgrounds between black and grey.

## Quick colour reference
- **Background:** #000000
- **Text:** #ffffff
- **Muted text on black:** #a3a3a3
- **Muted text on white:** #595959
- **Border on light:** #dddddd
- **Border on dark:** rgba(255,255,255,0.18)
- **Primary action:** #fff050 with #000000 text
- **Hover:** #f2e03a
- **Error:** #ff6b6b on dark, #b42318 on light
- **Success:** #5fd38d on dark, #1e7a45 on light

## Font loading

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;600&family=Manrope:wght@200;400;500;700&family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
```
