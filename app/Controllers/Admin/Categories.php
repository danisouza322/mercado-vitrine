<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ProductCategoryModel;

class Categories extends BaseController
{
    protected $categoryModel;
    protected $productCategoryModel;
    
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productCategoryModel = new ProductCategoryModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Gerenciar Categorias - Painel Admin',
            'description' => 'Lista e gerenciamento de categorias',
            'categories' => $this->categoryModel->findAll()
        ];
        
        return view('admin/pages/categories/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Adicionar Categoria - Painel Admin',
            'description' => 'Formulário para adicionar uma nova categoria',
            'categories' => $this->categoryModel->findAll(), // Para selecionar categoria pai
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/pages/categories/create', $data);
    }
    
    public function store()
    {
        // Regras de validação
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Preparar dados da categoria
        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
            'description' => $this->request->getPost('description'),
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'status' => $this->request->getPost('status') ? 1 : 0,
        ];
        
        // Upload de imagem se existir
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/categories', $newName);
            $data['image'] = 'uploads/categories/' . $newName;
        }
        
        // Inserir categoria no banco
        $this->categoryModel->insert($data);
        
        return redirect()->to('admin/categories')
            ->with('message', 'Categoria adicionada com sucesso');
    }
    
    public function edit($id)
    {
        $category = $this->categoryModel->find($id);
        
        if (!$category) {
            return redirect()->to('admin/categories')
                ->with('error', 'Categoria não encontrada');
        }
        
        // Buscar todas as categorias exceto a atual (para evitar referência circular)
        $categories = $this->categoryModel->where('id !=', $id)->findAll();
        
        $data = [
            'title' => 'Editar Categoria - Painel Admin',
            'description' => 'Formulário para editar uma categoria existente',
            'category' => $category,
            'categories' => $categories,
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/pages/categories/edit', $data);
    }
    
    public function update($id)
    {
        // Regras de validação
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'permit_empty'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Verificar se a categoria existe
        $category = $this->categoryModel->find($id);
        
        if (!$category) {
            return redirect()->to('admin/categories')
                ->with('error', 'Categoria não encontrada');
        }
        
        // Verificar se está tentando definir como pai uma categoria filha
        $parentId = $this->request->getPost('parent_id');
        if ($parentId && $this->isCategoryChild($id, $parentId)) {
            return redirect()->back()->withInput()
                ->with('error', 'Não é possível definir uma categoria filha como pai');
        }
        
        // Preparar dados da categoria
        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => url_title($this->request->getPost('name'), '-', true),
            'description' => $this->request->getPost('description'),
            'parent_id' => $parentId ?: null,
            'status' => $this->request->getPost('status') ? 1 : 0,
        ];
        
        // Upload de nova imagem se existir
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Remover imagem antiga
            if (!empty($category['image'])) {
                $filePath = ROOTPATH . 'public/' . $category['image'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/categories', $newName);
            $data['image'] = 'uploads/categories/' . $newName;
        }
        
        // Atualizar categoria no banco
        $this->categoryModel->update($id, $data);
        
        return redirect()->to('admin/categories')
            ->with('message', 'Categoria atualizada com sucesso');
    }
    
    public function delete($id)
    {
        // Verificar se a categoria existe
        $category = $this->categoryModel->find($id);
        
        if (!$category) {
            return redirect()->to('admin/categories')
                ->with('error', 'Categoria não encontrada');
        }
        
        // Verificar se há produtos associados a esta categoria
        $productsCount = $this->productCategoryModel->where('category_id', $id)->countAllResults();
        
        if ($productsCount > 0) {
            return redirect()->to('admin/categories')
                ->with('error', 'Esta categoria não pode ser excluída pois possui produtos associados');
        }
        
        // Verificar se há categorias filhas
        $childCategories = $this->categoryModel->where('parent_id', $id)->countAllResults();
        
        if ($childCategories > 0) {
            return redirect()->to('admin/categories')
                ->with('error', 'Esta categoria não pode ser excluída pois possui categorias filhas');
        }
        
        // Remover imagem da categoria
        if (!empty($category['image'])) {
            $filePath = ROOTPATH . 'public/' . $category['image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        // Remover categoria
        $this->categoryModel->delete($id);
        
        return redirect()->to('admin/categories')
            ->with('message', 'Categoria excluída com sucesso');
    }
    
    // Método auxiliar para verificar se uma categoria é filha de outra
    private function isCategoryChild($categoryId, $possibleChildId)
    {
        // Obter todas as categorias filhas diretas
        $children = $this->categoryModel->where('parent_id', $categoryId)->findAll();
        
        foreach ($children as $child) {
            // Verificar se é o filho que estamos procurando
            if ($child['id'] == $possibleChildId) {
                return true;
            }
            
            // Verificar recursivamente os filhos deste filho
            if ($this->isCategoryChild($child['id'], $possibleChildId)) {
                return true;
            }
        }
        
        return false;
    }
} 