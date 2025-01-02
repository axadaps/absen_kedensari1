<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends BaseModel
{
   protected $builder;

   public function __construct()
   {
      parent::__construct();
      $this->builder = $this->db->table('tb_kelas');
   }

   //input values
   public function inputValues()
   {
      return [
         'kelas' => inputPost('kelas'),
      ];
   }

   public function addKelas()
   {
      $data = $this->inputValues();
      return $this->builder->insert($data);
   }

   public function editKelas($id)
   {
      $kelas = $this->getKelas($id);
      if (!empty($kelas)) {
         $data = $this->inputValues();
         return $this->builder->where('id_kelas', $kelas->id_kelas)->update($data);
      }
      return false;
   }

   public function getDataKelas()
   {
      return $this->builder->orderBy('id_kelas')->get()->getResult('array');
   }

   public function getKelas($id)
   {
      return $this->builder->where('id_kelas', cleanNumber($id))->get()->getRow();
   }

   public  function getCategoryTree($categoryId, $categories)
   {
      $tree = array();
      $categoryId = cleanNumber($categoryId);
      if (!empty($categoryId)) {
         array_push($tree, $categoryId);
      }
      return $tree;
   }

   public function deleteKelas($id)
   {
      $kelas = $this->getKelas($id);
      if (!empty($kelas)) {
         return $this->builder->where('id_kelas', $kelas->id_kelas)->delete();
      }
      return false;
   }

   public function getAllKelas()
   {
      return $this->join('tb_kelas', 'left')->findAll();
   }
}
