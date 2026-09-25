import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

s1 = """
<section class="slide-item active" id="slide-1" data-index="1" data-section="01 // KNR INTRODUCTION">
  <div class="slide-container" style="text-align: center; align-items: center;">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot"></span>
      GLOBAL TECHNOLOGY & INNOVATION ECOSYSTEM • EST. 2015
    </div>
    
    <h1 class="slide-title" style="font-size: clamp(2.4rem, 4.8vw, 4.4rem); max-width: 1150px; margin-bottom: 0.6rem;">
      Building The Future Through <br>
      <span class="slide-title-gradient">Knowledge, Technology & Innovation</span>
    </h1>
    
    <p class="slide-subtitle" style="text-align: center; max-width: 860px; margin-left: auto; margin-right: auto; margin-bottom: 2rem;">
      A pioneering digital engineering, research, education, and enterprise transformation partner operating across 
      <strong style="color: var(--cyan);">Bengaluru, India</strong> and <strong style="color: #60A5FA;">Melbourne, Australia</strong>.
      Connecting institutions and enterprises through high-velocity digital products.
    </p>

    <!-- Strategic Philosophy Matrix -->
    <div class="grid-6" style="width: 100%; margin-bottom: 2rem;">
      <div class="glass-card glass-card-glow-cyan" style="padding: 1.1rem 0.75rem; text-align: center;">
        <div style="font-size: 1.5rem; margin-bottom: 0.35rem;">💡</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: var(--cyan); letter-spacing: 0.05em;">KNOWLEDGE</div>
        <div style="font-size: 0.73rem; color: var(--text-muted); margin-top: 0.3rem; line-height: 1.35;">Learning creates possibility</div>
      </div>
      
      <div class="glass-card glass-card-glow-primary" style="padding: 1.1rem 0.75rem; text-align: center;">
        <div style="font-size: 1.5rem; margin-bottom: 0.35rem;">🌐</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; letter-spacing: 0.05em;">NETWORK</div>
        <div style="font-size: 0.73rem; color: var(--text-muted); margin-top: 0.3rem; line-height: 1.35;">Connections create opportunity</div>
      </div>

      <div class="glass-card glass-card-glow-purple" style="padding: 1.1rem 0.75rem; text-align: center;">
        <div style="font-size: 1.5rem; margin-bottom: 0.35rem;">🔬</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; letter-spacing: 0.05em;">RESEARCH</div>
        <div style="font-size: 0.73rem; color: var(--text-muted); margin-top: 0.3rem; line-height: 1.35;">Research creates innovation</div>
      </div>

      <div class="glass-card glass-card-glow-emerald" style="padding: 1.1rem 0.75rem; text-align: center;">
        <div style="font-size: 1.5rem; margin-bottom: 0.35rem;">⚡</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; letter-spacing: 0.05em;">TECHNOLOGY</div>
        <div style="font-size: 0.73rem; color: var(--text-muted); margin-top: 0.3rem; line-height: 1.35;">Technology creates scale</div>
      </div>

      <div class="glass-card glass-card-glow-amber" style="padding: 1.1rem 0.75rem; text-align: center;">
        <div style="font-size: 1.5rem; margin-bottom: 0.35rem;">👥</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; letter-spacing: 0.05em;">PEOPLE</div>
        <div style="font-size: 0.73rem; color: var(--text-muted); margin-top: 0.3rem; line-height: 1.35;">People create impact</div>
      </div>

      <div class="glass-card" style="padding: 1.1rem 0.75rem; text-align: center; border-color: rgba(255,255,255,0.25); background: linear-gradient(135deg, rgba(59,130,246,0.25), rgba(139,92,246,0.25));">
        <div style="font-size: 1.5rem; margin-bottom: 0.35rem;">🚀</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FFF; letter-spacing: 0.05em;">KNR UNIFIED</div>
        <div style="font-size: 0.73rem; color: rgba(255,255,255,0.85); margin-top: 0.3rem; line-height: 1.35;">Brings them together</div>
      </div>
    </div>

    <!-- Core Strategic Footprint -->
    <div class="grid-4" style="width: 100%;">
      <div class="glass-card" style="display: flex; align-items: center; gap: 1rem;">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">🇮🇳</div>
        <div style="text-align: left;">
          <div style="font-size: 0.72rem; color: var(--cyan); font-weight: 700; text-transform: uppercase;">India Headquarters</div>
          <div style="font-size: 0.9rem; font-weight: 700; color: #FFF;">Rajajinagar, Bengaluru</div>
          <div style="font-size: 0.7rem; color: var(--text-dim);">Engineering & R&D Hub</div>
        </div>
      </div>

      <div class="glass-card" style="display: flex; align-items: center; gap: 1rem;">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(59, 130, 246, 0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">🇦🇺</div>
        <div style="text-align: left;">
          <div style="font-size: 0.72rem; color: #60A5FA; font-weight: 700; text-transform: uppercase;">Australia Corporate</div>
          <div style="font-size: 0.9rem; font-weight: 700; color: #FFF;">St Kilda Rd, Melbourne</div>
          <div style="font-size: 0.7rem; color: var(--text-dim);">Global Client Engagements</div>
        </div>
      </div>

      <div class="glass-card" style="display: flex; align-items: center; gap: 1rem;">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(16, 185, 129, 0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">🏛️</div>
        <div style="text-align: left;">
          <div style="font-size: 0.72rem; color: #34D399; font-weight: 700; text-transform: uppercase;">Core Domains</div>
          <div style="font-size: 0.9rem; font-weight: 700; color: #FFF;">EdTech & Enterprise SaaS</div>
          <div style="font-size: 0.7rem; color: var(--text-dim);">Custom Cloud Architecture</div>
        </div>
      </div>

      <div class="glass-card" style="display: flex; align-items: center; gap: 1rem;">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.15); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">🌱</div>
        <div style="text-align: left;">
          <div style="font-size: 0.72rem; color: #FBBF24; font-weight: 700; text-transform: uppercase;">Human Capability</div>
          <div style="font-size: 0.9rem; font-weight: 700; color: #FFF;">Skill Development & STEM</div>
          <div style="font-size: 0.7rem; color: var(--text-dim);">Robotics & CBSE Vocational</div>
        </div>
      </div>
    </div>
  </div>
</section>
"""

write_slide(1, s1)
