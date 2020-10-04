<?php
  function nameCheck($name)
  {
    $length = strlen($name);
    
    if($length<3)
    {
      return 0;
    }
    
    for($i=0;$i<$length;$i++)
    {
      if(!ctype_alpha($name[$i]))
      {
       return 0;
      }
    }
    return 1;
  }

?>