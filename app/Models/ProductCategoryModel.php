<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table            = 'product_categories';
    protected $primaryKey       = 'product_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'category_id'];

    // Define a chave composta
    protected $uniqueKeys = [
        'product_category_pk' => ['product_id', 'category_id']
    ];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules = [
        'product_id'  => 'required|numeric',
        'category_id' => 'required|numeric',
    ];
    
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Método para associar um produto a várias categorias
    public function associateCategories($productId, $categoryIds)
    {
        // Primeiro, remover todas as associações existentes
        $this->where('product_id', $productId)->delete();
        
        // Inserir as novas associações
        $data = [];
        foreach ($categoryIds as $categoryId) {
            $data[] = [
                'product_id'  => $productId,
                'category_id' => $categoryId
            ];
        }
        
        if (!empty($data)) {
            return $this->insertBatch($data);
        }
        
        return true;
    }
    
    // Método para obter as categorias de um produto
    public function getProductCategories($productId)
    {
        return $this->select('category_id')
                   ->where('product_id', $productId)
                   ->findAll();
    }
}
