<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="app-wrapper">
  <aside class="sidebar">
    <div class="sidebar-logo">Fit<span>Space</span></div>
    <div class="sidebar-section">Menu</div>
    <ul class="sidebar-nav">
      <li><a href="<?= base_url('client/dashboard') ?>"><i class="bi bi-grid-fill"></i> Mes Réservations</a></li>
      <li><a href="<?= base_url('client/reserver') ?>" class="active"><i class="bi bi-calendar-plus-fill"></i> Réserver</a></li>
      <li><a href="<?= base_url('client/profil') ?>"><i class="bi bi-person-bounding-box"></i> Mon Profil</a></li>
      <li><a href="<?= base_url('auth/logout') ?>" style="color:var(--accent);"><i class="bi bi-box-arrow-left"></i> Déconnexion</a></li>
    </ul>
  </aside>
  <div class="main-content">
    <div class="topbar">
      <span class="topbar-title">Disponibilités des créneaux</span>
      <div class="user-profile-menu">
        <div class="avatar"><?= substr(session()->get('user_nom'), 0, 2) ?></div>
        <span><?= esc(session()->get('user_nom')) ?></span>
      </div>
    </div>
    <div class="page-content">
      <h2 style="font-family:'Syne'; font-weight:800; margin-bottom:1.5rem;">Choisir un créneau</h2>
      <?php if(session()->getFlashdata('error')): ?>
        <div class="flash-message flash-error"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>
      <div class="cards-grid">
        <?php foreach($creneaux as $c): ?>
          <?php if($c['actif'] == 1): ?>
            <div class="creneau-card">
              <span class="c-badge"><?= esc($c['places_dispo']) ?> places</span>
              <div>
                <div class="c-title"><?= esc($c['ressource_nom']) ?></div>
                <div class="c-type"><?= esc($c['ressource_type']) ?></div>
                <div class="c-info"><i class="bi bi-calendar3"></i> <?= date('d/m/Y', strtotime($c['date_debut'])) ?></div>
                <div class="c-info"><i class="bi bi-clock"></i> <?= date('H\hi', strtotime($c['date_debut'])) ?> – <?= date('H\hi', strtotime($c['date_fin'])) ?></div>
              </div>
              <div class="c-footer">
                <span style="font-size:0.8rem; color:var(--muted);">Capacité max: <?= esc($c['ressource_capacite']) ?></span>
                <?php if($c['places_dispo'] > 0): ?>
                  <a href="<?= base_url('client/reservations/store/'.$c['id']) ?>" class="btn-submit" style="text-decoration:none; font-size:0.8rem;">Réserver</a>
                <?php else: ?>
                  <span class="badge-statut s-annulee">Complet</span>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>