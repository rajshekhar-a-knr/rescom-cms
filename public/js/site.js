const showSwalAlerts = () => {
  if (!window.Swal) return;
  const alerts = document.querySelectorAll('.alert');
  if (!alerts.length) return;

  alerts.forEach((a) => {
    let type = 'info';
    if (a.classList.contains('alert-success')) type = 'success';
    if (a.classList.contains('alert-error')) type = 'error';
    if (a.classList.contains('alert-warning')) type = 'warning';
    if (a.classList.contains('alert-info')) type = 'info';

    const text = a.innerText.replace(/\s+/g, ' ').trim();
    Swal.fire({
      icon: type,
      title: type.charAt(0).toUpperCase() + type.slice(1),
      text,
      timer: 3000,
      showConfirmButton: false
    });

    a.remove();
  });
};

document.addEventListener('DOMContentLoaded', () => {
  showSwalAlerts();
  initLightbox();
});

window.showSwalAlerts = showSwalAlerts;

const initLightbox = () => {
  const lightbox = document.getElementById('lightbox');
  if (!lightbox) return;
  const imgEl = lightbox.querySelector('.lightbox-image');
  const captionEl = lightbox.querySelector('.lightbox-caption');
  const closeEls = lightbox.querySelectorAll('[data-lightbox-close]');
  const prevBtn = lightbox.querySelector('[data-lightbox-prev]');
  const nextBtn = lightbox.querySelector('[data-lightbox-next]');

  let items = [];
  let currentIndex = 0;

  const collectItems = (group) => {
    const all = Array.from(document.querySelectorAll('.lightbox-item'));
    items = all.filter((el) => (el.getAttribute('data-lightbox-group') || 'default') === group);
  };

  const openAt = (index) => {
    if (!items.length) return;
    currentIndex = (index + items.length) % items.length;
    const link = items[currentIndex];
    const img = link.querySelector('img');
    const src = link.getAttribute('href') || (img ? img.getAttribute('src') : '');
    const caption = img ? (img.getAttribute('alt') || '') : '';
    imgEl.src = src || '';
    imgEl.alt = caption;
    captionEl.textContent = caption;
    lightbox.classList.add('open');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };

  const close = () => {
    lightbox.classList.remove('open');
    lightbox.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    imgEl.src = '';
  };

  const next = () => openAt(currentIndex + 1);
  const prev = () => openAt(currentIndex - 1);

  document.querySelectorAll('.lightbox-item').forEach((link) => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const group = link.getAttribute('data-lightbox-group') || 'default';
      collectItems(group);
      openAt(items.indexOf(link));
    });
  });

  closeEls.forEach((btn) => btn.addEventListener('click', close));
  if (nextBtn) nextBtn.addEventListener('click', next);
  if (prevBtn) prevBtn.addEventListener('click', prev);

  document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('open')) return;
    if (e.key === 'Escape') close();
    if (e.key === 'ArrowRight') next();
    if (e.key === 'ArrowLeft') prev();
  });
};
