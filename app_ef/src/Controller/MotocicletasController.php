<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Motocicletas Controller
 *
 * @property \App\Model\Table\MotocicletasTable $Motocicletas
 */
class MotocicletasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Motocicletas->find();
        $motocicletas = $this->paginate($query);

        $this->set(compact('motocicletas'));
    }

    /**
     * View method
     *
     * @param string|null $id Motocicleta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $motocicleta = $this->Motocicletas->get($id, contain: []);
        $this->set(compact('motocicleta'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $motocicleta = $this->Motocicletas->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Procesar imagen
            $imagenFile = $this->request->getData('imagen');
            if ($imagenFile && $imagenFile->getError() === UPLOAD_ERR_OK) {
                $uploadDir = WWW_ROOT . 'img' . DS . 'motocicletas' . DS;
                
                // Crear directorio si no existe
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $filename = time() . '_' . $imagenFile->getClientFilename();
                $targetPath = $uploadDir . $filename;
                
                $imagenFile->moveTo($targetPath);
                $data['imagen'] = $filename;
            } else {
                $data['imagen'] = null;
            }
            
            $motocicleta = $this->Motocicletas->patchEntity($motocicleta, $data);
            if ($this->Motocicletas->save($motocicleta)) {
                $this->Flash->success(__('La motorcycles ha sido guardada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la motorcycles. Intenta de nuevo.'));
        }
        $this->set(compact('motocicleta'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Motocicleta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $motocicleta = $this->Motocicletas->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Procesar imagen
            $imagenFile = $this->request->getData('imagen');
            if ($imagenFile && $imagenFile->getError() === UPLOAD_ERR_OK) {
                $uploadDir = WWW_ROOT . 'img' . DS . 'motocicletas' . DS;
                
                // Crear directorio si no existe
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                // Eliminar imagen anterior si existe
                if ($motocicleta->imagen) {
                    $oldFile = $uploadDir . $motocicleta->imagen;
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
                
                $filename = time() . '_' . $imagenFile->getClientFilename();
                $targetPath = $uploadDir . $filename;
                
                $imagenFile->moveTo($targetPath);
                $data['imagen'] = $filename;
            } else {
                unset($data['imagen']);
            }
            
            $motocicleta = $this->Motocicletas->patchEntity($motocicleta, $data);
            if ($this->Motocicletas->save($motocicleta)) {
                $this->Flash->success(__('La motorcycles ha sido actualizada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo actualizar la motorcycles. Intenta de nuevo.'));
        }
        $this->set(compact('motocicleta'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Motocicleta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $motocicleta = $this->Motocicletas->get($id);
        
        // Eliminar imagen asociada
        if ($motocicleta->imagen) {
            $imagenFile = WWW_ROOT . 'img' . DS . 'motocicletas' . DS . $motocicleta->imagen;
            if (file_exists($imagenFile)) {
                unlink($imagenFile);
            }
        }
        
        if ($this->Motocicletas->delete($motocicleta)) {
            $this->Flash->success(__('La motorcycles ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la motorcycles. Intenta de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}