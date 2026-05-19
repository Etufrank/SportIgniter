<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section id="page-inscription" style="background:var(--surface);">
  <nav class="nav-public">
    <a href="<?= site_url('/') ?>" class="brand">Fit<span>Space</span></a>
  </nav>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">Fit<span>Space</span></div>
      <div class="auth-subtitle">Créez votre compte client gratuitement.</div>

      <?php $validation = \Config\Services::validation(); ?>

      <?= form_open('auth/registerHandler') ?>
        <div class="form-grid-2 mb-3">
          <div class="form-group">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" placeholder="Jean" value="<?= old('prenom') ?>" required />
            <?php if ($validation->getError('prenom')): ?>
              <small style="color:var(--accent);font-size:0.78rem;margin-top:3px;"><?= $validation->getError('prenom') ?></small>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" placeholder="Dupont" value="<?= old('nom') ?>" required />
            <?php if ($validation->getError('nom')): ?>
              <small style="color:var(--accent);font-size:0.78rem;margin-top:3px;"><?= $validation->getError('nom') ?></small>
            <?php endif; ?>
          </div>
        </div>
        
        <div class="form-group mb-3">
          <label class="form-label">Adresse email</label>
          <input type="email" name="email" class="form-control" placeholder="jean.dupont@email.com" value="<?= old('email') ?>" required />
          <?php if ($validation->getError('email')): ?>
            <small style="color:var(--accent);font-size:0.78rem;margin-top:3px;"><?= $validation->getError('email') ?></small>
          <?php endif; ?>
        </div>
        
        <div class="form-group mb-3">
          <label class="form-label">Mot de passe</label>
          <input type="password" name="password" class="form-control" placeholder="8 caractères minimum" required />
          <?php if ($validation->getError('password')): ?>
            <small style="color:var(--accent);font-size:0.78rem;margin-top:3px;"><?= $validation->getError('password') ?></small>
          <?php endif; ?>
        </div>
        
        <div class="form-group mb-4">
          <label class="form-label">Confirmer le mot de passe</label>
          <input type="password" name="password_confirm" class="form-control" placeholder="Retapez votre mot de passe" required />
          <?php if ($validation->getError('password_confirm')): ?>
            <small style="color:var(--accent);font-size:0.78rem;margin-top:3px;"><?= $validation->getError('password_confirm') ?></small>
          <?php endif; ?>
        </div>
        
        <button type="submit" class="btn-primary-custom">Créer mon compte</button>
      <?= form_close() ?>

      <hr class="auth-divider" />
      <div class="auth-footer">Déjà inscrit ? <a href="<?= site_url('auth/login') ?>">Se connecter</a></div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>