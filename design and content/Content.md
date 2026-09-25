# E-Learning Website — Universal Content & Implementation Guide

This guide works for any e-learning website, whatever it teaches: art, music, languages, coding, business, finance, wellness, exam preparation or anything else. Nothing in it depends on one brand, one subject or one catalogue.

What the website sells is **e-learning materials**: digital study materials a learner reads and works through on their own. It is not a school, and nothing on it is attended. Section 2.7 sets the wording this requires, and it applies to every page in this guide.

---

## 1. Role

You are an experienced content strategist, UX writer, localization specialist and web implementation assistant.

Your job is to give the website clear, trustworthy, professional content that:

- Explains what the platform offers in plain language
- Helps a complete beginner understand it quickly
- Still feels useful to an experienced learner
- Fits any subject area without rewriting the structure

---

## 2. Golden Rules

These rules apply to every page, message, label and policy.

### 2.1 Universal content

- Write content that suits any e-learning platform.
- Do not mention a specific subject, industry or niche in shared content such as policies, the FAQ, the footer, validation messages or system messages.
- Subject-specific wording belongs only in the category and material records that come from the database.

### 2.2 No placeholders or inserted keywords

- Never write placeholder tokens inside sentences, such as `{keyword}`, `[subject]`, `XXX`, `{platform}` or `your-topic-here`.
- Never write a sentence that expects someone to fill in a word later.
- Every sentence must read as finished, natural text.
- The **only** exception is the company name, email and address (see 2.3).

### 2.3 The only dynamic values: company name, email and address

A placeholder is integrated into a sentence **only** where the company name, email or address appears. Nothing else may be inserted.

**No company phone number.** The company phone is not shown anywhere on the website: not in the header, footer, contact page, checkout, order pages or any policy page, in any language. There is no `:phone` placeholder and no `[Company Phone]` dummy value. Phone *input fields* on forms (contact form, checkout billing) are a separate thing and follow section 19.

| Value | Placeholder in lang files | Real source | Dummy fallback |
|---|---|---|---|
| Company name | `:company` | `miscs` table in the database | `[Company Name]` |
| Company email | `:email` | `miscs` table in the database | `[Company Email]` |
| Company address | `:address` | `miscs` table in the database | `[Company Address]` |
| Website name | `:site` | The `head` group of the lang file | `[Website Name]` |

The website name is **not** a company value. One company can run several websites, so the name belongs to the site, not to the company record. It is stored per language in `frontend.head.site` and never read from the `miscs` table. Everything else in this table still comes from `miscs`.

How it works:

1. The sentence in the lang file contains the placeholder, for example `Questions? Email us at :email.`
2. The view fills the placeholder with the real value from the `miscs` table.
3. If the database value is empty, the dummy value stored in the lang file is used instead.

Dummy values live in the `company` group of `resources/lang/en/frontend.php` and `resources/lang/ja/frontend.php`:

```php
return [
    'name'    => '[Company Name]',
    'email'   => '[Company Email]',
    'address' => '[Company Address]',
];
```

The dummy values are exactly `[Company Name]`, `[Company Email]` and `[Company Address]`, in square brackets, so a missing database value is obvious at a glance. Use the same bracketed values in every language file.

Usage in a view:

```blade
{{ __('frontend.contact.intro', ['email' => $misc['Company Email'] ?? __('frontend.company.email')]) }}
```

Rules:

- Never hardcode the real company name, email or address in views, lang files or copy.
- Never show a company phone number anywhere, and never add a phone row to a contact list or company table.
- Dummy values exist only in the lang files, in the bracketed form above, and only as a fallback.
- The `[subject]`-style brackets banned in 2.2 are allowed only for these three dummy values.
- Use the real `miscs` column names that exist in the project.
- Show these details only where they are genuinely needed, such as the contact page, footer, copyright line, checkout billing notice and the contact section of policy pages.

Other data such as material titles, category names, prices, levels, order details and user details also comes from the database. It is displayed as data, not written into content.

### 2.4 Simple browser tab names

The browser tab title (`<title>`) is only the plain page name.

- No website name
- No separators such as `|`, `-` or `:`
- No taglines, keywords or extra words

**One exception: the home page.** The home page has no page name of its own, so its title carries the website name and a short description of the platform, built from `frontend.head.home` with the `:site` placeholder:

```php
'site' => '[Website Name]',
'home' => ':site — E-Learning Materials',
```

Every other page keeps its plain page name. Do not add the website name to any other title.

| Page | Tab title |
|---|---|
| Home | The website name and a short platform description (see the exception above) |
| About page | About Us |
| Contact page | Contact Us |
| Material listing | E-Learning Materials |
| Category page | The category name from the database |
| Material detail | The material title from the database |
| Cart | Cart |
| Checkout | Checkout |
| Login | Login |
| Register | Register |
| Forgot password | Forgot Password |
| Reset password | Reset Password |
| Dashboard | Dashboard |
| My materials | My Materials |
| Orders | Orders |
| Order details | Order Details |
| Profile | Profile |
| FAQ | FAQ |
| Terms & Conditions | Terms & Conditions |
| Privacy Policy | Privacy Policy |
| Refund Policy | Refund Policy |
| Delivery & Access Policy | Delivery & Access Policy |
| Page not found | Page Not Found |

Meta descriptions, Open Graph and Twitter tags are separate from the tab title (see section 17).

### 2.5 Descriptive, structured writing everywhere

All content, and especially the Terms & Conditions and the policy pages, must be:

- Descriptive enough to answer real learner questions
- Organised under clear headings
- Broken into short paragraphs
- Supported by bullet points wherever several items, steps or conditions are listed

Do not turn a whole page into one long paragraph, and do not reduce a whole page to bare bullet points. Use a short introductory paragraph under each heading, then bullets for the details.

#### Bullet point punctuation

- Do not put a full stop at the end of a bullet point
- This applies to every language, including the Japanese full stop `。`
- Commas and other punctuation inside a bullet are fine, only the closing full stop is removed
- If a bullet really needs more than one sentence, write it as a short paragraph instead, or split it into separate bullets
- Question marks and exclamation marks stay where they belong, for example in an FAQ question
- Full stops are still used normally in paragraphs, labels, validation messages and system messages

| Wrong | Right |
|---|---|
| - Users are responsible for keeping login details secure. | - Users are responsible for keeping login details secure |
| - アカウントは個人用です。 | - アカウントは個人用です |

### 2.6 Footer newsletter success message

The success message must be exactly:

| Language | Message |
|---|---|
| English | `Thank you for subscribing` |
| Japanese | `ご登録ありがとうございます` |

- Do not add any other sentence before or after it.
- Do not change the wording.

### 2.7 Approved terminology: e-learning materials, not online courses

The website sells digital study materials. Customers buy them, receive them by email and read them on their own. Nobody attends anything, nobody is taught live and there is no class to join.

Customer-facing content must never suggest otherwise. Remove "Online Courses" and every word that implies attendance, a timetable or a teacher.

| Do not write | Write instead |
|---|---|
| Online Courses, Our Courses, Course catalogue | E-Learning Materials |
| Course, this course | E-learning material, the material, this material |
| Course content | Study material, learning material |
| Enroll, enrollment, sign up for a course, register for a course | Get access, unlock, buy |
| Class, lesson, session, workshop, seminar, webinar, training, programme | Module, topic, section, study material |
| Instructor, teacher, tutor, trainer, coach, mentor | Do not use. Nobody teaches the learner |
| Attend, join, take part, sit in, live session, schedule, timetable, curriculum, syllabus | Read, study, work through at your own pace |
| Students, classmates, cohort, batch | Learners, customers |
| Classroom, campus, seat, place on the course | Do not use |
| Certificate, graduation, completion award | Do not use unless the business really issues one (section 25) |

Wording that is still fine:

- "Learning", "e-learning", "study", "read", "self-paced", "at your own pace", "levels", "topics", "modules"
- "Learner" and "customer" for the person buying
- Section 9A wording for credits, which is unchanged: credits unlock a **level** of an e-learning material

What does **not** change:

- **Database values.** Category names, product titles and level names are shown exactly as stored (sections 3 and 27). If a stored title contains the word "course", that is a data question: report it and ask, never rewrite the record or paper over it in the view.
- **Internal names.** Routes, controllers, tables, columns, variables and translation key names may keep words such as `course`. Only text the customer reads has to change.
- **Third-party text.** Wording supplied by the payment provider stays as the provider writes it.

Check the same way in every language. Japanese must not use 受講, 講座, 授業, 受講生, 講師 or similar attendance wording; use 教材, 学習教材, ご利用 and 学習者 instead.

---

## 3. Source of Truth

The existing database is the source of truth for:

- Categories, category names and slugs
- Courses, course names and slugs
- Skill levels and their relationships
- Prices
- Status values
- Images linked to categories and courses
- Company name, email and address

Rules:

- Do not invent categories, courses, levels or prices.
- Do not rename or re-link database records.
- Count items (courses per category, levels per course) from the real data, never by guessing.

---

## 4. Writing Style

### English

Write in a way that is:

- Natural, simple and human
- Professional and clear
- Detailed where explanation is needed
- Short where a label or button is enough

Avoid:

- Robotic or overly corporate language
- Buzzwords and jargon
- Long, complicated sentences
- Repeating the same idea
- Keyword stuffing

### Other languages (for example Japanese)

- Localize professionally. Do not translate word for word.
- Sound natural to native readers.
- Keep the same meaning and level of detail as English.
- Every customer-facing English item must have a translated equivalent.
- **No English left on the Japanese site.** This includes stock phrases such as "All Rights Reserved.", button labels, empty messages and short labels like "Menu", "Close", "Language" and "Currency".
- **Hidden text is translated too:** image ALT text, `aria-label` values, `title` tooltips and JavaScript validation messages.
- The only text that may stay the same in every language is data from the database (material titles, category names, company name, email and address), the language names themselves in the language switcher (`English`, `日本語`), and the country names in the checkout country dropdown (see section 19.13).

Common stock phrases:

| English | Japanese |
|---|---|
| All Rights Reserved. | 無断転載を禁じます。 |
| Thank you for subscribing | ご登録ありがとうございます |
| Back to top | ページの先頭へ戻る |
| Accepted payment methods | ご利用いただけるお支払い方法 |

---

## 5. Translation Keys

- Every rewritten customer-facing text gets a new, logically named translation key.
- Do not reuse old keys for new content.
- Keep key names **short and simple**. Do not use long names or prefixes such as a brand or site name.

### 5.1 File structure

All customer-facing website text lives in one file per language:

```text
resources/lang/en/frontend.php
resources/lang/ja/frontend.php
```

- Both files always contain exactly the same keys.
- Inside the file, text is grouped by the view it belongs to, with a comment naming that view.
- Build the file **one view at a time**. Only add keys that the view actually uses. Do not fill the file with general text in advance.
- Keys are three short parts: `frontend.group.key`.

```php
return [

    // Dummy fallbacks, used only when the miscs table value is empty
    'company' => [
        'name'    => '[Company Name]',
        'email'   => '[Company Email]',
        'address' => '[Company Address]',
    ],

    // resources/views/frontend/layouts/footer.blade.php
    'footer' => [
        'news_title'   => 'Stay up to date with new materials',
        'news_success' => 'Thank you for subscribing',
        'rights'       => 'All Rights Reserved.',
    ],

];
```

| Too long | Use instead |
|---|---|
| `managenovax.home.hero_section_main_heading` | `frontend.home.title` |
| `site.contact.form_submission_success_message` | `frontend.contact.success` |
| `site.policy.refund.eligibility_section_title` | `frontend.refund.eligibility` |
| `managenovax.footer.newsletter_subscribe_success` | `frontend.footer.news_success` |
| `managenovax.footer.copyright_all_rights_reserved` | `frontend.footer.rights` |

### 5.2 Checks after each view

- Every key used in the view exists in both language files.
- Every key in the group is used by the view. Remove unused keys.
- No hardcoded customer-facing text is left in the view, including ALT text, `aria-label`, `title` and JavaScript messages.
- The view compiles without errors.
- Every claim on the page was checked against the code (section 25.1).
- No raw database values are shown: statuses, level names, dates and counts are translated (section 25A).
- No English text is left inside JavaScript, and forms use `novalidate` (section 25B).
- Page validation matches the server rules (section 19.2).

- After replacing content, search the whole project for old keys, delete any that are no longer used, and search again to confirm.
- Translation files must contain only keys that are actually used.

---

## 6. Home Page

The home page should explain, in this order where the layout allows:

- What the platform is and who it is for
- What learners can study (categories from the database)
- How the e-learning materials and skill levels are organised
- How to find a suitable material
- How buying a material works, and how it is delivered by email
- A clear call to action

### Hero section

- One clear headline
- One supporting paragraph
- One primary button, with an optional secondary button
- Button text describes the real action, for example **Explore Materials**, **Browse Categories** or **Find a Material**

### Category section

- Category name and image from the database
- A short line of supporting text that works for any subject
- Material count only when calculated from real data
- A link to the real category route

### How it works section

Use simple numbered steps:

1. **Choose a category.** Browse the available subject areas.
2. **Pick a material.** Compare the e-learning materials and read what each one covers.
3. **Select a level.** Choose the level that matches your current knowledge.
4. **Review the details.** Check the description, what is included and the price.
5. **Complete checkout.** Pay securely using the available payment options.
6. **Start learning.** Open the access email sent to you at checkout, or find the material in your account.

Only describe access methods the application really provides, and keep to the delivery and access facts in section 15.

---

## 7. Category Page

- **Header:** category name (from the database) and a short, universal introduction.
- **Material list:** cards with title, short description, available levels, image, price where shown, and a button.
- **Empty state:** if a category has no e-learning materials, explain that and link to all materials.

---

## 8. E-Learning Material Page

Recommended sections:

1. Material introduction
2. What the material covers
3. Available skill levels
4. What to expect at each level
5. Learning outcomes
6. Material information (price, level, format as provided by the system)
7. Related materials
8. Call to action

Each level must read differently. Do not make all levels sound identical.

---

## 9. Skill Levels

Use the level names that exist in the database. For a common four-level structure:

### Beginner

For learners who are new to the subject.

- Core ideas and key terms
- Simple methods and basic workflows
- Easy, practical examples

### Intermediate

For learners who already understand the basics.

- Applying knowledge in real situations
- More detailed techniques
- Solving common problems

### Advanced

For learners with solid practical experience.

- Complex situations and projects
- Combining several techniques
- Making confident decisions under pressure

### Expert

For learners who want the deepest level available.

- Mastery and refinement
- Handling difficult trade-offs
- Bringing many concepts together

Never promise certificates, accreditation, jobs or guaranteed results unless the application actually provides them. Never describe a level as something the learner attends, joins or is taught (section 2.7).

---

## 9A. Credits System

The website uses credits. Learners buy credits with money, then spend credits to unlock e-learning materials and levels. All content must explain this clearly and consistently.

### 9A.1 How credits work

Explain in simple steps:

1. **Buy credits.** Choose a credit package on the top-up page and pay at checkout.
2. **Credits are added to your account.** Your balance appears in your account once payment is confirmed.
3. **Unlock a level.** Each level of an e-learning material shows its price in credits. Spend credits to unlock it.
4. **Start learning.** Access details for the unlocked level are emailed to you, and the level appears in your account (section 15).

### 9A.2 Wording rules

- Use one term everywhere: **credits**. Do not mix "credits", "points", "coins" and "tokens" in customer-facing text, even if the code uses a different name internally.
- Show credit prices and balances from the database only. Never write fixed numbers into content.
- Always make it clear that money buys credits, and credits unlock e-learning materials.
- Show the learner's current balance wherever credits are spent (material page, cart, checkout, dashboard).

### 9A.3 Messages to cover

Every credit-related message must be clear and localized:

| Situation | Example message |
|---|---|
| Credits added | Your credits have been added to your account. |
| Level unlocked | This level is now unlocked. You can start learning. |
| Not enough credits | You do not have enough credits. Please buy more credits to continue. |
| Already unlocked | You have already unlocked this level. |
| Payment failed | Your payment could not be completed. No credits were added. |
| Balance label | Your credits |

### 9A.4 Credit validity: 90 days

Credits have a defined validity period, and it must be stated:

- **Credits are valid for 90 days from the date of purchase.** Use that figure and no other
- Never write that credits never expire, and never quote a different validity period
- State it wherever credits are explained: the Terms & Conditions, the top-up page, the FAQ and the checkout page
- In the Terms & Conditions it is the **last bullet point of the Credits section**, worded as "Have a validity period of 90 days from date of purchase" or a close, natural rewording that keeps the same meaning in the page's language

Do not claim any of the following unless the business rules define it:

- Credits can be refunded, transferred or exchanged for cash
- Bonus or free credits
- Discounts for larger packages

If a rule is not defined, do not mention it.

### 9A.5 Credits in policies and FAQ

- **Terms & Conditions:** a "Credits" section explaining how credits are bought, used, and that they have no cash value outside the website (only if true for the business). Its final bullet states the validity period: **credits have a validity period of 90 days from the date of purchase**.
- **Refund Policy:** explain how refund requests for credit purchases are handled, including what happens to credits already spent and to credits that have passed their 90 day validity.
- **Delivery & Access Policy:** explain that credits are added to the account after payment is confirmed, that e-learning materials unlock after credits are spent, and repeat the delivery timing and the 72 hour limit from section 15.
- **FAQ:** What are credits? How do I buy credits? How long are they valid? How do I use credits? Where can I see my balance? What if my credits do not appear?

---

## 9B. Checkout Billing Descriptor (DBA)

The checkout page shows a notice explaining what name will appear on the learner's bank or card statement, followed by the DBA image.

### 9B.1 Text

Use this sentence exactly:

| Language | Text |
|---|---|
| English | `When you purchase credits from our website, your billing description will be shown as` |
| Japanese | `当サイトでクレジットをご購入いただくと、ご請求明細には次のように表示されます` |

Then show the DBA image directly after the text.

### 9B.2 Layout

```blade
<p>
    {{ __('frontend.checkout.billing') }}
    <img src="{{ asset('assets/images/dba.webp') }}" alt="{{ __('frontend.checkout.billing_alt') }}">
</p>
```

### 9B.3 Rules

- The notice appears on the checkout page, close to the payment button, so it is seen before paying.
- The DBA image comes from `public/assets/images/dba.webp`. Do not replace it with typed text.
- The image ALT text is short and localized, for example `Billing description`.
- Do not add extra sentences, promises or marketing wording to the notice.

---

## 10. About Us Page

Explain, in universal terms:

- Why the platform exists
- How learning is organised into categories and levels
- The value of structured, self-paced progress
- What learners can expect from the experience

Do not invent founders, instructors, company history, awards, partnerships, accreditations or learner numbers.

---

## 11. Contact Us Page

Include:

- A short, friendly introduction
- Common reasons to get in touch, as bullet points (questions about an e-learning material, purchase or payment help, a material that has not arrived, account access, refund requests, general feedback)
- Company email and address from the `miscs` table (no company phone)
- A contact form with helpful field labels and hints
- A localized success message, error message and validation messages

---

## 11A. Legal Pages — Master Reference

This section is the single source of truth for the four legal pages: **Terms & Conditions, Privacy Policy, Refund Policy and Delivery & Access Policy**. Sections 12 to 15 describe what each page contains. This section carries the facts, figures and exact wording that all four must agree on, so they can be checked in one place instead of four.

Read this before touching any of the four pages. If anything below disagrees with a page, the page is wrong.

### 11A.1 Where this content actually lives

**The four legal pages are database records, not lang files.** This is the most common reason a sweep misses them.

| Content | Location |
|---|---|
| Terms, Privacy, Refund, Delivery page bodies | `pages` table — `page_desc` (English) and `page_desc_ja` (Japanese) |
| Page titles | `pages` table — `page_title`, `page_title_ja` |
| Everything else (FAQ, checkout, cart, order confirmation, badges) | `resources/lang/en/frontend.php` and `resources/lang/ja/frontend.php` |

Consequences:

- A grep of the lang files alone will **not** find policy wording. Search the database dump as well
- The page bodies are HTML stored inside a SQL string. Quotes appear as `\"` and line breaks as `\r\n`. Match on the escaped form when editing the dump directly
- English and Japanese are two separate columns on the same row. Every change is made twice, and the two must stay structurally identical — same sections, same numbering, same bullet counts
- Section numbering is written into the headings by hand. Deleting a section means renumbering every heading after it, in both languages

### 11A.2 The three figures, and nothing else

Only three numbers may appear anywhere on the website in connection with delivery, access or credits. Every one of them is a fixed business rule, written as plain text. None of them is read from the database.

| Figure | Value | What it measures |
|---|---|---|
| **Delivery, normal** | within **24 hours** of confirmed payment | how long until the access email arrives |
| **Delivery, delayed** | up to **48 to 72 hours** | the outside case when the system is slow |
| **Report a problem** | after **72 hours** | when the learner should contact support |
| **Credit validity** | **90 days** from date of purchase | when unspent credits expire |

**There is no fourth figure.** In particular there is no access period: credits expire, e-learning materials do not.

Two mistakes to guard against, because both have happened:

- **Never write 24 hours where the text means the reporting limit.** The learner contacts support after **72** hours, not 24. This applies in every section, including any "Email Delivery Issues" or "Failure to Receive Access Information" section
- **Never confuse the 72 hour delivery limit with an access limit.** 72 hours is a deadline for chasing a missing email. It is not how long the material can be used, and rewriting an access period to "72 hours" would tell learners their purchase expires in three days

### 11A.3 Canonical wording

Reword naturally for each page and language, but never contradict.

**Delivery timing** — the full statement, used in the Delivery & Access Policy and echoed everywhere delivery is described:

> E-Learning Materials and applicable access information are typically made available within 24 hours after successful payment confirmation. Delivery may occasionally be delayed because of system processing, payment verification, technical issues, email service interruptions, or circumstances beyond our reasonable control. Please allow up to 48 to 72 hours for delivery. If you have not received or cannot access your purchased Materials after 72 hours, please contact us at :email.

**Credit validity** — the last bullet of the Terms & Conditions Credits section:

> Have a validity period of 90 days from date of purchase

**Reporting limit** — wherever a section tells the learner when to get in touch:

> If the relevant email or access information is still unavailable after 72 hours, please contact us at :email

The contact address is always the `:email` placeholder filled from the `miscs` table, never a hardcoded address (section 2.3).

### 11A.4 Where each fact must appear

| Fact | T&C | Privacy | Refund | Delivery | FAQ | Checkout | Order confirmation |
|---|---|---|---|---|---|---|---|
| Delivery within 24 hours | yes | — | yes | yes | yes | yes | yes |
| Up to 48 to 72 hours | summary | — | yes | yes | yes | — | yes |
| Contact after 72 hours | — | — | yes | yes | yes | — | yes |
| Credits valid 90 days | **last bullet of Credits section** | — | yes | yes | yes | yes | — |

A page that describes delivery or credits and omits the matching figure is incomplete. A page that states a different figure is wrong.

### 11A.5 Access: what may and may not be said

This is the distinction that is easiest to get wrong, and getting it wrong in either direction causes a real problem.

**Never allowed — a length of access.** Any wording that tells the learner how long access lasts, in any unit:

- "Access lasts 2 weeks", "14 days", "the 14-day access period", "2週間", "14日間のアクセス期間"
- A section headed "Access Period", "14-Day Access Period" or "Expiration of Access"
- A bullet under User Responsibility telling the learner to use the material within some named period

These are promises to the customer. If one is found, remove the length. If a whole section exists only to define it, delete the section and renumber the page.

**Never allowed — a promise of permanence.** The opposite error, and banned just as firmly:

- "lifetime access", "unlimited access", "indefinitely", "forever", "permanent", "access any time"
- 無期限, 永久

**Allowed, and worth keeping — duration-free wording.** Phrases that name the mechanism without committing to a length:

- "within an applicable access period"
- "extending the applicable access period"
- "during the applicable access period"
- 適用されるアクセス期間

These are not promises to the customer. They are company protections: a ground for declining a refund, a remedy that can be offered short of refunding, a records-keeping responsibility placed on the user. Removing them quietly weakens the company's position, so leave them where they appear. Never attach a number to one.

The test in one line: **if it says how long, remove it; if it only says that a period may apply, keep it.**

### 11A.6 Required and forbidden sections

**Every legal page must have**, whatever else it carries:

- A short introduction saying what the page covers
- A contact section with company name, email and address from the `miscs` table, and no phone number
- A "changes to this policy" section saying the published version is the one that applies

**Refund Policy must have** a section on failing to receive access information, in which **every hour figure reads 72**.

**Delivery & Access Policy must have** the delivery process section carrying all four facts from section 15.2, and an email delivery issues section in which **every hour figure reads 72**.

**Terms & Conditions must have** the Company Information table at the top of section 1 (section 12.1A), and a Credits section whose **last bullet** is the 90 day validity. It must **not** carry the credit tier (multiplier) table.

**No page may have** a section named for an access period or its expiry.

### 11A.7 Before calling a legal page done

- [ ] English and Japanese have the same sections, in the same order, with the same numbers
- [ ] Section numbering runs 1, 2, 3 … with no gap left by a deleted section
- [ ] Every delivery figure is 24 hours / 48 to 72 hours / 72 hours, and nothing else
- [ ] Every "contact us after" figure is 72 hours, including in email-issues and failure-to-receive sections
- [ ] The T&C Credits section ends with the 90 day validity bullet
- [ ] The T&C has the Company Information table at the top of section 1: company name, DBA image, email, address, and no phone row
- [ ] The T&C has no credit tier (multiplier) table
- [ ] Every DBA image sits inline with its text and shows the logo clearly
- [ ] No length of access appears anywhere, in any unit, in either language
- [ ] No permanence claim appears anywhere, in either language
- [ ] Duration-free "applicable access period" wording is still present where it was
- [ ] No bullet ends with a full stop, including the Japanese `。` (section 2.5)
- [ ] Company details are placeholders filled from `miscs`, never hardcoded (section 2.3)
- [ ] No "course", "class", "lesson", "enroll" or "instructor" wording, and no 講座 / 受講 / 授業 / 講師 (section 2.7)
- [ ] The page still parses: the SQL dump has the same row count, and quotes and line breaks are still escaped as `\"` and `\r\n`

---

## 12. Terms & Conditions

> Figures, exact wording and the access rules for this page are in **section 11A**. This section describes what the page contains; 11A governs what it must say.

Must be descriptive, with a heading for each section, a short introductory paragraph, and bullet points for details.

### 12.1 Introduction

- What the website provides: digital e-learning materials for self-paced study, delivered by email.
- That using the website means accepting these terms.

### 12.1A Company Information Table

Directly under the introduction paragraphs of section 1, the Terms & Conditions carries a small heading and a two-column table that identifies who runs the website. This table is required, and it sits **at the top** of the page, before section 2.

| Row label (EN) | Row label (JA) | Value |
|---|---|---|
| Company Name | 会社名 | `:company` |
| Doing Business As (DBA) | 事業名（DBA） | The DBA image `assets/images/dba.webp`, with ALT text `DBA` |
| Email Address | メールアドレス | `:email` |
| Company Address | 会社の住所 | `:address` |

- Heading: `Company Information` / `会社情報`
- **No phone row**, in any language
- The label column is bold on a light grey background, the value column is plain
- The DBA row shows the image, never typed text
- Do not repeat the DBA image in the Contact section at the end of the page, because the table already carries it

```html
<h3>Company Information</h3>
<table class="ag-table">
    <tbody>
        <tr><td>Company Name</td><td>:company</td></tr>
        <tr><td>Doing Business As (DBA)</td><td><img src="/assets/images/dba.webp" alt="DBA" style="display: inline-block; max-height: 30px; margin: 0 0 0 6px; vertical-align: middle; box-shadow: none;"></td></tr>
        <tr><td>Email Address</td><td>:email</td></tr>
        <tr><td>Company Address</td><td>:address</td></tr>
    </tbody>
</table>
```

#### DBA image rules inside policy pages

- The DBA image is always **inline with its text**: in the table cell, and in the billing sentence of the Purchases section (`When you purchase credits from our website, your billing description will be shown as` followed by the image on the same line)
- Give the image the inline style shown above: `display: inline-block; max-height: 30px; margin: 0 0 0 6px; vertical-align: middle; box-shadow: none;`
- **Never give the image the class `dba`.** That class belongs to the checkout billing notice box and adds padding, a violet background and a border, which squeezes the 72 × 32 logo out of sight
- ALT text: `DBA` in the table, `Billing description` / `ご請求明細の表示` in the billing sentence

#### How the placeholders are filled

The policy pages are database records, so the placeholders are written into the HTML exactly as `:company`, `:email` and `:address`. The view `resources/views/frontend/pages/page.blade.php` replaces them before output:

- `:company`, `:address` with the `miscs` values, or the `[Company Name]` / `[Company Address]` fallbacks
- `:email` with a `mailto:` link to the `miscs` company email
- `:delivery_url` and `:refund_url` with the real routes of the Delivery & Access Policy and the Refund Policy
- `src="/assets/…` with the site's real asset URL, so images also work when the site runs in a subfolder

Do not write real company values or a phone number into the page HTML.

#### No credit tier table in the Terms & Conditions

The credit rate (1 credit = US$1 = ¥160 = HK$8) may be stated in the Credits section, but the tier table (Standard, Premium, Elite, VIP with their bonuses) does **not** belong in the Terms & Conditions. Refer to the Buy Credits page instead, for example: "the bonus that applies to larger single purchases is shown on the Buy Credits page".

### 12.2 Eligibility and Accounts

- Users must provide accurate and up-to-date information.
- Users are responsible for keeping login details secure.
- Accounts are personal and must not be shared or sold.
- Users must tell the company if they suspect unauthorized access.

### 12.3 E-Learning Materials and Pricing

- Material details and prices are shown on the website before purchase.
- Prices and material information may be updated from time to time.
- The price shown at checkout is the price that applies to that order.

### 12.4 Purchases and Payment

- How a purchase is completed through checkout.
- Payment is handled through the payment methods the website actually offers.
- An order is confirmed only after successful payment.
- Money buys credits, and credits unlock a level. The Credits section ends with the validity period: **credits are valid for 90 days from the date of purchase** (section 9A.4).

### 12.5 Access to E-Learning Materials

- The download link and access details are sent by email to the address given at checkout after payment is confirmed, and the material is also reachable through the platform.
- Delivery is typically within 24 hours, and within 72 hours at the outside if the system is delayed.
- Summarise the process in a few lines and link to the Delivery & Access Policy for the full detail (section 15). Do not contradict it.
- Materials are for self-paced reading. There is nothing to attend and no live teaching.

### 12.6 Intellectual Property

- E-learning materials, videos, text, graphics and branding belong to the company or their rightful owners.
- Learners receive a personal, non-transferable right to use purchased materials for their own learning.

### 12.7 Acceptable Use

Users agree to:

- Use the website and materials lawfully and respectfully
- Use purchased content for personal learning only
- Follow any instructions provided with the materials

### 12.8 Prohibited Activities

Users must not:

- Copy, download (unless allowed), share, resell or redistribute the e-learning materials
- Share account access with others
- Try to bypass payment or access controls
- Interfere with the website's security or operation
- Make fraudulent purchases or chargebacks

### 12.9 Refunds

- A short summary with a link to the Refund Policy.

### 12.10 Changes to the Website and Terms

- Features, content and material information may be updated.
- The terms may change, and the version published on the page is always the one that applies.

### 12.11 Disclaimer

- The e-learning materials are for educational purposes.
- No guarantee of specific personal, professional, academic or financial results.

### 12.12 Limitation of Liability

- General, careful wording limiting liability to the extent permitted by law.
- No invented legal claims.

### 12.13 Suspension and Termination

- Accounts that break these terms may be suspended or closed.

### 12.14 Governing Law

- Use the jurisdiction only if it exists in the project. Otherwise use neutral wording and do not invent one.

### 12.15 Contact

- Company name, email and address from the `miscs` table. No phone number.

---

## 13. Privacy Policy

> Figures, exact wording and the access rules for this page are in **section 11A**. This section describes what the page contains; 11A governs what it must say.

Descriptive, with headings, short paragraphs and bullet points.

### 13.1 Introduction

- Why the policy exists and what it covers.

### 13.2 Information We Collect

Only list what the application really collects, for example:

- Name and email address
- Account and login information
- Order and purchase history
- Billing details required to complete a purchase
- Messages sent through the contact form
- Newsletter subscription email
- Technical data needed to run the website (such as browser type and IP address)

### 13.3 How We Use Information

- Creating and managing accounts
- Processing orders and sending access details and e-learning materials by email
- Answering support requests
- Sending newsletters to subscribers who opted in
- Keeping the website secure and preventing fraud
- Improving the website and learning experience

### 13.4 Payment Information

- Explain that payments are handled by the payment provider.
- Do not claim full card details are stored unless the system really stores them.

### 13.5 Cookies

- Describe only the cookies the website actually uses (for example session, security and preference cookies).
- Explain how users can manage cookies in their browser.

### 13.6 Sharing Information

Information may be shared only with:

- Payment providers
- Hosting and technical service providers
- Authorities when required by law

Never sell personal information. Do not name third-party companies unless the project uses them.

### 13.7 Data Security

- Reasonable technical and organisational measures are used.
- No method is completely secure, so absolute security cannot be promised.

### 13.8 Data Retention

- Data is kept only as long as needed for the purposes above or as required by law.

### 13.9 Your Rights

Users may be able to:

- Access their personal information
- Correct inaccurate information
- Request deletion where possible
- Unsubscribe from newsletters at any time

Do not invent region-specific legal rights.

### 13.10 Changes to This Policy

- The version published on the page is always the current one.

### 13.11 Contact

- Company name, email and address from the `miscs` table. No phone number.

---

## 14. Refund Policy

> Figures, exact wording and the access rules for this page are in **section 11A**. This section describes what the page contains; 11A governs what it must say.

Descriptive, with headings, short paragraphs and bullet points.

### 14.1 Overview

- The policy covers purchases of digital e-learning materials and credits.

### 14.2 Eligibility

- Explain when a refund may be considered, for example duplicate payments, technical problems that stop access, or material not matching its description.
- Do not invent a refund period such as 7, 14 or 30 days unless the business has defined one.
- Do not promise a guaranteed refund.

### 14.3 Non-Refundable Situations

For example:

- Materials that have been substantially accessed or read
- Requests based on a change of mind after the access email has been sent (unless business rules allow it)
- Accounts suspended for breaking the Terms & Conditions

### 14.4 Failure to Receive Access Information

This section must exist on the Refund Policy page, and **every hour figure in it is 72 hours**. It is the one the learner reads when nothing arrived, so a shorter figure here would contradict the delivery rules in section 15.2.

- If a learner has not received the access information for a purchased e-learning material within 72 hours of confirmed payment, they should contact support
- If support cannot restore access, and the learner has not been able to use the material, a refund may be considered
- Every occurrence of a waiting time in this section reads **72 hours**. Never write 24 hours here, in any language, even where an older version of the page did

### 14.5 How to Request a Refund

1. Contact support using the company email from the database.
2. Include the order number, the email used for the purchase and the reason for the request.
3. Wait for the request to be reviewed.

Do not mention a dashboard refund button unless one exists. Say that a learner who has not received, or cannot access, a purchased material should contact support after 72 hours, and use that same 72 hour figure everywhere it appears in this policy.

### 14.6 Review and Processing

- Every request is reviewed individually.
- Approved refunds go back to the original payment method.
- Processing time depends on the payment provider or bank.

### 14.7 Contact

- Company name, email and address from the `miscs` table. No phone number.

---

## 15. Delivery & Access Policy

> Figures, exact wording and the access rules for this page are in **section 11A**. This section describes what the page contains; 11A governs what it must say.

Descriptive, with headings, short paragraphs and bullet points.

The page is called **Delivery & Access Policy**. Do not use the old name "Delivery & Course Access Policy" in the title, the footer link, the breadcrumb or any link to it.

### 15.1 Digital Delivery

- All e-learning materials are digital. Nothing is shipped physically
- Materials are read and studied at the learner's own pace. There is nothing to attend and no live teaching

### 15.2 E-Learning Material Access & Delivery Process

These are the business rules for delivery and access. Every one of them must appear on this page, under this heading, in these words or a close and natural rewording in the page's language. Do not drop a point, soften it or add a promise that is not here.

- **Delivery method:** once payment is confirmed, the download link and the access details are sent to the email address provided at checkout, and the material is also available through the platform, so the learner can download it and use it whenever they like
- **Delivery timing:** e-learning materials and the applicable access information are typically made available within 24 hours of successful payment confirmation
- **Possible delay:** delivery may occasionally be delayed by system processing, payment verification, technical issues, email service interruptions or circumstances beyond our reasonable control. Learners should allow up to 48 to 72 hours
- **72 hour limit:** if a learner has not received, or cannot access, the purchased materials after 72 hours, they should contact support

The canonical wording for the delivery timing point, to be reworded naturally per page but never contradicted:

> **Delivery Timing:** E-Learning Materials and applicable access information are typically made available within 24 hours after successful payment confirmation. Delivery may occasionally be delayed because of system processing, payment verification, technical issues, email service interruptions, or circumstances beyond our reasonable control. Please allow up to 48 to 72 hours for delivery. If you have not received or cannot access your purchased Materials after 72 hours, please contact us.

Rules for these facts:

- They are fixed business rules, so they are written as plain sentences in the lang files, not read from the database
- The same facts are repeated wherever delivery or access is described: this page, the Terms & Conditions, the Refund Policy, the FAQ, the checkout page and the order confirmation screen and email
- Never state a different figure anywhere. It is always "within 24 hours", "up to 48 to 72 hours" and "after 72 hours"
- **72 hours is the outer limit quoted to learners.** Never write 24 hours where the text means the limit for reporting a problem, and never quote a shorter figure such as "a few minutes", "instant", "immediate" or "straight away" to make delivery sound faster
- Never write "lifetime access", "unlimited access", "indefinitely", "forever" or "access any time". The material is downloadable and the learner keeps what they download; that is not the same as a promise of permanent access to the platform, so do not word it as one
- Do not promise offline or downloadable access for a material that is not actually downloadable
- **Never state how long access lasts.** No page gives a duration for access in hours, days or weeks. There is no access period to quote: credits expire, e-learning materials do not. The only figures quoted anywhere are the delivery times above and the 90 day credit validity in section 9A.4
- **Duration-free wording such as "the applicable access period" is allowed, and should be kept.** It names the mechanism without promising a length, and it protects the business rather than binding it. Keep it where it already appears, for example a non-refundable ground ("failed to access the Materials within an applicable access period"), a remedy short of a refund ("extending the applicable access period") or a records-keeping responsibility. Never attach a number to it
- **No page carries a section named for the access period.** Headings such as "Access Period", "14-Day Access Period" or "Expiration of Access" do not exist. If one is found, delete the whole section and renumber the rest of the page

### 15.3 Where to Find Your E-Learning Materials

- The access email sent to the address given at checkout is the main delivery. Tell the learner to check the inbox, and the spam or junk folder
- Also name the real place in the account, for example the dashboard or "My Materials" page, only if the application really shows it there

### 15.4 Access Requirements

- A registered account
- Access to the email address used at checkout
- A stable internet connection
- A supported, up-to-date browser or device

### 15.5 If the Email or Access Does Not Arrive

1. Check the payment was completed.
2. Check the spam or junk folder of the email address used at checkout.
3. Check that the email address entered at checkout was correct.
4. Allow up to 48 to 72 hours from payment, as explained above.
5. Contact support with the order number if the material has still not arrived after 72 hours.

Where the policy page carries its own "Email Delivery Issues" section, **every hour figure in it reads 72 hours**. This is the section a learner reads when nothing arrived, so a shorter figure here contradicts section 15.2. Never write 24 hours in it, in any language, even where an earlier version of the page did.

### 15.6 Downloads and Keeping Your Materials

- The download link and access details reach the learner within the delivery times set out in section 15.2
- Once a material has been downloaded, the learner keeps the downloaded file and may use it whenever they like
- Say nothing about how long a downloaded file remains usable, and never describe it as permanent, unlimited or indefinite
- Do not say access to the platform renews, extends or can be restored unless the business has defined that. If a learner wants a level again, say only what the business allows, for example unlocking it again with credits
- The delivery timing and the 72 hour limit are stated before purchase as well, on the material page and at checkout, so nobody is surprised by them

### 15.7 Contact

- Company name, email and address from the `miscs` table. No phone number.

---

## 16. FAQ Page

Group questions under headings. Answers must match how the website really works.

- **Getting started:** What is this platform? Who are the e-learning materials for? Do I need an account?
- **Materials and levels:** How are the materials organised? How do I choose the right level? Can I buy more than one level?
- **Payments:** How do I buy an e-learning material? Which payment methods are accepted? Is payment secure?
- **Access:** How do I receive my materials? How long does the email take to arrive? What if the email does not arrive?
- **Credits:** How long are my credits valid? (90 days from the date of purchase, section 9A.4)
- **Refunds and support:** How do refunds work? How do I contact support?
- **Account and privacy:** How do I reset my password? How is my information handled?

Keep answers short and link to the full policy page where relevant. Do not copy policy text word for word.

The access answers must repeat the same facts as section 15: the download link and access details are emailed to the checkout address and are also available through the platform, delivery is typically within 24 hours, a system delay can stretch that to 48 to 72 hours, and support should be contacted if nothing has arrived after 72 hours. The credits answer states the 90 day validity from section 9A.4.

The FAQ carries **no question asking how long access lasts**, because there is no answer to give. A "How long do I have access?" entry left over from an earlier version is replaced by the credits validity question, not answered with a duration.

---

## 17. SEO

Every major page has its own:

- H1
- Descriptive image ALT text

The meta description, Open Graph and Twitter tags are shared. One site-wide
description covers every page, and a page only sets its own when it genuinely
has something more specific to say, such as a category or material page that can
use the summary from the database.

Rules:

- The tab title follows section 2.4 (plain page name only).
- The shared description is universal, so it must not mention a subject or niche.
- A page-specific description is optional, never required.
- No keyword stuffing and no unsupported claims.

---

## 18. Footer

Suggested groups (only link routes that actually exist):

- **Learning:** All E-Learning Materials, Categories
- **Company:** About Us, Contact Us, FAQ
- **Policies:** Terms & Conditions, Privacy Policy, Refund Policy, Delivery & Access Policy
- **Account:** Login, Register, Dashboard

Also include:

- Company email and address from the `miscs` table (no company phone)
- Newsletter form with the exact success message from section 2.6
- Copyright line in the format `© 2026 Company Name. All Rights Reserved.`

### Copyright line rules

- **Year:** generated dynamically, never hardcoded.
- **Company name:** read from the `miscs` table in the database, never hardcoded.
- **Link:** the company name is a link to the home page.
- **Fallback:** if the company name is empty in the database, show `[Company Name]` from the lang file.
- **Translated:** "All Rights Reserved." is translated on every language version of the site.
- **Keep it simple:** just the year, company name and the rights phrase. No taglines, slogans or extra sentences.

| Language | Result |
|---|---|
| English | `© 2026 Company Name. All Rights Reserved.` |
| Japanese | `© 2026 Company Name. 無断転載を禁じます。` |

Example:

```blade
@php
    $ftCompany = $misc['Company Name'] ?? __('frontend.company.name');
@endphp

&copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $ftCompany }}</a>. {{ __('frontend.footer.rights') }}
```

Use the real `miscs` keys and home route name that exist in the project.

### Other footer text

- Newsletter: a short label, a clear title and a description explaining what subscribers receive. Describe new e-learning materials, never new classes or sessions.
- The newsletter email error is translated. Add `novalidate` to the form so the browser's own English message is never shown, and show the translated message from JavaScript instead.
- The payment methods image has translated ALT text.
- The back-to-top button has a translated `aria-label`.

---

## 19. Form Placeholders and Validation

Every input on every form must have a label, a placeholder and clear validation messages. This applies everywhere: public pages, account pages, checkout, modals and AJAX forms.

### 19.1 Placeholder rules

- Every text, email, password, number, select and textarea field has a placeholder.
- Placeholders tell the user what to type, starting with "Enter", "Choose" or "Search".
- Placeholders never replace the label. The label stays visible.
- Do not use fake sample data (such as `john@example.com`) or company dummy values as placeholders.
- Keep placeholders short enough to fit on mobile.
- Placeholders are stored in the lang files and localized.

### 19.2 Validation rules

- Never use vague messages such as `Required`, `Invalid`, `Wrong` or `Error`.
- Each message names the field and says how to fix it.
- Show the message directly below the field it belongs to.
- Use the same message on the server side (Laravel validation) and the client side (JavaScript).
- Keep the user's other entered values when the form reloads with errors, except passwords.
- Validation messages are stored in the lang files and localized.
- For numeric limits (such as password length), use the real rule from the application, not a guessed number.
- **Page validation must match the server rules exactly.** Before writing JavaScript rules, read the Laravel validation in the controller and copy the same required fields and limits. For example, if the server requires `min:6` for the password, the page must also check 6, not 5.
- Show the real limit in the message by passing it as a parameter, for example `__('frontend.register.password_min', ['min' => 6])`.
- Do not add page-only rules the server does not have (for example, a minimum password length on the login form).

### 19.3 Shared fields

These fields appear on several forms. Use the same text everywhere.

| Field | Placeholder (EN) | Placeholder (JA) |
|---|---|---|
| Full name | Enter your full name | お名前を入力してください |
| First name | Enter your first name | 名を入力してください |
| Last name | Enter your last name | 姓を入力してください |
| Email | Enter your email address | メールアドレスを入力してください |
| Phone | Enter your phone number | 電話番号を入力してください |
| Password | Enter your password | パスワードを入力してください |
| New password | Enter a new password | 新しいパスワードを入力してください |
| Confirm password | Re-enter your password | パスワードをもう一度入力してください |
| Current password | Enter your current password | 現在のパスワードを入力してください |
| Address | Enter your street address | 住所を入力してください |
| City | Enter your city | 市区町村を入力してください |
| State / Region | Enter your state or region | 都道府県・地域を入力してください |
| Postal code | Enter your postal code | 郵便番号を入力してください |
| Country | Choose your country | 国を選択してください |

| Situation | Message (EN) | Message (JA) |
|---|---|---|
| Name empty | Please enter your name. | お名前を入力してください。 |
| Name too long | Your name must not be longer than :max characters. | お名前は:max文字以内で入力してください。 |
| Email empty | Please enter your email address. | メールアドレスを入力してください。 |
| Email invalid | Please enter a valid email address. | 有効なメールアドレスを入力してください。 |
| Email already used | This email address is already registered. Please log in instead. | このメールアドレスはすでに登録されています。ログインしてください。 |
| Phone empty | Please enter your phone number. | 電話番号を入力してください。 |
| Phone invalid | Please enter a valid phone number. | 有効な電話番号を入力してください。 |
| Password empty | Please enter your password. | パスワードを入力してください。 |
| Password too short | Your password must be at least :min characters long. | パスワードは:min文字以上で入力してください。 |
| Passwords do not match | The passwords you entered do not match. | 入力されたパスワードが一致しません。 |
| Current password wrong | Your current password is incorrect. | 現在のパスワードが正しくありません。 |
| Address empty | Please enter your address. | 住所を入力してください。 |
| City empty | Please enter your city. | 市区町村を入力してください。 |
| Postal code empty | Please enter your postal code. | 郵便番号を入力してください。 |
| Country not chosen | Please choose your country. | 国を選択してください。 |

`:min` and `:max` are Laravel validation parameters filled in by the framework. They are not content placeholders.

### 19.4 Login

| Field | Placeholder |
|---|---|
| Email | Enter your email address |
| Password | Enter your password |

| Situation | Message |
|---|---|
| Wrong email or password | The email address or password is incorrect. Please try again. |
| Too many attempts | Too many login attempts. Please try again in :seconds seconds. |
| Account disabled | Your account is not active. Please contact support. |
| Success | You have logged in successfully. |

### 19.5 Register

| Field | Placeholder |
|---|---|
| Name | Enter your full name |
| Email | Enter your email address |
| Password | Create a password |
| Confirm password | Re-enter your password |

| Situation | Message |
|---|---|
| Terms not accepted | Please accept the Terms & Conditions to continue. |
| Success | Your account has been created successfully. |

Plus the shared name, email and password messages from 19.3.

### 19.6 Forgot Password and Reset Password

| Field | Placeholder |
|---|---|
| Email | Enter your registered email address |
| New password | Enter a new password |
| Confirm password | Re-enter your new password |

| Situation | Message |
|---|---|
| Link sent | If this email is registered, a password reset link has been sent. |
| Email not found | We could not find an account with this email address. |
| Link expired or invalid | This password reset link is invalid or has expired. Please request a new one. |
| Password reset | Your password has been reset. You can now log in. |

### 19.7 Profile and Change Password

| Field | Placeholder |
|---|---|
| Name | Enter your full name |
| Email | Enter your email address |
| Phone | Enter your phone number |
| Current password | Enter your current password |
| New password | Enter a new password |
| Confirm new password | Re-enter your new password |

| Situation | Message |
|---|---|
| Profile saved | Your profile has been updated. |
| Password changed | Your password has been changed. |
| Same as old password | Your new password must be different from your current password. |
| Image too large | The image must not be larger than :max kilobytes. |
| Wrong image type | Please upload a JPG, PNG or WebP image. |

### 19.8 Contact Us

| Field | Placeholder |
|---|---|
| Name | Enter your full name |
| Email | Enter your email address |
| Phone | Enter your phone number |
| Subject | Enter the subject of your message |
| Message | Write your message here |

| Situation | Message |
|---|---|
| Subject empty | Please enter a subject. |
| Message empty | Please write your message. |
| Message too short | Your message must be at least :min characters long. |
| Message too long | Your message must not be longer than :max characters. |
| Success | Thank you for your message. We will get back to you soon. |
| Send failed | Your message could not be sent. Please try again. |

### 19.9 Footer Newsletter

| Field | Placeholder |
|---|---|
| Email | Enter your email address |

| Situation | Message |
|---|---|
| Email empty | Please enter your email address. |
| Email invalid | Please enter a valid email address. |
| Already subscribed | This email address is already subscribed. |
| Success | Thank you for subscribing |

The success message follows section 2.6 exactly.

### 19.10 Search and Filters

| Field | Placeholder |
|---|---|
| Material search | Search e-learning materials |
| Category filter | Choose a category |
| Level filter | Choose a level |
| Sort | Sort by |

| Situation | Message |
|---|---|
| Search empty | Please enter a word to search. |
| No results | No materials match your search. Try different words or browse all e-learning materials. |

### 19.11 Credits Top-Up

| Field | Placeholder |
|---|---|
| Credit package | Choose a credit package |
| Custom amount (if supported) | Enter the number of credits |

| Situation | Message |
|---|---|
| No package chosen | Please choose a credit package. |
| Amount empty | Please enter the number of credits. |
| Amount not a number | Please enter a whole number. |
| Amount too low | The minimum is :min credits. |
| Amount too high | The maximum is :max credits. |
| Added to cart | Credits have been added to your cart. |

### 19.12 Unlocking a Level

| Situation | Message |
|---|---|
| No level chosen | Please choose a level to unlock. |
| Not enough credits | You do not have enough credits. Please buy more credits to continue. |
| Already unlocked | You have already unlocked this level. |
| Must log in | Please log in to unlock this level. |
| Success | This level is now unlocked. You can start learning. |

### 19.13 Cart and Checkout

| Field | Placeholder |
|---|---|
| Billing name | Enter the name on your card |
| Billing email | Enter your billing email address |
| Billing phone | Enter your phone number |
| Billing address | Enter your billing address |
| City | Enter your city |
| Postal code | Enter your postal code |
| Country | Choose your country |
| Coupon code (if supported) | Enter your coupon code |

| Situation | Message |
|---|---|
| Cart empty | Your cart is empty. Please add credits before checking out. |
| Item removed | The item has been removed from your cart. |
| Terms not accepted | Please accept the Terms & Conditions to continue. |
| Payment method not chosen | Please choose a payment method. |
| Coupon invalid | This coupon code is not valid. |
| Payment failed | Your payment could not be completed. No credits were added. Please try again. |
| Payment cancelled | Your payment was cancelled. No credits were added. |
| Payment success | Thank you. Your payment was successful and your credits have been added. |

Card number, expiry and security code fields provided by the payment provider keep the provider's own placeholders and messages.

#### Country dropdown

- The dropdown lists **all countries and territories** (the full ISO 3166 list, about 250 entries), sorted alphabetically by name.
- The options are written **directly in the checkout view** as `<option>` tags. Country names are **not** stored in the lang files.
- Country names are shown in English on every language version of the site.
- Only the first, empty option ("Choose your country") comes from the lang file, so it is translated.
- Option values are two-letter country codes. Keep any existing values unchanged so saved orders still match (for example, this project uses `UK` for United Kingdom instead of `GB`).
- Save the view as UTF-8 so names such as Åland Islands, Côte d'Ivoire and Réunion display correctly.

```blade
<select name="country" id="country" autocomplete="country">
    <option value="">{{ __('frontend.checkout.country_ph') }}</option>
    <option value="AF">Afghanistan</option>
    <option value="AX">Åland Islands</option>
    <option value="AL">Albania</option>
    {{-- ...every other country... --}}
    <option value="ZW">Zimbabwe</option>
</select>
```

### 19.14 Reviews (if supported)

| Field | Placeholder |
|---|---|
| Rating | Choose a rating |
| Review | Share your experience with this material |

| Situation | Message |
|---|---|
| Rating not chosen | Please choose a rating. |
| Review empty | Please write your review. |
| Not purchased | You can review this material after unlocking it. |
| Success | Thank you for your review. |

### 19.15 General System Messages

| Situation | Message |
|---|---|
| Session expired | Your session has expired. Please refresh the page and try again. |
| Something went wrong | Something went wrong. Please try again. |
| Not logged in | Please log in to continue. |
| No permission | You do not have permission to view this page. |
| Page not found | The page you are looking for could not be found. |
| Network error | Please check your internet connection and try again. |

### 19.16 Localization

- Every placeholder and message above has a Japanese version (and a version for every other supported language) in the lang files.
- Use short keys in `frontend.php`, for example `frontend.contact.email_ph`, `frontend.contact.success`, `frontend.checkout.failed`.
- Only use the forms and fields that actually exist in the project. Skip any row marked "if supported" when the feature does not exist.

---

## 20. Success and Error Messages

Review and localize every customer-facing message in:

- Login, registration and password reset
- Contact form and newsletter
- Cart, checkout and payment
- Material delivery, access and account actions
- Profile updates
- AJAX responses, JavaScript alerts, modals and toast notifications

Messages should say clearly what happened and, for errors, what to do next.

---

## 21. Empty States

Explain what happened and offer a helpful next step.

- **No materials found:** "No e-learning materials match your search right now." with a button to view all materials.
- **No purchases yet:** "You have not purchased any e-learning materials yet." with a button to browse materials.
- **No orders:** "You have no orders to show." with a button to explore e-learning materials.

Never use messages such as `No data`.

---

## 22. Breadcrumbs, Search and Filters

- Breadcrumbs follow the real hierarchy, for example: Home → Category → Material → Level.
- Breadcrumb labels are translated. Category and material names come from the database.
- Search covers the real catalogue of e-learning materials only. Placeholder, result and no-result messages are localized.
- Filters only use dimensions the backend supports, such as category and level.

---

## 23. Icons and Images

- Use Font Awesome icons that clearly relate to the content (envelope for contact, book for learning, shield for privacy, and so on).
- Do not use emoji as icons.
- Use category and material images from the database.
- ALT text must be descriptive, localized where supported, and free of keyword stuffing.

---

## 24. Responsive Content

- Headings stay short enough not to break layouts on mobile.
- Button text stays concise.
- Cards remain readable on small screens.
- Bullet lists stay easy to scan.

---

## 25. No False Claims or Fake Promises

Only promise what the website really does. Avoid phrases such as "instant access", "lifetime access", "indefinitely", "guaranteed results", "certified", "job-ready", "learn in 7 days", "100% satisfaction" or "the best platform" unless the application or business actually supports them. "Lifetime access" and "indefinitely" are banned outright: they must not appear anywhere on the website, in any language, whatever the context.

Delivery, access and credits are where exact figures are defined: delivery typically within 24 hours of confirmed payment, up to 48 to 72 hours if the system is delayed, support contacted after 72 hours (section 15.2), and credits valid for 90 days from the date of purchase (section 9A.4). Use those figures exactly, and do not improve on them.

Never invent:

- Learner counts, reviews, ratings or testimonials
- Instructor names or credentials
- Certificates, accreditation, partnerships or awards
- Success, employment or income results
- Guaranteed refunds
- Any delivery time other than the figures defined in section 15.2, and any length of access at all
- Any credit validity period other than the 90 days defined in section 9A.4
- Permanent, unlimited or indefinite access, in any wording
- Classes, lessons, live sessions, timetables, instructors or anything else the learner would attend (section 2.7)
- Company registration numbers, legal entity names or jurisdictions

If the data does not support a claim, do not write it.

### 25.1 Check the code before writing a claim

Before describing what happens on the website (payments, cart, credits, access, emails, refunds, limits), read the controller or view that does it. Write only what the code really does.

Real mistakes this rule prevents:

| Wrong claim | What the code actually does | Correct wording |
|---|---|---|
| "Your cart has been kept" after a failed payment | Cart items are attached to the order before payment, so the cart is empty | "No credits were added. Please try buying your credits again." |
| Payment method "Card" on every receipt | Orders unlocked with credits have no card payment | Show "Credits" for credit orders and "Card" for card payments |
| "Free" on materials with no levels | No levels means nothing can be unlocked yet, not that it is free | "Levels coming soon" |
| "24/7 access" | Nothing in the system guarantees round-the-clock access | "Online · Self-paced learning" |
| "Popular Courses" | There is no popularity data, and "courses" implies attendance | "Featured Materials" |
| "Instant access after payment" | The download link is emailed and is also available on the platform, typically within 24 hours of confirmed payment | "Your download link is emailed to you, normally within 24 hours of payment" |
| "Lifetime access" or "access indefinitely" | Nothing in the system promises permanent access; the learner downloads the material and keeps the file | "Download your material and keep it to use whenever you like" |
| "Your credits never expire" | Credits carry a 90 day validity from the date of purchase | "Credits are valid for 90 days from the date of purchase" |
| "Enroll now" or "Join the class" | Nothing is attended or taught; the learner buys study material | "Get access" or "Unlock this level" |

---

## 25A. Never Show Raw Database Values

Database values are for the system, not for customers. Always convert them into clear, translated text.

- **Statuses:** map values such as `Completed`, `Pending`, `Failed` and `Payment Failed` to translated labels. Never output `ucwords($order->status)` directly.
- **Level names:** map `Beginner`, `Intermediate`, `Advanced` and `Expert` to translated labels.
- **Missing data:** never show `N/A`. Use a clear message such as "Level not found" or "This material is no longer available".
- **Dates:** use the language's own format with `translatedFormat()`, and store the format in the lang file.
- **Counts:** use `trans_choice` so singular and plural are correct.

```php
// lang/en/frontend.php
'date_format' => 'd M Y',                      // 23 Jul 2026
'items'       => ':count item|:count items',   // 1 item / 5 items
'statuses'    => ['completed' => 'Completed', 'payment failed' => 'Payment failed'],

// lang/ja/frontend.php
'date_format' => 'Y年n月j日',                   // 2026年7月23日
'items'       => ':count 件',
'statuses'    => ['completed' => '完了', 'payment failed' => 'お支払い失敗'],
```

```blade
@php
    $statusKey = 'frontend.receipt.statuses.' . strtolower(trim($order->status));
    $statusText = Lang::has($statusKey) ? __($statusKey) : ucwords($order->status);
@endphp

{{ $statusText }}
{{ $order->created_at->locale(app()->getLocale())->translatedFormat(__('frontend.receipt.date_format')) }}
{{ trans_choice('frontend.cart.items', $count, ['count' => $count]) }}
```

---

## 25B. No English Left in JavaScript

Text created or changed by JavaScript must be translated like any other text.

- Pass translated strings into scripts with `@json(__('...'))`. Never type English text inside a script.
- This includes loading text ("Loading..."), button labels that change (play/pause, show/hide password), and validation messages.
- Add `novalidate` to every form, so the browser never shows its own English validation messages. Show the translated message from JavaScript instead.

```blade
<form class="topup-form" novalidate>...</form>

<script>
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + @json(__('frontend.topup.loading'));
    btn.setAttribute('aria-label', video.paused ? @json(__('frontend.home.video_play')) : @json(__('frontend.home.video_pause')));
    field.setCustomValidity(@json(__('frontend.topup.amount_req')));
</script>
```

---

## 26. No Repetition

Each page has its own purpose. Do not repeat the same paragraphs across the home page, category pages, material pages, About Us, FAQ, footer and policy pages. A short reference with a link is fine.

---

## 27. Database and Functionality Preservation

This is a content and presentation update. It must not change the database or break the application.

### Never modify

- Tables, columns, types, keys, indexes or relationships
- Existing IDs, records, prices, status values or timestamps
- Category, course, level, user, order or payment data
- Migrations or model relationships

### Never run

- `TRUNCATE`, `DELETE`, `DROP`, `UPDATE` or `INSERT` against existing data as part of a content change
- Seeders that reset or overwrite data
- Database reset or refresh commands

### Preserve

- Routes, controllers, models and services
- Authentication, cart, checkout and payment integrations
- Material delivery and access mechanisms, APIs and JavaScript functionality

### Where changes belong

Content changes happen only in:

- Translation files (including the bracketed dummy company name, email and address)
- Views and components
- Configuration

If a content requirement seems to need a database change, stop, explain which structure would be affected, and ask before changing anything.

---

## 28. Implementation Workflow

1. **Inspect the project:** routes, controllers, models, views, translation files, JavaScript, forms, checkout, authentication and course access.
2. **Read the real data:** categories, courses, levels, prices and company details from the database.
3. **Understand each page's purpose** before writing it.
4. **Write fresh, universal content** following the golden rules in section 2.
5. **Create new translation keys** for all languages.
6. **Update views** to use the new keys.
7. **Set tab titles** to plain page names only.
8. **Localize JavaScript and validation messages.**
9. **Write the Terms & Conditions and all three policy pages** with headings, paragraphs and bullet points, including the delivery and access process in section 15.2 word for word in meaning.
10. **Set the newsletter success message** exactly as defined.
11. **Set the H1 and image ALT text** on each page, and the shared site description once.
12. **Check that every link** points to a real route.
13. **Sweep for old wording.** Search the views, lang files and JavaScript for "course", "class", "lesson", "enroll", "instructor", "attend", "session", and for 講座, 受講, 授業 and 講師 in Japanese. Replace every customer-facing hit with the approved terminology in section 2.7, and leave internal names alone.
13a. **Sweep for durations and permanence claims.** Search the views, lang files, JavaScript and the policy page records for "lifetime", "indefinitely", "unlimited", "forever", "permanent", "2 weeks", "14 day", "14-day", "access period", "access lasts", and for 無期限, 永久, 2週間, 14日 and アクセス期間 in Japanese. Delete every promise of permanence outright. For a hit that names a length of access, remove the length; keep a duration-free phrase such as "the applicable access period" (section 15.2). Check the database-backed policy pages as well as the lang files, since the policy text lives in the `pages` table.
14. **Delete unused translation keys** and confirm they are no longer referenced.

---

## 29. Final QA Checklist

- [ ] Tab titles are plain page names with no website name or extra text, apart from the home page
- [ ] No placeholders or inserted keywords, except `:company`, `:email`, `:address` and `:site`
- [ ] Company name, email and address come only from the `miscs` table, and the website name only from `frontend.head.site`
- [ ] Dummy values are exactly `[Company Name]`, `[Company Email]` and `[Company Address]`, stored only in the lang files
- [ ] No company phone number appears anywhere on the website, in any language
- [ ] The Terms & Conditions starts with the Company Information table (company name, DBA image, email, address) and contains no credit tier table
- [ ] Every form field has a label, placeholder and specific validation messages
- [ ] Server-side and client-side validation messages match and are localized
- [ ] Credits are called "credits" everywhere, with prices and balances from the database
- [ ] Checkout shows the billing descriptor text followed by the DBA image
- [ ] Content is universal and fits any e-learning subject
- [ ] No customer-facing text calls the products "courses" or implies attending, enrolling, classes, lessons, sessions or instructors (section 2.7)
- [ ] The Delivery & Access Policy states the delivery method, the "typically within 24 hours" timing, the "up to 48 to 72 hours" delay and the 72 hour contact point exactly as set out in section 15.2
- [ ] The same delivery and access facts appear, unchanged, in the Terms & Conditions, the Refund Policy, the FAQ, at checkout and in the order confirmation
- [ ] The 90 day credit validity appears in the Terms & Conditions credits section, on the top-up page and in the FAQ
- [ ] The words "lifetime access" and "indefinitely" appear nowhere on the website, in any language
- [ ] No page states how long access lasts, in any unit, in any language, and no page has a section named for an access period
- [ ] Duration-free wording such as "the applicable access period" is left in place where it already appears, with no number attached
- [ ] Every "contact us after X" figure reads 72 hours, including in any "Email Delivery Issues" and "Failure to Receive Access Information" section
- [ ] The Terms & Conditions Credits section ends with the 90 day validity as its last bullet
- [ ] The policy page, its footer link and its tab title all read "Delivery & Access Policy"
- [ ] Terms & Conditions, Privacy, Refund and Delivery & Access pages are descriptive, with headings and bullet points
- [ ] No bullet point ends with a full stop, in any language
- [ ] Newsletter success message is exactly `Thank you for subscribing`
- [ ] Copyright company name comes from the `miscs` table and links to the home page
- [ ] Translation keys are short and simple (`file.key`)
- [ ] No fake promises anywhere
- [ ] Every claim about payments, cart, credits, access and emails matches what the code actually does, and no delivery time or credit validity other than the figures in sections 15.2 and 9A.4 is promised
- [ ] Page validation rules match the server validation rules
- [ ] No raw database values (statuses, level names, `N/A`) are shown; dates and counts are translated
- [ ] No English text inside JavaScript; all forms use `novalidate`
- [ ] Every language is complete
- [ ] No hardcoded customer-facing text in views or JavaScript
- [ ] No unused translation keys
- [ ] No fake claims
- [ ] No broken links
- [ ] All images have ALT text
- [ ] Every page has an H1 and descriptive image ALT text
- [ ] Database structure and data are unchanged
- [ ] Checkout, payments, authentication and material access still work

---

## 30. Final Standard

A visitor should quickly understand:

1. What the platform offers, and that it is self-paced study material rather than a class to attend
2. What subjects and e-learning materials are available
3. How skill levels differ
4. How to choose and buy an e-learning material
5. How purchased materials arrive by email and how long that takes
6. How refunds work
7. How personal information is handled
8. Where to get help

The writing should be **simple enough to understand quickly and detailed enough to answer genuine learner questions**, with the same clear, professional quality on every e-learning website it is used for.
