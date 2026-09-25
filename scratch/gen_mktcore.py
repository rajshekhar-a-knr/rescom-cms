# Generator for MKTcore Slides (18, 19, 20, 21)

LOGO_MKT = "https://knrint-website.blr1.cdn.digitaloceanspaces.com/KNR-WEBSITE/2026/product_logos/MKTcore.png"

def get_stepper(active_idx):
    steps = ["1. COMMERCE ENGINE", "2. 15 MODULES", "3. TRANSACTION FLOW", "4. MARKETPLACE ROI"]
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

# Slide 18: MKTcore Identity
s18 = f"""<section class="slide-item theme-mkt" id="slide-18" data-index="18" data-section="PRODUCT 05 // MKTCORE" data-theme="theme-mkt">
  <div class="product-watermark-bg">MKTCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_MKT}" alt="MKTcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">COMMERCE // MULTI-VENDOR DIGITAL MARKETPLACE</div>
          <h3>MKTcore: Turning Marketing Into Measurable Growth</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(1)}
      </div>
    </div>

    <p class="slide-subtitle">
      MKTcore is KNR's high-velocity multi-vendor digital commerce and growth marketing platform. 
      It transforms marketing campaigns into direct digital revenue by providing a lightning-fast Progressive Web App (PWA) storefront, 
      real-time inventory reservation locks, multi-vendor split-fulfillment, and automated payment gateway settlements.
    </p>

    <!-- 3 Core Tenets of MKTcore -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(52, 211, 153, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">High-Velocity Storefront PWA</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Mobile-first Progressive Web App with service worker offline caching, sub-50ms fuzzy full-text search, and automated WebP multi-tier image processing.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">PWA Offline</span>
          <span class="tech-tag">Sub-50ms Search</span>
          <span class="tech-tag">WebP Media</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(52, 211, 153, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Smart Stock-Lock Cart &amp; Checkout</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Prevents overselling during high-volume promotions with real-time stock reservation locks, price-drift safeguards, and an optimized 4-step conversion funnel.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">Atomic Locks</span>
          <span class="tech-tag">12+ Coupons</span>
          <span class="tech-tag">Anti-Drift</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(52, 211, 153, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Multi-Vendor Merchant Ecosystem</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Self-serve vendor onboarding with KYC verification, dynamic category commission tiers, automated cart splitting, and transparent bank wire payout tracking.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">KYC Vault</span>
          <span class="tech-tag">Split Orders</span>
          <span class="tech-tag">Bank Payouts</span>
        </div>
      </div>
    </div>

    <div class="glass-card" style="margin-top: 0.8rem; padding: 0.8rem 1.25rem; display: flex; align-items: center; justify-content: space-between; background: rgba(52, 211, 153, 0.08); border-color: rgba(52, 211, 153, 0.25);">
      <div style="display: flex; align-items: center; gap: 0.8rem;">
        <span style="font-size: 1.3rem;">?</span>
        <span style="font-size: 0.82rem; color: #FFF; font-weight: 600;">FinTech &amp; Logistics: Razorpay Webhooks, Stripe Connect, COD Verification &amp; Reverse API Refunds.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">500+ Vendor Scalability</span>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_18.html", "w", encoding="utf-8") as f:
    f.write(s18)

# Slide 19: MKTcore 15 Modules Matrix
s19 = f"""<section class="slide-item theme-mkt" id="slide-19" data-index="19" data-section="PRODUCT 05 // MKTCORE" data-theme="theme-mkt">
  <div class="product-watermark-bg">MKTCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_MKT}" alt="MKTcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">COMMERCE // MULTI-VENDOR DIGITAL MARKETPLACE</div>
          <h3>MKTcore: 15 Confirmed High-Velocity Modules</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(2)}
      </div>
    </div>

    <p class="slide-subtitle">
      A battle-tested digital commerce stack built for high-concurrency transactions, automated multi-merchant settlements, and full-funnel retention.
    </p>

    <!-- 4 Functional Pillars for MKTcore -->
    <div class="grid-4" style="gap: 0.9rem; margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: var(--theme-accent); margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>???</span> STOREFRONT &amp; CATALOG
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Storefront PWA:</strong> Service worker caching &amp; add-to-home-screen<br>
          &bull; <strong>Smart Search:</strong> Sub-50ms fuzzy query &amp; 'Did You Mean'<br>
          &bull; <strong>Variant Matrix:</strong> Unlimited size, color, specs &amp; auto-SKUs<br>
          &bull; <strong>WebP Pipeline:</strong> Auto-compression &amp; zoomable photo gallery<br>
          &bull; <strong>Social Proof:</strong> Verified buyer badge reviews &amp; community Q&amp;A
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #FBBF24; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>?</span> CART, PROMOS &amp; CHECKOUT
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Smart Cart:</strong> Real-time inventory reservation lock &amp; sync<br>
          &bull; <strong>Price Drift Safeguard:</strong> Live price change alert &amp; review<br>
          &bull; <strong>12+ Coupon Rules:</strong> Percentage, flat, free shipping &amp; caps<br>
          &bull; <strong>4-Step Checkout:</strong> Geolocation address, shipping &amp; payment<br>
          &bull; <strong>Fraud Safeguards:</strong> Device fingerprint lock &amp; per-user limits
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #60A5FA; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> FINTECH &amp; LOGISTICS
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Multi-Gateway Hub:</strong> Razorpay webhooks, Stripe &amp; COD<br>
          &bull; <strong>Tax Invoicing:</strong> Automated GST/VAT-compliant PDF generation<br>
          &bull; <strong>Pincode Logistics:</strong> Serviceability checks &amp; packing slips<br>
          &bull; <strong>6-State Order Machine:</strong> Split-vendor fulfillment pipeline<br>
          &bull; <strong>Automated Returns:</strong> Defect photo uploads &amp; direct API refunds
        </div>
      </div>

      <div class="glass-card card-theme-glow" style="padding: 1.1rem;">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.92rem; color: #C084FC; margin-bottom: 0.55rem; display: flex; align-items: center; gap: 0.45rem;">
          <span>??</span> MULTI-VENDOR GOVERNANCE
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.55;">
          &bull; <strong>Vendor Portal &amp; KYC:</strong> Document vault (GST, PAN, Trade License)<br>
          &bull; <strong>Product Moderation:</strong> Admin approval queue &amp; catalog curation<br>
          &bull; <strong>Commission Engine:</strong> Dynamic platform &amp; category % cuts<br>
          &bull; <strong>Payout Ledger:</strong> Vendor balances, bank wire &amp; UTR records<br>
          &bull; <strong>Support Desk &amp; Bot:</strong> Threaded inquiries &amp; e-commerce bot
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_19.html", "w", encoding="utf-8") as f:
    f.write(s19)

# Slide 20: MKTcore Commerce Flow
s20 = f"""<section class="slide-item theme-mkt" id="slide-20" data-index="20" data-section="PRODUCT 05 // MKTCORE" data-theme="theme-mkt">
  <div class="product-watermark-bg">MKTCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_MKT}" alt="MKTcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">COMMERCE // MULTI-VENDOR DIGITAL MARKETPLACE</div>
          <h3>MKTcore: End-to-End Multi-Vendor Commerce Flow</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(3)}
      </div>
    </div>

    <p class="slide-subtitle">
      MKTcore coordinates an intricate multi-party commerce network &mdash; enabling frictionless buying for consumers and automated operations for sellers and platform owners.
    </p>

    <!-- Visual Journey Flow -->
    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Merchant</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">KYC Onboarding &amp; Catalog</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Discovery</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">PWA Storefront &amp; Search</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">03. Smart Cart</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Stock-Lock &amp; 12+ Promos</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. FinTech</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Razorpay, Stripe &amp; COD</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Dispatch</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Split Fulfillment</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(52, 211, 153, 0.12);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">06. Settlement</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Commission &amp; Bank Payouts</div>
      </div>
    </div>

    <!-- Multi-Party Synergy -->
    <div class="grid-3" style="margin-top: 0.6rem;">
      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>???</span> Shopper Experience
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Sub-second search results, real-time stock availability, saved address books with geolocation markers, transparent order timelines, and 1-click returns.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>??</span> Merchant Operations
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Dedicated seller dashboard to manage custom product catalogs, fulfill order queues with auto-generated packing slips, and monitor transparent payout balances.
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-weight: 800; font-size: 0.9rem; color: #FFF; margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.4rem;">
          <span>???</span> Platform Governance
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          Complete admin moderation over product listings, category commission rates, fraud protection, financial ledgers, and automated GST compliance exports.
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_20.html", "w", encoding="utf-8") as f:
    f.write(s20)

# Slide 21: MKTcore Marketplace Impact
s21 = f"""<section class="slide-item theme-mkt" id="slide-21" data-index="21" data-section="PRODUCT 05 // MKTCORE" data-theme="theme-mkt">
  <div class="product-watermark-bg">MKTCORE</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_MKT}" alt="MKTcore">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">COMMERCE // MULTI-VENDOR DIGITAL MARKETPLACE</div>
          <h3>MKTcore: Proven Multi-Vendor Marketplace Impact &amp; ROI</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(4)}
      </div>
    </div>

    <p class="slide-subtitle">
      MKTcore empowers brand marketplaces and retailers to scale inventory, protect conversion rates, and automate merchant financial settlements.
    </p>

    <!-- Verified Value Metrics -->
    <div class="grid-4" style="margin-top: 0.3rem;">
      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: var(--theme-accent);">500+</div>
        <div class="stat-label">Merchant Scale</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Architected to host hundreds of verified independent sellers with isolated stores and unified checkout.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #60A5FA;">Zero</div>
        <div class="stat-label">Stock Collisions</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Atomic inventory reservation locks prevent double-selling during viral promotional spikes and flash sales.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #FBBF24;">12+</div>
        <div class="stat-label">Promotion Drivers</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Granular campaign rules driving average order value through dynamic tiers, category whitelists, and caps.
        </p>
      </div>

      <div class="glass-card card-theme-glow" style="text-align: center;">
        <div class="stat-huge" style="color: #C084FC;">Automated</div>
        <div class="stat-label">Reverse Logistics</div>
        <p style="font-size: 0.74rem; color: var(--text-muted); margin-top: 0.5rem; line-height: 1.4;">
          Transparent defect verification workflow with instant gateway API refunds directly back to customer cards.
        </p>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card card-theme-glow" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: var(--theme-accent); text-align: center; padding: 1.4rem; margin-top: 1rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: var(--theme-accent); font-weight: 700; text-transform: uppercase; margin-bottom: 0.4rem;">
        THE MKTCORE PHILOSOPHY
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.2rem, 2.2vw, 1.8rem); font-weight: 900; color: #FFF;">
        &ldquo;From cart clicks to verified customer value.&rdquo;
      </h3>
      <p style="font-size: 0.82rem; color: var(--text-muted); margin-top: 0.4rem; max-width: 760px; margin-left: auto; margin-right: auto;">
        From lightning PWA mobile discovery to multi-vendor split delivery and automated bank payouts &mdash; MKTcore fuels modern enterprise commerce.
      </p>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_21.html", "w", encoding="utf-8") as f:
    f.write(s21)

print("MKTcore Slides 18, 19, 20, 21 generated successfully.")
