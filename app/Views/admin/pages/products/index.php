<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Produtos</h2>
        <p>Gerencie todos os produtos da loja</p>
    </div>
    <div>
        <a href="<?= base_url('admin/products/create') ?>" class="btn btn-primary">
            <i class="material-icons md-plus"></i> Adicionar Produto
        </a>
    </div>
</div>

<?php if (session()->has('message')): ?>
    <div class="alert alert-success"><?= session('message') ?></div>
<?php endif; ?>

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
<?php endif; ?>

<div class="card mb-4">
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6 col-12 me-auto mb-md-0 mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar produto...">
                    <button class="btn btn-light" type="button"><i class="material-icons md-search"></i></button>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <select class="form-select" id="statusFilter">
                    <option value="all">Status - Todos</option>
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>
        </div>
    </header>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="productsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Preço Promocional</th>
                        <th>Status</th>
                        <th>Destaque</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
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
                                    <?= !empty($product['sale_price']) ? 'R$ ' . number_format($product['sale_price'], 2, ',', '.') : '-' ?>
                                </td>
                                <td>
                                    <span class="badge <?= $product['status'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $product['status'] ? 'Ativo' : 'Inativo' ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= $product['featured'] ? 'bg-info' : 'bg-light text-dark' ?>">
                                        <?= $product['featured'] ? 'Sim' : 'Não' ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm">
                                            <i class="material-icons md-more_horiz"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('admin/products/edit/' . $product['id']) ?>">
                                                <i class="material-icons md-edit"></i> Editar
                                            </a>
                                            <a class="dropdown-item text-danger" href="<?= base_url('admin/products/delete/' . $product['id']) ?>" 
                                               onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                                <i class="material-icons md-delete"></i> Excluir
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Nenhum produto cadastrado</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div> <!-- table-responsive end -->
    </div> <!-- card-body end -->
</div> <!-- card end -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Filtro por status
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value;
        const table = document.getElementById('productsTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const statusCell = rows[i].getElementsByTagName('td')[4];
            
            if (statusCell) {
                const statusText = statusCell.textContent.trim();
                
                if (status === 'all' || 
                   (status === '1' && statusText === 'Ativo') || 
                   (status === '0' && statusText === 'Inativo')) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });
    
    // Busca por nome do produto
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const table = document.getElementById('productsTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const nameCell = rows[i].getElementsByTagName('td')[1];
            
            if (nameCell) {
                const productName = nameCell.textContent.toLowerCase();
                
                if (productName.includes(searchText)) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });
</script>
<?= $this->endSection() ?> 