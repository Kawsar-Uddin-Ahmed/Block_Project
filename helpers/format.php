<?php

class format
{
  public function Date($date)
  {
  	return date("F j,Y,g:i a",strtotime($date));
  }
public function readmore($text,$limit = 600)
{
   $text = $text." ";
   $text = substr($text,0,$limit);/// Here it will manually show $limit = 300 words means it will show only 300 words if you give more or less than it will show that much word and to read full paragraph you have to press 'Readmore' option.you can specify the limit is main code also but here it is mandatory to fix limit range of text.//---\\\
   $text = substr($text,0,strrpos($text, ' '));///Here strrpos($text, '1 space only')is used so that No string can be show by cutting some word in the paragarph from where read more start.//--\\\
   $text = $text."....";
   return $text;
}

///For validation or checking the correctness of password and name in login admin panel.///---\\

public function validation($data)
{
	$dat = trim($data);/// The trim() function is used to remove the white spaces and other predefined characters from the left and right sides of a string//--\\\

	$dat = stripcslashes($data);///The stripcslashes() function is used to remove backslashes added by the addslashes() function.Specially script cannot be run using this function.Example:<></script> this thing cannot be run //--\\\

	$dat = htmlspecialchars($data);///For security.//--\\\

	return $dat;
}
///For dymacially showing the tittle means the page I enter the name of the page will be in the title.This is done by without catching id means all time each value.little bit connnected to header.php

public function title()
{
  $path = $_SERVER['SCRIPT_FILENAME'];//For catching the path where the project is( means localhost/project) and the file name.//--\\\
  $title = basename($path,'.php');
 ///Here is the file(in the if condition)name and $title in is the title name. This used only for the pages that are not in the admin panel.///---\\\\
 if($title == 'index')
 {
   $title = 'home';
 }
 elseif($title == 'contact')
 {
   $title = 'contact';
 }
 return $title  = ucwords($title);///Converts the first character of each word in a string to uppercase.//--\\\
}
//---\\\


}


?>