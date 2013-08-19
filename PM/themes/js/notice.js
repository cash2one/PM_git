if($.browser.msie&&$.browser.version=="6.0")
{
	if($("body").height()>370)
		$("body").css("width","96%");
}

$("#containter .pmLink").click(function(){
	var url=$(this).attr("href");
	window.external.openUrl(url);
	return false;
})


function setState(proj_id,pnod_id,state,action,rowid)
{
	var rowId;
	var btn
	if(action=='proj_state')
	{
		rowId="proj_row_"+proj_id;
		var url='?c=project&a=setStateAjax&proj_id='+proj_id+'&state='+state;
	}
	else 
	{
		rowId="pnod_row_"+pnod_id;
		var url='?c=pnode&a=setState&proj_id='+proj_id+'&pnod_id='+pnod_id+'&state='+state;
	}
	if(rowid) rowId="row_"+rowid;
	switch(state)
	{
		case 10:
			btn=' .btnDone';
			break;
		case 15:
			btn=' .btnFinish';
			break;
		case 20:
			btn=' .btnPass';
			break;
		case 1000:
			btn=' .btnFinish';
			break;
	}
	$("#"+rowId+btn).hide("fast");
	$.get(url,function(msg){
				if(msg.rs==1)
				{
					$("#"+rowId+" .controler").prepend('<span class="controled">已经操作</span>');
				}
				else
				{
					alert(msg.des);
					$("#"+rowId+btn).show("fast");
				}
				},"json")
}