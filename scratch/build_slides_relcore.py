import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# =========================================================================
# SLIDE 10: RELCORE INTRODUCTION
# =========================================================================
s10 = """
<section class="slide-item" id="slide-10" data-index="10" data-section="PRODUCT 03 // RELCORE">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.4rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--primary);"></span>
          PRODUCT 03 • ENTERPRISE CRM & REVENUE ACCELERATION PLATFORM
        </div>
        <h2 class="slide-title">
          RELcore <br>
          <span class="slide-title-gradient">Relationships That Drive Growth</span>
        </h2>
      </div>
      <div style="text-align: right;">
        <span class="tech-tag tech-tag-primary" style="font-size: 0.82rem; padding: 0.35rem 0.9rem;">19 Confirmed Enterprise Modules</span>
      </div>
    </div>

    <p class="slide-subtitle">
      RELcore is KNR's comprehensive customer relationship and commercial operations engine. 
      It unites sales pipelines, customer 360 intelligence, multi-warehouse inventory, automated invoicing with MYOB integration, and customer support into one synchronized platform.
    </p>

    <!-- 3 Core Tenets of RELcore -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card glass-card-glow-primary">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(59, 130, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          💼
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Revenue Pipeline Acceleration</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Visual drag-and-drop Kanban deal pipeline with AI deal suggestions, win probability scoring, commercial offer bundling, and multi-tier approval workflows.
        </p>
      </div>

      <div class="glass-card glass-card-glow-emerald">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(16, 185, 129, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          💳
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">FinTech & 2-Way MYOB Accounting</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          End-to-end billing with automated quote-to-invoice generation, customer advances credit ledgers, online Razorpay payments, and seamless 2-way MYOB ledger synchronization.
        </p>
      </div>

      <div class="glass-card glass-card-glow-purple">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(139, 92, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          🔭
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Customer 360° Intelligence</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Consolidated single source of truth tracking communication histories, phone call logs, support tickets, contracts, and lifetime account health indicators.
        </p>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 11: RELCORE CAPABILITIES
# =========================================================================
s11 = """
<section class="slide-item" id="slide-11" data-index="11" data-section="PRODUCT 03 // RELCORE">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.1rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--primary);"></span>
          PLATFORM CAPABILITIES
        </div>
        <h2 class="slide-title">
          19 Confirmed Enterprise Modules
        </h2>
      </div>
      <div style="text-align: right;">
        <span style="font-family: var(--font-mono); font-size: 0.85rem; color: #60A5FA; font-weight: 700;">Integrations: MYOB • Razorpay • Google Calendar • Zoom</span>
      </div>
    </div>

    <!-- 4 Functional Pillars for RELcore -->
    <div class="grid-4" style="gap: 0.9rem;">
      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>⚡</span> SALES & PIPELINE
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Kanban Deals:</strong> Drag-and-drop stages, win rates & forecast<br>
          • <strong>AI Deal Suggestions:</strong> Stagnation alerts & next best actions<br>
          • <strong>Commercial Offers:</strong> Bundled product discount packages<br>
          • <strong>Price Books:</strong> Multi-tier pricing catalogs & customer tiers<br>
          • <strong>Approval Center:</strong> Multi-level manager sign-off workflows
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>💰</span> BILLING & INVENTORY
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Quotes & Invoices:</strong> 1-click conversion & automated PDFs<br>
          • <strong>Customer Advances:</strong> Advance payment deposit ledger<br>
          • <strong>MYOB 2-Way Sync:</strong> Full accounting ledger reconciliation<br>
          • <strong>Multi-Warehouse Stock:</strong> Location transfers & safety stock<br>
          • <strong>Dead Stock Actions:</strong> Slow inventory clearance triggers
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>📞</span> ENGAGEMENT & MARKETING
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Omnichannel Marketing:</strong> Email & SMS automated campaigns<br>
          • <strong>Telephony & Email:</strong> IMAP/SMTP sync & call outcome logs<br>
          • <strong>Meetings Calendar:</strong> 2-way Google Calendar & Zoom sync<br>
          • <strong>Prioritized Tasks:</strong> Smart rep work queues & SLA reminders<br>
          • <strong>Customer Segments:</strong> Dynamic behavior & engagement filters
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🛡️</span> GOVERNANCE & ANALYTICS
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Support Desk:</strong> SLA monitoring & customer self-service portal<br>
          • <strong>Custom Report Builder:</strong> Drag-and-drop multi-entity BI<br>
          • <strong>Document Vault:</strong> Secure cloud file repository & contracts<br>
          • <strong>Recycle Bin DLP:</strong> Soft-delete safety net & 30-day purge<br>
          • <strong>Multi-Tenancy & MFA:</strong> Workspace isolation & TOTP security
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 12: RELCORE BUSINESS ECOSYSTEM
# =========================================================================
s12 = """
<section class="slide-item" id="slide-12" data-index="12" data-section="PRODUCT 03 // RELCORE">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--primary);"></span>
      REVENUE LIFECYCLE ARCHITECTURE
    </div>
    <h2 class="slide-title">
      End-to-End Commercial Growth Flow
    </h2>
    <p class="slide-subtitle">
      RELcore synchronizes every department across the customer journey — ensuring zero lost leads, accelerated sales execution, and lifetime account retention.
    </p>

    <!-- Visual Journey Flow -->
    <div class="flow-container" style="margin: 1.6rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🎯</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">01. Lead</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Campaigns & Ingestion</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🤝</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Engagement</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Calls, Emails & Meetings</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">📈</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Opportunity</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Kanban Deals & Offers</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">💳</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Invoicing</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Razorpay & MYOB Sync</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">📦</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Fulfillment</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Multi-Warehouse Stock</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step" style="border-color: var(--cyan); background: rgba(0, 240, 255, 0.08);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🚀</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">06. Growth</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Customer 360 Retention</div>
      </div>
    </div>

    <!-- Departmental Synergy Cards -->
    <div class="grid-3" style="margin-top: 0.8rem;">
      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>🤝</span> Sales & Management Sync
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Reps manage their prioritized work queue while sales executives gain live forecast dashboards, rep win-rate leaderboards, and approval workflows.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>📊</span> Finance & Accounting Sync
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Direct synchronization with MYOB Accounting ensures invoices, customer advances, credit adjustments, and tax codes match financial ledgers.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>🎧</span> Operations & Support Sync
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Client issues logged via the Customer Portal link directly to the account 360 timeline, triggering automated SLA breach warnings and ticket-to-task conversions.
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 13: RELCORE VALUE
# =========================================================================
s13 = """
<section class="slide-item" id="slide-13" data-index="13" data-section="PRODUCT 03 // RELCORE">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--primary);"></span>
      ENTERPRISE VALUE & ROI
    </div>
    <h2 class="slide-title">
      Proven Commercial Impact
    </h2>
    <p class="slide-subtitle">
      RELcore replaces fragmented sales spreadsheets with an intelligent, auditable revenue acceleration engine.
    </p>

    <!-- Verified Value Metrics -->
    <div class="grid-4" style="margin-bottom: 1.5rem;">
      <div class="glass-card glass-card-glow-primary" style="text-align: center;">
        <div class="stat-huge" style="color: #60A5FA;">100%</div>
        <div class="stat-label">Pipeline Visibility</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Real-time visibility from initial marketing touchpoint to closed deal, invoicing, and warehouse dispatch.
        </p>
      </div>

      <div class="glass-card glass-card-glow-emerald" style="text-align: center;">
        <div class="stat-huge" style="color: #34D399;">Zero</div>
        <div class="stat-label">Revenue Leakage</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Automated payment tracking, MYOB invoice reconciliation, advance deposits, and overdue reminders.
        </p>
      </div>

      <div class="glass-card glass-card-glow-amber" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">AI-Led</div>
        <div class="stat-label">Deal Velocity</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Smart stagnation alerts prompt sales reps with optimal follow-up timings and discount parameters.
        </p>
      </div>

      <div class="glass-card glass-card-glow-purple" style="text-align: center;">
        <div class="stat-huge" style="color: #C084FC;">30-Day</div>
        <div class="stat-label">Data Recovery Vault</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Universal Recycle Bin soft-delete protection guards critical customer data and deals against accidental loss.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: #60A5FA; text-align: center; padding: 1.8rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: #60A5FA; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
        THE RELCORE PROMISE
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.3rem, 2.4vw, 2.2rem); font-weight: 900; color: #FFF;">
        “From leads to lasting relationships.”
      </h3>
      <p style="font-size: 0.84rem; color: var(--text-muted); margin-top: 0.5rem; max-width: 720px; margin-left: auto; margin-right: auto;">
        Connecting marketing, sales execution, inventory fulfillment, and customer support into one unified commercial growth engine.
      </p>
    </div>
  </div>
</section>
"""

write_slide(10, s10)
write_slide(11, s11)
write_slide(12, s12)
write_slide(13, s13)
