<?php
class DtTemplate{
    protected   $_tplVars = array();
	protected   $_tplDir = 'templates'; // 
	
	public function __construct($tplDir = '') 
	 {        
	   if ($tplDir != '')
		 {          
		  $this->setTplDir($tplDir);    
		 }   
	 }
	 
	public function setTplDir($tplDir)    
	{       
		$this->_checkFileExists($tplDir);      
	   $this->_tplDir = $tplDir;    
	}	 
	
	 public function assign($var, $value = null)    
	 {        
		if (is_array($var)) 
		{           
			 foreach ($var as $name => $value)            
			 {                
			 $this->_tplVars[$name] = $value;            
			 }       
	   } else 
	   {           
		 $this->_tplVars[$var] = $value;       
	   }    
	}	 
		
	public function fetch($tplFile)    
	{        
		ob_start();        
		$this->display($tplFile);        
		$output = ob_get_contents();        
		ob_end_clean();         
		return $output;    
	}
	
	
	public function display($tplFile)    
	{        
		$filePath = $this->_tplDir . '/' . $tplFile;        
		$this->_checkFileExists($filePath);        
		extract($this->_tplVars);        
		require($filePath);    
	}
		
	
	
	public function clearAllAssign()    
	{        
		foreach (array_keys($this->_tplVars) as $name)        
		{            
		unset($this->_tplVars[$name]);        
		}    
	}
		
	
	
	private function _checkFileExists($filePath)    
	{        
		if (!file_exists($filePath)) 
		{            
			trigger_error("DtTemplate: Khong tim thay file <b>$filePath</b>", E_USER_ERROR);            
			exit;        
		}    
	}

}	
		
$data->closedata() ;
	 
?>	