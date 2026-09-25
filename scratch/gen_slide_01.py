import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# SLIDE 01: ABOUT KNR (HERO + KNR LOGO)
s1 = """
<section class="slide-item theme-knr active" id="slide-1" data-index="1" data-section="01 // KNR INTRODUCTION" data-theme="theme-knr">
  <div class="product-watermark-bg" style="opacity: 0.035;">KNR</div>
  <div class="slide-container" style="text-align: center; align-items: center; justify-content: center;">
    
    <!-- Central Illuminated Official KNR Logo -->
    <div style="position: relative; width: 140px; height: 140px; margin: 0 auto 1.1rem;">
      <div style="position: absolute; inset: -8px; border-radius: 50%; border: 2px dashed rgba(0,240,255,0.45); animation: rotateOrbit 25s linear infinite;"></div>
      <div style="position: absolute; inset: -2px; border-radius: 50%; border: 1px solid rgba(59,130,246,0.6); box-shadow: 0 0 35px rgba(0,240,255,0.45);"></div>
      <div style="width: 140px; height: 140px; border-radius: 50%; background: #FFFFFF; display: flex; align-items: center; justify-content: center; padding: 14px; box-shadow: 0 10px 40px rgba(0,0,0,0.6);">
        <img src="https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/site_logo/KNR-WEBSITE_f817360c-0c15-4992-bc1b-4df24f071612_KNR-Logo.png" 
             alt="KNR Tech Solutions" 
             style="max-width: 95%; max-height: 95%; object-fit: contain;">
      </div>
    </div>

    <div class="slide-eyebrow">
      <span class="hud-pulse-dot"></span>
      KNR TECH SOLUTIONS PVT. LTD. &bull; GLOBAL DIGITAL ECOSYSTEM &bull; EST. 2015
    </div>
    
    <h1 class="slide-title" style="font-size: clamp(2.2rem, 4.4vw, 4rem); max-width: 1150px; margin-bottom: 0.6rem;">
      Building The Future Through <br>
      <span class="slide-title-gradient">Knowledge, Technology & Innovation</span>
    </h1>
    
    <p class="slide-subtitle" style="text-align: center; max-width: 860px; margin-left: auto; margin-right: auto; margin-bottom: 1.8rem;">
      A pioneering digital engineering, research, education, and enterprise transformation partner operating across 
      <strong style="color: var(--theme-accent);">Bengaluru, India</strong> and <strong style="color: #60A5FA;">Melbourne, Australia</strong>.
      Empowering institutions, businesses, and people with future-ready platforms.
    </p>

    <!-- Strategic Philosophy Matrix -->
    <div class="grid-6" style="width: 100%; margin-bottom: 1.6rem;">
      <div class="glass-card card-theme-glow" style="padding: 1rem 0.65rem; text-align: center;">
        <div style="font-size: 1.4rem; margin-bottom: 0.25rem;">💡</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent); letter-spacing: 0.05em;">KNOWLEDGE</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem; line-height: 1.35;">Learning creates possibility</div>
      </div>
      
      <div class="glass-card" style="padding: 1rem 0.65rem; text-align: center; border-color: rgba(96,165,250,0.3);">
        <div style="font-size: 1.4rem; margin-bottom: 0.25rem;">🌐</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA; letter-spacing: 0.05em;">NETWORK</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem; line-height: 1.35;">Connections create opportunity</div>
      </div>

      <div class="glass-card" style="padding: 1rem 0.65rem; text-align: center; border-color: rgba(192,132,252,0.3);">
        <div style="font-size: 1.4rem; margin-bottom: 0.25rem;">🔬</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC; letter-spacing: 0.05em;">RESEARCH</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem; line-height: 1.35;">Research creates innovation</div>
      </div>

      <div class="glass-card" style="padding: 1rem 0.65rem; text-align: center; border-color: rgba(52,211,153,0.3);">
        <div style="font-size: 1.4rem; margin-bottom: 0.25rem;">⚡</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399; letter-spacing: 0.05em;">TECHNOLOGY</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem; line-height: 1.35;">Technology creates scale</div>
      </div>

      <div class="glass-card" style="padding: 1rem 0.65rem; text-align: center; border-color: rgba(251,191,36,0.3);">
        <div style="font-size: 1.4rem; margin-bottom: 0.25rem;">👥</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24; letter-spacing: 0.05em;">PEOPLE</div>
        <div style="font-size: 0.72rem; color: var(--text-muted); margin-top: 0.25rem; line-height: 1.35;">People create impact</div>
      </div>

      <div class="glass-card" style="padding: 1rem 0.65rem; text-align: center; border-color: rgba(255,255,255,0.3); background: linear-gradient(135deg, rgba(0,240,255,0.2), rgba(59,130,246,0.25));">
        <div style="font-size: 1.4rem; margin-bottom: 0.25rem;">🚀</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FFF; letter-spacing: 0.05em;">KNR UNIFIED</div>
        <div style="font-size: 0.72rem; color: rgba(255,255,255,0.85); margin-top: 0.25rem; line-height: 1.35;">Brings them together</div>
      </div>
    </div>

    <!-- Footprint Locations -->
    <div class="grid-2" style="width: 100%; max-width: 900px;">
      <div class="glass-card" style="display: flex; align-items: center; gap: 0.9rem; padding: 0.85rem 1.1rem;">
        <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(0, 240, 255, 0.15); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">🇮🇳</div>
        <div style="text-align: left;">
          <div style="font-size: 0.68rem; color: var(--theme-accent); font-weight: 700; text-transform: uppercase;">India Headquarters</div>
          <div style="font-size: 0.86rem; font-weight: 700; color: #FFF;">Rajajinagar, Bengaluru, Karnataka</div>
        </div>
      </div>

      <div class="glass-card" style="display: flex; align-items: center; gap: 0.9rem; padding: 0.85rem 1.1rem;">
        <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(59, 130, 246, 0.15); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">🇦🇺</div>
        <div style="text-align: left;">
          <div style="font-size: 0.68rem; color: #60A5FA; font-weight: 700; text-transform: uppercase;">Australia Corporate Office</div>
          <div style="font-size: 0.86rem; font-weight: 700; color: #FFF;">St Kilda Road Towers, Melbourne, VIC</div>
        </div>
      </div>
    </div>
  </div>
</section>
"""

write_slide(1, s1)
