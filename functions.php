<?php
function clean($X)
{
  //fixes strings with ' " \ in them to be processable by php correctly
  if (strpos($X,"'")!=-1 && ord( $X[strpos($X,"'")-1] )!= 92) 
  {
   
    for ($i=0; $i < strlen($X); $i++)
    { 
      if ($X[$i]=="'")
      {
        $X=substr($X,0,$i)."\'".substr($X,$i+1,strlen($X));
        $i++;
      }
      elseif($X[$i]=='"')
      {
        $i++;
        $X=substr($X,0,$i).'\"'.substr($X,$i+1,strlen($X));
      }
    }

    return $X;
  }

}

function email_check($email)
{
  //check if email exists
  if (true)
  {
    return true;
  }
  else
  {
    false;
  }
}
//used for date calculation
function date_calc($date1,$date2,$return)
{

  //calculates difference between two dates and returns result 
  /*
    $return value
   a returns all
   d returns days 
   m returns months
   y retuns years
   */
  $differnce=date("y-m-d");
  $differnce= $date1->diff($date2);
  switch ($return) {
    case 'a':
      return $differnce;
      
    case 'd':
      return $differnce->d;
      
    case'm':
      return $differnce->m;
      
    case 'y':
      return $differnce->y;
      

    default:
      return $differnce;
      
  }
}

