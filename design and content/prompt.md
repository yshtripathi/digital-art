# [Website Name] — Google Flow Prompts (Images & Videos)

Ready-to-paste prompts for **Google Flow** (Imagen for images, Veo for videos) for every photo, illustration
and video used on the **Homepage** and **About Us** page, plus the database images those pages show
(category tiles and course cards).

Everything is **subject-neutral**, so the same media works for **any e-learning platform** — art, digital art,
general courses, stock market & finance, computer & coding, languages, music, business. Each slot gives:

- **Photo prompt** — realistic editorial style (default).
- **Illustration prompt** — flat/3D-style illustration in the brand colours (use when you want a softer,
  more playful look, or when a platform has no real-people photography).
- **Niche add-on** — one sentence to append if a platform wants a subject hint (art, digital art, stocks, coding).
- **Flow settings** — model, aspect ratio to generate in Flow, and how to crop/export for the site.

---

## 0. How to use these prompts in Google Flow

### 0.1 Prompt structure (Flow / Veo / Imagen understand natural language best)
Every prompt below is written in this order, as one flowing paragraph:

> **Shot & style** → **Subject** (who they are, look, clothing) → **Action** → **Setting** → **Lighting & colour**
> → **Camera** (lens, framing, movement) → **Mood** → **Audio** (videos only) → **Constraints** ("no text…")

Flow has no reliable separate negative-prompt box, so every prompt ends with a short **"Avoid:"** sentence.
Keep it in.

### 0.2 Aspect ratios — generate, then crop
Flow only generates a few aspect ratios. Generate in the ratio listed under **Flow settings**, then crop to the
**Deliver** size. Every prompt already keeps the subject inside the crop-safe area.

| Site needs | Generate in Flow | Crop / resize |
|---|---|---|
| 4:5 portrait (hero video) | **9:16** | Crop top and bottom to 4:5, keep centre |
| 2:3 portrait (About photo) | **9:16** (image) or **3:4** | Crop to 2:3, keep upper-centre |
| 3:2 landscape | **16:9** | Crop sides slightly to 3:2 |
| 2:1 landscape | **16:9** | Crop top and bottom to 2:1 |
| 8:3 wide banner | **16:9** | Crop top and bottom to 8:3, keep centre |
| 4:3 cards | **4:3** | Resize only |
| 1:1 square | **1:1** | Resize only |
| 16:9 video | **16:9** | Resize only |

### 0.3 Keeping the same person across images and videos (optional)
1. Generate the photo/illustration first with **Imagen**.
2. Save it to your Flow project and add it as an **Ingredient** (or use **Frames to Video** with it as the
   start frame) — Veo will keep the same person, outfit and setting in the video.
3. For a **seamless loop**, use **Frames to Video** with the **same image as the first and last frame**.
4. Use **Extend** only if the clip needs to be longer than 8 seconds (the site needs 8 s, so usually not).

### 0.4 Rules included in every prompt
- **No text:** no words, letters, numbers, logos, watermarks, subtitles or UI labels. Screens show only a
  generic online-lesson layout of soft blurred shapes (a video rectangle, a play-button circle, a progress bar).
  Notebooks, sketchbooks and boards are blank or show abstract lines only.
- **People:** adults (20–55) of **Japanese or Southeast Asian** appearance (Japanese, Thai, Vietnamese,
  Filipino, Malaysian, Indonesian, Singaporean), mixed genders and ages, natural expressions, correct hands.
- **Neutral props only** in the default prompts: laptop, tablet, smartphone, earbuds/headphones, blank notebook,
  pen, plain books, mug, plant, desk lamp, backpack. No charts, code, paint, suits, trophies or graduation caps.
- **Clothing:** relaxed smart-casual (knitwear, cardigans, plain tees, overshirts) in off-white, beige, grey, navy.
- **Brand colours as small accents:** cobalt blue `#2665d6`, lime green `#d2e823`, saffron `#d6a337`,
  maroon `#780016`, midnight ink `#1e2330`, bone white `#f3f3f1`.
- **Videos:** the site plays them **muted**, so ask Veo for **no dialogue and no music** (quiet room tone is fine);
  the audio track is removed on export anyway.

### 0.5 Illustration style (use for every "Illustration prompt")
> Modern flat editorial illustration with subtle soft 3D shading, clean rounded shapes, gentle grain texture,
> limited palette of bone white, midnight ink, cobalt blue, lime green, saffron and soft maroon, simple
> stylised adult characters of Japanese or Southeast Asian appearance with natural proportions, minimal facial
> detail, calm friendly expressions, uncluttered background, lots of soft negative space, no outlines heavier
> than 2px, no text, no letters, no numbers, no logos.

For **animated illustration videos**, add: *"smooth 2D motion-graphics animation, gentle looping movement,
soft easing, no camera shake"*.

### 0.6 Niche add-ons (append to any prompt)
| Platform | Append this sentence |
|---|---|
| Art | *Add a sketchbook with loose abstract pencil strokes and a few pencils on the table.* |
| Digital art | *Add a tablet with a stylus showing soft abstract colour swatches and brush strokes.* |
| Stocks & finance | *The screen shows soft abstract upward line shapes in blue and green, with no numbers or tickers.* |
| Computer & coding | *The screen shows soft blurred coloured horizontal bars like an editor, with no characters.* |
| Languages | *Add headphones and a tablet showing a blurred video-call style lesson.* |
| Music | *Add a small keyboard or acoustic guitar softly out of focus in the background.* |

### 0.7 Export for the website
| Type | Export | Target size |
|---|---|---|
| Photos / illustrations | WebP, quality 75–80, sRGB, at the **Deliver** size | as listed per slot |
| Videos | WebM (VP9), **audio removed**, 30 fps, at the **Deliver** size | ≤ 2 MB |
| Video posters | WebP frame from ~1 s | ≤ 30 KB |

```bash
# Image → crop/resize → WebP (example: 16:9 → 1200×800)
ffmpeg -i flow_image.png -vf "scale=1200:-2,crop=1200:800" -c:v libwebp -quality 78 how-it-works.webp

# Veo video (9:16 MP4) → 4:5, 1080×1350, no audio, WebM
ffmpeg -i flow_video.mp4 -an -vf "scale=1080:-2,crop=1080:1350,fps=30" -c:v libvpx-vp9 -b:v 0 -crf 34 -row-mt 1 hero.webm

# Veo video (16:9 MP4) → 1920×1080, no audio, WebM
ffmpeg -i flow_video.mp4 -an -vf "scale=1920:1080,fps=30" -c:v libvpx-vp9 -b:v 0 -crf 34 -row-mt 1 inspire.webm

# Poster frame
ffmpeg -ss 1 -i hero.webm -frames:v 1 -vf scale=720:-2 -c:v libwebp -quality 75 hero-poster.webp
```

---

## 1. HOMEPAGE

### 1.1 Hero video — a learner starting an online lesson

| | |
|---|---|
| **Replaces** | `public/assets/videos/hero.webm` + poster `public/assets/images/home/hero-poster.webp` (720×900) |
| **Deliver** | **1080×1350 (4:5)**, 8 s, seamless loop, muted, WebM ≤ 2 MB |
| **On page** | Rounded 4:5 frame with a white border (max 420 px wide) on a lime background |
| **Safe zones** | Play button **bottom-right**; floating pills overlap the **left edge (20% & 90% height)** and **right edge (50% height)** → keep face and hands in the **centre 60%** |
| **Flow settings** | **Veo**, **9:16**, 8 s · for a perfect loop: make the start image with Imagen (9:16), then **Frames to Video** with it as first **and** last frame |

**Photo prompt (Veo)**
```
A vertical cinematic lifestyle shot in soft natural light. A Japanese woman in her mid-20s with
shoulder-length dark hair, wearing an off-white knit sweater and small wireless earbuds, sits at a light oak
desk beside a large bright window in a calm modern apartment. She watches an online video lesson on her
laptop, then looks down and writes a few lines in a blank notebook, glances back at the screen and gives a
small, happy nod of understanding. A lime green ceramic mug and a small green plant sit on the desk. The
laptop screen shows only a soft blurred video rectangle, a round play button and a thin progress bar. Warm,
clean morning daylight, gentle shadows, true-to-life skin tones. Shot on a 50mm lens with shallow depth of
field, subject centered and framed from the waist up, the camera slowly pushes in a tiny amount. Calm,
focused, optimistic mood. Audio: quiet room tone only, no dialogue, no music. Avoid: any text, letters or
numbers on screens or objects, logos, watermarks, charts, code, extra fingers, fast movement, cuts.
```

**Illustration prompt (Veo, animated)**
```
A smooth looping 2D motion-graphics animation in a modern flat editorial illustration style with soft 3D
shading. A stylised young Japanese woman with dark bob hair in an off-white sweater sits at a simple wooden
desk by a big window, watching a lesson on a laptop; soft rounded shapes on the screen gently pulse, she
writes in a notebook and small lime and cobalt circles float upward like ideas, then she smiles and nods.
Limited palette of bone white, midnight ink, cobalt blue, lime green and saffron, plant and mug on the desk,
uncluttered background with soft negative space. Vertical framing, character centered, gentle easing, no
camera shake. Audio: no dialogue, no music. Avoid: any text, letters, numbers, logos.
```

**Niche add-on:** append a sentence from **0.6** (e.g. *digital art* → she draws on a tablet with a stylus).

---

### 1.2 How it works — making progress at a desk

| | |
|---|---|
| **Replaces** | `public/assets/images/home/how-it-works.webp` |
| **Deliver** | **1200×800 (3:2)**, WebP ≤ 60 KB |
| **On page** | Left half of a dark card, cover-cropped, focal point **60% across / 50% down**, min-height 460 px |
| **Safe zones** | Lime badge **bottom-left** → keep the bottom-left corner simple |
| **Flow settings** | **Imagen**, **16:9** → crop sides to 3:2 |

**Photo prompt (Imagen)**
```
A realistic editorial lifestyle photograph in a bright modern study lounge. A Vietnamese man in his early
30s wearing a soft grey overshirt, with headphones resting around his neck, sits at a light wood desk and
looks at a large monitor showing a generic online-course page made only of soft blurred rounded shapes, a
video rectangle and a long progress bar that is almost full. He leans back slightly with a calm, satisfied
smile, holding a pen above a blank notebook; a cobalt blue notebook and a potted plant are on the desk.
Large window light from the left, white walls, warm neutral colours. 35mm lens, shallow depth of field,
the man placed slightly right of center, the bottom-left of the frame kept clean and simple. Calm sense of
achievement. Avoid: any text, letters or numbers on the screen or objects, logos, charts, code, suits,
extra fingers, clutter.
```

**Illustration prompt (Imagen)**
```
A modern flat editorial illustration with subtle soft 3D shading and gentle grain. A stylised Vietnamese man
in a grey overshirt sits at a wooden desk in front of a large monitor showing simple rounded shapes and a
lime green progress bar nearly complete; he leans back with a relaxed smile, notebook and plant beside him,
small floating check-mark circles and stars in cobalt and lime drift around the screen. Palette of bone
white, midnight ink, cobalt blue, lime green and saffron, clean background with soft negative space,
character slightly right of center, bottom-left area empty. Avoid: any text, letters, numbers, logos.
```

---

### 1.3 Credits card — an online study setup from above

| | |
|---|---|
| **Replaces** | `public/assets/images/home/credits.webp` |
| **Deliver** | **800×800 (1:1)**, WebP ≤ 70 KB |
| **On page** | Top of a saffron card, only a **wide middle band (≈2.2:1)** is visible |
| **Safe zones** | Coin badge **bottom-right** → keep key objects in the **middle horizontal third** |
| **Flow settings** | **Imagen**, **1:1** |

**Photo prompt (Imagen)**
```
A realistic top-down flat-lay photograph on a light oak desk in soft diffused daylight. An open laptop shows
a generic video-lesson layout made of a blurred rectangle, a round play button and a thin progress bar;
around it lie a blank notebook with a pen, wireless earbuds in their open case, a smartphone face-down, a
saffron yellow ceramic cup of tea and a small lime green sticky note with nothing written on it. The hands of
a Thai woman in a beige cardigan rest lightly on the keyboard. All objects are arranged in a neat horizontal
band across the middle of the square frame, with plain wood above and below. Gentle shadows, warm neutral
colours, crisp detail. Avoid: any text, letters or numbers, logos, brand marks, charts, code, extra fingers.
```

**Illustration prompt (Imagen)**
```
A flat isometric-style editorial illustration with soft 3D shading, seen from above: a wooden desk with an
open laptop showing rounded shapes and a play button, a notebook and pen, earbuds, a saffron mug and a stack
of three gold coins with a small lime sparkle, all arranged in a tidy horizontal row across the middle of a
square canvas. Palette of bone white, midnight ink, cobalt blue, lime green and saffron, soft shadows, clean
empty space above and below the objects. Avoid: any text, letters, numbers, currency symbols, logos.
```

---

### 1.4 Final call to action — ready to start

| | |
|---|---|
| **Replaces** | `public/assets/images/home/start-today.webp` |
| **Deliver** | **1200×600 (2:1)**, WebP ≤ 50 KB |
| **On page** | Right half of a maroon card, cover-cropped, focal point **70% across / 50% down** |
| **Safe zones** | Keep the person in the **right half** of the frame |
| **Flow settings** | **Imagen**, **16:9** → crop top and bottom to 2:1 |

**Photo prompt (Imagen)**
```
A realistic wide editorial lifestyle photograph in a bright minimalist living room. A Filipino woman in her
late 20s with a low ponytail, wearing a cream knit top and wireless earbuds, sits cross-legged on a light
sofa with a laptop on her lap, the screen facing away from the camera, and looks at it with an excited,
confident smile as if she has just started a new online course. She is placed in the right third of the
frame, with soft open space on the left. Large window with sheer curtains, soft afternoon light, light wood
floor, a green plant and a maroon cushion. 50mm lens, shallow depth of field, warm natural colours. Avoid:
any text, letters or numbers, logos, charts, code, visible screen content, extra fingers.
```

**Illustration prompt (Imagen)**
```
A modern flat editorial illustration with subtle 3D shading. A stylised Filipino woman with a low ponytail
sits happily on a rounded sofa with a laptop on her lap, small lime and cobalt spark shapes bursting from
the screen, a plant and a maroon cushion beside her, big soft window in the background. Character placed in
the right third of a wide canvas with calm negative space on the left. Palette of bone white, midnight ink,
cobalt blue, lime green, saffron and maroon. Avoid: any text, letters, numbers, logos.
```

---

### 1.5 Category tiles — one per category (subject-specific)

| | |
|---|---|
| **Replaces** | `public/storage/photos/category/{id}.webp` |
| **Deliver** | **1200×896 (≈4:3)**, WebP ≤ 60 KB |
| **On page** | Tile image (150 px tall, ≈3:2 centre crop) and category page banner |
| **Safe zones** | Keep the subject **centered** |
| **Flow settings** | **Imagen**, **4:3** |

These show each platform's own subjects, so here the subject **should** be visible.

**Template (fill in the blanks)**
```
A realistic editorial lifestyle photograph for an online-learning category about {SUBJECT}. {SCENE}.
Adults of Japanese or Southeast Asian appearance in relaxed smart-casual clothes of off-white, beige, grey
and navy. Bright modern space, soft natural daylight, warm neutral colours, 35mm lens, shallow depth of
field, subject centered with a clean background. Avoid: any text, letters, numbers, logos, readable screens,
book titles, extra fingers.
```
*Illustration version:* replace the first sentence with **"A modern flat editorial illustration with soft 3D
shading and gentle grain, in a palette of bone white, midnight ink, cobalt blue, lime green and saffron,"**.

| Platform | `{SUBJECT}` | `{SCENE}` |
|---|---|---|
| Art | Drawing & sketching | A Japanese woman sketching loose abstract shapes in a large sketchbook at a sunlit table |
| Art | Painting | A Thai man painting soft abstract colour fields on a small canvas by a window |
| Art | Crafts & ceramics | Hands of a Vietnamese woman shaping clay on a pottery wheel in a bright studio |
| Digital art | Illustration | A Filipino woman drawing colourful abstract shapes on a tablet with a stylus |
| Digital art | 3D & motion | An Indonesian man at a wide monitor of soft glowing abstract 3D shapes |
| Digital art | Photography | A Malaysian woman holding a mirrorless camera, reviewing blurred colourful thumbnails on a laptop |
| Stocks & finance | Investing basics | A Singaporean man watching soft abstract rising line shapes on a monitor, notebook with arrows |
| Stocks & finance | Personal finance | A Japanese couple reviewing a tablet of abstract coloured blocks at a kitchen table |
| Computer & coding | Web development | A Thai woman typing on a laptop showing soft coloured horizontal bars |
| Computer & coding | Data & AI | An Indonesian man looking at a monitor of soft glowing connected dots |
| General | Languages | A Japanese man with headphones in a video-call style lesson, smiling |
| General | Business | Three colleagues around a table with blank sticky notes and a laptop |
| General | Personal growth | A Malaysian woman journaling in a blank notebook in a calm café |
| General | Music | A Vietnamese man with headphones practising on a small keyboard |

---

### 1.6 Course card photos — one per course (subject-specific)

| | |
|---|---|
| **Replaces** | `public/storage/photos/products/{id}.webp` |
| **Deliver** | **1200×896 (≈4:3)**, WebP ≤ 60 KB |
| **On page** | Course cards (16:10), course detail gallery (16:9) and course banner |
| **Safe zones** | Category pill **top-left**, level badge **bottom-left** → keep those corners simple |
| **Flow settings** | **Imagen**, **4:3** |

**Template**
```
A realistic editorial lifestyle photograph for an online course about {COURSE TOPIC}. {SCENE showing one
person or a small group actively learning or doing that topic}. Adults of Japanese or Southeast Asian
appearance in relaxed smart-casual clothes. Bright modern space, soft natural daylight, warm neutral colours,
35mm lens, shallow depth of field, subject centered or slightly right, top-left and bottom-left corners kept
clean. Avoid: rendering the course title, any text, letters, numbers, logos, readable screens, extra fingers.
```
*Illustration version:* same swap as in 1.5.

| Platform | Course topic | `{SCENE}` |
|---|---|---|
| Art | Portrait drawing | A Japanese woman sketching a simple abstract face outline, a plaster bust softly blurred behind |
| Art | Watercolour | Hands of a Thai man laying soft blue washes on textured paper |
| Digital art | Character illustration | A Filipino woman drawing abstract shapes on a tablet under a warm desk lamp |
| Digital art | UI design | A Malaysian man arranging rounded colour blocks on a large monitor |
| Stocks & finance | Stock market basics | A Singaporean woman at a laptop with soft abstract rising lines, taking notes |
| Stocks & finance | Portfolio planning | A Vietnamese man sorting blank cards into groups beside a tablet with coloured segments |
| Coding | Python programming | An Indonesian woman typing on a laptop with soft coloured bars, headphones on |
| Coding | Computer basics | A Japanese man in his 50s learning on a desktop computer with a friendly younger mentor |
| General | Communication skills | A Thai woman presenting to two seated colleagues in a bright room |
| General | Project planning | A Japanese woman arranging blank colour-coded cards into a timeline on a table |

---

## 2. ABOUT US PAGE

### 2.1 Page banner (About Us + inner pages)

| | |
|---|---|
| **Replaces** | `public/assets/images/breadcrumb.webp` (1600×600) + `breadcrumb-sm.webp` (800×300) |
| **Deliver** | **1600×600 (8:3)** + 800×300 copy, WebP ≤ 80 KB / 30 KB |
| **On page** | Right half of a cobalt banner, cover-cropped, focal point **50% across / 35% down** (desktop shows a near-square centre crop) |
| **Safe zones** | White pill **bottom-left** → keep the person in the **centre 40%** |
| **Flow settings** | **Imagen**, **16:9** → crop top and bottom to 8:3 |

**Photo prompt (Imagen)**
```
A realistic wide editorial photograph on a bright modern city plaza in soft morning sun. A young Japanese
woman with short dark wavy hair, wearing a camel coat over a grey knit top and carrying a canvas backpack,
smiles as she looks down at a tablet held in both hands, its screen facing away from the camera, as if
continuing an online lesson on the go. She stands exactly in the centre of the frame, framed from the waist
up, with modern buildings and trees softly blurred on both sides and a clear blue sky above. 50mm lens,
shallow depth of field, clean warm colours, optimistic mood. Avoid: any text, signs, letters, numbers,
logos, visible screen content, charts, code, extra fingers.
```

**Illustration prompt (Imagen)**
```
A modern flat editorial illustration with soft 3D shading. A stylised young Japanese woman with short wavy
hair, camel coat and backpack, walks through a simple city scene of rounded buildings and trees, smiling at a
tablet, with small lime and cobalt circles and a play-button shape floating above it. Character in the exact
centre of a wide canvas, calm empty space on both sides. Palette of bone white, midnight ink, cobalt blue,
lime green and saffron, soft sky gradient. Avoid: any text, letters, numbers, logos, signs.
```

---

### 2.2 Section 1 — "Learning that fits your life" (tall image)

| | |
|---|---|
| **Replaces** | `public/assets/images/about/learn-together.webp` (1200×1800) + `learn-together-sm.webp` (700×1050) |
| **Deliver** | **1200×1800 (2:3)** + 700×1050 copy, WebP ≤ 80 KB / 40 KB |
| **On page** | Right column, cover-cropped, focal point **50% across / 30% down**, min-height 560 px |
| **Safe zones** | Lime pill **bottom-left** (keep the bottom 20% simple); dashed ring over the **top-right corner** |
| **Flow settings** | **Imagen**, **9:16** → crop to 2:3 keeping the upper-centre |

**Photo prompt (Imagen)**
```
A realistic vertical editorial lifestyle photograph in a bright, plant-filled study lounge with large windows.
A Malaysian mentor in her late 30s wearing a navy cardigan sits beside a younger Japanese learner in his
mid-20s wearing an off-white sweater at a light wood table. She points at a tablet showing a generic online
lesson made of soft blurred shapes and a progress bar, while he listens and writes in a blank notebook; both
are engaged and smiling slightly in a warm moment of guided learning. Their faces sit in the upper third of
the frame, the table and hands in the middle, and the lower part of the frame is simple and uncluttered. A
cobalt blue notebook as a small accent. Soft daylight, 35mm lens, gentle background blur, warm neutral
colours. Avoid: any text, letters, numbers, logos, readable screens, charts, code, extra fingers.
```

**Illustration prompt (Imagen)**
```
A tall modern flat editorial illustration with subtle 3D shading and gentle grain. A stylised Malaysian
mentor in a navy cardigan and a young Japanese learner in an off-white sweater sit together at a wooden
table, she points at a tablet with rounded shapes while he writes in a notebook, soft lime and cobalt idea
bubbles float above them, tall plants and a big window behind. Faces in the upper third, simple empty floor
area in the lower fifth. Palette of bone white, midnight ink, cobalt blue, lime green and saffron. Avoid:
any text, letters, numbers, logos.
```

---

### 2.3 Section 3 — "Your learning journey" video (learning together)

| | |
|---|---|
| **Replaces** | `public/assets/videos/inspire.webm` + poster `public/assets/images/about/journey-poster.webp` (1280×720) |
| **Deliver** | **1920×1080 (16:9)**, 8 s, seamless loop, muted, WebM ≤ 2 MB |
| **On page** | Left column of a dark card; desktop shows a **near-square centre crop**, mobile shows full 16:9 |
| **Safe zones** | Play button **bottom-right** → keep all people in the **centre 50% of the width** |
| **Flow settings** | **Veo**, **16:9**, 8 s · for a loop use **Frames to Video** with the same start and end frame |

**Photo prompt (Veo)**
```
A cinematic lifestyle shot in a bright modern library lounge with soft window light. Three adults sit close
together around a small round table: a Thai woman in a beige top, a Japanese man in a navy overshirt and an
Indonesian woman in a light grey cardigan. They are learning together from a laptop and a tablet whose
screens show only a soft blurred video rectangle, a play button and a progress bar. The man points at the
tablet, the Thai woman leans in and nods, the Indonesian woman writes a quick note in a blank notebook, and
all three share a quiet smile of understanding. The group is tightly centered with soft plain background on
both sides. 35mm lens, shallow depth of field, the camera drifts very slowly to the right, natural subtle
movement, warm neutral colours. Audio: soft room tone only, no dialogue, no music. Avoid: any text, letters
or numbers on screens or objects, logos, charts, code, people entering or leaving the frame, cuts, extra
fingers.
```

**Illustration prompt (Veo, animated)**
```
A smooth looping 2D motion-graphics animation in a modern flat editorial illustration style with soft 3D
shading. Three stylised adults of Japanese and Southeast Asian appearance sit around a round table with a
laptop and a tablet; rounded shapes on the screens light up one after another, small lime, cobalt and
saffron circles connect between them like shared ideas, and they take turns nodding and smiling. Characters
grouped in the centre of a wide frame with calm empty space at the sides. Palette of bone white, midnight
ink, cobalt blue, lime green and saffron, gentle easing, no camera shake. Audio: no dialogue, no music.
Avoid: any text, letters, numbers, logos.
```

---

### 2.4 Section 4 — "Ready to start learning?" card image

| | |
|---|---|
| **Replaces** | `public/assets/images/about/start-learning.webp` |
| **Deliver** | **1000×1000 (1:1)**, WebP ≤ 40 KB |
| **On page** | Top of a cobalt card, cover-cropped to a **wide band (≈1.8:1)**, focal point **50% across / 30% down** |
| **Safe zones** | Keep the face in the **upper-middle band** |
| **Flow settings** | **Imagen**, **1:1** |

**Photo prompt (Imagen)**
```
A realistic square editorial lifestyle photograph in a bright modern library corridor with large windows and
plants. A cheerful Indonesian man in his late 20s wearing a light grey overshirt, wireless earbuds and a
canvas backpack with a small lime green strap detail walks forward holding a tablet under his arm, smiling
confidently toward the side as if heading off to start a new online course. Framed from the chest up with
his face in the upper middle of the frame, background softly blurred. Bright natural daylight, 50mm lens,
shallow depth of field, fresh warm colours. Avoid: any text, signs, letters, numbers, logos, visible screen
content, charts, code, extra fingers.
```

**Illustration prompt (Imagen)**
```
A square modern flat editorial illustration with soft 3D shading. A stylised Indonesian man with a backpack
and tablet strides forward with a confident smile, a lime green arrow shape and small cobalt sparkles leading
the way, simple rounded corridor with windows and plants behind. Face in the upper middle of the canvas,
wide calm space around. Palette of bone white, midnight ink, cobalt blue, lime green and saffron. Avoid: any
text, letters, numbers, logos, signs.
```

---

## 3. Delivery checklist

| # | File | Deliver | Flow | Type | Page |
|---|---|---|---|---|---|
| 1 | `assets/videos/hero.webm` + `images/home/hero-poster.webp` | 1080×1350 · 8 s (poster 720×900) | Veo 9:16 | Video | Home |
| 2 | `images/home/how-it-works.webp` | 1200×800 | Imagen 16:9 | Photo / illustration | Home |
| 3 | `images/home/credits.webp` | 800×800 | Imagen 1:1 | Photo / illustration | Home |
| 4 | `images/home/start-today.webp` | 1200×600 | Imagen 16:9 | Photo / illustration | Home |
| 5 | `storage/photos/category/{id}.webp` | 1200×896 each | Imagen 4:3 | Photo / illustration | Home, catalog |
| 6 | `storage/photos/products/{id}.webp` | 1200×896 each | Imagen 4:3 | Photo / illustration | Home, catalog, course |
| 7 | `images/breadcrumb.webp` + `breadcrumb-sm.webp` | 1600×600 / 800×300 | Imagen 16:9 | Photo / illustration | About + inner pages |
| 8 | `images/about/learn-together.webp` + `-sm.webp` | 1200×1800 / 700×1050 | Imagen 9:16 | Photo / illustration | About |
| 9 | `assets/videos/inspire.webm` + `images/about/journey-poster.webp` | 1920×1080 · 8 s (poster 1280×720) | Veo 16:9 | Video | About |
| 10 | `images/about/start-learning.webp` | 1000×1000 | Imagen 1:1 | Photo / illustration | About |

**Style tip:** pick **one style per page** — either all photos or all illustrations on the Homepage and About
Us — so each page looks consistent. Videos can be live-action even on an illustrated page, or animated to match.

### Final check before uploading
- [ ] Zoom to 100%: no text, letters, numbers or logos on screens, notebooks, clothes or signs.
- [ ] Universal media (1–4, 7–10) has no subject-specific props unless a niche add-on was used on purpose.
- [ ] People are adults of Japanese or Southeast Asian appearance; faces and hands look natural.
- [ ] The subject sits inside the safe zone after cropping.
- [ ] Videos loop smoothly, have the audio removed and are ≤ 2 MB.
- [ ] Files use the exact names and paths above, in WebP/WebM, within the size targets.
