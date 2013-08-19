<?php
class product extends spController
{
	function index()
	{

	}
	
	//产品列表
	function slist()
	{
		$plist=spClass("m_product");
		$this->plist=$plist->spPager($this->spArgs('topage',1),50)->findAll();
		$this->pager=$plist->spPager()->getPager();
		$this->productType=getProductType();
		if(pmUser("power","html")==0) $this->isManager=true;else  $this->isManager=false;
		$this->display('project/products.html');
	}	
	
	//产品添加页
	function add()
	{
		if(pmUser("power","html")!=0)
		$this->productType=getProductType();
		$this->display('project/productEdit.html');
	}
	
	//产品添加，执行
	function addDo()
	{
		pmUser("power");
		$product_c=spClass("m_product");
		$prod_uidlist=$this->spArgs('user_id');
		$userArray=explode("|",$prod_uidlist);
		$prod_unamelist=spClass("m_user")->getUserList($userArray);
		$row=array(
				   'prod_name'=>$this->spArgs('prod_name'),
				   'prod_ename'=>$this->spArgs('prod_ename'),
				   'prod_type'=>$this->spArgs('prod_type'),
				   'prod_Url'=>$this->spArgs('prod_Url'),
				   'prod_uidlist'=>$prod_uidlist,
				   'prod_unamelist'=>$prod_unamelist
				   );
		$product_c->create($row);
		$product_c->reflash();
		$this->jump(spUrl('product','slist'));
	}	
	
	//产品编辑
	function edit()
	{
		pmAuth("manager");
		$plist=spClass("m_product");
		$this->product=$plist->find(array("prod_id"=>$this->spArgs('prod_id')));
		$this->productType=getProductType();
		$this->display('project/productEdit.html');
	}

	function editDo()
	{
		pmAuth("manager","html");
		$prod_c=spClass("m_product");
		$prod_uidlist=$this->spArgs('user_id');
		$userArray=explode("|",$prod_uidlist);
		$prod_unamelist=spClass("m_user")->getUserList($userArray);
		$row=array(
				   'prod_name'=>$this->spArgs('prod_name'),
				   'prod_ename'=>$this->spArgs('prod_ename'),
				   'prod_type'=>$this->spArgs('prod_type'),
				   'prod_Url'=>$this->spArgs('prod_Url'),
				   'prod_uidlist'=>$prod_uidlist,
				   'prod_unamelist'=>$prod_unamelist
				   );
		$conn=array('prod_id'=>$this->spArgs('prod_id'));
		$prod_c->update($conn,$row);
		$prod_c->reflash();
		$this->jump(spUrl('product','slist'));
	}
	

}
