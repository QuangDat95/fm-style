<?php

class template {

	var $filecontents = '';
	var $blocks = array();
	var $parsed_blocks = array();
	var $preparsed_blocks = array();
	var $block_parse_order = array();
	var $sub_blocks = array();
	var $vars = array();
	var $filevars = array();
	var $filevar_parent = array();
	var $filecache = array();
	var $tpldir = '';
	var $files = null;
	var $filename = '';
	var $file_delim = '';
	var $filevar_delim = '';
	var $filevar_delim_nl = '';
	var $block_start_delim = '<!-- ';
	var $block_end_delim = '-->';
	var $block_start_word = 'BEGIN:';
	var $block_end_word = 'END:';
	var $tag_start_delim = '{';
	var $tag_end_delim = '}';
	var $mainblock = 'main';
	var $output_type = 'HTML';
	var $_null_string = array('' => '');
	var $_null_block = array('' => '');
	var $_error = '';
	var $_autoreset = true;            
	var $_ignore_missing_blocks = true ;	
	var $_file_name_full_path = '';
	
	function template ($file,  $tpldir = '', $files = null, $mainblock = 'main', $autosetup = true) {

		$this->filename = $file;
		$this->_file_name_full_path = realpath($file);		
		$this->tpldir = $tpldir;

		if (is_array($files)) {
			$this->files = $files;
		}

		$this->mainblock = $mainblock;

		if ($autosetup) {
			$this->setup();
		}
	}

	function restart ($file, $tpldir = '', $files = null, $mainblock = 'main', $autosetup = true, $tag_start = '{', $tag_end = '}') {
		
		$this->filename = $file;		
		$this->_file_name_full_path = realpath($file);		
		$this->tpldir = $tpldir;		
		if (is_array($files)) {
			$this->files = $files;
		}
		
		$this->mainblock = $mainblock;	
		$this->tag_start_delim = $tag_start;
		$this->tag_end_delim = $tag_end;
		$this->filecontents = '';	
		$this->blocks = array();
		$this->parsed_blocks = array();
		$this->preparsed_blocks = array();
		$this->block_parse_order = array();
		$this->sub_blocks = array();
		$this->vars = array();
		$this->filevars = array();
		$this->filevar_parent = array();
		$this->filecache = array();
		
		if ($autosetup) {
			$this->setup();
		}
	}

	function setup ($add_outer = false) {
		
		$this->tag_start_delim = preg_quote($this->tag_start_delim);
		$this->tag_end_delim = preg_quote($this->tag_end_delim);
		$this->file_delim = "/" . $this->tag_start_delim . "FILE\s*\"([^\"]+)\"\s*" . $this->tag_end_delim . "/m";
		$this->filevar_delim = "/" . $this->tag_start_delim . "FILE\s*" . $this->tag_start_delim . "([A-Za-z0-9\._]+?)" . $this->tag_end_delim . "\s*" . $this->tag_end_delim . "/m";
		$this->filevar_delim_nl = "/^\s*" . $this->tag_start_delim . "FILE\s*" . $this->tag_start_delim . "([A-Za-z0-9\._]+?)" . $this->tag_end_delim . "\s*" . $this->tag_end_delim . "\s*\n/m";

		if (empty($this->filecontents)) {
			$this->filecontents = $this->_r_getfile($this->filename);
		}

		if ($add_outer) {
			$this->_add_outer_block();
		}

		$this->blocks = $this->_maketree($this->filecontents, '');
		$this->filevar_parent = $this->_store_filevar_parents($this->blocks);
		$this->scan_globals();
	}

	function assign ($name, $val = '') {

		if (is_array($name)) {
			foreach ($name as $k => $v) {
				$this->vars[$k] = $v;
			}
		} else {
			$this->vars[$name] = $val;
		}
	}

	function assign_file ($name, $val = '') {

		if (is_array($name)) {
			foreach ($name as $k => $v) {
				$this->_assign_file_sub($k, $v);
			}
		} else {
			$this->_assign_file_sub($name, $val);
		}
	}

	function parse ($bname) {
		if (isset($this->preparsed_blocks[$bname])) {
			$copy = $this->preparsed_blocks[$bname];
		} elseif (isset($this->blocks[$bname])) {
			$copy = $this->blocks[$bname];
		} elseif ($this->_ignore_missing_blocks) {
			$this->_set_error("parse: blockname [$bname] does not exist");
			return;
		} else {
			$this->_set_error("parse: blockname [$bname] does not exist");
		}

		if (!isset($copy)) {
			die('Block: ' . $bname);
		}

		$copy = preg_replace($this->filevar_delim_nl, '', $copy);
		$var_array = array();
		preg_match_all("/" . $this->tag_start_delim . "([A-Za-z0-9\._]+? ?#?.*?)" . $this->tag_end_delim. "/", $copy, $var_array);
		$var_array = $var_array[1];
		
		foreach ($var_array as $k => $v) {
			$any_comments = explode('#', $v);
			$v = rtrim($any_comments[0]);

			if (sizeof($any_comments) > 1) {
				$comments = $any_comments[1];
			} else {
				$comments = '';
			}

			$sub = explode('.', $v);

			if ($sub[0] == '_BLOCK_') {
				unset($sub[0]);
				$bname2 = implode('.', $sub);
				$var = isset($this->parsed_blocks[$bname2]) ? $this->parsed_blocks[$bname2] : null;
				$nul = (!isset($this->_null_block[$bname2])) ? $this->_null_block[''] : $this->_null_block[$bname2];
				
				if ($var == '') {

					if ($nul == '') {
						$copy = preg_replace("/" . $this->tag_start_delim . $v . $this->tag_end_delim . "/m", '', $copy);
					} else {
						$copy = preg_replace("/" . $this->tag_start_delim . $v . $this->tag_end_delim . "/", "$nul", $copy);
					}
				} else {

					$var = trim($var);
					$var = str_replace('\\', '\\\\', $var);
					$var = str_replace('$', '\\$', $var);
					$var = str_replace('\\|', '|', $var);
					$copy = preg_replace("|" . $this->tag_start_delim . $v . $this->tag_end_delim . "|", "$var", $copy);
				}
			} else {

				$var = $this->vars;
				foreach ($sub as $v1) {
					if (!isset($var[$v1]) || (!is_array($var[$v1]) && strlen($var[$v1]) == 0)) {
						if (defined($v1)) {
							$var[$v1] = constant($v1);
						} else {
							$var[$v1] = null;
						}
					}
					$var = $var[$v1];
				}

				$nul = (!isset($this->_null_string[$v])) ? ($this->_null_string[""]) : ($this->_null_string[$v]);
				$var = (!isset($var)) ? $nul : $var;

				if ($var == '') {
					$copy=preg_replace("|\s*" . $this->tag_start_delim . $v . " ?#?" . $comments . $this->tag_end_delim . "\s*\n|m", '', $copy);
				}

				$var = trim($var);
				$var = str_replace('\\', '\\\\', $var);
				$var = str_replace('$', '\\$', $var);
				$var = str_replace('\\|', '|', $var);
				$copy=preg_replace("|" . $this->tag_start_delim . $v . " ?#?" . $comments . $this->tag_end_delim . "|", "$var", $copy);
			}
		}

		if (isset($this->parsed_blocks[$bname])) {
			$this->parsed_blocks[$bname] .= $copy;
		} else {
			$this->parsed_blocks[$bname] = $copy;
		}

		if ($this->_autoreset && (!empty($this->sub_blocks[$bname]))) {
			reset($this->sub_blocks[$bname]);
			foreach ($this->sub_blocks[$bname] as $k => $v) {
				$this->reset($v);
			}
		}
	}

	function rparse ($bname) {

		if (!empty($this->sub_blocks[$bname])) {
			reset($this->sub_blocks[$bname]);
			foreach ($this->sub_blocks[$bname] as $k => $v) {
				if (!empty($v)) {
					$this->rparse($v);
				}
			}
		}

		$this->parse($bname);
	}

	function insert_loop ($bname, $var, $value = '') {
		$this->assign($var, $value);
		$this->parse($bname);
	}

	function array_loop ($bname, $var, &$values) {
		if (is_array($values)) {
			foreach($values as $v) {
				$this->assign($var, $v);
				$this->parse($bname);
			}
		}
	}

	function text ($bname = '') {
		$text = '';
		$bname = !empty($bname) ? $bname : $this->mainblock;
		$text .= isset($this->parsed_blocks[$bname]) ? $this->parsed_blocks[$bname] : $this->get_error();
		return $text;
	}

	function out ($bname) {
		$out = $this->text($bname);
		echo $out;
	}

	function out_file ($bname, $fname) {
		if (!empty($bname) && !empty($fname) && is_writeable($fname)) {
			$fp = fopen($fname, 'w');
			fwrite($fp, $this->text($bname));
			fclose($fp);
		}
	}

	function reset ($bname) {
		$this->parsed_blocks[$bname] = '';
	}

	function parsed ($bname) {
		return (!empty($this->parsed_blocks[$bname]));
	}

	function SetNullString ($str, $varname = '') {
		$this->_null_string[$varname] = $str;
	}

	function SetNullBlock ($str, $bname = '') {
		$this->_null_block[$bname] = $str;
	}

	function set_autoreset () {
		$this->_autoreset = true;
	}

	function clear_autoreset () {
		$this->_autoreset = false;
	}

	function scan_globals () {
		reset($GLOBALS);
		foreach ($GLOBALS as $k => $v) {
			$GLOB[$k] = $v;
		}

		$this->assign('PHP', $GLOB);
	}

	function get_error () {
		$retval = false;
		if ($this->_error != '') {			
			switch ($this->output_type) {
				case 'HTML':
				case 'html':
				$retval = '<b>[template]</b><ul>' . nl2br(str_replace('* ', '<li>', str_replace(" *\n", "</li>\n", $this->_error))) . '</ul>';
				break;
				default:
				$retval = '[template] ' . str_replace(' *\n', "\n", $this->_error);
				break;
			}
		}

		return $retval;
	}

	function _maketree ($con, $parentblock='') {
		$blocks = array();
		$con2 = explode($this->block_start_delim, $con);
		if (!empty($parentblock)) {
			$block_names = explode('.', $parentblock);
			$level = sizeof($block_names);
		} else {
			$block_names = array();
			$level = 0;
		}

		foreach($con2 as $k => $v) {
			$patt = "($this->block_start_word|$this->block_end_word)\s*(\w+) ?#?.*?\s*$this->block_end_delim(.*)";
			$res = array();
			if (preg_match_all("/$patt/ims", $v, $res, PREG_SET_ORDER)) {
				$block_word	= $res[0][1];
				$block_name	= $res[0][2];
				$content	= $res[0][3];
				
				if (strtoupper($block_word) == $this->block_start_word) {
					$parent_name = implode('.', $block_names);
					$block_names[++$level] = $block_name;
					$cur_block_name=implode('.', $block_names);
					$this->block_parse_order[] = $cur_block_name;
					$blocks[$cur_block_name] = isset($blocks[$cur_block_name]) ? $blocks[$cur_block_name] . $content : $content;
					$blocks[$parent_name] .= str_replace('\\', '', $this->tag_start_delim) . '_BLOCK_.' . $cur_block_name . str_replace('\\', '', $this->tag_end_delim);
					$this->sub_blocks[$parent_name][] = $cur_block_name;
					$this->sub_blocks[$cur_block_name][] = '';
				} else if (strtoupper($block_word) == $this->block_end_word) {
					unset($block_names[$level--]);
					$parent_name = implode('.', $block_names);
					$blocks[$parent_name] .= $res[0][3];
				}
			} else {
				$tmp = implode('.', $block_names);
				if ($k) {
					$blocks[$tmp] .= $this->block_start_delim;
				}
				$blocks[$tmp] = isset($blocks[$tmp]) ? $blocks[$tmp] . $v : $v;
			}
		}
		return $blocks;
	}

	function _assign_file_sub ($name, $val) {
		if (isset($this->filevar_parent[$name])) {
			if ($val != '') {
				$val = $this->_r_getfile($val);
				foreach($this->filevar_parent[$name] as $parent) {
					if (isset($this->preparsed_blocks[$parent]) && !isset($this->filevars[$name])) {
						$copy = $this->preparsed_blocks[$parent];
					} elseif (isset($this->blocks[$parent])) {
						$copy = $this->blocks[$parent];
					}
					$res = array();
					preg_match_all($this->filevar_delim, $copy, $res, PREG_SET_ORDER);
					if (is_array($res) && isset($res[0])) {
						foreach ($res[0] as $v) {
							$copy = preg_replace("/" . preg_quote($v) . "/", "$val", $copy);
							$this->preparsed_blocks = array_merge($this->preparsed_blocks, $this->_maketree($copy, $parent));
							$this->filevar_parent = array_merge($this->filevar_parent, $this->_store_filevar_parents($this->preparsed_blocks));
						}
					}
				}
			}
		}
		$this->filevars[$name] = $val;
	}

	function _store_filevar_parents ($blocks){
		$parents = array();
		foreach ($blocks as $bname => $con) {
			$res = array();
			preg_match_all($this->filevar_delim, $con, $res);
			foreach ($res[1] as $k => $v) {
				$parents[$v][] = $bname;
			}
		}
		return $parents;
	}

	function _set_error ($str)    {
		$this->_error .= '* ' . $str . " *\n";
	}

	function _getfile ($file) {
		if (!isset($file)) {
			$this->_set_error('!isset file name!' . $file);
			return '';
		}

		if (isset($this->files)) {
			if (isset($this->files[$file])) {
				$file = $this->files[$file];
			}
		}

		if (!empty($this->tpldir)) {
			$file = $this->tpldir. '/' . $file;
		}

		if (isset($this->filecache[$file])) {
			$file_text=$this->filecache[$file];

		} else {
			if (is_file($file)) {
				if (!($fh = fopen($file, 'r'))) {
					$this->_set_error('Cannot open file: ' . $file);
					return '';
				}
				$file_text = fread($fh,filesize($file));
				fclose($fh);

			} else {
				$this->_set_error("[" . realpath($file) . "] ($file) does not exist");
				$file_text = "<b>__template fatal error: file [$file] does not exist__</b>";
			}
			
			$this->filecache[$file] = $file_text;
		}
		return $file_text;
	}

	function _r_getfile ($file) {
		$text = $this->_getfile($file);
		$res = array();
		while (preg_match($this->file_delim,$text,$res)) {			
			$text2 = $this->_getfile($res[1]);
			$text = preg_replace("'".preg_quote($res[0])."'",$text2,$text);
		}
		return $text;
	}

	function _add_outer_block () {
		$before = $this->block_start_delim . $this->block_start_word . ' ' . $this->mainblock . ' ' . $this->block_end_delim;
		$after = $this->block_start_delim . $this->block_end_word . ' ' . $this->mainblock . ' ' . $this->block_end_delim;
		$this->filecontents = $before . "\n" . $this->filecontents . "\n" . $after;
	}

	function _pre_var_dump () {
		echo '<pre>';
		var_dump(func_get_args());
		echo '</pre>';
	}
}

?>