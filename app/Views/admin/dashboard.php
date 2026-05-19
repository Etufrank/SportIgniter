<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="app-wrapper">
  <aside class="sidebar">
    <div class="sidebar-logo">Fit<span>Space</span> Admin</div>
    <div class="sidebar-section">Gestion</div>
    <ul class="sidebar-nav">
      <li><a href="<?= base_url('admin/dashboard') ?>" class="active"><i class="bi bi-speedometer2"></i> Réservations</a></li>
      <li><a href="<?= base_url('admin/creneaux') ?>"><i class="bi bi-calendar-week-fill"></i> Créneaux</a></li>
      <li><a href="<?= base_url('admin/ressources') ?>"><i class="bi bi-layers-half"></i> Ressources</a></li>
      <li><a href="<?= base_url('admin/clients') ?>"><i class="bi bi-people-fill"></i> Liste Clients</a></li>
      <li><a href="<?= base_url('auth/logout') ?>" style="color:var(--accent);"><i class="bi bi-box-arrow-left"></i> Déconnexion</a></li>
    </ul>
  </aside>
  <div class="main-content">
    <div class="topbar">
      <span class="topbar-title">Tableau de Bord Administrateur</span>
    </div>
    <div class="page-content">
      <div class="stats-grid">
        <div class="stat-card">
          <div><div class="stat-label">Réservations totales</div><div class="stat-val"><?= $total_reservations ?></div></div>
          <div class="stat-icon" style="background:#e8f4f8; color:#0a4d7a;"><i class="bi bi-bookmark-check-fill"></i></div>
        </div>
        <div class="stat-card">
          <div><div class="stat-label">Clients inscrits</div><div class="stat-val"><?= $total_clients ?></div></div>
          <div class="stat-icon" style="background:#e9f7ef; color:#1a6b39;"><i class="bi bi-people-fill"></i></div>
        </div>
        <div class="stat-card">
          <div><div class="stat-label">Créneaux créés</div><div class="stat-val"><?= $total_creneaux ?></div></div>
          <div class="stat-icon" style="background:#fff8e6; color:#7a5300;"><i class="bi bi-calendar3"></i></div>
        </div>
      </div>
      
      <h3 style="font-family:'Syne'; font-weight:700; margin-bottom:1rem;">Toutes les demandes de réservations</h3>
      <div class="table-responsive-custom">
        <table class="table-custom">
          <thead>
            <tr>
              <th>Client</th>
              <th>Activité</th>
              <th>Date & Heures</th>
              <th>Statut</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($reservations as $r): ?>
              <tr>
                <td><strong><?= esc($r['user_nom']) ?></strong><br><small style="color:var(--muted);"><?= esc($r['user_email']) ?></small></td>
                <td><?= esc($r['ressource_nom']) ?></td>
                <td>Le <?= date('d/m/Y', strtotime($r['date_debut'])) ?> à <?= date('H\hi', strtotime($r['date_debut'])) ?></td>
                <td><span class="badge-statut s-<?= str_replace(' ', '-', $r['statut']) ?>"><?= esc($r['statut']) ?></span></td>
                <td>
                  <?php if($r['statut'] === 'en attente'): ?>
                    <a href="<?= base_url('admin/dashboard/statut/'.$r['id'].'/confirmee') ?>" class="btn-action-sm btn-success-sm">Confirmer</a>
                    <a href="<?= base_url('admin/dashboard/statut/'.$r['id'].'/refusee') ?>" class="btn-action-sm btn-danger-sm">Refuser</a>
                  <?php else: ?>
                    <span style="color:var(--muted); font-size:0.85rem;">Traité</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>