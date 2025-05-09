<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Configurações da Loja</h2>
        <p>Configure as informações da sua loja online</p>
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
        
        <form action="<?= base_url('admin/settings/update') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-4">
                        <h5>Informações Gerais</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="store_name" class="form-label">Nome da Loja</label>
                                <input type="text" class="form-control" id="store_name" name="store_name" value="<?= $settings['store_name'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="store_description" class="form-label">Descrição da Loja</label>
                                <textarea class="form-control" id="store_description" name="store_description" rows="1"><?= $settings['store_description'] ?? '' ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="company_address" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="company_address" name="company_address" value="<?= $settings['company_address'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="company_phone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="company_phone" name="company_phone" value="<?= $settings['company_phone'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="company_email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="company_email" name="company_email" value="<?= $settings['company_email'] ?? '' ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <h5>Logotipo e Ícone</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="logo" class="form-label">Logo da Loja</label>
                                <?php if (isset($settings['logo']) && !empty($settings['logo'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url($settings['logo']) ?>" alt="Logo" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" id="logo" name="logo">
                                <small class="text-muted">Recomendado: 200x60px, PNG transparente</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="favicon" class="form-label">Favicon</label>
                                <?php if (isset($settings['favicon']) && !empty($settings['favicon'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url($settings['favicon']) ?>" alt="Favicon" class="img-thumbnail" style="max-height: 60px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" id="favicon" name="favicon">
                                <small class="text-muted">Recomendado: 32x32px, formato ICO, PNG</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <h5>Redes Sociais</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="facebook_link" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="facebook_link" name="facebook_link" value="<?= $settings['facebook_link'] ?? '' ?>" placeholder="URL do Facebook">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="instagram_link" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="instagram_link" name="instagram_link" value="<?= $settings['instagram_link'] ?? '' ?>" placeholder="URL do Instagram">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="twitter_link" class="form-label">Twitter</label>
                                <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="<?= $settings['twitter_link'] ?? '' ?>" placeholder="URL do Twitter">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="whatsapp_number" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" value="<?= $settings['whatsapp_number'] ?? '' ?>" placeholder="Ex: 5511999999999">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="whatsapp_message" class="form-label">Mensagem padrão do WhatsApp</label>
                                <textarea class="form-control" id="whatsapp_message" name="whatsapp_message" rows="2"><?= $settings['whatsapp_message'] ?? 'Olá! Estou interessado em seus produtos.' ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <h5>SEO e Metadados</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="meta_title" class="form-label">Título da Página (Meta Title)</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= $settings['meta_title'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="meta_description" class="form-label">Descrição da Página (Meta Description)</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="1"><?= $settings['meta_description'] ?? '' ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <h5>Moeda e Preços</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="currency_symbol" class="form-label">Símbolo da Moeda</label>
                                <input type="text" class="form-control" id="currency_symbol" name="currency_symbol" value="<?= $settings['currency_symbol'] ?? 'R$' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="currency_code" class="form-label">Código da Moeda</label>
                                <input type="text" class="form-control" id="currency_code" name="currency_code" value="<?= $settings['currency_code'] ?? 'BRL' ?>">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">Salvar Configurações</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?> 