# Generator for Skill Development Slides (22, 23, 24, 25)

LOGO_SKILL = "https://knrint-website.blr1.digitaloceanspaces.com/KNR-WEBSITE/2026/portfolio/KNR-WEBSITE_581aabf1-8244-49b1-bcad-1b6dbdfb26a9_Screenshot_2026-05-25_100002.webp"

def get_stepper(active_idx):
    steps = ["1. TALENT VISION", "2. PROFESSIONAL TRACKS", "3. ROBOTICS & VOCATIONAL", "4. PROGRESSION JOURNEY"]
    html = '<div class="product-story-stepper">'
    for i, step in enumerate(steps, 1):
        cls = "stepper-step active" if i == active_idx else "stepper-step"
        html += f'<span class="{cls}">&bull; {step}</span>'
    html += '</div>'
    return html

# Slide 22: Skill Dev Identity
s22 = f"""<section class="slide-item theme-skill" id="slide-22" data-index="22" data-section="PRODUCT 06 // SKILL DEVELOPMENT" data-theme="theme-skill">
  <div class="product-watermark-bg">SKILLS</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_SKILL}" alt="Skill Development">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ACADEMY // HUMAN CAPABILITY &amp; VOCATIONAL DEVELOPMENT</div>
          <h3>KNR Skill Development: Developing People For The Future</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(1)}
      </div>
    </div>

    <p class="slide-subtitle">
      This is not just software &mdash; it is KNR's holistic human capability ecosystem. 
      While software creates scale, human capability creates impact. KNR empowers students, young professionals, 
      and educators with high-growth vocational, robotics, and executive competencies.
    </p>

    <!-- The 3 Major Capability Pillars -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(251, 191, 36, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <div style="font-size: 0.72rem; color: var(--theme-accent); font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">PILLAR 01</div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Personality &amp; Professional Mastery</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Emotional Intelligence (EQ), executive presence, assertive workplace communication, conflict resolution, and career track roadmaps.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">Executive EQ</span>
          <span class="tech-tag">Public Speaking</span>
          <span class="tech-tag">Workplace Poise</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(251, 191, 36, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <div style="font-size: 0.72rem; color: var(--theme-accent); font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">PILLAR 02</div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Applied STEM &amp; Robotics Labs</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Experiential hardware learning: Microcontrollers (Arduino, Raspberry Pi), IoT sensors, robotic chassis construction, and 3D CAD prototyping.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">Hardware Labs</span>
          <span class="tech-tag">Arduino &amp; Pi</span>
          <span class="tech-tag">IoT Telemetry</span>
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(251, 191, 36, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          ??
        </div>
        <div style="font-size: 0.72rem; color: var(--theme-accent); font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">PILLAR 03</div>
        <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">CBSE &amp; NEP 2020 Vocational Skills</h4>
        <p style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.5;">
          Curriculum-aligned vocational tracks: Scratch coding for Middle School, Python AI &amp; Computer Vision for Secondary School, and cyber safety.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 0.25rem; margin-top: 0.6rem;">
          <span class="tech-tag tech-tag-theme">NEP 2020</span>
          <span class="tech-tag">Python &amp; AI</span>
          <span class="tech-tag">Cyber Ethics</span>
        </div>
      </div>
    </div>

    <div class="glass-card" style="margin-top: 0.8rem; padding: 0.8rem 1.25rem; display: flex; align-items: center; justify-content: space-between; background: rgba(251, 191, 36, 0.08); border-color: rgba(251, 191, 36, 0.25);">
      <div style="display: flex; align-items: center; gap: 0.8rem;">
        <span style="font-size: 1.3rem;">??</span>
        <span style="font-size: 0.82rem; color: #FFF; font-weight: 600;">Bridging theoretical academics with practical innovation and global industry readiness.</span>
      </div>
      <span class="tech-tag tech-tag-theme" style="font-size: 0.78rem;">3 Core Strategic Pillars</span>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_22.html", "w", encoding="utf-8") as f:
    f.write(s22)

# Slide 23: Skill Dev Tracks
s23 = f"""<section class="slide-item theme-skill" id="slide-23" data-index="23" data-section="PRODUCT 06 // SKILL DEVELOPMENT" data-theme="theme-skill">
  <div class="product-watermark-bg">SKILLS</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_SKILL}" alt="Skill Development">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ACADEMY // HUMAN CAPABILITY &amp; VOCATIONAL DEVELOPMENT</div>
          <h3>KNR Skill Development: Personality &amp; Professional Mastery</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(2)}
      </div>
    </div>

    <p class="slide-subtitle">
      Cultivating essential human power-skills that enable technical professionals and young graduates to lead, communicate, and succeed in high-stakes environments.
    </p>

    <!-- Visual Journey Flow: Self -> Skills -> Confidence -> Career -> Leadership -->
    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Self</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Self-Awareness &amp; Values</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Skills</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">EQ &amp; Communication Poise</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">?</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Confidence</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Public Speaking &amp; Presence</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">04. Career</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Industry Track Roadmaps</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(251, 191, 36, 0.12);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">05. Leadership</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Executive Influence &amp; Teams</div>
      </div>
    </div>

    <!-- Verified Modules Detail Grid -->
    <div class="grid-4" style="margin-top: 0.6rem;">
      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: var(--theme-accent); margin-bottom: 0.4rem;">
          ?? Emotional Intelligence (EQ)
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.5;">
          &bull; Emotional trigger identification<br>
          &bull; Stress regulation under pressure<br>
          &bull; Active empathetic listening<br>
          &bull; Cross-perspective thinking
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #60A5FA; margin-bottom: 0.4rem;">
          ?? Executive Presentation
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.5;">
          &bull; Verbal clarity &amp; structural framing<br>
          &bull; Non-verbal posture &amp; eye engagement<br>
          &bull; Pitch delivery &amp; Q&amp;A composure<br>
          &bull; Storytelling with data
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #34D399; margin-bottom: 0.4rem;">
          ?? Workplace Collaboration
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.5;">
          &bull; Cross-functional agile teamwork<br>
          &bull; Constructive conflict resolution<br>
          &bull; Corporate business email etiquette<br>
          &bull; Meeting facilitation &amp; ownership
        </div>
      </div>

      <div class="glass-card card-theme-glow">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #C084FC; margin-bottom: 0.4rem;">
          ??? Industry Career Roadmaps
        </div>
        <div style="font-size: 0.74rem; color: var(--text-muted); line-height: 1.5;">
          &bull; Full-stack &amp; cloud engineering<br>
          &bull; AI &amp; data science milestones<br>
          &bull; Capstone portfolio build &amp; review<br>
          &bull; Skill gap self-diagnostics
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_23.html", "w", encoding="utf-8") as f:
    f.write(s23)

# Slide 24: Robotics & Vocational
s24 = f"""<section class="slide-item theme-skill" id="slide-24" data-index="24" data-section="PRODUCT 06 // SKILL DEVELOPMENT" data-theme="theme-skill">
  <div class="product-watermark-bg">SKILLS</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_SKILL}" alt="Skill Development">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ACADEMY // HUMAN CAPABILITY &amp; VOCATIONAL DEVELOPMENT</div>
          <h3>KNR Skill Development: Applied Robotics &amp; CBSE Vocational Skills</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(3)}
      </div>
    </div>

    <p class="slide-subtitle">
      A dual-track experiential curriculum bridging theoretical academics with physical engineering, artificial intelligence, and digital innovation.
    </p>

    <!-- Split Futuristic Architecture -->
    <div class="grid-2" style="margin-top: 0.5rem; gap: 1.2rem;">
      <!-- ROBOTICS & HARDWARE -->
      <div class="glass-card card-theme-glow" style="padding: 1.25rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.7rem;">
          <div style="display: flex; align-items: center; gap: 0.6rem;">
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(251, 191, 36, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">??</div>
            <div>
              <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.05rem; color: #FFF;">APPLIED ROBOTICS &amp; STEM LABS</h4>
              <span style="font-size: 0.7rem; color: var(--theme-accent); font-weight: 600;">Hands-On Engineering &amp; Hardware</span>
            </div>
          </div>
          <span class="tech-tag tech-tag-theme">Physical Labs</span>
        </div>

        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 0.7rem;">
          &bull; <strong>Microcontroller Computing:</strong> Arduino UNO, Raspberry Pi, ESP32 Wi-Fi boards<br>
          &bull; <strong>Sensor Telemetry:</strong> Ultrasonic, temperature, infrared, LDR &amp; gas detectors<br>
          &bull; <strong>Actuators &amp; Motors:</strong> Servo motors, stepper drivers &amp; robotic chassis kits<br>
          &bull; <strong>Autonomous Robotics:</strong> Line-follower bots &amp; obstacle-avoiding smart cars<br>
          &bull; <strong>Applied Engineering:</strong> Tinkercad 3D CAD modeling, solar tracking &amp; drone physics
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
          <span class="tech-tag">Arduino &amp; Pi</span>
          <span class="tech-tag">Sensor Integration</span>
          <span class="tech-tag">3D CAD Prototyping</span>
          <span class="tech-tag">Smart Home Models</span>
        </div>
      </div>

      <!-- CBSE & NEP 2020 SKILLS -->
      <div class="glass-card card-theme-glow" style="padding: 1.25rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.7rem;">
          <div style="display: flex; align-items: center; gap: 0.6rem;">
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(251, 191, 36, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">??</div>
            <div>
              <h4 style="font-family: var(--font-display); font-weight: 800; font-size: 1.05rem; color: #FFF;">CBSE &amp; NEP 2020 VOCATIONAL SKILLS</h4>
              <span style="font-size: 0.7rem; color: var(--theme-accent); font-weight: 600;">21st Century School Competencies</span>
            </div>
          </div>
          <span class="tech-tag tech-tag-theme">NEP Aligned</span>
        </div>

        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 0.7rem;">
          &bull; <strong>Middle School (Grades 6-8):</strong> Scratch block coding, algorithms &amp; digital literacy<br>
          &bull; <strong>Secondary School (Grades 9-12):</strong> Python OOP, data structures &amp; NumPy logic<br>
          &bull; <strong>Artificial Intelligence:</strong> Computer Vision, Natural Language Processing &amp; ethics<br>
          &bull; <strong>Cyber Defense:</strong> Password hygiene, phishing defense &amp; digital safety<br>
          &bull; <strong>Vocational Modules:</strong> Financial markets literacy, design thinking &amp; capstones
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
          <span class="tech-tag">Python &amp; AI</span>
          <span class="tech-tag">Computer Vision</span>
          <span class="tech-tag">Cyber Safety</span>
          <span class="tech-tag">Board AI Capstones</span>
        </div>
      </div>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_24.html", "w", encoding="utf-8") as f:
    f.write(s24)

# Slide 25: Human Progression Journey
s25 = f"""<section class="slide-item theme-skill" id="slide-25" data-index="25" data-section="PRODUCT 06 // SKILL DEVELOPMENT" data-theme="theme-skill">
  <div class="product-watermark-bg">SKILLS</div>
  <div class="slide-container">
    <div class="product-header-strip">
      <div class="product-header-left">
        <div class="product-logo-avatar">
          <img src="{LOGO_SKILL}" alt="Skill Development">
        </div>
        <div class="product-header-text">
          <div class="product-domain-tag">ACADEMY // HUMAN CAPABILITY &amp; VOCATIONAL DEVELOPMENT</div>
          <h3>KNR Skill Development: The 6-Stage Human Progression Journey</h3>
        </div>
      </div>
      <div class="product-header-right">
        {get_stepper(4)}
      </div>
    </div>

    <p class="slide-subtitle">
      KNR bridges the historic divide between academic credentials and real-world industrial capability through active experiential building.
    </p>

    <!-- 6-Stage Progression Flow -->
    <div class="flow-container" style="margin: 1.2rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">01. Discover</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Aptitude &amp; Curiosity</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Learn</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Core Concepts &amp; Ethics</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Practice</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Guided Coding &amp; Labs</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">???</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">04. Build</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Robots &amp; Prototypes</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Demonstrate</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Public Defense &amp; Expos</div>
      </div>
      <div class="flow-connector">&rarr;</div>

      <div class="flow-step" style="border-color: var(--theme-accent); background: rgba(251, 191, 36, 0.12);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">??</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--theme-accent);">06. Grow</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Industry Career Launch</div>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card card-theme-glow" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: var(--theme-accent); text-align: center; padding: 1.4rem; margin-top: 0.8rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: var(--theme-accent); font-weight: 700; text-transform: uppercase; margin-bottom: 0.4rem;">
        THE HUMAN-FIRST CREED
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.2rem, 2.2vw, 1.8rem); font-weight: 900; color: #FFF;">
        &ldquo;Technology changes the future. People build it.&rdquo;
      </h3>
      <p style="font-size: 0.82rem; color: var(--text-muted); margin-top: 0.4rem; max-width: 760px; margin-left: auto; margin-right: auto;">
        By connecting theoretical classroom syllabi with physical robotics hardware, ethical AI coding, and executive emotional intelligence, 
        KNR nurtures the inventors, engineers, and compassionate leaders of tomorrow.
      </p>
    </div>
  </div>
</section>"""

with open("scratch/slides/slide_25.html", "w", encoding="utf-8") as f:
    f.write(s25)

print("Skill Development Slides 22, 23, 24, 25 generated successfully.")
