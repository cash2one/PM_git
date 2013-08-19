<?php /* Smarty version 2.6.26, created on 2013-07-12 15:00:41
         compiled from pg/user/myInformation.html */ ?>
<section class="clearfix myInfo-content">
    <div style="width: 960px;margin: 0 auto;background: #fff;background: linear-gradient(to top,#fff,#f2f2f2);margin-bottom: 30px;" class="clearfix">
        <img id="myImg" width="65" height="90" >
        <div class="myInfo">
            <h2><span class="user_nickname"></span>（<span class="user_name">Loading……</span>）</h2>
            <p class="clearfix item">
                <strong>职业:</strong><span class="job_name"></span>&nbsp;&nbsp;
                <strong>称谓:</strong><span class="title_name"></span>
            </p>
            <div class="clearfix item">
                <strong>等级进度：</strong>
                <div class="probar_com probar" id="probar">
                    <div class="probar_com probar_had" id="probar_had">

                    </div>
                </div>
            </div>
            <p class="clearfix item">
                <strong>经验值: </strong><span class="pg_user_exp"></span>
                <strong>贡献值: </strong><span class="pg_user_gongxian"></span>
            </p>
        </div>
    </div>
</section>
<script>
    getMyInfor();
    function getMyInfor()
    {
        $.ajax({
            url:'index.php?c=pguser&a=myInfor_axjx',
            type:'GET',
            success:function(data){
                var result = JSON.parse(data);
                var plv = result['baseInfor'];
                var unRead=result['unreadMsg'];
                $('.unread-msg').text(unRead);
                $("#myImg").attr("src","themes/images/userface/userface_"+plv['user_id']+".jpg");
                var totle = $("#probar").width();
                $("#probar_had").width((plv['job_lv_num']/5*totle).toFixed(0));
                var numS='<font>'+plv['job_lv_num']+'/5'+'</font>';
                $("#probar").append(numS);
                for(var key in plv){
                    $("."+key).html(plv[key]);
                }
                var tname = result['titleArray'];
                if(tname.length>0){
                    for(var key in tname){
                        $(".title_name").append(tname[key]['title_name']+";");
                    }
                }else{
                    $(".title_name").html('暂无')
                }
            },
            error:function(){
                alert('出错了！')
            }
        })
    }
</script>