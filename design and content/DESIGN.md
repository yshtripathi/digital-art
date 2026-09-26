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
| Deep Sage | `#e4ead6` | `--surface-sage-deep` | Alternate section band (deeper than the canvas) |
| Mint | `#f5f8ee` | `--surface-mint` | Alternate section band (lighter than the canvas) |

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
The BizAcademys logo (`assets/images/logo.webp`, 1146×240, transparent) sits at the left of the header at 38px tall (30px on small phones), and on a Paper White tile in the footer at 36px. The favicon is the book-and-arrow mark alone (`favicon.ico` with 16, 32, 48 and 64px sizes, plus `favicon-64.png`).

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
Full width inside a centered form of at most 480px, strictly one field per row. Label above in Inter 500 14px, Deep Forest. Input: 50px tall, Paper White, 1px Soft Line border, 12px radius, a Muted Moss icon inside on the left, Inter 16px. Focus: Deep Forest border plus a soft lime glow. Error: Error border, message below in Error color with an icon.

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

### Form pages (log in, create account, forgot password, contact)
No photos or video. The form sits in a centered Paper White card (480px max for account forms) with a 3px lime top border, 16px radius, a solid Strategy Lime offset shadow (14px right, 16px down) plus a soft forest shadow, and a drifting Deep Forest dot grid behind its top-left corner. The card fades up on load. Inside: a pill eyebrow with a small dot, an Inter 500 22px title, a short lead, then one field per row. Fields are 50px tall with a Muted Moss icon inside on the left that turns Deep Forest on focus. Focus shows a Deep Forest border and a soft lime glow; errors turn the border Error red and show the message below with an icon. Password fields have an eye button on the right, and the captcha image sits in a Pale Sage tile beside its field. The "remember me" box is a round check that fills Deep Forest with a lime tick. A line with centered text separates the primary action from the secondary one.

The contact page pairs the form card (right) with a sticky Deep Forest info panel (left). The panel holds a lime eyebrow, title and lead, company detail rows with lime icon tiles on faint glass rows, and the common reasons list with lime dots. On tablets and phones the panel stacks above the form.

### Payment result pages (order success, order failed)
Two columns (5:7), stacking on tablets and phones. On the left is a sticky status card, centered text, with an 88px round badge that pops in:
- Success: a Deep Forest card with lime glows. The badge is Strategy Lime with a black check and two lime rings pulsing outward. The title and message are in Paper White, the primary button is lime and the secondary is outlined in white.
- Failed: a Paper White card with a 3px Error top border and a soft shadow. The badge is a red cross on the Error surface, and it shakes once.

On the right, the success page shows a receipt card (lime top border, lime offset shadow). It has the order number under a caption label, then a dashed tear line, the total on a Pale Sage row in large figures, the transaction ID, a status pill (Success colors when paid, Warning colors when pending), and the invoice download. Below it, a "what happens next" card lists each point beside a Pale Sage icon tile. The failed page shows a card with numbered steps (Deep Forest circles with lime numbers joined by a thin timeline line) and a Pale Sage help box with a Deep Forest headset tile. Cards fade up one after another.

### Checkout
Two columns: the form on the left and a sticky 380px order summary on the right, stacking below 992px. A Paper White stepper card on top: completed steps are Deep Forest circles with a lime check joined by a Deep Forest line, the current step is a lime circle with a soft lime halo, and upcoming steps are Pale Sage. On phones only the current step keeps its label.

The form is split into numbered Paper White section cards (a Deep Forest 40px tile with a lime number, an Inter 500 18px title, and a Soft Line rule under the head). Each card fades up in turn, and its border darkens while a field inside has focus. Fields follow the form field rules, one per row; the card expiry is a month / year pair centered inside one field. Required marks are Error red. Each policy agreement is a selectable row that turns Pale Sage with a Deep Forest border once ticked. "Before you pay" facts sit in a Pale Sage box with small Deep Forest icon tiles.

The DBA notice is an Info alert, and the billing description image sits inline at the end of the sentence, 26px tall and vertically centered, with no border, radius or other decoration.

The summary is a Deep Forest card with a lime glow. It has a lime bag tile in the head, each line on a faint glass row with a lime credits tile, a dashed rule above the total (32px, Strategy Lime), a 54px lime pay button, a white-outlined secondary button, a secure-payment note with a lime shield, and the payment methods image on a Paper White tile.

### Cart pages (cart, credit cart)
A single-column layout of their own, unlike the two-column form pages. There is no stepper. Everything is centered: a muted item-count eyebrow, a Fraunces heading and a pill-shaped "keep browsing" link stacked in the middle.

Items form a centered grid of cards (260–320px each), so a single card, often a credit pack, sits in the middle instead of on the left. Each card is Paper White with a 16px radius; it lifts 4px with a Deep Forest border on hover, and the cards fade up in turn.
- **Top:** a full-width 16:9 image, because material images are landscape; it zooms slightly on hover. A white pill chip (lime for credit packs) sits top left and a round white remove button top right, which turns Error red and rotates on hover. Credit packs use a Deep Forest frame with a dot texture and a lime glow, holding a box that shows the pack's total credits: a 40px lime figure over an uppercase caption label, framed by a faint lime border on a glass fill.
- **Body:** the title, clamped to two lines.
- **Foot:** under a dashed rule, muted meta on the left and the price (22px) on the right.

Below the grid, a centered 560px summary card: Paper White, a lime top border and a lime offset shadow. It has a centered Inter 500 18px title, stat rows on Soft Line rules, the total on a Pale Sage row in 30px figures, and a full-width 54px lime button. The secure note and payment methods image sit centered below it.

On the credit cart, a wide wallet panel sits below the item grid, above the summary card: Paper White, with a 6px left border that is lime, or Warning when credits are short. It shows three stat tiles side by side (balance on Deep Forest, then needed and remaining on Pale Sage) and a 12px meter that fills on load, with the coverage percentage and a buy-credits link. A Warning note spans the panel when the balance is too low.

Empty and signed-out states show three dashed placeholder card outlines that breathe softly and fade out downward. A lime round icon, ringed in canvas and a thin Soft Line, overlaps their lower edge, followed by the Fraunces title, the text, an optional balance pill and the primary and secondary buttons.

### Buy credits (calculator)
A centered intro sits on top: a muted eyebrow, the intro at reading size, and two pill chips for the exchange rate and the 90-day validity. Below it is one wide calculator console, a Paper White card with a soft forest shadow split into two halves (stacking below 992px):
- **Input half:** an uppercase caption label, then a large Pale Sage amount box (88px tall). The currency symbol and the typed figure are in Fraunces; on focus the box turns Paper White with a Deep Forest border and a lime glow. Four quick-amount buttons sit in a grid; the selected one turns lime and they lift on hover. The "good to know" Info note sits at the bottom.
- **Result half:** Deep Forest with a lime glow and a faint dot texture. It shows the credits you will receive as a large Fraunces lime figure that pulses when it changes, a "base × multiplier" equation in two glass cells, a 56px lime button and the secure note.

Above the console, between the intro and the calculator, "Multipliers by purchase amount" is a ladder of four tier cards, not a table. Each card has a small gridded chart whose bar rises on load to its share of the top multiplier (x1 33%, x2 67%, x2.5 83%, x3 100%). Below the chart are the multiplier in Fraunces 44px, the tier name with its icon, and the amount range under a caption. The top tier has a Deep Forest bar and a lime "highest multiplier" pill. The tier that matches the typed amount lifts 6px with a Deep Forest border, a lime offset shadow, a lime bar and a green "matches your amount" pill.

### Policy and information pages (from the database)
The article is a Paper White card (16px radius) with reading-friendly 16px / 1.75 text:
- **Headings:** each h2 opens a new section, with a Soft Line rule above it and a short lime bar on that rule; h2 is Inter 500 22px, h3 18px and h4–h6 16px, all Deep Forest.
- **Lists:** bullets are lime dots ringed in Deep Forest; numbered lists use Deep Forest circles with lime numbers.
- **Other elements:** links are underlined, blockquotes sit on Pale Sage with a Deep Forest edge, and horizontal rules are dashed.
- **Tables:** tables from the database are wrapped in a rounded bordered frame that scrolls sideways on small screens. Their inline styles are overridden so the label column sits on Pale Sage in Inter 500, rows are separated by Soft Line rules, and header rows turn Deep Forest. Inline DBA images keep their own inline styles.

When a page has two or more h2 headings, a sticky "On this page" card appears on the left (260px). It lists the sections with two-digit numbers, and the section in view is marked with a lime left edge on Pale Sage. Otherwise the article is centered at 880px.

Below the article, "Related policies" shows cards for the other policies: a Deep Forest icon tile with a lime icon, the policy name and a "read policy" link. On hover a card lifts with a lime offset shadow. Printing hides everything except the article.

### Catalogue (e-learning materials list)
A 280px sticky sidebar sits beside the results. It holds a Paper White categories card (an uppercase caption title, then one row per category with a count pill; the current one turns Deep Forest with a lime count) and a Deep Forest "need credits?" promo card (lime icon tile, short text, primary button). Below 992px the sidebar turns into a sideways-scrolling row of pill links and the promo hides.

The results start with a header: a muted count eyebrow, a Fraunces title and the intro on the right, above a Soft Line rule. Material cards sit in an auto-fill grid (260px minimum):
- **Top:** a 4:3 image (material images are landscape) that zooms slightly on hover.
- **Body:** a category chip and a four-bar level meter with the level count, the title and summary (each clamped to two lines), and a dashed rule over the "starting from" credits.
- **Corner:** a round arrow button that turns lime and tilts on hover.

On hover a card lifts 4px with a Deep Forest border and a lime offset shadow, and cards fade up in turn. Pagination uses 44px square buttons, with the current page in Deep Forest. The empty state is a dashed-border card.

### Material detail
Two columns: a sticky 4:3 image stage with a five-across thumbnail strip (the active thumbnail has a Deep Forest border), and an info card with a lime top border. The info card holds:
- a category pill linking to its category
- the Fraunces title and the lede at reading size
- an "at a glance" row of Pale Sage tiles: level count, starting price and category
- a full-width lime button that jumps to the levels, and the wallet note

Levels come straight after the hero, in a Deep Forest section: a lime eyebrow, a white Fraunces title and a hint, then a level picker. The picker is a tab row showing four options at a time (two on phones) and scrolls sideways with snapping when a material has more. Each option shows "Level n", a four-bar meter, the level name and its credits; the selected option turns Strategy Lime with a Deep Forest meter. Only the selected level's details show below, in a Paper White panel:
- the level name
- the "what you will learn / who it is for / what you will be able to do" points as Pale Sage cards with Deep Forest icon tiles
- a buy box with a lime top border: the level label, the price in Fraunces 48px and a lime add-to-cart button

Arrow keys, Home and End move between the options. "About this e-learning material" follows the levels, under a rule, with its Fraunces title in a 280px column beside the text at reading size. The main image and thumbnails are clipped to their 16px and 12px corners even when content protection is off.

### About page
Two sections.

1. **Story beside a video (two columns, video first on tablets and phones).** The text column has a Forest Mid eyebrow, a Fraunces heading-lg title, the lead paragraph at reading size, a second paragraph, and three key points as Paper White rows with Deep Forest icon tiles that slide right on hover. The video (`assets/videos/about-work.mp4`, muted, looping, 16:9, with the `about-work.webp` poster) sits in a 16px-radius frame with a lime offset shadow and a soft forest shadow, and a drifting dot grid peeks from behind its top-right corner. A round frosted pause/play button sits bottom right; reduced-motion visitors get the poster without autoplay.
2. **How it works.** A Deep Forest panel with lime and Forest Mid glows. It has a centered lime eyebrow and white Fraunces title, then four path cards (Categories, E-Learning Materials, Levels, Credits) joined by a dashed lime line. Each card shows a small step number, a lime round icon, the name and a one-line explanation, and lifts on hover. A closing row pairs "Ready to take a look?" with the lime primary button and a white-outlined contact button.

### Account dashboard
An app-style layout: a 300px sticky sidebar and a content column (stacking below 992px).
- **Profile card:** Deep Forest with a lime glow. It holds a 72px lime avatar with the initial in Fraunces, a lime "welcome back" eyebrow, the name, the email and a member-since pill. Under a dashed rule sit the available credits in Fraunces 44px lime and a full-width lime buy-credits button.
- **Section menu:** a Paper White vertical tab list (orders, materials, password), each with an icon and a count pill; the active tab is Deep Forest with a lime icon and count. Log out sits last and turns Error red on hover. On narrow screens the menu becomes a sideways-scrolling row.

The content column starts with three stat tiles (available credits, levels unlocked, credit purchases), each with a Deep Forest icon tile. The active section sits in a Paper White card:
- **Credit purchases:** wrapping rows rather than a table. Each row has a Pale Sage icon tile, the order number and date, credits, amount, a status pill (Success, Warning or Error colors) and an outlined "view receipt" button that turns lime on hover.
- **My materials:** a grid of cards with a 16:10 image, an "unlocked" or status pill on the image, level and credits chips, the title, the order number and date, and an "open material" link.
- **Change password:** the form (one field per row, 480px max) beside a Pale Sage tips card with green check bullets.

Empty sections show a dashed card with a Deep Forest round icon, one line of text and a primary button.

### Order details (receipt)
An invoice layout, 1000px wide.
- **Top bar:** Deep Forest with a lime glow and a dot texture. On the left: a lime "receipt" pill, the order number in Fraunces, the date, and the order and payment status pills with captions. On the right: "total paid" (or "credits used") in large lime Fraunces, with the lime PDF download button and a white-outlined print button.
- **Cards below:** two Paper White cards side by side, each titled over a dashed rule. "Items in this order" lists each item on a Pale Sage row (course icon, or a Deep Forest tile with lime coins for credit packs), with its title, level and credits. "Order information" is a two-column grid of caption labels and values, with the transaction ID spanning the full width.
- **Footer:** a "back to my account" link. Printing turns the top bar light and hides the buttons.

### Homepage
Seven sections, all using live database figures (materials, skill areas and levels). Each section sits on its own full-width band so the page reads as distinct steps: the hero on Pale Sage fading to Mint with a lime glow, skills on Paper White, featured materials on Deep Sage, how it works on Mint, credits as a full-bleed Deep Forest band, why learn here on Paper White, and the closing call to action on Deep Sage with a lime glow and a dot texture. Cards flip colour to stand out from their band (Pale Sage cards on white bands, Paper White cards on sage bands).

Optional media slots appear only when their file exists, so the page never shows an empty frame:
- `assets/videos/home-hero.mp4` (horizontal 16:9) replaces the hero chart
- `assets/videos/home-flow.mp4` (horizontal, shown 21:9) adds a wide reel above the how-it-works timeline
- `assets/images/home-skills.webp` (vertical 3:4) adds a tall photo tile at the start of the skills grid, with a caption over a forest gradient
- `assets/images/home-why.webp` (vertical 4:5) replaces the why-learn-here pattern panel
- `assets/images/home-start.webp` (horizontal 3:2) turns the closing card into a photo and text split

Both videos have pause buttons, and their optional posters are `home-hero.webp` and `home-flow.webp`.
1. **Hero:** two columns. On the left: a pill tag with a lime dot, a Fraunces 44–80px headline, the lead at reading size, and a 54px primary button plus a secondary button. On the right: a 16:11 frame with a lime offset shadow. It plays `assets/videos/home-hero.mp4` (with a pause button and the optional `home-hero.webp` poster) when that file exists, and otherwise shows an animated growth chart on Deep Forest. Three floating stat chips (the third in lime) drift gently over the frame's edges.
2. **Browse by skill:** category tiles in an auto-fill grid. Each tile has a Deep Forest icon tile picked from keywords in the category name (for example a megaphone for marketing, a handshake for sales, a cart for e-commerce and a chart for analytics), the name, a material count and a corner arrow that tilts on hover. Tiles lift with a lime offset shadow.
3. **Featured materials:** on a Paper White band. One lead card spans two columns and two rows (16:10 image, Fraunces title, summary), and four smaller cards sit beside it (4:3 images). An outlined "all materials" pill sits in the heading row.
4. **How it works:** a four-step horizontal timeline. Deep Forest round icons ringed in canvas sit on a line that draws in on load. The icons turn lime on hover, and each step has a Forest Mid number, a title and a one-line explanation.
5. **Credits:** a Deep Forest band with a dot texture. On the left: the explanation, the 90-day validity note and a primary button. On the right: the x1 / x2 / x2.5 / x3 multipliers as a bar chart that grows on load, with the top bar in lime.
6. **Why learn here:** a 4:5 visual with a lime offset shadow on the left. It shows `assets/images/home-why.webp` when that file exists, and otherwise a Deep Forest pattern panel with a large lime chart mark. On the right: four value cards with lime icon tiles in a 2×2 grid.
7. **Closing call to action:** a centered Paper White card with a lime top border and a lime offset shadow, a Fraunces title and two buttons (create account for guests, buy credits for members).

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
