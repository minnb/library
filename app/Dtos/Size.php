<?php
namespace App\Dtos;

class Size
{
  public $code;
  public $value;
   
  public function set_content($code )
  {
      $this->code = $code;
  }
  public function set_content($value )
  {
      $this->value = $value;
  }
 
}
?>