{{--
    resources/views/digital-card/pdf.blade.php
    85 × 54 mm  ·  STRICTLY ONE PAGE  ·  dompdf-safe

    Key fixes:
    - ZERO flow layout — every element is position:absolute with explicit coordinates
    - html/body/card all have overflow:hidden and exact 85×54mm dimensions
    - Company office details are HARDCODED (same for all cards)
    - SVG icons via data-URI (no Unicode, no external fonts)
    - page-break-inside:avoid on card; no page-break-after anywhere
--}}
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
@page {
    size: 85mm 54mm;
    margin: 0;
}
html {
    width: 85mm;
    height: 54mm;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
body {
    width: 85mm;
    height: 54mm;
    overflow: hidden;
    margin: 0;
    padding: 0;
    font-family: DejaVu Sans, Arial, sans-serif;
    background: #ffffff;
}
* { margin: 0; padding: 0; box-sizing: border-box; }
</style>
</head>
<body>
@php
/* ── collect phones / emails ── */
$phones = array_values(array_unique(array_filter([
    $member->region1_phone ?? null,
    $member->region2_phone ?? null,
])));
$emails = array_values(array_unique(array_filter([
    $member->region1_email ?? null,
    $member->region2_email ?? null,
])));

/* ── logo ── */
$logoSrc = null;
if (!empty($companyLogo)) {
    $logoSrc = (str_starts_with($companyLogo,'data:') || str_starts_with($companyLogo,'http'))
        ? $companyLogo
        : 'data:image/png;base64,'.$companyLogo;
}

/* ── colour the company abbreviation in designation ── */
$desig = $member->designation ?? '';
$cn    = trim($companyName ?? '');
$abbr  = null;
foreach (explode(' ', $cn) as $w) {
    if (strlen($w) <= 6 && strtoupper($w) === $w && ctype_alpha($w)) { $abbr = $w; break; }
}
if ($abbr && str_contains($desig, $abbr)) {
    $colours = ['#0f83c9','#3d8b21','#f20f16'];
    $coloured = '';
    foreach (str_split($abbr) as $i => $l) {
        $coloured .= '<span style="color:'.$colours[$i%3].';font-weight:900;">'.$l.'</span>';
    }
    $desigHtml = str_replace($abbr, $coloured, e($desig));
} else {
    $desigHtml = e($desig);
}

/* ── SVG icon helper ──
   Returns data:image/svg+xml;base64,…  circle with embedded SVG path
   Size: 22×22px circle
*/
$icon = function(string $bg, string $innerSvg): string {
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22">'
         . '<circle cx="11" cy="11" r="11" fill="'.$bg.'"/>'
         . $innerSvg
         . '</svg>';
    return 'data:image/svg+xml;base64,'.base64_encode($svg);
};

/* Phone handset */
$icoPhone = $icon('#ef1b24',
    '<path transform="translate(4,4)" d="M10.8 7.4c-.3-.1-1.8-.9-2.1-1s-.5-.1-.7.1-.8 1-.9 1.2-.4.2-.7.1C6.1 7.6 5.1 7.2 3.9 6 2.9 5 2.3 3.9 2.1 3.6c-.2-.3 0-.5.1-.6.1-.1.3-.4.5-.5.1-.2.2-.3.3-.5.1-.2 0-.4 0-.5C2.9 1.3 2.3-.1 2-.7c-.2-.6-.5-.5-.7-.5H.7C.5-.2.2.1 0 .3-.3.6-1 1.3-1 2.8c0 1.4 1.1 2.8 1.2 3 .2.2 2.1 3.2 5.1 4.5.7.3 1.3.5 1.7.6.7.2 1.4.2 1.9.1.6-.1 1.8-.7 2-1.4.3-.6.3-1.2.2-1.4-.1-.1-.3-.2-.6-.3z" fill="#ffffff"/>');

/* Envelope */
$icoMail = $icon('#2483c5',
    '<rect x="4" y="7" width="14" height="9" rx="1" fill="none" stroke="#ffffff" stroke-width="1.2"/>'
   .'<polyline points="4,7 11,13 18,7" fill="none" stroke="#ffffff" stroke-width="1.2"/>');

/* Globe */
$icoWeb = $icon('#0b7fc3',
    '<circle cx="11" cy="11" r="6.5" fill="none" stroke="#ffffff" stroke-width="1.1"/>'
   .'<line x1="4.5" y1="11" x2="17.5" y2="11" stroke="#ffffff" stroke-width="1"/>'
   .'<path d="M11 4.5 C8.8 6.5 8.8 15.5 11 17.5 C13.2 15.5 13.2 6.5 11 4.5Z" fill="none" stroke="#ffffff" stroke-width="1"/>');

/* Small globe for footer (16×16) */
$icoWebSm = function(string $bg) use ($icon): string {
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">'
         . '<circle cx="8" cy="8" r="8" fill="'.$bg.'"/>'
         . '<circle cx="8" cy="8" r="4.5" fill="none" stroke="#ffffff" stroke-width="0.9"/>'
         . '<line x1="3" y1="8" x2="13" y2="8" stroke="#ffffff" stroke-width="0.8"/>'
         . '<path d="M8 3.5 C6.5 5 6.5 11 8 12.5 C9.5 11 9.5 5 8 3.5Z" fill="none" stroke="#ffffff" stroke-width="0.8"/>'
         . '</svg>';
    return 'data:image/svg+xml;base64,'.base64_encode($svg);
};
$icoWebSmBlue = $icoWebSm('#0b7fc3');

/* Small envelope for footer */
$icoEmailSm = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">'
    .'<circle cx="8" cy="8" r="8" fill="#2483c5"/>'
    .'<rect x="3" y="5.5" width="10" height="6.5" rx="0.8" fill="none" stroke="#ffffff" stroke-width="0.9"/>'
    .'<polyline points="3,5.5 8,9.5 13,5.5" fill="none" stroke="#ffffff" stroke-width="0.9"/>'
    .'</svg>';
$icoEmailSmUri = 'data:image/svg+xml;base64,'.base64_encode($icoEmailSm);
@endphp

{{--
  ┌─────────────────────────────────────────────────────┐
  │  CARD  85mm × 54mm — ALL children position:absolute │
  │                                                     │
  │  Vertical zones (all measurements in mm):           │
  │   0.0 – 1.2   top colour strip                     │
  │   1.2 – 18.0  header (name + logo)                 │
  │  18.0 – 18.3  divider                              │
  │  18.3 – 38.5  contact rows                         │
  │  38.5 – 38.8  divider                              │
  │  38.8 – 52.0  footer offices                       │
  │  52.0 – 54.0  green bottom border                  │
  │  left 0–2mm   red left border                      │
  └─────────────────────────────────────────────────────┘
--}}

<div style="
    position:absolute; top:0; left:0;
    width:85mm; height:54mm;
    overflow:hidden;
    background:#ffffff;
    border-left:2mm solid #f20f16;
    border-bottom:2mm solid #3d8b21;
    page-break-inside:avoid;
">

    {{-- ① TOP COLOUR STRIP (1.2mm tall) --}}
    <div style="position:absolute; top:0; left:2mm; right:0; height:1.2mm; overflow:hidden;">
        <table style="width:100%; height:1.2mm; border-collapse:collapse;">
            <tr>
                <td style="background:#0f83c9; padding:0;"></td>
                <td style="background:#3d8b21; padding:0;"></td>
                <td style="background:#f20f16; padding:0;"></td>
            </tr>
        </table>
    </div>

    {{-- ② WATERMARK --}}
    @if($logoSrc)
    <img src="{{ $logoSrc }}" style="
        position:absolute; left:9mm; top:13mm;
        width:63mm; opacity:0.03; z-index:0;
    " alt="">
    @else
    <div style="
        position:absolute; left:9mm; top:12mm;
        font-size:30pt; font-weight:900; letter-spacing:4mm;
        color:#0f83c9; opacity:0.03; z-index:0;
        white-space:nowrap;
    ">{{ $cn }}</div>
    @endif

    {{-- ③ HEADER — name left, logo right (top: 1.2mm, height: 16.8mm) --}}

    {{-- name + designation --}}
    <div style="
        position:absolute;
        top:1.2mm; left:2mm;
        width:50mm; height:16.8mm;
        padding:3mm 0 0 3mm;
        z-index:2;
    ">
        <div style="font-size:13pt; font-weight:900; color:#111111; line-height:1.1; margin-bottom:1.2mm;">{{ $member->name }}</div>
        <div style="font-size:6.8pt; font-weight:700; color:#333333; line-height:1.3;">{!! $desigHtml !!}</div>
    </div>

    {{-- logo --}}
    <div style="
        position:absolute;
        top:1.2mm; right:0;
        width:33mm; height:16.8mm;
        padding:2.5mm 3mm 2mm 0;
        text-align:right;
        z-index:2;
    ">
        @if($logoSrc)
            <img src="{{ $logoSrc }}" style="max-width:30mm; max-height:14mm; object-fit:contain; display:block; margin-left:auto;" alt="{{ $cn }}">
        @else
            <div style="font-size:15pt; font-weight:900; letter-spacing:0.5mm; line-height:1;">
                <span style=" color:#f20f16;">K</span><span style="color:#0f83c9;">N</span><span style="color:#3d8b21;">R</span>
            </div>
            @if(!empty($companyTagline))
            <div style="font-size:4.5pt; font-weight:700; color:#555; margin-top:0.5mm; line-height:1.3;">{{ $companyTagline }}</div>
            @endif
        @endif
    </div>

    {{-- ④ DIVIDER under header --}}
    <div style="position:absolute; top:18mm; left:2mm; right:0; height:0.3mm; background:#dddddd; z-index:2;"></div>

    {{-- ⑤ CONTACT ROWS (top:18.3mm) --}}

    {{-- Phone --}}
    @if(count($phones))
    <div style="position:absolute; top:19mm; left:2mm; right:0; height:7mm; z-index:2; padding-left:3mm;">
        <table style="border-collapse:collapse; width:100%; height:7mm;">
            <tr>
                <td style="width:7mm; vertical-align:middle; padding:0;">
                    <img src="{{ $icoPhone }}" style="width:5.5mm; height:5.5mm; display:block;" alt="">
                </td>
                <td style="vertical-align:middle; font-size:8pt; font-weight:900; color:#111111; line-height:1.35; padding:0;">
                    @foreach($phones as $p)
                        {{ $p }}@if(!$loop->last) &nbsp;&nbsp;&nbsp; @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
    @endif

    {{-- Email --}}
    @if(count($emails))
    <div style="position:absolute; top:26mm; left:2mm; right:0; height:7mm; z-index:2; padding-left:3mm;">
        <table style="border-collapse:collapse; width:100%; height:7mm;">
            <tr>
                <td style="width:7mm; vertical-align:middle; padding:0;">
                    <img src="{{ $icoMail }}" style="width:5.5mm; height:5.5mm; display:block;" alt="">
                </td>
                <td style="vertical-align:middle; font-size:8pt; font-weight:900; color:#111111; line-height:1.35; padding:0;">
                    @foreach($emails as $e)
                        {{ $e }}@if(!$loop->last) &nbsp;&nbsp;&nbsp; @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
    @endif

    {{-- ⑥ DIVIDER above footer --}}
    <div style="position:absolute; top:36mm; left:2mm; right:0; height:0.3mm; background:#cccccc; z-index:2;"></div>

    {{-- ⑦ FOOTER — two-column offices  (top:36.3mm → 52mm = 15.7mm tall) --}}
    {{-- HARDCODED company addresses for all cards --}}
    <div style="position:absolute; top:36.3mm; left:2mm; right:0; height:15.7mm; z-index:2;">
        <table style="border-collapse:collapse; width:100%; height:15.7mm;">
            <tr>

                {{-- Corporate Office --}}
                <td style="width:50%; vertical-align:top; padding:1.2mm 2mm 0.5mm 2.8mm; border-right:0.35mm dashed #999999;">
                    <div style="font-size:5pt; font-weight:900; color:#111111; margin-bottom:0.5mm;">Corporate Office</div>
                    <div style="font-size:4.3pt; font-weight:700; color:#333333; line-height:1.35; margin-bottom:0.8mm;">
                        ACN: 633 276 178, Suite 319, 1 Queens Rd,
                        St Kilda Rd Towers, Melbourne<br>
                        VIC 3004, Australia
                    </div>
                    <table style="border-collapse:collapse;">
                        <tr>
                            <!-- <td style="padding:0 1.5mm 0 0; vertical-align:middle;">
                                <img src="{{ $icoWebSmBlue }}" style="width:3.5mm;height:3.5mm;display:block;" alt="">
                            </td> -->
                            <td style="font-size:4.1pt; font-weight:700; color:#0b7fc3; vertical-align:middle; padding-right:2mm;">www.rescom.in</td>
                            <!-- <td style="padding:0 1.5mm 0 0; vertical-align:middle;">
                                <img src="{{ $icoEmailSmUri }}" style="width:3.5mm;height:3.5mm;display:block;" alt="">
                            </td> -->
                            <td style="font-size:4.1pt; font-weight:700; color:#0b7fc3; vertical-align:middle;">info@rescom.in</td>
                        </tr>
                    </table>
                </td>

                {{-- India Office --}}
                <td style="width:50%; vertical-align:top; padding:1.2mm 2mm 0.5mm 2.8mm;">
                    <div style="font-size:5pt; font-weight:900; color:#111111; margin-bottom:0.5mm;">India Office</div>
                    <div style="font-size:4.3pt; font-weight:700; color:#333333; line-height:1.35; margin-bottom:0.8mm;">
                        #233, Rahul Building, 6th Main Road,<br>
                        Rajajinagar Industrial Town,<br>
                        Bengaluru, Karnataka 560044
                    </div>
                    <table style="border-collapse:collapse;">
                        <tr>
                            <!-- <td style="padding:0 1mm 0 0; vertical-align:middle;">
                                <img src="{{ $icoWebSmBlue }}" style="width:3.5mm;height:3.5mm;display:block;" alt="">
                            </td> -->
                            <td style="font-size:4.1pt; font-weight:700; color:#0b7fc3; vertical-align:middle; padding-right:2mm;">www.rescom.in</td>
                            <!-- <td style="padding:0 1.5mm 0 0; vertical-align:middle;">
                                <img src="{{ $icoEmailSmUri }}" style="width:3.5mm;height:3.5mm;display:block;" alt="">
                            </td> -->
                            <td style="font-size:4.1pt; font-weight:700; color:#0b7fc3; vertical-align:middle;">info@rescom.in</td>
                        </tr>
                    </table>
                </td>

            </tr>
        </table>
    </div>

</div>{{-- /card --}}

</body>
</html>