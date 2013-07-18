<?php
class image
 {
  
  public function  reSize($filename,$newwidth,$path)
   { 
    
      
   if(strtolower($this->fileExtension($filename))=='jpg')
    {
   // if you are using png or gif then use this fucntion
    //imagecreatefrompng()
    //imagecreatefromgif() 
   $uploadedfile  = $filename;   
   $src    =  imagecreatefromjpeg($uploadedfile);     
   list($width,$height)=getimagesize($uploadedfile);     
   $newheight=($height/$width)*$newwidth;
   $tmp=imagecreatetruecolor($newwidth,$newheight);
   imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);   
   $filename = $path.time().$uploadedfile ;
   $imagestatus = imagejpeg($tmp,$filename,100);
    if($imagestatus){ $var = 'Image Has Resized Sucessfully ...'; return $var; }
      imagedestroy($src);
     }
    else
    {
    $var = 'Only Jpg Format Supported :)';
    return $var;
    }
      
    
   }
  function  fileExtension($filename)
   {
   $filetype = pathinfo($filename);
   return $filetype['extension'];    
   }

   
    }
?> 
<?php 
$fileresize = new image();
$filename='Penguins.jpg';
$width='100';
$path='';
// if you are using in some other directory 
//$path='user/';

echo $fileresize->reSize($filename,$width,$path);
?>