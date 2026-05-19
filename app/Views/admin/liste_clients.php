<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="app-wrapper">
  <aside class="sidebar">
    <div class="sidebar-logo">Fit<span>Space</span> Admin</div>
    <div class="sidebar-section">Gestion</div>
    <ul class="sidebar-nav">
      <li><a href="<?= base_url('admin/dashboard') ?>"><i class="bi bi-speedometer2"></i> Réservations</a></li>
      <li><a href="<?= base_url('admin/creneaux') ?>"><i class="bi bi-calendar-week-fill"></i> Créneaux</a></li>
      <li><a href="<?= base_url('admin/ressources') ?>"><i class="bi bi-layers-half"></i> Ressources</a></li>
      <li><a href="<?= base_url('admin/clients') ?>" class="active"><i class="bi bi-people-fill"></i> Liste Clients</a></li>
      <li><a href="<?= base_url('auth/logout') ?>" style="color:var(--accent);"><i class="bi bi-box-arrow-left"></i> Déconnexion</a></li>
    </ul>
  </aside>
  <div class="main-content">
    <div class="topbar">
      <span class="topbar-title">Fichiers des membres</span>
    </div>
    <div class="page-content">
      <h2 style="font-family:'Syne'; font-weight:800; margin-bottom:1.5rem;">Liste des utilisateurs clients inscrits</h2>
      <div class="table-responsive-custom">
        <table class="table-custom">
          <thead>
            <tr>
              <th>Identifiant</th>
              <th>Nom complet</th>
              <th>Adresse Électronique</th>
              <th>Membre depuis le</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($clients as $client): ?>
              <tr>
                <td>#<?= esc($client['id']) ?></td>
                <td><strong><?= esc($client['nom']) ?></strong></td>
                <td><?= esc($client['email']) ?></td>
                <td class="text-muted"><?= date('d/m/Y \à H\hi', strtotime($client['created_at'])) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>