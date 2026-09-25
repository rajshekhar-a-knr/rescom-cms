# Generator for WEBcore Slides (14, 15, 16, 17)

LOGO_WEB = "https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/product_logos/Webcorebg.png"

def get_stepper(active_idx):
    steps = ["1. DIGITAL ENGINE", "2. 13 MODULES", "3. PUBLISHING STACK", "4. GOVERNANCE & IMPACT"]
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

# Slide 14: WEBcore Identity
s14 = f"""<section class="slide-item theme-web" id="slide-14" data-index="14" data-section="PRODUCT 04 // WEBCORE" data-theme="theme-web">
  <div class="product-watermark-bg">WEBCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_WEB}" alt="WEBcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // DIGITAL EXPERIENCE &amp; CMS PLATFORM</div>
          <h3>WEBcore: Your Digital Presence. Your Control.</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(1)}
      </div>
    </div>

    <p class="slide-subtitle">
      WEBcore is KNR's enterprise digital experience and content management platform. 
      It grants organizations total autonomy over their public websites, announcements, event fests, media galleries, 
      and online admissions &mdash; completely eliminating dependence on web developers.
    </p>

    <!-- 3 Core Tenets of WEBcore -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Dynamic Page Architecture</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Effortlessly build, schedule, and update homepage hero sliders, leadership profiles, facility showcases, and custom institutional pages via intuitive visual controls.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">Visual Layouts</span>
          <span class="tech-tag">Slider Builder</span>
          <span class="tech-tag">Zero-Code</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Real-Time Omnichannel Alerts</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Broadcast urgent campus news with dynamic headscroller tickers, modal priority popups, categorized event fests, and embedded video announcements.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">Live Marquee</span>
          <span class="tech-tag">Priority Modals</span>
          <span class="tech-tag">Fest Portals</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">24/7 AI Chatbot Engine</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          An automated institutional assistant that answers visitor inquiries, captures admission leads, and allows admins to convert unresolved questions into FAQs with 1 click.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">AI Inquiries</span>
          <span class="tech-tag">Lead Forms</span>
          <span class="tech-tag">1-Click FAQ</span>
        </div>
      </div>
    </div>

    <div class="glass-card" style="margin-top: 0.8rem; padding: 0.8rem 1.25rem; display: flex; align-items: center; justify-content: space-between; background: rgba(0, 240, 255, 0.08); border-color: rgba(0, 240, 255, 0.25);">
      <div style="display: flex; align-items: center; gap: 0.8rem;">
        <span style="font-size: 1.3rem;">?</span>
        <span style="font-size: 0.82rem; color: #FFF; font-weight: 600;">Media Stack: AWS S3 CDN Storage, Automated WebP Image Compression, and SEO Tag Automation.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">13 Confirmed Modules</span>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_14.html", "w", encoding="utf-8") as f:
    f.write(s14)

# Slide 15: WEBcore 13 Modules Matrix
s15 = f"""<section class="slide-item theme-web" id="slide-15" data-index="15" data-section="PRODUCT 04 // WEBCORE" data-theme="theme-web">
  <div class="product-watermark-bg">WEBCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_WEB}" alt="WEBcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // DIGITAL EXPERIENCE &amp; CMS PLATFORM</div>
          <h3>WEBcore: 13 Confirmed Enterprise Modules</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(2)}
      </div>
    </div>

    <p class="slide-subtitle">
      A purpose-built digital publishing and engagement platform that handles institutional announcements, event registration, admissions, and multimedia.
    </p>

    <!-- 4 Functional Pillars for WEBcore -->
    <div class="grid-4" style="gap: 0.9rem; margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: var(--theme-accent); margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> PAGES &amp; LAYOUT CMS
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Homepage Carousel:</strong> Reorder slides, captions &amp; CTAs<br>
          &bull; <strong>Section Layouts:</strong> Drag-and-drop order &amp; active toggles<br>
          &bull; <strong>Facilities Builder:</strong> Dynamic facility cards &amp; detail slugs<br>
          &bull; <strong>Leadership &amp; About:</strong> Mission, vision &amp; management profiles<br>
          &bull; <strong>Policy Manager:</strong> Privacy, terms &amp; custom draft workflows
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> EVENTS &amp; ACTIVITIES
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Event Categories:</strong> Multi-category school activities &amp; dates<br>
          &bull; <strong>Inter-School Fests:</strong> Multi-event registration &amp; schedules<br>
          &bull; <strong>Class Assemblies:</strong> Class filters &amp; assembly photo albums<br>
          &bull; <strong>Clubs &amp; Associations:</strong> Activity logs &amp; student coordinators<br>
          &bull; <strong>Headscroller Ticker:</strong> Speed-controlled news marquee alerts
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> ADMISSIONS &amp; PRIDE HUB
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Multi-Step Admissions:</strong> Step flow builder &amp; document uploads<br>
          &bull; <strong>Board Centum Records:</strong> Grade 10 &amp; 12 topper archives<br>
          &bull; <strong>Merit Scholarships:</strong> Annual scholarship awardee showcase<br>
          &bull; <strong>Alumni Network:</strong> Annual meets, global university admits<br>
          &bull; <strong>Trailblazer Stories:</strong> Inspirational human interest profiles
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>???</span> MEDIA &amp; AI ENGINE
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Campus Media Gallery:</strong> Drag-and-drop album reordering<br>
          &bull; <strong>AWS S3 CDN:</strong> Automated image compression &amp; WebP serving<br>
          &bull; <strong>Editorial Blog:</strong> Rich article editor, tags &amp; author assignment<br>
          &bull; <strong>AI Chatbot Assistant:</strong> Intent builder &amp; 1-click convert to FAQ<br>
          &bull; <strong>Popup Form Builder:</strong> Lead capture modal campaign manager
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_15.html", "w", encoding="utf-8") as f:
    f.write(s15)

# Slide 16: WEBcore Publishing Cycle
s16 = f"""<section class="slide-item theme-web" id="slide-16" data-index="16" data-section="PRODUCT 04 // WEBCORE" data-theme="theme-web">
  <div class="product-watermark-bg">WEBCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_WEB}" alt="WEBcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // DIGITAL EXPERIENCE &amp; CMS PLATFORM</div>
          <h3>WEBcore: The Enterprise Digital Publishing Cycle</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(3)}
      </div>
    </div>

    <p class="slide-subtitle">
      WEBcore establishes a rapid, secure content pipeline that turns institutional milestones into beautiful, live public engagements within minutes.
    </p>

    <!-- Visual Journey Flow -->
    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Create</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Rich Text, Media &amp; Banners</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Manage</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Draft Review &amp; Role Approval</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Publish</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">AWS S3 Cloud Delivery</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Optimize</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">SEO Tags &amp; Mobile Preview</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(0, 240, 255, 0.12);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">05. Analyze</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Lead Inquiries &amp; AI Resolution</div>
      </div>
    </div>

    <!-- Publishing Capabilities Synergy -->
    <div class="grid-3" style="margin-top: 0.6rem;">
      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>?</span> Non-Technical Team Empowerment
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Communications officers, admissions staff, and teachers can publish announcements, photo galleries, and blog articles without writing a single line of HTML code.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>??</span> High-Performance Media Pipeline
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Direct AWS S3 integration automatically compresses raw camera uploads into modern WebP formats with multi-resolution thumbnails for instant mobile loading.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>??</span> Automated Lead Capture Engine
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Floating AI chatbot and custom modal forms channel visitor inquiries into structured admin leads with instant email notifications and Excel export capability.
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_16.html", "w", encoding="utf-8") as f:
    f.write(s16)

# Slide 17: WEBcore Governance & Impact
s17 = f"""<section class="slide-item theme-web" id="slide-17" data-index="17" data-section="PRODUCT 04 // WEBCORE" data-theme="theme-web">
  <div class="product-watermark-bg">WEBCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_WEB}" alt="WEBcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // DIGITAL EXPERIENCE &amp; CMS PLATFORM</div>
          <h3>WEBcore: Proven Digital Governance Impact &amp; ROI</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(4)}
      </div>
    </div>

    <p class="slide-subtitle">
      WEBcore puts institutional communication teams back in control &mdash; delivering agility, brand consistency, and conversion-engineered admission pipelines.
    </p>

    <!-- Verified Value Metrics -->
    <div class="grid-4" style="margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: var(--theme-accent);">100%</div>
        <div class="stat-label">Developer Independence</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Update hero carousels, admission notices, policy pages, and fests directly from the admin console in seconds.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #34D399;">&lt; 5 Min</div>
        <div class="stat-label">Publishing Velocity</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Draft, approve, and push urgent announcements or media gallery albums live to visitors immediately.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">24/7</div>
        <div class="stat-label">AI Visitor Assistance</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Automated inquiry resolution for campus visits, admission deadlines, and fee policies without staff overhead.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #C084FC;">SEO-Ready</div>
        <div class="stat-label">Organic Visibility</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Automated meta titles, custom slugs, XML sitemaps, and OpenGraph tags maximize search engine rankings.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card card-theme-glow" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: var(--theme-accent); text-align: center; padding: 1.4rem; margin-top: 1rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: var(--theme-accent); font-weight: 700; text-transform: uppercase; margin-bottom: 0.4rem;">
        THE WEBCORE PHILOSOPHY
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.2rem, 2.2vw, 1.8rem); font-weight: 900; color: #FFF;">
        &ldquo;Build once. Manage intelligently. Evolve continuously.&rdquo;
      </h3>
      <p style="font-size: 0.82rem; color: var(--text-muted); margin-top: 0.4rem; max-width: 760px; margin-left: auto; margin-right: auto;">
        From school assemblies and inter-school fest portals to alumni tracking and admission pipelines &mdash; WEBcore elevates your institution's digital identity.
      </p>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_17.html", "w", encoding="utf-8") as f:
    f.write(s17)

print("WEBcore Slides 14, 15, 16, 17 generated successfully.")
