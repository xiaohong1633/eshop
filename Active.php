<?php
abstract class ActiveRecord{
	protected static $table;
	protected  $fieldvalue;
	public $select;
	
	static function findById($id){
		$query = "select * from ".static::$table." where id=$id";
		return self::createDomain($query);
	}
	function __get($name){
		return $this->fieldvalue[$name];
	}
	static function __callStatic($method,$args){
		$field = preg_match("/^findBy(\w*)$/","${1}",$method);
		$query = "select * from ".static::$table." where $field='$args[0]'";//若参数是ID则实现将id字符串返回，供以后调用
		return self::createDomain($query);
	}
	private static function createDomain($query){
		$klass = get_called_class();//返回调用该方法的类名
		$domain = new $klass();
		$domain->fieldvalue = array();
		$domain->select = $query;
		foreach($klass::$fields as $field=>$type){
			$domain->fieldvalue[$field]  = "TODO:set from sql result";
		}
		return $domain;
	}
	
}

class Customer extends ActiveRecord{
	protected static $table = "custdb";
	protected static $fields = array("id"=>"int",'email'=>'varchar','lastname'=>'varchar');
}
class Sales extends ActiveRecord{
	protected static $table = 'salesdb';
	protected static $fields = array(
		'id'=>'int',
		'item'=>'varchar',
		'qty'=>'int'
	);
}

if(assert("select * from custdb where id='123'" == Customer::findById('123')->select)){echo "eqal<br/>}";};

?>













