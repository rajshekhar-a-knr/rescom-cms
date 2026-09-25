import os

def write_slide(num, content):
    filename = f"scratch/slides/slide_{num:02d}.html"
    with open(filename, "w", encoding="utf-8") as f:
        f.write(content.strip())
    print(f"Wrote {filename}")

# =========================================================================
# SLIDE 22: SKILL DEVELOPMENT INTRODUCTION
# =========================================================================
s22 = """
<section class="slide-item" id="slide-22" data-index="22" data-section="PRODUCT 06 // SKILL DEVELOPMENT">
  <div class="slide-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.4rem;">
      <div>
        <div class="slide-eyebrow">
          <span class="hud-pulse-dot" style="background: var(--amber);"></span>
          PRODUCT 06 • HUMAN CAPABILITY DEVELOPMENT ECOSYSTEM
        </div>
        <h2 class="slide-title">
          KNR Skill Development <br>
          <span class="slide-title-gradient">Developing People For The Future</span>
        </h2>
      </div>
      <div style="text-align: right;">
        <span class="tech-tag tech-tag-amber" style="font-size: 0.82rem; padding: 0.35rem 0.9rem;">3 Strategic Capability Pillars</span>
      </div>
    </div>

    <p class="slide-subtitle">
      This is not just a software product — it is KNR's holistic human capability ecosystem. 
      While software creates scale, human capability creates impact. KNR empowers students, young professionals, 
      and educators with high-growth vocational, robotics, and executive competencies.
    </p>

    <!-- The 3 Major Capability Pillars -->
    <div class="grid-3" style="margin-top: 0.4rem;">
      <div class="glass-card glass-card-glow-amber">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          💼
        </div>
        <div style="font-size: 0.72rem; color: #FBBF24; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">PILLAR 01</div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Personality & Professional Mastery</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Emotional Intelligence (EQ), executive presence, assertive workplace communication, conflict resolution, and career track roadmaps.
        </p>
      </div>

      <div class="glass-card glass-card-glow-purple">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(139, 92, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          🤖
        </div>
        <div style="font-size: 0.72rem; color: #C084FC; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">PILLAR 02</div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">Applied STEM & Robotics Skills</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Experiential hardware learning: Microcontrollers (Arduino, Raspberry Pi), IoT sensors, robotic chassis construction, and 3D CAD prototyping.
        </p>
      </div>

      <div class="glass-card glass-card-glow-cyan">
        <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 0.8rem;">
          🎓
        </div>
        <div style="font-size: 0.72rem; color: var(--cyan); font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.2rem;">PILLAR 03</div>
        <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.1rem; color: #FFF; margin-bottom: 0.4rem;">CBSE & NEP 2020 Vocational Skills</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.5;">
          Curriculum-aligned vocational tracks: Scratch coding for Middle School, Python AI & Computer Vision for Secondary School, cyber ethics, and financial markets.
        </p>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 23: PERSONALITY & PROFESSIONAL DEVELOPMENT
# =========================================================================
s23 = """
<section class="slide-item" id="slide-23" data-index="23" data-section="PRODUCT 06 // SKILL DEVELOPMENT">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--amber);"></span>
      CAPABILITY PILLAR 01 • HUMAN TRANSFORMATION
    </div>
    <h2 class="slide-title">
      Personality & Professional Development
    </h2>
    <p class="slide-subtitle">
      Cultivating essential human power-skills that enable technical professionals and young graduates to lead, communicate, and succeed in high-stakes environments.
    </p>

    <!-- Visual Journey Flow: Self -> Skills -> Confidence -> Career -> Leadership -->
    <div class="flow-container" style="margin: 1.6rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🌱</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">01. Self</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Self-Awareness & Values</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🧠</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Skills</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">EQ & Communication Poise</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">⚡</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Confidence</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Public Speaking & Presence</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">💼</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Career</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Industry Track Roadmaps</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step" style="border-color: var(--cyan); background: rgba(0, 240, 255, 0.08);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">👑</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">05. Leadership</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Executive Influence & Teams</div>
      </div>
    </div>

    <!-- Verified Modules Detail Grid -->
    <div class="grid-4" style="margin-top: 0.8rem;">
      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #FBBF24; margin-bottom: 0.4rem;">
          ❤️ Emotional Intelligence (EQ)
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          • Emotional trigger identification<br>
          • Stress regulation under pressure<br>
          • Active empathetic listening<br>
          • Cross-perspective thinking
        </div>
      </div>

      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #60A5FA; margin-bottom: 0.4rem;">
          🎤 Executive Presentation
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          • Verbal clarity & structural framing<br>
          • Non-verbal posture & eye engagement<br>
          • Pitch delivery & Q&A composure<br>
          • Storytelling with data
        </div>
      </div>

      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #34D399; margin-bottom: 0.4rem;">
          🤝 Workplace Collaboration
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          • Cross-functional agile teamwork<br>
          • Constructive conflict resolution<br>
          • Professional corporate email etiquette<br>
          • Meeting facilitation & ownership
        </div>
      </div>

      <div class="glass-card">
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.9rem; color: #C084FC; margin-bottom: 0.4rem;">
          🗺️ Industry Career Roadmaps
        </div>
        <div style="font-size: 0.76rem; color: var(--text-muted); line-height: 1.5;">
          • Full-stack & cloud tracks<br>
          • AI & data engineering milestones<br>
          • Capstone portfolio reviews<br>
          • Skill gap self-diagnostics
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 24: ROBOTICS & CBSE SKILLS
# =========================================================================
s24 = """
<section class="slide-item" id="slide-24" data-index="24" data-section="PRODUCT 06 // SKILL DEVELOPMENT">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--amber);"></span>
      CAPABILITY PILLARS 02 & 03 • STEM & VOCATIONAL EXCELLENCE
    </div>
    <h2 class="slide-title">
      Applied Robotics & CBSE Vocational Skills
    </h2>
    <p class="slide-subtitle">
      A dual-track experiential curriculum bridging theoretical academics with physical engineering, artificial intelligence, and digital innovation.
    </p>

    <!-- Split Futuristic Architecture -->
    <div class="grid-2" style="margin-top: 0.8rem; gap: 1.4rem;">
      <!-- ROBOTICS & HARDWARE -->
      <div class="glass-card glass-card-glow-purple" style="padding: 1.4rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.8rem;">
          <div style="display: flex; align-items: center; gap: 0.6rem;">
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(139, 92, 246, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">🤖</div>
            <div>
              <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.05rem; color: #FFF;">APPLIED ROBOTICS & STEM LABS</h3>
              <span style="font-size: 0.7rem; color: #C084FC; font-weight: 600;">Hands-On Engineering & Hardware</span>
            </div>
          </div>
          <span class="tech-tag tech-tag-purple">Physical Labs</span>
        </div>

        <div style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 0.8rem;">
          • <strong>Microcontroller Computing:</strong> Arduino UNO, Raspberry Pi, ESP32 Wi-Fi boards<br>
          • <strong>Sensor Telemetry:</strong> Ultrasonic, temperature, infrared, LDR & gas detectors<br>
          • <strong>Actuators & Motors:</strong> Servo motors, stepper drivers & robotic chassis kits<br>
          • <strong>Autonomous Robotics:</strong> Line-follower bots & obstacle-avoiding smart cars<br>
          • <strong>Applied Engineering:</strong> Tinkercad 3D CAD modeling, solar tracking & drone physics
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
          <span class="tech-tag">Arduino & Pi</span>
          <span class="tech-tag">Sensor Integration</span>
          <span class="tech-tag">3D CAD Prototyping</span>
          <span class="tech-tag">Smart Home Models</span>
        </div>
      </div>

      <!-- CBSE & NEP 2020 SKILLS -->
      <div class="glass-card glass-card-glow-cyan" style="padding: 1.4rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.8rem;">
          <div style="display: flex; align-items: center; gap: 0.6rem;">
            <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(0, 240, 255, 0.2); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">🎓</div>
            <div>
              <h3 style="font-family: var(--font-display); font-weight: 800; font-size: 1.05rem; color: #FFF;">CBSE & NEP 2020 VOCATIONAL SKILLS</h3>
              <span style="font-size: 0.7rem; color: var(--cyan); font-weight: 600;">21st Century School Competencies</span>
            </div>
          </div>
          <span class="tech-tag tech-tag-cyan">NEP Aligned</span>
        </div>

        <div style="font-size: 0.78rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 0.8rem;">
          • <strong>Middle School (Grades 6-8):</strong> Scratch block coding, algorithms & digital literacy<br>
          • <strong>Secondary School (Grades 9-12):</strong> Python OOP, data structures & NumPy logic<br>
          • <strong>Artificial Intelligence:</strong> Computer Vision, Natural Language Processing & ethics<br>
          • <strong>Cyber Defense:</strong> Password hygiene, phishing defense & digital safety<br>
          • <strong>Vocational Modules:</strong> Financial markets literacy, design thinking & capstones
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
          <span class="tech-tag">Python & AI</span>
          <span class="tech-tag">Computer Vision</span>
          <span class="tech-tag">Cyber Safety</span>
          <span class="tech-tag">Board AI Capstones</span>
        </div>
      </div>
    </div>
  </div>
</section>
"""

# =========================================================================
# SLIDE 25: SKILL DEVELOPMENT IMPACT
# =========================================================================
s25 = """
<section class="slide-item" id="slide-25" data-index="25" data-section="PRODUCT 06 // SKILL DEVELOPMENT">
  <div class="slide-container">
    <div class="slide-eyebrow">
      <span class="hud-pulse-dot" style="background: var(--amber);"></span>
      HUMAN IMPACT & WORKFORCE TRANSFORMATION
    </div>
    <h2 class="slide-title">
      The 6-Stage Human Progression Journey
    </h2>
    <p class="slide-subtitle">
      KNR bridges the historic divide between academic credentials and real-world industrial capability through active experiential building.
    </p>

    <!-- 6-Stage Progression Flow -->
    <div class="flow-container" style="margin: 1.6rem 0;">
      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🔍</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">01. Discover</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Aptitude & Curiosity</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">📖</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #60A5FA;">02. Learn</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Core Concepts & Ethics</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">⚙️</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #34D399;">03. Practice</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Guided Coding & Labs</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🛠️</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #FBBF24;">04. Build</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Robots, Prototypes & AI</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🎤</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: #C084FC;">05. Demonstrate</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Public Defense & Expos</div>
      </div>
      <div class="flow-connector">➔</div>

      <div class="flow-step" style="border-color: var(--cyan); background: rgba(0, 240, 255, 0.08);">
        <div style="font-size: 1.5rem; margin-bottom: 0.3rem;">🚀</div>
        <div style="font-family: var(--font-display); font-weight: 800; font-size: 0.88rem; color: var(--cyan);">06. Grow</div>
        <div style="font-size: 0.68rem; color: var(--text-muted); margin-top: 0.2rem;">Industry Career Launch</div>
      </div>
    </div>

    <!-- Final Value Anchor Statement -->
    <div class="glass-card" style="background: linear-gradient(135deg, rgba(14,22,50,0.9), rgba(20,32,70,0.8)); border-color: #FBBF24; text-align: center; padding: 1.8rem; margin-top: 0.8rem;">
      <div style="font-size: 0.78rem; font-family: var(--font-mono); letter-spacing: 0.2em; color: #FBBF24; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
        THE HUMAN-FIRST CREED
      </div>
      <h3 style="font-family: var(--font-display); font-size: clamp(1.3rem, 2.4vw, 2.2rem); font-weight: 900; color: #FFF;">
        “Technology changes the future. People build it.”
      </h3>
      <p style="font-size: 0.84rem; color: var(--text-muted); margin-top: 0.5rem; max-width: 760px; margin-left: auto; margin-right: auto;">
        By connecting theoretical classroom syllabi with physical robotics hardware, ethical AI coding, and executive emotional intelligence, 
        KNR nurtures the inventors, engineers, and compassionate leaders of tomorrow.
      </p>
    </div>
  </div>
</section>
"""

write_slide(22, s22)
write_slide(23, s23)
write_slide(24, s24)
write_slide(25, s25)
