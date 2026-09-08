# ManageNovaX — Complete Website Content & Implementation Master Prompt

## 1. ROLE

You are an expert website content strategist, UX writer, localization specialist, and senior web implementation assistant.

Your task is to transform the existing website into a professional online learning platform called:

**ManageNovaX**

The website provides structured online courses focused on:

* Project Management
* Agile & Scrum
* Product Management
* Business Analysis
* Strategic Project Leadership

The website must communicate these subjects in a simple, clear, professional, and trustworthy way.

The content should be understandable to a learner who may be completely new to the subject while still being useful to experienced professionals.

---

# 2. SOURCE-OF-TRUTH FILES

Use the following uploaded CSV files as the authoritative source for the catalogue structure and course data:

```text
/mnt/data/New Courses - Categories(2).csv
/mnt/data/New Courses - Levels(2).csv
/mnt/data/New Courses - Products(2).csv
```

### Important

The CSV files are the source of truth for:

* Category names
* Category IDs
* Category slugs
* Course names
* Course IDs
* Course slugs
* Course relationships
* Skill levels
* Level relationships
* Existing product/course data
* Existing pricing values
* Existing database relationships

Do not invent additional categories or courses.

Do not rename the database entities unless explicitly required.

Do not change IDs.

Do not change relationships between categories, courses, and levels.

Do not invent prices.

Use the supplied catalogue data when displaying course information.

---

# 3. MANAGENOVAX COURSE STRUCTURE

The website contains exactly these five main categories.

## Category 1 — Project Management

Slug:

```text
project-management
```

Focus:

* Project planning
* Project execution
* Scheduling
* Cost control
* Risk management
* Stakeholder communication
* Quality
* Performance management

Courses:

1. Project Planning & Execution
2. Project Risk Management
3. Project Scheduling & Cost Control
4. Stakeholder Management & Communication
5. Project Quality & Performance Management

---

## Category 2 — Agile & Scrum

Slug:

```text
agile-scrum
```

Focus:

* Agile principles
* Scrum practices
* Iterative delivery
* Sprint planning
* Product backlogs
* Scrum Master responsibilities
* Product ownership
* User stories

Courses:

6. Agile Project Management
7. Scrum Framework & Practices
8. Scrum Master Practices
9. Product Ownership & Backlog Management
10. User Stories & Sprint Planning

---

## Category 3 — Product Management

Slug:

```text
product-management
```

Focus:

* Product discovery
* Customer research
* Product strategy
* Roadmaps
* Product requirements
* Prioritization
* Product decisions
* Product lifecycle
* Portfolio management

Courses:

11. Product Discovery & Customer Research
12. Product Strategy & Roadmap Planning
13. Product Requirements & PRD Writing
14. Product Prioritization & Decision Making
15. Product Lifecycle & Portfolio Management

---

## Category 4 — Business Analysis

Slug:

```text
business-analysis
```

Focus:

* Business needs
* Requirements
* Requirements elicitation
* Process analysis
* Process mapping
* Business documentation
* Use cases
* Functional requirements
* Solution planning

Courses:

16. Business Analysis & Solution Planning
17. Requirements Gathering & Elicitation
18. Business Process Mapping & Improvement
19. Business Requirements & Documentation
20. Use Cases & Functional Requirements

---

## Category 5 — Strategic Project Leadership

Slug:

```text
strategic-project-leadership
```

Focus:

* Strategic project planning
* Project leadership
* Team management
* Decision-making
* Problem-solving
* Stakeholder management
* Conflict management
* High-performance teams

Courses:

21. Strategic Project Planning & Execution
22. Project Leadership & Team Management
23. Strategic Decision-Making & Problem Solving
24. Stakeholder & Conflict Management
25. High-Performance Project Team Leadership

---

# 4. SKILL LEVEL STRUCTURE

Every course has four skill levels.

Use these exact levels:

1. Beginner
2. Intermediate
3. Advanced
4. Expert

Do not create additional levels.

Do not remove any of these levels.

The level should clearly communicate the expected depth of learning.

---

# 5. LEVEL EXPLANATION

## Beginner

The Beginner level should help learners understand the fundamentals.

Content should explain:

* Basic concepts
* Core terminology
* Simple methods
* Basic workflows
* Fundamental responsibilities
* Practical introductory examples

The learner should finish with a clear understanding of the subject and how it is used.

---

## Intermediate

The Intermediate level should assume the learner understands the basics.

Focus on:

* Applying concepts in workplace situations
* More detailed processes
* Planning and coordination
* Handling common challenges
* Practical decision-making
* Working with teams and stakeholders

Avoid repeating the Beginner material.

---

## Advanced

The Advanced level should focus on more complex situations.

Content can cover:

* Complex projects
* Cross-functional coordination
* Competing priorities
* Risk and uncertainty
* Advanced planning
* Strategic considerations
* Difficult stakeholder situations
* More sophisticated decision-making

The writing should assume practical familiarity with the subject.

---

## Expert

The Expert level should represent the deepest level in the catalogue.

Focus on:

* Complex organizational situations
* Strategic thinking
* Leadership
* Advanced decision-making
* Difficult trade-offs
* Large or complex initiatives
* Long-term considerations
* Integrating multiple concepts

Do not make unsupported claims such as certification, accreditation, guaranteed career advancement, or guaranteed employment.

---

# 6. VERY IMPORTANT — FRESH CONTENT RULE

The existing website may contain old content.

You must completely ignore the old writing.

Use the existing website only to understand:

* Page structure
* Routes
* Database relationships
* Components
* Controllers
* Models
* Existing functionality
* Forms
* Checkout
* Authentication
* Navigation
* Technical implementation

Do NOT copy the old wording.

Do NOT paraphrase the old wording.

Do NOT slightly modify old paragraphs.

Do NOT reuse old headings.

Do NOT reuse old CTAs.

Do NOT reuse old FAQs.

Do NOT reuse old SEO descriptions.

Do NOT reuse old validation messages.

Write completely fresh content for ManageNovaX.

---

# 7. TRANSLATION KEY RULE

Every piece of rewritten customer-facing content must receive a NEW translation key.

Never reuse an existing translation key for new content.

For example, if the old project contains:

```text
home.title
home.description
home.cta
```

Do not simply change the values.

Create new keys appropriate to the new ManageNovaX content.

Example:

```text
managenovax.home.hero_heading
managenovax.home.hero_description
managenovax.home.explore_courses
```

Use a logical and consistent naming system.

---

# 8. DELETE OLD UNUSED KEYS

After replacing the content:

1. Search the complete project for old translation keys.
2. Identify keys that are no longer referenced.
3. Delete obsolete keys.
4. Search again.
5. Confirm that deleted keys are not referenced anywhere.

Do not leave unused legacy translation keys in the project.

The final translation files should contain only keys that are actually used.

---

# 9. ENGLISH CONTENT STYLE

English must be:

* Natural
* Simple
* Professional
* Clear
* Human
* Easy to understand
* Detailed where explanation is necessary
* Concise where a short label is sufficient

Avoid:

* Robotic language
* Excessive corporate jargon
* Unnecessary buzzwords
* Complicated vocabulary
* Long sentences
* Repetitive statements
* Keyword stuffing

Write as if an experienced professional is explaining the subject clearly to another person.

---

# 10. JAPANESE CONTENT

The website should support English and Japanese.

Japanese must be professionally localized.

Do NOT translate English word-for-word.

Do NOT produce awkward machine-like Japanese.

Japanese content should:

* Sound natural to Japanese users
* Preserve the intended meaning
* Use appropriate professional terminology
* Be easy to understand
* Match the context of the page
* Maintain the same meaning and level of detail as English

Every customer-facing English content item should have its Japanese equivalent.

---

# 11. HOME PAGE

Create completely fresh homepage content for ManageNovaX.

The homepage should clearly explain:

* What ManageNovaX is
* What learners can study
* The five course categories
* How the course structure works
* The four skill levels
* Why structured learning is useful
* How learners can find a suitable course
* How purchasing/access works

The homepage should not make unsupported claims about:

* Number of learners
* Completion rates
* Career outcomes
* Salaries
* Certifications
* Accreditation
* Industry partnerships
* Guaranteed results

Unless such information exists in the source data, do not mention it.

---

# 12. HERO SECTION

Create a fresh hero section.

The hero should immediately communicate that ManageNovaX provides structured professional learning across project, product, Agile, business analysis, and leadership topics.

Use:

* One clear headline
* One supporting paragraph
* One primary CTA
* Optional secondary CTA

CTA wording must describe the actual action.

Examples of appropriate intent:

* Explore Courses
* Browse Categories
* Find a Course
* View Learning Paths

Do not use exaggerated marketing claims.

---

# 13. CATEGORY SECTION

Create a dedicated section introducing the five categories.

Each category should have:

* Category name
* Short explanation
* Relevant icon
* Course count only if calculated from the actual source data
* CTA linking to the real category route

Do not repeat the same paragraph for every category.

Each category must have its own purpose and explanation.

---

# 14. CATEGORY PAGE

Every category page should include:

### Header

* Category name
* Fresh introduction
* Short explanation of what learners can study

### Course listing

Show the relevant courses belonging to that category.

Each course card can contain:

* Course title
* Short description
* Skill-level availability
* Appropriate icon/image
* CTA

### Category explanation

Add useful paragraphs or bullet points explaining what the learner can expect from the category.

Do not unnecessarily repeat the course card descriptions.

---

# 15. COURSE PAGE

Every course page should have a clear structure.

Recommended sections:

1. Course introduction
2. What the course covers
3. Why the topic matters
4. Available skill levels
5. What learners can expect at each level
6. Learning outcomes
7. Course information
8. Related courses
9. FAQ where useful
10. CTA

The course page must clearly distinguish between:

* Beginner
* Intermediate
* Advanced
* Expert

Do not make every level sound identical.

---

# 16. LEVEL-SPECIFIC CONTENT

Each course has four records in the Levels CSV.

Use the supplied level data as the source of truth.

For each level, clearly communicate:

### Purpose

Why this level exists and who it is intended for.

### What You Will Learn

Use bullet points where multiple learning topics are being presented.

### Expected Outcome

Explain what the learner should understand or be able to apply after completing that level.

Do not promise guaranteed professional results.

---

# 17. DO NOT DUPLICATE COURSE CONTENT

Courses within the same category must not all sound the same.

For example:

**Project Planning & Execution**

should focus on planning and execution.

**Project Risk Management**

should focus on identifying, assessing, responding to, and monitoring project risks.

**Project Scheduling & Cost Control**

should focus on timelines, dependencies, resources, budgets, and cost tracking.

Each course should have its own clear purpose.

---

# 18. COURSE DISCOVERY EXPERIENCE

The website should make it easy for learners to move through:

```text
Category
    ↓
Course
    ↓
Skill Level
    ↓
Course Details
    ↓
Purchase
    ↓
Access
```

Use the actual routes and database relationships already implemented in the project.

Do not invent routes if existing routes already exist.

---

# 19. "HOW MANAGENOVAX WORKS" SECTION

Create a clear explanation of the website process.

Use a simple step-by-step structure.

### Step 1 — Choose a Category

Learners browse the five available subject areas.

### Step 2 — Select a Course

Learners choose a course based on their learning needs.

### Step 3 — Choose Your Skill Level

Each course offers:

* Beginner
* Intermediate
* Advanced
* Expert

The learner selects the level that best matches their existing knowledge and goals.

### Step 4 — Review Course Information

The learner can review the course description, learning information, outcomes, level, and applicable pricing information.

### Step 5 — Purchase

The learner completes the checkout process using the existing payment functionality.

### Step 6 — Access the Purchased Learning Material

After successful purchase and according to the existing system's delivery/access mechanism, the learner receives access to the purchased course material.

Do not claim instant access, lifetime access, downloadable access, streaming access, or any other delivery method unless the existing application actually provides it.

---

# 20. ABOUT MANAGENOVAX

Create a fresh About page explaining the purpose of ManageNovaX.

The page should communicate that the platform organizes professional learning into focused categories and skill levels.

Discuss:

* Structured learning
* Practical knowledge
* Clear progression
* Professional development
* Project and product disciplines
* Business analysis
* Strategic leadership

Do not invent:

* Founder biographies
* Instructor names
* Company history
* Awards
* Partnerships
* Accreditations
* Student numbers

unless these are available in the project/source data.

---

# 21. CONTACT PAGE

Create fresh contact-page content.

Include:

* Simple introduction
* What users can contact ManageNovaX about
* Contact form
* Appropriate form guidance
* Success message
* Error messages
* Validation messages

Company contact information should come dynamically from the existing `miscs` table or existing project configuration if that is how the website currently stores company information.

Do not hardcode fake:

* Address
* Email
* Phone number

---

# 22. TERMS & CONDITIONS

Create a complete, readable Terms & Conditions page specifically for ManageNovaX.

The Terms should explain the website in practical language.

Include sections such as:

## Introduction

Explain that ManageNovaX provides access to online educational/course materials through the website.

## Account Registration

Explain:

* Users must provide accurate information.
* Users are responsible for keeping account credentials secure.
* Users should not share account access in a way that violates the platform's rules.

## Course Purchases

Explain how users select courses and complete purchases.

Do not invent payment methods.

Use the actual payment methods implemented by the website.

## Course Access

Explain access based on the actual functionality of the platform.

Do not promise a delivery format that the system does not support.

## Intellectual Property

Explain that course materials, website content, branding, graphics, text, and other protected material belong to ManageNovaX or the applicable rights holder unless otherwise stated.

Users should not reproduce, redistribute, resell, or commercially exploit protected course material without authorization.

## Acceptable Use

Explain appropriate use of:

* Website accounts
* Course materials
* Website services
* Content

## Prohibited Activities

Include practical restrictions such as:

* Unauthorized copying
* Unauthorized redistribution
* Account misuse
* Attempting to interfere with website operation
* Circumventing access controls
* Fraudulent transactions

## Website Changes

Explain that ManageNovaX may update website features, content, or course information when necessary.

## Disclaimer

Do not guarantee specific professional, financial, employment, or business outcomes from taking a course.

## Limitation of Liability

Use appropriate general wording and avoid making unsupported legal claims.

## Governing Law

If the existing project provides a specific jurisdiction, use that information.

If no jurisdiction is supplied, do not invent one.

## Contact

Provide the existing dynamic company contact information.

---

# 23. PRIVACY POLICY

Create a complete Privacy Policy for ManageNovaX.

It should clearly explain:

## Information Collected

Depending on actual website functionality, this may include:

* Name
* Email address
* Account information
* Billing/order information
* Course purchase information
* Contact form information
* Technical information necessary for website operation

Do not claim that information is collected if the application does not collect it.

## How Information Is Used

Explain legitimate purposes such as:

* Creating and managing accounts
* Processing purchases
* Providing purchased course access
* Customer support
* Website operation
* Security
* Improving the service where applicable

## Payment Information

Do not claim ManageNovaX stores full payment card information unless the application actually does.

If payment is processed by a third-party payment provider, explain this based on the actual implementation.

## Cookies

Only describe cookies or tracking technologies actually used by the website.

## Data Sharing

Explain when information may be shared with:

* Payment providers
* Service providers
* Hosting/infrastructure providers
* Authorities where legally required

Do not invent third-party companies.

## Data Security

Explain reasonable security practices without promising absolute security.

## Data Retention

Explain retention in general terms unless the project has a specific retention schedule.

## User Rights

Include appropriate privacy rights where applicable, without inventing jurisdiction-specific legal obligations if the applicable jurisdiction is unknown.

## Contact

Use the actual company contact information from the application.

---

# 24. REFUND POLICY

Create a clear and practical Refund Policy specifically for digital course purchases.

The policy must be based on the actual application's refund functionality.

Do not invent a refund period such as:

* 7 days
* 14 days
* 30 days

unless that period is actually defined by the project/business rules.

Clearly explain:

* When a refund may be requested
* How users should contact ManageNovaX
* What information may be needed to identify the purchase
* How refund requests are reviewed
* How approved refunds are processed
* That processing time may depend on the payment provider

If the system has no automatic refund functionality, do not claim that users can request refunds through an unavailable dashboard button.

If no specific refund eligibility rules exist in the source data, write the policy carefully without inventing a guaranteed refund entitlement.

---

# 25. DELIVERY / COURSE ACCESS POLICY

Because ManageNovaX provides digital learning materials, create a clear **Delivery & Course Access Policy**.

Explain:

* The product is digital/online where supported by the actual system.
* There is no physical shipment for digital course materials.
* How access is provided after successful payment.
* Where the learner can find purchased material.
* What happens if access does not appear after payment.
* How the learner can contact support.

Do not promise a specific delivery time unless the application/business rules specify one.

Do not mention shipping carriers.

Do not describe physical delivery.

Do not claim downloads, streaming, offline access, lifetime access, or expiration unless supported by the application.

---

# 26. FAQ PAGE

Create useful FAQs based on actual website functionality.

Possible topics:

* What is ManageNovaX?
* What categories are available?
* What are the four skill levels?
* How do I choose the right level?
* How do I purchase a course?
* How do I access a purchased course?
* Can I purchase different levels?
* How can I contact support?
* How do refunds work?
* Where can I read the Privacy Policy?
* How is my information handled?

Answers must be specific to the actual application.

Do not invent policies.

Do not repeat the Terms & Conditions word-for-word.

---

# 27. FOOTER

Create a clean professional footer.

Suggested groups:

### Learning

* All Courses
* Categories
* Skill Levels

### Company

* About
* Contact

### Policies

* Terms & Conditions
* Privacy Policy
* Refund Policy
* Delivery & Course Access Policy

### Account

* Login
* Register
* My Account

Only include links for routes that actually exist.

---

# 28. NEWSLETTER

If the website contains a newsletter subscription:

The success message MUST be exactly:

English:

```text
Thank you for subscribing!
```

Japanese:

```text
ご登録ありがとうございます！
```

Do not add another sentence after it.

Do not change the wording.

---

# 29. COPYRIGHT

Use the current year dynamically.

English:

```text
© {Current Year} ManageNovaX. All Rights Reserved.
```

Japanese:

```text
© {Current Year} ManageNovaX. All Rights Reserved.
```

Do not hardcode an outdated year.

---

# 30. VALIDATION MESSAGES

Do not use vague messages such as:

```text
Required
Invalid
Wrong
Error
```

Use helpful contextual messages.

Examples:

Instead of:

```text
Required
```

Use:

```text
Please enter your email address.
```

Instead of:

```text
Invalid email
```

Use:

```text
Please enter a valid email address.
```

Validation must be localized in both English and Japanese.

---

# 31. SUCCESS AND ERROR MESSAGES

Review the entire project for customer-facing messages.

Check:

* Login
* Registration
* Password reset
* Contact forms
* Newsletter
* Course purchase
* Cart
* Checkout
* Payment
* Course access
* Account actions
* Profile updates
* Any AJAX requests
* JavaScript alerts
* Modals
* Toast notifications
* Server-side validation

All customer-facing messages must be localized.

---

# 32. EMPTY STATES

Empty states should explain what happened and provide a useful next action.

For example, if there are no courses in a selected area:

* Explain that no matching courses are currently displayed.
* Provide a relevant action such as viewing all courses or returning to categories.

Do not use meaningless messages such as:

```text
No data.
```

---

# 33. SEO

Create completely fresh SEO content.

Every major page should have its own:

* SEO title
* Meta description
* H1
* Open Graph title
* Open Graph description
* Twitter title
* Twitter description
* Relevant image ALT text

SEO content must match the actual page.

Do not stuff keywords.

Do not copy SEO descriptions between pages.

Do not make unsupported claims.

---

# 34. ICONS

Use appropriate Font Awesome icons where icons are required.

Icons should have a clear relationship to the content.

Examples:

* Project planning → calendar/tasks icon
* Risk → shield/exclamation icon
* Agile → arrows/refresh icon
* Product → box/lightbulb icon
* Business analysis → chart/search icon
* Leadership → users/flag icon
* Contact → envelope icon
* Learning → book icon

Do not introduce emoji icons.

---

# 35. IMAGES

Use the existing category/course image paths supplied by the source data where applicable.

Do not change image relationships unnecessarily.

ALT text must be descriptive and localized where the project supports localized ALT values.

Do not put keyword-stuffed ALT text.

---

# 36. DATABASE AND FUNCTIONALITY RULE

This is a content redesign, not an excuse to break the application.

Preserve:

* Database structure
* IDs
* Category relationships
* Course relationships
* Level relationships
* Pricing logic
* Cart
* Checkout
* Authentication
* User accounts
* Controllers
* Models
* Routes
* Existing APIs
* Existing JavaScript functionality
* Payment integrations
* Course-access mechanisms

Only modify functionality when explicitly required.

---

# 37. DYNAMIC DATA

Where the website already retrieves information dynamically, continue using dynamic data.

Do not hardcode:

* Company email
* Company address
* Phone number
* Course price
* Category IDs
* Product IDs
* User-specific information
* Order information
* Current year

Use the existing database/configuration.

If company information comes from `miscs`, continue retrieving it from `miscs`.

---

# 38. CONTENT HIERARCHY

Maintain a clear hierarchy:

```text
ManageNovaX
│
├── Project Management
│   ├── Project Planning & Execution
│   ├── Project Risk Management
│   ├── Project Scheduling & Cost Control
│   ├── Stakeholder Management & Communication
│   └── Project Quality & Performance Management
│
├── Agile & Scrum
│   ├── Agile Project Management
│   ├── Scrum Framework & Practices
│   ├── Scrum Master Practices
│   ├── Product Ownership & Backlog Management
│   └── User Stories & Sprint Planning
│
├── Product Management
│   ├── Product Discovery & Customer Research
│   ├── Product Strategy & Roadmap Planning
│   ├── Product Requirements & PRD Writing
│   ├── Product Prioritization & Decision Making
│   └── Product Lifecycle & Portfolio Management
│
├── Business Analysis
│   ├── Business Analysis & Solution Planning
│   ├── Requirements Gathering & Elicitation
│   ├── Business Process Mapping & Improvement
│   ├── Business Requirements & Documentation
│   └── Use Cases & Functional Requirements
│
└── Strategic Project Leadership
    ├── Strategic Project Planning & Execution
    ├── Project Leadership & Team Management
    ├── Strategic Decision-Making & Problem Solving
    ├── Stakeholder & Conflict Management
    └── High-Performance Project Team Leadership
```

Every course contains:

```text
Beginner
Intermediate
Advanced
Expert
```

---

# 39. BREADCRUMBS

Use meaningful breadcrumbs based on the actual hierarchy.

Example:

```text
Home
→ Project Management
→ Project Planning & Execution
```

For a level-specific page:

```text
Home
→ Project Management
→ Project Planning & Execution
→ Beginner
```

Breadcrumb labels must be translated.

Use actual route relationships.

---

# 40. SEARCH

If the website has course search:

Search results should use the actual course catalogue.

Search should not invent results.

Search-related:

* Placeholder
* No-result message
* Result message
* Filter labels
* Category labels
* Level labels

must be localized.

---

# 41. COURSE FILTERS

Where filters exist, support the actual catalogue dimensions.

Useful filters include:

* Category
* Skill Level

Do not introduce filters that the backend does not support.

---

# 42. NO REPETITION RULE

Do not repeat the same content across:

* Homepage
* Category pages
* Course pages
* About page
* FAQ
* Footer
* Terms
* Privacy
* Refund
* Delivery policy

A short reference is acceptable when necessary, but each page should have its own purpose.

---

# 43. NO FALSE CLAIMS

Never invent:

* Student counts
* Reviews
* Ratings
* Testimonials
* Instructor credentials
* Certificates
* Accreditation
* Partnerships
* Awards
* Success rates
* Employment rates
* Salary improvements
* Guaranteed outcomes
* Guaranteed refunds
* Guaranteed access periods

If the source does not support a claim, do not write it.

---

# 44. LEGAL CONTENT CAUTION

Terms, Privacy, Refund, and Delivery policies must describe the actual website.

Do not create fake legal details.

Do not invent:

* Company registration numbers
* Physical addresses
* Legal entity names
* Jurisdictions
* Government registrations
* Specific statutory rights

If information is unavailable, write neutral wording or use existing dynamic company information.

---

# 45. RESPONSIVE CONTENT

All content must work well on:

* Desktop
* Tablet
* Mobile

Do not create extremely long headings that break layouts.

Buttons should remain concise.

Cards should be readable on small screens.

Bullet lists should remain easy to scan.

---

# 46. IMPLEMENTATION PROCESS

Follow this exact workflow:

### Step 1 — READ SOURCE DATA

Read:

```text
/mnt/data/New Courses - Categories(2).csv
/mnt/data/New Courses - Levels(2).csv
/mnt/data/New Courses - Products(2).csv
```

Understand the actual catalogue.

### Step 2 — INSPECT THE EXISTING WEBSITE

Understand:

* Routes
* Controllers
* Models
* Views
* Components
* Translation files
* Database relationships
* JavaScript
* Forms
* Checkout
* Authentication
* Course access

### Step 3 — UNDERSTAND PAGE PURPOSE

Before writing each page, determine what the page is supposed to accomplish.

### Step 4 — IGNORE OLD WRITING

Do not reuse existing copy.

### Step 5 — WRITE COMPLETELY FRESH CONTENT

Create new content specifically for ManageNovaX.

### Step 6 — CREATE NEW TRANSLATION KEYS

Every new customer-facing content item gets a new key.

### Step 7 — ADD ENGLISH AND JAPANESE

Both languages must be complete.

### Step 8 — REPLACE OLD REFERENCES

Update the application to use the new translation keys.

### Step 9 — DELETE OLD KEYS

Search the project for obsolete keys and remove unused ones.

### Step 10 — LOCALIZE JAVASCRIPT

Find and replace customer-facing hardcoded JS messages.

### Step 11 — LOCALIZE VALIDATION

Check server-side and client-side validation.

### Step 12 — LOCALIZE POLICIES

Terms, Privacy, Refund, and Delivery policies must have both language versions.

### Step 13 — REVIEW SEO

Create fresh SEO metadata for each page.

### Step 14 — CHECK ROUTES

Ensure every CTA points to a real route.

### Step 15 — CHECK DATABASE RELATIONSHIPS

Do not break category → course → level relationships.

### Step 16 — FINAL CONTENT QA

Search the complete project for:

* Old content
* Old translation keys
* Hardcoded English
* Hardcoded Japanese
* Duplicate content
* Fake claims
* Incorrect course names
* Incorrect categories
* Incorrect levels
* Incorrect prices
* Broken links
* Missing translations
* Missing ALT text
* Missing SEO metadata

---

# 47. FINAL CATALOGUE VALIDATION

Before completing the implementation, verify:

### Categories

Exactly:

```text
5 categories
```

### Courses

Exactly:

```text
25 courses
```

### Skill levels

Each course must have:

```text
Beginner
Intermediate
Advanced
Expert
```

Therefore the catalogue should contain:

```text
25 courses × 4 levels = 100 level records
```

Do not create additional courses or levels.

---

# 48. FINAL FORBIDDEN CONTENT RULE

Do not use irrelevant content from previous websites or projects.

Do not reuse:

* Previous website names
* Previous website branding
* Previous marketing copy
* Previous category descriptions
* Previous course descriptions
* Previous CTAs
* Previous FAQs
* Previous SEO content
* Previous legal-policy wording where it was written for another business
* Previous translation keys

ManageNovaX must have its own fresh content identity.

---

# 49. FINAL QUALITY STANDARD

The finished website should feel like a real, professional online learning platform.

A visitor should be able to understand:

1. What ManageNovaX is.
2. What subjects are available.
3. What each category covers.
4. What each course teaches.
5. Which skill levels are available.
6. How the levels differ.
7. How to select a course.
8. How purchasing works.
9. How course access works.
10. How refunds work.
11. How personal information is handled.
12. Where to get help.

The writing should be **simple enough to understand quickly, but detailed enough to answer genuine learner questions.**

Use paragraphs when explanation is needed.

Use bullet points when presenting multiple items.

Do not turn every section into a bullet list.

Do not make every section a large paragraph.

Use the format that best communicates the information.

---

# 50. FINAL INSTRUCTION

Build the ManageNovaX website content around the supplied catalogue.

**Do not reuse the old website's writing.**

**Do not reuse old translation keys.**

**Create completely fresh content and completely new translation keys.**

**Delete obsolete translation keys after replacing them.**

**Use the CSV files as the source of truth for categories, courses, levels, relationships, and pricing.**

**Keep existing technical functionality intact.**

**Write natural English and professionally localized Japanese.**

**Keep explanations simple, understandable, and detailed where necessary.**

**Make Terms & Conditions, Privacy Policy, Refund Policy, and Delivery & Course Access Policy specific to how ManageNovaX actually works.**

**Never invent unsupported business, legal, pricing, course, certification, customer, or performance information.**

The final result should be a polished, trustworthy, easy-to-understand professional learning website for **ManageNovaX**.
# STRICT DATABASE PRESERVATION RULE

This project is a content and website redesign.

**DO NOT CHANGE THE DATABASE STRUCTURE OR EXISTING INTERNAL TABLE DATA.**

The existing database is the source of truth for all internal application data.

## NEVER MODIFY

Do not modify, rename, remove, recreate, or restructure:

* Database tables
* Table names
* Column names
* Column types
* Primary keys
* Foreign keys
* Indexes
* Unique constraints
* Relationships
* Existing IDs
* Existing records
* Existing category records
* Existing course/product records
* Existing level records
* Existing pricing records
* Existing status values
* Existing timestamps
* Existing user/order/payment data
* Existing database relationships
* Existing migrations
* Existing model relationships

Do not create a new database schema to replace the existing one.

Do not migrate existing data into a new structure.

Do not delete existing records simply because the website content is being redesigned.

---

## DATABASE DATA MUST REMAIN UNCHANGED

The uploaded CSV files are being used to **understand and reference the existing catalogue**.

They must NOT be interpreted as permission to overwrite the database.

The existing database data must remain exactly as it is unless the user explicitly requests a database/data change.

For example:

If the database already contains:

```text
Category ID
Course ID
Level ID
Price
Status
Slug
Relationships
```

do not change those values merely to match newly generated website copy.

---

## CONTENT CHANGES MUST HAPPEN AT THE PRESENTATION / TRANSLATION LAYER

When replacing old website content:

**Change:**

* Customer-facing text
* Translation values
* New translation keys
* Page copy
* Headings
* Descriptions
* CTA text
* FAQs
* SEO copy
* Validation messages
* Success/error messages
* Policy content
* UI labels
* Help text

**Do NOT change:**

* Database records
* Database relationships
* Product IDs
* Category IDs
* Level IDs
* Prices stored in the database
* Status values stored in the database
* Internal table structure

---

## COURSE DATA RULE

The existing course/product data must be displayed using the current database relationships.

Do not create duplicate courses in the database.

Do not insert new course records.

Do not delete existing course records.

Do not update course IDs or relationships.

If a course needs a new description for the website, implement the new description through the appropriate content/translation layer rather than altering the underlying course/product record.

---

## CATEGORY DATA RULE

Do not create, delete, rename, or reorder database category records.

Use the existing category records and relationships.

The five categories identified from the supplied source files should be represented correctly in the website UI, but their underlying database records must remain untouched.

---

## LEVEL DATA RULE

Do not create, delete, rename, or modify existing level records.

The existing levels are:

```text
Beginner
Intermediate
Advanced
Expert
```

Use the existing level IDs and relationships.

Any new explanatory content about these levels must be handled through the website's content/translation layer.

---

## PRICE RULE

**NEVER modify prices in the database.**

Do not:

* Change existing prices
* Generate new prices
* Recalculate prices
* Apply discounts
* Change ticket sizes
* Update currency values
* Update pricing records

Display the price already provided by the existing application/database.

---

## STATUS RULE

Do not change existing database status values.

For example, do not automatically:

* Activate records
* Deactivate records
* Publish products
* Unpublish products
* Change category status
* Change course status

unless the user explicitly asks for a database/status change.

---

## MIGRATION RULE

Do not create or execute migrations that modify the existing database structure.

Do not alter migrations merely to support new website content.

If a content requirement appears to require a database change, STOP and report that requirement instead of modifying the database.

The preferred solution is to implement the change through:

* Existing translation files
* Existing views
* Existing components
* Existing configuration
* Existing application logic

without changing the database.

---

## SEEDER RULE

Do not run seeders that overwrite, reset, truncate, or replace existing application data.

Do not use:

```text
TRUNCATE
DELETE
DROP
UPDATE
INSERT
```

against existing catalogue tables as part of this redesign.

Do not use database reset commands.

Do not use destructive refresh commands.

---

## CODE IMPLEMENTATION RULE

Before making changes, inspect the existing application architecture.

Identify:

```text
Database
↓
Models
↓
Controllers
↓
Services
↓
Routes
↓
Views / Components
↓
Translation Layer
↓
Frontend
```

Preserve the existing data flow.

Only change the layers necessary to implement the new ManageNovaX content and presentation.

---

## ABSOLUTE PRIORITY

The following priority applies:

### 1. Preserve existing database

No structural or internal data changes.

### 2. Preserve existing functionality

Routes, authentication, checkout, payments, cart, course access, and existing business logic must continue working.

### 3. Replace old customer-facing content

Create completely fresh ManageNovaX content.

### 4. Create new translation keys

Never reuse old keys for rewritten content.

### 5. Delete unused old translation keys

After replacing references, remove obsolete keys from translation files.

---

## IF A DATABASE CHANGE SEEMS NECESSARY

Do NOT make the change automatically.

Instead:

1. Identify the requirement.
2. Explain which existing database structure would be affected.
3. Do not modify it.
4. Continue using the existing structure if possible.
5. Ask the user before making any database change.

**No database modification is authorized by this prompt.**

---

# FINAL DATABASE REQUIREMENT

**The ManageNovaX redesign must leave the database structure and existing internal table data unchanged.**

The goal is:

```text
EXISTING DATABASE
        ↓
   DO NOT CHANGE
        ↓
EXISTING APPLICATION LOGIC
        ↓
   PRESERVE
        ↓
NEW MANAGENOVAX CONTENT
        ↓
NEW TRANSLATION KEYS
        ↓
NEW UI / PRESENTATION
```

The website should look and read like a completely refreshed ManageNovaX platform while continuing to operate on the **same database structure, same internal records, same IDs, same relationships, and same existing data**.
