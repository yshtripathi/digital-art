# Word Craftsman — Style Reference
> quill violet on a clean white page

**Website:** https://www.word-craftsman.com/
**Subject:** self-study materials for **writing** and **language learning**
**Theme:** light
**Tokens:** `variables.css` (source of truth) · **Site stylesheet:** `public/css/word-craftsman.css`

## Website profile

Word Craftsman is an e-learning website that sells digital, self-paced study materials. Learners read and work through them on their own; nothing is attended live. Materials are grouped into five categories:

| # | Category | Covers | Class key | Mark colour |
|---|---|---|---|---|
| 1 | **Writing for Digital Media & Influencers** | Social posts, blogs, newsletters, video scripts, personal-brand content | `digital` | Quill Violet `#693edf` |
| 2 | **Business & Technical Writing** | Emails, reports, proposals, documentation, manuals, workplace writing | `business` | Royal Script `#3b0d96` |
| 3 | **AI-Powered Writing & Language Tools** | Using AI assistants for drafting, editing, translation and language practice | `ai` | Margin Violet `#7249f1` |
| 4 | **Language Learning for Global Communication** | Foreign languages and English for international study, work and travel | `language` | Midnight Ink `#29007a` |
| 5 | **Creative & Professional Writing** | Fiction, poetry, storytelling, copywriting, editing and freelance writing | `creative` | Manuscript Iris `#4f1bb7` |

Category names and descriptions shown on the site come from the database (`categories` table) and are never hard-coded in views. The class key is only used for styling (`.badge--digital`, `.card--digital` and so on).

Word Craftsman looks like a well-kept notebook: a white page, crisp black type and one vivid violet, like ink from a quill, marking what matters. The design is confident but quiet. Bold grotesque headings give titles presence. A 4px corner on every surface keeps things neat and precise, like a ruled margin. Depth comes from the violet gradient band and a thin pressed edge on buttons, never from drop shadows. Components are flat and grid-aligned, and cards sit on white so text stays easy to read.

---

## Tokens — Colors

### Violet (brand)

| Name | Value | Token | Role |
|------|-------|-------|------|
| Quill Violet | `#693edf` | `--color-quill-violet` | The brand colour. Primary buttons, links, active states, focus and the top of the gradient |
| Manuscript Iris | `#4f1bb7` | `--color-manuscript-iris` | Hover and pressed state for violet buttons. Second gradient stop and learning-path cells |
| Plum Ink | `#4514a6` | `--color-plum-ink` | Middle gradient stop. Panels on violet backgrounds |
| Royal Script | `#3b0d96` | `--color-royal-script` | Violet text on light tints (badges, alerts). Fourth gradient stop |
| Midnight Ink | `#29007a` | `--color-midnight-ink` | Deepest gradient stop. Language Learning category mark |
| Lavender Page | `#c1b9f4` | `--color-lavender-page` | Soft violet for highlights on dark violet, text selection and hover borders on cards |
| Lavender Wash | `#efebfc` | `--color-lavender-wash` | Pale violet background for badges, info alerts and soft panels |
| Margin Violet | `#7249f1` | `--color-margin-violet` | Outlined badges, illustration lines and decorative connectors |

### Neutrals

| Name | Value | Token | Role |
|------|-------|-------|------|
| Ink | `#000b0f` | `--color-ink` | Headings on light backgrounds |
| Typeset | `#171717` | `--color-typeset` | Main text and icon colour. Also the footer and notice strip background |
| Graphite | `#222222` | `--color-graphite` | Strong nav and label text |
| Slate | `#364045` | `--color-slate` | Muted headings and quote text |
| Pencil | `#566b76` | `--color-pencil` | Body paragraphs, descriptions and helper text. The most-used grey |
| Lead | `#5d5d5d` | `--color-lead` | Less prominent utility text |
| Eraser | `#878787` | `--color-eraser` | Placeholders and icons only, never body text |
| Smudge | `#a6a6a6` | `--color-smudge` | Light decorative lines and breadcrumb separators |
| Margin Line | `#ccd9e0` | `--color-margin-line` | Outlined button borders |
| Page Rule | `#e2e8eb` | `--color-page-rule` | Dividers and card borders |
| Blotter | `#e4edf1` | `--color-blotter` | Input borders and image placeholders |
| Notebook | `#f6fafb` | `--color-notebook` | Page background. Off-white with a faint cool tint |
| Paper | `#ffffff` | `--color-paper` | Cards, header, inputs and text on dark fills |
| Carbon Copy | `#1d2130` | `--color-carbon-copy` | Borders on dark elements |
| Charcoal | `#333333` | `--color-charcoal` | Small UI text |
| Typewriter | `#535866` | `--color-typewriter` | Illustration and SVG line colour |

### Categories

All five categories stay inside the violet family, so there is still only one brand hue. Each category has a **mark colour** (see Website profile) used for the 8px square in its badge and the 3px top border on its cards.

| Token | Value | Category |
|---|---|---|
| `--color-cat-digital` | `#693edf` | Writing for Digital Media & Influencers |
| `--color-cat-business` | `#3b0d96` | Business & Technical Writing |
| `--color-cat-ai` | `#7249f1` | AI-Powered Writing & Language Tools |
| `--color-cat-language` | `#29007a` | Language Learning for Global Communication |
| `--color-cat-creative` | `#4f1bb7` | Creative & Professional Writing |
| `--color-cat-badge-bg` | `#efebfc` | Shared badge background |
| `--color-cat-badge-text` | `#3b0d96` | Shared badge text |

Every badge shares the same Lavender Wash background and Royal Script text; only the small square changes. The category name is always written out, so colour is never the only signal.

### Status

| Name | Text | Background |
|---|---|---|
| Success | `#1f7a4d` | `#e8f5ee` |
| Error | `#b42318` | `#fdecea` |
| Warning | `#8a5a00` | `#fff4dc` |
| Info | Royal Script | Lavender Wash |

### Contrast (WCAG AA)

| Pair | Result |
|---|---|
| White on Quill Violet | ≈ 6.3 : 1 — pass |
| Quill Violet on white | ≈ 6.3 : 1 — pass |
| Pencil on Notebook | ≈ 5.1 : 1 — pass |
| Royal Script on Lavender Wash | ≈ 10 : 1 — pass |
| Quill Violet on Lavender Page | ≈ 3.4 : 1 — **fail for small text**, don't use |
| Eraser on white | ≈ 3.5 : 1 — icons and placeholders only |

---

## Tokens — Typography

| Family | Token | Role |
|---|---|---|
| **Space Grotesk** | `--font-heading` | Headings (H1–H4), prices, the preloader name and monogram. Weights 500 and 600. Tight tracking at large sizes gives the precise, drafted feel |
| **Inter** | `--font-body` | All other text: body, nav, buttons, labels, badges, forms, tables. 400 body, 500 labels, 600 buttons and nav, 700 strong callouts. `"cv11", "ss01"` on |
| **Noto Sans JP** | `--font-ja` | Replaces both on Japanese pages |

All three are free on Google Fonts:

```html
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap">
```

### Type scale

| Role | Family / weight | Size | Line height | Letter spacing | Token |
|---|---|---|---|---|---|
| caption | Inter 500–600 | 12px | 1.5 | -0.24px | `--text-caption` |
| body-sm | Inter 400–600 | 14px | 1.57 | -0.28px | `--text-body-sm` |
| body | Inter 400 | 16px | 1.5 | -0.08px | `--text-body` |
| reading | Inter 400 | 17px | 1.7 | 0 | `--text-reading` |
| lead | Inter 400 | 18px | 1.6 | 0 | `--text-lead` |
| subheading (H4) | Space Grotesk 500 | 24px | 1.31 | 0.12px | `--text-subheading` |
| heading-sm (H3) | Space Grotesk 600 | 28px | 1.31 | -0.56px | `--text-heading-sm` |
| heading | Space Grotesk 600 | 32px | 1.4 | -0.64px | `--text-heading` |
| heading-lg (H2) | Space Grotesk 600 | 48px | 1.18 | -0.96px | `--text-heading-lg` |
| display (H1) | Space Grotesk 600 | 56px | 1.05 | -1.12px | `--text-display` |
| display-lg (hero) | Space Grotesk 600 | 88px | 1 | -1.76px | `--text-display-lg` |

On phones the large sizes scale down (hero 44px, H1 38px, H2 32px).

### Type rules
- 12px is the minimum, used only for captions and badges. Paragraphs are 14–18px.
- Material descriptions and policy pages use the reading size and stop at `--reading-max-width` (720px).
- **Italics are allowed only inside content:** example sentences, foreign words (with a `lang` attribute), quotes and titles of books or films. UI labels, buttons and headings stay upright.

---

## Tokens — Spacing and shape

**Base unit:** 4px · **Density:** comfortable

**Spacing steps:** 4, 8, 12, 16, 20, 24, 28, 32, 36, 40, 48, 52, 60, 64, 80, 84, 100 (`--spacing-*`)

| Layout | Value |
|---|---|
| Page max width | 1200px |
| Reading width | 720px |
| Form width | 480px |
| Section gap | 80px (48px on phones) |
| Card padding | 24px |
| Grid gap | 24px |

**Radius:** 4px on everything: cards, badges, images, inputs and buttons. Nothing larger.

| Shadow | Value | Token | Use |
|---|---|---|---|
| Pressed edge | `rgba(204, 217, 224, 0.2) 0 -3px 0 0 inset` | `--shadow-pressed` | All filled and outlined buttons |
| Light hairline | `rgba(255, 255, 255, 0.1) 0 1px 0 0` | `--shadow-hairline-light` | Top edge of panels on dark violet |
| Float | `0 8px 24px rgba(23, 23, 23, 0.1)` | `--shadow-float` | Dropdowns, cart popover and modals only |

---

## Components

### Primary button
Quill Violet background, white Inter 600 at 14px, 4px radius, 12px × 24px padding, minimum 48px tall. It has the pressed-edge inset shadow. Hover: Manuscript Iris. Use one per view for the main action: *Browse materials*, *Add to cart*, *Sign up*.

### Outlined button
Transparent background, 1px Margin Line border, Typeset text in Inter 500–600 at 14px, with the same pressed edge. Hover: border and text turn Quill Violet. Use it for secondary actions such as *View details*.

### Text button
No background or border, Pencil text, turning Quill Violet on hover. Use it for low-emphasis links such as *Learn more*.

### Light button (on violet)
White background with Ink text. Hover: Lavender Wash background and Royal Script text. It is the only button used on the gradient band.

### Hero gradient band
A full-width band using `--gradient-quill`, running top to bottom. It has:
- A small uppercase eyebrow in Lavender Page.
- A Space Grotesk headline of 56–88px in white, two lines at most.
- An 18px lead in white at 82% opacity.
- A light button plus an outlined-white button.

The right side can show a white card listing the five categories, or a simple line illustration of a pen nib and speech bubble. There are no counters and no statistics.

### Learning path strip
A row of four white dot connectors on the gradient, each with a short label: **Choose a subject → Pick your level → Study at your own pace → Put it into practice**. It explains how the site works without making promises.

### Category cells
Five cells, one per category, on a Manuscript Iris → Royal Script background: 3 columns on desktop (the last row of two centred), 2 on tablet, 1 on phones. Each cell has a 3px top border in its category mark (Lavender Page for the darker marks so it stays visible) and sits on a semi-transparent Midnight Ink panel with a 4px radius and 24px padding. It holds a white Space Grotesk 24px heading, a 14px Inter description at 85% white and a light button. There are no drop shadows; depth comes only from the colour shift.

### Material card
White card on the Notebook background, 1px Page Rule border, 4px radius, 24px padding, no shadow. Top to bottom:
1. A 16:9 image (4px top corners), with a Blotter placeholder if there is none.
2. The category badge.
3. The title in Space Grotesk 500 at 24px, two lines at most.
4. A one-line summary in Inter 14px Pencil.
5. The level name (Beginner, Intermediate, Advanced or Expert) as a caption.
6. A footer row: price in Space Grotesk 600 at 24px, then an outlined *View details* button.

Hover: the border turns Lavender Page.

### Category badge
Inter 600 at 12px, uppercase with 0.04em tracking, 4px radius, 4px × 8px padding, Lavender Wash background, Royal Script text, and an 8px square in the category mark colour before the name (`.badge--digital`, `--business`, `--ai`, `--language`, `--creative`). Long names may wrap onto two lines; never shorten them. Use a neutral version (Notebook background, Page Rule border, Pencil text) for levels and other meta.

### Newsletter signup (letter card)
A `--gradient-quill` card at the top of the footer, with an animated **airmail edge** (white and Lavender Page diagonal stripes sliding along the bottom) and a large Lavender Page opening quote mark (“) in the corner. Left: an outlined uppercase tag with an envelope icon, a Space Grotesk 40px title and a short line. Right: a visible label and one "envelope slot" row — a translucent Midnight Ink frame holding the transparent email input and a white *Join the List* button with a violet arrow tile (the arrow flies through on hover). Focus brightens the frame with a lavender ring. An invalid email shakes the frame and shows a pale red message under it. On success the form stays in place, the frame turns white, and a message bar rises in underneath it (translucent white with a solid white left edge and a small check tile) reading exactly *Thank you for subscribing* (JA: ご登録ありがとうございます). It clears after 5 seconds. Stacks into one column on phones.

### Forms (sign in, sign up, contact, checkout)
A centred white card, 480px wide, with a 1px Page Rule border and 32px padding (24px on phones). **Strictly one field per row**; never put two fields side by side. Labels are Inter 500 at 14px in Typeset, 8px above the field. Helper and error text is 12px. The submit button is a full-width primary button.

### Navigation bar (floating masthead)
A floating white bar (`.mast__shell`) inset 12px from the page edges, 68px tall, 1px Page Rule border, 4px radius. On scroll it tightens to 60px, gains `--shadow-float` and a Lavender Page border.
- **Left:** logo (34px tall).
- **Centre:** Home, Materials, **Categories** (mega dropdown), About, Contact. Links are Inter 500 at 14px in Pencil. Hover fills the link with Lavender Wash rising from the bottom and turns the text Royal Script. The active page shows a small Quill Violet diamond under the label that pops in, and uses Ink 600.
- **Right tools** (40px square-cornered buttons): a preferences button showing the selected language's flag and code, then the selected currency's symbol (in a small Lavender Wash tile) and code, that opens the language and currency panel; for members, a credits pill and an avatar button that opens the account menu; for guests, *Log In* text plus a small *Create Account* button; the cart button with a violet count tag. Below 1100px everything except the credits pill and cart moves into the menu drawer and a burger button appears.

### Dropdowns
White panel, 1px Page Rule border with a 2px Quill Violet top edge, `--shadow-float`, 4px radius. They open on hover (desktop) and click (touch/keyboard), fading in while rising 8px, and close on Escape, outside click or focus leaving.
- **Categories mega panel:** spans the whole masthead. Left: the categories from the database in two columns, each with its mark square (turns 45° on hover), name, two-line summary, subcategory chips and an arrow that slides in on hover. Right: a 300px `--gradient-quill` aside with the tagline, a short line, a light *Browse* button and the help email. Mark colours follow the alphabetical order of the categories (AI, Business, Creative, Language, Digital).
- **Language and currency:** languages as rows with flag and tick; currencies as a 3-column grid of tiles, the active one filled violet.
- **Account:** header with avatar and name on Notebook, then My Account, My Materials, Buy Credits (with balance tag), and a red *Log Out* row.

### Cart drawer
Slides in from the right (420px) over a blurred Midnight Ink veil. The head is a `--gradient-quill` band with the site name eyebrow, *Your Cart* title and a white count tag. Items are bordered cards: 64px thumbnail (credits packs show a coin tile), neutral level badge, two-line title, quantity × credits and a trash button that turns red on hover. Items slide in one after another. The foot on Notebook has a total card (dashed rule, Space Grotesk total), the main button, an outlined secondary button and a *Continue browsing* link. The empty state shows a lavender bag tile with a dashed outline.

### Menu drawer (phones and tablets)
Slides in from the left (360px). Member card, large Space Grotesk links that indent and show an arrow on hover, a Categories accordion with mark squares, a language segmented control, currency tiles, the help email, and full-width account buttons at the bottom.

### Notice strip
A thin bar (about 40px) in Typeset with white Inter 500 text at 13–14px and a small light button. Use it for real site notices only, such as new materials or policy updates.

### Section header
An eyebrow in Quill Violet (Inter 600 at 12px, uppercase), an H2 of 48px in Ink, and a lead of 18px in Pencil, 640px wide at most. It is left-aligned by default. Leave 40px below the block before the content starts.

### Example / quote block
White background with a 3px Quill Violet left border, 16px × 24px padding, and Slate text. Italics are allowed here for example sentences and quotations.

### Alerts
Full width, a 4px left border in the status colour, the status tint as background, 16px padding and 14px Typeset text.

### Tables (orders, credits, receipts)
White, with a 1px Page Rule border and a 4px radius. The header row is Notebook with 12px uppercase Pencil labels. Rows are 14px with Page Rule dividers.

### Footer
White background with a Page Rule top border, in three layers:
1. **Newsletter letter card** (see Newsletter signup).
2. **Link grid** (1.5fr + 3 columns; 2 on tablet with the brand spanning the row; 1 on phones):
   - **Brand:** logo, short About line and the categories from the database as chips. On hover a chip lifts 3px, turns Lavender Wash with a border and a 3px under-edge in its category mark colour (a pressed tab), and its square stretches into a bar.
   - **Learning** and **Legal & Policies:** Pencil links. On hover the label rolls up and a Quill Violet copy of it rolls in from below, while a long arrow slides in after it.
   - **Get in Touch:** company name, email and address from the database, each with an outlined icon tile that floods with the violet gradient from its bottom-left corner on hover (icon turns white). The email turns violet and opens its letter spacing slightly.
   - Column heads are 12px uppercase Ink with a hairline and a short violet stub under them.
3. **Base strip** in Typeset: © year + company name (linked to home; on hover it gets a small solid violet tag behind it) + the copyright text, and the payment image on a small white tile.

A **back-to-top** square (44px, Quill Violet) appears after 320px of scroll, with a Lavender Page **progress ring** that travels around its square border as the page scrolls; on hover the arrow flies out the top and back in from below.

### Page header / breadcrumb band
No photo or video — built only from theme elements. A full-width `--gradient-quill` band (compact version when a page has no title) with:
- A fine white **dot grid** (22px spacing) that drifts slowly, visible only in a soft oval on the right, over a gently breathing Margin Violet **glow** in the top-right corner. No ruled lines anywhere on the site.
- **Glyph tiles** on the right half: letters from several scripts and writing marks (A, あ, Ж, ¶, ع, 한, “) in 58px square tiles — some outlined, some softly filled — that rise in one by one and then drift gently. They shrink on tablets and are hidden on phones.
- **Trail:** each earlier step is a small translucent chip (the first with a home icon) separated by tiny chevrons; on hover a chip turns white with Royal Script text and lifts 2px. The current page is a solid white chip with a violet square that turns now and then.
- **Title:** Space Grotesk 34–56px in white that comes into focus from a soft blur. No underline, stroke or highlighter under the text.

### Toast messages (success / error)
Session messages appear as toasts **centred at the top**, 12px below the floating masthead (or 16px from the top where there is no masthead), 460px wide (full width minus 12px on phones). White card, 1px Page Rule border, 4px radius, soft violet shadow, and a **folded corner** at top-right in the status colour that folds in after the card lands.
- 40px icon tile (green tick on Success tint, red exclamation on Error tint) that stamps in with a small spin.
- Space Grotesk title (*Success* / *Something went wrong*) above the message in Pencil.
- Square close button; on hover it turns Lavender Wash and the × shrinks slightly.
- Success toasts auto-close after 5s, shown by a violet time bar draining along the bottom edge; hovering or focusing pauses it. Error toasts stay until closed. Escape closes all.
- Enters by dropping in from above; leaves by lifting up and fading.
- Styles live inside the view (with fallbacks) so it looks the same on the storefront and the member dashboard; it renders once per page.

### Cookie consent card
A floating card anchored **bottom-left** (20px from the edges, 440px wide) so it never covers the back-to-top button on the right; on phones it stretches across the bottom with 12px insets. White, 1px Page Rule border, 4px radius, soft violet shadow, a 4px `--gradient-quill` strip along the top, and it rises in 0.6s after the page loads.
- **Head:** 44px gradient icon tile with a cookie, Space Grotesk 18px title, 14px intro; the policy link has a lavender underline that fills behind the text on hover.
- **Actions:** *Accept all* (primary violet) and *Essentials only* (outlined) side by side, then a full-width dashed *Customize* button with a sliders icon that turns solid lavender on hover or when open.
- **Preferences:** unfold smoothly between the head and the actions on a Notebook background (scrolls at 46% of the screen height). Each category is a white bordered card: Space Grotesk name, a lock tile for essentials, and a square-cornered 44×24 toggle (violet when on, lavender and locked for essentials). *Show details* unfolds the cookie list: monospace names, a Lavender Wash duration tag and a lavender left rule. A dark *Save settings* button closes the panel.

### Preloader
A full-screen `--gradient-quill` overlay with a slow rotating **light sweep** (a soft conic beam of Lavender Page and Margin Violet circling behind the content). CSS-only; hides itself after about 1.9s; not shown with reduced motion. Centred, top to bottom:
1. **Monogram tile:** 64px white square, 4px radius, site initials in Quill Violet Space Grotesk 600; pops in.
2. **Site name:** white Space Grotesk 600 at 34–56px, rising from behind a mask.
3. **Five-step loader:** five 10px outlined squares that fill white, hop up and turn 45° one after another in a loop — one step per category.
4. **Category chips:** the category names from the database, one chip each, fading up in turn with a small Lavender Page square.
5. **Tagline:** `frontend.head.topic` in uppercase Inter 600 at 12px, white at 72%.

---

## Do's and Don'ts

### Do
- Use Space Grotesk for all headings of 24px and above, and Inter for everything else.
- Use a 4px radius everywhere.
- Use the violet gradient only for full-width bands (hero, category cells, preloader).
- Give every button the pressed-edge inset shadow.
- Use Quill Violet as the one accent colour for primary buttons, links, active states and focus.
- Keep white cards on the Notebook page background, separated by space and hairline borders.
- Show the category and level as text, not colour alone.
- Keep content universal: subject wording comes from the category and material records only.

### Don't
- Don't use drop shadows on cards.
- Don't use a radius larger than 4px.
- Don't set paragraph text below 14px.
- Don't put the gradient on buttons, badges, icons or hover states.
- Don't add a second brand hue. The categories are two treatments of the same violet.
- Don't use italics in UI labels or headings. Keep them for examples, foreign words and quotes.
- Don't centre long paragraphs. Centre only the hero, short intros and form headings.
- Don't show counters, "trusted by" numbers, ratings, partner logos or testimonials that are not real data.

---

## Surfaces

| Level | Name | Token | Value | Purpose |
|---|---|---|---|---|
| 1 | Page | `--surface-page` | `#f6fafb` | Base page background |
| 2 | Card | `--surface-card` | `#ffffff` | Cards, header, inputs, modals |
| 3 | Hero band | `--surface-hero-band` | `#693edf` | Start of the gradient hero |
| 4 | Path cells | `--surface-path-cells` | `#4f1bb7` | Category cells and learning-path panels |
| 5 | Notice strip | `--surface-notice-strip` | `#171717` | Notice bar and footer |

---

## Gradient system

```css
--gradient-quill: linear-gradient(180deg, #693edf 0%, #4f1bb7 25%, #4514a6 50%, #3b0d96 75%, #29007a 100%);
```

It always runs top to bottom with evenly spaced stops. Never skew, shorten or recolour it. Use it only on full-width bands and the preloader, never on cards, buttons or small elements.

---

## Imagery

- **Illustrations:** simple line drawings of writing and language subjects: pen nibs, open notebooks, speech bubbles and letters from different alphabets. Draw them in Typewriter lines with Quill Violet, Margin Violet and Lavender Page accents.
- **Material images:** 16:9, 4px radius, protected by the watermark in `prevention.css` (violet tint with "WORD CRAFTSMAN" at -30°).
- **No stock collages or 3D renders.** Logos of other companies are not used.
- **Alt text:** every image needs meaningful alt text; decorative ones use `alt=""`.

---

## Layout

The page is centred at a maximum width of 1200px on the Notebook background. Full-width bands (hero, category cells, notice strip, footer) run edge to edge.

- **Hero:** a split layout, with the headline on the left and the lead, buttons and category card on the right, all on the gradient.
- **Section rhythm:** Notebook and white alternate with no divider lines, and sections are 80px apart.
- **Material grid:** 3 columns on desktop, 2 on tablet (≤1024px), 1 on phones (≤768px).
- **Reading pages:** policies, About and the material detail text use a single column at 720px.
- **Phones:** no horizontal scroll at any width, a 16px minimum side gutter and touch targets of at least 44px.

---

## Agent prompt guide

**Quick colour reference**
- **Text:** Ink `#000b0f` for headings, Typeset `#171717` for main UI text, Pencil `#566b76` for paragraphs.
- **Backgrounds:** Notebook `#f6fafb` for the page, Paper `#ffffff` for cards, Typeset `#171717` for the footer.
- **Borders:** Page Rule `#e2e8eb` for cards and dividers, Blotter `#e4edf1` for inputs, Margin Line `#ccd9e0` for outlined buttons.
- **Accent:** Quill Violet `#693edf` for primary buttons, links, active states and focus (hover Manuscript Iris `#4f1bb7`).
- **Badges:** every category badge is `#efebfc` background / `#3b0d96` text with an 8px square in the category mark colour.

**Example prompts**

1. **Hero:** A full-width gradient band, `#693edf` to `#29007a` top to bottom. The eyebrow "LANGUAGE & WRITING STUDY MATERIALS" is Inter 600 at 12px, uppercase, in `#c1b9f4`. The headline is Space Grotesk 600 at 72–88px in white, tracking -1.76px. The lead is Inter 18px in white at 82% opacity. Below sit a white *Browse materials* button and an outlined white *How it works* button.

2. **Material card grid:** 3 columns on `#f6fafb` with a 24px gap. Each white card has a 1px `#e2e8eb` border, 4px radius and 24px padding. It holds a 16:9 image, a BUSINESS & TECHNICAL WRITING badge (`#efebfc` background, `#3b0d96` text, `#3b0d96` square), a Space Grotesk 500 title at 24px in `#000b0f`, a one-line summary in Inter 14px `#566b76` and a "Beginner" caption. The footer row has the price in Space Grotesk 600 at 24px and an outlined *View details* button.

3. **Section header:** An eyebrow in `#693edf`, Inter 600 at 12px, uppercase. Then an H2 in Space Grotesk 600 at 48px, `#000b0f`, tracking -0.96px, and a lead in Inter 18px `#566b76`, 640px wide at most, with 40px below.

4. **Category cells:** Five cells in a 3-column grid on a `#4f1bb7` to `#3b0d96` band. Each has a `rgba(41, 0, 122, 0.45)` panel, 4px radius and 24px padding, with a white Space Grotesk 24px heading, an Inter 14px description in white at 85% and a white *Explore* button.

5. **Sign-in form:** A centred white card, 480px wide, with a 1px `#e2e8eb` border and 32px padding. It has one field per row: email, then password. Labels are Inter 500 at 14px `#171717`; inputs have a 1px `#e4edf1` border and a violet focus ring. A full-width `#693edf` *Sign in* button sits at the bottom.
