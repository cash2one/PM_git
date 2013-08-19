<?php
//流程检查时、完成时，要提醒的人user_id
function PMChecker()
{
	$PMChecker=array();
	//编辑
	$PMChecker["1"]=array(45);
	//设计
	$PMChecker["2"]=array(92);
	//前端
	$PMChecker["3"]=array(42);
	//动画
	$PMChecker["6"]=array(41);
	//移动
	$PMChecker["7"]=array(27);
	return $PMChecker;
}

//全新设计的权限系统2.0(只影响新功能)
//字段:user.power2
function pmPower2($key)
{
	$list=array(
		'1'=>"项目评分",
		/*
		'2'=>"未定义",
		'4'=>"未定义",
		'8'=>"未定义",
		'16'=>"未定义",
		'32'=>"未定义",
		'64'=>"未定义"
		*/
	);
	if($key)
		return $list[$key];
	else
		return $list;
}

//职能
//字段:role_id
function getRoleArray()
{
	$role_list=array(
					 '5'=>'经理',
					 '4'=>'组长',
					 '1'=>'编辑',
					 '2'=>'设计师',
					 '3'=>'前端技术',
					 '6'=>'动画',
					 '7'=>'移动',
					 '100'=>'组外接口人',
					 '101'=>'邮件列表',
					 );
	return $role_list;
}


//权限
//字段:user.power
function getPowerArray()
{
	$power_list=array(
					 '0'=>'管理员',
					 '1'=>'审核员',
					 '2'=>'普通用户',
					 '10'=>'无操作用户',
					 '100'=>'非系统使用者'
					 );
	return $power_list;
}

//项目状态
//字段:project.proj_state
function getProjState()
{
	$state_list=array(
					 '10'=>'归档',
					 '15'=>'完成',
					 '20'=>'正在进行',
					 '30'=>'未开始',
					 '40'=>'等待审核',
					 '50'=>'草稿',
					 '100'=>'已取消',
					 '1020'=>'恢复',
					 );
	return $state_list;
}

//项目分类
//字段:proj_node.proj_class
function getProjClass()
{
	$list=array(
					 '1'=>'官网日常',
					 '2'=>'线上活动',
					 '3'=>'玩家专题',
					 '4'=>'营销推广',
                     '5'=>'redmine提单',
					 '0'=>'其它',
				);
	return $list;
}

//项目等级
//字段:project.proj_level1
//							=>project.proj_level2
function getProjLevel()
{
	$list=array(
					 1=>array('name'=>'A','data'=>array(
								1=>'新游概念/展示站',
								2=>'推广期官网改版项目',
								3=>'重点系统/APP开发'
								)),
					 2=>array('name'=>'B','data'=>array(
								1=>'创意型互动站',
								2=>'资料片/展示站(互动)',
								3=>'重点投放FAB',
								4=>'大型互动类专题',
								5=>'系统/APP开发'
								)),
					 3=>array('name'=>'C','data'=>array(
								1=>'节假日/活动专题',
					 			2=>'单页面专题'
								)),
					 4=>array('name'=>'D','data'=>array(
								1=>'简单型专题',
					 			2=>'直邮'
								)),
					 5=>array('name'=>'E','data'=>array(
								1=>'页面修改',
					 			2=>'日常banner'
								)),
					 10=>array('name'=>'无级别','data'=>array(
								1=>'组织贡献类',
					 			2=>'其它'
								))
				);
	return $list;
}



//流程状态
//字段:proj_node.pnod_state
function getPnodState()
{
	$state_list=array(
					 '10'=>'归档',
					 '15'=>'完成',
					 '17'=>'检查一',
					 '18'=>'检查二',
					 '20'=>'正在进行',
					 '30'=>'未开始',
					 '40'=>'等待审核',
					 '50'=>'草稿',
					 '100'=>'已取消',
					 '1000'=>'未知',
					 );
	return $state_list;
}





//流程是否需要审核
//字段:proj_node.pnod_state2
function getPnodState2()
{
	$state_list=array(
					 '0'=>'不需要审核',
					 '1'=>'需要审核'
					 );
	return $state_list;
}



//流程类别
//字段:proj_node.pnod_type
//							=>proj_node.pnod_type2
function getNodesClass($type)
{
	$list=array(
				1=>array(
					//网站
						1=>array('name'=>'编辑','data'=>array(
								 1=>"需求整理",
								 2=>'数据分析',
								 3=>'原型规划',
								 4=>'内容填充',
								 5=>'后续跟进',
								 6=>'页面测试',
								 7=>'修改优化',
								 8=>'现场报道'
							)),
						2=>array('name'=>'设计','data'=>array(
								 1=>"前期沟通",
								 2=>'风格确定',
								 3=>'页面设计',
								 4=>'优化调整',
								 5=>'创意提案',
								 6=>'动画设计',
								 7=>'Banner设计',
								 8=>'APP设计',
                                 9=>'交互设计'
							)),
						3=>array('name'=>'技术','data'=>array(
								 1=>"页面开发",
								 2=>'页面修改',
								 3=>'页面优化',
								 4=>'技术测试',
								 5=>'后续跟进',
								 6=>'Flash开发',
								 7=>'Flash优化',
								 8=>'Flash修改',
								 9=>'APP开发'
							)),
						6=>array('name'=>'动画','data'=>array(
								 2=>'创意策划',
								 3=>'互动原型',
								 4=>'平面设计',
								 5=>'动画设计',
								 1=>"动画特效",
								 6=>'优化调整'
							)),
						10=>array('name'=>'redmine提单','data'=>array(
								 1=>"redmine提单"
							)),
                        100=>array('name'=>'其它','data'=>array(
                            1=>"其它"
                        ))
                        /*20130730 将10改成redmine的，100变成其他*/
					),
				2=>array(
					//移动
					30=>array('name'=>'产品策划','data'=>array(
							 1=>'前期策划',
							 2=>'需求分析',
							 3=>'文档撰写',
							 4=>'原型规划',
							 5=>'跟进开发',
							 6=>'后续跟进',
							 7=>'跟进测试',
							 8=>'上线确认'
						)),
					31=>array('name'=>'交互设计','data'=>array(
							 1=>'需求收集与分析',
							 2=>'交互初稿',
							 3=>'交互原型',
							 4=>'可用性测试'
						)),
					32=>array('name'=>'交互设计','data'=>array(
							 1=>'需求收集与分析',
							 2=>'交互初稿',
							 3=>'交互原型',
							 4=>'可用性测试'
						)),
					33=>array('name'=>'视觉设计','data'=>array(
							 1=>'风格设计',
							 2=>'关键界面设计',
							 3=>'完善界面',
							 4=>'测试',
							 5=>'标注视觉稿',
							 6=>'整理/规范'
						)),
					34=>array('name'=>'技术开发','data'=>array(
							 1=>'服务器端开发',
							 2=>'客户端架构',
							 3=>'客户端模块开发',
							 4=>'编译安装包'
						)),
					35=>array('name'=>'QA测试','data'=>array(
							 1=>'UI测试',
							 2=>'功能测试',
							 3=>'技术测试'
						)),
					36=>array('name'=>'内容编辑','data'=>array(
							 1=>'内容填充',
							 2=>'原型规划',
							 3=>'专区建设',
							 4=>'后续跟进',
							 5=>'修改优化',
							 6=>'专题制作',
							 7=>'数据分析',
							 8=>'活动策划',
							 9=>'现场报道',
							 10=>'采访'
						))
					)
			);
	return $list[$type];
}

//评分标准
function pmScoreToNum($score=NULL)
{
	$list=array(
	'A'=>150,
	'B'=>125,
	'C'=>100,
	'D'=>75,
	'E'=>50,
	'F'=>25
	);
	if($score===NULL) return $list;
	else return $list[$score];
}
//评分文案
function pmScoreNameArray($score=NULL)
{
	$list=array(
	'A'=>"A.卓越",
	'B'=>"B.优秀",
	'C'=>"C.良好",
	'D'=>"D.一般",
	'E'=>"E.较差",
	'F'=>"F.极差"
	);
	if($score===NULL) return $list;
	else return $list[$score];
}

//延期说明
function pmDelayReasonArray($id=NULL)
{
	$list=array(
	1=>"无延期",
	2=>"素材延迟",
	3=>"反复修改",
	4=>"无人跟进",
	5=>"确认太晚",
	);
	if($id===NULL) return $list;
	else return $list[$id];
}

//产品分类
//字段:product.prod_type
function getProductType()
{
$G_produtType=array(
'0'=>'游戏产品',
'1'=>'其它产品',
'404'=>'停用产品'
);
return $G_produtType;
}


//项目集状态分类
function getWrapState()
{
	$list=array(
				'1'=>'结束',
				'2'=>'进行中'
				);
	return $list;
}

//技能分类
function getSkillType($type=NULL)
{
	$list=array(
				'1'=>'专业能力',
				'2'=>'胜任力',
				'3'=>'知识结构',
				'4'=>'工具运用能力',
				);
	if($type===NULL) return $list;
	else return $list[$type];
}

/**
 * 技能得分计算
 * @param int $now_skill_lv 现在的技能等级
 * @param int $get_skill_lv 做的任务所需技能等级
 * @param int $get_skill_score 获得的评价A=1,B=2,C=3
 */
function getSkillScore($now_skill_lv,$get_skill_lv,$get_skill_score)
{
	$x = 0;
	$y = 0;
	switch ($get_skill_score)
	{
		case 1:$x=3.5;break;
		case 2:$x=1;break;
		default:$x=0;
	}
	switch ($get_skill_lv -  $now_skill_lv)
	{
		case -3:$y=0;break;
		case -2:$y=0;break;
		case -1:$y=0;break;
		case 0:$y=1;break;
		case 1:$y=2;break;
		case 2:$y=2;break;
		case 3:$y=2;break;
	}
	
	return 10*$x*$y;
	//TODO juetion 记得讨论计算技能得分计算
}

//页面需要显示的标签
function get_skills_show() {
	//	文档能力  22
	//	信息设计能力 23
	//	手绘原型能力 24
	//	正式原型能力 25
	//	PPT能力 50
	//	会议能力 26
	//	提案能力 27
	//	设计把控能力 28
	//	数据分析能力 34
	//	专业研究能力 35
	//	业务理解 38
	//	沟通表达 43
	//	组织协调 44
	//	团队合作 45
	
	//以下是skill_id,需要从数据库中查找
	return array(22,23,24,25,50,26,27,28,34,35,38,43,44,45);
}
?>