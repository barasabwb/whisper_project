<?php 
  class BaseController
  {

      //LOAD VIEWS
      public function load_view($view,$meta=null, $data=null){
        if($meta!==null){
          $meta= (object)$meta;
        }
        if($data!==null){
          $data= (object)$data;
        }
        require_once BASE.'views/inc/header.php';
        require_once BASE.'views/inc/navigation_bar.php';
        require_once BASE.'views/'.$view.'.php';
        require_once BASE.'views/inc/modals.php';
        require_once BASE.'views/inc/footer.php';
      }

//      LOAD DB MODELS
      public function load_model($model){
        require_once BASE.'models/'.$model.'_model.php';
        $model = ucfirst($model).'Model';
        return new $model();
      }

//      REDIRECT
      public function redirect($url){
        $url= ROOT.$url;
        header("Location: $url");
        die();
      }

      //PARSE {{ELEMENT}}
      public function parse_body_tags($body, $array){
        $repl = preg_replace_callback('/{{([^}]+)}}/', function ($m) use ($array) {
          return $array[$m[1]]; }, $body);
        return $repl;
      }

      //VALIDATE POST DATA
      public function validatePost(){
          if($_SERVER['REQUEST_METHOD']=='POST'){
              return true;
          }
          header('HTTP/1.1 404 Not Found');
          die('Not a Valid Request');
      }

  }


