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
                                <label for="shop_name" class="form-label">Nome da Loja</label>
                                <input type="text" class="form-control" id="shop_name" name="shop_name" value="<?= $settings['shop_name'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="shop_description" class="form-label">Descrição da Loja</label>
                                <textarea class="form-control" id="shop_description" name="shop_description" rows="1"><?= $settings['shop_description'] ?? '' ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="shop_address" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="shop_address" name="shop_address" value="<?= $settings['shop_address'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="shop_phone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="shop_phone" name="shop_phone" value="<?= $settings['shop_phone'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label for="shop_email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="shop_email" name="shop_email" value="<?= $settings['shop_email'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="shop_city" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="shop_city" name="shop_city" value="<?= $settings['shop_city'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="shop_state" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="shop_state" name="shop_state" value="<?= $settings['shop_state'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="shop_zip" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="shop_zip" name="shop_zip" value="<?= $settings['shop_zip'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="shop_country" class="form-label">País</label>
                                <input type="text" class="form-control" id="shop_country" name="shop_country" value="<?= $settings['shop_country'] ?? 'Brasil' ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <h5>Logotipo e Ícone</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="shop_logo" class="form-label">Logo da Loja</label>
                                <?php if (isset($settings['shop_logo']) && !empty($settings['shop_logo'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url($settings['shop_logo']) ?>" alt="Logo" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" id="shop_logo" name="shop_logo">
                                <small class="text-muted">Recomendado: 200x60px, PNG transparente</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="shop_favicon" class="form-label">Favicon</label>
                                <?php if (isset($settings['shop_favicon']) && !empty($settings['shop_favicon'])): ?>
                                    <div class="mb-2">
                                        <img src="<?= base_url($settings['shop_favicon']) ?>" alt="Favicon" class="img-thumbnail" style="max-height: 60px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" class="form-control" id="shop_favicon" name="shop_favicon">
                                <small class="text-muted">Recomendado: 32x32px, formato ICO, PNG</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <h5>Contato e WhatsApp</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="shop_whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="shop_whatsapp" name="shop_whatsapp" value="<?= $settings['shop_whatsapp'] ?? '' ?>" placeholder="Ex: 5511999999999">
                                <small class="text-muted">Formato internacional com código do país (Ex: 5511999999999)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="whatsapp_default_message" class="form-label">Mensagem padrão do WhatsApp</label>
                                <textarea class="form-control" id="whatsapp_default_message" name="whatsapp_default_message" rows="2"><?= $settings['whatsapp_default_message'] ?? 'Olá! Estou interessado no produto:' ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <h5>Redes Sociais</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="shop_facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="shop_facebook" name="shop_facebook" value="<?= $settings['shop_facebook'] ?? '' ?>" placeholder="URL do Facebook">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="shop_instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="shop_instagram" name="shop_instagram" value="<?= $settings['shop_instagram'] ?? '' ?>" placeholder="URL do Instagram">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="shop_twitter" class="form-label">Twitter</label>
                                <input type="text" class="form-control" id="shop_twitter" name="shop_twitter" value="<?= $settings['shop_twitter'] ?? '' ?>" placeholder="URL do Twitter">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-4">
                                <label for="shop_youtube" class="form-label">YouTube</label>
                                <input type="text" class="form-control" id="shop_youtube" name="shop_youtube" value="<?= $settings['shop_youtube'] ?? '' ?>" placeholder="URL do YouTube">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <h5>Moeda e Preços</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="shop_currency_symbol" class="form-label">Símbolo da Moeda</label>
                                <input type="text" class="form-control" id="shop_currency_symbol" name="shop_currency_symbol" value="<?= $settings['shop_currency_symbol'] ?? 'R$' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="shop_currency" class="form-label">Código da Moeda</label>
                                <input type="text" class="form-control" id="shop_currency" name="shop_currency" value="<?= $settings['shop_currency'] ?? 'BRL' ?>">
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