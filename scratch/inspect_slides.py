import glob, re

for f in sorted(glob.glob('scratch/slides/slide_*.html')):
    with open(f, 'r', encoding='utf-8') as fp:
        c = fp.read()
    m_id = re.search(r'id="([^"]+)"', c)
    m_sec = re.search(r'data-section="([^"]+)"', c)
    m_theme = re.search(r'data-theme="([^"]+)"', c)
    m_h = re.search(r'<h[23][^>]*>(.*?)</h[23]>', c, re.DOTALL)
    title = re.sub(r'<.*?>', '', m_h.group(1)).replace('\n', ' ').strip() if m_h else 'None'
    print(f"{f} | id={m_id.group(1) if m_id else None} | theme={m_theme.group(1) if m_theme else 'NONE'} | sec={m_sec.group(1) if m_sec else None} | title={title[:45]}")
