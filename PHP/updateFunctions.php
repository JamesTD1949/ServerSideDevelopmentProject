<?php
  function checkName($string){
    $characters=0;
    $spaces=0;
    $length = strlen($string);
    for($i=0;$i<$length;$i++)
    {
      global $characters;
      global $spaces;
      //https://www.php.net/manual/en/function.ctype-alpha.php
      if(ctype_alpha($string[$i]))
      {
        $characters++;
      }
      else if($string[$i]==' ')
      {
        $spaces++;
      } 
    }
    if((($characters + $spaces) == $length) && $spaces<=2)
    {
      return 1;
    }
    else{
      return 0;
    }
  }
  
  function checkPhone($number){
    $length = strlen($number);
    for($i=0;$i<$length;$i++)
    {
      if(!ctype_digit($number[$i]))
      {
         return 0;
      }
    }
    if($length!=10)
    {
      return 0;
    }
    return 1;
  }
  
  function checkEircode($eircode){
    $length = strlen($eircode);
    if($length!=8)
    {
      return 0;
    }
    else
    {
      for($i=0;$i<3;$i++)
      {
        if(!ctype_digit($eircode[$i]) && !ctype_alpha($eircode[$i]))
        {
           return 0;
        }
      }
      if($eircode[3]!=" ")
      {
        return 0;
      }
      for($i=4;$i<8;$i++)
      {
        if(!ctype_digit($eircode[$i]) && !ctype_alpha($eircode[$i]))
        {
           return 0;
        }
      }
      return 1;
    }
  }
  
  function checkEmail($email){
    $length = strlen($email);
    $atsymbol;
    
    for($i=1;$i<$length;$i++)
    {
        global $atsymbol;
        if($email[$i]=='@')
        {
           
           $atsymbol++;
        }
    }
    
    if($email[0]!='@' && $atsymbol==1)
    {
      if($email[$length-1]=='m' && $email[$length-2]=='o' && $email[$length-3]=='c' && $email[$length-4]=='.' && $length>4 && $email[$length-5]!='@')
      {
        return 1;
      }
    }
    else{
      return 0;
    }
    
  }
  
  function checkPassword($password){
      $length = strlen($password);
      $number;
      $letter;
      $special;
      if($length<6)
      {
        return 0;
      }
      for($i=0;$i<$length;$i++)
      {
           global $number;
           global $letter;
           global $special;
           
           if(ctype_digit($password[$i]))
           {
            $number++;
           }
           if(ctype_alpha($password[$i]))
           {
            $letter++;
           }
           if($password[$i]==' ')
           {
            return 0;
           }
           else{
            $special++;
           }
      }
      if($number>0 && $letter>0 && $special>0)
      {
        return 1;
      }
  }
?>