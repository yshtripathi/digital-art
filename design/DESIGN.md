# ACADEMY — Credit-Based Light Theme E-Learning Style Guide
> Editorial Learning Atelier — a crisp white canvas with pill-shaped controls, subtle hairline borders, and a signature violet accent. Tailored for a **credit-based e-learning platform** hosting diverse courses (Stock & Trading, Art, Personality Development, etc.) with a unified aesthetic and an e-commerce Cart → Checkout credit purchasing flow.

**Theme:** Strict Light  
**Monetization Model:** Credit-Based (Courses unlocked via Credits)  
**Tone:** Editorial, modern, unified, distraction-free  
**Core Rules:**
- **No Rating Stars or Review Scores:** Objective course metrics only (modules, duration, certificate).
- **No Instructor Avatars / Names:** Focus 100% on course subject, syllabus, and learning outcomes.
- **Unified Badges & Chips:** Consistent neutral/brand styling without per-category color discrimination.
- **Cart-First Purchase Flow:** Credit tiers & calculator recommendations are added to the cart first, followed by a streamlined checkout.

---

## 1. Tokens Reference

### Core Palette

| Name | Value | Token | Role |
|------|-------|-------|------|
| **Orchid Accent** | `#a95ef8` | `--color-orchid-accent` | Highlighted word in display headlines |
| **Iris Brand** | `#5551ff` | `--color-iris-brand` | Primary brand accent for active tabs, icons, and credit balance |
| **Iris Hover** | `#433fe0` | `--color-iris-brand-hover` | Hover state for interactive brand elements |
| **Lavender Wash** | `#f0f3ff` | `--color-lavender-wash` | Soft tinted background for calculators, featured blocks, toasts |
| **Cobalt Spark** | `#007aff` | `--color-cobalt-spark` | Secondary accent for info banners and links |
| **Ink Black** | `#0e0f12` | `--color-ink-black` | Primary headings, titles, high-emphasis text |
| **Pure White** | `#ffffff` | `--color-pure-white` | Page canvas, card surfaces, modal/drawer backgrounds |
| **Surface Subtle** | `#f8f9fc` | `--color-surface-subtle` | Section backgrounds, input fills, table row highlights |
| **Obsidian** | `#1e1e24` | `--color-obsidian` | High-contrast pill button fills (`Unlock Course`, `Add to Cart`) |
| **Mist** | `#e4e7ed` | `--color-mist` | 1px hairline borders for cards, inputs, and dividers |
| **Mist Light** | `#f3f5f8` | `--color-mist-light` | Unified badge background, chip background |
| **Fog** | `#d2d4d7` | `--color-fog` | Disabled states, borders on hover |
| **Ash** | `#8e929b` | `--color-ash` | Metadata labels, timestamps, credit icon fills |
| **Slate** | `#5c6068` | `--color-slate` | Descriptions, syllabus summaries, helper copy |

### Unified Badge & Status Tokens

| Token | Value | Description |
|-------|-------|-------------|
| `--badge-bg` | `#f3f5f8` | Universal neutral pill badge background |
| `--badge-text` | `#2d2d34` | Universal neutral badge text |
| `--badge-border` | `#e4e7ed` | Universal neutral badge hairline border |
| `--badge-brand-bg` | `#f0f3ff` | Featured / Highlighted badge background |
| `--badge-brand-text` | `#5551ff` | Featured / Highlighted badge text |
| `--badge-brand-border` | `#dbe2ff` | Featured / Highlighted badge border |
| `--status-success-bg` | `#ecfdf5` | Toast & Alert success surface |
| `--status-success-text`| `#059669` | Toast & Alert success text / icon |
| `--status-error-bg`   | `#fef2f2` | Toast & Alert error surface |
| `--status-error-text`  | `#dc2626` | Toast & Alert error text / icon |

---

## 2. Notification & Toast System

### Toast Behavior & Animation
- **Placement:** Floating at **Top-Right** (`top: 24px; right: 24px;`) or **Bottom-Right** for non-blocking alerts.
- **Z-Index:** `9999`
- **Animation:** 
  - *Entry:* Smooth slide-in from right + subtle fade (`transform: translateX(100%) → translateX(0)`, `300ms cubic-bezier(0.16, 1, 0.3, 1)`).
  - *Exit:* Fade-out + slight collapse (`opacity: 0; transform: translateY(-8px);`, `200ms ease`).
  - *Auto-Dismiss:* 4.5 seconds default with a subtle progress bar at the bottom.

### Toast Types & Examples
```
┌───────────────────────────────────────────────────────────┐
│  🛒 Added to Cart!                                    ✕   │
│  "Pro Pack (70 Credits)" added.   [ View Cart ] [ Checkout]│
└───────────────────────────────────────────────────────────┘
```
```
┌───────────────────────────────────────────────────────────┐
│  ⚡ (Iris Icon) Successfully Unlocked!                ✕   │
│  "Stock Chart Mastery" is now added to your dashboard.    │
│  Remaining balance: 48 Credits                            │
└───────────────────────────────────────────────────────────┘
```
- **Structure:**
  - Background: Pure White (`#ffffff`) with subtle Lavender tint (`#f0f3ff`) or 1px hairline border (`#e4e7ed`).
  - Border Radius: `14px` (or `60px` for single-line mini pill toasts).
  - Elevation: `box-shadow: 0 16px 36px -8px rgba(14, 15, 18, 0.12);`
  - Padding: `16px 20px`.
  - Icon: 20px circular indicator (Success: Checkmark, Cart: 🛒 Cart, Credit Deduct: ⚡ Bolt).

---

## 3. Global Header & Footer Layout

### Header Layout (Sticky Light Navigation with Cart & Credit Balance)
- **Position:** `position: sticky; top: 0; z-index: 1000;`
- **Background:** Pure White (`#ffffff`) with `backdrop-filter: blur(12px); background: rgba(255, 255, 255, 0.92);` and bottom hairline border `1px solid var(--color-mist)`.
- **Height:** `72px`
- **Container:** Max-width `1240px`, centered with `24px` horizontal padding.

```
┌──────────────────────────────────────────────────────────────────────────────────────────────────┐
│ [ ACADEMY ]  Explore   Topics   Credits & Pricing   [ 🔍 Search ]  [ ⚡ 64 Cr ] [ 🛒 Cart (1) ] [ Dashboard ] │
└──────────────────────────────────────────────────────────────────────────────────────────────────┘
```

1. **Brand Logo (Left):** Editorial wordmark in Poppins SemiBold (`#0e0f12`) with a subtle violet dot.
2. **Nav Links (Center-Left):** Poppins 14px Medium (`#2d2d34`), hover color `var(--color-iris-brand)`. Single link **"Credits & Pricing"** navigates to the unified Tiers + Calculator page.
3. **Search Pill (Center-Right):** Compact pill input (`#f3f5f8` fill, 60px radius, 14px placeholder).
4. **Credit Balance Badge (Right):**
   - High-visibility pill badge: `background: var(--color-lavender-wash); color: var(--color-iris-brand); border: 1px solid var(--badge-brand-border); padding: 8px 16px; border-radius: 9999px; font-weight: 600; font-size: 13px;`.
   - Clicking navigates directly to the Credits & Pricing page.
5. **Cart Button (Right):**
   - Pill button: `border: 1px solid var(--color-mist); background: #ffffff; padding: 8px 16px; border-radius: 9999px; font-size: 13px; font-weight: 500;`. Opens the **Cart Slide-Over Drawer**.
6. **User Account Pill (Far Right):** Obsidian `#1e1e24` pill button ("My Courses" or "Sign In").

---

### Footer Layout (Editorial Light Footer with Newsletter)
- **Background:** Surface Subtle (`#f8f9fc`) with top hairline border `1px solid var(--color-mist)`.
- **Padding:** `64px 0 32px 0`.

```
┌────────────────────────────────────────────────────────────────────────────────────────┐
│  NEWSLETTER SUBSCRIPTION STRIP (TOP OF FOOTER)                                         │
│  Stay Updated on New Course Releases                                                   │
│  Get notified when new stock, art, and personal growth courses drop + bonus credit days.│
│                                                                                        │
│  ┌───────────────────────────────────────────────────┐ ┌─────────────────────────────┐  │
│  │ ✉ Enter your email address...                     │ │ Subscribe (Obsidian Pill)   │  │
│  └───────────────────────────────────────────────────┘ └─────────────────────────────┘  │
│  No spam. Unsubscribe at any time.                                                     │
│                                                                                        │
│  ────────────────────────────────────────────────────────────────────────────────────  │
│                                                                                        │
│  ACADEMY             PLATFORM            CREDITS & TIERS        LEGAL & HELP          │
│  Unlocking skills    • All Courses       • Pricing Tiers        • Terms of Service    │
│  through flexible    • Learning Paths    • Credit Calculator    • Privacy Policy      │
│  credit learning.    • Certificates      • Top-Up Packs         • Support Center      │
│                                                                                        │
│  ────────────────────────────────────────────────────────────────────────────────────  │
│  © 2026 ACADEMY Inc. All rights reserved.           [ Clean Light Editorial System ]  │
└────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 4. Unified "Credits & Pricing" Page (Tiers + Calculator on Same Page)

The Pricing & Credits page hosts **both the 4 Credit Tiers AND the Interactive Calculator** on the exact same page for a seamless buying experience.

```
┌────────────────────────────────────────────────────────────────────────────────────────┐
│  [ PRICING & CREDITS ]                                                                 │
│  Simple, Flexible Credits — Learn at Your Own Pace                                     │
│  Buy credit packs once, unlock any course across all categories anytime. Credits never expire.│
│                                                                                        │
│  ════════════════════════════════════════════════════════════════════════════════════  │
│  SECTION 1: THE 4 CREDIT TIERS                                                         │
│  ════════════════════════════════════════════════════════════════════════════════════  │
│                                                                                        │
│  ┌───────────────┐ ┌───────────────┐ ┌────────────────┐ ┌───────────────┐              │
│  │ STARTER PACK  │ │ LEARNER PACK  │ │ PRO PACK (TOP) │ │ MASTER PACK   │              │
│  │ $29           │ │ $69           │ │ $149           │ │ $329          │              │
│  │ ⚡ 10 Credits  │ │ ⚡ 28 Credits  │ │ ⚡ 70 Credits   │ │ ⚡ 185 Credits │              │
│  │ (+0 bonus)    │ │ (+3 bonus)    │ │ (+10 bonus)    │ │ (+35 bonus)   │              │
│  │ ───────────── │ │ ───────────── │ │ ────────────── │ │ ───────────── │              │
│  │ • 1–2 courses │ │ • Full path   │ │ • Best Value   │ │ • All-Access  │              │
│  │ • No expiry   │ │ • No expiry   │ │ • No expiry    │ │ • No expiry   │              │
│  │               │ │               │ │                │ │               │              │
│  │ [Add to Cart] │ │ [Add to Cart] │ │ [Add to Cart]  │ │ [Add to Cart] │              │
│  └───────────────┘ └───────────────┘ └────────────────┘ └───────────────┘              │
│                                                                                        │
│  ════════════════════════════════════════════════════════════════════════════════════  │
│  SECTION 2: INTERACTIVE CREDIT ESTIMATOR & CALCULATOR                                  │
│  ════════════════════════════════════════════════════════════════════════════════════  │
│                                                                                        │
│  ┌──────────────────────────────────────────────────────────────────────────────────┐  │
│  │  Not sure which pack to choose? Calculate your learning roadmap:                 │  │
│  │                                                                                  │  │
│  │  Select expected courses:                                                        │  │
│  │  [ - ]  3  [ + ]  Stock & Technical Analysis Courses     (Avg. 6 credits each)   │  │
│  │  [ - ]  2  [ + ]  Digital Art & Illustration Courses     (Avg. 5 credits each)   │  │
│  │  [ - ]  2  [ + ]  Personality & Leadership Courses       (Avg. 4 credits each)   │  │
│  │                                                                                  │  │
│  │  ──────────────────────────────────────────────────────────────────────────────  │  │
│  │  Total Estimated Requirement: 36 Credits                                         │  │
│  │  Recommended Pack: PRO PACK (70 Credits for $149) — Saves 32% + Extra Balance    │  │
│  │                                                                                  │  │
│  │  [ Add Recommended Pro Pack to Cart ] (Obsidian 60px Pill Button)                │  │
│  └──────────────────────────────────────────────────────────────────────────────────┘  │
└────────────────────────────────────────────────────────────────────────────────────────┘
```

### The 4 Credit Tiers Breakdown

| Tier Name | Credits Included | Bonus Credits | Total Credits | Price | Best For | Action |
|-----------|------------------|---------------|---------------|-------|----------|--------|
| **1. Starter Pack** | 10 Credits | +0 Bonus | **10 Credits** | $29 | 1–2 focused courses | `[ Add to Cart ]` |
| **2. Learner Pack** | 25 Credits | +3 Bonus | **28 Credits** | $69 | Complete single topic path | `[ Add to Cart ]` |
| **3. Pro Pack (Popular)** | 60 Credits | +10 Bonus | **70 Credits** | $149 | Multi-topic learning | `[ Add to Cart ]` |
| **4. Master Pack** | 150 Credits | +35 Bonus | **185 Credits** | $329 | Complete academy access | `[ Add to Cart ]` |

---

## 5. Cart System & Slide-Over Drawer

When a user clicks `[ Add to Cart ]` on any Tier card or the Calculator, the **Cart Drawer** slides in from the right.

```
┌──────────────────────────────────────────────────────────┐
│  Your Cart (1 item)                                  ✕   │
│  ──────────────────────────────────────────────────────  │
│                                                          │
│  ┌────────────────────────────────────────────────────┐  │
│  │  PRO PACK — CREDIT BUNDLE                          │  │
│  │  ⚡ 70 Credits Total (60 + 10 Free Bonus)          │  │
│  │  Qty: [ - ] 1 [ + ]                      $149.00   │  │
│  │  [ Remove ]                                        │  │
│  └────────────────────────────────────────────────────┘  │
│                                                          │
│  Promo Code:                                             │
│  ┌─────────────────────────────────┐ ┌───────────────┐  │
│  │ Enter code...                   │ │ Apply (Pill)  │  │
│  └─────────────────────────────────┘ └───────────────┘  │
│                                                          │
│  ──────────────────────────────────────────────────────  │
│  Subtotal:                                   $149.00     │
│  Credits Added to Account:                70 Credits     │
│  Tax / Fees:                                   $0.00     │
│  Total Due Today:                            $149.00     │
│                                                          │
│  [ Proceed to Checkout ] (Obsidian 60px Pill Button)     │
│  🔒 Credits credited immediately upon checkout.          │
└──────────────────────────────────────────────────────────┘
```

- **Container:** Slide-over panel (`width: 420px; max-width: 90vw; background: #ffffff; box-shadow: -12px 0 40px rgba(0,0,0,0.1);`).
- **Cart Actions:**
  - `[ Proceed to Checkout ]`: Directs user to the secure checkout page.
  - `[ Continue Browsing ]`: Closes drawer.

---

## 6. Checkout Page Layout (Cart → Checkout)

```
┌────────────────────────────────────────────────────────────────────────────────────────┐
│  CHECKOUT — SECURE CREDIT PURCHASE                                                     │
│                                                                                        │
│  ┌───────────────────────────────────────────┐  ┌────────────────────────────────────┐ │
│  │ 1. Account & Billing Details              │  │ ORDER SUMMARY                      │ │
│  │ Email: user@example.com (Logged In)       │  │                                    │ │
│  │                                           │  │ Pro Pack Bundle          $149.00   │ │
│  │ 2. Payment Method                         │  │ • 70 Total Credits                 │ │
│  │ (•) Credit / Debit Card                   │  │ • Lifetime No-Expiry Guarantee     │ │
│  │ ( ) Apple Pay / Google Pay                │  │                                    │ │
│  │ ( ) PayPal                                │  │ Subtotal:                $149.00   │ │
│  │                                           │  │ Total Due:               $149.00   │ │
│  │ Card Number:                              │  │                                    │ │
│  │ ┌──────────────────────────────────────┐  │  │ ────────────────────────────────── │ │
│  │ │ 4242 •••• •••• 4242         MM / YY │  │  │ Current Balance:        64 Credits  │ │
│  │ └──────────────────────────────────────┘  │  │ New Balance After:     134 Credits  │ │
│  │                                           │  │                                    │ │
│  │ [ Pay $149 & Receive 70 Credits ]         │  │ 🔒 256-Bit SSL Encrypted           │ │
│  │ (Obsidian 60px Pill Button)               │  │ Instant delivery to account.       │ │
│  └───────────────────────────────────────────┘  └────────────────────────────────────┘ │
└────────────────────────────────────────────────────────────────────────────────────────┘
```
- **Post-Purchase Flow:**
  - Instantly re-directs to the Course Catalog / Dashboard.
  - Fires the **Success Toast**: `⚡ 70 Credits added to your account! Your new balance is 134 Credits.`

---

## 7. Course List Page Layout

```
┌────────────────────────────────────────────────────────────────────────────────────────┐
│  [ BROWSE ALL COURSES ]                                                                │
│  Expand your knowledge with curated, master-level courses.                             │
│                                                                                        │
│  [ 🔍 Search by topic or keyword...               ]  [ Sort by: Newest ▾ ]             │
│                                                                                        │
│  [ All (48) ]  [ Stock & Finance ]  [ Art & Design ]  [ Personality Dev ]  [ Skills ]   │
│                                                                                        │
│  ┌──────────────────┐  ┌──────────────────┐  ┌──────────────────┐                      │
│  │ [ Course Image ] │  │ [ Course Image ] │  │ [ Course Image ] │                      │
│  │ [ Topic ] [ Lvl] │  │ [ Topic ] [ Lvl] │  │ [ Topic ] [ Lvl] │                      │
│  │ Title of Course  │  │ Title of Course  │  │ Title of Course  │                      │
│  │ Summary copy...  │  │ Summary copy...  │  │ Summary copy...  │                      │
│  │ 12 Less. • 4h    │  │ 18 Less. • 6h    │  │ 8 Less. • 2.5h   │                      │
│  │ ⚡ 6 Credits     │  │ ⚡ 8 Credits     │  │ ⚡ 4 Credits     │                      │
│  │ [ View Course ]  │  │ [ View Course ]  │  │ [ View Course ]  │                      │
│  └──────────────────┘  └──────────────────┘  └──────────────────┘                      │
│                                                                                        │
│  [ Load More Courses ] (White pill with Mist border)                                   │
└────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 8. Course Detail Page Layout

Clean, distraction-free syllabus breakdown and credit unlock action.

```
┌────────────────────────────────────────────────────────────────────────────────────────┐
│  Breadcrumb: Home / Courses / Stock & Technical Analysis                              │
│                                                                                        │
│  [ TOPIC TAG ]  •  [ INTERMEDIATE ]                                                    │
│  Advanced Price Action & Market Structure                                              │
│  Master chart patterns, order flow dynamics, and risk management systems.              │
│                                                                                        │
│  ┌─────────────────────────────────────────┐  ┌──────────────────────────────────────┐ │
│  │  [ 16:9 Course Video / High-Key Banner] │  │  ⚡ UNLOCK COURSE                     │ │
│  │  (12px rounded image container)         │  │                                      │ │
│  │                                         │  │  Cost: 8 Credits                     │ │
│  │  Course Overview:                       │  │  Your Balance: 64 Credits            │ │
│  │  Detailed explanation of what will be   │  │  Remaining After: 56 Credits         │ │
│  │  taught in this curriculum...           │  │                                      │ │
│  │                                         │  │  [ Unlock with 8 Credits ]           │ │
│  │  Curriculum & Modules (Accordion):      │  │  (Obsidian Pill Button)              │ │
│  │  ▸ Module 1: Market Fundamentals (4 les)│  │                                      │ │
│  │  ▸ Module 2: Support & Resistance (6 les│  │  • If balance insufficient:           │ │
│  │  ▸ Module 3: Liquidity & Entries (5 les)│  │    [ Buy Credits ] links to Pricing  │ │
│  │  ▸ Module 4: Risk Rules & Journaling    │  │                                      │ │
│  │                                         │  │  Includes:                           │ │
│  │  Prerequisites:                         │  │  • 15 Video Lessons (5.2 Hours)      │ │
│  │  Basic understanding of financial terms.│  │  • Complete Project Resource Files   │ │
│  │                                         │  │  • Certificate of Completion         │ │
│  │                                         │  │  • Lifetime Unlimited Access         │ │
│  └─────────────────────────────────────────┘  └──────────────────────────────────────┘ │
└────────────────────────────────────────────────────────────────────────────────────────┘
```

---

## 9. Image Guidelines & Visual Asset Specs

To preserve the editorial, high-trust atelier atmosphere, all imagery must adhere to the following specifications:

### 1. Course Thumbnail Images
- **Aspect Ratio:** `16:9` (recommended resolution: `1280 × 720px` or `800 × 450px`).
- **Border Radius:** `10px` inside cards, `12px` on detail pages.
- **Visual Direction:**
  - **Stock/Finance:** Clean modern 3D abstract charts, sleek workspace setups, subtle candlestick visualizations with high-key lighting.
  - **Art & Design:** Vibrant artwork samples, physical sketchbook flat-lays, gouache palettes, typography specimens with natural soft lighting.
  - **Personality Development:** Minimalist conceptual photography, journal & notebook desk scenes, inspiring modern architecture.
- **Rules:** 
  - Never use dark, moody, or hyper-saturated clip-art.
  - No fake badge overlays, "50% OFF" stickers, or star graphics baked into the images.
  - No device mockup frames (e.g. fake laptop borders).

### 2. Iconography
- **Style:** Clean 1.5px stroke geometric icons (Lucide / Feather / Tabler style).
- **Credit Icon:** Minimalist ⚡ bolt icon in `var(--color-iris-brand)` (`#5551ff`).
- **Cart Icon:** Minimalist 🛒 shopping bag/cart icon.
- **Size:** `16px` for inline badges/metadata, `20px` for header indicators, `24px` for feature blocks.

---

## 10. Summary Checklist for Implementation

- [x] **Light Mode Only:** Canvas `#ffffff`, section tint `#f8f9fc`, borders `#e4e7ed`.
- [x] **Credits & Pricing Page:** 4 Tiers + Interactive Calculator on the same page.
- [x] **Cart-First Flow:** `[ Add to Cart ]` action on tiers/calculator → Slide-Over Cart Drawer → Checkout.
- [x] **Toast Notifications:** Smooth slide-in, rounded pill toasts for "Added to Cart" and "Successfully Unlocked".
- [x] **Clean Course Card:** Unified neutral pill badges, lesson/hour counts, credit price (`⚡ 6 Credits`), no star ratings, no instructor avatars.
- [x] **Course Detail Page:** 2-column layout with sticky credit unlock widget and accordion syllabus.
- [x] **Curated Imagery:** 16:9 ratio, 10px radius, high-key photography/abstracts, no marketing stickers.
