<?php
class send_mail {
	
	var $to;
	var $from;
	var $cc;
	var $bcc;
	var $subject;
	var $message;
	var $contentType;

	function send_mail() {
		$this->to = "";
		$this->from = "";
		$this->cc = "";
		$this->bcc = "";
		$this->subject = "";
		$this->message = "";
		$this->contentType = "html";
	}

	/*
	function is_email($email) {
		$regex = '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$';
		if(eregi($regex, $email)){
			return true;
		}else{
			return false;
		}
	}
	*/
	
	function send(){
		/*
		// check if e-mail adresses are valid.
		if (!send_mail::is_email($this->to)) die('ERROR: Invalid To e-mail address');
		if (!send_mail::is_email($this->from)) die('ERROR: Invalid From e-mail address');
		if (!send_mail::is_email($this->cc) && !$this->cc=="") die('ERROR: Invalid CC e-mail address');
		if (!send_mail::is_email($this->bcc) && !$this->bcc=="") die('ERROR: Invalid BCC e-mail address');
		// To send HTML mail, you can set the Content-type header. html is the default
		*/
		$headers  = "MIME-Version: 1.0\r\n";
		if ($this->contentType=="html"){
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
		}else{
			$headers .= "Content-type: text/plain; charset=utf-8\r\n";
		}
		// additional headers  for From, Cc and Bcc
		$headers .= "From: ".$this->from."\r\n";
		if(!$this->cc==""){
			$headers .= "Cc: ".$this->cc."\r\n";
		}
		if(!$this->bcc==""){
			$headers .= "Bcc: ".$this->bcc."\r\n";
		}
		// send the e-mail
		return @mail($this->to, $this->subject, $this->message, $headers);
	}
}

?>

