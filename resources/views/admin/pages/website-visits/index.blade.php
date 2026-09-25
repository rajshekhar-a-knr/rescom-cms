@extends('admin.layouts.app')
@section('title', 'Website Visits & Telemetry Command')
@section('breadcrumb')
    <span>></span><span class="current">Website Visits & Telemetry</span>
@endsection

@section('head')
    <!-- Leaflet CSS & JS for Interactive Cyber Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <style>
        /* ===== FUTURISTIC WHITE & LIGHT TELEMETRY THEME ===== */
        :root {
            --white-bg: #f8fafc;
            --white-card: #ffffff;
            --white-card-elevated: #ffffff;
            --white-border: #e2e8f0;
            --white-border-subtle: #f1f5f9;
            --accent-blue: #2563eb;
            --accent-cyan: #0284c7;
            --accent-indigo: #4f46e5;
            --accent-purple: #7c3aed;
            --accent-emerald: #059669;
            --accent-amber: #d97706;
            --accent-rose: #e11d48;
            --text-main: #0f172a;
            --text-secondary: #334155;
            --text-muted: #64748b;
        }

        .telemetry-container {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-main);
            margin: -20px;
            padding: 24px;
            background: linear-gradient(180deg, #f0f6ff 0%, #f8fafc 18%, #f8fafc 100%);
            min-height: calc(100vh - 120px);
            border-radius: 12px;
            position: relative;
        }

        .telemetry-container::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, #3b82f6, #06b6d4, #8b5cf6, #3b82f6);
            border-radius: 12px 12px 0 0;
            z-index: 1;
        }

        /* ===== HUD HEADER ===== */
        .hud-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--white-border);
            position: relative;
        }

        .hud-title-group {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .hud-icon-globe {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #e0edff 0%, #e0f2fe 100%);
            border: 1.5px solid #bfdbfe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-blue);
            font-size: 22px;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.12);
            animation: pulse-glow 3s infinite alternate;
        }

        @keyframes pulse-glow {
            0% { box-shadow: 0 0 10px rgba(37, 99, 235, 0.1); }
            100% { box-shadow: 0 0 20px rgba(37, 99, 235, 0.25); }
        }

        .hud-main-title {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .hud-badge-version {
            font-size: 11px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 6px;
            background: #e0edff;
            border: 1px solid #bfdbfe;
            color: var(--accent-blue);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .hud-live-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 700;
            color: #059669;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            padding: 4px 10px;
            border-radius: 999px;
            letter-spacing: 0.3px;
        }

        .radar-ping {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: radar-blip 1.8s infinite;
        }

        @keyframes radar-blip {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.8); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .hud-subtitle {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 3px;
            font-weight: 500;
        }

        .hud-controls-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .hud-clock-box {
            background: #ffffff;
            border: 1px solid var(--white-border);
            padding: 8px 14px;
            border-radius: 10px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            color: #1e3a8a;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .btn-cyber {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .btn-cyber-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-cyber-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
            color: #ffffff;
        }

        .btn-cyber-secondary {
            background: #ffffff;
            color: var(--text-secondary);
            border-color: var(--white-border);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .btn-cyber-secondary:hover {
            background: #f1f5f9;
            color: var(--accent-blue);
            border-color: #cbd5e1;
        }

        .btn-cyber-emerald {
            background: #ecfdf5;
            color: #047857;
            border-color: #a7f3d0;
            box-shadow: 0 2px 6px rgba(5, 150, 105, 0.08);
        }

        .btn-cyber-emerald:hover {
            background: #d1fae5;
            color: #065f46;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.15);
        }

        /* ===== FILTER CONTROL HUD ===== */
        .filter-panel {
            background: #ffffff;
            border: 1px solid var(--white-border);
            border-radius: 14px;
            padding: 18px 20px;
            margin-bottom: 24px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
            position: relative;
        }

        .presets-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--white-border-subtle);
        }

        .preset-pill {
            padding: 5px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            background: #f8fafc;
            border: 1px solid var(--white-border);
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .preset-pill:hover {
            color: var(--accent-blue);
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .preset-pill.active {
            color: #ffffff;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-color: #2563eb;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
            font-weight: 700;
        }

        .filter-fields-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
            gap: 12px;
            align-items: end;
        }

        .filter-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .filter-input, .filter-select {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            color: var(--text-main);
            font-size: 12.5px;
            padding: 8px 12px;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            width: 100%;
        }

        .filter-input:focus, .filter-select:focus {
            background: #ffffff;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .filter-select option {
            background: #ffffff;
            color: var(--text-main);
        }

        /* ===== STAT METRIC HUD CARDS ===== */
        .hud-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .hud-stat-card {
            background: #ffffff;
            border: 1px solid var(--white-border);
            border-radius: 14px;
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .hud-stat-card:hover {
            transform: translateY(-2px);
            border-color: var(--accent-blue);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
        }

        .hud-stat-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 4px; height: 100%;
            background: var(--accent-color, var(--accent-blue));
            border-radius: 4px 0 0 4px;
        }

        .hud-stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .hud-stat-title {
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
        }

        .hud-stat-icon-wrap {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--icon-bg, #eff6ff);
            color: var(--icon-color, var(--accent-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .hud-stat-value {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.1;
            letter-spacing: -0.5px;
        }

        .hud-stat-footer {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11.5px;
            padding-top: 6px;
            border-top: 1px solid var(--white-border-subtle);
        }

        .trend-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
            font-size: 11px;
        }

        .trend-up {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .trend-down {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        /* ===== GEOGRAPHIC INTELLIGENCE COMMAND MATRIX ===== */
        .cyber-matrix-card {
            background: #ffffff;
            border: 1px solid var(--white-border);
            border-radius: 16px;
            margin-bottom: 24px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
        }

        .matrix-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--white-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            background: #ffffff;
        }

        .matrix-title-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .matrix-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .matrix-subtitle {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .matrix-nav-tabs {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 10px;
            border: 1px solid var(--white-border);
            flex-wrap: wrap;
        }

        .matrix-tab-btn {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            color: var(--text-secondary);
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .matrix-tab-btn:hover {
            color: var(--accent-blue);
            background: #ffffff;
        }

        .matrix-tab-btn.active {
            color: #ffffff;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        }

        .tab-content-pane {
            display: none;
            padding: 20px;
            background: #ffffff;
        }

        .tab-content-pane.active {
            display: block;
        }

        /* ===== FUTURISTIC TABLE STYLES (LIGHT) ===== */
        .cyber-table-container {
            overflow-x: auto;
            border-radius: 10px;
            border: 1px solid var(--white-border);
            background: #ffffff;
        }

        .cyber-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            text-align: left;
        }

        .cyber-table thead th {
            background: #f8fafc;
            color: var(--text-secondary);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 12px 16px;
            border-bottom: 2px solid var(--white-border);
            white-space: nowrap;
        }

        .cyber-table tbody tr {
            border-bottom: 1px solid var(--white-border-subtle);
            transition: background 0.15s ease;
        }

        .cyber-table tbody tr:hover {
            background: #f8fafc;
        }

        .cyber-table td {
            padding: 12px 16px;
            color: var(--text-secondary);
            vertical-align: middle;
        }

        .entity-rank {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: #f1f5f9;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
            color: var(--text-muted);
        }

        .rank-top-1 { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
        .rank-top-2 { background: #e2e8f0; color: #475569; border: 1px solid #cbd5e1; }
        .rank-top-3 { background: #ffedd5; color: #c2410c; border: 1px solid #fed7aa; }

        .progress-meter {
            width: 100%;
            height: 6px;
            background: #e2e8f0;
            border-radius: 999px;
            overflow: hidden;
            position: relative;
            margin-top: 4px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, #2563eb, #06b6d4);
            transition: width 0.4s ease;
        }

        .progress-fill-emerald { background: linear-gradient(90deg, #059669, #10b981); }
        .progress-fill-purple { background: linear-gradient(90deg, #7c3aed, #a855f7); }
        .progress-fill-amber { background: linear-gradient(90deg, #d97706, #f59e0b); }

        .coord-pill {
            font-family: 'Courier New', monospace;
            font-size: 11.5px;
            background: #f1f5f9;
            border: 1px solid var(--white-border);
            padding: 2px 7px;
            border-radius: 5px;
            color: #1e3a8a;
            font-weight: 600;
        }

        /* ===== LEAFLET CYBER MAP ===== */
        #telemetryMap {
            height: 480px;
            width: 100%;
            border-radius: 12px;
            border: 1px solid var(--white-border);
            z-index: 5;
            background: #f8fafc;
        }

        .map-quick-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .map-btn-group {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .map-jump-btn {
            background: #ffffff;
            border: 1px solid var(--white-border);
            color: var(--text-secondary);
            font-size: 11.5px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .map-jump-btn:hover {
            background: var(--accent-blue);
            color: #ffffff;
            border-color: var(--accent-blue);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        }

        /* Leaflet Light Popups */
        .leaflet-popup-content-wrapper {
            background: #ffffff !important;
            border: 1.5px solid #bfdbfe !important;
            color: var(--text-main) !important;
            border-radius: 10px !important;
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        }

        .leaflet-popup-tip {
            background: #ffffff !important;
            border: 1.5px solid #bfdbfe !important;
        }

        /* ===== MULTI-CHART DECK ===== */
        .chart-deck-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        @media (max-width: 1024px) {
            .chart-deck-grid {
                grid-template-columns: 1fr;
            }
        }

        .chart-box-card {
            background: #ffffff;
            border: 1px solid var(--white-border);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
        }

        .chart-box-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--white-border-subtle);
        }

        .chart-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ===== LIVE RADAR STREAM TERMINAL (WHITE) ===== */
        .live-stream-panel {
            background: #ffffff;
            border: 1px solid var(--white-border);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
            margin-bottom: 24px;
        }

        .stream-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--white-border-subtle);
        }

        .stream-status-pill {
            font-family: 'Courier New', monospace;
            font-size: 11.5px;
            color: var(--accent-blue);
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 3px 9px;
            border-radius: 6px;
            font-weight: 700;
        }

        .stream-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 400px;
            overflow-y: auto;
            padding-right: 6px;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .stream-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #f8fafc;
            border: 1px solid var(--white-border);
            border-left: 3px solid var(--accent-blue);
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            transition: all 0.15s ease;
        }

        .stream-row:hover {
            background: #eff6ff;
            border-color: #bfdbfe;
            transform: translateX(2px);
        }

        .stream-row-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
            flex: 1;
        }

        .stream-path-badge {
            font-weight: 700;
            font-family: 'Courier New', monospace;
            color: #1e40af;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            padding: 3px 8px;
            border-radius: 6px;
            white-space: nowrap;
        }

        .stream-loc-badge {
            color: var(--text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }

        .stream-row-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
            font-family: 'Courier New', monospace;
            font-size: 11.5px;
            color: var(--text-muted);
        }

        .stream-ip-pill {
            background: #e2e8f0;
            border: 1px solid #cbd5e1;
            padding: 2px 7px;
            border-radius: 4px;
            color: #334155;
            font-weight: 600;
        }

        /* Search input inside table header */
        .table-search-input {
            background: #f8fafc;
            border: 1px solid var(--white-border);
            color: var(--text-main);
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 8px;
            outline: none;
            width: 220px;
            transition: border-color 0.2s;
        }

        .table-search-input:focus {
            background: #ffffff;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.12);
        }
    </style>
@endsection

@section('content')
<div class="telemetry-container">

    <!-- ===== 1. HUD HEADER ===== -->
    <div class="hud-header">
        <div class="hud-title-group">
            <div class="hud-icon-globe">
                <i class="fas fa-globe fa-spin" style="--fa-animation-duration: 16s; animation-duration: 16s; color:var(--accent-blue); font-size:24px;"></i>
            </div>
            <div>
                <h1 class="hud-main-title">
                    Global Telemetry Command
                    <span class="hud-badge-version">v4.8 Matrix</span>
                    <span class="hud-live-pill">
                        <span class="radar-ping"></span> Live Signal Active
                    </span>
                </h1>
                <div class="hud-subtitle">
                    Real-time Geospatial Intelligence &bull; State &bull; District &bull; Place &bull; Behavioral Metrics
                </div>
            </div>
        </div>

        <div class="hud-controls-group">
            <div class="hud-clock-box">
                <i class="fas fa-clock" style="color:var(--accent-blue);"></i>
                <span id="cyberClock">--:--:-- IST</span>
            </div>

            <button type="button" class="btn-cyber btn-cyber-secondary" id="btnSyncNow" title="Sync live data now">
                <i class="fas fa-rotate" id="syncIcon"></i> Sync
            </button>

            <a href="{{ route('admin.website-visits.export', request()->all()) }}" class="btn-cyber btn-cyber-emerald" title="Download filtered telemetry CSV">
                <i class="fas fa-file-csv"></i> Export CSV
            </a>
        </div>
    </div>

    <!-- ===== 2. ADVANCED FILTER & PRESET CONSOLE ===== -->
    <div class="filter-panel">
        <div class="presets-bar">
            <span style="font-size:11px;font-weight:800;text-transform:uppercase;color:var(--accent-blue);letter-spacing:1px;margin-right:6px;">
                <i class="fas fa-bolt"></i> Range Presets:
            </span>
            <a href="{{ route('admin.website-visits', array_merge(request()->except(['preset','start_date','end_date']), ['preset' => '24h'])) }}" 
               class="preset-pill {{ $preset === '24h' || (!$preset && !$startDate && !$endDate) ? 'active' : '' }}">Last 24 Hours</a>
            <a href="{{ route('admin.website-visits', array_merge(request()->except(['preset','start_date','end_date']), ['preset' => 'today'])) }}" 
               class="preset-pill {{ $preset === 'today' ? 'active' : '' }}">Today</a>
            <a href="{{ route('admin.website-visits', array_merge(request()->except(['preset','start_date','end_date']), ['preset' => 'yesterday'])) }}" 
               class="preset-pill {{ $preset === 'yesterday' ? 'active' : '' }}">Yesterday</a>
            <a href="{{ route('admin.website-visits', array_merge(request()->except(['preset','start_date','end_date']), ['preset' => '7d'])) }}" 
               class="preset-pill {{ $preset === '7d' ? 'active' : '' }}">Last 7 Days</a>
            <a href="{{ route('admin.website-visits', array_merge(request()->except(['preset','start_date','end_date']), ['preset' => '30d'])) }}" 
               class="preset-pill {{ $preset === '30d' ? 'active' : '' }}">Last 30 Days</a>
            <a href="{{ route('admin.website-visits', array_merge(request()->except(['preset','start_date','end_date']), ['preset' => 'this_month'])) }}" 
               class="preset-pill {{ $preset === 'this_month' ? 'active' : '' }}">This Month</a>
            <a href="{{ route('admin.website-visits', array_merge(request()->except(['preset','start_date','end_date']), ['preset' => 'all'])) }}" 
               class="preset-pill {{ $preset === 'all' ? 'active' : '' }}">All Time</a>
        </div>

        <form id="filterForm" method="GET" action="{{ route('admin.website-visits') }}">
            <div class="filter-fields-grid">
                <div class="filter-field">
                    <label class="filter-label"><i class="fas fa-flag"></i> Country</label>
                    <select name="country" id="filterCountry" class="filter-select">
                        <option value="">All Countries</option>
                        @foreach($availableCountries as $c)
                            <option value="{{ $c }}" {{ $selectedCountry === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-field">
                    <label class="filter-label"><i class="fas fa-map"></i> State / Province</label>
                    <select name="state" id="filterState" class="filter-select">
                        <option value="">All States</option>
                        @foreach($availableStates as $s)
                            <option value="{{ $s }}" {{ $selectedState === $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-field">
                    <label class="filter-label"><i class="fas fa-city"></i> District / Place</label>
                    <select name="city" id="filterCity" class="filter-select">
                        <option value="">All Districts / Places</option>
                        @foreach($availablePlaces as $p)
                            <option value="{{ $p }}" {{ $selectedCity === $p ? 'selected' : '' }}>{{ $p }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-field">
                    <label class="filter-label"><i class="fas fa-desktop"></i> Hardware Device</label>
                    <select name="device_type" class="filter-select">
                        <option value="">All Devices</option>
                        <option value="desktop" {{ $selectedDevice === 'desktop' ? 'selected' : '' }}>Desktop</option>
                        <option value="mobile" {{ $selectedDevice === 'mobile' ? 'selected' : '' }}>Mobile</option>
                        <option value="tablet" {{ $selectedDevice === 'tablet' ? 'selected' : '' }}>Tablet</option>
                    </select>
                </div>

                <div class="filter-field">
                    <label class="filter-label"><i class="fas fa-calendar"></i> From Date</label>
                    <input type="date" name="start_date" class="filter-input" value="{{ $startDate ? \Illuminate\Support\Carbon::parse($startDate)->toDateString() : '' }}">
                </div>

                <div class="filter-field">
                    <label class="filter-label"><i class="fas fa-calendar"></i> To Date</label>
                    <input type="date" name="end_date" class="filter-input" value="{{ $endDate ? \Illuminate\Support\Carbon::parse($endDate)->toDateString() : '' }}">
                </div>

                <div class="filter-field" style="grid-column: 1 / -1; display:flex; flex-direction:row; gap:10px; align-items:center; margin-top:8px; flex-wrap:wrap;">
                    <div style="flex:1; min-width:260px;">
                        <input type="text" name="search" class="filter-input" placeholder="Search by route path, IP address, place name, or referrer URL..." value="{{ $search }}">
                    </div>
                    <button type="submit" class="btn-cyber btn-cyber-primary">
                        <i class="fas fa-filter"></i> Apply Matrix Filter
                    </button>
                    <a href="{{ route('admin.website-visits') }}" class="btn-cyber btn-cyber-secondary">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ===== 3. HIGH IMPACT METRIC TILES ===== -->
    <div class="hud-stats-grid">
        <!-- Tile 1: Total Ingress -->
        <div class="hud-stat-card" style="--accent-color: var(--accent-blue); --icon-bg: #eff6ff; --icon-color: var(--accent-blue);">
            <div class="hud-stat-header">
                <span class="hud-stat-title">Total Ingress Hits</span>
                <div class="hud-stat-icon-wrap"><i class="fas fa-chart-line"></i></div>
            </div>
            <div class="hud-stat-value">{{ number_format($totalVisits) }}</div>
            <div class="hud-stat-footer">
                <span style="color:var(--text-muted);">Today: <strong style="color:var(--text-main);">{{ number_format($todayVisits) }}</strong></span>
                @if(!is_null($growth))
                    <span class="trend-pill {{ $growth >= 0 ? 'trend-up' : 'trend-down' }}">
                        <i class="fas {{ $growth >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> {{ abs($growth) }}%
                    </span>
                @endif
            </div>
        </div>

        <!-- Tile 2: Unique Identifiers -->
        <div class="hud-stat-card" style="--accent-color: var(--accent-emerald); --icon-bg: #ecfdf5; --icon-color: #059669;">
            <div class="hud-stat-header">
                <span class="hud-stat-title">Unique Digital Entities</span>
                <div class="hud-stat-icon-wrap"><i class="fas fa-fingerprint"></i></div>
            </div>
            <div class="hud-stat-value" style="color:#059669;">{{ number_format($uniqueVisitors) }}</div>
            <div class="hud-stat-footer">
                <span style="color:var(--text-muted);">Entity Coverage</span>
                <span style="color:#059669;font-weight:700;">
                    {{ $totalVisits > 0 ? round(($uniqueVisitors / $totalVisits) * 100, 1) : 0 }}% Unique
                </span>
            </div>
        </div>

        <!-- Tile 3: Live Active Signal -->
        <div class="hud-stat-card" style="--accent-color: var(--accent-amber); --icon-bg: #fffbeb; --icon-color: #d97706;">
            <div class="hud-stat-header">
                <span class="hud-stat-title">Live Active Signals (15m)</span>
                <div class="hud-stat-icon-wrap"><i class="fas fa-satellite-dish"></i></div>
            </div>
            <div class="hud-stat-value" style="color:#d97706;" id="hudActiveNow">{{ number_format($activeNowEstimate) }}</div>
            <div class="hud-stat-footer">
                <span style="color:var(--text-muted);">Real-time pulse</span>
                <span class="trend-pill trend-up"><i class="fas fa-circle-check"></i> Streaming</span>
            </div>
        </div>

        <!-- Tile 4: State Saturation -->
        <div class="hud-stat-card" style="--accent-color: var(--accent-purple); --icon-bg: #f5f3ff; --icon-color: #7c3aed;">
            <div class="hud-stat-header">
                <span class="hud-stat-title">State-Wise Coverage</span>
                <div class="hud-stat-icon-wrap"><i class="fas fa-map-location-dot"></i></div>
            </div>
            <div class="hud-stat-value" style="color:#7c3aed;">{{ $stateBreakdown->count() }}</div>
            <div class="hud-stat-footer">
                <span style="color:var(--text-muted);">Top State</span>
                <span style="color:var(--text-main);font-weight:700;">{{ $stateBreakdown->first()->state_name ?? '—' }}</span>
            </div>
        </div>

        <!-- Tile 5: District & Place Nodes -->
        <div class="hud-stat-card" style="--accent-color: #0284c7; --icon-bg: #f0f9ff; --icon-color: #0284c7;">
            <div class="hud-stat-header">
                <span class="hud-stat-title">District / Place Nodes</span>
                <div class="hud-stat-icon-wrap"><i class="fas fa-city"></i></div>
            </div>
            <div class="hud-stat-value" style="color:#0284c7;">{{ $cityDistrictBreakdown->count() }}</div>
            <div class="hud-stat-footer">
                <span style="color:var(--text-muted);">Top Locality</span>
                <span style="color:var(--text-main);font-weight:700;">{{ $cityDistrictBreakdown->first()->place_name ?? '—' }}</span>
            </div>
        </div>

        <!-- Tile 6: Hardware Ratio -->
        <div class="hud-stat-card" style="--accent-color: var(--accent-rose); --icon-bg: #fff1f2; --icon-color: #e11d48;">
            <div class="hud-stat-header">
                <span class="hud-stat-title">Hardware Matrix</span>
                <div class="hud-stat-icon-wrap"><i class="fas fa-mobile-screen"></i></div>
            </div>
            @php
                $mob = $deviceBreakdown['mobile'] ?? 0;
                $desk = $deviceBreakdown['desktop'] ?? 0;
                $tab = $deviceBreakdown['tablet'] ?? 0;
                $devTot = max($mob + $desk + $tab, 1);
                $mobPct = round(($mob / $devTot) * 100);
                $deskPct = round(($desk / $devTot) * 100);
            @endphp
            <div class="hud-stat-value" style="font-size:20px; display:flex; align-items:center; gap:8px;">
                <span style="color:#2563eb;"><i class="fas fa-desktop" style="font-size:14px;"></i> {{ $deskPct }}%</span>
                <span style="color:var(--text-muted);font-size:14px;">/</span>
                <span style="color:#7c3aed;"><i class="fas fa-mobile" style="font-size:14px;"></i> {{ $mobPct }}%</span>
            </div>
            <div class="hud-stat-footer">
                <div class="progress-meter" style="height:5px;">
                    <div class="progress-fill" style="width: {{ $deskPct }}%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== 4. MULTI-DECK GEOSPATIAL INTELLIGENCE MATRIX (TABS) ===== -->
    <div class="cyber-matrix-card">
        <div class="matrix-header">
            <div class="matrix-title-box">
                <div class="hud-stat-icon-wrap" style="background:#eff6ff; color:var(--accent-blue);">
                    <i class="fas fa-globe-asia"></i>
                </div>
                <div>
                    <h3 class="matrix-title">Multi-Tier Geographic Intelligence Hub</h3>
                    <div class="matrix-subtitle">State-Wise Breakdown &bull; District / Place Radar &bull; Geospatial Visualizer &bull; Global Reach</div>
                </div>
            </div>

            <div class="matrix-nav-tabs">
                <button type="button" class="matrix-tab-btn active" data-tab="tabStates">
                    <i class="fas fa-map"></i> 🛰️ State-Wise Matrix ({{ $stateBreakdown->count() }})
                </button>
                <button type="button" class="matrix-tab-btn" data-tab="tabDistricts">
                    <i class="fas fa-city"></i> 🏙️ District / Place Nodes ({{ $cityDistrictBreakdown->count() }})
                </button>
                <button type="button" class="matrix-tab-btn" data-tab="tabGeoMap">
                    <i class="fas fa-map-location-dot"></i> 🗺️ Cyber Radar Map
                </button>
                <button type="button" class="matrix-tab-btn" data-tab="tabCountries">
                    <i class="fas fa-earth-americas"></i> 🌍 Countries ({{ $countryBreakdown->count() }})
                </button>
            </div>
        </div>

        <!-- PANE 1: STATE-WISE MATRIX -->
        <div class="tab-content-pane active" id="tabStates">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; flex-wrap:wrap; gap:10px;">
                <div style="font-size:13px; color:var(--text-muted);">
                    Showing detailed regional state/province telemetry sorted by volume.
                </div>
                <input type="text" id="stateTableSearch" class="table-search-input" placeholder="Search state name...">
            </div>

            <div class="cyber-table-container">
                <table class="cyber-table" id="stateTable">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>State / Province</th>
                            <th>Country</th>
                            <th>Signal Volume (Hits)</th>
                            <th>Unique IP Entities</th>
                            <th>Regional Share</th>
                            <th style="text-align:right;">Quick Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stateBreakdown as $idx => $st)
                            <tr>
                                <td>
                                    <span class="entity-rank {{ $idx === 0 ? 'rank-top-1' : ($idx === 1 ? 'rank-top-2' : ($idx === 2 ? 'rank-top-3' : '')) }}">
                                        {{ $idx + 1 }}
                                    </span>
                                </td>
                                <td>
                                    <strong style="color:var(--text-main); font-size:13.5px;">{{ $st->state_name }}</strong>
                                </td>
                                <td>
                                    <span style="color:var(--text-muted);"><i class="fas fa-flag" style="font-size:10px;margin-right:4px;"></i> {{ $st->country ?? 'Global' }}</span>
                                </td>
                                <td>
                                    <strong style="color:var(--accent-blue); font-family:'Courier New', monospace; font-size:14px;">
                                        {{ number_format($st->total) }}
                                    </strong>
                                </td>
                                <td>
                                    <span style="color:#059669; font-family:'Courier New', monospace; font-weight:700;">
                                        {{ number_format($st->unique_ips) }}
                                    </span>
                                </td>
                                <td style="min-width:160px;">
                                    <div style="display:flex; justify-content:space-between; font-size:11px; margin-bottom:3px;">
                                        <span style="color:var(--text-muted);">Share</span>
                                        <strong style="color:var(--text-main);">{{ $st->share_pct }}%</strong>
                                    </div>
                                    <div class="progress-meter">
                                        <div class="progress-fill" style="width: {{ $st->share_pct }}%;"></div>
                                    </div>
                                </td>
                                <td style="text-align:right;">
                                    <a href="{{ route('admin.website-visits', array_merge(request()->all(), ['state' => $st->state_name])) }}" 
                                       class="btn-cyber btn-cyber-secondary" style="padding:4px 10px; font-size:11px;" title="Filter dashboard to this state">
                                        <i class="fas fa-filter"></i> Filter
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center; padding:30px; color:var(--text-muted);">
                                    <i class="fas fa-satellite-dish" style="font-size:24px;margin-bottom:10px;display:block;opacity:0.4;"></i>
                                    No state-level telemetry captured for the selected filter range.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PANE 2: DISTRICT & PLACE NODES -->
        <div class="tab-content-pane" id="tabDistricts">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; flex-wrap:wrap; gap:10px;">
                <div style="font-size:13px; color:var(--text-muted);">
                    Granular place & district localities with coordinates and unique visitors.
                </div>
                <input type="text" id="districtTableSearch" class="table-search-input" placeholder="Search place, district, city...">
            </div>

            <div class="cyber-table-container">
                <table class="cyber-table" id="districtTable">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Place / District / Locality</th>
                            <th>State / Province</th>
                            <th>Country</th>
                            <th>Geo Coordinates</th>
                            <th>Volume (Hits)</th>
                            <th>Unique IPs</th>
                            <th>Share</th>
                            <th style="text-align:right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cityDistrictBreakdown as $idx => $pl)
                            <tr>
                                <td>
                                    <span class="entity-rank {{ $idx === 0 ? 'rank-top-1' : ($idx === 1 ? 'rank-top-2' : ($idx === 2 ? 'rank-top-3' : '')) }}">
                                        {{ $idx + 1 }}
                                    </span>
                                </td>
                                <td>
                                    <strong style="color:var(--accent-blue); font-size:13.5px;"><i class="fas fa-location-dot" style="font-size:11px;margin-right:4px;"></i> {{ $pl->place_name }}</strong>
                                </td>
                                <td>{{ $pl->state ?? '—' }}</td>
                                <td>{{ $pl->country ?? '—' }}</td>
                                <td>
                                    @if($pl->lat && $pl->lon)
                                        <span class="coord-pill" title="Latitude, Longitude">
                                            {{ round($pl->lat, 4) }}, {{ round($pl->lon, 4) }}
                                        </span>
                                    @else
                                        <span style="color:var(--text-muted);font-size:11px;">—</span>
                                    @endif
                                </td>
                                <td>
                                    <strong style="color:var(--accent-blue); font-family:'Courier New', monospace; font-size:14px;">
                                        {{ number_format($pl->total) }}
                                    </strong>
                                </td>
                                <td>
                                    <span style="color:#059669; font-family:'Courier New', monospace; font-weight:700;">
                                        {{ number_format($pl->unique_ips) }}
                                    </span>
                                </td>
                                <td style="min-width:130px;">
                                    <div style="display:flex; justify-content:space-between; font-size:11px; margin-bottom:3px;">
                                        <span style="color:var(--text-muted);">Share</span>
                                        <strong style="color:var(--text-main);">{{ $pl->share_pct }}%</strong>
                                    </div>
                                    <div class="progress-meter">
                                        <div class="progress-fill progress-fill-emerald" style="width: {{ $pl->share_pct }}%;"></div>
                                    </div>
                                </td>
                                <td style="text-align:right;">
                                    <a href="{{ route('admin.website-visits', array_merge(request()->all(), ['city' => $pl->place_name])) }}" 
                                       class="btn-cyber btn-cyber-secondary" style="padding:4px 10px; font-size:11px;" title="Filter dashboard to this place">
                                        <i class="fas fa-filter"></i> Filter
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" style="text-align:center; padding:30px; color:var(--text-muted);">
                                    No district or locality telemetry captured for this filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PANE 3: CYBER RADAR MAP (LIGHT) -->
        <div class="tab-content-pane" id="tabGeoMap">
            <div class="map-quick-bar">
                <div style="font-size:13px; color:var(--text-muted);">
                    <i class="fas fa-satellite"></i> Visualizing <strong>{{ $geoMapPoints->count() }}</strong> active geographic coordinates.
                </div>
                <div class="map-btn-group">
                    <button type="button" class="map-jump-btn" onclick="flyMap(20, 0, 2)"><i class="fas fa-globe"></i> Global</button>
                    <button type="button" class="map-jump-btn" onclick="flyMap(20.5937, 78.9629, 5)"><i class="fas fa-flag"></i> India</button>
                    <button type="button" class="map-jump-btn" onclick="flyMap(37.0902, -95.7129, 4)"><i class="fas fa-flag-usa"></i> USA</button>
                    <button type="button" class="map-jump-btn" onclick="flyMap(51.1657, 10.4515, 4)"><i class="fas fa-earth-europe"></i> Europe</button>
                    <button type="button" class="map-jump-btn" onclick="flyMap(1.3521, 103.8198, 5)"><i class="fas fa-earth-asia"></i> SE Asia</button>
                </div>
            </div>
            <div id="telemetryMap"></div>
        </div>

        <!-- PANE 4: GLOBAL COUNTRIES -->
        <div class="tab-content-pane" id="tabCountries">
            <div class="cyber-table-container">
                <table class="cyber-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Country</th>
                            <th>Signal Volume (Hits)</th>
                            <th>Unique Digital Entities</th>
                            <th>Traffic Contribution</th>
                            <th style="text-align:right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($countryBreakdown as $idx => $cnt)
                            <tr>
                                <td>
                                    <span class="entity-rank {{ $idx === 0 ? 'rank-top-1' : ($idx === 1 ? 'rank-top-2' : ($idx === 2 ? 'rank-top-3' : '')) }}">
                                        {{ $idx + 1 }}
                                    </span>
                                </td>
                                <td>
                                    <strong style="color:var(--text-main); font-size:14px;"><i class="fas fa-globe" style="color:var(--accent-blue);margin-right:6px;"></i> {{ $cnt->country }}</strong>
                                </td>
                                <td>
                                    <strong style="color:var(--accent-blue); font-family:'Courier New', monospace; font-size:14px;">
                                        {{ number_format($cnt->total) }}
                                    </strong>
                                </td>
                                <td>
                                    <span style="color:#059669; font-family:'Courier New', monospace; font-weight:700;">
                                        {{ number_format($cnt->unique_ips) }}
                                    </span>
                                </td>
                                <td style="min-width:180px;">
                                    <div style="display:flex; justify-content:space-between; font-size:11px; margin-bottom:3px;">
                                        <span style="color:var(--text-muted);">Share</span>
                                        <strong style="color:var(--text-main);">{{ $cnt->share_pct }}%</strong>
                                    </div>
                                    <div class="progress-meter">
                                        <div class="progress-fill progress-fill-purple" style="width: {{ $cnt->share_pct }}%;"></div>
                                    </div>
                                </td>
                                <td style="text-align:right;">
                                    <a href="{{ route('admin.website-visits', array_merge(request()->all(), ['country' => $cnt->country])) }}" 
                                       class="btn-cyber btn-cyber-secondary" style="padding:4px 10px; font-size:11px;">
                                        <i class="fas fa-filter"></i> Filter
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center; padding:30px; color:var(--text-muted);">
                                    No country telemetry available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ===== 5. INTERACTIVE MULTI-CHART DECK ===== -->
    <div class="chart-deck-grid">
        <!-- Chart 1: Timeline Wave -->
        <div class="chart-box-card">
            <div class="chart-box-header">
                <div class="chart-title">
                    <i class="fas fa-wave-square" style="color:var(--accent-blue);"></i>
                    Telemetry Traffic Ingress Flow
                </div>
                <span class="hud-badge-version">
                    {{ $isHourly ? '24-Hour Rolling Wave' : 'Timeline Waveform' }}
                </span>
            </div>
            <div style="position:relative; height:260px; width:100%;">
                <canvas id="timelineWaveChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Device Neural Radial -->
        <div class="chart-box-card">
            <div class="chart-box-header">
                <div class="chart-title">
                    <i class="fas fa-pie-chart" style="color:#7c3aed;"></i>
                    Hardware Platform Matrix
                </div>
                <span style="font-size:11px; color:var(--text-muted);">Devices</span>
            </div>
            <div style="position:relative; height:220px; width:100%; display:flex; align-items:center; justify-content:center;">
                <canvas id="deviceDoughnutChart"></canvas>
            </div>
            <div style="display:flex; justify-content:space-around; margin-top:10px; font-size:11.5px; border-top:1px solid var(--white-border-subtle); padding-top:8px;">
                <span style="color:#2563eb; font-weight:600;"><i class="fas fa-desktop"></i> Desktop: {{ number_format($deviceBreakdown['desktop'] ?? 0) }}</span>
                <span style="color:#7c3aed; font-weight:600;"><i class="fas fa-mobile-screen"></i> Mobile: {{ number_format($deviceBreakdown['mobile'] ?? 0) }}</span>
                <span style="color:#059669; font-weight:600;"><i class="fas fa-tablet-screen-button"></i> Tablet: {{ number_format($deviceBreakdown['tablet'] ?? 0) }}</span>
            </div>
        </div>
    </div>

    <!-- ===== 6. TOP ROUTES & BROWSER/OS MATRICES ===== -->
    <div class="chart-deck-grid" style="grid-template-columns: 1fr 1fr;">
        <!-- Top Visited Routes -->
        <div class="chart-box-card">
            <div class="chart-box-header">
                <div class="chart-title">
                    <i class="fas fa-route" style="color:#0ea5e9;"></i> Top Ingress Routes
                </div>
                <span style="font-size:11px; color:var(--text-muted);">Top 12 Performing URLs</span>
            </div>
            <div class="cyber-table-container">
                <table class="cyber-table">
                    <thead>
                        <tr>
                            <th>Path</th>
                            <th>Hits</th>
                            <th>Unique</th>
                            <th>Share</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topPages as $p)
                            <tr>
                                <td>
                                    <div style="display:flex; align-items:center; gap:6px;">
                                        <a href="{{ $p->path }}" target="_blank" style="color:var(--text-main); text-decoration:none; font-weight:700; font-family:'Courier New', monospace;" title="Open in new tab">
                                            {{ $p->path === '/' ? '/ (Home)' : $p->path }}
                                        </a>
                                        <a href="{{ $p->path }}" target="_blank" style="color:var(--accent-blue); font-size:10px;"><i class="fas fa-arrow-up-right-from-square"></i></a>
                                    </div>
                                </td>
                                <td><strong style="color:var(--accent-blue); font-family:'Courier New', monospace;">{{ number_format($p->total) }}</strong></td>
                                <td><span style="color:#059669; font-family:'Courier New', monospace; font-weight:700;">{{ number_format($p->unique_ips) }}</span></td>
                                <td style="min-width:90px;">
                                    <div class="progress-meter" style="height:4px;">
                                        <div class="progress-fill" style="width: {{ $p->share_pct }}%;"></div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" style="text-align:center; color:var(--text-muted);">No page hits recorded.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Browser & Operating System Matrices -->
        <div class="chart-box-card">
            <div class="chart-box-header">
                <div class="chart-title">
                    <i class="fas fa-microchip" style="color:#059669;"></i> Browser & OS Telemetry
                </div>
                <span style="font-size:11px; color:var(--text-muted);">Client Environments</span>
            </div>
            
            <div style="margin-bottom:16px;">
                <div style="font-size:11px; font-weight:800; text-transform:uppercase; color:var(--accent-blue); letter-spacing:0.8px; margin-bottom:8px;">
                    <i class="fas fa-window-maximize"></i> Browser Distribution
                </div>
                @php $browserTotal = max(array_sum($browserBreakdown), 1); @endphp
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap:8px;">
                    @foreach($browserBreakdown as $bName => $bCount)
                        @php $bPct = round(($bCount / $browserTotal) * 100, 1); @endphp
                        <div style="background:#f8fafc; border:1px solid var(--white-border); padding:8px 10px; border-radius:8px;">
                            <div style="display:flex; justify-content:space-between; font-size:11px; margin-bottom:4px;">
                                <strong style="color:var(--text-main);">{{ $bName }}</strong>
                                <span style="color:var(--accent-blue); font-weight:700;">{{ $bPct }}%</span>
                            </div>
                            <div class="progress-meter" style="height:3px;">
                                <div class="progress-fill progress-fill-emerald" style="width: {{ $bPct }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div style="font-size:11px; font-weight:800; text-transform:uppercase; color:#7c3aed; letter-spacing:0.8px; margin-bottom:8px;">
                    <i class="fas fa-laptop-code"></i> Operating System Share
                </div>
                @php $osTotal = max(array_sum($osBreakdown), 1); @endphp
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap:8px;">
                    @foreach($osBreakdown as $osName => $osCount)
                        @php $osPct = round(($osCount / $osTotal) * 100, 1); @endphp
                        <div style="background:#f8fafc; border:1px solid var(--white-border); padding:8px 10px; border-radius:8px;">
                            <div style="display:flex; justify-content:space-between; font-size:11px; margin-bottom:4px;">
                                <strong style="color:var(--text-main);">{{ $osName }}</strong>
                                <span style="color:#7c3aed; font-weight:700;">{{ $osPct }}%</span>
                            </div>
                            <div class="progress-meter" style="height:3px;">
                                <div class="progress-fill progress-fill-purple" style="width: {{ $osPct }}%;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ===== 7. LIVE RADAR TRAFFIC STREAM TERMINAL ===== -->
    <div class="live-stream-panel">
        <div class="stream-header">
            <div style="display:flex; align-items:center; gap:10px;">
                <span class="radar-ping"></span>
                <strong style="color:var(--text-main); font-size:15px; letter-spacing:-0.3px;">Real-Time Telemetry Event Stream</strong>
                <span class="stream-status-pill">RECEIVING LIVE SIGNALS</span>
            </div>
            <div style="display:flex; align-items:center; gap:8px; font-size:12px; color:var(--text-muted);">
                <span>Auto-refresh in <strong id="streamCountdown" style="color:var(--accent-blue);">15s</strong></span>
                <button type="button" class="btn-cyber btn-cyber-secondary" style="padding:3px 8px; font-size:11px;" onclick="fetchStreamNow()">
                    <i class="fas fa-arrows-rotate"></i>
                </button>
            </div>
        </div>

        <div class="stream-list" id="telemetryStreamList">
            @forelse($recentVisits as $rv)
                @php
                    $locParts = array_filter([$rv->district ?: $rv->city, $rv->state, $rv->country]);
                    $locString = !empty($locParts) ? implode(', ', $locParts) : 'Local IP / Private Node';
                    $ipParts = explode('.', $rv->ip);
                    $maskedIp = count($ipParts) === 4 ? $ipParts[0] . '.' . $ipParts[1] . '.***.***' : $rv->ip;
                @endphp
                <div class="stream-row" data-id="{{ $rv->id }}">
                    <div class="stream-row-left">
                        <span class="stream-path-badge">{{ $rv->path === '/' ? '/ (Home)' : $rv->path }}</span>
                        <span class="stream-loc-badge" title="{{ $locString }}">
                            <i class="fas fa-location-crosshairs" style="color:var(--accent-blue);font-size:10px;"></i>
                            {{ $locString }}
                        </span>
                    </div>
                    <div class="stream-row-right">
                        <span class="stream-ip-pill">{{ $maskedIp }}</span>
                        <span><i class="fas {{ $rv->device_type === 'mobile' ? 'fa-mobile-screen' : 'fa-desktop' }}"></i></span>
                        <span style="color:var(--accent-blue); font-weight:600;">{{ $rv->visited_at ? $rv->visited_at->diffForHumans(null, true) . ' ago' : 'just now' }}</span>
                    </div>
                </div>
            @empty
                <div style="text-align:center; padding:20px; color:var(--text-muted);">
                    No telemetry events in queue.
                </div>
            @endforelse
        </div>
    </div>

</div>

<!-- ===== JAVASCRIPT LOGIC & MAP INIT ===== -->
<script>
    // 1. Dynamic Cascading Geolocation Filters (Country -> State -> District)
    const geoHierarchy = @json($geoHierarchy);
    const initialCountry = @json($selectedCountry);
    const initialState = @json($selectedState);
    const initialCity = @json($selectedCity);

    const filterCountry = document.getElementById('filterCountry');
    const filterState = document.getElementById('filterState');
    const filterCity = document.getElementById('filterCity');

    function updateStates(country, selectedStateVal = '') {
        if (!filterState) return;
        filterState.innerHTML = '<option value="">All States</option>';
        
        let statesList = [];
        if (country && geoHierarchy[country]) {
            statesList = Object.keys(geoHierarchy[country]);
        } else {
            const allStates = new Set();
            Object.values(geoHierarchy).forEach(cStates => {
                Object.keys(cStates).forEach(s => allStates.add(s));
            });
            statesList = Array.from(allStates);
        }
        statesList.sort();

        statesList.forEach(st => {
            const opt = document.createElement('option');
            opt.value = st;
            opt.textContent = st;
            if (st === selectedStateVal) opt.selected = true;
            filterState.appendChild(opt);
        });
    }

    function updateDistricts(country, state, selectedCityVal = '') {
        if (!filterCity) return;
        filterCity.innerHTML = '<option value="">All Districts / Places</option>';
        
        let placesList = [];
        if (country && state && geoHierarchy[country] && geoHierarchy[country][state]) {
            placesList = geoHierarchy[country][state];
        } else if (state) {
            Object.values(geoHierarchy).forEach(cStates => {
                if (cStates[state]) {
                    placesList = placesList.concat(cStates[state]);
                }
            });
            placesList = Array.from(new Set(placesList));
        } else if (country && geoHierarchy[country]) {
            Object.values(geoHierarchy[country]).forEach(sPlaces => {
                placesList = placesList.concat(sPlaces);
            });
            placesList = Array.from(new Set(placesList));
        }
        placesList.sort();

        placesList.forEach(pl => {
            const opt = document.createElement('option');
            opt.value = pl;
            opt.textContent = pl;
            if (pl === selectedCityVal) opt.selected = true;
            filterCity.appendChild(opt);
        });
    }

    if (filterCountry) {
        filterCountry.addEventListener('change', () => {
            const c = filterCountry.value;
            updateStates(c);
            updateDistricts(c, '');
        });
    }

    if (filterState) {
        filterState.addEventListener('change', () => {
            const c = filterCountry ? filterCountry.value : '';
            const s = filterState.value;
            updateDistricts(c, s);
        });
    }

    // 2. Cyber Clock
    function updateClock() {
        const now = new Date();
        const str = now.toLocaleTimeString('en-GB') + ' IST';
        const el = document.getElementById('cyberClock');
        if (el) el.textContent = str;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // 3. Tabs Switcher
    const tabBtns = document.querySelectorAll('.matrix-tab-btn');
    const tabPanes = document.querySelectorAll('.tab-content-pane');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            btn.classList.add('active');
            const target = btn.getAttribute('data-tab');
            const targetPane = document.getElementById(target);
            if (targetPane) {
                targetPane.classList.add('active');
            }

            // Invalidate Leaflet map size on tab switch
            if (target === 'tabGeoMap' && window.telemetryLeafletMap) {
                setTimeout(() => {
                    window.telemetryLeafletMap.invalidateSize();
                }, 150);
            }
        });
    });

    // 4. Client-side Table Search (State & District Tables)
    function setupTableSearch(inputId, tableId) {
        const input = document.getElementById(inputId);
        const table = document.getElementById(tableId);
        if (!input || !table) return;

        input.addEventListener('input', () => {
            const val = input.value.toLowerCase().trim();
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(r => {
                const text = r.textContent.toLowerCase();
                r.style.display = text.includes(val) ? '' : 'none';
            });
        });
    }
    setupTableSearch('stateTableSearch', 'stateTable');
    setupTableSearch('districtTableSearch', 'districtTable');

    // 4. Timeline Waveform Chart (Light Theme)
    const waveLabels = @json($timelineLabels);
    const waveCounts = @json($timelineCounts);

    const waveCanvas = document.getElementById('timelineWaveChart');
    if (waveCanvas) {
        const waveCtx = waveCanvas.getContext('2d');
        const grad = waveCtx.createLinearGradient(0, 0, 0, 240);
        grad.addColorStop(0, 'rgba(37, 99, 235, 0.25)');
        grad.addColorStop(0.7, 'rgba(37, 99, 235, 0.05)');
        grad.addColorStop(1, 'rgba(255, 255, 255, 0)');

        new Chart(waveCtx, {
            type: 'line',
            data: {
                labels: waveLabels,
                datasets: [{
                    label: 'Ingress Hits',
                    data: waveCounts,
                    borderColor: '#2563eb',
                    borderWidth: 2.5,
                    backgroundColor: grad,
                    fill: true,
                    tension: 0.38,
                    pointRadius: waveLabels.length > 30 ? 1 : 3,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#2563eb',
                    pointBorderColor: '#ffffff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#38bdf8',
                        bodyColor: '#ffffff',
                        borderColor: '#38bdf8',
                        borderWidth: 1,
                        padding: 10,
                        displayColors: false,
                    }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(0, 0, 0, 0.04)' },
                        ticks: { color: '#64748b', font: { size: 11 } }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.04)' },
                        ticks: { color: '#64748b', precision: 0, font: { size: 11 } }
                    }
                }
            }
        });
    }

    // 5. Hardware Doughnut Chart (Light Theme)
    const deviceBreakdown = @json($deviceBreakdown);
    const deviceCanvas = document.getElementById('deviceDoughnutChart');
    if (deviceCanvas) {
        new Chart(deviceCanvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Desktop', 'Mobile', 'Tablet'],
                datasets: [{
                    data: [
                        deviceBreakdown['desktop'] || 0,
                        deviceBreakdown['mobile'] || 0,
                        deviceBreakdown['tablet'] || 0
                    ],
                    backgroundColor: ['#2563eb', '#7c3aed', '#059669'],
                    borderColor: '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleColor: '#38bdf8',
                        bodyColor: '#ffffff',
                        borderColor: '#38bdf8',
                        borderWidth: 1,
                        padding: 10,
                    }
                }
            }
        });
    }

    // 6. Interactive Leaflet Map with CartoDB Voyager (Light)
    let telemetryMap = null;
    const geoPoints = @json($geoMapPoints);

    function initTelemetryMap() {
        const mapEl = document.getElementById('telemetryMap');
        if (!mapEl) return;

        telemetryMap = L.map('telemetryMap', {
            center: [20.5937, 78.9629], // Centered on India region
            zoom: 4,
            zoomControl: true,
            attributionControl: false
        });
        window.telemetryLeafletMap = telemetryMap;

        // CartoDB Voyager light tiles
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            subdomains: 'abcd',
        }).addTo(telemetryMap);

        // Custom Glowing Radar Pin
        const createRadarIcon = (count) => {
            const size = Math.min(Math.max(count > 100 ? 18 : 12, 10), 28);
            return L.divIcon({
                className: 'custom-radar-marker',
                html: `<div style="width:${size}px;height:${size}px;border-radius:50%;background:#2563eb;border:2.5px solid #ffffff;box-shadow:0 0 10px rgba(37,99,235,0.7);animation:radar-blip 2s infinite;"></div>`,
                iconSize: [size, size],
                iconAnchor: [size / 2, size / 2]
            });
        };

        const markers = [];
        geoPoints.forEach(pt => {
            if (pt.lat && pt.lng) {
                const marker = L.marker([pt.lat, pt.lng], { icon: createRadarIcon(pt.total) });
                marker.bindPopup(`
                    <div style="font-family:'Inter',sans-serif;padding:4px 2px;">
                        <div style="font-weight:800;font-size:14px;color:#2563eb;margin-bottom:2px;">
                            <i class="fas fa-location-dot"></i> ${pt.city || 'Place Node'}
                        </div>
                        <div style="font-size:12px;color:#475569;margin-bottom:6px;">
                            ${[pt.state, pt.country].filter(Boolean).join(', ')}
                        </div>
                        <div style="display:flex;justify-content:space-between;gap:12px;font-size:11.5px;border-top:1px solid #e2e8f0;padding-top:4px;">
                            <span style="color:#64748b;">Signal Hits:</span>
                            <strong style="color:#059669;">${Number(pt.total).toLocaleString()}</strong>
                        </div>
                        <div style="font-family:'Courier New',monospace;font-size:10px;color:#64748b;margin-top:2px;">
                            ${Number(pt.lat).toFixed(4)}, ${Number(pt.lng).toFixed(4)}
                        </div>
                    </div>
                `);
                marker.addTo(telemetryMap);
                markers.push(marker);
            }
        });

        if (markers.length > 0) {
            const group = new L.featureGroup(markers);
            telemetryMap.fitBounds(group.getBounds().pad(0.15));
        }
    }

    function flyMap(lat, lng, zoom) {
        if (window.telemetryLeafletMap) {
            window.telemetryLeafletMap.flyTo([lat, lng], zoom, { duration: 1.5 });
        }
    }

    // Init map when DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        initTelemetryMap();
    });

    // 7. Live Stream Poller & Sync Button
    let streamTimer = 15;
    const countdownEl = document.getElementById('streamCountdown');
    const syncIcon = document.getElementById('syncIcon');

    function fetchStreamNow() {
        if (syncIcon) syncIcon.classList.add('fa-spin');

        fetch("{{ route('admin.website-visits.stream') }}")
            .then(res => res.json())
            .then(res => {
                if (res.status === 'success') {
                    renderStream(res.data);
                    const actEl = document.getElementById('hudActiveNow');
                    if (actEl && res.active_now !== undefined) {
                        actEl.textContent = Number(res.active_now).toLocaleString();
                    }
                }
            })
            .catch(err => console.error('Stream poll error:', err))
            .finally(() => {
                if (syncIcon) syncIcon.classList.remove('fa-spin');
                streamTimer = 15;
            });
    }

    function renderStream(items) {
        const list = document.getElementById('telemetryStreamList');
        if (!list || !items || items.length === 0) return;

        let html = '';
        items.forEach(item => {
            const devIcon = item.device === 'mobile' ? 'fa-mobile-screen' : 'fa-desktop';
            html += `
                <div class="stream-row" data-id="${item.id}">
                    <div class="stream-row-left">
                        <span class="stream-path-badge">${item.path === '/' ? '/ (Home)' : item.path}</span>
                        <span class="stream-loc-badge" title="${item.location}">
                            <i class="fas fa-location-crosshairs" style="color:var(--accent-blue);font-size:10px;"></i>
                            ${item.location}
                        </span>
                    </div>
                    <div class="stream-row-right">
                        <span class="stream-ip-pill">${item.masked_ip}</span>
                        <span><i class="fas ${devIcon}"></i></span>
                        <span style="color:var(--accent-blue); font-weight:600;">${item.time_ago}</span>
                    </div>
                </div>
            `;
        });
        list.innerHTML = html;
    }

    // Countdown ticker for live stream
    setInterval(() => {
        streamTimer--;
        if (countdownEl) countdownEl.textContent = streamTimer + 's';
        if (streamTimer <= 0) {
            fetchStreamNow();
        }
    }, 1000);

    const btnSyncNow = document.getElementById('btnSyncNow');
    if (btnSyncNow) {
        btnSyncNow.addEventListener('click', () => {
            fetchStreamNow();
        });
    }
</script>
@endsection
