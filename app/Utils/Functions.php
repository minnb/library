<?php
function print_result($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function getImageInContent($content){
	$first_img = '';
	ob_start();
	ob_end_clean();
  if(strlen($content) > 0){
    $output = preg_match_all('/.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
    $first_img = $matches [1] [0];
  }else{
    $first_img = '';
  }
	
	if(empty($first_img)){
    $first_img = "/images/default.jpg";
	}
	
	if (strlen(strstr($first_img, "youtube")) > 0) {
		return "http://i.ytimg.com/vi/".substr($first_img,30)."/0.jpg";
	}
  else
  {
		return $first_img;
	}

}

function fdecrypt($string) {
    $key ='01234567890795879133';
    $result = '';
    $string = base64_decode($string);
    for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
    }
    return $result;
}

function fencrypt($string) {
    $key ='01234567890795879133';
    $result = '';
    for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
    }
    return base64_encode($result);
}

function menuMulti ($data, $parent_id = 0, $str="---|", $select = 0) {
  foreach ($data as $val) {
    $id = $val->id;
    $name = $val->name;
    if ($val->parent == $parent_id) {
      if ($select != 0 && $id == $select) {
        echo '<option value="'.$id.'" selected>'.$str." ".$name.'</option>';
      } else {
        echo '<option value="'.$id.'" >'.$str." ".$name.'</option>';
      }
      $space ="---";
      menuMulti ($data, $id, $space." ---|",$select);
    }
  }
}

//use for array
function selectedOption($array, $select){
  foreach($array as $key=>$value){
    if($key == $select && $select != '' ){
        echo '<option value="'.$key.'" selected>'.$value.' </option>';
    }else{
        echo '<option value="'.$key.'">'.$value.'</option>';
    }
  }
}
//use for get from Models
function getSelectForm($data, $select = 0){
  foreach($data as $value){
    $id = $value->id;
    $name = $value->name;
    if($id == $select && $select != ''){
      echo '<option  value="'.$id.'" selected>'.$name.' </option>';
    }else{
      echo '<option  value="'.$id.'">'.$name.'</option>';
    }
  }
}
function getSelectArrayForm($data, $select){
  foreach($data as $value){
    $id = $value->id;
    $name = $value->name;
    if($select != null){
      foreach($select as $item){
        if($id == $item){
          echo '<option  value="'.$id.'" selected>'.$name.' </option>';
        }else{
          echo '<option  value="'.$id.'">'.$name.'</option>';
        }
      }
    }
  }
}


function path_storage($name)
{
  $path_server = 'storage/'.$name;
  $str = date("Ym");
  $path = $path_server.'/'.$str;
  if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
  return $path;
}

function getImage($link){
  $path = '/admin/images/no_image.png';
  return File::exists($link) ? $link : $path;
}

function getImgDefault(){
  return 'public/dashboard/images/no-image.png';
}

function delete_image_by_path($image, $path){
  $img = $path.'/'.$image;
  if(File::exists($img)){
      File::delete($img);
  }
}
function delete_image_no_path($img){
  if(File::exists($img)){
    File::delete($img);
  }
}


include('Const.php');
include('FunStr.php');
include('FunsCss.php');