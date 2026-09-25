# -*- coding: utf-8 -*-
"""Presentation styles and visual theme"""

CSS_STYLES = """
/* ==========================================================================
   FUTURISTIC KNR PRESENTATION DESIGN SYSTEM
   ========================================================================== */
:root {
  --bg-space: #050814;
  --bg-deep: #090E22;
  --bg-card: rgba(14, 22, 48, 0.65);
  --bg-card-hover: rgba(22, 34, 72, 0.85);
  --border-glass: rgba(255, 255, 255, 0.12);
  --border-glow: rgba(0, 240, 255, 0.4);
  
  --primary: #3B82F6;
  --primary-glow: rgba(59, 130, 246, 0.35);
  --cyan: #00F0FF;
  --cyan-glow: rgba(0, 240, 255, 0.35);
  --purple: #8B5CF6;
  --purple-glow: rgba(139, 92, 246, 0.35);
  --emerald: #10B981;
  --emerald-glow: rgba(16, 185, 129, 0.35);
  --amber: #F59E0B;
  --amber-glow: rgba(245, 158, 11, 0.35);
  --rose: #F43F5E;
  --rose-glow: rgba(244, 63, 94, 0.35);
  
  --text-pure: #FFFFFF;
  --text-muted: rgba(255, 255, 255, 0.72);
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
  background: radial-gradient(circle at 15% 20%, rgba(59, 130, 246, 0.12) 0%, transparent 45%),
              radial-gradient(circle at 85% 75%, rgba(139, 92, 246, 0.12) 0%, transparent 45%),
              radial-gradient(circle at 50% 50%, rgba(0, 240, 255, 0.05) 0%, transparent 65%);
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

/* Presentation Progress Bar */
.progress-container {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: rgba(255, 255, 255, 0.08);
  z-index: 999;
}

.progress-fill {
  height: 100%;
  width: 0%;
  background: linear-gradient(90deg, var(--cyan), var(--primary), var(--purple));
  box-shadow: 0 0 10px var(--cyan-glow);
  transition: width 0.4s ease-out;
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
  background: rgba(10, 16, 38, 0.7);
  backdrop-filter: blur(16px);
  padding: 0.45rem 1rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
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
  font-size: 0.95rem;
  font-weight: 800;
  letter-spacing: 0.08em;
  color: var(--text-pure);
}

.brand-tagline {
  font-size: 0.65rem;
  color: var(--cyan);
  font-weight: 600;
  letter-spacing: 0.12em;
  text-transform: uppercase;
}

.hud-section-pill {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  background: rgba(10, 16, 38, 0.7);
  backdrop-filter: blur(16px);
  padding: 0.45rem 1.25rem;
  border-radius: 50px;
  border: 1px solid var(--border-glass);
  font-family: var(--font-mono);
  font-size: 0.78rem;
  font-weight: 600;
  color: var(--cyan);
  text-transform: uppercase;
  letter-spacing: 0.1em;
}

.hud-pulse-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: var(--cyan);
  box-shadow: 0 0 8px var(--cyan);
  animation: pulseDot 2s infinite;
}

@keyframes pulseDot {
  0%, 100% { transform: scale(1); opacity: 0.8; }
  50% { transform: scale(1.4); opacity: 1; }
}

.hud-index-pill {
  background: rgba(10, 16, 38, 0.7);
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
  background: rgba(10, 16, 38, 0.85);
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
  background: linear-gradient(135deg, var(--primary), var(--purple));
  border-color: transparent;
  box-shadow: 0 0 15px var(--primary-glow);
}

.ctrl-counter {
  font-family: var(--font-mono);
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--cyan);
  min-width: 4.8rem;
  text-align: center;
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
  padding: 5.5rem clamp(1.5rem, 4vw, 4.5rem) 4.5rem;
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
}

/* Slide Typography and Header Structure */
.slide-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  font-family: var(--font-mono);
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--cyan);
  margin-bottom: 0.6rem;
}

.slide-title {
  font-family: var(--font-display);
  font-size: clamp(2rem, 3.8vw, 3.6rem);
  font-weight: 900;
  line-height: 1.1;
  letter-spacing: -0.02em;
  color: var(--text-pure);
  margin-bottom: 0.6rem;
}

.slide-title-gradient {
  background: linear-gradient(135deg, #FFFFFF 30%, var(--cyan) 75%, var(--primary) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.slide-subtitle {
  font-size: clamp(0.92rem, 1.35vw, 1.25rem);
  color: var(--text-muted);
  line-height: 1.55;
  max-width: 960px;
  margin-bottom: 1.6rem;
  font-weight: 400;
}

/* Glass Card Components */
.glass-card {
  background: var(--bg-card);
  backdrop-filter: blur(16px);
  border: 1px solid var(--border-glass);
  border-radius: 18px;
  padding: 1.4rem;
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
  border-color: rgba(255, 255, 255, 0.22);
  transform: translateY(-3px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
}

.glass-card-glow-cyan:hover {
  border-color: var(--cyan);
  box-shadow: 0 12px 35px var(--cyan-glow);
}

.glass-card-glow-primary:hover {
  border-color: var(--primary);
  box-shadow: 0 12px 35px var(--primary-glow);
}

.glass-card-glow-purple:hover {
  border-color: var(--purple);
  box-shadow: 0 12px 35px var(--purple-glow);
}

.glass-card-glow-emerald:hover {
  border-color: var(--emerald);
  box-shadow: 0 12px 35px var(--emerald-glow);
}

.glass-card-glow-amber:hover {
  border-color: var(--amber);
  box-shadow: 0 12px 35px var(--amber-glow);
}

/* Standard Grids */
.grid-2 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.4rem;
}

.grid-3 {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.25rem;
}

.grid-4 {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1.1rem;
}

.grid-6 {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 0.85rem;
}

@media (max-width: 1200px) {
  .grid-4 { grid-template-columns: repeat(2, 1fr); }
  .grid-6 { grid-template-columns: repeat(3, 1fr); }
}

@media (max-width: 768px) {
  .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
  .grid-6 { grid-template-columns: repeat(2, 1fr); }
}

/* Badges and Tags */
.tech-tag {
  display: inline-flex;
  align-items: center;
  font-family: var(--font-mono);
  font-size: 0.68rem;
  font-weight: 600;
  padding: 0.22rem 0.6rem;
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.14);
  color: var(--text-pure);
  margin: 0.15rem;
}

.tech-tag-cyan {
  background: rgba(0, 240, 255, 0.12);
  border-color: rgba(0, 240, 255, 0.3);
  color: var(--cyan);
}

.tech-tag-primary {
  background: rgba(59, 130, 246, 0.12);
  border-color: rgba(59, 130, 246, 0.3);
  color: #60A5FA;
}

.tech-tag-emerald {
  background: rgba(16, 185, 129, 0.12);
  border-color: rgba(16, 185, 129, 0.3);
  color: #34D399;
}

.tech-tag-purple {
  background: rgba(139, 92, 246, 0.12);
  border-color: rgba(139, 92, 246, 0.3);
  color: #C084FC;
}

.tech-tag-amber {
  background: rgba(245, 158, 11, 0.12);
  border-color: rgba(245, 158, 11, 0.3);
  color: #FBBF24;
}

/* Visual Node Diagrams & Flows */
.flow-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
  width: 100%;
  margin: 1.5rem 0;
  gap: 0.5rem;
}

.flow-step {
  flex: 1;
  background: var(--bg-card);
  border: 1px solid var(--border-glass);
  border-radius: 16px;
  padding: 1.1rem;
  text-align: center;
  position: relative;
  transition: var(--transition-smooth);
}

.flow-step:hover {
  background: var(--bg-card-hover);
  border-color: var(--cyan);
  transform: translateY(-4px);
  box-shadow: 0 10px 30px var(--cyan-glow);
}

.flow-connector {
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--cyan);
  font-size: 1.2rem;
  padding: 0 0.2rem;
  opacity: 0.6;
}

/* Stat Counters and Numbers */
.stat-huge {
  font-family: var(--font-display);
  font-size: clamp(2.2rem, 4vw, 3.8rem);
  font-weight: 900;
  line-height: 1;
  letter-spacing: -0.02em;
}

.stat-label {
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--text-muted);
  margin-top: 0.4rem;
}

/* Slide Deck Overview Modal */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(4, 7, 20, 0.88);
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
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid var(--border-glass);
}

.modal-title {
  font-family: var(--font-display);
  font-size: 1.4rem;
  font-weight: 800;
  color: var(--text-pure);
}

.modal-close-btn {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid var(--border-glass);
  color: #fff;
  border-radius: 50%;
  width: 40px;
  height: 40px;
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
  gap: 1.1rem;
  overflow-y: auto;
  padding-right: 0.5rem;
}

.deck-card {
  background: rgba(14, 22, 50, 0.6);
  border: 1px solid var(--border-glass);
  border-radius: 14px;
  padding: 1rem;
  cursor: pointer;
  transition: var(--transition-smooth);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 140px;
}

.deck-card:hover {
  background: rgba(25, 40, 90, 0.8);
  border-color: var(--cyan);
  transform: translateY(-3px);
  box-shadow: 0 10px 25px var(--cyan-glow);
}

.deck-card.current {
  border-color: var(--cyan);
  background: rgba(0, 240, 255, 0.12);
  box-shadow: 0 0 20px var(--cyan-glow);
}

.deck-num {
  font-family: var(--font-mono);
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--cyan);
}

.deck-section {
  font-size: 0.65rem;
  color: var(--text-dim);
  text-transform: uppercase;
  letter-spacing: 0.1em;
}

.deck-title {
  font-family: var(--font-display);
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--text-pure);
  line-height: 1.25;
}
"""
