<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<section style="background:var(--surface);">
  <nav class="nav-public">
    <a href="#" class="brand">Fit<span>Space</span></a>
  </nav>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">Fit<span>Space</span></div>
      <div class="auth-subtitle">Bienvenue ! Connectez-vous à votre espace.</div>
      
      <?php if(session()->getFlashdata('error')): ?>
        <div class="flash-message flash-error"><i class="bi bi-exclamation-circle-fill"></i> <?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>
      <?php if(session()->getFlashdata('info')): ?>
        <div class="flash-message flash-info"><i class="bi bi-info-circle-fill"></i> <?= session()->getFlashdata('info') ?></div>
      <?php endif; ?>

      <?= form_open('auth/loginHandler') ?>
        <div class="mb-3">
          <label class="form-label">Adresse email</label>
          <input type="email" name="email" class="form-control" placeholder="votre@email.com" required />
        </div>
        <div class="mb-4">
          <label class="form-label">Mot de passe</label>
          <input type="password" name="password" class="form-control" placeholder="••••••••" required />
        </div>
        <button type="submit" class="btn-primary-custom">Se connecter</button>
      <?= form_close() ?>
      <hr class="auth-divider" />
      <div class="auth-footer">Pas encore de compte ? <a href="<?= base_url('auth/register') ?>">Créer un compte</a></div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>