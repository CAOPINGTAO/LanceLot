<?php
/**
 * 定义用户与角色关联模型
 * User: Lancelot
 * Date: 2016/5/4
 * Time: 18:46
 */
namespace Admin\Model;
use Think\Model\RelationModel;

class UserRelationModel extends RelationModel {

    //定义主表名称
    protected $tableName = 'auser';

    //定义关联关系
    protected $_link = array(
        'role'  =>  array(
            'mapping_type'  => self::MANY_TO_MANY,  //关联类型
            'foreign_key'   =>  'user_id',          //主表在中间表中的字段名称
            'relation_foreign_key'  =>  'role_id',  //关联表（附表在中间表中的字段名称）
            'relation_table'=>  'll_role_user',     //中间表的名称，默认是数据表前缀_关联操作的主表名_关联表名，但我们这里不使用默认的，自己进行定义
            'mapping_fields'=>  'id,name,title'     //只读取附表中的某些字段（附表在这里为role）
        )
    );
}

?>