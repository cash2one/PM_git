<?php /* Smarty version 2.6.26, created on 2014-02-17 14:18:42
         compiled from tool/participle.html */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>热点关键字工具Beta 1.0版</title>
    <link href="themes/boot/css/bootstrap.min.css" rel="stylesheet">
    <link href="themes/icheck/skins/flat/red.css" rel="stylesheet">
    <!-- <link type="text/css"  rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />-->
    <link type="text/css"  rel="stylesheet" href="http://go.nie.netease.com/css/css/jquery-ui.css" />

    <script src="themes/js/jquery19.js?<?php echo @RD; ?>
"></script>
    <script src="themes/boot/js/bootstrap.min.js"></script>
    <script src="themes/icheck/jquery.icheck.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>


    <style>
        body {
            font-family: microsoft yahei !important;
        }
        .bs-old-docs {
            padding: 12px 18px;
            color: #777;
            background-color: #FAFAFA;
            border-bottom: 1px solid #E5E5E5;
            border-top: 1px solid #E5E5E5;
            margin-bottom: 10px;
        }
        .bs-callout {
            margin: 20px 0;
            padding: 15px 30px 15px 15px;
            border-left: 5px solid #eee;
        }

        .bs-callout h4 {
            margin-top: 0;
            font-family: microsoft yahei;
        }

        .bs-callout p:last-child {
            margin-bottom: 0;
        }

        .bs-callout code,
        .bs-callout .highlight {
            background-color: #fff;
        }

            /* Themes for different contexts */
        .bs-callout-danger {
            background-color: #fcf2f2;
            border-color: #dFb5b4;
        }

        .bs-callout-warning {
            background-color: #fefbed;
            border-color: #f1e7bc;
        }

        .bs-callout-info {
            background-color: #f0f7fd;
            border-color: #d0e3f0;
        }

        .icheck-label {
            margin: 8px 5px 5px 12px;
            font-weight: normal;
        }
        #game-list .icheck-label{
            width: 97px;
        }
        .siteList-tip {
            margin-top: 8px;
        }

        .tab-content {
            margin-top: 20px;
        }

        a, a:hover {
            color: #c7254e;
        }

        .panel-title {
            font-size: 15px;
        }

        .btn-list {
            border-top: 1px solid #ddd;
            margin-top: 20px;
            padding-top: 20px;
        }

        .btn-list button {
            margin-left: 10px;
        }
            /*==jquery ui==*/
        .ui-datepicker .ui-datepicker-header {
            background-color: #31b0d5;
        }

        .ui-datepicker {
            border-color: #46b8da;
        }

        .ui-datepicker-calendar .ui-state-active {
            background-color: #31b0d5;
            border-color: #31b0d5;
            color: white;
        }

        .ui-datepicker-calendar .ui-state-hover {
            background-color: #31b0d5 !important;
            border-color: #31b0d5 !important;
            color: white !important;
        }
        .ui-datepicker-calendar .ui-state-default {
            background-color: #eeeeee;
            border-color: #eee;
            color: #777;
        }
        .ui-datepicker .ui-datepicker-prev-hover {
            left: 6px;
            top: 6px;
        }
        .ui-datepicker .ui-datepicker-next {
            right: 6px;
            top: 6px;
        }
        .ui-datepicker .ui-datepicker-prev {
            left: 6px;
            top: 6px;
        }

        .loading-box,.result-box{display: none;}
        #result{margin-top: 10px;}
        #result td{padding: 6px;}
        .icheckbox_flat-red, .iradio_flat-red{float: left;margin-right: 5px;}
        #chose-result .icheck-label{width:45%;margin-top: 10px;}
        .modal-title{font-family: microsoft yahei; margin: 10px;}
        .modal-dialog{padding-top: 40px;}
        #record-box{display: none;}
        #addsite-form .icheck-label{width: 120px;}
        #record-result{margin-top: 10px;}
        #record-result a{color: #46b8da;}
        .has-error .form-control{color: #B94A48;padding-right:12px;-webkit-animation:shock .35s linear;}
        @-webkit-keyframes shock{0%{opacity: 1}50%{opacity: .5}100%{opacity: 1}}
    </style>
</head>
<body>
<div class="container">
<div class="row">
    <div class="bs-callout bs-callout-danger">
        <h4>如何使用传说中的“热点关键词”工具？</h4>
        <p>热点关键字工具Beta 1.0版。系统默认已经配有几个主流站点，也可以通过下面的按钮添加其他站点的规则。也可以通过查看记录来看到每天的统计结果！<br>
        由于客观条件制约，此“玩具”假设在本人的机子上，所以运行速度肯定木有PM服务器的快，请给予耐心。</p>
        <p><a class="btn btn-danger btn-lg" data-toggle="modal" href="#addSite">添加更多站点!</a></p>
        <hr>
        <p style="line-height: 26px;"><span class="label label-info">2013-08-11</span>  基本功能已齐备。后续功能如用户体验提升，过滤指定关键词等待加入。  <span class="label label-warning">TODO</span> 过滤指定关键词。<br>
            <span class="label label-info">2013-08-12</span>  加入了页数查询条件，加入了黑名单限制，优化了输出结果的排序。  <span class="label label-warning">TODO</span> 查看记录部分优化<br>
            <span class="label label-info">2013-08-13</span>  完善了站点添加，完善了查询结果，暂时默认返回前50条查询记录。  <span class="label label-warning">TODO</span> 优化记录结果查看，优化规则添加方式<br>
            <span class="label label-info">2013-08-16</span> 自动识别页面编码！妈妈再也不用担心我的编码啦。  <span class="label label-warning">TODO</span>慢慢做，最近没时间完善 <br>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <ul class="nav nav-tabs" id="myTab">
            <li><a href="#typcial">高端接地气</a></li>
            <li><a href="#custom">文艺小清新</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="typcial">
                <div class="bs-old-docs">
                    <div class="container">
                        <strong>
                            Check your input!……
                        </strong>
                        请输入完整的信息。
                    </div>
                </div>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">选择游戏</label>

                        <div class="col-lg-10" id="game-list">
                            <?php $_from = $this->_tpl_vars['gamelist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
                            <label class="icheck-label">
                                <input type="radio" id="gameRadio<?php echo $this->_tpl_vars['rs']['game_id']; ?>
" value="<?php echo $this->_tpl_vars['rs']['game_id']; ?>
" name="gameRadio"><?php echo $this->_tpl_vars['rs']['game_name']; ?>

                            </label>
                            <?php endforeach; endif; unset($_from); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">选择网站</label>

                        <div class="col-lg-10">
                            <div class="siteList">
                                <p style="margin-top: 8px;margin-left: 12px;" id="chose-game">请先选择游戏</p>
                                <div id="chose-result"></div>
                                <!--
                                <label class="icheck-label">
                                    <input type="checkbox" id="siteRadio3" value="17173" name="siteCk"> 官方论坛
                                </label>

                                -->
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">选择类型</label>

                        <div class="col-lg-10">
                            <label class="icheck-label">
                                <input type="radio" id="typeRadio1" value="news" name="typeRadio" checked>新闻列表
                            </label>
                            <label class="icheck-label">
                                <input type="radio" id="typeRadio2" value="bbs" name="typeRadio"> 论坛首页
                            </label>
                        </div>
                    </div>
                    -->
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">过滤名单</label>

                        <div class="col-lg-10">
                            <input class="form-control"  id="filtr-list"  name="filtr-list" placeholder="用|隔开,同义词请以全称排序。如：梦幻西游|梦幻|官方论坛|论坛">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">返回列数</label>

                        <div class="col-lg-4">
                            <input class="form-control"  id="shagua-num" value="20">
                        </div>
                        <label for="" class="col-lg-2 control-label">抓取页数</label>

                        <div class="col-lg-4">
                            <input class="form-control"  id="pages-num" value="5">
                        </div>
                    </div>
                    <div class="form-group btn-list">
                        <div class="col-offset-2 col-lg-10">
                            <a class="btn btn-danger" id="shagua-go">马上分析</a>
                            <a class="btn btn-info show-record">查看记录</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="custom">
                <div class="bs-old-docs">
                    <div class="container">
                        <strong>
                            A little pity……
                        </strong>
                        若输入多个网址，请保证它们的编码都是同一的。
                    </div>
                </div>
                <form class="form-horizontal" id="custom-form">
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">基本链接</label>

                        <div class="col-lg-10">
                            <textarea class="form-control req" rows="5" id="baseLink" placeholder="例如:http://xyq.yzz.cn。如有页数规律，请按如下规则填写:http://xyq.netease.com/forumdisplay.php?fid=12&page={@}或http://bbs.yzz.cn/forum-32-{@}.html。这里的{@}将会被到时输入的页码取代。" name="baseLink"><?php echo $this->_tpl_vars['baseLink']; ?>
</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">抓取标识</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputEmail"
                                   placeholder="留空则抓取全文。如果你懂jQuery的话,可以填选择符例如 .news/#id" name="sign">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">过滤名单</label>

                        <div class="col-lg-10">
                            <input class="form-control"  id="filtr-list-advance"  name="filtr-list" placeholder="用|隔开,同义词请以全称排序。如：梦幻西游|梦幻|官方论坛|论坛">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">返回列数</label>

                        <div class="col-lg-4">
                            <input id="rowsNum" class="form-control" value="20" type="text"
                                   placeholder="如：20。则返回前20个关键词" name="showNum">
                        </div>
                        <label for="" class="col-lg-2 control-label">抓取页数</label>

                        <div class="col-lg-4">
                            <input id="pages-num-adv" class="form-control" value="5" type="text"
                                   placeholder="如：5。抓取前5页" name="pages-num">
                        </div>
                    </div>
                    <div class="form-group btn-list">
                        <div class="col-offset-2 col-lg-10">
                            <button id="go" class="btn btn-danger" type="">马上分析</button>
                            <a class="btn btn-info show-record">查看记录</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="col-lg-6">
        <div class="panel panel-danger" id="result-box">
            <div class="panel-heading">
                <h3 class="panel-title" style="font-family: microsoft yahei">返回结果</h3>
            </div>
            <div class="loading-box">
                <h4 style="font-family: microsoft yahei;font-size: 14px;color: #555">请闭眼倒数10秒...如睁眼还是这鸟样则可能服务器端挂了，请按F5...╮(╯▽╰)╭ </h4>

                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                </div>
            </div>

            <div class="result-box">
                <div class="input-group">
                    <span class="input-group-addon">你查询的网址</span>
                    <a href="#" class="form-control target-link" target="_blank"></a>
                </div>
                <div class="operate-box" style="margin: 10px 0;float: right;display: none;">
                    <a id="save-result" data-toggle="tooltip" data-placement="top" data-original-title="敬请期待" title="敬请期待">保存本次查询规则</a>
                </div>
                <div id="result"></div>
            </div>
        </div>
        <div class="panel panel-info" id="record-box">
            <div class="panel-heading">
                <h3 class="panel-title" style="font-family: microsoft yahei">查看记录</h3>
            </div>

            <div class="query-box">
                <div class="input-group">

                    <span class="input-group-addon">开始日期</span>

                    <input type="text" class="form-control record-time" id="start-time">
                    <span class="input-group-addon" style="border-left: 0;border-right:0">结束日期</span>
                    <input type="text" class="form-control record-time" id="end-time">

                </div>
                <button type="button" id="search-record" class="btn btn-info btn-lg btn-block"  data-toggle="tooltip" data-placement="top"  data-original-title="暂时默认返回前50条记录" style="margin: 10px auto;">选好时间了，马上给我查！\(^o^)/</button>
                <div class="loading-box">
                    <h4 style="font-family: microsoft yahei;font-size: 14px;color: #555">请闭眼倒数10秒...如睁眼还是这鸟样则可能服务器端挂了，请按F5...╮(╯▽╰)╭  </h4>

                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-info " style="width: 100%"></div>
                    </div>
                </div>
                <div id="record-result">

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal
================================================== -->
<div class="modal fade" id="addSite">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">添加站点</h4>
            </div>
            <div class="modal-body">
                <div class="progress progress-striped active" id="add-loading" style="display: none;">
                    <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                </div>
                <div class="alert alert-danger" style="display: none;padding: 10px 35px 10px 15px" id="add-result">
                    <p>操作成功！</p>
                </div>
                <div class="bs-old-docs">
                    <div class="container">
                        <strong>
                            Hmm...
                        </strong>
                        要添加新站点？
                    </div>
                </div>
                <form class="form-horizontal" id="addsite-form">
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">所属游戏</label>

                        <div class="col-lg-10">
                            <?php $_from = $this->_tpl_vars['gamelist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rs']):
?>
                            <label class="icheck-label">
                                <input type="radio" id="gameRadio<?php echo $this->_tpl_vars['rs']['game_id']; ?>
" value="<?php echo $this->_tpl_vars['rs']['game_id']; ?>
" name="gameRadio"><?php echo $this->_tpl_vars['rs']['game_name']; ?>

                            </label>
                            <?php endforeach; endif; unset($_from); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">页面描述</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control req" value="" id="add-des" name="des"
                                   placeholder="例如:官方论坛-梦幻杂谈；叶子猪-梦幻山庄" autocomplete="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">链接格式</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control req"  name="baseLink" id="add-link"
                                   placeholder="例如http://bbs.yzz.cn/forum-57-{@}.html" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">抓取标识</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control req" id="add-sign"
                                   placeholder="类jQuery语法,可以填选择符例如 .news/#id" name="sign">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="add-cancel">取消</button>
                <button type="button" class="btn btn-danger" id="addsite-btn" >确定添加</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



</div>


<script>
$(document).ready(function () {
    $('.record-time').val(moment().format('YYYY-MM-DD'));
    $('.record-time').datepicker({ dateFormat: "yy-mm-dd" });
    $('#save-result').tooltip();
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
    $('.show-record').click(function(){
        $('#result-box').hide();
        $('#record-box').show();
    });
    $('#myTab a:first').tab('show');
    $('input').iCheck({
        checkboxClass:'icheckbox_flat-red',
        radioClass:'iradio_flat-red'
    });
    function sortQuery(name){
        return function(o, p){
            var a, b;
            if (typeof o === "object" && typeof p === "object" && o && p) {
                a = parseInt(o[name],10);
                b = parseInt(p[name],10);
                if (a === b) {
                    return 0;
                }
                if (typeof a === typeof b) {
                    return a > b ? -1 : 1;
                }
                return typeof a > typeof b ? -1 : 1;
            }
            else {
                throw ("error");
            }
        }
    }
    function convertResult(data){
        var arrStep1=data.split('\n');
        var resultArr=[];
        arrStep1.shift();
        arrStep1.shift();
        arrStep1.shift();
        arrStep1.pop();
        arrStep1.pop();
        for(var i= 0,len=arrStep1.length;i<len;i++){
            var str=arrStep1[i],
                    obj={},
                    newArr=[];
            str=str.replace(/\(/g,' ');
            str=str.replace( /\s{1,}/g, "@");
            str=str.replace(/\)/g,'@')
            newArr=str.split('@');
            obj['No']=/*newArr[0]*/i+1;
            obj['Word']=newArr[1];
            obj['Attr']=newArr[2];
            obj['Weight']=newArr[3];
            obj['Times']=newArr[4];
            resultArr.push(obj);
        }
        console.log(resultArr);
        resultArr=resultArr.sort(sortQuery('Times'));
        return convertHtml(resultArr);
    }
    function convertHtml(arr){
        var resultHtml='<table class="table table-striped"><thead><tr><th>#</th><th>热词</th><th>出现次数</th></tr></thead><tbody>';
        for(var i= 0,len=arr.length;i<len;i++){
            resultHtml+='<tr><td>'+(i+1)+'</td><td>'+arr[i]['Word']+'</td><td>'+arr[i]['Times']+'</td></tr>'
        }
        resultHtml+='</tbody></table>';
        return resultHtml;
    }
    $('#go').on('click', function (e) {
        e.preventDefault();
        var check=true;
        var $texts=$('#custom-form').find('.req');
        $texts.each(function(){
            if($(this).val()==''){
                check=false;
                $(this).parent().addClass('has-error');
                $(this).val('请填写完整');
                $(this).focus(function(){
                    if($(this).val()=='请填写完整'){
                        $(this).val('');
                    }
                })
            }
        })
        if(!check){
            return false;
        }
        $('#result-box').show();
        $('#record-box').hide();
        var url = 'index.php?c=toolAtten&a=participleA';
        var data = $('#custom-form').serialize();
        var rowNum = parseInt($('#rowsNum').val(), 10) + 3;
        var link=($('#baseLink').val().indexOf('http://')!=-1)?$('#baseLink').val().replace('{@}',$('#pages-num-adv').val()):'http://'+$('#baseLink').val().replace('{@}',$('#pages-num-adv').val());
        $('.loading-box').show();
        $('.result-box').hide();
        $.ajax({
            type:"POST",
            url:url,
            data:data,
            success:function (result) {
                result = JSON.parse(result);
                result = result.re;
                if(result){
                    console.log(result);
                    var resultHTML=convertResult(result);
                    $('#result').html(resultHTML);
                    $('.loading-box').hide();
                    $('.result-box').show();
                    $('.target-link').attr('href',link).html(link);
                    $('.operate-box').show();
                }else{
                    $('#result').html('Sorry sir.这破东西太不给力了');
                }

            }
        });

    })
    $('#game-list input').on('ifChecked',function(event){
        //alert(event.type.replace('if', '').toLowerCase());
        $('#chose-game').show().html('<div class="progress progress-striped active" id="add-loading" style="width: 95%;margin-left: -12px;margin-bottom: 0;"><div class="progress-bar progress-bar-danger" style="width: 100%"></div></div>');
        $('#chose-result').hide();
        var value=$(this).val();
        $('#game-list input').iCheck('disable');
        $.get('index.php?c=toolAtten&a=yoyoGeturllist&gameid=1',{gameid:value},function(result){
            var html='';
            var data=JSON.parse(result);
            data=data.re;
            for(var i= 0,len=data.length;i<len;i++){
                html+='<label class="icheck-label"><input type="checkbox" data-url="'+data[i]['page_sign']+'" data-charset="'+data[i]['charset']+'"id="ck'+data[i]['gu_id']+'" value="'+data[i]['sign']+'" name="siteCk">'+data[i]['des']+'</label>';
            }
            $('#chose-game').hide();
            var show=(html=='')?$('#chose-game').show().html('该系列暂无数据,可以先试试梦幻，大话，藏地，或者点击上方添加'):$('#chose-result').show().html(html);
            $('#chose-result input').iCheck({
                checkboxClass:'icheckbox_flat-red'
            });
            $('#game-list input').iCheck('enable');
        })
    })

    $('#shagua-go').click(function(){
        $('.operate-box').hide();
        $('#result-box').show();
        $('#record-box').hide();
        var $list=$(':checkbox:checked');
        var test=$list.eq(0);
        var url = 'index.php?c=toolAtten&a=participleA';
        var data = $('#custom-form').serialize();
        var link=test.data('url');
        $('#result-box .loading-box').show();
        $('.result-box').hide();
        $.ajax({
            type:"POST",
            url:url,
            data:{
                baseLink:test.data('url'),
                sign:test.val(),
                showNum:$('#shagua-num').val(),
                'page-num':$('#pages-num').val(),
                'filtr-list':$('#filtr-list').val(),
                type:1
            },
            success:function (result) {
                result = JSON.parse(result);
                result = result.re;
                if(result){
                    var resultHTML=convertResult(result);
                    $('#result').html(resultHTML);
                    $('#result-box .loading-box').hide();
                    $('.result-box').show();
                    $('.target-link').attr('href',link.replace('{@}',$('#pages-num').val())).html(link.replace('{@}',$('#pages-num').val()));
                }else{
                    $('#result').html('Sorry sir.这破东西太不给力了');
                    $('#result-box .loading-box').hide();
                }
            }
        });
    })

    $("#addsite-btn").click(function(){
        var that=$(this);
        var check=true;
        var $texts=$('#addSite').find('.req');
        $texts.each(function(){
            if($(this).val()==''){
                check=false;
                $(this).parent().addClass('has-error');
                $(this).val('请填写完整');
                $(this).focus(function(){
                    if($(this).val()=='请填写完整'){
                        $(this).val('');
                    }
                })
            }
        })
        if(!check){
            return false;
        }
        var url = 'index.php?c=toolAtten&a=yoyoAddsite';
        var data = $('#addsite-form').serialize();
        $("#add-loading").show();
        $.ajax({
            type:"POST",
            url:url,
            data:data,
            success:function (result) {
                result = JSON.parse(result);
                result = result.status;
                $("#add-loading").hide();
                if(result==200){
                    $('#add-result').show();
                    $('#addsite-form').find('input:text').val('');
                    setTimeout(function(){
                        $('#add-result').fadeOut();
                    },3000);
                }else{
                    $('#add-result').html('Sorry sir.这破东西太不给力了');
                }

            }
        });
    });

    $('#search-record').click(function(){
        var url = 'index.php?c=toolAtten&a=yoyoRecord';
        $('#record-box .loading-box').show();
        $.ajax({
            type:"POST",
            url:url,
            data:{
                startTime:$('#start-time').val(),
                endTime:$('#end-time').val()
            },
            success:function (result) {
                result = JSON.parse(result);
                status = result.status;
                $("#add-loading").hide();
                if(status==200){
                    var arr=result.re;
                    var resultHtml='<table class="table table-striped"><thead><tr><th>#</th><th>统计页面</th><th>日期</th></tr></thead><tbody>';
                    if(arr.length>0){
                        for(var i= 0,len=arr.length;i<len;i++){
                            resultHtml+='<tr><td>'+(i+1)+'</td><td><a href="#" >'+(arr[i]['record_url'].indexOf('http://')==-1?"http://"+arr[i]['record_url']:arr[i]['record_url'])+'</a></td><td>'+moment(arr[i]['Times']).format('YYYY-MM-DD')+'</td></tr>'
                        }
                        resultHtml+='</tbody></table>';
                    }else{
                        resultHtml='<p>(￣▽￣") 木有这个时间段里的数据哟。</p>'
                    }
                    $('#record-result').show().html(resultHtml);
                    $('#record-box .loading-box').hide();

                }else{
                    $('#record-result').html('Sorry sir.这破东西太不给力了');
                    $('#record-box .loading-box').hide();
                }

            }
        });
    })

});
</script>
</body>
</html>