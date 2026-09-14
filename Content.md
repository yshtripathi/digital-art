# E-Learning Website — Universal Content & Implementation Guide

This guide works for any e-learning website, whatever it teaches: art, music, languages, coding, business, finance, wellness, exam preparation or anything else. Nothing in it depends on one brand, one subject or one catalogue.

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
- Subject-specific wording belongs only in the category and course records that come from the database.

### 2.2 No placeholders or inserted keywords

- Never write placeholder tokens inside sentences, such as `{keyword}`, `[subject]`, `XXX`, `{platform}` or `your-topic-here`.
- Never write a sentence that expects someone to fill in a word later.
- Every sentence must read as finished, natural text.
- The **only** exception is the company name, email, address and phone (see 2.3).

### 2.3 The only dynamic values: company name, email, address and phone

A placeholder is integrated into a sentence **only** where the company name, email, address or phone appears. Nothing else may be inserted.

| Value | Placeholder in lang files | Real source | Dummy fallback |
|---|---|---|---|
| Company name | `:company` | `miscs` table in the database | `[Company Name]` |
| Company email | `:email` | `miscs` table in the database | `[Company Email]` |
| Company address | `:address` | `miscs` table in the database | `[Company Address]` |
| Company phone | `:phone` | `miscs` table in the database | `[Company Phone]` |

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
    'phone'   => '[Company Phone]',
];
```

The dummy values are exactly `[Company Name]`, `[Company Email]`, `[Company Address]` and `[Company Phone]`, in square brackets, so a missing database value is obvious at a glance. Use the same bracketed values in every language file.

Usage in a view:

```blade
{{ __('frontend.contact.intro', ['email' => $misc['Company Email'] ?? __('frontend.company.email')]) }}
```

Rules:

- Never hardcode the real company name, email, address or phone in views, lang files or copy.
- Dummy values exist only in the lang files, in the bracketed form above, and only as a fallback.
- The `[subject]`-style brackets banned in 2.2 are allowed only for these four dummy values.
- Use the real `miscs` column names that exist in the project.
- Show these details only where they are genuinely needed, such as the contact page, footer, copyright line, checkout billing notice and the contact section of policy pages.

Other data such as course titles, category names, prices, levels, order details and user details also comes from the database. It is displayed as data, not written into content.

### 2.4 Simple browser tab names

The browser tab title (`<title>`) is only the plain page name.

- No website name
- No separators such as `|`, `-` or `:`
- No taglines, keywords or extra words

| Page | Tab title |
|---|---|
| Home | Home |
| About page | About Us |
| Contact page | Contact Us |
| Course listing | Courses |
| Category page | The category name from the database |
| Course detail | The course title from the database |
| Cart | Cart |
| Checkout | Checkout |
| Login | Login |
| Register | Register |
| Forgot password | Forgot Password |
| Reset password | Reset Password |
| Dashboard | Dashboard |
| My courses | My Courses |
| Orders | Orders |
| Order details | Order Details |
| Profile | Profile |
| FAQ | FAQ |
| Terms & Conditions | Terms & Conditions |
| Privacy Policy | Privacy Policy |
| Refund Policy | Refund Policy |
| Delivery & Course Access Policy | Delivery & Course Access Policy |
| Page not found | Page Not Found |

Meta descriptions, Open Graph and Twitter tags are separate from the tab title (see section 17).

### 2.5 Descriptive, structured writing everywhere

All content, and especially the Terms & Conditions and the policy pages, must be:

- Descriptive enough to answer real learner questions
- Organised under clear headings
- Broken into short paragraphs
- Supported by bullet points wherever several items, steps or conditions are listed

Do not turn a whole page into one long paragraph, and do not reduce a whole page to bare bullet points. Use a short introductory paragraph under each heading, then bullets for the details.

### 2.6 Footer newsletter success message

The success message must be exactly:

| Language | Message |
|---|---|
| English | `Thank you for subscribing` |
| Japanese | `ご登録ありがとうございます` |

- Do not add any other sentence before or after it.
- Do not change the wording.

---

## 3. Source of Truth

The existing database is the source of truth for:

- Categories, category names and slugs
- Courses, course names and slugs
- Skill levels and their relationships
- Prices
- Status values
- Images linked to categories and courses
- Company name, email, address and phone

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
- The only text that may stay the same in every language is data from the database (course titles, category names, company name, email, address and phone) , the language names themselves in the language switcher (`English`, `日本語`), and the country names in the checkout country dropdown (see section 19.13).

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
        'phone'   => '[Company Phone]',
    ],

    // resources/views/frontend/layouts/footer.blade.php
    'footer' => [
        'news_title'   => 'Stay up to date with new courses',
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
- How courses and skill levels are organised
- How to find a suitable course
- How buying and accessing a course works
- A clear call to action

### Hero section

- One clear headline
- One supporting paragraph
- One primary button, with an optional secondary button
- Button text describes the real action, for example **Explore Courses**, **Browse Categories** or **Find a Course**

### Category section

- Category name and image from the database
- A short line of supporting text that works for any subject
- Course count only when calculated from real data
- A link to the real category route

### How it works section

Use simple numbered steps:

1. **Choose a category.** Browse the available subject areas.
2. **Pick a course.** Compare courses and read what each one covers.
3. **Select a level.** Choose the level that matches your current knowledge.
4. **Review the details.** Check the description, what is included and the price.
5. **Complete checkout.** Pay securely using the available payment options.
6. **Start learning.** Open your purchased course from your account.

Only describe access methods the application really provides.

---

## 7. Category Page

- **Header:** category name (from the database) and a short, universal introduction.
- **Course list:** course cards with title, short description, available levels, image, price where shown, and a button.
- **Empty state:** if a category has no courses, explain that and link to all courses.

---

## 8. Course Page

Recommended sections:

1. Course introduction
2. What the course covers
3. Available skill levels
4. What to expect at each level
5. Learning outcomes
6. Course information (price, level, format as provided by the system)
7. Related courses
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

Never promise certificates, accreditation, jobs or guaranteed results unless the application actually provides them.

---

## 9A. Credits System

The website uses credits. Learners buy credits with money, then spend credits to unlock courses and levels. All content must explain this clearly and consistently.

### 9A.1 How credits work

Explain in simple steps:

1. **Buy credits.** Choose a credit package on the top-up page and pay at checkout.
2. **Credits are added to your account.** Your balance appears in your account once payment is confirmed.
3. **Unlock a course level.** Each course level shows its price in credits. Spend credits to unlock it.
4. **Start learning.** Unlocked levels appear in your account.

### 9A.2 Wording rules

- Use one term everywhere: **credits**. Do not mix "credits", "points", "coins" and "tokens" in customer-facing text, even if the code uses a different name internally.
- Show credit prices and balances from the database only. Never write fixed numbers into content.
- Always make it clear that money buys credits, and credits unlock courses.
- Show the learner's current balance wherever credits are spent (course page, cart, checkout, dashboard).

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

### 9A.4 No fake promises about credits

Do not claim any of the following unless the business rules define it:

- Credits never expire, or credits expire after a set time
- Credits can be refunded, transferred or exchanged for cash
- Bonus or free credits
- Discounts for larger packages

If a rule is not defined, do not mention it.

### 9A.5 Credits in policies and FAQ

- **Terms & Conditions:** a "Credits" section explaining how credits are bought, used, and that they have no cash value outside the website (only if true for the business).
- **Refund Policy:** explain how refund requests for credit purchases are handled, including what happens to credits already spent.
- **Delivery & Course Access Policy:** explain that credits are added to the account after payment is confirmed, and courses unlock after credits are spent.
- **FAQ:** What are credits? How do I buy credits? How do I use credits? Where can I see my balance? What if my credits do not appear?

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
- Common reasons to get in touch, as bullet points (course questions, purchase or payment help, account access, refund requests, general feedback)
- Company email, address and phone from the `miscs` table
- A contact form with helpful field labels and hints
- A localized success message, error message and validation messages

---

## 12. Terms & Conditions

Must be descriptive, with a heading for each section, a short introductory paragraph, and bullet points for details. Show a "Last updated" date.

### 12.1 Introduction

- What the website provides: online courses and learning materials.
- That using the website means accepting these terms.

### 12.2 Eligibility and Accounts

- Users must provide accurate and up-to-date information.
- Users are responsible for keeping login details secure.
- Accounts are personal and must not be shared or sold.
- Users must tell the company if they suspect unauthorized access.

### 12.3 Courses and Pricing

- Course details and prices are shown on the website before purchase.
- Prices and course information may be updated from time to time.
- The price shown at checkout is the price that applies to that order.

### 12.4 Purchases and Payment

- How a purchase is completed through checkout.
- Payment is handled through the payment methods the website actually offers.
- An order is confirmed only after successful payment.

### 12.5 Course Access

- Access is provided through the learner's account after successful payment.
- Only describe the access method, duration and format the system actually supports.

### 12.6 Intellectual Property

- Course materials, videos, text, graphics and branding belong to the company or their rightful owners.
- Learners receive a personal, non-transferable right to use purchased materials for their own learning.

### 12.7 Acceptable Use

Users agree to:

- Use the website and materials lawfully and respectfully
- Use purchased content for personal learning only
- Follow any instructions provided with the courses

### 12.8 Prohibited Activities

Users must not:

- Copy, download (unless allowed), share, resell or redistribute course content
- Share account access with others
- Try to bypass payment or access controls
- Interfere with the website's security or operation
- Make fraudulent purchases or chargebacks

### 12.9 Refunds

- A short summary with a link to the Refund Policy.

### 12.10 Changes to the Website and Terms

- Features, content and course information may be updated.
- The terms may change, and the "Last updated" date will reflect this.

### 12.11 Disclaimer

- Courses are for educational purposes.
- No guarantee of specific personal, professional, academic or financial results.

### 12.12 Limitation of Liability

- General, careful wording limiting liability to the extent permitted by law.
- No invented legal claims.

### 12.13 Suspension and Termination

- Accounts that break these terms may be suspended or closed.

### 12.14 Governing Law

- Use the jurisdiction only if it exists in the project. Otherwise use neutral wording and do not invent one.

### 12.15 Contact

- Company name, email, address and phone from the `miscs` table.

---

## 13. Privacy Policy

Descriptive, with headings, short paragraphs and bullet points. Show a "Last updated" date.

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
- Processing orders and providing course access
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

- Updates are shown with a new "Last updated" date.

### 13.11 Contact

- Company name, email, address and phone from the `miscs` table.

---

## 14. Refund Policy

Descriptive, with headings, short paragraphs and bullet points. Show a "Last updated" date.

### 14.1 Overview

- The policy covers digital course purchases.

### 14.2 Eligibility

- Explain when a refund may be considered, for example duplicate payments, technical problems that stop access, or a course not matching its description.
- Do not invent a refund period such as 7, 14 or 30 days unless the business has defined one.
- Do not promise a guaranteed refund.

### 14.3 Non-Refundable Situations

For example:

- Courses that have been substantially accessed or completed
- Requests based on a change of mind after access (unless business rules allow it)
- Accounts suspended for breaking the Terms & Conditions

### 14.4 How to Request a Refund

1. Contact support using the company email from the database.
2. Include the order number, the email used for the purchase and the reason for the request.
3. Wait for the request to be reviewed.

Do not mention a dashboard refund button unless one exists.

### 14.5 Review and Processing

- Every request is reviewed individually.
- Approved refunds go back to the original payment method.
- Processing time depends on the payment provider or bank.

### 14.6 Contact

- Company name, email, address and phone from the `miscs` table.

---

## 15. Delivery & Course Access Policy

Descriptive, with headings, short paragraphs and bullet points. Show a "Last updated" date.

### 15.1 Digital Delivery

- All courses are digital. Nothing is shipped physically.

### 15.2 When Access Is Provided

- Access is provided after payment is successfully confirmed.
- Do not promise a specific delivery time unless the system defines one.

### 15.3 Where to Find Your Courses

- Explain the real location, for example the account dashboard or "My Courses" page.

### 15.4 Access Requirements

- A registered account
- A stable internet connection
- A supported, up-to-date browser or device

### 15.5 If Access Does Not Appear

1. Check the payment was completed.
2. Log out and log back in.
3. Check the email used for the purchase.
4. Contact support with the order number if the problem continues.

### 15.6 Access Duration

- Describe only what the system supports. Do not claim lifetime, offline or downloadable access unless it exists.

### 15.7 Contact

- Company name, email, address and phone from the `miscs` table.

---

## 16. FAQ Page

Group questions under headings. Answers must match how the website really works.

- **Getting started:** What is this platform? Who are the courses for? Do I need an account?
- **Courses and levels:** How are courses organised? How do I choose the right level? Can I buy more than one level?
- **Payments:** How do I buy a course? Which payment methods are accepted? Is payment secure?
- **Access:** How do I access my course? What if my course does not appear?
- **Refunds and support:** How do refunds work? How do I contact support?
- **Account and privacy:** How do I reset my password? How is my information handled?

Keep answers short and link to the full policy page where relevant. Do not copy policy text word for word.

---

## 17. SEO

Every major page has its own:

- Meta description
- H1
- Open Graph title and description
- Twitter title and description
- Descriptive image ALT text

Rules:

- The tab title follows section 2.4 (plain page name only).
- Descriptions are universal, specific to the page, and never copied between pages.
- No keyword stuffing and no unsupported claims.

---

## 18. Footer

Suggested groups (only link routes that actually exist):

- **Learning:** All Courses, Categories
- **Company:** About Us, Contact Us, FAQ
- **Policies:** Terms & Conditions, Privacy Policy, Refund Policy, Delivery & Course Access Policy
- **Account:** Login, Register, Dashboard

Also include:

- Company email, address and phone from the `miscs` table
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

- Newsletter: a short label, a clear title and a description explaining what subscribers receive.
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
| Course search | Search courses |
| Category filter | Choose a category |
| Level filter | Choose a level |
| Sort | Sort by |

| Situation | Message |
|---|---|
| Search empty | Please enter a word to search. |
| No results | No courses match your search. Try different words or browse all courses. |

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

### 19.12 Unlocking a Course Level

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

### 19.14 Course Reviews (if supported)

| Field | Placeholder |
|---|---|
| Rating | Choose a rating |
| Review | Share your experience with this course |

| Situation | Message |
|---|---|
| Rating not chosen | Please choose a rating. |
| Review empty | Please write your review. |
| Not purchased | You can review this course after unlocking it. |
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
- Course access and account actions
- Profile updates
- AJAX responses, JavaScript alerts, modals and toast notifications

Messages should say clearly what happened and, for errors, what to do next.

---

## 21. Empty States

Explain what happened and offer a helpful next step.

- **No courses found:** "No courses match your search right now." with a button to view all courses.
- **No purchases yet:** "You have not purchased any courses yet." with a button to browse courses.
- **No orders:** "You have no orders to show." with a button to explore courses.

Never use messages such as `No data`.

---

## 22. Breadcrumbs, Search and Filters

- Breadcrumbs follow the real hierarchy, for example: Home → Category → Course → Level.
- Breadcrumb labels are translated. Category and course names come from the database.
- Search uses the real catalogue only. Placeholder, result and no-result messages are localized.
- Filters only use dimensions the backend supports, such as category and level.

---

## 23. Icons and Images

- Use Font Awesome icons that clearly relate to the content (envelope for contact, book for learning, shield for privacy, and so on).
- Do not use emoji as icons.
- Use category and course images from the database.
- ALT text must be descriptive, localized where supported, and free of keyword stuffing.

---

## 24. Responsive Content

- Headings stay short enough not to break layouts on mobile.
- Button text stays concise.
- Cards remain readable on small screens.
- Bullet lists stay easy to scan.

---

## 25. No False Claims or Fake Promises

Only promise what the website really does. Avoid phrases such as "instant access", "lifetime access", "guaranteed results", "certified", "job-ready", "learn in 7 days", "100% satisfaction" or "the best platform" unless the application or business actually supports them.

Never invent:

- Learner counts, reviews, ratings or testimonials
- Instructor names or credentials
- Certificates, accreditation, partnerships or awards
- Success, employment or income results
- Guaranteed refunds or guaranteed access periods
- Company registration numbers, legal entity names or jurisdictions

If the data does not support a claim, do not write it.

### 25.1 Check the code before writing a claim

Before describing what happens on the website (payments, cart, credits, access, emails, refunds, limits), read the controller or view that does it. Write only what the code really does.

Real mistakes this rule prevents:

| Wrong claim | What the code actually does | Correct wording |
|---|---|---|
| "Your cart has been kept" after a failed payment | Cart items are attached to the order before payment, so the cart is empty | "No credits were added. Please try buying your credits again." |
| Payment method "Card" on every receipt | Orders unlocked with credits have no card payment | Show "Credits" for credit orders and "Card" for card payments |
| "Free" on courses with no levels | No levels means nothing can be unlocked yet, not that it is free | "Levels coming soon" |
| "24/7 access" | Nothing in the system guarantees round-the-clock access | "Online · Self-paced learning" |
| "Popular Courses" | There is no popularity data | "Featured Courses" |

---

## 25A. Never Show Raw Database Values

Database values are for the system, not for customers. Always convert them into clear, translated text.

- **Statuses:** map values such as `Completed`, `Pending`, `Failed` and `Payment Failed` to translated labels. Never output `ucwords($order->status)` directly.
- **Level names:** map `Beginner`, `Intermediate`, `Advanced` and `Expert` to translated labels.
- **Missing data:** never show `N/A`. Use a clear message such as "Level not found" or "Course no longer available".
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

Each page has its own purpose. Do not repeat the same paragraphs across the home page, category pages, course pages, About Us, FAQ, footer and policy pages. A short reference with a link is fine.

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
- Course access mechanisms, APIs and JavaScript functionality

### Where changes belong

Content changes happen only in:

- Translation files (including the bracketed dummy company name, email, address and phone)
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
9. **Write the Terms & Conditions and all three policy pages** with headings, paragraphs and bullet points.
10. **Set the newsletter success message** exactly as defined.
11. **Write SEO metadata** for each page.
12. **Check that every link** points to a real route.
13. **Delete unused translation keys** and confirm they are no longer referenced.

---

## 29. Final QA Checklist

- [ ] Tab titles are plain page names with no website name or extra text
- [ ] No placeholders or inserted keywords, except `:company`, `:email`, `:address` and `:phone`
- [ ] Company name, email, address and phone come only from the `miscs` table
- [ ] Dummy values are exactly `[Company Name]`, `[Company Email]`, `[Company Address]` and `[Company Phone]`, stored only in the lang files
- [ ] Every form field has a label, placeholder and specific validation messages
- [ ] Server-side and client-side validation messages match and are localized
- [ ] Credits are called "credits" everywhere, with prices and balances from the database
- [ ] Checkout shows the billing descriptor text followed by the DBA image
- [ ] Content is universal and fits any e-learning subject
- [ ] Terms & Conditions, Privacy, Refund and Delivery pages are descriptive, with headings and bullet points
- [ ] Newsletter success message is exactly `Thank you for subscribing`
- [ ] Copyright company name comes from the `miscs` table and links to the home page
- [ ] Translation keys are short and simple (`file.key`)
- [ ] No fake promises anywhere
- [ ] Every claim about payments, cart, credits, access and emails matches what the code actually does
- [ ] Page validation rules match the server validation rules
- [ ] No raw database values (statuses, level names, `N/A`) are shown; dates and counts are translated
- [ ] No English text inside JavaScript; all forms use `novalidate`
- [ ] Every language is complete
- [ ] No hardcoded customer-facing text in views or JavaScript
- [ ] No unused translation keys
- [ ] No fake claims
- [ ] No broken links
- [ ] All images have ALT text
- [ ] Every page has SEO metadata
- [ ] Database structure and data are unchanged
- [ ] Checkout, payments, authentication and course access still work

---

## 30. Final Standard

A visitor should quickly understand:

1. What the platform offers
2. What subjects and courses are available
3. How skill levels differ
4. How to choose and buy a course
5. How to access purchased courses
6. How refunds work
7. How personal information is handled
8. Where to get help

The writing should be **simple enough to understand quickly and detailed enough to answer genuine learner questions**, with the same clear, professional quality on every e-learning website it is used for.
