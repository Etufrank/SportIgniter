<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="app-wrapper">
  <aside class="sidebar">
    <div class="sidebar-logo">Fit<span>Space</span></div>
    <div class="sidebar-section">Menu</div>
    <ul class="sidebar-nav">
      <li><a href="<?= base_url('client/dashboard') ?>" class="active"><i class="bi bi-grid-fill"></i> Mes Réservations</a></li>
      <li><a href="<?= base_url('client/reserver') ?>"><i class="bi bi-calendar-plus-fill"></i> Réserver</a></li>
      <li><a href="<?= base_url('client/profil') ?>"><i class="bi bi-person-bounding-box"></i> Mon Profil</a></li>
      <li><a href="<?= base_url('auth/logout') ?>" style="color:var(--accent);"><i class="bi bi-box-arrow-left"></i> Déconnexion</a></li>
    </ul>
  </aside>
  <div class="main-content">
    <div class="topbar">
      <span class="topbar-title">Mon Espace Client</span>
      <div class="user-profile-menu">
        <div class="avatar"><?= substr(session()->get('user_nom'), 0, 2) ?></div>
        <span><?= esc(session()->get('user_nom')) ?></span>
      </div>
    </div>
    <div class="page-content">
      <h2 style="font-family:'Syne'; font-weight:800; margin-bottom:1.5rem;">Mes réservations en cours</h2>
      <?php if(session()->getFlashdata('info')): ?>
        <div class="flash-message flash-info"><?= session()->getFlashdata('info') ?></div>
      <?php endif; ?>
      <div class="table-responsive-custom">
        <table class="table-custom">
          <thead>
            <tr>
              <th>Activité / Ressource</th>
              <th>Date & Horaires</th>
              <th>Statut</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($reservations as $res): ?>
              <tr>
                <td><strong><?= esc($res['ressource_nom']) ?></strong></td>
                <td>Le <?= date('d/m/Y', strtotime($res['date_debut'])) ?> de <?= date('H\hi', strtotime($res['date_debut'])) ?> à <?= date('H\hi', strtotime($res['date_fin'])) ?></td>
                <td>
                  <span class="badge-statut s-<?= str_replace(' ', '-', $res['statut']) ?>"><?= esc($res['statut']) ?></span>
                </td>
                <td>
                  <?php if($res['statut'] === 'en attente'): ?>
                    <a href="<?= base_url('client/reservations/annuler/'.$res['id']) ?>" class="btn-action-sm btn-danger-sm">Annuler</a>
                  <?php else: ?>
                    <span style="color:var(--muted); font-size:0.85rem;">Indisponible</span>
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