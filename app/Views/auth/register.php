<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section style="background:var(--surface);">
  <nav class="nav-public">
    <a href="#" class="brand">Fit<span>Space</span></a>
  </nav>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">Fit<span>Space</span></div>
      <div class="auth-subtitle">Créez votre compte gratuitement.</div>
      
      <?= form_open('auth/registerHandler') ?>
        <div class="form-grid-2 mb-3">
          <div>
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" placeholder="Jean" required />
          </div>
          <div>
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" placeholder="Dupont" required />
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Adresse email</label>
          <input type="email" name="email" class="form-control" placeholder="jean.dupont@email.com" required />
        </div>
        <div class="mb-4">
          <label class="form-label">Mot de passe</label>
          <input type="password" name="password" class="form-control" placeholder="8 caractères minimum" required />
        </div>
        <button type="submit" class="btn-primary-custom">Créer mon compte</button>
      <?= form_close() ?>
      <hr class="auth-divider" />
      <div class="auth-footer">Déjà inscrit ? <a href="<?= base_url('auth/login') ?>">Se connecter</a></div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>