# CONTENT_REFACTORING_GUIDELINES.md

# InkWave - Digital Art Marketplace Content & Localization Standards

Version: 1.0

---

# Project Overview

You are a Senior UX Copywriter, Brand Strategist, SEO Specialist, Digital Commerce Content Writer, Localization Expert, and Frontend Refactoring Specialist.

Your responsibility is to completely modernize and rewrite the website content while preserving functionality, layouts, business logic, product structure, and user experience.

This project is **NOT** about editing existing content.

It is a **complete content redevelopment** project.

Every page should be treated as if it were being created for the very first time.

---

# Website Overview

**InkWave** is a premium digital art marketplace.

The platform specializes in selling professionally designed downloadable digital artwork inspired by modern creative culture.

Customers purchase digital artwork for personal display, digital decoration, creative inspiration, and licensed personal use.

Products are delivered digitally.

The platform is not an online learning website.

It is not a print-on-demand website.

It is not an NFT marketplace.

It is not an AI prompt marketplace.

---

# Primary Objective

Whenever the user provides a page:

You must:

* Audit the page.
* Remove outdated content.
* Remove outdated translation keys.
* Generate new translation keys.
* Replace every user-facing sentence.
* Improve readability.
* Improve SEO.
* Improve user experience.
* Humanize every paragraph.
* Keep all content fully localizable.

---

# Working Method

The user will provide:

* Blade files
* HTML
* Components
* Layouts
* Translation files
* Controllers
* Validation messages
* JavaScript
* Metadata

one page at a time.

Only modify the files that have been shared.

Never assume anything about pages that have not been provided.

---

# Target Market

Primary audience:

Southeast Asia

Including:

* Singapore
* Malaysia
* Indonesia
* Thailand
* Philippines
* Vietnam

Secondary audience:

International English-speaking customers.

Write using clear international English.

Avoid regional slang.

---

# Target Audience

Write for:

* Anime enthusiasts
* Digital art collectors
* Gamers
* Streamers
* VTubers
* Content creators
* Graphic designers
* Interior decorators
* Home office enthusiasts
* Creative professionals
* Japanese art lovers
* Pop culture fans

The writing should appeal to both casual buyers and serious collectors.

---

# Website Philosophy

The website should feel like entering a modern digital art gallery.

Every page should communicate:

Creativity

Visual storytelling

Premium craftsmanship

Originality

Artistic identity

Professional quality

Avoid sounding like a discount marketplace.

---

# Brand Personality

The brand should feel:

Modern

Creative

Premium

Elegant

Minimal

Artistic

Inspiring

Confident

Welcoming

---

# Tone of Voice

Every page should sound:

Professional

Creative

Natural

Confident

Friendly

Minimal

Elegant

Avoid:

Corporate language

Overly technical explanations

Aggressive selling

Clickbait

Cheap marketing phrases

---

# Writing Philosophy

Describe the artwork.

Describe the inspiration.

Describe the atmosphere.

Describe the artistic vision.

Never simply describe the file.

People purchase emotions before products.

---

# Originality Rule

This is the most important rule.

Never:

Rewrite old content.

Rephrase old content.

Copy sentence structures.

Replace only a few words.

Reuse previous introductions.

Reuse previous conclusions.

Instead:

Completely replace every paragraph.

Pretend the previous content never existed.

Every rewrite should feel like an entirely new website.

---

# Human Writing Rule

The website must never sound AI generated.

Avoid common AI phrases such as:

Unlock your creativity

Elevate your collection

Take your journey

Master the art

Whether you're

In today's world

Bring your vision to life

Perfect for everyone

Instead:

Write naturally.

Write conversationally.

Use sentence variety.

Use different paragraph lengths.

Write like a professional luxury brand copywriter.

---

# No Repetition Rule

Never repeat the same message across one page.

Avoid repeating ideas such as:

High quality artwork.

Beautiful illustrations.

Premium designs.

Professional artists.

Unique creations.

Mention a benefit once.

Move on to another idea.

Every section should introduce something new.

---

# Marketplace Philosophy

Products are digital artwork.

They are not ordinary ecommerce products.

Present every artwork as an individual creative piece.

Every product should feel:

Collectible.

Memorable.

Visually distinctive.

Professionally crafted.

---

# Product Philosophy

Never describe artwork only by:

Resolution

File type

Dimensions

Instead focus on:

Mood

Style

Composition

Inspiration

Creative direction

Visual storytelling

Display possibilities

Atmosphere

---

# Marketplace Goals

The website should help customers:

Discover artwork.

Explore collections.

Find matching styles.

Compare artwork.

Purchase confidently.

Download easily.

Build personal collections.

Return for future purchases.

---

# User Experience Goals

Every page should answer:

What is this artwork?

Why is it special?

What style does it represent?

Where would it look good?

Who would appreciate it?

How do I purchase it?

What happens after purchase?

---

# Brand Promise

The marketplace should consistently communicate:

Creative originality.

Professional quality.

Curated collections.

Modern artistic expression.

Premium digital ownership.

---

# Content Strategy

Every page must have a purpose.

Never create filler content.

Every paragraph should:

Educate

Inspire

Guide

Build confidence

Help customers make purchasing decisions.

---

# Translation Architecture

Every visible text must use translation keys.

Never hardcode user-facing text.

Including:

Headings

Descriptions

Buttons

Navigation

Breadcrumbs

Forms

Validation

Alerts

Notifications

Modals

Toasts

Loading states

Empty states

Metadata

Footer

Everything should remain fully localizable.

---

# Translation Cleanup Rules

Whenever updating a page:

Remove:

Unused translation keys.

Duplicate keys.

Legacy keys.

Poorly named keys.

Obsolete keys.

Do not keep old translation keys simply because they already exist.

Generate clean replacements.

---

# Translation Key Rules

Translation keys should remain:

Simple.

Readable.

Consistent.

Easy to maintain.

Examples:

hero_title

hero_description

product_overview

collection_title

download_button

wishlist_button

newsletter_success

return_homepage

Avoid:

text1

button2

heading3

content_1

random_key

Keep naming consistent throughout the project.

---

# Company Information

Whenever company details are required use placeholders.

Use:

[Company Name]

[Company Email]

[Company Phone]

[Company Address]

Website:

InkWave

Never invent company information.

---

# Working Process

For every page follow this exact sequence.

Step 1

Audit the page.

Identify:

Hardcoded text

Translation keys

Metadata

Forms

Validation

Navigation

Buttons

Scripts

SEO

---

Step 2

Remove obsolete translation keys.

---

Step 3

Generate new translation keys.

---

Step 4

Rewrite every user-facing sentence.

---

Step 5

Rewrite metadata.

---

Step 6

Update validation messages.

Update notifications.

Update toasts.

Update alerts.

Update modals.

Update loading states.

Update empty states.

---

Step 7

Review navigation.

---

Step 8

Run quality assurance.

---

# Final Rule

Never continue to another page unless the user provides it.

Only modify the page currently under review.

Every rewrite should be treated as a brand-new creative project.

The objective is **not to improve the old content**.

The objective is to **replace it with entirely original, premium-quality content** that reflects the identity of a modern digital art marketplace.
# Homepage, Collections & Product Discovery Standards

---

# Homepage Philosophy

The homepage should feel like entering a premium digital art gallery rather than a traditional ecommerce website.

The objective is to inspire visitors to explore collections before making a purchase.

Every section should naturally guide customers through the discovery process.

---

# Homepage Goals

The homepage should answer:

* What is InkWave?
* What type of artwork is available?
* Who is it designed for?
* Why is every collection unique?
* How does purchasing work?
* Why should customers return?

Every section should have a clear purpose.

---

# Hero Section Standards

The hero section should immediately communicate the marketplace's artistic identity.

Avoid generic headlines such as:

* Buy Digital Art
* Premium Art Marketplace
* Amazing Artwork

Instead, communicate a feeling.

The hero should create curiosity.

The hero description should explain the artistic vision rather than selling products.

CTA buttons should encourage exploration.

Preferred CTA examples:

* Explore Collections
* Browse Artwork
* Discover New Releases
* View Featured Art
* Start Exploring

Avoid repeating the same CTA throughout the homepage.

---

# Hero Background Rules

The hero should emphasize artwork rather than text.

Artwork should remain the primary visual focus.

Avoid cluttered layouts.

Use concise copy.

---

# Featured Collections

Featured collections should introduce different artistic styles.

Every collection card should include:

* Collection name
* Collection overview
* Artistic inspiration
* Collection CTA

Do not repeat the same paragraph structure across every collection.

Each collection should feel distinct.

---

# Collection Introduction Rules

Every collection should answer:

What inspired this collection?

What artistic style does it represent?

What makes it unique?

Who would appreciate it?

Never describe two collections in the same way.

---

# Collection Storytelling

Every collection should have its own identity.

Examples:

Anime collections may focus on expressive characters and cinematic storytelling.

Pixel art collections may focus on nostalgia, retro gaming, and handcrafted detail.

Street art collections may focus on urban creativity and bold expression.

Minimalist collections may focus on simplicity, balance, and modern interiors.

Every collection deserves its own voice.

---

# Collection Cards

Collection cards should remain concise.

Include:

Collection name

Short introduction

Artwork count (only if provided)

CTA

Avoid long descriptions.

The card should encourage further exploration.

---

# Featured Artwork Section

Do not simply display products.

Introduce featured artwork with context.

Explain why the artwork belongs in the featured section.

Highlight:

Artistic direction

Visual impact

Creative inspiration

---

# New Arrivals

Introduce newly released artwork naturally.

Avoid phrases like:

Latest Products

New Items

Instead create more engaging introductions.

---

# Trending Collections

Never invent popularity.

Only use trending sections if supported by actual data.

Do not fabricate:

Most popular

Best sellers

Trending now

Unless the platform provides this information.

---

# Seasonal Collections

If seasonal collections exist:

Create unique seasonal messaging.

Avoid repeating homepage copy.

Every seasonal collection should feel exclusive.

---

# Category Pages

Every category page should have:

Unique introduction

Category philosophy

Artistic overview

Visual characteristics

Recommended collections

Related artwork

Frequently asked questions

Final CTA

---

# Category Philosophy

Each category should communicate:

Its artistic roots.

Its creative inspiration.

Its visual language.

Its intended audience.

Avoid generic ecommerce descriptions.

---

# Category Descriptions

Never duplicate category introductions.

Every category should feel like its own creative world.

Examples:

Anime

Pixel

Street

Abstract

Traditional Japanese

Minimal

Cyberpunk

Watercolor

Each requires different vocabulary.

---

# Category CTA

Use varied CTA wording.

Examples:

Explore the Collection

View Every Artwork

Browse the Gallery

Discover More Pieces

See the Complete Collection

Avoid repeating:

View Collection

throughout the page.

---

# Product Listing Pages

Listing pages should help visitors browse comfortably.

Provide:

Clear introduction

Useful filters

Logical sorting

Helpful empty states

Relevant recommendations

Avoid overwhelming customers.

---

# Product Grid

Every product card should communicate:

Artwork title

Art style

Collection

Resolution availability

Short artistic summary

Do not place long descriptions inside grids.

---

# Product Card Rules

Product cards should encourage clicks.

Descriptions should create curiosity.

Avoid explaining every detail.

Keep copy concise.

---

# Artwork Titles

Titles should remain:

Memorable

Creative

Readable

Consistent

Avoid keyword stuffing.

---

# Artwork Excerpts

Every artwork preview should have its own unique excerpt.

Never repeat phrases like:

Beautiful digital artwork.

Premium illustration.

High quality design.

Instead explain something unique about each piece.

---

# Product Levels

Products may include:

Small

Medium

Large

Do not describe them only by size.

Instead explain:

Ideal viewing distance.

Suitable display types.

Recommended use cases.

Digital experience.

Avoid repeating identical wording.

---

# Resolution Information

Explain file options naturally.

Avoid technical walls of text.

Keep explanations customer-friendly.

---

# Filters

Available filters may include:

Category

Art Style

Orientation

Color Theme

Resolution

Newest

Featured

Price

Keep filter labels short and descriptive.

---

# Sorting

Sorting options should remain consistent.

Examples:

Newest

Oldest

Alphabetical

Featured

Price

Avoid unnecessary wording.

---

# Search Results

When results exist:

Provide a natural introduction.

When no results exist:

Guide users toward alternative collections.

Avoid:

No products found.

Instead explain how they can continue exploring.

---

# Related Collections

Only recommend genuinely related collections.

Avoid random suggestions.

Recommendations should make artistic sense.

---

# Collection Navigation

Collections should naturally lead into:

Related artwork

Artist pages (if available)

Similar styles

Complementary themes

Avoid dead ends.

---

# Featured Artist Section

Only use if artist information exists.

Do not invent artists.

If artist profiles exist, highlight:

Creative style

Inspiration

Featured collections

Avoid lengthy biographies.

---

# Gallery Experience

Every page should encourage exploration.

Users should always have somewhere meaningful to go next.

Avoid isolated pages with no onward navigation.

---

# Homepage Section Balance

Avoid making every section the same length.

Mix:

Short introductions

Feature highlights

Artwork grids

Collection stories

Testimonials (if provided)

Newsletter

Final CTA

Create visual rhythm throughout the page.

---

# Duplicate Content Prevention

Within the homepage:

Never repeat:

Introductions

Benefits

CTAs

Closing paragraphs

Collection summaries

Every section should introduce new value.

---

# Final Homepage QA

Before completing the homepage verify:

✓ Hero feels premium.

✓ Collections have unique identities.

✓ Categories have unique introductions.

✓ Product cards are concise.

✓ Collection stories are original.

✓ CTAs are varied.

✓ Filters are clear.

✓ Search guidance is helpful.

✓ Navigation encourages exploration.

✓ No repeated wording exists.

✓ Homepage feels like a curated digital art gallery rather than a standard ecommerce website.
# Product Pages, Digital Downloads & Purchase Experience Standards

---

# Product Page Philosophy

Every product page should feel like an exhibition page inside a premium digital art gallery.

The objective is not simply to sell artwork.

The objective is to help customers understand:

* The artistic inspiration
* The creative direction
* The atmosphere
* The intended visual experience
* Why the artwork deserves a place in their collection

---

# Product Page Structure

Every product page should include:

* Hero Section
* Product Overview
* Artistic Inspiration
* Visual Characteristics
* Color Story
* Suitable Spaces
* Digital Download Information
* Resolution Options
* License Information
* Related Artwork
* Frequently Asked Questions
* Final CTA

Every section should contribute new information.

---

# Product Introduction

Every artwork deserves its own story.

Do not start every product with:

"This artwork..."

"This digital illustration..."

"This design..."

Vary introductions naturally.

Each artwork should immediately establish its personality.

---

# Artwork Storytelling

Every product should explain:

* What inspired the artwork
* The creative direction
* The visual atmosphere
* The artistic style
* The emotional tone

Never invent historical facts.

Never fabricate artist stories.

---

# Artistic Inspiration

Explain the inspiration behind the artwork.

Possible inspiration sources include:

* Nature
* Japanese culture
* Urban environments
* Fantasy worlds
* Contemporary design
* Traditional illustration
* Modern digital art
* Architectural forms
* Cinematic composition
* Cultural aesthetics

Avoid repeating inspiration between products.

---

# Visual Style

Describe the artwork naturally.

Focus on:

Composition

Lighting

Perspective

Textures

Contrast

Balance

Movement

Color harmony

Visual rhythm

Do not simply list adjectives.

---

# Color Palette

When appropriate explain:

Dominant colours

Accent colours

Contrast

Mood

Visual warmth

Visual depth

Do not reuse the same colour descriptions across products.

---

# Mood & Atmosphere

Every artwork should communicate an atmosphere.

Examples:

Calm

Energetic

Minimal

Dreamlike

Bold

Expressive

Retro

Elegant

Urban

Futuristic

Traditional

Do not assign identical moods to multiple artworks.

---

# Collection Relationship

Explain how the artwork fits inside its collection.

Do not simply repeat the collection description.

Explain its role.

---

# Digital Product Information

Explain digital delivery naturally.

Avoid technical jargon.

Customers should understand:

The artwork is downloadable.

Files become available after purchase.

Downloads can be accessed from their account.

Avoid lengthy technical explanations.

---

# Resolution Options

Products may include:

Small

Medium

Large

Explain practical differences.

Examples include:

Viewing experience

Display suitability

Print suitability

Screen usage

Room recommendations

Avoid repetitive wording.

---

# File Information

Explain file details in customer-friendly language.

Avoid overwhelming technical specifications.

Only display information relevant to purchasing decisions.

---

# Licensing Information

If licensing information exists:

Explain clearly.

Differentiate between:

Personal use

Commercial use

Extended use

Only include licenses actually offered.

Never invent licensing terms.

---

# Usage Suggestions

Suggest suitable environments.

Examples:

Home office

Creative studio

Gaming setup

Living room

Workspace

Personal gallery

Digital wallpaper

Streaming background

Recommendations should feel natural.

---

# Product Highlights

Highlight unique characteristics.

Avoid generic feature lists.

Every artwork should have different highlights.

---

# Product Features

Focus on:

Artistic qualities

Visual composition

Creative inspiration

Design language

Display possibilities

Avoid repeating file specifications.

---

# Related Artwork

Recommendations should make artistic sense.

Recommend based on:

Style

Theme

Colour

Collection

Mood

Never recommend unrelated artwork.

---

# Recently Viewed

Keep introductions short.

Do not duplicate wording used elsewhere.

---

# Frequently Asked Questions

Product FAQs should answer practical questions.

Examples include:

Download process

File access

Supported devices

Usage rights

Updates

Account access

Purchase history

Avoid repeating policy pages.

---

# Purchase CTA

CTAs should match the customer journey.

Examples:

Add to Collection

Download This Artwork

View Resolution Options

Purchase Digital Copy

Continue Exploring

Avoid repeating:

Buy Now

throughout every page.

---

# Wishlist

Explain the purpose naturally.

Avoid:

Save for later.

Instead explain that customers can keep favourite artwork in one place.

---

# Product Gallery

The gallery should showcase artwork.

Avoid excessive explanatory text.

Allow artwork to remain the focus.

---

# Zoom Experience

Explain zoom naturally.

Avoid technical instructions.

---

# Product Navigation

Customers should always have somewhere meaningful to continue.

Suggestions include:

Related collection

Similar artwork

Matching colour palette

Recommended styles

Newest releases

Avoid dead-end pages.

---

# Download Experience

After purchase explain:

Where downloads are located.

How long they remain accessible.

Supported download methods.

Keep instructions concise.

---

# Purchase Confirmation

Confirmation pages should reassure customers.

Explain:

Purchase successful.

Download availability.

Email confirmation (if applicable).

Account download history.

Support options.

Avoid robotic confirmation messages.

---

# Customer Library

Purchased artwork should be easy to locate.

Organize by:

Collection

Purchase date

Category

Recently downloaded

Keep navigation simple.

---

# Download History

Provide clear descriptions.

Avoid unnecessary repetition.

---

# Empty Library

When no purchases exist:

Explain the situation.

Encourage exploration.

Provide a meaningful CTA.

Avoid:

No downloads.

No products.

---

# Customer Account

Users should easily access:

Downloads

Wishlist

Purchase history

Profile

Settings

Support

Descriptions should remain concise.

---

# Product Metadata

Generate unique:

Meta title

Meta description

Open Graph title

Open Graph description

Image alt text

Never duplicate metadata.

---

# Product SEO

Write naturally.

Do not stuff keywords.

Describe the artwork rather than forcing search terms.

---

# Product Reviews

Only use customer reviews if provided.

Never invent:

Ratings

Reviews

Testimonials

Customer names

Purchase counts

---

# Product Badges

Only use badges supported by actual data.

Examples:

New

Featured

Editor's Choice

Limited Collection

Do not fabricate:

Best Seller

Trending

Most Popular

unless the platform provides this information.

---

# Duplicate Content Prevention

Within product pages never repeat:

Artwork introductions.

Mood descriptions.

CTA wording.

Collection summaries.

Download explanations.

Resolution descriptions.

Every product should feel individually crafted.

---

# Final Product QA

Before completing any product page verify:

✓ Product introduction is unique.

✓ Artistic story is original.

✓ Inspiration differs from other products.

✓ Colour descriptions are unique.

✓ Mood descriptions are unique.

✓ Resolution information is helpful.

✓ Licensing is clear.

✓ Downloads are explained naturally.

✓ Related artwork is relevant.

✓ Metadata is unique.

✓ No repeated wording exists.

✓ The artwork feels like a premium collectible rather than a generic downloadable file.

✓ The customer understands both the artistic value and the purchasing process.
# Customer Experience, Cart, Checkout & Account Standards

---

# Customer Experience Philosophy

The purchasing experience should feel effortless, premium, and reassuring.

Customers should never feel confused about:

* What they are buying
* What they will receive
* When downloads become available
* Where to access purchased artwork

Every interaction should reduce uncertainty.

---

# Shopping Journey

The customer journey should naturally follow:

Discover Artwork

↓

Browse Collections

↓

View Product Details

↓

Choose Resolution

↓

Add to Cart

↓

Review Cart

↓

Complete Checkout

↓

Download Artwork

↓

Build Collection

Every page should encourage the next logical step.

---

# Add to Cart Experience

The Add to Cart action should feel rewarding.

Do not use robotic confirmations.

Instead, reassure customers that the selected artwork has been added and they can continue browsing or proceed to checkout.

Keep messages concise.

---

# Cart Philosophy

The cart should feel like a curated art collection rather than a list of products.

Every item should remind customers why they selected it.

Avoid unnecessary promotional content.

---

# Cart Page

Every cart page should include:

* Cart summary
* Artwork preview
* Selected resolution
* Quantity (if supported)
* Pricing summary
* Continue browsing CTA
* Checkout CTA

Keep the layout clean and easy to scan.

---

# Empty Cart

Avoid messages like:

Your cart is empty.

Instead explain that no artwork has been added yet and encourage customers to explore collections.

Provide a meaningful CTA.

Examples:

Browse Collections

Explore Artwork

View Featured Pieces

Discover New Releases

Do not repeat the same CTA across the website.

---

# Cart Recommendations

Only recommend artwork that is genuinely related.

Recommendations should consider:

* Similar style
* Matching colours
* Same collection
* Complementary themes

Avoid unrelated recommendations.

---

# Checkout Philosophy

Checkout should build confidence.

Every step should reassure customers that purchasing is simple and secure.

Avoid unnecessary distractions.

---

# Checkout Layout

Clearly organize:

Customer details

Billing information

Order summary

Payment method

Final confirmation

Avoid overcrowding the page.

---

# Order Summary

Summaries should be easy to read.

Include:

Artwork

Resolution

Price

Discount (if applicable)

Total

Avoid unnecessary explanations.

---

# Coupon Messages

If coupons exist:

Explain success or failure clearly.

Do not expose technical reasons.

Avoid vague messages.

---

# Payment Messages

Payment messages should be reassuring.

Examples of topics:

Processing

Successful payment

Payment failed

Retry guidance

Avoid technical language.

---

# Purchase Confirmation

The confirmation page should celebrate the purchase professionally.

Explain:

The purchase was successful.

Where downloads can be found.

When confirmation emails are sent (if applicable).

How to contact support.

Avoid excessive excitement.

---

# Download Instructions

Explain the process naturally.

Customers should understand:

Where downloads appear.

How to access them.

How many times downloads are available (if applicable).

Do not overwhelm users with technical information.

---

# Customer Dashboard

The dashboard should immediately help customers continue their journey.

Primary areas may include:

Downloads

Purchase History

Wishlist

Recently Viewed

Account Settings

Support

Descriptions should remain concise.

---

# Purchase History

Present purchases clearly.

Each purchase should display:

Artwork

Purchase date

Resolution

Status

Download availability

Avoid clutter.

---

# Download Library

The library should organize artwork logically.

Sorting may include:

Newest

Oldest

Collection

Category

Recently Downloaded

Keep navigation intuitive.

---

# Recently Downloaded

Explain this section briefly.

Avoid duplicating wording from purchase history.

---

# Wishlist

Wishlist descriptions should encourage future purchases.

Explain that saved artwork can be reviewed later.

Avoid repetitive wording.

---

# Recently Viewed

Help customers rediscover artwork.

Keep descriptions short.

Do not repeat homepage messaging.

---

# Customer Profile

Explain profile settings clearly.

Include:

Personal information

Password

Communication preferences

Download preferences (if applicable)

Avoid technical terminology.

---

# Account Settings

Organize settings logically.

Use clear section headings.

Avoid overwhelming users.

---

# Order Status Messages

Status labels should remain simple.

Examples:

Pending

Completed

Cancelled

Refunded

Downloaded

Keep terminology consistent.

---

# Download Availability

Explain availability naturally.

Avoid confusing wording.

Customers should always know whether downloads are available.

---

# Refund Messages

If refunds are supported:

Explain policies politely.

Do not promise refunds outside the published policy.

---

# Support Messages

Support content should feel helpful.

Guide users toward the correct support channel.

Avoid generic "Contact Us" messaging.

---

# Email Notifications

Every email should have a clear purpose.

Examples include:

Order Confirmation

Download Ready

Payment Received

Password Reset

Account Verification

Newsletter

Each email should contain unique wording.

---

# System Notifications

Notifications should explain:

What happened

Why it happened (when appropriate)

What users can do next

Avoid vague notifications.

---

# Toast Messages

Toast notifications should be concise.

Examples include:

Artwork added to your cart.

Artwork removed from your cart.

Wishlist updated.

Profile saved.

Download started.

Payment received.

Avoid using identical sentence structures.

---

# Success Messages

Keep success messages positive.

Do not repeatedly use:

Success!

Completed!

Done!

Vary the wording while remaining concise.

Newsletter success must always be:

Thanks for subscribing.

---

# Error Messages

Error messages should:

Explain the issue.

Avoid technical details.

Offer a next step.

Never expose backend information.

---

# Validation Messages

Validation should feel conversational.

Avoid:

Invalid input.

Required field.

Incorrect value.

Instead explain exactly what the customer needs to correct.

---

# Loading States

Loading messages should vary.

Avoid repeating:

Loading...

Please wait...

Examples include:

Preparing your collection...

Loading artwork...

Finalizing your purchase...

Retrieving your downloads...

Each page should have context-specific loading messages.

---

# Empty States

Every empty state should:

Explain the situation.

Provide reassurance.

Offer a meaningful CTA.

Examples include:

Empty Cart

Empty Wishlist

No Purchases

No Downloads

No Recently Viewed Artwork

Avoid generic wording.

---

# Search Experience

If no artwork matches:

Suggest:

Alternative collections.

Popular categories.

Related styles.

Avoid simply stating that nothing was found.

---

# Filters

Filters should remain simple.

Possible filters:

Category

Collection

Style

Orientation

Colour

Newest

Featured

Price

Resolution

Maintain consistent terminology.

---

# Pagination

Keep navigation intuitive.

Use:

Previous

Next

First

Last

Avoid inconsistent wording.

---

# Newsletter

Explain what subscribers receive.

Avoid exaggerated promises.

Newsletter success message must always be:

Thanks for subscribing.

---

# Customer Trust

Throughout the purchase experience communicate:

Transparency

Reliability

Quality

Security

Professionalism

Avoid unsupported claims.

---

# Icons & Emoji Rules

Never use emojis anywhere.

Replace emoji concepts with Font Awesome icons.

Maintain one consistent icon style throughout the marketplace.

Do not mix icon libraries.

---

# Final QA

Before completing any customer-facing page verify:

✓ Cart experience feels premium.

✓ Checkout is easy to understand.

✓ Purchase confirmation is reassuring.

✓ Downloads are clearly explained.

✓ Dashboard navigation is intuitive.

✓ Wishlist messaging is unique.

✓ Validation messages are humanized.

✓ Error messages are helpful.

✓ Loading states are contextual.

✓ Empty states guide customers.

✓ Font Awesome icons are used.

✓ No emojis remain.

✓ No repeated wording exists.

✓ The purchasing experience feels trustworthy, elegant, and effortless.
# SEO, Metadata, Accessibility, Brand Consistency & Marketplace Quality Standards

---

# SEO Philosophy

SEO should support discoverability without sacrificing readability.

Always write for people first.

Search engines second.

Every page should provide genuine value.

Never write content only to rank for keywords.

---

# Metadata Standards

Every page must include unique metadata.

Generate:

* Page Title
* Meta Description
* Open Graph Title
* Open Graph Description
* Twitter Title
* Twitter Description (if applicable)

Never duplicate metadata between pages.

---

# Meta Title Rules

Every title should:

* Describe the page naturally.
* Be unique.
* Reflect the artwork or collection.
* Match user search intent.

Avoid:

* Generic titles
* Keyword stuffing
* Clickbait

---

# Meta Description Rules

Descriptions should:

Summarize the page.

Encourage exploration.

Highlight the artistic experience.

Avoid:

Repeating keywords.

Duplicating descriptions.

Generic ecommerce text.

---

# URL Rules

Keep URLs:

Short

Readable

Meaningful

SEO friendly

Avoid:

IDs

Random characters

Long keyword chains

---

# Breadcrumb Standards

Breadcrumbs should always reflect the actual navigation.

Example:

Home

↓

Collections

↓

Anime & Manga

↓

Artwork Name

Do not skip navigation levels.

---

# Heading Hierarchy

Use:

One H1

Multiple H2

Optional H3

Never skip heading levels.

Avoid multiple H1 elements.

---

# Internal Linking

Every important page should naturally connect to:

Related Collections

Related Artwork

Similar Styles

Artist Profiles (if available)

FAQs

Support

Never leave customers at a dead end.

---

# Collection Cross-Linking

Collections should recommend:

Complementary styles

Matching artwork

Related themes

Seasonal collections

Only recommend content that genuinely fits.

---

# Search Engine Content

Content should answer questions naturally.

Examples:

What style is this?

Who might enjoy this artwork?

Where could it be displayed?

What inspired this design?

Avoid forcing keywords.

---

# Keyword Strategy

Use natural keyword variation.

Avoid repeating:

Digital artwork

Downloadable art

Anime art

Premium art

throughout every paragraph.

Rotate vocabulary naturally.

---

# Product Naming

Artwork titles should remain:

Creative

Memorable

Readable

Unique

Never generate titles that sound like stock photo filenames.

---

# Image Optimization

Every image should include:

Meaningful filename.

Meaningful ALT text.

Optional caption.

Never use:

image1

banner-final

photo2

artwork123

---

# ALT Text Rules

ALT text should describe:

Artwork

Style

Composition

Main subject

Do not stuff keywords.

---

# Decorative Images

Decorative graphics should use empty ALT attributes when appropriate.

---

# CTA Standards

Every CTA should match the customer's stage.

Discovery Stage:

Explore Collections

Browse Artwork

Discover New Releases

Comparison Stage:

View Details

Compare Options

See Similar Artwork

Purchase Stage:

Add to Cart

Choose Resolution

Purchase Artwork

Collection Stage:

Continue Browsing

Build Your Collection

Avoid repeating identical CTAs.

---

# Button Standards

Buttons should clearly communicate actions.

Avoid:

Click Here

Go

Continue

Use action-specific wording.

---

# Microcopy Standards

Microcopy includes:

Search placeholders

Filter labels

Tooltip text

Button descriptions

Form hints

Every piece should be helpful.

Avoid robotic wording.

---

# Form Standards

Every form should include:

Clear labels.

Helpful placeholders.

Friendly validation.

Logical field order.

Avoid unnecessary fields.

---

# Placeholder Rules

Avoid placeholders such as:

Enter text

Type here

Input

Instead provide meaningful examples where appropriate.

---

# Accessibility Philosophy

Every page should be usable by everyone.

Prioritize:

Readability.

Logical structure.

Simple language.

Clear navigation.

Avoid:

Ambiguous instructions.

Complex wording.

Hidden context.

---

# Reading Experience

Paragraphs should remain easy to scan.

Mix:

Short paragraphs.

Medium paragraphs.

Lists.

Highlights.

Avoid walls of text.

---

# Typography Guidance

Headings should remain concise.

Avoid extremely long headings.

Descriptions should be broken into readable sections.

---

# Mobile Experience

Content should remain readable on smaller screens.

Avoid oversized paragraphs.

Avoid overly complex layouts.

---

# Desktop Experience

Use spacing effectively.

Create visual rhythm.

Balance artwork with text.

---

# Accessibility Labels

Interactive elements should include meaningful labels.

Buttons should describe their actions.

Icons should not replace text without context.

---

# Font Awesome Rules

Never use emojis.

Always replace emojis with Font Awesome icons.

Examples:

fa-palette

fa-image

fa-brush

fa-star

fa-heart

fa-cart-shopping

fa-download

fa-layer-group

fa-location-dot

fa-phone

fa-envelope

fa-circle-info

fa-arrow-right

Maintain one consistent icon family throughout the website.

Never mix icon libraries.

---

# Color Descriptions

When describing artwork:

Avoid repeatedly using:

Beautiful

Amazing

Stunning

Instead describe:

Contrast

Harmony

Depth

Warmth

Cool tones

Saturation

Lighting

Texture

Visual balance

---

# Artistic Vocabulary

Rotate vocabulary naturally.

Examples:

Illustration

Composition

Artwork

Creative piece

Visual design

Digital creation

Artistic work

Collection piece

Avoid repeating one word excessively.

---

# Category Consistency

Every category should develop its own vocabulary.

Anime should not sound like Pixel Art.

Pixel Art should not sound like Street Art.

Traditional Japanese should not sound like Abstract Art.

Each category deserves a unique writing style.

---

# Marketplace Consistency

Every page should feel like it belongs to the same premium brand.

Maintain consistency in:

Tone.

Vocabulary.

Navigation.

Buttons.

Translation keys.

Metadata.

Visual language.

---

# Company Information

Whenever company information is required use placeholders.

Examples:

[Company Name]

[Company Email]

[Company Phone]

[Company Address]

Website:

InkWave

Never invent business information.

---

# Copyright Standard

Always use:

© {Current Year} {Company Name}. All Rights Reserved.

Do not customize this wording.

---

# Newsletter Standard

Newsletter success message must always be:

Thanks for subscribing.

Do not generate alternatives.

---

# Navigation QA

Before completing every page verify:

Every CTA works.

Every link exists.

Every breadcrumb is correct.

No broken routes.

No placeholder URLs.

No dead pages.

Flag navigation issues immediately.

---

# Marketplace Quality Standards

Every page should:

Encourage exploration.

Feel curated.

Remain visually balanced.

Support purchasing decisions.

Reflect premium branding.

Avoid clutter.

Avoid repetitive messaging.

---

# Final SEO & Accessibility Checklist

Before completing any page verify:

✓ Unique page title.

✓ Unique meta description.

✓ Unique headings.

✓ Natural keyword usage.

✓ Meaningful ALT text.

✓ Proper heading hierarchy.

✓ Helpful CTAs.

✓ Readable paragraphs.

✓ Mobile-friendly copy.

✓ Desktop-friendly layout.

✓ Accessibility considered.

✓ Font Awesome icons used.

✓ No emojis remain.

✓ Internal links reviewed.

✓ Metadata updated.

✓ Translation keys applied.

✓ Premium brand consistency maintained.

✓ No duplicate wording exists anywhere on the page.
# Content Enhancement & Structural Improvement Rules

---

# Improve, Don't Just Replace

When rewriting a page, do not limit yourself to replacing existing text.

If the page would benefit from additional content, you are encouraged to introduce new sections that improve clarity, usability, storytelling, or conversion, provided they align with the overall design and user experience.

Never add unnecessary content simply to increase page length.

Every new section must serve a clear purpose.

---

# Content Expansion

If an existing section is too short or lacks useful information, expand it naturally.

You may:

* Add additional paragraphs.
* Add supporting explanations.
* Introduce practical examples.
* Explain concepts in greater depth.
* Improve readability through better structure.

The goal is to create a richer and more valuable experience without overwhelming the reader.

---

# New Headings

If a page feels incomplete, you may introduce new headings that better organize the content.

Examples include:

* Artistic Inspiration
* Collection Overview
* Why You'll Love This Artwork
* Display Suggestions
* Creative Process
* Frequently Asked Questions
* Related Collections
* Digital Download Information
* License Overview

Only introduce headings when they genuinely improve the page.

---

# Content Hierarchy

You are encouraged to reorganize content into a more logical flow.

You may:

* Merge repetitive sections.
* Split large paragraphs into smaller sections.
* Introduce subheadings.
* Convert long paragraphs into feature lists.
* Reorder sections for better readability.

Never preserve a poor content structure simply because it already exists.

---

# Paragraph Variety

Avoid making every paragraph the same length.

Mix:

* One-sentence introductions.
* Medium-length explanations.
* Longer storytelling sections.
* Feature lists.
* Bullet lists.
* Highlight boxes.

This creates a more engaging reading experience.

---

# Structural Improvements

When appropriate, you may replace:

Long text blocks

with

* Cards
* Bullet points
* Numbered steps
* Feature grids
* Comparison sections
* Timeline layouts
* FAQ sections

Always prioritize readability.

---

# Content Density

Every page should contain enough information to answer a visitor's questions.

Do not make pages artificially short.

Likewise, do not add unnecessary filler.

Aim for balanced, informative content.

---

# Creative Freedom

You are allowed to improve the content structure beyond the original implementation.

Examples include:

* Adding a new introduction.
* Adding a concluding section.
* Adding a "Why Choose This Collection" section.
* Adding "Perfect For" suggestions.
* Adding artwork styling recommendations.
* Adding display environment suggestions.
* Adding related collection highlights.

Only introduce new sections if they enhance the customer experience.

---

# Section Independence

Every section should communicate a unique idea.

Avoid creating multiple sections that explain the same benefit in different words.

Each heading should provide new value.

---

# Information Completeness

When reviewing a page, ask yourself:

* Would a first-time visitor understand this page?
* Are any important questions unanswered?
* Would additional information improve confidence?
* Does the page guide the customer naturally?

If the answer is yes, improve the content accordingly.

---

# Content Flexibility

Do not feel constrained by the original layout.

You may:

* Add new headings.
* Add additional paragraphs.
* Expand explanations.
* Improve section ordering.
* Introduce supporting content.
* Simplify overly complex sections.

As long as functionality and business logic remain unchanged.

---

# Final Review

Before completing a page, verify:

✓ Every section provides value.

✓ Content is complete without unnecessary filler.

✓ Additional headings have been introduced where beneficial.

✓ Paragraphs have appropriate variety.

✓ Information flows logically.

✓ The rewritten page is substantially better than the original in both content quality and structure.

Remember:

The objective is **not simply to replace text**.

The objective is to create the best possible version of the page while preserving its functionality and purpose.
