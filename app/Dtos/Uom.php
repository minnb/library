<?php
namespace App\Dtos;

class Uom
{
  public $code;
  public $qtty_of_uom;
  public $length;
  public $width;
  public $height;
  public $cubage;
  public $weight;
  
  public function set_content($code)
  {
    return $this->code = $code;
  }
 
  public function set_content($code)
  {
    return $this->qtty_of_uom = $code;
  }
 
  public function set_content($code)
  {
    return $this->length = $code;
  }
  
  public function set_content($code)
  {
    return $this->width = $code;
  }
  
  public function set_content($code)
  {
    return $this->height = $code;
  }
  
  public function set_content($code)
  {
    return $this->cubage = $code;
  }

  public function set_content($code)
  {
    return $this->weight = $code;
  }
}
?>