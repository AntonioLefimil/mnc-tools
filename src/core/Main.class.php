<?php
include 'Config.php';
include 'Annotation.class.php';
include 'Logger.class.php';
include 'Controller.class.php';
include 'AjaxException.class.php';

class Main {

	private $logger;
	
	public function Main(){
		$this->logger = Logger::getLogger();
	}
	
	public function isIndex($uri){ return strlen($uri) == strlen(CTX_PATH)+1; }
	
	public function handleRequest($uri){
		$uri = str_replace(CTX_PATH.'/', '', $uri);
		$site = simplexml_load_file('../'.SITE_MAP);
		$requestMapping = null;
		foreach ($site->requestMapping as $map){
			if ($map['name'] == $uri){
				try {
					$requestMapping = $map;
					$className = (string)$map['class'];
					include '../controllers/'.$className.'.class.php';
					$refClass = new ReflectionClass($className);
					$method = $refClass->getMethod($map['method']);
					$ap = new AnnotationProccess($method);
					$instance = $refClass->newInstance(); #invoca al constructor
					
					if($an = $ap->getAnnotationByName('Privilege')){ PrivilegeAnnotation::process($an); }
					if($an = $ap->getAnnotationByName('ClassDependency')){ ClassDependencyAnnotation::process($an); }
					
					$result = $method->invoke($instance);
					break;
				}
				catch (Exception $e){
					if ($requestMapping['ajaxResponse']){
						throw new AjaxException($e->getMessage());
					}
					throw $e;
				}
			}
		}
		
		if ($requestMapping) {
			if ($requestMapping['ajaxResponse']){ print(json_encode($result)); }
			else { $this->setView($result); }
		}
		else { throw new Exception("No existe mapeo para $uri"); }
	}
	
	public function notifyError($message){
		$this->logger->error($message);
		$this->setView('error');
	}
	
	public function notifyAjaxError($message){
		$this->logger->error($message);
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	}
	
	private function setView($v){
		$path = $this->getContextPath()."/webapp/views/$v.php";
		if ($this->isMobileDevice()){ $path = $this->getContextPath()."/webapp/mobile/$v.php"; }
		require $path;
	}
	
	private function isMobileDevice(){
		$user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
		return (
			preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent)
			or preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) 
			or (DEV_MOBILE == '1')
		);
	}
	private function getContextPath(){ return $_SERVER['DOCUMENT_ROOT'].'.'.CTX_PATH; } 
}

class Request {
	static private $p;
	static private $i;
	private function Request(){self::$p = (($_SERVER['REQUEST_METHOD'] == 'GET')?$_GET:$_POST);}
	public static function getInstance(){if (self::$i == null){ self::$i = new Request();} return self::$i;}
	public function getParam($n){ return self::$p[$n]; }
	public function attachFile(){ return count($_FILES > 0); }
	public function getFile($n){ return $_FILES[$n]; }
}

class Session {
	static private $i;
	private function Session(){session_start();}
	public static function getInstance(){if (self::$i == null){self::$i = new Session();} return self::$i; }
	public function setUser($u){ $_SESSION['USER']=$u; }
	public function getAttr($k){ return $_SESSION[$k]; }
	public function setAttr($k, $v){ $_SESSION[$k]=$v; }
	public function close(){session_unset();}
}

class Util {
	public static function lastOcurrence($a, $b){$t=explode($b, $a);return $t[count($t)-1];}
	public static function endWith($str, $end){ return preg_match("($end$)", $str); }
	public static function getExtension($fileName){ return self::lastOcurrence($fileName, '.');}
}

$main = new Main();
$uri = $_SERVER['REQUEST_URI'];
if (strpos($uri, '?')){ $uri = substr($uri, 0, strpos($uri, '?'));} #fix $uri
if( $main->isIndex($uri) ){ $uri = CTX_PATH.'/'.WELCOME_PAGE; }
try { $main->handleRequest($uri); }
catch (AjaxException $e){ $main->notifyAjaxError($e->getMessage()); }
catch (Exception $e){ $main->notifyError($e->getMessage()); }


