<?php
namespace App\Dtos;

class Color
{
  public $code;
  public $value;
   
  public function set_content($code)
  {
    return $this->code;
  }
 
  public function set_content($value)
  {
    return $this->value;
  }
 
}
?>