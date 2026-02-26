---
theme: nmt
background: https://cover.sli.dev
title: Session 01 - PHP Fundamentals & Intro MVC
class: text-left
drawings:
  persist: false
transition: fade
mdc: true
duration: 35min
---

# Session 04: Authentication in APIs

## SaaS 2 – REST API Development

### How to Implement API Authentication in Laravel 

<div @click="$slidev.nav.next" class="mt-12 -mx-4 p-4" hover:bg="white op-10">
<p>Press <kbd>Space</kbd> or <kbd>RIGHT</kbd> for next slide/step <fa7-solid-arrow-right /></p>
</div>

<div class="abs-br m-6 text-xl">
  <a href="https://github.com/adygcode/SaaS-FED-Notes" target="_blank" class="slidev-icon-btn">
    <fa7-brands-github class="text-zinc-300 text-3xl -mr-2"/>
  </a>
</div>


<!--
The last comment block of each slide will be treated as slide notes. It will be visible and editable in Presenter Mode along with the slide. [Read more in the docs](https://sli.dev/guide/syntax.html#notes)
-->


---
layout: default
level: 2
---


# Navigating Slides

Hover over the bottom-left corner to see the navigation's controls panel.

## Keyboard Shortcuts

|                                                     |                             |
| --------------------------------------------------- | --------------------------- |
| <kbd>right</kbd> / <kbd>space</kbd>                 | next animation or slide     |
| <kbd>left</kbd>  / <kbd>shift</kbd><kbd>space</kbd> | previous animation or slide |
| <kbd>up</kbd>                                       | previous slide              |
| <kbd>down</kbd>                                     | next slide                  |


---
layout: section
---

# Objectives


---
layout: two-cols
level: 1
class: text-left
---

# Objectives

::left::

- Explain what CORS is and when preflight (OPTIONS) happens.
- Distinguish simple vs non‑simple requests.
- Define origin and explain the Same‑Origin Policy (SOP).
- Why browsers block cross‑origin reads.

::right::

- Configure Laravel v12 CORS (global middleware + config/cors.php) to allow specific origins/methods/headers.
- Test CORS via Pest testing.
- Implement OPTIONS handling and test failures → success with Postman & browser.


---
level: 2
---

# Contents 

<Toc minDepth="1" maxDepth="1" />

---
class: text-left
layout: section
---

# Warm up!

## Two Truths and One Lie

---
level: 2
---

# Two Truths, One Lie (Set 1)

In small groups you will identify the lie in a set of statements about CORS


<Announcement type="brainstorm">
<ol>
<li>CORS is a browser security feature designed to prevent websites from making unauthorized cross‑origin requests.</li>
<li>CORS must always be configured on the frontend; the backend plays no role in CORS.</li>
<li>CORS can allow or block requests based on the request's origin.</li>
</ol>
</Announcement>

<!--
CORS is a browser security feature designed to prevent websites from making unauthorized cross‑origin requests. ✔️ Truth
CORS must always be configured on the frontend; the backend plays no role in CORS. ❌ Lie
CORS can allow or block requests based on the request's origin. ✔️ Truth
-->


---
level: 2
---

# Two Truths, One Lie (Set 2)

In small groups you will identify the lie in a set of statements about CORS


<Announcement type="brainstorm">
<ol>
<li>The Access-Control-Allow-Origin header determines which origins are permitted to access a resource.</li>
<li>A preflight request uses the HTTP OPTIONS method to check permissions before sending certain types of requests.</li>
<li>The Access-Control-Allow-Cookies header is required to send cookies with cross‑origin requests.</li>
</ol>
</Announcement>

<!--
The Access-Control-Allow-Origin header determines which origins are permitted to access a resource. ✔️ Truth
A preflight request uses the HTTP OPTIONS method to check permissions before sending certain types of requests. ✔️ Truth
The Access-Control-Allow-Cookies header is required to send cookies with cross‑origin requests. ❌ Lie
(The real header is Access-Control-Allow-Credentials.)

-->


---
level: 2
---

# Two Truths, One Lie (Set 3)

In small groups you will identify the lie in a set of statements about CORS


<Announcement type="brainstorm">
<ol>
<li>CORS errors occur in the browser, even if the server is misconfigured.</li>
<li>Disabling CORS in your browser permanently fixes CORS issues in production.</li>
<li>CORS is not relevant for server‑to‑server communication unless one server emulates a browser environment.</li>
</ol>
</Announcement>

<!--
CORS errors occur in the browser, even if the server is misconfigured. ✔️ Truth
Disabling CORS in your browser permanently fixes CORS issues in production. ❌ Lie
CORS is not relevant for server‑to‑server communication unless one server emulates a browser environment. ✔️ Truth
-->


---







---


# Recap Checklist

- [ ] 
- [ ] 
- [ ] 
- [ ] 
- [ ] 

---
level: 2
---

# Exit Ticket

> Pose a question about the content


---

# Acknowledgements

- Fu, A. (2020). Slidev. Sli.dev. https://sli.dev/
- Font Awesome. (2026). Font Awesome. Fontawesome.com; Font Awesome. https://fontawesome.com/
- Mermaid Chart. (2026). Mermaid.ai. https://mermaid.ai/

> Slide template by Adrian Gould

<br>

> - Mermaid syntax used for some diagrams
> - Some content was generated with the assistance of Microsoft CoPilot
