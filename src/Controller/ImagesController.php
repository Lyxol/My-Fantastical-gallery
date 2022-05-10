<?php

namespace App\Controller;

use Exception;

class ImagesController extends AppController
{
    private function exif_Traitement($path)
    {
        $exif = exif_read_data('img/' . $path);
        $data = [];
        $data['fold$folder'] = $exif['FileName'];
        $data['description'] = $exif['ImageDescription'] ?? 'Aucune description';
        $data['comment'] = $exif['UserComment'] ?? 'No-comment';
        $data['author'] = $exif['Make'] ?? 'Inconnu';
        $data['width'] = $exif['COMPUTED']['Width'];
        $data['height'] = $exif['COMPUTED']['Height'];
        $data['html'] = $exif['COMPUTED']['html'];

        return $data;
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['add','home']);
    }

    public function json()
    {

        $json = $this->Images
            ->find()
            ->toArray();

        return $this->response
            ->withStringBody(json_encode($json))
            ->withType("application/json");
    }

    public function oembedTarget($id)
    {
        $picturesPath = json_decode(
            json_encode(
                $this->Images
                    ->find()
                    ->select('path')
                    ->where(['path' => 'jpg/' . $id])
            ),
            1
        );
        if (empty($picturesPath)) {
            throw new Exception(400);
        }
        return $this->response
            ->withStringBody(json_encode(
                $this->exif_Traitement($picturesPath[0]['path'])
            ))
            ->withType('application/json');
    }

    public function oembed()
    {
        $name = $this->request->getQuery('name');
        if (isset($name)) {
            $images = json_decode(
                json_encode(
                    $this->Images
                        ->find()
                        ->select('path')
                        ->where(['path' => 'jpg/' . $name])
                ),
                1
            );
            $result[] = $this->exif_Traitement($images[0]['path']);
        } else {
            $limit = $this->request->getQuery('limit');
            $images = json_decode(
                json_encode(
                    $this->Images
                        ->find()
                        ->select('path')
                ),
                1
            );
            if ($limit == null) {
                $limit = count($images);
            }
            for ($i = 0; $i < $limit; $i++) {
                $result[] = $this->exif_Traitement($images[$i]['path']);
            }
        }
        return $this->response
            ->withStringBody(json_encode($result))
            ->withType('application/json');
    }

    public function home()
    {
        $param = $this->request->getParam('pass');

        if (empty($param)) {
            $images = json_decode(
                json_encode($this->Images
                    ->find()
                    ->select('path')
                    ->toArray()),
                1
            );
        } else {
            $targetPath = 'jpg/' . $param[0];
            $images = json_decode(
                json_encode(
                    $this->Images
                        ->find()
                        ->where(['path' => $targetPath])
                        ->toArray()
                ),
                1
            );
        }
        $this->set(compact('images'));
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $img = $this->request->getData('upload');
            $name = $img->getClientFilename();
            $media = $img->getClientMediaType();
            $err = $img->getError();

            if (!empty($name) && !empty($media) && $err == 0) {
                if (empty($this->Images
                    ->find()
                    ->where(['path' => 'jpg/' . $name])
                    ->toArray())) {
                    $this->Flash->set("The image has been send");
                    $folderPath = "./img/jpg/" . $name;
                    $img->moveTo($folderPath);

                    $exif = $this->exif_Traitement('jpg/' . $name);
                    $newImage = $this->Images->newEmptyEntity();
                    $newImage->id = 0;
                    $newImage->path = "jpg/".$name;
                    if($this->request->getData('description') == null){
                        $newImage->description = 'Aucune description';
                    }else{
                        $newImage->description = $this->request->getData('description');
                    }
                    
                    $newImage->width = $exif['width'];
                    $newImage->height = $exif['height'];
                    $newImage->author = $exif['author'];
                    $this->Images->save($newImage);
                } else {
                    $this->Flash->set("The image already exist");
                }
            } else {
                $this->Flash->set("No image have been send");
            }
        }
    }

    public function connexion()
    {
        
    }

    public function inscription()
    {

    }
}
