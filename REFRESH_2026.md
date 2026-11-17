# Kouli.sh — 2026 portfolio refresh

This branch contains an intentionally small, static, single-page professional portfolio refresh.

## Preview

Open the HTML using a static-site preview service that serves the entire branch, including relative CSS and assets:

**https://raw.githack.com/jkoul/portfolio/2026-refresh/index.html**

The preview uses the `2026-refresh` branch. GitHub Pages for `kouli.sh` continues to publish from `master`; no DNS or GitHub Pages settings need to change. Do not merge until Jeremy approves.

## Implementation

- One semantic HTML page (`index.html`) with one new CSS file (`css/refresh-2026.css`).
- No JavaScript, framework, build step, backend, or browser-side tracking.
- Responsive typography and grids; visible keyboard focus; skip link; reduced-motion handling.
- Visible descriptions and links, not hover-only text or flippable cards.
- Five approved projects: DDP design system, Census platform, Census chart library/page, Investor.gov, Urban Institute 501(c)(4) research.

## Pending review and assets

- Census platform: the current treatment is temporary until the provided Ulster County screenshot is committed as an optimized image.
- Census Chart Page: the card needs Jeremy's representative chart screenshot and a verified link to the specific Chart Page.
- DDP design-system art: custom **conceptual composition**, not a screenshot of Storybook or the actual library. Replace if a real Storybook screenshot is preferred.
- Investor.gov: typographic treatment rather than an unverified screenshot.
- Current résumé PDF: **not included**. The former site's `images/resume.pdf` appears to be from the old site; do not link to it without replacing it.
- Exact role/contribution wording and links require final owner review.
- Automated cross-browser/assistive-tech testing has not been performed in a connected browser environment. Manual WCAG 2.2 AA verification is still needed before publication.

## Legacy code attribution

The repository retains its original TemplateMo Flex template files (including header attribution in `css/templatemo_style.css`). The replacement page does not import or reuse its Bootstrap/jQuery styling or scripting.
