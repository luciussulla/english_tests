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
    // echo "|".$this->percentage."|"; 
  }

  private function grade() {
    /*
    0	-	60 %	=	2
    61 - 70 %	=	3
    71 - 75 %	=	3,5
    76 - 85 %	=	4
    86 - 90 %	=	4,5
    91 - 100 %	=	5
    */ 

    $percent = (int)$this->percentage;  

    if((int)$percent < 61) {
      $grade = 2; 
    } 
    else if ($percent< 71) {
      $grade = 3; 
    } 
    else if ($percent < 76) {
      $grade = 3.5; 
    } 
    else if ($percent < 86) {
      $grade = 4; 
    }
    else if ($perent < 91) {
      $grade = 4.5; 
    }
    else if ($percent < 101) {
      $grade = 5; 
    }
  }
  
  public function result_html() {
    $html = ""; 
    $html .=  "<div class=\"result_tab\"/>"; 
    $html .= "<p class=\"score\"> You have scored: " . $this->points . " points out of  " . $this->max_points . "</p>";   
    $html .= "<p class=\"score\"> Your grade is: " . $this->grade . "</p>"; 
    $html .= "</> "; 

    return $html;  
  }

}
?>