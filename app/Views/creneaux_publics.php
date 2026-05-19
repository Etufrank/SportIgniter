<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section id="page-creneaux" style="padding-top:1rem;">

  <nav class="nav-public">
    <a href="<?= site_url('/') ?>" class="brand">Fit<span>Space</span></a>
    <div class="nav-links">
      <a href="<?= site_url('/') ?>">Accueil</a>
      <a href="<?= site_url('auth/login') ?>">Connexion</a>
      <a href="<?= site_url('auth/register') ?>" class="btn-nav-primary">S'inscrire</a>
    </div>
  </nav>

  <div class="page-section">
    <div class="section-head">
      <h2>Créneaux disponibles</h2>
      <span class="count"><?= count($creneaux) ?> créneaux trouvés</span>
    </div>

    <div class="filter-bar">
      <button class="filter-pill active">Tous</button>
      <button class="filter-pill"><i class="bi bi-people-fill"></i> Cours collectifs</button>
      <button class="filter-pill"><i class="bi bi-door-open-fill"></i> Salles</button>
      <button class="filter-pill"><i class="bi bi-dribbble"></i> Terrains</button>
    </div>

    <div class="creneaux-grid">
      <?php if(!empty($creneaux)): ?>
        <?php foreach($creneaux as $c): ?>
          <?php 
            $isFull = $c['places_dispo'] <= 0; 
            $capaciteMax = isset($c['capacite']) ? $c['capacite'] : 10;
            $placesOccupees = $capaciteMax - $c['places_dispo'];
            $percentage = $capaciteMax > 0 ? ($placesOccupees / $capaciteMax) * 100 : 0;
          ?>
          <div class="creneau-card <?= $isFull ? 'full' : '' ?>">
            <div class="creneau-header">
              <span class="creneau-type type-<?= esc($c['ressource_type']) ?>">
                <?php if($c['ressource_type'] === 'cours'): ?>
                  <i class="bi bi-people-fill"></i> Cours
                <?php elseif($c['ressource_type'] === 'salle'): ?>
                  <i class="bi bi-door-open-fill"></i> Salle
                <?php else: ?>
                  <i class="bi bi-dribbble"></i> Terrain
                <?php endif; ?>
              </span>
              <span style="font-size:0.75rem;color:var(--muted);"><?= date('D d M', strtotime($c['date_debut'])) ?></span>
            </div>
            
            <p class="creneau-title"><?= esc($c['ressource_nom']) ?></p>
            
            <div class="creneau-meta">
              <div class="meta-row"><i class="bi bi-clock"></i> <?= date('H\hi', strtotime($c['date_debut'])) ?> — <?= date('H\hi', strtotime($c['date_fin'])) ?></div>
              <div class="meta-row"><i class="bi bi-geo-alt"></i> <?= esc($c['ressource_desc']) ?></div>
            </div>
            
            <div>
              <div class="places-bar">
                <div class="places-fill" style="width:<?= $isFull ? '100%' : $percentage.'%' ?>; <?= $isFull ? 'background:var(--muted)' : '' ?>"></div>
              </div>
              <div class="places-label">
                <?php if($isFull): ?>
                  Complet — 0 place restante
                <?php else: ?>
                  <?= esc($c['places_dispo']) ?> places restantes sur <?= $capaciteMax ?>
                <?php endif; ?>
              </div>
            </div>

            <?php if($isFull): ?>
              <button class="btn-reserver disabled" disabled>Complet</button>
            <?php else: ?>
              <a href="<?= site_url('auth/login') ?>" class="btn-reserver">Connexion pour réserver</a>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="grid-column: 1/-1; text-align: center; color: var(--muted); padding: 2rem;">Aucun créneau planifié pour le moment.</p>
      <?php endif; ?>
    </div>
  </div>

  <div class="footer-public">FitSpace &copy; 2026 — Projet CodeIgniter 4 · Tous droits <span>réservés</span></div>
</section>

<?= $this->endSection() ?>