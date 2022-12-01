<?php

class originalDropShadow extends dropShadow
{
var $_size;
var $_type;

function setDebugging($do = FALSE)
{
  $this->_showDebug = ($do ? TRUE : FALSE);
}

function setImageType($type = '')
{
  if ($type != "jpg" && $type != "png") $this->_type = "png";
  else $this->_type = $imgtype;
  if ($this->_type == 'jpg') $this->_type = 'jpeg';
}

function setImageSize($size = 0)
{
  $this->_size = $size;
}

function createThumbnail($input = '', $output = '', $isstring = FALSE)
{
  $this->createDropShadow($input, $output, array(255,255,255), $isstring, 1);
}
// If create shadow -> $withoutshadow=0, if without shadow -> $withdoutshadow=1
function createDropShadow($input = '', $output = '', $background = array(), $isstring = FALSE, $withoutshadow = 1)
{
  $ok = FALSE;
  if ($isstring) $ok = $this->loadImageFromString($input);
  else $ok = $this->loadImage($input, $this->_type);
  if ($ok == FALSE)
  {
  $this->_debug('createDropShadow', 'The image could not be loaded.');
  return FALSE;
  }

  if ($this->_size)
  {
  $sizes = @GetImageSize($input);
  if ($sizes[0] > $sizes[1]) $this->resizeToSize(0, $this->_size);
  else $this->resizeToSize($this->_size, 0);
  }
  
  if (!$withoutshadow)
  {
  $this->applyShadow(dechex($background[0]) . dechex($background[1]) . dechex($background[2]));
  $this->saveShadow($output, $this->_type, 90);
  }
  else
  {
  $this->saveFinal($output, $this->_type, 90);
  }
}

}
?>