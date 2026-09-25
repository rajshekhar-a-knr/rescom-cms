import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# =========================================================================
# SLIDE 14: WEBCORE INTRODUCTION
# =========================================================================
s14 = """
<section class="slide-item" id="slide-14" data-index="14" data-section="PRODUCT 04 // WEBCORE">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.4rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--cyan);"></span>
          PRODUCT 04 • ENTERPRISE CONTENT MANAGEMENT SYSTEM (CMS)
        </div>
        <h2 class="slide-title">
          WEBcore <br>
          <span class="slide-title-gradient">Your Digital Presence. Your Control.</span>
        </h2>
      </div>
      <div style="text-align: right;">
        <span class="tech-tag tech-tag-cyan" style="font-size: 0.82rem; padding: 0.35rem 0.9rem;">13 Confirmed CMS Modules</span>
      </div>
    </div>

    <p class="slide-subtitle">
      WEBcore is KNR's enterprise digital experience and content management platform. 
      It grants organizations total autonomy over their public websites, announcements, event fests, media galleries, 
      and online admissions — completely eliminating dependence on web developers.
    </p>

    <!-- 3 Core Tenets of WEBcore -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card glass-card-glow-cyan">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          🌐
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Dynamic Page Architecture</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Effortlessly build, schedule, and update homepage hero sliders, leadership profiles, facility showcases, and custom institutional pages via intuitive visual controls.
        </p>
      </div>

      <div class="glass-card glass-card-glow-primary">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(59, 130, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          📢
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Real-Time Omnichannel Alerts</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Broadcast urgent campus news with dynamic headscroller tickers, modal priority popups, categorized event fests, and embedded video announcements.
        </p>
      </div>

      <div class="glass-card glass-card-glow-purple">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(139, 92, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          🤖
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">24/7 AI Chatbot Engine</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          An automated institutional assistant that answers visitor inquiries, captures admission leads, and allows admins to convert unresolved questions into FAQs with 1 click.
        </p>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 15: WEBCORE CAPABILITIES
# =========================================================================
s15 = """
<section class="slide-item" id="slide-15" data-index="15" data-section="PRODUCT 04 // WEBCORE">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.1rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--cyan);"></span>
          CONTENT MANAGEMENT CAPABILITIES
        </div>
        <h2 class="slide-title">
          13 Confirmed Enterprise Modules
        </h2>
      </div>
      <div style="text-align: right;">
        <span style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--cyan); font-weight: 700;">AWS S3 • SEO Controls • WebP Optimization</span>
      </div>
    </div>

    <!-- 4 Functional Pillars for WEBcore -->
    <div class="grid-4" style="gap: 0.9rem;">
      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🌐</span> PAGES & LAYOUT CMS
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Homepage Carousel:</strong> Reorder slides, captions & CTAs<br>
          • <strong>Section Layouts:</strong> Drag-and-drop order & active toggles<br>
          • <strong>Facilities Builder:</strong> Dynamic facility cards & detail slugs<br>
          • <strong>Leadership & About:</strong> Mission, vision & management profiles<br>
          • <strong>Policy Manager:</strong> Privacy, terms & custom draft workflows
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🎉</span> EVENTS & ACTIVITIES
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Event Categories:</strong> Multi-category school activities & dates<br>
          • <strong>Inter-School Fests:</strong> Multi-event registration & schedules<br>
          • <strong>Class Assemblies:</strong> Class filters & assembly photo albums<br>
          • <strong>Clubs & Associations:</strong> Activity logs & student coordinators<br>
          • <strong>Headscroller Ticker:</strong> Speed-controlled news marquee alerts
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🎓</span> ADMISSIONS & PRIDE HUB
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Multi-Step Admissions:</strong> Step flow builder & document uploads<br>
          • <strong>Board Centum Records:</strong> Grade 10 & 12 topper archives<br>
          • <strong>Merit Scholarships:</strong> Annual scholarship awardee showcase<br>
          • <strong>Alumni Network:</strong> Annual meets, global university admits<br>
          • <strong>Trailblazer Stories:</strong> Inspirational human interest profiles
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🖼️</span> MEDIA & AI ENGINE
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Campus Media Gallery:</strong> Drag-and-drop album reordering<br>
          • <strong>AWS S3 CDN:</strong> Automated image compression & WebP serving<br>
          • <strong>Editorial Blog:</strong> Rich article editor, tags & author assignment<br>
          • <strong>AI Chatbot Assistant:</strong> Intent builder & 1-click convert to FAQ<br>
          • <strong>Popup Form Builder:</strong> Lead capture modal campaign manager
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 16: WEBCORE DIGITAL ECOSYSTEM
# =========================================================================
s16 = """
<section class="slide-item" id="slide-16" data-index="16" data-section="PRODUCT 04 // WEBCORE">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--cyan);"></span>
      PUBLISHING LIFECYCLE ARCHITECTURE
    </div>
    <h2 class="slide-title">
      The Enterprise Digital Publishing Cycle
    </h2>
    <p class="slide-subtitle">
      WEBcore establishes a rapid, secure content pipeline that turns institutional milestones into beautiful, live public engagements within minutes.
    </p>

    <!-- Visual Journey Flow -->
    <div class="flow-container" style="margin: 1.6rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">✍️</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">01. Create</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Rich Text, Media & Banners</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">📋</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Manage</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Draft Review & Role Approval</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🚀</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Publish</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">AWS S3 Cloud Delivery</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🔍</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Optimize</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">SEO Tags & Responsive Preview</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step" style="border-color: var(--cyan); background: rgba(0, 240, 255, 0.08);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">📊</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">05. Analyze</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Lead Inquiries & AI Resolution</div>
      </div>
    </div>

    <!-- Publishing Capabilities Synergy -->
    <div class="grid-3" style="margin-top: 0.8rem;">
      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>⚡</span> Non-Technical Team Empowerment
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Communications officers, admissions staff, and teachers can publish announcements, photo galleries, and blog articles without writing a single line of HTML code.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>☁️</span> High-Performance Media Pipeline
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Direct AWS S3 integration automatically compresses raw camera uploads into modern WebP formats with multi-resolution thumbnails for instant mobile loading.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>🎯</span> Automated Lead Capture Engine
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Floating AI chatbot and custom modal forms channel visitor inquiries into structured admin leads with instant email notifications and Excel export capability.
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 17: WEBCORE VALUE
# =========================================================================
s17 = """
<section class="slide-item" id="slide-17" data-index="17" data-section="PRODUCT 04 // WEBCORE">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--cyan);"></span>
      ENTERPRISE VALUE & AUTONOMY
    </div>
    <h2 class="slide-title">
      Proven Digital Governance Impact
    </h2>
    <p class="slide-subtitle">
      WEBcore puts institutional communication teams back in control — delivering agility, brand consistency, and conversion-engineered admission pipelines.
    </p>

    <!-- Verified Value Metrics -->
    <div class="grid-4" style="margin-bottom: 1.5rem;">
      <div class="glass-card glass-card-glow-cyan" style="text-align: center;">
        <div class="stat-huge" style="color: var(--cyan);">100%</div>
        <div class="stat-label">Developer Independence</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Update hero carousels, admission notices, policy pages, and fests directly from the admin console in seconds.
        </p>
      </div>

      <div class="glass-card glass-card-glow-emerald" style="text-align: center;">
        <div class="stat-huge" style="color: #34D399;">&lt; 5 Min</div>
        <div class="stat-label">Publishing Velocity</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Draft, approve, and push urgent announcements or media gallery albums live to visitors immediately.
        </p>
      </div>

      <div class="glass-card glass-card-glow-amber" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">24/7</div>
        <div class="stat-label">AI Visitor Assistance</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Automated inquiry resolution for campus visits, admission deadlines, and fee policies without staff overhead.
        </p>
      </div>

      <div class="glass-card glass-card-glow-purple" style="text-align: center;">
        <div class="stat-huge" style="color: #C084FC;">SEO-Ready</div>
        <div class="stat-label">Organic Visibility</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Automated meta titles, custom slugs, XML sitemaps, and OpenGraph tags maximize search engine rankings.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: var(--cyan); text-align: center; padding: 1.8rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: var(--cyan); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
        THE WEBCORE PHILOSOPHY
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.3rem, 2.4vw, 2.2rem); font-weight: 900; color: #FFF;">
        “Build once. Manage intelligently. Evolve continuously.”
      </h3>
      <p style="font-size: 0.84rem; color: var(--text-muted); margin-top: 0.5rem; max-width: 720px; margin-left: auto; margin-right: auto;">
        From school assemblies and inter-school fest portals to alumni tracking and admission pipelines — WEBcore elevates your institution's digital identity.
      </p>
    </div>
  </div>
</section>
"""

write_slide(14, s14)
write_slide(15, s15)
write_slide(16, s16)
write_slide(17, s17)
