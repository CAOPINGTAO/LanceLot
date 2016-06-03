<?php
/**
 * 后台公用函数库
 * User: Lancelot
 * Date: 2016/5/09
 * Time: 16:43
 */

/**
 * 递归重组节点多维信息数组
 * @param  [array] $node [要处理的节点数组:二维数组]
 * @param  [int]   $pid  [父级ID]
 * @return [array]       [树状结构的节点体系:多维数组]
 */
function node_merge($node, $pid=0){

	$array = array();
	foreach ($node as $val) {
		//如果该节点的父节点等于pid（默认为0即顶级应用）
		if ($node['pid'] == $pid) {
			//为该节点新建一个child项，	
			$val['child'] = node_merge($node, $val['id']);
			$array[] = $val;
		}
	}

	return $array;
}

/**
 * 生成返回数组
 * @param int 	 $statusCode 返回响应状态码
 * @param String $message 	 返回信息
 * @param type 	 $type 		 回调方式
 * @param nav 	 $nav 		 返回以后要进行刷新的页面
 * @param for 	 $for 		 rel
 */
function getReturnArray($statusCode, $message, $type="closeCurrent", $nav="", $for=""){

	return array(
		"statusCode"	=>	$statusCode,
		"message"		=>	$message,
		"navTabId"		=>	$nav,
		"forwardUrl"	=>	$for,
		"callbackType"	=>	$type
	);
}