<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section id="page-mes-reservations">
  <div class="app-wrapper">
    
    <aside class="sidebar">
      <div class="sidebar-logo">Fit<span>Space</span></div>
      <ul class="sidebar-nav" style="margin-top:1rem;">
        <li><a href="<?= site_url('client/dashboard') ?>"><i class="bi bi-grid-1x2-fill"></i> Tableau de bord</a></li>
        <li><a href="<?= site_url('client/reserver') ?>" class="active"><i class="bi bi-calendar3"></i> Voir les créneaux</a></li>
        <li><a href="<?= site_url('client/reservations') ?>"><i class="bi bi-bookmark-check-fill"></i> Mes réservations</a></li>
        <li><a href="<?= site_url('client/profil') ?>"><i class="bi bi-person-fill"></i> Mon profil</a></li>
      </ul>
      <div class="sidebar-footer">
        <div class="sidebar-user">
          <div class="avatar">
            <?= strtoupper(substr(session()->get('prenom'), 0, 1) . substr(session()->get('nom'), 0, 1)) ?>
          </div>
          <div class="user-info">
            <div class="name"><?= esc(session()->get('prenom')) ?> <?= esc(session()->get('nom')) ?></div>
            <div class="role">Client</div>
          </div>
          <a href="<?= site_url('auth/logout') ?>" style="margin-left:auto;color:rgba(255,255,255,0.3);font-size:1.1rem;" title="Déconnexion"><i class="bi bi-box-arrow-right"></i></a>
        </div>
      </div>
    </aside>

    <div class="main-content">
      <div class="topbar">
        <span class="topbar-title">Créneaux disponibles</span>
      </div>
      
      <div class="page-content">
        <div class="data-card">
          <div class="data-card-header">
            <h3>Toutes les sessions de réservation</h3>
          </div>
          
          <table class="table-custom">
            <thead>
              <tr>
                <th>Ressource</th>
                <th>Date</th>
                <th>Horaire</th>
                <th>Type</th>
                <th>Statut / Places</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($creneaux)): ?>
                <?php foreach ($creneaux as $c): ?>
                  <?php 
                    $isFull = $c['places_dispo'] <= 0; 
                    $capaciteMax = isset($c['capacite']) ? $c['capacite'] : 10;
                  ?>
                  <tr>
                    <td class="td-name"><?= esc($c['ressource_nom']) ?></td>
                    <td class="td-muted"><?= date('d M Y', strtotime($c['date_debut'])) ?></td>
                    <td class="td-muted"><?= date('H\hi', strtotime($c['date_debut'])) ?> – <?= date('H\hi', strtotime($c['date_fin'])) ?></td>
                    <td>
                      <span class="creneau-type type-<?= esc($c['ressource_type']) ?>" style="font-size:0.68rem;">
                        <?= ucfirst(esc($c['ressource_type'])) ?>
                      </span>
                    </td>
                    <td>
                      <?php if ($isFull): ?>
                        <span class="badge-statut s-refusee">complet</span>
                      <?php else: ?>
                        <span class="badge-statut s-confirmee"><?= esc($c['places_dispo']) ?> / <?= $capaciteMax ?> places</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($isFull): ?>
                        <span style="font-size:0.75rem;color:var(--muted);">—</span>
                      <?php else: ?>
                        <a href="<?= site_url('client/reservations/store/' . $c['id']) ?>" class="btn-sm-custom btn-nav-primary" style="text-decoration:none; background:var(--accent); color:#fff; padding:5px 12px; border-radius:6px; font-size:0.78rem;">
                          <i class="bi bi-plus-lg"></i> Réserver
                        </a>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" style="text-align: center; color: var(--muted); padding: 2rem;">Aucun créneau de disponible pour le moment.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</section>

<?= $this->endSection() ?>