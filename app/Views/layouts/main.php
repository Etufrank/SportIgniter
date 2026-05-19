<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FitSpace — Gestionnaire de réservations</title>
  <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet" />
  <style>
    :root {
      --primary:    #1a1a2e;
      --accent:     #e94560;
      --accent2:    #0f3460;
      --surface:    #f7f7fa;
      --border:     #e2e2ea;
      --text:       #1a1a2e;
      --muted:      #7b7b96;
      --success-bg: #e9f7ef;
      --success-tx: #1a6b39;
      --warning-bg: #fff8e6;
      --warning-tx: #7a5300;
      --danger-bg:  #fdecea;
      --danger-tx:  #8b1a1a;
      --info-bg:    #e8f4fd;
      --info-tx:    #0a4d7a;
      --nav-h:      64px;
    }
    *, *::before, *::after { box-sizing: border-box; }
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--surface);
      color: var(--text);
      margin: 0;
    }
    h1, h2, h3, .brand { font-family: 'Syne', sans-serif; }
    
    /* NAV BAR */
    .nav-public {
      background: var(--primary);
      height: var(--nav-h);
      display: flex;
      align-items: center;
      padding: 0 2rem;
      gap: 2rem;
    }
    .nav-public .brand {
      color: #fff;
      font-size: 1.4rem;
      font-weight: 800;
      text-decoration: none;
      letter-spacing: -0.5px;
    }
    .nav-public .brand span { color: var(--accent); }
    .nav-public .nav-links { margin-left: auto; display: flex; align-items: center; gap: 1rem; }
    .nav-public .nav-links a {
      color: rgba(255,255,255,0.7);
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      transition: color 0.15s;
    }
    .nav-public .nav-links a:hover { color: #fff; }
    .btn-nav-primary {
      background: var(--accent);
      color: #fff !important;
      border-radius: 6px;
      padding: 8px 18px;
    }
    .btn-nav-primary:hover { background: #c73250 !important; }
    
    /* HERO ACCUEIL */
    .hero {
      background: var(--primary);
      padding: 80px 2rem 100px;
      text-align: center;
    }
    .hero-eyebrow {
      display: inline-block;
      background: rgba(233,69,96,0.15);
      color: var(--accent);
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      padding: 6px 14px;
      border-radius: 20px;
      margin-bottom: 1.5rem;
    }
    .hero h1 {
      color: #fff;
      font-size: clamp(2rem, 5vw, 3.2rem);
      font-weight: 800;
      line-height: 1.1;
      margin-bottom: 1rem;
    }
    .hero h1 em { color: var(--accent); font-style: normal; }
    .hero p {
      color: rgba(255,255,255,0.6);
      font-size: 1.05rem;
      max-width: 540px;
      margin: 0 auto 2rem;
    }
    .hero-ctas { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
    .btn-hero {
      padding: 12px 28px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.95rem;
      text-decoration: none;
      transition: all 0.15s;
    }
    .btn-hero-primary { background: var(--accent); color: #fff; }
    .btn-hero-primary:hover { background: #c73250; color: #fff; }
    .btn-hero-outline { border: 1.5px solid rgba(255,255,255,0.3); color: #fff; }
    .btn-hero-outline:hover { border-color: #fff; color: #fff; }
    
    /* BAND STATS */
    .stats-band {
      background: var(--accent2);
      padding: 1.5rem 2rem;
      display: flex;
      justify-content: center;
      gap: 3rem;
      flex-wrap: wrap;
    }
    .stat-item { text-align: center; }
    .stat-item .num { font-family: 'Syne', sans-serif; font-size: 1.6rem; font-weight: 800; color: #fff; }
    .stat-item .lbl { font-size: 0.75rem; color: rgba(255,255,255,0.5); margin-top: 2px; }
    
    /* PAGES STRUCTURE & FILTRES */
    .page-section { padding: 2.5rem 2rem; max-width: 1100px; margin: 0 auto; }
    .section-head { margin-bottom: 1.5rem; }
    .section-head h2 { font-size: 1.5rem; font-weight: 800; margin: 0; }
    .section-head .count { font-size: 0.85rem; color: var(--muted); }
    .filter-bar { display: flex; gap: 8px; margin-bottom: 1.5rem; flex-wrap: wrap; }
    .filter-pill { background: #fff; border: 1px solid var(--border); padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; color: var(--text); cursor: pointer; transition: all 0.1s; }
    .filter-pill:hover { border-color: var(--muted); }
    .filter-pill.active { background: var(--primary); color: #fff; border-color: var(--primary); }
    
    /* GRILLE & CARDS CRENEAUX */
    .creneaux-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1rem; }
    .creneau-card { background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 1.25rem; display: flex; flex-direction: column; gap: 0.75rem; position: relative; }
    .creneau-card.full { background: #fdfdfd; opacity: 0.8; }
    .creneau-header { display: flex; align-items: center; justify-content: space-between; gap: 8px; }
    .creneau-type { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; padding: 4px 9px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px; }
    .type-cours { background: var(--info-bg); color: var(--info-tx); }
    .type-salle { background: var(--success-bg); color: var(--success-tx); }
    .type-terrain { background: var(--warning-bg); color: var(--warning-tx); }
    .creneau-title { font-weight: 700; font-size: 1.1rem; margin: 0; color: var(--primary); }
    .creneau-meta { display: flex; flex-direction: column; gap: 5px; }
    .meta-row { display: flex; align-items: center; gap: 6px; font-size: 0.85rem; color: var(--muted); }
    .meta-row i { color: var(--muted); }
    .places-bar { height: 4px; background: var(--border); border-radius: 2px; overflow: hidden; }
    .places-fill { height: 100%; background: var(--accent); }
    .places-label { font-size: 0.75rem; color: var(--muted); margin-top: 3px; }
    .btn-reserver { background: var(--accent); color: #fff; border: none; border-radius: 8px; padding: 10px; font-weight: 600; text-decoration: none; text-align: center; font-size: 0.9rem; }
    .btn-reserver:hover { background: #c73250; color: #fff; }
    .btn-reserver.disabled { background: var(--border) !important; color: var(--muted) !important; cursor: not-allowed; }
    
    /* AUTH PAGES (LOGIN & REGISTER) */
    .auth-wrapper { min-height: calc(100vh - var(--nav-h)); display: flex; align-items: center; justify-content: center; padding: 2.5rem 1rem; }
    .auth-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 440px; }
    .auth-logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.6rem; color: var(--primary); text-align: center; margin-bottom: 0.25rem; }
    .auth-logo span { color: var(--accent); }
    .auth-subtitle { font-size: 0.85rem; color: var(--muted); text-align: center; margin-bottom: 2rem; }
    .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .form-label { font-size: 0.85rem; font-weight: 500; color: var(--primary); margin-bottom: 6px; display: block; }
    .form-control { border: 1.5px solid var(--border); border-radius: 8px; padding: 10px 14px; font-size: 0.9rem; background: #fff; color: var(--text); }
    .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(233,69,96,0.08); outline: none; }
    .btn-primary-custom { background: var(--accent); border: none; color: #fff; border-radius: 8px; padding: 12px; font-weight: 600; font-size: 0.95rem; width: 100%; cursor: pointer; transition: background 0.15s; }
    .btn-primary-custom:hover { background: #c73250; }
    .auth-divider { border: none; border-top: 1px solid var(--border); margin: 1.75rem 0; }
    .auth-footer { text-align: center; font-size: 0.85rem; color: var(--muted); }
    .auth-footer a { color: var(--accent); text-decoration: none; font-weight: 500; }
    .flash-message { padding: 10px 14px; border-radius: 8px; font-size: 0.85rem; font-weight: 500; display: flex; align-items: center; gap: 8px; margin-bottom: 1.25rem; }
    .flash-error { background: var(--danger-bg); color: var(--danger-tx); border: 1px solid #f5b8b8; }
    .flash-info { background: var(--info-bg); color: var(--info-tx); border: 1px solid #bce0fd; }
    
    /* FOOTER */
    .footer-public { background: var(--primary); color: rgba(255,255,255,0.4); text-align: center; padding: 1.5rem; font-size: 0.8rem; }
    .footer-public span { color: var(--accent); }
    /* APP WRAPPER & DASHBOARD STRUCTURE */
.app-wrapper { display: flex; min-height: 100vh; background: var(--surface); }
.sidebar { width: 260px; background: var(--primary); display: flex; flex-direction: column; flex-shrink: 0; }
.sidebar-logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.4rem; color: #fff; padding: 1.5rem 2rem; border-bottom: 1px solid rgba(255,255,255,0.05); }
.sidebar-logo span { color: var(--accent); }
.sidebar-section { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.3); padding: 1.5rem 2rem 0.5rem; font-weight: 600; }
.sidebar-nav { list-style: none; padding: 0; margin: 0; }
.sidebar-nav a { display: flex; align-items: center; gap: 12px; padding: 10px 2rem; color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: all 0.15s; }
.sidebar-nav a:hover, .sidebar-nav a.active { color: #fff; background: rgba(255,255,255,0.03); }
.sidebar-nav a.active { border-left: 3px solid var(--accent); padding-left: calc(2rem - 3px); }
.sidebar-badge { margin-left: auto; font-size: 0.7rem; font-weight: 600; padding: 2px 7px; border-radius: 10px; }
.sidebar-badge.urgent { background: var(--accent); color: #fff; }
.sidebar-footer { margin-top: auto; padding: 1rem 1.5rem; border-top: 1px solid rgba(255,255,255,0.05); background: rgba(0,0,0,0.1); }
.sidebar-user { display: flex; align-items: center; gap: 10px; }
.sidebar-user .avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--accent2); color: #fff; font-weight: 600; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; }
.sidebar-user .user-info .name { color: #fff; font-size: 0.85rem; font-weight: 500; line-height: 1.2; }
.sidebar-user .user-info .role { color: rgba(255,255,255,0.4); font-size: 0.75rem; }

.main-content { flex-grow: 1; display: flex; flex-direction: column; min-width: 0; }
.topbar { height: var(--nav-h); background: #fff; border-bottom: 1px solid var(--border); display: flex; align-items: center; padding: 0 2rem; justify-content: space-between; }
.topbar-title { font-weight: 700; font-size: 1.15rem; color: var(--primary); font-family: 'Syne', sans-serif; }
.topbar-actions .icon-btn { width: 36px; height: 36px; border-radius: 8px; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--text); text-decoration: none; transition: background 0.15s; }
.topbar-actions .icon-btn:hover { background: var(--surface); }
.page-content { padding: 2rem; flex-grow: 1; }

/* METRICS */
.metrics-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
.metric-card { background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 1.25rem; display: flex; align-items: center; gap: 15px; }
.metric-icon { width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
.metric-icon.yellow { background: var(--warning-bg); color: var(--warning-tx); }
.metric-icon.green { background: var(--success-bg); color: var(--success-tx); }
.metric-icon.red { background: var(--danger-bg); color: var(--danger-tx); }
.metric-icon.blue { background: var(--info-bg); color: var(--info-tx); }
.metric-value { font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 800; color: var(--primary); line-height: 1; }
.metric-label { font-size: 0.8rem; color: var(--muted); margin-top: 2px; }

/* TABLES & CARDS */
.data-card { background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; }
.data-card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; }
.data-card-header h3 { font-size: 1.1rem; font-weight: 700; margin: 0; color: var(--primary); font-family: 'Syne', sans-serif; }
.table-custom { width: 100%; border-collapse: collapse; text-align: left; }
.table-custom th { font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: var(--muted); padding: 10px 12px; border-bottom: 1px solid var(--border); letter-spacing: 0.5px; }
.table-custom td { padding: 14px 12px; border-bottom: 1px solid var(--border); font-size: 0.9rem; vertical-align: middle; }
.table-custom tr:last-child td { border-bottom: none; }
.table-custom .td-name { font-weight: 600; color: var(--primary); }
.table-custom .td-muted { color: var(--muted); }

/* STATUS BADGES & BUTTONS */
.badge-statut { font-size: 0.72rem; font-weight: 600; text-transform: uppercase; padding: 4px 8px; border-radius: 4px; display: inline-block; }
.badge-statut.s-attente { background: var(--warning-bg); color: var(--warning-tx); }
.badge-statut.s-confirmee { background: var(--success-bg); color: var(--success-tx); }
.badge-statut.s-refusee { background: var(--danger-bg); color: var(--danger-tx); }
.btn-sm-custom { padding: 5px 10px; border-radius: 6px; font-size: 0.78rem; font-weight: 500; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; }
.btn-sm-custom.btn-cancel { background: var(--danger-bg); color: var(--danger-tx); transition: opacity 0.15s; }
.btn-sm-custom.btn-cancel:hover { opacity: 0.85; }
  </style>
</head>
<body>
  <?= $this->renderSection('content') ?>
  <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>