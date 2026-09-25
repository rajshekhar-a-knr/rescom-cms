import sys
sys.path.insert(0, "scratch")
import icons as ic

LOGO_REL = "https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_5ca81605-0654-4ee7-ac04-412e675862e5_RELcore.webp"
LOGO_WEB = "https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/product_logos/Webcorebg.png"

def standard_stepper(steps, active_idx):
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

# SLIDE 10: RELcore 1/4
rel_steps = ["1. CRM VISION", "2. 19 MODULES", "3. COMMERCIAL FLOW", "4. PROVEN ROI"]
s10 = f"""<section class="slide-item theme-rel" id="slide-10" data-index="10" data-section="PRODUCT 03 // RELCORE" data-theme="theme-rel">
  <div class="product-watermark-bg">RELCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_REL}" alt="RELcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // CRM &amp; REVENUE ACCELERATION PLATFORM</div>
          <h3>RELcore: Relationships That Drive Growth</h3>
        </div>
      </div>
      <div class="product-header-right">
        {standard_stepper(rel_steps, 1)}
      </div>
    </div>

    <p class="slide-subtitle">
      RELcore is KNR's comprehensive customer relationship and commercial operations engine. 
      It unites sales pipelines, customer 360 intelligence, multi-warehouse inventory, automated invoicing with MYOB integration, and customer support into one synchronized platform.
    </p>

    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(129, 140, 248, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
          {ic.icon('briefcase', 24, '#818CF8')}
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Revenue Pipeline Acceleration</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Visual drag-and-drop Kanban deal pipeline with AI deal suggestions, win probability scoring, commercial offer bundling, price book controls, and multi-tier approval workflows.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">Kanban Deals</span>
          <span class="tech-tag">AI Suggestions</span>
          <span class="tech-tag">Price Books</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(129, 140, 248, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
          {ic.icon('credit_card', 24, '#818CF8')}
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">FinTech &amp; 2-Way MYOB Accounting</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          End-to-end billing with automated quote-to-invoice generation, customer advances credit ledgers, online Razorpay payments, and seamless 2-way MYOB ledger synchronization.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">MYOB 2-Way</span>
          <span class="tech-tag">Customer Advances</span>
          <span class="tech-tag">Auto Invoices</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(129, 140, 248, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
          {ic.icon('compass', 24, '#818CF8')}
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Customer 360&deg; Intelligence</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Consolidated single source of truth tracking communication histories, phone call logs, support tickets, contracts, multi-warehouse shipments, and lifetime account health indicators.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">Omnichannel CRM</span>
          <span class="tech-tag">SLA Support Desk</span>
          <span class="tech-tag">Recycle Bin DLP</span>
        </div>
      </div>
    </div>

    <div class="glass-card" style="margin-top: 0.8rem; padding: 0.8rem 1.25rem; display: flex; align-items: center; justify-content: space-between; background: rgba(129, 140, 248, 0.08); border-color: rgba(129, 140, 248, 0.25);">
      <div style="display: flex; align-items: center; gap: 0.8rem;">
        {ic.icon('zap', 20, '#818CF8')}
        <span style="font-size: 0.82rem; color: #FFF; font-weight: 600;">Full Integration: MYOB Accounting, Razorpay Gateway, Google Calendar &amp; Zoom Telephony.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">19 Confirmed Modules</span>
    </div>
  </div>
</section>"""
with open("scratch/slides/slide_10.html", "w", encoding="utf-8") as f: f.write(s10)

# SLIDE 11: RELcore 2/4
s11 = f"""<section class="slide-item theme-rel" id="slide-11" data-index="11" data-section="PRODUCT 03 // RELCORE" data-theme="theme-rel">
  <div class="product-watermark-bg">RELCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_REL}" alt="RELcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // CRM &amp; REVENUE ACCELERATION PLATFORM</div>
          <h3>RELcore: 19 Confirmed Enterprise Modules</h3>
        </div>
      </div>
      <div class="product-header-right">
        {standard_stepper(rel_steps, 2)}
      </div>
    </div>

    <p class="slide-subtitle">
      A modular revenue engine engineered to govern the entire customer lifecycle from initial marketing touchpoints to recurring account retention.
    </p>

    <div class="grid-4" style="gap: 0.9rem; margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="display:flex; align-items:center; gap:0.45rem; font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #818CF8; margin-bottom: 0.55rem;">
          {ic.icon('zap', 18, '#818CF8')} SALES &amp; PIPELINE
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Kanban Deals:</strong> Drag-and-drop stages, win rates &amp; forecast<br>
          &bull; <strong>AI Deal Suggestions:</strong> Stagnation alerts &amp; next best actions<br>
          &bull; <strong>Commercial Offers:</strong> Bundled product discount packages<br>
          &bull; <strong>Price Books:</strong> Multi-tier pricing catalogs &amp; customer tiers<br>
          &bull; <strong>Approval Center:</strong> Multi-level manager sign-off workflows
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="display:flex; align-items:center; gap:0.45rem; font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem;">
          {ic.icon('credit_card', 18, '#34D399')} BILLING &amp; INVENTORY
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Quotes &amp; Invoices:</strong> 1-click conversion &amp; automated PDFs<br>
          &bull; <strong>Customer Advances:</strong> Advance payment deposit ledger<br>
          &bull; <strong>MYOB 2-Way Sync:</strong> Full accounting ledger reconciliation<br>
          &bull; <strong>Multi-Warehouse Stock:</strong> Location transfers &amp; safety stock<br>
          &bull; <strong>Dead Stock Actions:</strong> Slow inventory clearance triggers
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="display:flex; align-items:center; gap:0.45rem; font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem;">
          {ic.icon('phone', 18, '#FBBF24')} ENGAGEMENT &amp; MARKETING
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Omnichannel Marketing:</strong> Email &amp; SMS automated campaigns<br>
          &bull; <strong>Telephony &amp; Email:</strong> IMAP/SMTP sync &amp; call outcome logs<br>
          &bull; <strong>Meetings Calendar:</strong> 2-way Google Calendar &amp; Zoom sync<br>
          &bull; <strong>Prioritized Tasks:</strong> Smart rep work queues &amp; SLA reminders<br>
          &bull; <strong>Customer Segments:</strong> Dynamic behavior &amp; engagement filters
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="display:flex; align-items:center; gap:0.45rem; font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem;">
          {ic.icon('shield', 18, '#C084FC')} GOVERNANCE &amp; ANALYTICS
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Support Desk:</strong> SLA monitoring &amp; customer self-service portal<br>
          &bull; <strong>Custom Report Builder:</strong> Drag-and-drop multi-entity BI<br>
          &bull; <strong>Document Vault:</strong> Secure cloud file repository &amp; contracts<br>
          &bull; <strong>Recycle Bin DLP:</strong> Soft-delete safety net &amp; 30-day purge<br>
          &bull; <strong>Multi-Tenancy &amp; MFA:</strong> Workspace isolation &amp; TOTP security
        </div>
      </div>
    </div>
  </div>
</section>"""
with open("scratch/slides/slide_11.html", "w", encoding="utf-8") as f: f.write(s11)

# SLIDE 12: RELcore 3/4
s12 = f"""<section class="slide-item theme-rel" id="slide-12" data-index="12" data-section="PRODUCT 03 // RELCORE" data-theme="theme-rel">
  <div class="product-watermark-bg">RELCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_REL}" alt="RELcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // CRM &amp; REVENUE ACCELERATION PLATFORM</div>
          <h3>RELcore: End-to-End Commercial Growth Flow</h3>
        </div>
      </div>
      <div class="product-header-right">
        {standard_stepper(rel_steps, 3)}
      </div>
    </div>

    <p class="slide-subtitle">
      RELcore synchronizes every department across the customer journey &mdash; ensuring zero lost leads, accelerated sales execution, and lifetime account retention.
    </p>

    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('target', 24, '#818CF8')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Lead</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Campaigns &amp; Ingestion</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('message', 24, '#60A5FA')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Engagement</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Calls &amp; Meetings</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('chart', 24, '#34D399')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Opportunity</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Kanban &amp; Offers</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('credit_card', 24, '#FBBF24')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Invoicing</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Razorpay &amp; MYOB</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('package', 24, '#C084FC')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Fulfillment</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Warehouse Stock</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(129, 140, 248, 0.12);">
        <div style="margin-bottom: 0.3rem;">{ic.icon('rocket', 24, '#818CF8')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">06. Growth</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Customer 360</div>
      </div>
    </div>

    <div class="grid-3" style="margin-top: 0.6rem;">
      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('user', 18, '#818CF8')} Sales &amp; Management Sync
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Reps manage their prioritized work queue while sales executives gain live forecast dashboards, rep win-rate leaderboards, and approval workflows.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('chart', 18, '#34D399')} Finance &amp; Accounting Sync
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Direct synchronization with MYOB Accounting ensures invoices, customer advances, credit adjustments, and tax codes match financial ledgers.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('shield', 18, '#60A5FA')} Operations &amp; Support Sync
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Client issues logged via the Customer Portal link directly to the account 360 timeline, triggering automated SLA breach warnings and ticket-to-task conversions.
        </div>
      </div>
    </div>
  </div>
</section>"""
with open("scratch/slides/slide_12.html", "w", encoding="utf-8") as f: f.write(s12)

# SLIDE 14: WEBcore 1/4
web_steps = ["1. DIGITAL ENGINE", "2. 13 MODULES", "3. PUBLISHING STACK", "4. GOVERNANCE & IMPACT"]
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
        {standard_stepper(web_steps, 1)}
      </div>
    </div>

    <p class="slide-subtitle">
      WEBcore is KNR's enterprise digital experience and content management platform. 
      It grants organizations total autonomy over their public websites, announcements, event fests, media galleries, 
      and online admissions &mdash; completely eliminating dependence on web developers.
    </p>

    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
          {ic.icon('globe', 24, '#00F0FF')}
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
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
          {ic.icon('megaphone', 24, '#00F0FF')}
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
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
          {ic.icon('bot', 24, '#00F0FF')}
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
        {ic.icon('zap', 20, '#00F0FF')}
        <span style="font-size: 0.82rem; color: #FFF; font-weight: 600;">Media Stack: AWS S3 CDN Storage, Automated WebP Image Compression, and SEO Tag Automation.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">13 Confirmed Modules</span>
    </div>
  </div>
</section>"""
with open("scratch/slides/slide_14.html", "w", encoding="utf-8") as f: f.write(s14)

# SLIDE 15: WEBcore 2/4
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
        {standard_stepper(web_steps, 2)}
      </div>
    </div>

    <p class="slide-subtitle">
      A purpose-built digital publishing and engagement platform that handles institutional announcements, event registration, admissions, and multimedia.
    </p>

    <div class="grid-4" style="gap: 0.9rem; margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="display:flex; align-items:center; gap:0.45rem; font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: var(--theme-accent); margin-bottom: 0.55rem;">
          {ic.icon('globe', 18, '#00F0FF')} PAGES &amp; LAYOUT CMS
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
        <div style="display:flex; align-items:center; gap:0.45rem; font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem;">
          {ic.icon('party', 18, '#34D399')} EVENTS &amp; ACTIVITIES
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
        <div style="display:flex; align-items:center; gap:0.45rem; font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem;">
          {ic.icon('award', 18, '#FBBF24')} ADMISSIONS &amp; PRIDE HUB
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
        <div style="display:flex; align-items:center; gap:0.45rem; font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem;">
          {ic.icon('image', 18, '#C084FC')} MEDIA &amp; AI ENGINE
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
with open("scratch/slides/slide_15.html", "w", encoding="utf-8") as f: f.write(s15)

# SLIDE 16: WEBcore 3/4
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
        {standard_stepper(web_steps, 3)}
      </div>
    </div>

    <p class="slide-subtitle">
      WEBcore establishes a rapid, secure content pipeline that turns institutional milestones into beautiful, live public engagements within minutes.
    </p>

    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('pen', 24, '#00F0FF')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Create</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Rich Text &amp; Banners</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('shield', 24, '#60A5FA')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Manage</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Drafts &amp; Approvals</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('rocket', 24, '#34D399')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Publish</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">AWS S3 Cloud Delivery</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="margin-bottom: 0.3rem;">{ic.icon('search', 24, '#FBBF24')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Optimize</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">SEO &amp; Mobile Preview</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(0, 240, 255, 0.12);">
        <div style="margin-bottom: 0.3rem;">{ic.icon('chart', 24, '#00F0FF')}</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">05. Analyze</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Inquiries &amp; Resolution</div>
      </div>
    </div>

    <div class="grid-3" style="margin-top: 0.6rem;">
      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('zap', 18, '#00F0FF')} Non-Technical Team Empowerment
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Communications officers, admissions staff, and teachers can publish announcements, photo galleries, and blog articles without writing a single line of HTML code.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('cloud', 18, '#60A5FA')} High-Performance Media Pipeline
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Direct AWS S3 integration automatically compresses raw camera uploads into modern WebP formats with multi-resolution thumbnails for instant mobile loading.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="display:flex; align-items:center; gap:0.4rem; font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem;">
          {ic.icon('target', 18, '#34D399')} Automated Lead Capture Engine
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Floating AI chatbot and custom modal forms channel visitor inquiries into structured admin leads with instant email notifications and Excel export capability.
        </div>
      </div>
    </div>
  </div>
</section>"""
with open("scratch/slides/slide_16.html", "w", encoding="utf-8") as f: f.write(s16)

print("RELcore and WEBcore slides updated with SVG icons successfully.")
