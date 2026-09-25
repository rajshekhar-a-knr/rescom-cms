# Generator for RELcore Slides (10, 11, 12, 13)

LOGO_REL = "https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_5ca81605-0654-4ee7-ac04-412e675862e5_RELcore.webp"

def get_stepper(active_idx):
    steps = ["1. CRM VISION", "2. 19 MODULES", "3. COMMERCIAL FLOW", "4. PROVEN ROI"]
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

# Slide 10: RELcore Identity & Vision
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
        {get_stepper(1)}
      </div>
    </div>

    <p class="slide-subtitle">
      RELcore is KNR's comprehensive customer relationship and commercial operations engine. 
      It unites sales pipelines, customer 360 intelligence, multi-warehouse inventory, automated invoicing with MYOB integration, and customer support into one synchronized platform.
    </p>

    <!-- 3 Core Tenets of RELcore -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(129, 140, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
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
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(129, 140, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
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
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(129, 140, 248, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
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
        <span style="font-size: 1.3rem;">?</span>
        <span style="font-size: 0.82rem; color: #FFF; font-weight: 600;">Full Integration: MYOB Accounting, Razorpay Gateway, Google Calendar &amp; Zoom Telephony.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">19 Confirmed Modules</span>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_10.html", "w", encoding="utf-8") as f:
    f.write(s10)

# Slide 11: RELcore 19 Modules Matrix
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
        {get_stepper(2)}
      </div>
    </div>

    <p class="slide-subtitle">
      A modular revenue engine engineered to govern the entire customer lifecycle from initial marketing touchpoints to recurring account retention.
    </p>

    <!-- 4 Functional Pillars for RELcore -->
    <div class="grid-4" style="gap: 0.9rem; margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #818CF8; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>?</span> SALES &amp; PIPELINE
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
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> BILLING &amp; INVENTORY
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
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> ENGAGEMENT &amp; MARKETING
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
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>???</span> GOVERNANCE &amp; ANALYTICS
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

with open("scratch/slides/slide_11.html", "w", encoding="utf-8") as f:
    f.write(s11)

# Slide 12: RELcore Commercial Growth Flow
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
        {get_stepper(3)}
      </div>
    </div>

    <p class="slide-subtitle">
      RELcore synchronizes every department across the customer journey &mdash; ensuring zero lost leads, accelerated sales execution, and lifetime account retention.
    </p>

    <!-- Visual Journey Flow -->
    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Lead</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Campaigns &amp; Ingestion</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #818CF8;">02. Engagement</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Calls, Emails &amp; Meetings</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Opportunity</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Kanban Deals &amp; Offers</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Invoicing</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Razorpay &amp; MYOB Sync</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Fulfillment</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Multi-Warehouse Stock</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(129, 140, 248, 0.12);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">06. Growth</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Customer 360 Retention</div>
      </div>
    </div>

    <!-- Departmental Synergy Cards -->
    <div class="grid-3" style="margin-top: 0.6rem;">
      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>??</span> Sales &amp; Management Sync
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Reps manage their prioritized work queue while sales executives gain live forecast dashboards, rep win-rate leaderboards, and approval workflows.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>??</span> Finance &amp; Accounting Sync
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Direct synchronization with MYOB Accounting ensures invoices, customer advances, credit adjustments, and tax codes match financial ledgers.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>??</span> Operations &amp; Support Sync
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Client issues logged via the Customer Portal link directly to the account 360 timeline, triggering automated SLA breach warnings and ticket-to-task conversions.
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_12.html", "w", encoding="utf-8") as f:
    f.write(s12)

# Slide 13: RELcore Commercial Impact
s13 = f"""<section class="slide-item theme-rel" id="slide-13" data-index="13" data-section="PRODUCT 03 // RELCORE" data-theme="theme-rel">
  <div class="product-watermark-bg">RELCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_REL}" alt="RELcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ENTERPRISE // CRM &amp; REVENUE ACCELERATION PLATFORM</div>
          <h3>RELcore: Proven Commercial Impact &amp; ROI</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(4)}
      </div>
    </div>

    <p class="slide-subtitle">
      RELcore replaces fragmented sales spreadsheets with an intelligent, auditable revenue acceleration engine that delivers measurable return on investment.
    </p>

    <!-- Verified Value Metrics -->
    <div class="grid-4" style="margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: var(--theme-accent);">100%</div>
        <div class="stat-label">Pipeline Visibility</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Real-time visibility from initial marketing touchpoint to closed deal, invoicing, and warehouse dispatch.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #34D399;">Zero</div>
        <div class="stat-label">Revenue Leakage</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Automated payment tracking, MYOB invoice reconciliation, advance deposits, and overdue reminders.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">AI-Led</div>
        <div class="stat-label">Deal Velocity</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Smart stagnation alerts prompt sales reps with optimal follow-up timings and discount parameters.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #C084FC;">30-Day</div>
        <div class="stat-label">Data Recovery Vault</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Universal Recycle Bin soft-delete protection guards critical customer data and deals against accidental loss.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card card-theme-glow" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: var(--theme-accent); text-align: center; padding: 1.4rem; margin-top: 1rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: var(--theme-accent); font-weight: 700; text-transform: uppercase; margin-bottom: 0.4rem;">
        THE RELCORE PROMISE
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.2rem, 2.2vw, 1.8rem); font-weight: 900; color: #FFF;">
        &ldquo;From leads to lasting relationships.&rdquo;
      </h3>
      <p style="font-size: 0.82rem; color: var(--text-muted); margin-top: 0.4rem; max-width: 760px; margin-left: auto; margin-right: auto;">
        Connecting marketing, sales execution, inventory fulfillment, and customer support into one unified commercial growth engine.
      </p>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_13.html", "w", encoding="utf-8") as f:
    f.write(s13)

print("RELcore Slides 10, 11, 12, 13 generated successfully.")
