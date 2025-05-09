<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Categorias</h2>
        <p>Gerencie todas as categorias da loja</p>
    </div>
    <div>
        <a href="<?= base_url('admin/categories/create') ?>" class="btn btn-primary">
            <i class="material-icons md-plus"></i> Adicionar Categoria
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
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar categoria...">
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
            <table class="table table-hover" id="categoriesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Categoria</th>
                        <th>Categoria Pai</th>
                        <th>Status</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= $category['id'] ?></td>
                                <td>
                                    <div class="d-flex">
                                        <?php 
                                        $imagePath = !empty($category['image']) ? $category['image'] : 'assets/admin/imgs/theme/no-image.png';
                                        ?>
                                        <img src="<?= base_url($imagePath) ?>" class="img-sm img-thumbnail" alt="<?= $category['name'] ?>">
                                        <div class="info ms-3">
                                            <h6 class="mb-0"><?= $category['name'] ?></h6>
                                            <small class="text-muted"><?= !empty($category['description']) ? substr($category['description'], 0, 50) . '...' : '-' ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $categoryModel = new \App\Models\CategoryModel();
                                    $parentName = '-';
                                    if (!empty($category['parent_id'])) {
                                        $parent = $categoryModel->find($category['parent_id']);
                                        if ($parent) {
                                            $parentName = $parent['name'];
                                        }
                                    }
                                    echo $parentName;
                                    ?>
                                </td>
                                <td>
                                    <span class="badge <?= $category['status'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $category['status'] ? 'Ativo' : 'Inativo' ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm">
                                            <i class="material-icons md-more_horiz"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?= base_url('admin/categories/edit/' . $category['id']) ?>">
                                                <i class="material-icons md-edit"></i> Editar
                                            </a>
                                            <a class="dropdown-item text-danger" href="<?= base_url('admin/categories/delete/' . $category['id']) ?>" 
                                               onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                                <i class="material-icons md-delete"></i> Excluir
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhuma categoria cadastrada</td>
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
        const table = document.getElementById('categoriesTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const statusCell = rows[i].getElementsByTagName('td')[3];
            
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
    
    // Busca por nome da categoria
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const table = document.getElementById('categoriesTable');
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const nameCell = rows[i].getElementsByTagName('td')[1];
            
            if (nameCell) {
                const categoryName = nameCell.textContent.toLowerCase();
                
                if (categoryName.includes(searchText)) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    });
</script>
<?= $this->endSection() ?> 