<?php 
/**
 * manage the attached file
 *
 * This file include three classes for managing file attached.
 * MODEL:{source,uri,name,descript,tag,author,createtime,updatetime}
 * EXAMPLE:
	$f = new nieFile;
	$result = $f->put(array(
		'source'=>$_FILES['file'],
		'name'=>'the nie file',
		'descript'=>'this is a nie project file',
		'tag'=>'file,nie',
		'author'=>'mrhanta'
	));
	if($result){...};
 * INSTALL:
	CREATE TABLE IF NOT EXISTS `files` (
	  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `uri` varchar(250) NOT NULL,
	  `source` varchar(250) NOT NULL,
	  `name` varchar(250) NOT NULL,
	  `author` varchar(50) NOT NULL,
	  `tag` varchar(250) DEFAULT NULL,
	  `createtime` datetime NOT NULL,
	  `updatetime` datetime NOT NULL,
	  `descript` mediumtext,
	  PRIMARY KEY (`id`)
 	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 * 
 * @author <zhfu@corp.netease.com> zhfu
 * @subpackage nie-file
 * @method string put(array $file)
 * @method bool delete(string $furi)
 * @method array get(string $furi)
 * @method array get()
 * @method bool update(array $file)
 * @example /index.php?c=file show how to use the extension
 */
	class nieFileConf{
		public static $ROOT = APP_PATH;
		public static $DIR = '/files';
	}
	
	class nieFileModel extends spModel{
		var $table = 'files';
		var $pk = 'id';
	}
	
	class nieFile{
	
		public function __construct(){}
		
		/* API->put: */
		public function put($file){
			if(is_array($file)){ //save uploaded file;
				$uri = $this->upload($file);
				if($uri){
					$f = new nieFileModel;
					$f->create(array(
						'source'=>'uploaded',
						'name'=>$file['name'],
						'descript'=>$file['descript'],
						'tag'=>$file['tag'],
						'uri'=>$uri,
						'author'=>$file['author'],
						'createtime'=>date('Y-m-d H:i:s')
					));
					return $uri;
				}
				return false;
			}elseif(is_string($file)){ 
				//save file from url;
			}
		}
		
		/* API->delete: */
		public function delete($uri=''){
			$filepath=nieFileConf::$ROOT.$uri;
			if($uri!='' && file_exists($filepath)){
				if(unlink($filepath)){
					$f=new nieFileModel;
					$f->delete(array('uri'=>$uri));
					return $uri;
				}else{ return false; }
			}
		} 
		
		/* API->update: */
		public function update($file){
			if(is_array($file)){
				$f=new nieFileModel;
				$file['updatetime']=date('Y-m-d H:i:s');
				return $f->update(array('uri'=>$file['uri']),$file);
			}
			return false;
		}
		
		/* API->get: */
		public function get($furi){
			
			if(isset($furi)){
				$f = new nieFileModel;
				return $f->find(array('uri'=>$furi));
			}else{
				
				$f= new nieFileModel;
				return $f->findAll('','createtime','','0,20');
			
			}
		}
		
		/**
		 * @method bool upload() save file from uploaded
		 */
		public function upload($upfile){
			if($upfile){
				if(!$this->safe($upfile['source'])) return false;				
				$fdir=nieFileConf::$ROOT.nieFileConf::$DIR.'/'.date('Y-m').'/';
				$fname=$this->rename($upfile['source']['name']);
				if(!is_dir($fdir)) mkdir($fdir);
				move_uploaded_file($upfile['source']['tmp_name'],$fdir.$fname);
				return str_replace(nieFileConf::$ROOT,'',$fdir.$fname);
			}
			return false;
		}
		/**
		 * @method string rename() generate a new name for the file
		 */
		private function rename($fname){
			$finfo=pathinfo($fname);
			return md5('file:'.time().round(1,100)).'.'.$finfo['extension'];
		}
		/**
		 * @method bool upload() ensure the file is safty
		 */
		private function safe($f){
			return !preg_match('/\.exe$/',$f['name']);
		}
		
	}
	
	
?>