<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="app-wrapper">
  <aside class="sidebar">
    <div class="sidebar-logo">Fit<span>Space</span></div>
    <div class="sidebar-section">Menu</div>
    <ul class="sidebar-nav">
      <li><a href="<?= base_url('client/dashboard') ?>"><i class="bi bi-grid-fill"></i> Mes Réservations</a></li>
      <li><a href="<?= base_url('client/reserver') ?>"><i class="bi bi-calendar-plus-fill"></i> Réserver</a></li>
      <li><a href="<?= base_url('client/profil') ?>" class="active"><i class="bi bi-person-bounding-box"></i> Mon Profil</a></li>
      <li><a href="<?= base_url('auth/logout') ?>" style="color:var(--accent);"><i class="bi bi-box-arrow-left"></i> Déconnexion</a></li>
    </ul>
  </aside>
  <div class="main-content">
    <div class="topbar">
      <span class="topbar-title">Mon Profil</span>
      <div class="user-profile-menu">
        <div class="avatar"><?= substr(session()->get('user_nom'), 0, 2) ?></div>
        <span><?= esc(session()->get('user_nom')) ?></span>
      </div>
    </div>
    <div class="page-content">
      <?php if(session()->getFlashdata('info')): ?>
        <div class="flash-message flash-info"><?= session()->getFlashdata('info') ?></div>
      <?php endif; ?>
      <div class="form-section" style="max-width: 500px;">
        <h3>Modifier mes informations</h3>
        <?= form_open('client/profil/update') ?>
          <div class="mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="nom" class="form-control" value="<?= esc($user['nom']) ?>" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Adresse email (Non modifiable)</label>
            <input type="email" class="form-control" value="<?= esc($user['email']) ?>" readonly style="background:var(--surface);" />
          </div>
          <div class="mb-4">
            <label class="form-label">Nouveau mot de passe (Laisser vide si inchangé)</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" />
          </div>
          <button type="submit" class="btn-submit">Sauvegarder les changements</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>