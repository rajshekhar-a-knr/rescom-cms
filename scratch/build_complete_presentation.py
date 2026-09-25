# -*- coding: utf-8 -*-
import os
import glob
from styles_v2 import CSS_STYLES_V2

# Read all 28 slides
slides_html = []
for i in range(1, 29):
    slide_file = f"scratch/slides/slide_{i:02d}.html"
    if not os.path.exists(slide_file):
        raise FileNotFoundError(f"Missing slide: {slide_file}")
    with open(slide_file, "r", encoding="utf-8") as f:
        slides_html.append(f.read().strip())

# Deck metadata for the 28 slides in Overview Modal
deck_cards_data = [
    {"num": "01", "sec": "01 // KNR INTRODUCTION", "title": "About KNR: Global Technology & Capability Partner"},
    {"num": "02", "sec": "01 // KNR PORTFOLIO", "title": "Flagship Products & Full-Spectrum Technology Services"},
    {"num": "03", "sec": "PRODUCT 01 // LEAP", "title": "KNR-LEAP: Learners • Educators • Administrators • Parents"},
    {"num": "04", "sec": "PRODUCT 01 // LEAP", "title": "KNR-LEAP: Comprehensive 26 Core + 3 Add-on Capabilities"},
    {"num": "05", "sec": "PRODUCT 01 // LEAP", "title": "KNR-LEAP: Measurable Institutional Outcomes & Proven ROI"},
    {"num": "06", "sec": "PRODUCT 02 // EDXCORE", "title": "EDXcore: Learning Without Boundaries (Architecture)"},
    {"num": "07", "sec": "PRODUCT 02 // EDXCORE", "title": "EDXcore: 22 Core Enterprise Modules Matrix"},
    {"num": "08", "sec": "PRODUCT 02 // EDXCORE", "title": "EDXcore: The End-to-End Digital Learning Journey"},
    {"num": "09", "sec": "PRODUCT 02 // EDXCORE", "title": "EDXcore: Proven Enterprise Learning Scale & Integrity"},
    {"num": "10", "sec": "PRODUCT 03 // RELCORE", "title": "RELcore: Relationships That Drive Growth (CRM)"},
    {"num": "11", "sec": "PRODUCT 03 // RELCORE", "title": "RELcore: 19 Confirmed Enterprise Modules"},
    {"num": "12", "sec": "PRODUCT 03 // RELCORE", "title": "RELcore: End-to-End Commercial Growth Flow"},
    {"num": "13", "sec": "PRODUCT 03 // RELCORE", "title": "RELcore: Proven Commercial Impact & ROI"},
    {"num": "14", "sec": "PRODUCT 04 // WEBCORE", "title": "WEBcore: Your Digital Presence. Your Control. (CMS)"},
    {"num": "15", "sec": "PRODUCT 04 // WEBCORE", "title": "WEBcore: 13 Confirmed Enterprise Modules"},
    {"num": "16", "sec": "PRODUCT 04 // WEBCORE", "title": "WEBcore: The Enterprise Digital Publishing Cycle"},
    {"num": "17", "sec": "PRODUCT 04 // WEBCORE", "title": "WEBcore: Proven Digital Governance Impact & ROI"},
    {"num": "18", "sec": "PRODUCT 05 // MKTCORE", "title": "MKTcore: Turning Marketing Into Measurable Growth"},
    {"num": "19", "sec": "PRODUCT 05 // MKTCORE", "title": "MKTcore: 15 Confirmed High-Velocity Modules"},
    {"num": "20", "sec": "PRODUCT 05 // MKTCORE", "title": "MKTcore: End-to-End Multi-Vendor Commerce Flow"},
    {"num": "21", "sec": "PRODUCT 05 // MKTCORE", "title": "MKTcore: Proven Multi-Vendor Marketplace Impact & ROI"},
    {"num": "22", "sec": "PRODUCT 06 // SKILL", "title": "Skill Development: Developing People For The Future"},
    {"num": "23", "sec": "PRODUCT 06 // SKILL", "title": "Pillar 01: Personality & Professional Mastery"},
    {"num": "24", "sec": "PRODUCT 06 // SKILL", "title": "Pillars 02 & 03: Applied Robotics & CBSE Skills"},
    {"num": "25", "sec": "PRODUCT 06 // SKILL", "title": "Human Impact: The 6-Stage Human Progression Journey"},
    {"num": "26", "sec": "03 // KNR SERVICES", "title": "KNR Technology Engineering Services (10 Domains)"},
    {"num": "27", "sec": "03 // KNR SERVICES", "title": "Strategic Digital Transformation Architecture"},
    {"num": "28", "sec": "04 // THANK YOU", "title": "Thank You: Australia & India Corporate Offices & QR"}
]

deck_grid_cards_html = ""
for item in deck_cards_data:
    idx = int(item["num"])
    deck_grid_cards_html += f"""
      <div class="deck-card" onclick="goToSlide({idx})">
        <div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
            <span class="deck-num">SLIDE {item['num']}</span>
            <span class="deck-section">{item['sec']}</span>
          </div>
          <div class="deck-title">{item['title']}</div>
        </div>
        <div style="font-family: var(--font-mono); font-size: 0.65rem; color: var(--theme-accent);">Jump to slide &rarr;</div>
      </div>
"""

JS_SCRIPTS = r"""
// ==========================================================================
// DYNAMIC COLOR THEME MAP FOR PRODUCTS
// ==========================================================================
const THEME_MAP = {
  'theme-knr':      { accent: '#00F0FF', rgb: '0, 240, 255' },
  'theme-leap':     { accent: '#38BDF8', rgb: '56, 189, 248' },
  'theme-edx':      { accent: '#C084FC', rgb: '192, 132, 252' },
  'theme-rel':      { accent: '#818CF8', rgb: '129, 140, 248' },
  'theme-web':      { accent: '#00F0FF', rgb: '0, 240, 255' },
  'theme-mkt':      { accent: '#34D399', rgb: '52, 211, 153' },
  'theme-skill':    { accent: '#FBBF24', rgb: '251, 191, 36' },
  'theme-services': { accent: '#60A5FA', rgb: '96, 165, 250' },
  'theme-contact':  { accent: '#FBBF24', rgb: '251, 191, 36' }
};

let currentThemeRGB = '0, 240, 255';

// ==========================================================================
// FUTURISTIC CANVAS PARTICLES & NEURAL NETWORK
// ==========================================================================
(function() {
  const canvas = document.getElementById('bg-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let width, height;
  let particles = [];
  const particleCount = 65;
  const maxDistance = 145;
  let mouse = { x: null, y: null, radius: 130 };

  function resize() {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
  }
  window.addEventListener('resize', resize);
  resize();

  class Particle {
    constructor() {
      this.x = Math.random() * width;
      this.y = Math.random() * height;
      this.vx = (Math.random() - 0.5) * 0.7;
      this.vy = (Math.random() - 0.5) * 0.7;
      this.radius = Math.random() * 1.8 + 0.6;
    }

    update() {
      this.x += this.vx;
      this.y += this.vy;

      if (this.x < 0) this.x = width;
      else if (this.x > width) this.x = 0;
      if (this.y < 0) this.y = height;
      else if (this.y > height) this.y = 0;

      // Mouse interactivity
      if (mouse.x !== null) {
        const dx = mouse.x - this.x;
        const dy = mouse.y - this.y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < mouse.radius) {
          const force = (mouse.radius - dist) / mouse.radius;
          this.x -= (dx / dist) * force * 2;
          this.y -= (dy / dist) * force * 2;
        }
      }
    }

    draw() {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(${currentThemeRGB}, 0.65)`;
      ctx.shadowBlur = 8;
      ctx.shadowColor = `rgba(${currentThemeRGB}, 0.8)`;
      ctx.fill();
      ctx.shadowBlur = 0;
    }
  }

  for (let i = 0; i < particleCount; i++) {
    particles.push(new Particle());
  }

  window.addEventListener('mousemove', (e) => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  });

  window.addEventListener('mouseleave', () => {
    mouse.x = null;
    mouse.y = null;
  });

  function animate() {
    ctx.clearRect(0, 0, width, height);

    for (let i = 0; i < particles.length; i++) {
      particles[i].update();
      particles[i].draw();

      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < maxDistance) {
          const alpha = (1 - dist / maxDistance) * 0.22;
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(${currentThemeRGB}, ${alpha})`;
          ctx.lineWidth = 0.9;
          ctx.stroke();
        }
      }
    }

    requestAnimationFrame(animate);
  }
  animate();
})();

// ==========================================================================
// SLIDE NAVIGATION ENGINE
// ==========================================================================
let currentSlide = 1;
const totalSlides = 28;
let autoPlayInterval = null;
let autoPlayActive = false;
let timerSeconds = 0;
let timerInterval = null;

function initPresentation() {
  if (window.location.hash) {
    const match = window.location.hash.match(/#slide-(\d+)/);
    if (match && match[1]) {
      const parsed = parseInt(match[1], 10);
      if (parsed >= 1 && parsed <= totalSlides) {
        currentSlide = parsed;
      }
    }
  }

  updatePresentation();
  startLiveTimer();

  window.addEventListener('keydown', handleKeyDown);
  setupTouchGestures();
}

function updatePresentation() {
  const slides = document.querySelectorAll('.slide-item');
  slides.forEach((s, idx) => {
    const slideIdx = idx + 1;
    if (slideIdx === currentSlide) {
      s.classList.add('active');
      s.scrollTop = 0; // Reset scroll on active slide
    } else {
      s.classList.remove('active');
    }
  });

  const activeSlideEl = document.getElementById(`slide-${currentSlide}`);
  const sectionName = activeSlideEl ? (activeSlideEl.dataset.section || '01 // KNR INTRODUCTION') : '01 // KNR INTRODUCTION';
  const slideTheme = activeSlideEl ? (activeSlideEl.dataset.theme || 'theme-knr') : 'theme-knr';

  const themeCfg = THEME_MAP[slideTheme] || THEME_MAP['theme-knr'];
  currentThemeRGB = themeCfg.rgb;
  document.documentElement.style.setProperty('--theme-accent', themeCfg.accent);
  document.documentElement.style.setProperty('--theme-glow', `rgba(${themeCfg.rgb}, 0.38)`);
  document.documentElement.style.setProperty('--theme-rgb', themeCfg.rgb);

  const sectionTextEl = document.getElementById('hudSectionText');
  if (sectionTextEl) sectionTextEl.textContent = sectionName;

  const indexTextEl = document.getElementById('hudIndexText');
  if (indexTextEl) {
    const curPadded = currentSlide < 10 ? `0${currentSlide}` : currentSlide;
    indexTextEl.textContent = `SLIDE ${curPadded} / ${totalSlides}`;
  }

  const hudCounterEl = document.getElementById('hudCounter');
  if (hudCounterEl) {
    const curPadded = currentSlide < 10 ? `0${currentSlide}` : currentSlide;
    hudCounterEl.textContent = `${curPadded} / ${totalSlides}`;
  }

  const progressFill = document.getElementById('progressFill');
  if (progressFill) {
    const pct = ((currentSlide - 1) / (totalSlides - 1)) * 100;
    progressFill.style.width = `${pct}%`;
  }

  window.history.replaceState(null, null, `#slide-${currentSlide}`);

  const deckCards = document.querySelectorAll('.deck-card');
  deckCards.forEach((c, i) => {
    if (i + 1 === currentSlide) {
      c.classList.add('current');
    } else {
      c.classList.remove('current');
    }
  });
}

function nextSlide() {
  if (currentSlide < totalSlides) {
    currentSlide++;
    updatePresentation();
  } else if (autoPlayActive) {
    currentSlide = 1;
    updatePresentation();
  }
}

function prevSlide() {
  if (currentSlide > 1) {
    currentSlide--;
    updatePresentation();
  }
}

function goToSlide(num) {
  if (num >= 1 && num <= totalSlides) {
    currentSlide = num;
    updatePresentation();
    closeDeckModal();
  }
}

function toggleAutoPlay() {
  autoPlayActive = !autoPlayActive;
  const btn = document.getElementById('btnAutoPlay');

  if (autoPlayActive) {
    if (btn) btn.classList.add('active');
    autoPlayInterval = setInterval(nextSlide, 7000);
  } else {
    if (btn) btn.classList.remove('active');
    clearInterval(autoPlayInterval);
    autoPlayInterval = null;
  }
}

function toggleFullscreen() {
  if (!document.fullscreenElement) {
    document.documentElement.requestFullscreen().catch((err) => {
      console.warn('Fullscreen request failed:', err);
    });
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    }
  }
}

function toggleDeckModal() {
  const modal = document.getElementById('deckModal');
  if (modal) {
    modal.classList.toggle('open');
  }
}

function closeDeckModal() {
  const modal = document.getElementById('deckModal');
  if (modal) {
    modal.classList.remove('open');
  }
}

function startLiveTimer() {
  const timerEl = document.getElementById('hudTimer');
  if (!timerEl) return;

  timerInterval = setInterval(() => {
    timerSeconds++;
    const mins = Math.floor(timerSeconds / 60);
    const secs = timerSeconds % 60;
    const padMins = mins < 10 ? `0${mins}` : mins;
    const padSecs = secs < 10 ? `0${secs}` : secs;
    timerEl.textContent = `${padMins}:${padSecs}`;
  }, 1000);
}

function handleKeyDown(e) {
  const modal = document.getElementById('deckModal');
  const isModalOpen = modal && modal.classList.contains('open');

  if (e.key === 'Escape') {
    if (isModalOpen) closeDeckModal();
    return;
  }

  if (e.key === 'o' || e.key === 'O') {
    toggleDeckModal();
    return;
  }

  if (e.key === 'f' || e.key === 'F') {
    toggleFullscreen();
    return;
  }

  if (e.key === 'a' || e.key === 'A') {
    toggleAutoPlay();
    return;
  }

  if (!isModalOpen) {
    if (e.key === 'ArrowRight' || e.key === 'PageDown' || e.key === ' ') {
      e.preventDefault();
      nextSlide();
    } else if (e.key === 'ArrowLeft' || e.key === 'PageUp') {
      e.preventDefault();
      prevSlide();
    } else if (e.key === 'Home') {
      e.preventDefault();
      goToSlide(1);
    } else if (e.key === 'End') {
      e.preventDefault();
      goToSlide(totalSlides);
    }
  }
}

function setupTouchGestures() {
  let touchStartX = 0;
  let touchEndX = 0;
  let touchStartY = 0;
  let touchEndY = 0;

  window.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
    touchStartY = e.changedTouches[0].screenY;
  }, { passive: true });

  window.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    touchEndY = e.changedTouches[0].screenY;
    handleSwipe();
  }, { passive: true });

  function handleSwipe() {
    const diffX = touchEndX - touchStartX;
    const diffY = touchEndY - touchStartY;
    // Only trigger slide navigation if horizontal swipe is dominant over vertical scroll
    if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 45) {
      if (diffX < 0) {
        nextSlide();
      } else {
        prevSlide();
      }
    }
  }
}

window.addEventListener('DOMContentLoaded', initPresentation);
"""

all_slides_combined = "\n\n".join(slides_html)

COMPLETE_HTML = f"""<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <title>KNR Tech Solutions — Futuristic Corporate Presentation</title>
  <link rel="icon" type="image/x-icon" href="favicon.png">

  <!-- Google Fonts: Outfit (Display Headlines), Plus Jakarta Sans (Body), JetBrains Mono (Tech) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
{CSS_STYLES_V2}
  </style>
</head>
<body>

  <!-- Visual Background Layers -->
  <canvas id="bg-canvas"></canvas>
  <div class="ambient-layer"></div>
  <div class="grid-overlay"></div>

  <!-- Top Progress Bar -->
  <div class="progress-container">
    <div class="progress-fill" id="progressFill"></div>
  </div>

  <!-- Top HUD Bar -->
  <header class="hud-top">
    <div class="hud-brand">
      <img src="https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/KNR-WEBSITE_f817360c-0c15-4992-bc1b-4df24f071612_KNR-Logo.png" 
           alt="KNR Logo" 
           class="brand-logo-img"
           onerror="this.style.display='none'; document.getElementById('fallbackLogo').style.display='block';">
      <div id="fallbackLogo" style="display:none; font-family:var(--font-display); font-weight:900; font-size:1.1rem; color:var(--theme-accent);">KNR</div>
      <div class="brand-title-wrap">
        <span class="brand-name">KNR TECH SOLUTIONS</span>
        <span class="brand-tagline">CHAMPIONS OF CHANGE</span>
      </div>
    </div>

    <div class="hud-section-pill">
      <span class="hud-pulse-dot"></span>
      <span id="hudSectionText">01 // KNR INTRODUCTION</span>
    </div>

    <div class="hud-index-pill" id="hudIndexText">
      SLIDE 01 / 28
    </div>
  </header>

  <!-- Viewport Containing All 28 Slides -->
  <main id="slides-viewport">
{all_slides_combined}
  </main>

  <!-- Bottom Control HUD -->
  <footer class="hud-bottom">
    <button class="ctrl-btn" onclick="prevSlide()" title="Previous Slide (Left Arrow, Page Up)">
      &larr; <span class="btn-text-hide">Prev</span>
    </button>
    <span class="ctrl-counter" id="hudCounter">01 / 28</span>
    <button class="ctrl-btn" onclick="nextSlide()" title="Next Slide (Right Arrow, Space, Page Down)">
      <span class="btn-text-hide">Next</span> &rarr;
    </button>
    <button class="ctrl-btn" id="btnAutoPlay" onclick="toggleAutoPlay()" title="Auto-Play Presentation (A Key)">
      &blacktriangleright; <span class="btn-text-hide">Auto</span>
    </button>
    <button class="ctrl-btn" onclick="toggleDeckModal()" title="Deck Overview Grid (O Key)">
      &#9638; <span class="btn-text-hide">Overview</span>
    </button>
    <button class="ctrl-btn" onclick="toggleFullscreen()" title="Toggle Fullscreen (F Key)">
      &#x26F6;
    </button>
    <span class="ctrl-timer" id="hudTimer">00:00</span>
  </footer>

  <!-- Deck Overview Modal -->
  <div class="modal-overlay" id="deckModal">
    <div class="modal-header">
      <div class="modal-title">Presentation Deck Navigator (28 Slides)</div>
      <button class="modal-close-btn" onclick="closeDeckModal()" title="Close (Escape)">&times;</button>
    </div>
    <div class="deck-grid">
{deck_grid_cards_html}
    </div>
  </div>

  <!-- Interactive JavaScript Engine -->
  <script>
{JS_SCRIPTS}
  </script>
</body>
</html>
"""

output_path = r"C:\xampp\htdocs\knr-website\KNR-Presentation.html"
with open(output_path, "w", encoding="utf-8") as f:
    f.write(COMPLETE_HTML)

print(f"Successfully assembled: {output_path}")
print(f"File size: {os.path.getsize(output_path):,} bytes")
