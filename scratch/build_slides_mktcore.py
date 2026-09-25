import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# =========================================================================
# SLIDE 18: MKTCORE INTRODUCTION
# =========================================================================
s18 = """
<section class="slide-item" id="slide-18" data-index="18" data-section="PRODUCT 05 // MKTCORE">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.4rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--emerald);"></span>
          PRODUCT 05 • MULTI-VENDOR DIGITAL COMMERCE & MARKETING PLATFORM
        </div>
        <h2 class="slide-title">
          MKTcore <br>
          <span class="slide-title-gradient">Turning Marketing Into Measurable Growth</span>
        </h2>
      </div>
      <div style="text-align: right;">
        <span class="tech-tag tech-tag-emerald" style="font-size: 0.82rem; padding: 0.35rem 0.9rem;">500+ Multi-Vendor Scale</span>
      </div>
    </div>

    <p class="slide-subtitle">
      MKTcore is KNR's high-velocity multi-vendor digital commerce and growth marketing platform. 
      It transforms marketing campaigns into direct digital revenue by providing a lightning-fast Progressive Web App (PWA) storefront, 
      real-time inventory reservation locks, multi-vendor split-fulfillment, and automated payment gateway settlements.
    </p>

    <!-- 3 Core Tenets of MKTcore -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card glass-card-glow-emerald">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(16, 185, 129, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          📱
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">High-Velocity Storefront PWA</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Mobile-first Progressive Web App with service worker offline caching, sub-50ms fuzzy full-text search, and automated WebP multi-tier image processing.
        </p>
      </div>

      <div class="glass-card glass-card-glow-amber">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          🛒
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Smart Stock-Lock Cart & Checkout</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Prevents overselling during high-volume promotions with real-time stock reservation locks, price-drift safeguards, and an optimized 4-step conversion funnel.
        </p>
      </div>

      <div class="glass-card glass-card-glow-purple">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(139, 92, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          🏬
        </div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Multi-Vendor Merchant Ecosystem</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Self-serve vendor onboarding with KYC verification, dynamic category commission tiers, automated cart splitting, and transparent bank wire payout tracking.
        </p>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 19: MKTCORE CAPABILITIES
# =========================================================================
s19 = """
<section class="slide-item" id="slide-19" data-index="19" data-section="PRODUCT 05 // MKTCORE">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.1rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--emerald);"></span>
          COMMERCE & MARKETING CAPABILITIES
        </div>
        <h2 class="slide-title">
          15 Confirmed High-Velocity Modules
        </h2>
      </div>
      <div style="text-align: right;">
        <span style="font-family: var(--font-mono); font-size: 0.85rem; color: #34D399; font-weight: 700;">FinTech: Razorpay • Stripe • COD • Reverse Logistics</span>
      </div>
    </div>

    <!-- 4 Functional Pillars for MKTcore -->
    <div class="grid-4" style="gap: 0.9rem;">
      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #34D399; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🛍️</span> STOREFRONT & CATALOG
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Storefront PWA:</strong> Service worker caching & add-to-home-screen<br>
          • <strong>Smart Search:</strong> Sub-50ms fuzzy query & 'Did You Mean'<br>
          • <strong>Variant Matrix:</strong> Unlimited size, color, specs & auto-SKUs<br>
          • <strong>WebP Pipeline:</strong> Auto-compression & zoomable photo gallery<br>
          • <strong>Social Proof:</strong> Verified buyer badge reviews & community Q&A
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>⚡</span> CART, PROMOS & CHECKOUT
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Smart Cart:</strong> Real-time inventory reservation lock & sync<br>
          • <strong>Price Drift Safeguard:</strong> Live price change alert & review<br>
          • <strong>12+ Coupon Rules:</strong> Percentage, flat, free shipping & caps<br>
          • <strong>4-Step Checkout:</strong> Geolocation address, shipping & payment<br>
          • <strong>Fraud Safeguards:</strong> Device fingerprint lock & per-user limits
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>💳</span> FINTECH & LOGISTICS
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Multi-Gateway Hub:</strong> Razorpay webhooks, Stripe & COD<br>
          • <strong>Tax Invoicing:</strong> Automated GST/VAT-compliant PDF generation<br>
          • <strong>Pincode Logistics:</strong> Serviceability checks & packing slips<br>
          • <strong>6-State Order Machine:</strong> Split-vendor fulfillment pipeline<br>
          • <strong>Automated Returns:</strong> Defect photo uploads & direct API refunds
        </div>
      </div>

      <div class="glass-card" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>🏬</span> MULTI-VENDOR GOVERNANCE
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.55;">
          • <strong>Vendor Portal & KYC:</strong> Document vault (GST, PAN, Trade License)<br>
          • <strong>Product Moderation:</strong> Admin approval queue & catalog curation<br>
          • <strong>Commission Engine:</strong> Dynamic platform & category % cuts<br>
          • <strong>Payout Ledger:</strong> Vendor balances, bank wire & UTR records<br>
          • <strong>Support Desk & Bot:</strong> Threaded inquiries & e-commerce bot
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 20: MKTCORE ECOSYSTEM
# =========================================================================
s20 = """
<section class="slide-item" id="slide-20" data-index="20" data-section="PRODUCT 05 // MKTCORE">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--emerald);"></span>
      COMMERCE ORCHESTRATION ARCHITECTURE
    </div>
    <h2 class="slide-title">
      End-to-End Multi-Vendor Commerce Flow
    </h2>
    <p class="slide-subtitle">
      MKTcore coordinates an intricate multi-party commerce network — enabling frictionless buying for consumers and automated operations for sellers and platform owners.
    </p>

    <!-- Visual Journey Flow -->
    <div class="flow-container" style="margin: 1.6rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🏬</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">01. Merchant</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">KYC Onboarding & Catalog</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">📱</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Discovery</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">PWA Storefront & Search</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🛒</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Smart Cart</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Stock-Lock & 12+ Promos</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">💳</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. FinTech</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Razorpay, Stripe & COD</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">📦</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Dispatch</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Multi-Vendor Split Fulfillment</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step" style="border-color: var(--cyan); background: rgba(0, 240, 255, 0.08);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">💸</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">06. Settlement</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Commission & Bank Payouts</div>
      </div>
    </div>

    <!-- Multi-Party Synergy -->
    <div class="grid-3" style="margin-top: 0.8rem;">
      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>🛍️</span> Shopper Experience
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Sub-second search results, real-time stock availability, saved address books with geolocation markers, transparent order timelines, and 1-click returns.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>🏬</span> Merchant Operations
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Dedicated seller dashboard to manage custom product catalogs, fulfill order queues with auto-generated packing slips, and monitor transparent payout balances.
        </div>
      </div>

      <div class="glass-card">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>🛡️</span> Platform Governance
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Complete admin moderation over product listings, category commission rates, fraud protection, financial ledgers, and automated GST compliance exports.
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 21: MKTCORE VALUE
# =========================================================================
s21 = """
<section class="slide-item" id="slide-21" data-index="21" data-section="PRODUCT 05 // MKTCORE">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--emerald);"></span>
      COMMERCIAL VALUE & SCALE
    </div>
    <h2 class="slide-title">
      Proven Multi-Vendor Marketplace Impact
    </h2>
    <p class="slide-subtitle">
      MKTcore empowers brand marketplaces and retailers to scale inventory, protect conversion rates, and automate merchant financial settlements.
    </p>

    <!-- Verified Value Metrics -->
    <div class="grid-4" style="margin-bottom: 1.5rem;">
      <div class="glass-card glass-card-glow-emerald" style="text-align: center;">
        <div class="stat-huge" style="color: #34D399;">500+</div>
        <div class="stat-label">Merchant Scale</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Architected to host hundreds of verified independent sellers with isolated stores and unified checkout.
        </p>
      </div>

      <div class="glass-card glass-card-glow-cyan" style="text-align: center;">
        <div class="stat-huge" style="color: var(--cyan);">Zero</div>
        <div class="stat-label">Stock Collisions</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Atomic inventory reservation locks prevent double-selling during viral promotional spikes and flash sales.
        </p>
      </div>

      <div class="glass-card glass-card-glow-amber" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">12+</div>
        <div class="stat-label">Promotion Drivers</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Granular campaign rules driving average order value through dynamic tiers, category whitelists, and caps.
        </p>
      </div>

      <div class="glass-card glass-card-glow-purple" style="text-align: center;">
        <div class="stat-huge" style="color: #C084FC;">Automated</div>
        <div class="stat-label">Reverse Logistics</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Transparent defect verification workflow with instant gateway API refunds directly back to customer cards.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: #34D399; text-align: center; padding: 1.8rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: #34D399; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
        THE MKTCORE PHILOSOPHY
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.3rem, 2.4vw, 2.2rem); font-weight: 900; color: #FFF;">
        “From cart clicks to verified customer value.”
      </h3>
      <p style="font-size: 0.84rem; color: var(--text-muted); margin-top: 0.5rem; max-width: 720px; margin-left: auto; margin-right: auto;">
        From lightning PWA mobile discovery to multi-vendor split delivery and automated bank payouts — MKTcore fuels modern enterprise commerce.
      </p>
    </div>
  </div>
</section>
"""

write_slide(18, s18)
write_slide(19, s19)
write_slide(20, s20)
write_slide(21, s21)
