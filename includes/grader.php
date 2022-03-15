<?php

class Grader {

  public $percentage; 
  public $grade; 
  public $points;
  public $max_points; 

  function __construct($points, $max_points) {
    $this->max_points = $max_points; 
    $this->points     = $points; 
    $this->calculate_percentage(); 
    $this->grade(); 
  }

  private function calculate_percentage() {
    $this->percentage = round(($this->points/$this->max_points),2) * 100; 
  }

  private function grade() {
    $grade = null; 
    /*
    0	-	60 %	=	2
    61 - 70 %	=	3
    71 - 75 %	=	3,5
    76 - 85 %	=	4
    86 - 90 %	=	4,5
    91 - 100 %	=	5
    */ 
    $percent = $this->percentage; 
    switch($percent) {
      case ($percent < 61 ): 
        $grade = 2; 
        break; 
      case ($percent < 71 ): 
        $grade = 3; 
        break; 
      case ($percent < 76): 
        $grade = 3.5; 
        break; 
      case ($percent < 86):
        $grade = 4; 
        break;
      case ($percent < 91): 
        $grade = 4.5; 
        break;
      case ($percent < 101): 
        $grade = 5;
      default: 
        $grade = null;    
    }
    $this->grade = $grade; 
  }
}
?>