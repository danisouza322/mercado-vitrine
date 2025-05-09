<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Meu Perfil</h2>
        <p>Gerencie suas informações pessoais</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form action="<?= base_url('admin/profile/update') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Foto do Perfil</h5>
                        </div>
                        <div class="card-body text-center">
                            <?php if (isset($user['photo']) && !empty($user['photo'])): ?>
                                <img src="<?= base_url($user['photo']) ?>" alt="Foto de Perfil" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            <?php else: ?>
                                <img src="<?= base_url('assets/admin/imgs/people/avatar-1.png') ?>" alt="Foto de Perfil" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <input type="file" class="form-control" id="photo" name="photo">
                                <small class="text-muted">Tamanho máximo: 2MB. Formatos: JPG, PNG</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Informações Pessoais</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <label for="name" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?? '' ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?? '' ?>" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Segurança</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <label for="password" class="form-label">Nova Senha</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Deixe em branco para manter a senha atual">
                                <small class="text-muted">Mínimo 6 caracteres</small>
                            </div>
                            <div class="mb-4">
                                <label for="password_confirm" class="form-label">Confirmar Nova Senha</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirme a nova senha">
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?> 