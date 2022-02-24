<?php 

  function proces_question_from_db($start=true, $question) {
    if($start) {
      return preg_split("/__/",$question)[0]; 
    } elseif(!$start) {  
      return preg_split("/__/",$question)[1]; 
    }
}

?>