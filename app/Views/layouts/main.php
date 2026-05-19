<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FitSpace — Gestionnaire de réservations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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
      --danger-bg:  #fceade;
      --danger-tx:  #c0392b;
      --info-bg:    #e8f4f8;
      --info-tx:    #0a4d7a;
      --sidebar-w:  240px;
      --nav-h:      64px;
    }
    body { font-family: 'DM Sans', sans-serif; background: #fff; color: var(--text); margin: 0; padding: 0; }
    .brand { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.25rem; color: var(--primary); text-decoration: none; }
    .brand span { color: var(--accent); }
    .nav-public { height: var(--nav-h); border-bottom: 1px solid var(--border); display: flex; align-items: center; padding: 0 2rem; background: #fff; }
    .auth-wrapper { min-height: calc(100vh - var(--nav-h)); display: flex; align-items: center; justify-content: center; padding: 2rem 1rem; }
    .auth-card { background: #fff; border: 1px solid var(--border); border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 440px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); }
    .auth-logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.75rem; color: var(--primary); text-align: center; margin-bottom: 0.5rem; }
    .auth-logo span { color: var(--accent); }
    .auth-subtitle { text-align: center; color: var(--muted); font-size: 0.935rem; margin-bottom: 2rem; }
    .form-label { font-weight: 500; font-size: 0.875rem; margin-bottom: 0.5rem; color: var(--primary); }
    .form-control, .select-custom { border: 1px solid var(--border); border-radius: 8px; padding: 0.625rem 0.875rem; font-size: 0.935rem; transition: all 0.2s; width: 100%; box-sizing: border-box; background-color: #fff; }
    .form-control:focus, .select-custom:focus { border-color: var(--accent); outline: none; box-shadow: 0 0 0 3px rgba(233,69,96,0.1); }
    .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .btn-primary-custom { background: var(--primary); color: #fff; border: none; border-radius: 8px; padding: 0.75rem; width: 100%; font-weight: 500; font-size: 0.935rem; transition: all 0.2s; cursor: pointer; margin-top: 0.5rem; text-decoration: none; display: inline-block; text-align: center; }
    .btn-primary-custom:hover { background: #24243e; color: #fff; }
    .auth-divider { margin: 1.75rem 0; border-color: var(--border); opacity: 0.6; }
    .auth-footer { text-align: center; font-size: 0.875rem; color: var(--muted); }
    .auth-footer a { color: var(--accent); text-decoration: none; font-weight: 500; }
    .flash-message { padding: 0.875rem 1rem; border-radius: 8px; font-size: 0.875rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; }
    .flash-error { background: var(--danger-bg); color: var(--danger-tx); }
    .flash-info { background: var(--info-bg); color: var(--info-tx); }
    .app-wrapper { display: flex; min-height: 100vh; }
    .sidebar { width: var(--sidebar-w); background: var(--primary); color: #fff; padding: 1.5rem 1rem; flex-shrink: 0; }
    .sidebar-logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.5rem; margin-bottom: 2.5rem; padding-left: 0.5rem; }
    .sidebar-logo span { color: var(--accent); }
    .sidebar-section { font-size: 0.68rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: rgba(255,255,255,0.4); margin-bottom: 0.75rem; padding-left: 0.5rem; }
    .sidebar-nav { list-style: none; padding: 0; margin: 0 0 2rem 0; }
    .sidebar-nav li { margin-bottom: 0.25rem; }
    .sidebar-nav a { display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 0.75rem; color: rgba(255,255,255,0.7); text-decoration: none; border-radius: 8px; font-size: 0.935rem; transition: all 0.2s; }
    .sidebar-nav a:hover, .sidebar-nav a.active { color: #fff; background: rgba(255,255,255,0.1); }
    .sidebar-nav a.active { background: var(--accent); }
    .main-content { flex-grow: 1; background: var(--surface); display: flex; flex-direction: column; }
    .topbar { height: var(--nav-h); background: #fff; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; }
    .topbar-title { font-weight: 600; font-size: 1.125rem; }
    .user-profile-menu { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: var(--primary); font-size: 0.875rem; font-weight: 500; }
    .avatar { width: 32px; height: 32px; border-radius: 50%; background: var(--accent); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; }
    .page-content { padding: 2rem; flex-grow: 1; }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
    .stat-card { background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 1.25rem; display: flex; align-items: center; justify-content: space-between; }
    .stat-val { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1.5rem; margin-top: 0.25rem; }
    .stat-label { font-size: 0.81rem; color: var(--muted); font-weight: 500; }
    .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .form-section { background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; }
    .form-section h3 { font-family: 'Syne', sans-serif; font-size: 1.125rem; margin-top: 0; margin-bottom: 1.25rem; }
    .btn-submit { background: var(--accent); color: #fff; border: none; border-radius: 8px; padding: 0.625rem 1.25rem; font-weight: 500; font-size: 0.875rem; cursor: pointer; transition: all 0.2s; }
    .btn-submit:hover { background: #d63953; }
    .btn-secondary-custom { background: #fff; color: var(--text); border: 1px solid var(--border); border-radius: 8px; padding: 0.625rem 1.25rem; font-weight: 500; font-size: 0.875rem; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-block; }
    .btn-secondary-custom:hover { background: var(--surface); }
    .table-responsive-custom { background: #fff; border: 1px solid var(--border); border-radius: 12px; overflow: hidden; }
    .table-custom { width: 100%; border-collapse: collapse; margin: 0; font-size: 0.875rem; }
    .table-custom th { background: #fafafa; font-weight: 600; color: var(--muted); padding: 0.75rem 1rem; border-bottom: 1px solid var(--border); text-align: left; }
    .table-custom td { padding: 1rem; border-bottom: 1px solid var(--border); vertical-align: middle; background: #fff; }
    .table-custom tr:last-child td { border-bottom: none; }
    .badge-statut { padding: 4px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.02em; display: inline-block; }
    .s-en-attente { background: var(--warning-bg); color: var(--warning-tx); }
    .s-confirmee { background: var(--success-bg); color: var(--success-tx); }
    .s-annulee, .s-refusee { background: var(--danger-bg); color: var(--danger-tx); }
    .cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
    .creneau-card { background: #fff; border: 1px solid var(--border); border-radius: 12px; padding: 1.5rem; display: flex; flex-direction: column; justify-content: space-between; position: relative; }
    .c-badge { position: absolute; top: 1.25rem; right: 1.25rem; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; padding: 2px 6px; border-radius: 4px; background: var(--surface); color: var(--muted); border: 1px solid var(--border); }
    .c-title { font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1.125rem; margin-bottom: 0.25rem; }
    .c-type { font-size: 0.75rem; color: var(--accent); font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem; }
    .c-info { display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: var(--text); margin-bottom: 0.5rem; }
    .c-info i { color: var(--muted); }
    .c-footer { margin-top: 1.5rem; border-top: 1px solid var(--border); padding-top: 1rem; display: flex; align-items: center; justify-content: space-between; }
    .btn-action-sm { padding: 5px 10px; font-size: 0.8rem; border-radius: 6px; text-decoration: none; display: inline-block; font-weight: 500; border: none; cursor: pointer; }
    .btn-danger-sm { background: var(--danger-bg); color: var(--danger-tx); }
    .btn-danger-sm:hover { background: #fcdbd0; }
    .btn-success-sm { background: var(--success-bg); color: var(--success-tx); }
    .btn-success-sm:hover { background: #d5f0e0; }
  </style>
</head>
<body>
  <?= $this->renderSection('content') ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>