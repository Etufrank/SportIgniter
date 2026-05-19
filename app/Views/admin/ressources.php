<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="app-wrapper">
  <aside class="sidebar">
    <div class="sidebar-logo">Fit<span>Space</span> Admin</div>
    <div class="sidebar-section">Gestion</div>
    <ul class="sidebar-nav">
      <li><a href="<?= base_url('admin/dashboard') ?>"><i class="bi bi-speedometer2"></i> Réservations</a></li>
      <li><a href="<?= base_url('admin/creneaux') ?>"><i class="bi bi-calendar-week-fill"></i> Créneaux</a></li>
      <li><a href="<?= base_url('admin/ressources') ?>" class="active"><i class="bi bi-layers-half"></i> Ressources</a></li>
      <li><a href="<?= base_url('admin/clients') ?>"><i class="bi bi-people-fill"></i> Liste Clients</a></li>
      <li><a href="<?= base_url('auth/logout') ?>" style="color:var(--accent);"><i class="bi bi-box-arrow-left"></i> Déconnexion</a></li>
    </ul>
  </aside>
  <div class="main-content">
    <div class="topbar">
      <span class="topbar-title">Configuration des structures</span>
    </div>
    <div class="page-content">
      <div class="form-section">
        <h3>Créer une nouvelle ressource (Salle, Cours, Terrain)</h3>
        <?= form_open('admin/ressources/store') ?>
          <div class="form-grid-2 mb-3">
            <div>
              <label class="form-label">Nom de la ressource</label>
              <input type="text" name="nom" class="form-control" placeholder="Ex: Terrain de Tennis A" required />
            </div>
            <div>
              <label class="form-label">Type de catégorie</label>
              <select name="type" class="select-custom" required>
                <option value="salle">Salle de sport</option>
                <option value="cours">Cours collectif</option>
                <option value="terrain">Terrain de jeu</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Capacité d'accueil maximum</label>
            <input type="number" name="capacite" class="form-control" placeholder="Ex: 20" required min="1" />
          </div>
          <div class="mb-4">
            <label class="form-label">Description ou détails</label>
            <textarea name="description" class="form-control" rows="2" placeholder="Informations complémentaires importantes..."></textarea>
          </div>
          <button type="submit" class="btn-submit">Enregistrer la ressource</button>
        <?= form_close() ?>
      </div>
      
      <h3 style="font-family:'Syne'; font-weight:700; margin-bottom:1rem;">Ressources matérielles actuelles</h3>
      <div class="table-responsive-custom">
        <table class="table-custom">
          <thead>
            <tr>
              <th>Nom complet</th>
              <th>Catégorie</th>
              <th>Capacité maximale</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($ressources as $res): ?>
              <tr>
                <td><strong><?= esc($res['nom']) ?></strong><br><small style="color:var(--muted);"><?= esc($res['description']) ?></small></td>
                <td><span class="badge-statut s-info"><?= esc($res['type']) ?></span></td>
                <td><?= esc($res['capacite']) ?> personnes max</td>
                <td><a href="<?= base_url('admin/ressources/delete/'.$res['id']) ?>" class="btn-action-sm btn-danger-sm">Retirer</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>