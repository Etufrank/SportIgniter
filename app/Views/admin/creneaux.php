<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="app-wrapper">
  <aside class="sidebar">
    <div class="sidebar-logo">Fit<span>Space</span> Admin</div>
    <div class="sidebar-section">Gestion</div>
    <ul class="sidebar-nav">
      <li><a href="<?= base_url('admin/dashboard') ?>"><i class="bi bi-speedometer2"></i> Réservations</a></li>
      <li><a href="<?= base_url('admin/creneaux') ?>" class="active"><i class="bi bi-calendar-week-fill"></i> Créneaux</a></li>
      <li><a href="<?= base_url('admin/ressources') ?>"><i class="bi bi-layers-half"></i> Ressources</a></li>
      <li><a href="<?= base_url('admin/clients') ?>"><i class="bi bi-people-fill"></i> Liste Clients</a></li>
      <li><a href="<?= base_url('auth/logout') ?>" style="color:var(--accent);"><i class="bi bi-box-arrow-left"></i> Déconnexion</a></li>
    </ul>
  </aside>
  <div class="main-content">
    <div class="topbar">
      <span class="topbar-title">Planification des créneaux</span>
    </div>
    <div class="page-content">
      <div class="form-section">
        <h3>Ajouter un nouveau créneau horaire</h3>
        <?= form_open('admin/creneaux/store') ?>
          <div class="form-grid-2 mb-3">
            <div>
              <label class="form-label">Choisir la ressource cible</label>
              <select name="ressource_id" class="select-custom" required>
                <?php foreach($ressources as $res): ?>
                  <option value="<?= $res['id'] ?>"><?= esc($res['nom']) ?> (Capacité Max: <?= esc($res['capacite']) ?>)</option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <label class="form-label">Nombre de places ouvertes</label>
              <input type="number" name="places_dispo" class="form-control" required min="1" placeholder="10" />
            </div>
          </div>
          <div class="form-grid-2 mb-4">
            <div>
              <label class="form-label">Date et Heure de Début</label>
              <input type="datetime-local" name="date_debut" class="form-control" required />
            </div>
            <div>
              <label class="form-label">Date et Heure de Fin</label>
              <input type="datetime-local" name="date_fin" class="form-control" required />
            </div>
          </div>
          <button type="submit" class="btn-submit">Publier le créneau</button>
        <?= form_close() ?>
      </div>
      
      <h3 style="font-family:'Syne'; font-weight:700; margin-bottom:1rem;">Créneaux configurés</h3>
      <div class="table-responsive-custom">
        <table class="table-custom">
          <thead>
            <tr>
              <th>Ressource</th>
              <th>Date / Début</th>
              <th>Fin</th>
              <th>Places Restantes</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($creneaux as $c): ?>
              <tr>
                <td><strong><?= esc($c['ressource_nom']) ?></strong><br><small style="color:var(--muted); text-transform:uppercase; font-size:0.7rem;"><?= esc($c['ressource_type']) ?></small></td>
                <td><?= date('d/m/Y \à H\hi', strtotime($c['date_debut'])) ?></td>
                <td><?= date('d/m/Y \à H\hi', strtotime($c['date_fin'])) ?></td>
                <td><strong><?= esc($c['places_dispo']) ?></strong> / <?= esc($c['ressource_capacite']) ?></td>
                <td><a href="<?= base_url('admin/creneaux/delete/'.$c['id']) ?>" class="btn-action-sm btn-danger-sm">Supprimer</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>