CSS_STYLES_V2 = """
/* ==========================================================================
   FUTURISTIC KNR MULTI-PRODUCT PRESENTATION SYSTEM (V3 RESPONSIVE)
   ========================================================================== */
:root {
  --bg-space: #040714;
  --bg-deep: #080D20;
  --bg-card: rgba(12, 18, 42, 0.65);
  --bg-card-hover: rgba(20, 30, 66, 0.85);
  --border-glass: rgba(255, 255, 255, 0.12);
  
  /* Brand Default */
  --theme-accent: #00F0FF;
  --theme-glow: rgba(0, 240, 255, 0.35);
  --theme-rgb: 0, 240, 255;
  
  --text-pure: #FFFFFF;
  --text-muted: rgba(255, 255, 255, 0.78);
  --text-dim: rgba(255, 255, 255, 0.45);
  
  --font-display: 'Outfit', sans-serif;
  --font-body: 'Plus Jakarta Sans', sans-serif;
  --font-mono: 'JetBrains Mono', monospace;
  
  --transition-smooth: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
}

html, body {
  width: 100vw;
  height: 100vh;
  min-height: 100%;
  overflow: hidden;
  background: var(--bg-space);
  color: var(--text-pure);
  font-family: var(--font-body);
  user-select: none;
}

/* Background canvas and atmospheric glow */
#bg-canvas {
  position: fixed;
  inset: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
  pointer-events: none;
}

.ambient-layer {
  position: fixed;
  inset: 0;
  z-index: 1;
  pointer-events: none;
  background: radial-gradient(circle at 15% 20%, rgba(var(--theme-rgb), 0.15) 0%, transparent 50%),
              radial-gradient(circle at 85% 75%, rgba(var(--theme-rgb), 0.1) 0%, transparent 50%);
  transition: background 0.8s ease-in-out;
}

.grid-overlay {
  position: fixed;
  inset: 0;
  z-index: 1;
  pointer-events: none;
  background-size: 50px 50px;
  background-image: 
    linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
    linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  mask-image: radial-gradient(circle at 50% 50%, black 60%, transparent 95%);
}

/* Progress Bar */
.progress-container {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 3.5px;
  background: rgba(255, 255, 255, 0.08);
  z-index: 999;
}

.progress-fill {
  height: 100%;
  width: 0%;
  background: linear-gradient(90deg, var(--theme-accent), #3B82F6, #8B5CF6);
  box-shadow: 0 0 12px var(--theme-glow);
  transition: width 0.4s ease-out, background 0.6s ease;
}

/* Top HUD Bar */
.hud-top {
  position: fixed;
  top: 0.75rem;
  left: 1.25rem;
  right: 1.25rem;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 100;
  pointer-events: auto;
  gap: 0.75rem;
}

.hud-brand {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  background: rgba(10, 16, 38, 0.85);
  backdrop-filter: blur(16px);
  padding: 0.35rem 0.9rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
  flex-shrink: 0;
}

.brand-logo-img {
  height: 24px;
  width: auto;
  object-fit: contain;
}

.brand-title-wrap {
  display: flex;
  flex-direction: column;
}

.brand-name {
  font-family: var(--font-display);
  font-size: 0.86rem;
  font-weight: 800;
  letter-spacing: 0.08em;
  color: var(--text-pure);
  white-space: nowrap;
}

.brand-tagline {
  font-size: 0.58rem;
  color: var(--theme-accent);
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  transition: color 0.5s ease;
  white-space: nowrap;
}

.hud-section-pill {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: rgba(10, 16, 38, 0.85);
  backdrop-filter: blur(16px);
  padding: 0.35rem 1rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
  font-family: var(--font-mono);
  font-size: 0.74rem;
  font-weight: 600;
  color: var(--theme-accent);
  text-transform: uppercase;
  letter-spacing: 0.1em;
  transition: color 0.5s ease, border-color 0.5s ease;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.hud-pulse-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--theme-accent);
  box-shadow: 0 0 8px var(--theme-glow);
  animation: pulseDot 2s infinite;
  transition: background 0.5s ease;
  flex-shrink: 0;
}

@keyframes pulseDot {
  0%, 100% { transform: scale(1); opacity: 0.8; }
  50% { transform: scale(1.4); opacity: 1; }
}

.hud-index-pill {
  background: rgba(10, 16, 38, 0.85);
  backdrop-filter: blur(16px);
  padding: 0.35rem 0.9rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
  font-family: var(--font-mono);
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--text-pure);
  white-space: nowrap;
  flex-shrink: 0;
}

/* Bottom Control HUD */
.hud-bottom {
  position: fixed;
  bottom: 0.85rem;
  left: 50%;
  transform: translateX(-50%);
  z-index: 100;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: rgba(10, 16, 38, 0.9);
  backdrop-filter: blur(20px);
  padding: 0.35rem 0.9rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
  max-width: calc(100vw - 1.5rem);
}

.ctrl-btn {
  background: transparent;
  border: 1px solid transparent;
  color: var(--text-pure);
  font-family: var(--font-body);
  font-size: 0.8rem;
  font-weight: 600;
  padding: 0.35rem 0.7rem;
  border-radius: 30px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  transition: var(--transition-smooth);
  white-space: nowrap;
}

.ctrl-btn:hover {
  background: rgba(255, 255, 255, 0.12);
  border-color: rgba(255, 255, 255, 0.2);
  transform: translateY(-1px);
}

.ctrl-btn.active {
  background: linear-gradient(135deg, var(--theme-accent), #3B82F6);
  border-color: transparent;
  box-shadow: 0 0 15px var(--theme-glow);
}

.ctrl-counter {
  font-family: var(--font-mono);
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--theme-accent);
  min-width: 4.2rem;
  text-align: center;
  transition: color 0.5s ease;
  white-space: nowrap;
}

.ctrl-timer {
  font-family: var(--font-mono);
  font-size: 0.72rem;
  color: var(--text-dim);
  border-left: 1px solid rgba(255, 255, 255, 0.15);
  padding-left: 0.6rem;
  white-space: nowrap;
}

/* Slides Viewport & Transitions */
#slides-viewport {
  position: relative;
  width: 100vw;
  height: 100vh;
  z-index: 10;
  overflow: hidden;
}

.slide-item {
  position: absolute;
  inset: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 4.5rem clamp(1rem, 3.5vw, 4rem) 3.8rem;
  opacity: 0;
  pointer-events: none;
  transform: scale(0.97) translateY(15px);
  transition: opacity 0.45s cubic-bezier(0.16, 1, 0.3, 1),
              transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
  overflow-y: auto;
  overflow-x: hidden;
  scrollbar-width: thin;
  scrollbar-color: rgba(255, 255, 255, 0.15) transparent;
  -webkit-overflow-scrolling: touch;
}

.slide-item::-webkit-scrollbar {
  width: 5px;
}
.slide-item::-webkit-scrollbar-track {
  background: transparent;
}
.slide-item::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.18);
  border-radius: 4px;
}

.slide-item.active {
  opacity: 1;
  pointer-events: auto;
  transform: scale(1) translateY(0);
}

.slide-container {
  width: 100%;
  max-width: 1420px;
  margin: auto;
  display: flex;
  flex-direction: column;
  min-height: min-content;
  justify-content: center;
  position: relative;
  z-index: 2;
}

/* PRODUCT DISTINCTIVE HEADER STRIP (Every product slide has this) */
.product-header-strip {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: rgba(14, 22, 50, 0.55);
  backdrop-filter: blur(16px);
  border: 1px solid var(--border-glass);
  border-left: 4px solid var(--theme-accent);
  border-radius: 16px;
  padding: 0.55rem 1.1rem;
  margin-bottom: 0.9rem;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
  position: relative;
  overflow: hidden;
  gap: 0.75rem;
}

.product-header-left {
  display: flex;
  align-items: center;
  gap: 0.85rem;
}

.product-logo-avatar {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: #FFFFFF;
  padding: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 15px var(--theme-glow);
  flex-shrink: 0;
}

.product-logo-avatar img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.product-header-text h3 {
  font-family: var(--font-display);
  font-size: clamp(1rem, 1.6vw, 1.35rem);
  font-weight: 900;
  line-height: 1.15;
  color: var(--text-pure);
}

.product-header-text .product-domain-tag {
  font-family: var(--font-mono);
  font-size: 0.65rem;
  font-weight: 700;
  color: var(--theme-accent);
  letter-spacing: 0.12em;
  text-transform: uppercase;
}

.product-header-right {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  flex-shrink: 0;
}

.product-story-stepper {
  display: flex;
  align-items: center;
  gap: 0.35rem;
  background: rgba(255, 255, 255, 0.06);
  padding: 0.28rem 0.75rem;
  border-radius: 30px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  font-family: var(--font-mono);
  font-size: 0.68rem;
  font-weight: 600;
  color: var(--text-muted);
  flex-wrap: wrap;
}

.stepper-step.active {
  color: var(--theme-accent);
  font-weight: 800;
}

/* Background Watermark Monogram */
.product-watermark-bg {
  position: absolute;
  right: -2%;
  bottom: -5%;
  font-family: var(--font-display);
  font-size: clamp(6rem, 13vw, 14rem);
  font-weight: 950;
  letter-spacing: -0.04em;
  color: rgba(255, 255, 255, 0.025);
  pointer-events: none;
  z-index: 1;
  text-transform: uppercase;
  line-height: 0.85;
}

/* Glass Card Components */
.glass-card {
  background: var(--bg-card);
  backdrop-filter: blur(16px);
  border: 1px solid var(--border-glass);
  border-radius: 16px;
  padding: 1.1rem;
  position: relative;
  overflow: hidden;
  transition: var(--transition-smooth);
}

.glass-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
}

.glass-card:hover {
  background: var(--bg-card-hover);
  border-color: rgba(255, 255, 255, 0.25);
  transform: translateY(-2px);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
}

.card-theme-glow:hover {
  border-color: var(--theme-accent);
  box-shadow: 0 8px 25px var(--theme-glow);
}

/* Specific Product Themes */
.theme-knr {
  --theme-accent: #00F0FF;
  --theme-glow: rgba(0, 240, 255, 0.35);
  --theme-rgb: 0, 240, 255;
}

.theme-leap {
  --theme-accent: #38BDF8;
  --theme-glow: rgba(56, 189, 248, 0.4);
  --theme-rgb: 56, 189, 248;
}

.theme-edx {
  --theme-accent: #C084FC;
  --theme-glow: rgba(192, 132, 252, 0.4);
  --theme-rgb: 192, 132, 252;
}

.theme-rel {
  --theme-accent: #818CF8;
  --theme-glow: rgba(129, 140, 248, 0.4);
  --theme-rgb: 129, 140, 248;
}

.theme-web {
  --theme-accent: #00F0FF;
  --theme-glow: rgba(0, 240, 255, 0.4);
  --theme-rgb: 0, 240, 255;
}

.theme-mkt {
  --theme-accent: #34D399;
  --theme-glow: rgba(52, 211, 153, 0.4);
  --theme-rgb: 52, 211, 153;
}

.theme-skill {
  --theme-accent: #FBBF24;
  --theme-glow: rgba(251, 191, 36, 0.4);
  --theme-rgb: 251, 191, 36;
}

.theme-services {
  --theme-accent: #60A5FA;
  --theme-glow: rgba(96, 165, 250, 0.4);
  --theme-rgb: 96, 165, 250;
}

.theme-contact {
  --theme-accent: #FBBF24;
  --theme-glow: rgba(251, 191, 36, 0.4);
  --theme-rgb: 251, 191, 36;
}

/* Grids */
.grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.1rem; }
.grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
.grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.9rem; }
.grid-5 { display: grid; grid-template-columns: repeat(5, 1fr); gap: 0.8rem; }
.grid-6 { display: grid; grid-template-columns: repeat(6, 1fr); gap: 0.75rem; }

/* Tech Tags */
.tech-tag {
  display: inline-flex;
  align-items: center;
  font-family: var(--font-mono);
  font-size: 0.68rem;
  font-weight: 600;
  padding: 0.2rem 0.55rem;
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.14);
  color: var(--text-pure);
  margin: 0.12rem;
}

.tech-tag-theme {
  background: rgba(var(--theme-rgb), 0.12);
  border-color: rgba(var(--theme-rgb), 0.35);
  color: var(--theme-accent);
}

/* Slide Typography */
.slide-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 0.45rem;
  font-family: var(--font-mono);
  font-size: clamp(0.65rem, 1vw, 0.75rem);
  font-weight: 700;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: var(--theme-accent);
  margin-bottom: 0.4rem;
  flex-wrap: wrap;
}

.slide-title {
  font-family: var(--font-display);
  font-size: clamp(1.5rem, 2.8vw, 3rem);
  font-weight: 900;
  line-height: 1.12;
  letter-spacing: -0.02em;
  color: var(--text-pure);
  margin-bottom: 0.4rem;
}

.slide-title-gradient {
  background: linear-gradient(135deg, #FFFFFF 30%, var(--theme-accent) 75%, #3B82F6 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.slide-subtitle {
  font-size: clamp(0.78rem, 1.1vw, 1.05rem);
  color: var(--text-muted);
  line-height: 1.5;
  max-width: 960px;
  margin-bottom: 1rem;
  font-weight: 400;
}

/* Flow & Stat Components */
.flow-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
  width: 100%;
  margin: 1rem 0;
  gap: 0.4rem;
}

.flow-step {
  flex: 1;
  background: var(--bg-card);
  border: 1px solid var(--border-glass);
  border-radius: 14px;
  padding: 0.85rem 0.65rem;
  text-align: center;
  position: relative;
  transition: var(--transition-smooth);
}

.flow-step:hover {
  background: var(--bg-card-hover);
  border-color: var(--theme-accent);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px var(--theme-glow);
}

.flow-connector {
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--theme-accent);
  font-size: 1.1rem;
  padding: 0 0.1rem;
  opacity: 0.6;
  flex-shrink: 0;
}

.stat-huge {
  font-family: var(--font-display);
  font-size: clamp(1.8rem, 3.2vw, 3.2rem);
  font-weight: 900;
  line-height: 1;
  letter-spacing: -0.02em;
  color: var(--theme-accent);
}

.stat-label {
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--text-muted);
  margin-top: 0.3rem;
}

/* Modal Overview Deck */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(4, 7, 20, 0.92);
  backdrop-filter: blur(24px);
  z-index: 9999;
  display: flex;
  flex-direction: column;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease;
  padding: 1.5rem;
}

.modal-overlay.open {
  opacity: 1;
  pointer-events: auto;
}

.modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1rem;
  padding-bottom: 0.7rem;
  border-bottom: 1px solid var(--border-glass);
}

.modal-title {
  font-family: var(--font-display);
  font-size: 1.25rem;
  font-weight: 800;
  color: var(--text-pure);
}

.modal-close-btn {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid var(--border-glass);
  color: #fff;
  border-radius: 50%;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 1.1rem;
  transition: var(--transition-smooth);
}

.modal-close-btn:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: scale(1.08);
}

.deck-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 0.85rem;
  overflow-y: auto;
  padding-right: 0.5rem;
}

.deck-card {
  background: rgba(14, 22, 50, 0.6);
  border: 1px solid var(--border-glass);
  border-radius: 14px;
  padding: 0.85rem;
  cursor: pointer;
  transition: var(--transition-smooth);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 125px;
}

.deck-card:hover {
  background: rgba(25, 40, 90, 0.8);
  border-color: var(--theme-accent);
  transform: translateY(-2px);
  box-shadow: 0 8px 25px var(--theme-glow);
}

.deck-card.current {
  border-color: var(--theme-accent);
  background: rgba(var(--theme-rgb), 0.15);
  box-shadow: 0 0 20px var(--theme-glow);
}

.deck-num {
  font-family: var(--font-mono);
  font-size: 0.7rem;
  font-weight: 700;
  color: var(--theme-accent);
}

.deck-section {
  font-size: 0.6rem;
  color: var(--text-dim);
  text-transform: uppercase;
  letter-spacing: 0.08em;
}

.deck-title {
  font-family: var(--font-display);
  font-size: 0.84rem;
  font-weight: 700;
  color: var(--text-pure);
  line-height: 1.25;
}

/* ==========================================================================
   RESPONSIVE BREAKPOINTS: DESKTOPS, LAPTOPS, TABLETS, PHONES & ULTRAWIDE
   ========================================================================== */

/* Laptop & Medium Displays (<= 1200px) */
@media (max-width: 1200px) {
  .grid-4 { grid-template-columns: repeat(2, 1fr); gap: 0.85rem; }
  .grid-5 { grid-template-columns: repeat(3, 1fr); gap: 0.75rem; }
  .grid-6 { grid-template-columns: repeat(3, 1fr); gap: 0.75rem; }
  .product-header-strip { padding: 0.5rem 0.9rem; }
  .glass-card { padding: 0.95rem; }
}

/* Tablets (<= 992px) */
@media (max-width: 992px) {
  .slide-item {
    padding: 4.8rem clamp(1rem, 3vw, 2.5rem) 4rem;
    justify-content: flex-start;
  }
  .slide-container {
    height: auto;
  }
  .grid-3 { grid-template-columns: repeat(2, 1fr); gap: 0.8rem; }
  .grid-4 { grid-template-columns: repeat(2, 1fr); gap: 0.8rem; }
  .grid-5 { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
  .grid-6 { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
  
  .product-header-strip {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }
  .product-header-right {
    width: 100%;
    justify-content: flex-start;
  }
  
  .flow-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.6rem;
  }
  .flow-connector {
    display: none;
  }
}

/* Small Tablets & Large Phones (<= 768px) */
@media (max-width: 768px) {
  .hud-top {
    left: 0.75rem;
    right: 0.75rem;
    top: 0.5rem;
    height: 44px;
    gap: 0.4rem;
  }
  .brand-tagline {
    display: none;
  }
  .brand-logo-img {
    height: 20px;
  }
  .brand-name {
    font-size: 0.8rem;
  }
  .hud-section-pill {
    max-width: 160px;
    font-size: 0.66rem;
    padding: 0.3rem 0.65rem;
  }
  .hud-index-pill {
    font-size: 0.72rem;
    padding: 0.3rem 0.65rem;
  }
  
  .slide-item {
    padding: 4.2rem 0.85rem 3.8rem;
    justify-content: flex-start;
  }
  
  .grid-2, .grid-3, .grid-4, .grid-5, .grid-6 {
    grid-template-columns: 1fr;
    gap: 0.65rem;
  }
  
  .flow-container {
    grid-template-columns: repeat(2, 1fr);
    gap: 0.55rem;
  }
  
  .product-story-stepper {
    font-size: 0.62rem;
    padding: 0.2rem 0.5rem;
  }
  
  .hud-bottom {
    bottom: 0.5rem;
    padding: 0.25rem 0.65rem;
    gap: 0.3rem;
  }
  .ctrl-btn {
    font-size: 0.74rem;
    padding: 0.3rem 0.55rem;
  }
  .ctrl-btn .btn-text-hide {
    display: none;
  }
  .ctrl-counter {
    font-size: 0.72rem;
    min-width: 3.6rem;
  }
  .ctrl-timer {
    display: none;
  }
}

/* Mobile Devices (<= 480px) */
@media (max-width: 480px) {
  .hud-top {
    left: 0.5rem;
    right: 0.5rem;
  }
  .hud-section-pill {
    display: none;
  }
  .slide-item {
    padding: 3.8rem 0.65rem 3.6rem;
  }
  .slide-title {
    font-size: 1.4rem;
  }
  .slide-subtitle {
    font-size: 0.76rem;
    margin-bottom: 0.75rem;
  }
  .product-header-strip {
    padding: 0.45rem 0.7rem;
    border-radius: 12px;
  }
  .product-logo-avatar {
    width: 38px;
    height: 38px;
  }
  .glass-card {
    padding: 0.85rem;
    border-radius: 12px;
  }
  .flow-container {
    grid-template-columns: 1fr;
    gap: 0.5rem;
  }
  .stat-huge {
    font-size: 1.7rem;
  }
  .modal-overlay {
    padding: 1rem 0.65rem;
  }
  .deck-grid {
    grid-template-columns: 1fr;
  }
}

/* Short screens / Landscape Laptops & Projectors (max-height: 760px) */
@media (max-height: 760px) {
  .hud-top {
    top: 0.4rem;
    height: 40px;
  }
  .hud-bottom {
    bottom: 0.4rem;
    padding: 0.25rem 0.75rem;
  }
  .slide-item {
    padding-top: 3.5rem;
    padding-bottom: 3.2rem;
    justify-content: flex-start;
  }
  .product-header-strip {
    margin-bottom: 0.55rem;
    padding: 0.4rem 0.85rem;
  }
  .product-logo-avatar {
    width: 36px;
    height: 36px;
  }
  .slide-subtitle {
    margin-bottom: 0.6rem;
    line-height: 1.35;
  }
  .glass-card {
    padding: 0.75rem 0.85rem;
  }
  .flow-container {
    margin: 0.65rem 0;
  }
  .flow-step {
    padding: 0.6rem 0.45rem;
  }
}

/* Ultra Short screens / Landscape Phones (max-height: 540px) */
@media (max-height: 540px) {
  .hud-top {
    position: absolute;
    top: 0.25rem;
  }
  .hud-bottom {
    bottom: 0.25rem;
  }
  .slide-item {
    padding-top: 2.8rem;
    padding-bottom: 2.8rem;
  }
  .product-header-strip {
    display: none;
  }
  .slide-title {
    font-size: 1.25rem;
  }
}

/* Ultra-wide Displays (>= 1920px) */
@media (min-width: 1920px) {
  .slide-container {
    max-width: 1680px;
  }
  .slide-title {
    font-size: clamp(2.4rem, 3.6vw, 4.2rem);
  }
  .slide-subtitle {
    font-size: 1.15rem;
    max-width: 1100px;
  }
  .glass-card {
    padding: 1.5rem;
  }
  .stat-huge {
    font-size: 4rem;
  }
}
"""
