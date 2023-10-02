<?php
// Archivo: app/Controllers/Api.php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use CodeIgniter\RESTful\ResourceController;

class Api extends BaseController
{
    // Método para obtener todos los registros
    // public function index()
    // {
    //     $model = new VentasModel();
    //     $data = $model->findAll();
        
    //     return $this->response->setJSON(['status' => 'success', 'data' => $data]);
    // }

    // Método para obtener todos los registros con paginación
    // http://localhost/ci4-test-api/public/api/ventas?page=2
    public function index()
    {
        $model = new VentasModel();
    
        // Configuración de la paginación
        $page = $this->request->getVar('page') ?? 1; // Página actual, por defecto 1
        $perPage = 3; // Registros por página
    
        $data = [
            'status' => 'success',
            'data' => $model->paginate($perPage),
            'pager' => [
                'currentPage' => (int)$model->pager->getCurrentPage(),
                'perPage' => (int)$model->pager->getPerPage(),
                'total' => $model->pager->getTotal(),
                'lastPage' => $model->pager->getPageCount(),
            ],
        ];
    
        return $this->response->setJSON($data);
    }

    // Método para obtener un registro por ID
    public function show($id = null)
    {
        var_dump($id);
        $model = new VentasModel();
        $data = $model->find($id);

        if ($data === null) {
            return $this->failNotFound('No se encontró el registro con ID ' . $id);
        }

        return $this->response->setJSON(['status' => 'success', 'data' => $data]);
    }

    // Método para crear un nuevo registro
    public function create()
    {
        $model = new VentasModel();
        $data = $this->request->getPost();

        if ($model->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Registro creado exitosamente']);
        } else {
            return $this->failServerError('Error al crear el registro');
        }
    }

    // Método para actualizar un registro por ID
    public function update($id = null)
    {
        $model = new VentasModel();
        $data = $this->request->getRawInput();

        if ($model->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Registro actualizado exitosamente']);
        } else {
            return $this->failServerError('Error al actualizar el registro');
        }
    }

    // Método para eliminar un registro por ID
    public function delete($id = null)
    {
        $model = new VentasModel();

        if ($model->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Registro eliminado exitosamente']);
        } else {
            return $this->failServerError('Error al eliminar el registro');
        }
    }
}
