// Progressive enhancements: header elevation on scroll and current-section highlighting in the primary nav. The page is fully usable without this file.
// Loaded as a classic deferred script rather than a module so the page also works when opened directly from the filesystem (file://).
(() => {
  const header = document.querySelector('.site-header');
  const links = [...document.querySelectorAll('.site-nav a[href^="#"]')];
  const sections = links.map((link) => document.querySelector(link.hash));

  if (!header || sections.includes(null)) return;

  let frameRequested = false;

  function update() {
    frameRequested = false;

    const { scrollY, innerHeight } = window;
    header.classList.toggle('is-scrolled', scrollY > 0);

    // A section is current once its top passes a line ~35% down the viewport; at the very bottom of the page, the last section wins.
    const atBottom = innerHeight + scrollY >= document.documentElement.scrollHeight - 2;
    const marker = innerHeight * 0.35;
    const current = atBottom
      ? sections.length - 1
      : sections.findLastIndex((section) => section.getBoundingClientRect().top <= marker);

    links.forEach((link, index) => {
      if (index === current) {
        link.setAttribute('aria-current', 'location');
      } else {
        link.removeAttribute('aria-current');
      }
    });
  }

  function requestUpdate() {
    if (frameRequested) return;
    frameRequested = true;
    requestAnimationFrame(update);
  }

  window.addEventListener('scroll', requestUpdate, { passive: true });
  window.addEventListener('resize', requestUpdate);
  update();
})();
