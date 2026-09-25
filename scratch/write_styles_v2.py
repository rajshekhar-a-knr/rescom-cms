import os

css_content = """
/* ==========================================================================
   FUTURISTIC KNR MULTI-PRODUCT PRESENTATION SYSTEM (V2)
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
  --text-muted: rgba(255, 255, 255, 0.75);
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
  top: 1rem;
  left: 1.5rem;
  right: 1.5rem;
  height: 52px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 100;
  pointer-events: auto;
}

.hud-brand {
  display: flex;
  align-items: center;
  gap: 0.85rem;
  background: rgba(10, 16, 38, 0.75);
  backdrop-filter: blur(16px);
  padding: 0.45rem 1rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
}

.brand-logo-img {
  height: 26px;
  width: auto;
  object-fit: contain;
}

.brand-title-wrap {
  display: flex;
  flex-direction: column;
}

.brand-name {
  font-family: var(--font-display);
  font-size: 0.92rem;
  font-weight: 800;
  letter-spacing: 0.08em;
  color: var(--text-pure);
}

.brand-tagline {
  font-size: 0.62rem;
  color: var(--theme-accent);
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  transition: color 0.5s ease;
}

.hud-section-pill {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  background: rgba(10, 16, 38, 0.75);
  backdrop-filter: blur(16px);
  padding: 0.45rem 1.25rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
  font-family: var(--font-mono);
  font-size: 0.78rem;
  font-weight: 600;
  color: var(--theme-accent);
  text-transform: uppercase;
  letter-spacing: 0.1em;
  transition: color 0.5s ease, border-color 0.5s ease;
}

.hud-pulse-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--theme-accent);
  box-shadow: 0 0 8px var(--theme-glow);
  animation: pulseDot 2s infinite;
  transition: background 0.5s ease;
}

@keyframes pulseDot {
  0%, 100% { transform: scale(1); opacity: 0.8; }
  50% { transform: scale(1.4); opacity: 1; }
}

.hud-index-pill {
  background: rgba(10, 16, 38, 0.75);
  backdrop-filter: blur(16px);
  padding: 0.45rem 1rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
  font-family: var(--font-mono);
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--text-pure);
}

/* Bottom Control HUD */
.hud-bottom {
  position: fixed;
  bottom: 1.2rem;
  left: 50%;
  transform: translateX(-50%);
  z-index: 100;
  display: flex;
  align-items: center;
  gap: 0.75rem;
  background: rgba(10, 16, 38, 0.88);
  backdrop-filter: blur(20px);
  padding: 0.45rem 1.2rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
}

.ctrl-btn {
  background: transparent;
  border: 1px solid transparent;
  color: var(--text-pure);
  font-family: var(--font-body);
  font-size: 0.85rem;
  font-weight: 600;
  padding: 0.4rem 0.85rem;
  border-radius: 30px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  transition: var(--transition-smooth);
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
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--theme-accent);
  min-width: 4.8rem;
  text-align: center;
  transition: color 0.5s ease;
}

.ctrl-timer {
  font-family: var(--font-mono);
  font-size: 0.75rem;
  color: var(--text-dim);
  border-left: 1px solid rgba(255, 255, 255, 0.15);
  padding-left: 0.75rem;
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
  padding: 5.2rem clamp(1.5rem, 4vw, 4.5rem) 4.2rem;
  opacity: 0;
  pointer-events: none;
  transform: scale(0.96) translateY(20px);
  transition: opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1),
              transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: rgba(255, 255, 255, 0.15) transparent;
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
  height: 100%;
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
  padding: 0.65rem 1.25rem;
  margin-bottom: 1.2rem;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
  position: relative;
  overflow: hidden;
}

.product-header-left {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.product-logo-avatar {
  width: 48px;
  height: 48px;
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
  font-size: 1.35rem;
  font-weight: 900;
  line-height: 1.1;
  color: var(--text-pure);
}

.product-header-text .product-domain-tag {
  font-family: var(--font-mono);
  font-size: 0.68rem;
  font-weight: 700;
  color: var(--theme-accent);
  letter-spacing: 0.12em;
  text-transform: uppercase;
}

.product-header-right {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.product-story-stepper {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  background: rgba(255, 255, 255, 0.06);
  padding: 0.3rem 0.8rem;
  border-radius: 30px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  font-family: var(--font-mono);
  font-size: 0.72rem;
  font-weight: 600;
  color: var(--text-muted);
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
  font-size: clamp(8rem, 14vw, 15rem);
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
  border-radius: 18px;
  padding: 1.3rem;
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
  transform: translateY(-3px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
}

.card-theme-glow:hover {
  border-color: var(--theme-accent);
  box-shadow: 0 10px 30px var(--theme-glow);
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
.grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.3rem; }
.grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.15rem; }
.grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; }
.grid-5 { display: grid; grid-template-columns: repeat(5, 1fr); gap: 0.9rem; }
.grid-6 { display: grid; grid-template-columns: repeat(6, 1fr); gap: 0.8rem; }

@media (max-width: 1200px) {
  .grid-4, .grid-5 { grid-template-columns: repeat(2, 1fr); }
  .grid-6 { grid-template-columns: repeat(3, 1fr); }
}

@media (max-width: 768px) {
  .grid-2, .grid-3, .grid-4, .grid-5 { grid-template-columns: 1fr; }
  .grid-6 { grid-template-columns: repeat(2, 1fr); }
}

/* Tech Tags */
.tech-tag {
  display: inline-flex;
  align-items: center;
  font-family: var(--font-mono);
  font-size: 0.68rem;
  font-weight: 600;
  padding: 0.2rem 0.6rem;
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.14);
  color: var(--text-pure);
  margin: 0.15rem;
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
  gap: 0.5rem;
  font-family: var(--font-mono);
  font-size: 0.76rem;
  font-weight: 700;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--theme-accent);
  margin-bottom: 0.5rem;
}

.slide-title {
  font-family: var(--font-display);
  font-size: clamp(1.8rem, 3.2vw, 3.2rem);
  font-weight: 900;
  line-height: 1.1;
  letter-spacing: -0.02em;
  color: var(--text-pure);
  margin-bottom: 0.5rem;
}

.slide-title-gradient {
  background: linear-gradient(135deg, #FFFFFF 30%, var(--theme-accent) 75%, #3B82F6 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.slide-subtitle {
  font-size: clamp(0.88rem, 1.25vw, 1.15rem);
  color: var(--text-muted);
  line-height: 1.5;
  max-width: 960px;
  margin-bottom: 1.3rem;
  font-weight: 400;
}

/* Flow & Stat Components */
.flow-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
  width: 100%;
  margin: 1.3rem 0;
  gap: 0.45rem;
}

.flow-step {
  flex: 1;
  background: var(--bg-card);
  border: 1px solid var(--border-glass);
  border-radius: 14px;
  padding: 1rem 0.8rem;
  text-align: center;
  position: relative;
  transition: var(--transition-smooth);
}

.flow-step:hover {
  background: var(--bg-card-hover);
  border-color: var(--theme-accent);
  transform: translateY(-3px);
  box-shadow: 0 8px 25px var(--theme-glow);
}

.flow-connector {
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--theme-accent);
  font-size: 1.15rem;
  padding: 0 0.15rem;
  opacity: 0.6;
}

.stat-huge {
  font-family: var(--font-display);
  font-size: clamp(2rem, 3.6vw, 3.4rem);
  font-weight: 900;
  line-height: 1;
  letter-spacing: -0.02em;
  color: var(--theme-accent);
}

.stat-label {
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--text-muted);
  margin-top: 0.35rem;
}

/* Modal Overview Deck */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(4, 7, 20, 0.9);
  backdrop-filter: blur(24px);
  z-index: 9999;
  display: flex;
  flex-direction: column;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease;
  padding: 2rem;
}

.modal-overlay.open {
  opacity: 1;
  pointer-events: auto;
}

.modal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1.2rem;
  padding-bottom: 0.8rem;
  border-bottom: 1px solid var(--border-glass);
}

.modal-title {
  font-family: var(--font-display);
  font-size: 1.35rem;
  font-weight: 800;
  color: var(--text-pure);
}

.modal-close-btn {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid var(--border-glass);
  color: #fff;
  border-radius: 50%;
  width: 38px;
  height: 38px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 1.2rem;
  transition: var(--transition-smooth);
}

.modal-close-btn:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: scale(1.08);
}

.deck-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 1rem;
  overflow-y: auto;
  padding-right: 0.5rem;
}

.deck-card {
  background: rgba(14, 22, 50, 0.6);
  border: 1px solid var(--border-glass);
  border-radius: 14px;
  padding: 0.95rem;
  cursor: pointer;
  transition: var(--transition-smooth);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 135px;
}

.deck-card:hover {
  background: rgba(25, 40, 90, 0.8);
  border-color: var(--theme-accent);
  transform: translateY(-3px);
  box-shadow: 0 8px 25px var(--theme-glow);
}

.deck-card.current {
  border-color: var(--theme-accent);
  background: rgba(var(--theme-rgb), 0.15);
  box-shadow: 0 0 20px var(--theme-glow);
}

.deck-num {
  font-family: var(--font-mono);
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--theme-accent);
}

.deck-section {
  font-size: 0.62rem;
  color: var(--text-dim);
  text-transform: uppercase;
  letter-spacing: 0.08em;
}

.deck-title {
  font-family: var(--font-display);
  font-size: 0.88rem;
  font-weight: 700;
  color: var(--text-pure);
  line-height: 1.25;
}
"""

with open("scratch/styles_v2.py", "w", encoding="utf-8") as f:
    f.write(f'CSS_STYLES_V2 = """{css_content}"""')
print("Wrote scratch/styles_v2.py")
