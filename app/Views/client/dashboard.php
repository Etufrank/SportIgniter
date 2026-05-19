<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section id="page-dashboard-client">
  <div class="app-wrapper">

    <aside class="sidebar">
      <div class="sidebar-logo">Fit<span>Space</span></div>

      <div class="sidebar-section">Menu</div>
      <ul class="sidebar-nav">
        <li><a href="<?= site_url('client/dashboard') ?>" class="active"><i class="bi bi-grid-1x2-fill"></i> Tableau de bord</a></li>
        <li><a href="<?= site_url('client/reserver') ?>"><i class="bi bi-calendar3"></i> Voir les créneaux</a></li>
        <li>
          <a href="<?= site_url('client/dashboard') ?>">
            <i class="bi bi-bookmark-check-fill"></i> Mes réservations
            <?php if (!empty($total_attente) && $total_attente > 0): ?>
              <span class="sidebar-badge urgent"><?= $total_attente ?></span>
            <?php endif; ?>
          </a>
        </li>
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
        <span class="topbar-title">Tableau de bord</span>
        <div class="topbar-actions">
          <a href="<?= site_url('client/reserver') ?>" class="icon-btn" title="Voir les créneaux"><i class="bi bi-plus-lg"></i></a>
        </div>
      </div>

      <div class="page-content">

        <?php if (session()->getFlashdata('info')): ?>
          <div class="flash-message flash-success">
            <i class="bi bi-check-circle-fill"></i>
            <?= session()->getFlashdata('info') ?>
          </div>
        <?php endif; ?>

        <div class="metrics-row">
          <div class="metric-card">
            <div class="metric-icon yellow"><i class="bi bi-hourglass-split"></i></div>
            <div class="metric-value"><?= isset($total_attente) ? $total_attente : 0 ?></div>
            <div class="metric-label">En attente</div>
          </div>
          <div class="metric-card">
            <div class="metric-icon green"><i class="bi bi-check-circle-fill"></i></div>
            <div class="metric-value"><?= isset($total_confirmee) ? $total_confirmee : 0 ?></div>
            <div class="metric-label">Confirmées</div>
          </div>
          <div class="metric-card">
            <div class="metric-icon red"><i class="bi bi-x-circle-fill"></i></div>
            <div class="metric-value"><?= isset($total_annulee) ? $total_annulee : 0 ?></div>
            <div class="metric-label">Annulées</div>
          </div>
          <div class="metric-card">
            <div class="metric-icon blue"><i class="bi bi-calendar-check"></i></div>
            <div class="metric-value"><?= isset($total_avenir) ? $total_avenir : 0 ?></div>
            <div class="metric-label">À venir</div>
          </div>
        </div>

        <div class="data-card">
          <div class="data-card-header">
            <h3>Mes prochaines réservations</h3>
            <a href="<?= site_url('client/dashboard') ?>" style="font-size:0.8rem;color:var(--accent);text-decoration:none;">Voir tout →</a>
          </div>
          <table class="table-custom">
            <thead>
              <tr>
                <th>Créneau</th>
                <th>Date</th>
                <th>Horaire</th>
                <th>Statut</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($reservations)): ?>
                <?php foreach ($reservations as $r): ?>
                  <tr>
                    <td class="td-name"><?= esc($r['ressource_nom']) ?></td>
                    <td class="td-muted"><?= date('D d M Y', strtotime($r['date_debut'])) ?></td>
                    <td class="td-muted"><?= date('H\hi', strtotime($r['date_debut'])) ?> – <?= date('H\hi', strtotime($r['date_fin'])) ?></td>
                    <td>
                      <?php if ($r['statut'] === 'en attente'): ?>
                        <span class="badge-statut s-attente">en attente</span>
                      <?php elseif ($r['statut'] === 'confirmee'): ?>
                        <span class="badge-statut s-confirmee">confirmée</span>
                      <?php else: ?>
                        <span class="badge-statut s-refusee"><?= esc($r['statut']) ?></span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($r['statut'] === 'en attente'): ?>
                        <a href="<?= site_url('client/reservations/annuler/' . $r['id']) ?>" class="btn-sm-custom btn-cancel" style="text-decoration:none;">
                          <i class="bi bi-x"></i> Annuler
                        </a>
                      <?php else: ?>
                        <span style="font-size:0.75rem;color:var(--muted);">—</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" style="text-align: center; color: var(--muted); padding: 2rem;">Vous n'avez pas de réservations planifiées.</td>
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