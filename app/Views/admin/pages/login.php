<?= $this->extend('admin/layouts/auth') ?>

<?= $this->section('content') ?>
<div class="card mx-auto card-login">
    <div class="card-body">
        <h4 class="card-title mb-4">Login - Painel Administrativo</h4>
        
        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
        <?php endif; ?>
        
        <?php if (session()->has('message')) : ?>
            <div class="alert alert-success"><?= session('message') ?></div>
        <?php endif; ?>
        
        <form action="<?= base_url('admin/login') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <input class="form-control" placeholder="Email" type="email" name="email" required />
                <?php if (isset(session('errors')['email'])) : ?>
                    <div class="text-danger mt-1"><?= session('errors')['email'] ?></div>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <input class="form-control" placeholder="Senha" type="password" name="password" required />
                <?php if (isset(session('errors')['password'])) : ?>
                    <div class="text-danger mt-1"><?= session('errors')['password'] ?></div>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <label class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember" value="1" />
                    <span class="form-check-label">Lembrar-me</span>
                </label>
            </div>
            
            <div class="mb-4">
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?> 