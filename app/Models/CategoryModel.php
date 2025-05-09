<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'slug', 'description', 'parent_id', 'image', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    protected $validationRules = [
        'name'     => 'required|min_length[3]|max_length[100]',
        'slug'     => 'permit_empty|is_unique[categories.slug,id,{id}]',
        'status'   => 'required|in_list[0,1]',
    ];
    
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Método para criar slug automaticamente
    protected function beforeInsert(array $data)
    {
        if (empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        if (empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        
        return $data;
    }
    
    // Método para obter hierarquia de categorias
    public function getHierarchy()
    {
        $categories = $this->where('parent_id', null)
                           ->where('status', 1)
                           ->findAll();
                           
        foreach ($categories as &$category) {
            $category['children'] = $this->getChildren($category['id']);
        }
        
        return $categories;
    }
    
    private function getChildren($parentId)
    {
        $children = $this->where('parent_id', $parentId)
                         ->where('status', 1)
                         ->findAll();
                         
        foreach ($children as &$child) {
            $child['children'] = $this->getChildren($child['id']);
        }
        
        return $children;
    }
}
