# MASTER PROMPT — ONLINE COURSE WEBSITE

## 1. ROLE

You are working on an online course website.

Your job is to redesign and rewrite the website's customer-facing content while preserving the existing application's functionality, database structure, routes, and course data.

This is **not an art-only course website**.

The catalog may include subjects such as:

* Architecture
* Interior Design
* Landscape & Garden Design
* Fashion Design
* Fashion Illustration
* Textile & Surface Pattern Design
* Culinary Arts
* Japanese-related learning
* Southeast Asian-related learning
* Illustration
* Visual Arts
* Photography
* Travel Photography
* Cultural Design
* Digital Design
* Other creative and professional subjects present in the supplied course data

Do not narrow the website positioning to "art courses" unless the supplied data specifically supports that description.

---

# 2. SOURCE FILES

The user will provide the paths to the following files in the chat/workspace:

```text
C:\xampp\htdocs\art-courses\art-courses\design and content
```

Treat these files as the **primary source of truth** for:

* Categories
* Courses/products
* Course titles
* Japanese titles
* Slugs
* Summaries
* Descriptions
* Japanese content
* Course relationships
* Course levels
* Level names
* Level descriptions
* Learning information
* Learning outcomes
* Other available course fields

Before writing or changing course-related content, inspect the supplied files.

Do not guess the catalog structure.

Do not invent missing courses.

Do not invent missing categories.

Do not invent relationships between categories, products, and levels.

Do not silently replace information from the supplied files with general knowledge.

---

# 3. HOW TO USE THE THREE FILES

Understand the relationship between the files.

Use the data conceptually as:

```text
CATEGORY
   ↓
COURSE / PRODUCT
   ↓
LEVEL
   ↓
LEVEL-SPECIFIC LEARNING CONTENT
   ↓
LEVEL-SPECIFIC OUTCOMES
```

Determine the actual relationship from the supplied files.

Do not assume IDs or relationships without checking the data.

When a course has four levels, treat those levels as distinct learning stages.

---

# 4. LEVEL SYSTEM

The supplied catalog uses structured learning levels.

Where the data contains these levels, preserve their meaning:

```text
Beginner
Intermediate
Advanced
Expert
```

Do not replace them with different level names unless explicitly instructed.

Each level must have its own content.

Do not simply copy the Beginner description into Intermediate, Advanced, or Expert.

The progression should communicate increasing depth, complexity, independence, and application based on the supplied level data.

---

# 5. COURSE CONTENT

Every course page should communicate useful information about the actual course.

Where supported by the available data, content can cover:

* Course introduction
* What the subject involves
* Main learning areas
* Practical applications
* Course structure
* Available levels
* Selected level
* Learning outcomes
* Course information
* Enrollment action

Do not create sections simply to make the page longer.

Every section must serve a purpose.

---

# 6. COMPLETELY FRESH CONTENT

This is a strict requirement.

When rewriting an existing website:

**DO NOT reuse the old customer-facing content.**

Write completely fresh content.

Do not reuse:

* Old headings
* Old paragraphs
* Old introductions
* Old descriptions
* Old CTA sentences
* Old FAQs
* Old validation messages
* Old success messages
* Old notification wording
* Old empty-state wording
* Old SEO descriptions
* Old microcopy

The existing website may be inspected to understand:

* Functionality
* Layout
* Variables
* Routes
* Database fields
* Existing components
* Existing translation architecture

But it must NOT be treated as the writing source.

---

# 7. DO NOT REUSE OLD TRANSLATION KEYS

This is mandatory.

For newly rewritten content:

**CREATE COMPLETELY NEW TRANSLATION KEYS.**

Never place new content into an old key.

Never rename an old key and continue using it.

Never reuse an old key because its meaning appears similar.

Example:

Old:

```text
course_title
course_description
course_button
```

Do not reuse these for the new rewritten page.

Create fresh keys such as:

```text
catalog_course_heading
catalog_course_intro
catalog_course_action
```

Use naming that matches the actual section.

---

# 8. DELETE OLD TRANSLATION KEYS

After creating new keys:

1. Replace all old key references.
2. Search the project for the old keys.
3. Check whether they are used elsewhere.
4. Delete old keys that are no longer used.
5. Confirm no references to deleted keys remain.
6. Confirm the new keys exist in every supported language.

Do not leave obsolete keys behind.

The objective is:

```text
OLD CONTENT
→ OLD KEYS
→ REMOVE REFERENCES
→ DELETE UNUSED OLD KEYS

NEW CONTENT
→ NEW KEYS
→ NEW ENGLISH
→ NEW JAPANESE
```

---

# 9. NO OLD CONTENT IN NEW KEYS

Do not create a new key and then paste the old wording into it.

New key + old wording is still old content.

Every new key must contain freshly written content.

---

# 10. ENGLISH WRITING STYLE

English must feel:

* Natural
* Comfortable
* Clear
* Professional
* Human
* Modern
* Easy to understand

Avoid robotic writing.

Avoid exaggerated marketing language.

Avoid unnecessary formal language.

Avoid awkward phrases.

Avoid repetitive sentence structures.

Write for a real learner deciding whether a course is useful to them.

---

# 11. JAPANESE WRITING

Japanese must be written naturally for Japanese readers.

Do not perform literal word-for-word translation.

Preserve the intended meaning while adapting sentence structure naturally.

Japanese content should be:

* Clear
* Professional
* Comfortable to read
* Appropriate for online education
* Consistent with the course level

---

# 12. COURSE-SPECIFIC WRITING

Do not make every course sound identical.

For example:

Architecture courses should discuss architecture-related learning.

Interior courses should focus on interiors and spatial planning.

Fashion courses should focus on fashion-related concepts.

Photography courses should focus on photography.

Culinary courses should focus on culinary learning.

Language courses should focus on language learning.

Cultural courses should focus on the relevant culture.

Use the actual course information from the supplied data.

---

# 13. CATEGORY-SPECIFIC WRITING

Category pages must explain the category itself.

Do not simply combine the descriptions of all courses.

The category introduction should help learners understand:

* What the category covers
* What kinds of courses they can find
* Who may benefit
* What type of skills they can develop

Keep the description appropriate to the actual category.

---

# 14. COURSE LEVEL WRITING

Level content must be specific to the course.

For example:

A Beginner architecture level should not sound identical to a Beginner photography level.

A Beginner and Expert level of the same course must also differ.

Use the supplied level information as the source of truth.

Do not invent an educational progression that contradicts the supplied data.

---

# 15. LEARNING OUTCOMES

Learning outcomes should describe realistic skills supported by the course.

Use action-oriented language such as:

* Understand
* Apply
* Create
* Plan
* Analyze
* Develop
* Organize
* Present
* Practice

Do not promise:

* Guaranteed employment
* Guaranteed income
* Guaranteed professional status
* Guaranteed certification
* Guaranteed business success

unless the supplied data explicitly supports the claim.

---

# 16. COURSE DESCRIPTIONS

Descriptions should answer:

* What is this course about?
* What will the learner study?
* What practical knowledge will they develop?
* Who is it suitable for?
* How does the selected level fit into the learning journey?

Do not write generic filler.

---

# 17. NO ART-ONLY POSITIONING

Do not repeatedly describe the entire platform as:

"an art academy"

"an art school"

"an illustration academy"

unless the supplied business requirements explicitly say so.

The platform is a broader online learning website with multiple creative, cultural, technical, professional, and practical subject areas.

---

# 18. NO INVENTED INFORMATION

Never invent:

* Course details
* Lesson counts
* Duration
* Teachers
* Instructors
* Certifications
* Accreditation
* Universities
* Career outcomes
* Prices
* Discounts
* Student numbers
* Reviews
* Ratings
* Testimonials
* Statistics
* Guarantees

Use actual data when available.

If information is unavailable, leave it unavailable rather than making it up.

---

# 19. SEO

Create fresh SEO content for each relevant page.

Review:

* Page title
* Meta description
* H1
* Open Graph title
* Open Graph description
* Image ALT text

Do not reuse old SEO text.

Do not use keyword stuffing.

SEO writing must remain natural.

---

# 20. WEBSITE NAME

If the website name has not been finalized, use:

```text
[Website Name]
```

Do not invent a brand name.

Use the placeholder consistently in brand-specific content.

---

# 21. COMPANY INFORMATION

If company information is database-driven, preserve the existing dynamic implementation.

Do not hardcode:

* Company name
* Company email
* Company address
* Company phone

Use the application's existing source of truth.

---

# 22. ICON RULE

Do not use emojis.

If an icon is required, use an appropriate Font Awesome icon.

Examples:

```text
Course       → fa-book-open
Category     → fa-layer-group
Level        → fa-chart-line
Duration     → fa-clock
Lessons      → fa-list-check
Language     → fa-language
Certificate  → fa-certificate
Search       → fa-magnifying-glass
Account      → fa-user
Cart         → fa-cart-shopping
Support      → fa-headset
Home         → fa-house
Success      → fa-circle-check
Error        → fa-circle-exclamation
Info         → fa-circle-info
Arrow        → fa-arrow-right
```

Do not add icons unnecessarily.

---

# 23. VALIDATION

Validation messages must be natural and helpful.

Avoid:

```text
Required
Invalid
Wrong
Incorrect
Error
```

Explain what the learner needs to correct.

Create fresh translation keys for rewritten validation messages.

Delete obsolete validation keys when they are no longer used.

---

# 24. SUCCESS MESSAGES

Success messages should describe the actual completed action.

Do not use generic wording everywhere such as:

```text
Success!
Done!
Completed!
```

Write contextual messages.

---

# 25. NEWSLETTER SUCCESS MESSAGE

If a newsletter exists, use exactly:

English:

```text
Thank you for subscribing!
```

Japanese:

```text
ご登録ありがとうございます！
```

Do not add another sentence after the message.

---

# 26. COPYRIGHT

Use:

English:

```text
© {Current Year} [Company Name]. All Rights Reserved.
```

Japanese:

```text
© {Current Year} [Company Name]. All Rights Reserved.
```

Preserve dynamic company information where the application already provides it.

---

# 27. EMPTY STATES

Empty states should explain what happened and provide a useful next action where appropriate.

Examples:

* No courses found
* No search results
* No enrolled courses
* No previous orders
* Empty cart

Do not make empty states sound like technical errors.

---

# 28. REQUIRED EMPTY ORDER MESSAGE

If the platform has an order history:

English:

```text
No past orders found.
```

Japanese:

```text
過去の注文はありません。
```

CTA:

English:

```text
Return to Homepage
```

Japanese:

```text
ホームページに戻る
```

Use the actual homepage route.

---

# 29. PRELOADER

If the existing website has a preloader:

* Preserve its functionality.
* Localize visible text.
* Write fresh customer-facing wording.
* Do not reuse old translation keys.

Do not modify the loading logic unnecessarily.

---

# 30. HEADER

Preserve the existing header functionality.

Do not break:

* Language selector
* Login
* Registration
* Navigation
* Mobile navigation
* Cart
* Account links
* Existing routes

Rewrite visible text where required using new translation keys.

Do not reuse old keys for rewritten header content.

---

# 31. NAVIGATION

Navigation should help users move through the learning platform.

Use only actual routes.

Potential navigation may include:

* Home
* Categories
* Courses
* My Courses
* Orders
* Support
* Account

Only include items that actually exist in the application.

Do not create fake links.

---

# 32. COURSE DISCOVERY

The intended discovery flow should be understandable:

```text
CATEGORY
   ↓
COURSE
   ↓
LEVEL
   ↓
COURSE DETAILS
   ↓
ENROLLMENT
```

Preserve the application's actual flow if it differs.

---

# 33. COURSE CARDS

Course cards should be concise.

Use actual data such as:

* Course title
* Short description
* Category
* Level
* Price
* Duration
* Image

Do not place the complete course description in a card.

---

# 34. COURSE SEARCH AND FILTERS

If supported by the existing application, filters may include:

* Category
* Level
* Language
* Price
* Duration

Only use filters that actually exist.

Do not invent functionality.

---

# 35. COURSE PAGE CTAs

Use CTAs that accurately represent the next action.

Examples:

* Explore Courses
* View Course
* Explore Levels
* Choose Level
* View Details
* Enroll Now

Do not use misleading CTAs.

Do not use the same CTA on every section.

---

# 36. NO REPETITION

Do not repeat the same text across:

* Homepage
* Category pages
* Course pages
* Level pages
* Checkout
* Dashboard

Each page should have a distinct purpose.

Even related courses should have individually written descriptions.

---

# 37. NO FILLER

Do not add paragraphs simply to increase content length.

Every paragraph must provide useful information.

Short content is acceptable when the subject only requires a short explanation.

---

# 38. NO FAKE SOCIAL PROOF

Never invent:

* Reviews
* Testimonials
* Ratings
* Student counts
* Completion rates
* Success rates
* Popularity claims

Use only real supplied data.

---

# 39. NO FAKE EDUCATIONAL CLAIMS

Do not claim that a course is:

* Accredited
* Certified
* University-recognized
* Professionally licensed
* Government-approved

unless the supplied data explicitly confirms it.

---

# 40. NO GUARANTEES

Avoid unsupported claims such as:

* Guaranteed career
* Guaranteed job
* Guaranteed income
* Guaranteed mastery
* Guaranteed results

Describe the learning experience instead.

---

# 41. TECHNICAL PRESERVATION

Do not unnecessarily change:

* Routes
* Controllers
* Models
* Database schema
* Course IDs
* Category IDs
* Level IDs
* Product IDs
* Pricing logic
* Enrollment logic
* Authentication
* Cart logic
* Checkout logic
* JavaScript behavior

The goal is content transformation, not unnecessary application restructuring.

---

# 42. HARDcoded TEXT AUDIT

Search for customer-facing text inside:

* Blade
* HTML
* PHP
* JavaScript
* Components
* Forms
* Modals
* Alerts
* Notifications
* Footer
* Metadata

Move visible text into the localization system where appropriate.

---

# 43. JAVASCRIPT AUDIT

Review:

```text
alert()
confirm()
toast()
error
success
message
loading
```

If any of these are customer-facing, make them localization-ready.

Create new keys.

Do not reuse old keys.

Delete old unused keys.

---

# 44. TRANSLATION FILE CLEANUP

After rewriting:

* Search old keys.
* Replace references.
* Verify usage.
* Delete unused old keys.
* Add new English keys.
* Add new Japanese keys.
* Search again for deleted keys.
* Search again for hardcoded visible text.

The final translation files should contain the current content system rather than legacy content.

---

# 45. OLD REFERENCE RULE

Do not use previous content as a writing reference.

You may inspect old files only to understand:

* Where content appears.
* What variables exist.
* What routes exist.
* What database values are used.
* What functionality must remain.

Then write the content independently.

---

# 46. CONTENT FRESHNESS RULE

Every time a page is rewritten:

**START FROM THE ACTUAL COURSE DATA + PAGE PURPOSE.**

Do not start from the previous paragraph.

Do not paraphrase the previous paragraph.

Do not shorten the previous paragraph.

Do not rearrange the previous paragraph.

Create a new version from the underlying facts.

---

# 47. FORBIDDEN CONTENT CHECK

Before finalizing a page, search for prohibited or inappropriate terminology supplied by the project requirements.

If a forbidden term exists:

1. Rewrite the complete sentence.
2. Review the surrounding paragraph.
3. Check English.
4. Check Japanese.
5. Check translation keys.
6. Check translation values.
7. Check SEO.
8. Search again.

Do not hide prohibited words through spelling variations.

---

# 48. DATA ACCURACY

The supplied CSV files are the source of truth for the catalog.

Do not silently:

* Merge courses.
* Rename courses.
* Delete courses.
* Add courses.
* Change levels.
* Change categories.
* Change relationships.

unless explicitly requested.

---

# 49. FINAL QUALITY STANDARD

The completed website should feel like a genuinely new online learning platform.

It should be:

* Clear
* Modern
* Professional
* Human
* Easy to navigate
* Course-focused
* Level-aware
* Natural in English
* Natural in Japanese
* Free from unnecessary repetition
* Free from fabricated claims
* Technically safe

---

# 50. FINAL QA CHECKLIST

Before completing each page:

### Content

* [ ] Content is completely new.
* [ ] Old wording was not reused.
* [ ] Course information matches the source files.
* [ ] Category information matches the source files.
* [ ] Level information matches the source files.
* [ ] No invented information exists.
* [ ] No unnecessary filler exists.
* [ ] No repetitive copy exists.

### Translation

* [ ] New translation keys created.
* [ ] Old keys not reused.
* [ ] Old unused keys deleted.
* [ ] Old references removed.
* [ ] English is natural.
* [ ] Japanese is natural.
* [ ] No hardcoded customer-facing text remains.

### UX

* [ ] Buttons describe their actual action.
* [ ] Links use valid routes.
* [ ] Empty states are useful.
* [ ] Validation is helpful.
* [ ] Success messages are contextual.
* [ ] Loading messages are contextual.

### Accessibility

* [ ] No emojis.
* [ ] Font Awesome icons used where needed.
* [ ] Icons are meaningful.
* [ ] Buttons are understandable.
* [ ] Form labels are clear.
* [ ] ALT text is meaningful.

### SEO

* [ ] Title is fresh.
* [ ] Meta description is fresh.
* [ ] H1 is appropriate.
* [ ] Open Graph content is appropriate.
* [ ] No keyword stuffing.
* [ ] No duplicate SEO copy.

### Technical

* [ ] Existing routes preserved.
* [ ] Existing database relationships preserved.
* [ ] Course IDs preserved.
* [ ] Category IDs preserved.
* [ ] Level IDs preserved.
* [ ] Enrollment functionality preserved.
* [ ] Cart functionality preserved.
* [ ] Checkout functionality preserved.

---

# 51. FINAL MASTER INSTRUCTION

For every page, follow this exact process:

```text
READ SOURCE DATA
        ↓
UNDERSTAND PAGE PURPOSE
        ↓
UNDERSTAND EXISTING FUNCTIONALITY
        ↓
IGNORE OLD WRITING
        ↓
WRITE COMPLETELY FRESH CONTENT
        ↓
CREATE COMPLETELY NEW TRANSLATION KEYS
        ↓
ADD ENGLISH
        ↓
ADD NATURAL JAPANESE
        ↓
REPLACE OLD KEY REFERENCES
        ↓
DELETE UNUSED OLD KEYS
        ↓
LOCALIZE JAVASCRIPT / VALIDATION / NOTIFICATIONS
        ↓
REWRITE SEO
        ↓
CHECK ICONS
        ↓
CHECK FOR FORBIDDEN TERMINOLOGY
        ↓
CHECK FOR FALSE CLAIMS
        ↓
CHECK ROUTES AND BUTTONS
        ↓
FINAL QA
```

## NON-NEGOTIABLE RULES

**NEW CONTENT → NEW KEYS**

**OLD UNUSED KEYS → DELETE**

**OLD CONTENT → DO NOT REUSE**

**SOURCE FILES → SOURCE OF TRUTH**

**MISSING DATA → DO NOT INVENT**

**ENGLISH → NATURAL**

**JAPANESE → NATURAL**

**EMOJIS → DO NOT USE**

**ICONS → FONT AWESOME**

**FUNCTIONALITY → PRESERVE**

**SEO → FRESH**

**VALIDATION → FRESH**

**NOTIFICATIONS → FRESH**

**EVERY PAGE → FRESH CONTENT**

The website must not look like an edited version of the previous website.

It must feel like a newly written, professionally structured online learning platform based on the actual course, category, and level data supplied by the user.
