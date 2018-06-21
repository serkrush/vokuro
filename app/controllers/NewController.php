<?php
namespace Vokuro\Controllers;

//use Vokuro\Models\Shops;
use Vokuro\Models\Avatar;
use Vokuro\Models\Users;

/**
 * View and define permissions for the various profile levels.
 */
class NewController extends ControllerBase
{
    public function initialize()
    {
        $this->view->setTemplateBefore('private');
    }

    /**
     * View the permissions for a profile level, and change them if we have a POST.
     */
    public function indexAction()
    {

      if (!$this->request->isAjax()) {
        $this->css(["dropzone.css"]);
        $this->js(["dropzone.js"]);
        $this->js(["bootstrap-typehead.js","loadFile.js"]);
      } else {
        if( isset( $_POST['my_file_upload'] ) ){
          // ВАЖНО! тут должны быть все проверки безопасности передавемых файлов и вывести ошибки если нужно

          $uploaddir = './files'; // . - текущая папка где находится submit.php

          // cоздадим папку если её нет
          if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

          $files      = $_FILES; // полученные файлы
          $done_files = array();

          // переместим файлы из временной директории в указанную
          foreach( $files as $file ){
            $file_name = $file['name'];

            if( move_uploaded_file( $file['tmp_name'], "$uploaddir/$file_name" ) ){
              $done_files[] = realpath( "$uploaddir/$file_name" );
            }
          }

          $data = $done_files ? array('files' => $done_files ) : array('error' => 'Ошибка загрузки файлов.');
          $q=$this->request->getPost('nameavatar', 'striptags');
          $w=$this->request->getPost('iduser', 'striptags');
          $avatar = new Avatar([
            'nameavatar' => $data[files][0],
            'iduser' => $w
          ]);

          $avatar->save();
          die( json_encode( $data ) );
        }
      }
    }

    public function uploadAction()
    {
        #check if there is any file
        if($this->request->hasFiles() == true){
            $uploads = $this->request->getUploadedFiles();
            $isUploaded = false;
            #do a loop to handle each file individually
            foreach($uploads as $upload){
                #define a “unique” name and a path to where our file must go
                $path = 'files/'.strtolower($upload->getname());
                #move the file and simultaneously check if everything was ok
                ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
            }
            #if any file couldn’t be moved, then throw an message
            ($isUploaded) ? die('Files successfully uploaded.') : die('Some error ocurred.');
        }else{
            #if no files were sent, throw a message warning user
            die('You must choose at least one file to send. Please try again.');
        }


//         if($this->request->hasFiles() !== false) {
//
//             // get uploader service
//             $uploader = $this->di->get('uploader');
//
//             // setting up uloader rules
//             $uploader->setRules([
//                 'directory' =>  '/files',
//                 //or 'dynamic'   =>  '/files/'.$part.'/'.$userId, // added v1.4-beta
//             ]);
//
//             // or use constructor if you don't use service
////             $uploader = new \Uploader\Uploader(([
////                 'directory' =>  '/files',
////                 //or 'dynamic'   =>  '/files/'.$part.'/'.$userId, // added v1.4-beta
////             ]);
//
//         }
    }

    public function typeheadAction() {
    $result = array();
    if ($this->request->isAjax()) {

//      $vShop = Shops::findFirstByIdshop($post[idshop]);
      $name = $this->request->getPost('name', 'string');
//      $name = $this->request->getPost();
      $localities = Users::findByName($name);
      $result["name"] = array();
      if ($localities->count() > 0) {
        foreach ($localities as $item) {
          $result["name"][$item->getName()] = array(
            "id" => $item->getId(),
            "typehead" => $item->getName(),
            "displayname" => $item->getName()
          );
        }
      }
    }
    $this->result($result);
  }
}
