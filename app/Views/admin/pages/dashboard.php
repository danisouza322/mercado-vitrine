<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Dashboard</h2>
        <p>Visão geral da sua loja online</p>
    </div>
    <div>
        <a href="<?= base_url('admin/products/create') ?>" class="btn btn-primary"><i class="material-icons md-post_add"></i>Adicionar Produto</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-shopping_bag"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total de Produtos</h6>
                    <span><?= $totalProducts ?></span>
                    <span class="text-sm">Todos os produtos cadastrados</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success material-icons md-local_offer"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Produtos Ativos</h6>
                    <span><?= $activeProducts ?></span>
                    <span class="text-sm">Produtos visíveis na loja</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-star"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Em Destaque</h6>
                    <span><?= $featuredProducts ?></span>
                    <span class="text-sm">Produtos marcados como destaque</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-category"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Categorias</h6>
                    <span><?= $totalCategories ?></span>
                    <span class="text-sm">Total de categorias cadastradas</span>
                </div>
            </article>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <header class="card-header">
                <h4 class="card-title">Produtos Recentes</h4>
            </header>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentProducts)): ?>
                                <?php foreach ($recentProducts as $product): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <?php 
                                                $productModel = new \App\Models\ProductModel();
                                                $image = $productModel->getProductFirstImage($product['id']);
                                                $imagePath = !empty($image) ? $image['image'] : 'assets/admin/imgs/theme/no-image.png';
                                                ?>
                                                <img src="<?= base_url($imagePath) ?>" class="img-sm img-thumbnail" alt="<?= $product['name'] ?>">
                                                <div class="info ms-3">
                                                    <h6 class="mb-0"><?= $product['name'] ?></h6>
                                                    <small class="text-muted">SKU: <?= $product['sku'] ?: '-' ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>R$ <?= number_format($product['price'], 2, ',', '.') ?></td>
                                        <td>
                                            <span class="badge <?= $product['status'] ? 'bg-success' : 'bg-secondary' ?>">
                                                <?= $product['status'] ? 'Ativo' : 'Inativo' ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($product['created_at'])) ?></td>
                                        <td class="text-end">
                                            <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="btn btn-sm btn-light">
                                                <i class="material-icons md-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum produto cadastrado</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="<?= base_url('admin/products') ?>" class="btn btn-light">Ver Todos os Produtos <i class="material-icons md-arrow_forward"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card mb-4">
            <header class="card-header">
                <h4 class="card-title">Ações Rápidas</h4>
            </header>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="<?= base_url('admin/products/create') ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 align-items-center">
                            <span class="icon icon-sm rounded-circle bg-primary-light me-3">
                                <i class="text-primary material-icons md-add"></i>
                            </span>
                            <div>
                                <h6 class="mb-0">Adicionar Produto</h6>
                                <small class="text-muted">Cadastrar um novo produto na loja</small>
                            </div>
                        </div>
                    </a>
                    <a href="<?= base_url('admin/categories/create') ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 align-items-center">
                            <span class="icon icon-sm rounded-circle bg-success-light me-3">
                                <i class="text-success material-icons md-add"></i>
                            </span>
                            <div>
                                <h6 class="mb-0">Adicionar Categoria</h6>
                                <small class="text-muted">Cadastrar uma nova categoria de produtos</small>
                            </div>
                        </div>
                    </a>
                    <a href="<?= base_url('admin/products') ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 align-items-center">
                            <span class="icon icon-sm rounded-circle bg-warning-light me-3">
                                <i class="text-warning material-icons md-edit"></i>
                            </span>
                            <div>
                                <h6 class="mb-0">Gerenciar Produtos</h6>
                                <small class="text-muted">Editar ou excluir produtos existentes</small>
                            </div>
                        </div>
                    </a>
                    <a href="<?= base_url('admin/categories') ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 align-items-center">
                            <span class="icon icon-sm rounded-circle bg-info-light me-3">
                                <i class="text-info material-icons md-edit"></i>
                            </span>
                            <div>
                                <h6 class="mb-0">Gerenciar Categorias</h6>
                                <small class="text-muted">Editar ou excluir categorias existentes</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <header class="card-header">
                <h4 class="card-title">Dicas Rápidas</h4>
            </header>
            <div class="card-body">
                <div class="alert alert-info p-3">
                    <h6 class="mb-2"><i class="material-icons md-info me-1"></i> Produtos em Destaque</h6>
                    <p class="mb-0 small">Os produtos marcados como "Destaque" aparecerão em seções especiais da loja, aumentando sua visibilidade.</p>
                </div>
                <div class="alert alert-warning p-3">
                    <h6 class="mb-2"><i class="material-icons md-lightbulb me-1"></i> Categorias Hierárquicas</h6>
                    <p class="mb-0 small">Você pode criar uma hierarquia de categorias selecionando uma "Categoria Pai" ao cadastrar uma nova categoria.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Scripts específicos para o dashboard
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Dashboard carregado com sucesso!');
    });
</script>
<?= $this->endSection() ?> 