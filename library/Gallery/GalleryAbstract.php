<?php
/**
 * Created by PhpStorm.
 * User: katan-hgmhub
 * Date: 4/4/17
 * Time: 4:30 PM
 */

namespace library\Gallery;


class GalleryAbstract
{
    public $path,
           $slideImagesPath;

    public function __construct()
    {
        $this->path = 'resources/assets/images/slideshow';
    }

    public function setPath($path){

        // removes the trailing '/' on the image path
        if(substr($this->path, -1) === '/'){
            $path = substr($path, 0, -1);
        }

        //echo $this->path = $path;
    }

    private function getDirectory($path){
        return scandir($path);
    }

    public function getImages($extensions = array('jpg', 'jpeg', 'JPEG', 'png', 'gif')){

        $images = $this->getDirectory($this->path);

        foreach($images as $index => $image){

            $extension = explode('.', $image);
            $imageFile_ext = strtolower(end($extension));

            if(!in_array($imageFile_ext, $extensions)){
                unset($images[$index]);
            }else{
                $images[$index] = array(
                    'full' => $this->path . '/' . $image,
                    'thumb' => $this->path . '/thumb/' . $image
                );
            }
        }
        return (count($images)) ? $images : false;
    }

}