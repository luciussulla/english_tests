<?php 
 class Obj {
   public $a = ""; 

  public function func1() {
    $this->a = "lbabla"; 
  }

 }

 $new_obj = new Obj();
 $new_obj->func1(); 
 echo $new_obj->a;  
?> 

<div>

</div>