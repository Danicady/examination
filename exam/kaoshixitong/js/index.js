var token=window.localStorage.getItem('token');
//得到题型
var kk=0;
function Course(course) {
    $.ajax({
        url:' http://10.195.7.51:9090/Examination/exam/examination/front/chooseQues.php',
        type:'post',
        dataType:'json',
        data:{
            course:course,
        },
        success:function (data) {
            $("input[type='checkbox']").click(function () {
               if($(this).is(':checked')&&kk===0){

                   console.log(data);
                   for(var i=0;i<data.length;i++)
                   {
                       $(".right_top").append('   <div class="type1 clearfix">\n' +
                           '                <p class="type"><span>'+data[i]+'</span></p>\n' +
                           '                <div class="set">\n' +
                           '                    <p class="num">数量:<input type="number"></p>\n' +
                           '                    <p class="grade">每题分数：<input type="number"></p>\n' +
                           '                </div>\n' +
                           '            </div>');
                   }
                   kk=1;

               }
            })

            $(".img").click(function () {
                $(".right_top").slideUp('1000');

                setTimeout(function () {

                    window.location.href='index.html';
                },400);

            })
        },error:function (data) {
            console.log(data);
        }
    })
}

//logout
function Logout() {
    $(".btn-lg").click(function () {
        $.ajax({
            url:' http://10.195.7.51:9090/Examination/exam/examination/front/layout.php?token='+token,
            type:'get'
            ,success:function (data) {
                console.log(data);
                alert(data);
                window.location.href='login.html';
            },error:function (data) {
                console.log(data);
                alert(data);
            }
        })
    })
}
//主页方法
function Index() {
    //班级
    var arr=new Array();


    $.ajax({
        url:'http://10.195.7.51:9090/Examination/exam/examination/front/index.php?token='+token,
        type:'get',
        dataType:'json',
        success:function (data) {
            console.log(data);
            $(".number p span").text(data[0][0].userID);
            for(var i=0;i<data.length;i++)
            {
                $(".first").append('  <li class="first_one"><p>'+data[i][0].course+' <img class="img" id="'+i+'" src="image/timg_down.png" alt=""></p>\n' +
                    '                <ul class="second"></ul>\n' +
                    '            </li>');
                for(var j=1;j<=data[i][0].unitnum;j++){
                        $(".first .second").eq(i).append('  <li><p>'+j+' 单元</p> <input class="'+j+'" type="checkbox" id="check"></li>\n');

                }
                arr[i]=new Array();
                for(var j=0;j<data[i].length;j++)
                {
                   arr[i][j]=data[i][j].class;

                }
            }
            console.log(arr);

        },error:function (data) {
            console.log(data);
        }
    })
    //选择的单元
    var unit=new Array();
    //点击
var flag=0;
    $(".first").click(function (e) {
        var el=e||window.event;
        var src=el.target||el.srcElement;
        if(src.className==='img') {
            var id = src.id;
            var srcEle=src.parentNode;
            var course=$(srcEle).text();
            window.localStorage.setItem('course',course);
            $(".second").eq(id).slideToggle(300);
            $(".first_one:eq(id) p img").attr('src', 'image/timg_down.png');
            $('#className').append('<option value="">请选择</option>\n');
            if (flag === 0) {
                Course(course);
                for (var j = 0; j < arr[id].length; j++)
                    $('#className').append('<option value='+ arr[id][j] +'>' + arr[id][j] + '</option>\n');
                flag = 1;
            }
            else if(flag===1){
              for(var j=1;j<=arr[id].length;j++)
                  $('#className option').remove();
                flag = 0;
            }
        }
            if (src.type === 'checkbox') {
                unit.push(src.className);
                window.localStorage.setItem('unit', unit);
                $(".right_top").slideDown('300');
            }
    })
    //生成试卷
    Product();
    //预览
    Preview();
    //下载
    Download();
}
//login
function Login() {
    $(".btn-lg").click(function () {
        var $userID=$("input:eq(0)").val();
        var $password=$("input:eq(1)").val();
        var check=$(".check");
        var checkval='';
        if(check.is(":checked"))
            check.val(1);
        if($userID===''||$password==='')
            alert("不能为空");
        else {
            checkval=check.val();
            $.ajax({

                url:'http://10.195.7.51:9090/Examination/exam/examination/front/login.php',
                type:'post',
                cache:false,
                data:{
                    userID:$userID,
                    password:$password,
                    autoFlag:checkval,
                },success:function (data) {
                    console.log(data);
                    alert("登录成功！");
                    window.localStorage.setItem('token',data);
                    window.location.href='index.html?token='+data;
                },error:function (data) {
                    console.log(data.responseText);
                    if(data.responseText==='已登录！')
                    {
                        alert("已登录！");

                        $.ajax({
                            url:' http://10.195.7.51:9090/Examination/exam/examination/front/relogin.php',
                            type:'post',
                            data:{
                                userID:$userID,
                                password:$password,
                            },
                            success:function (data) {
                                console.log(data);
                                window.localStorage.setItem('token',data);
                               window.location.href='index.html?token='+data;
                            },
                            error:function (data) {
                                console.log(data);
                            }
                            }
                        );


                    }
                    else
                    alert("登录失败!"+data.responseText);
                }

            })
        }

    })
}

//生成
function Product(){

    $("#btn-produce").click(function () {
        var level=$("#level").val();//难易程度
        var chioceClass=$("#className").val();//选择的班级
        var unit=window.localStorage.getItem('unit');//选择的单元
        var course=window.localStorage.getItem('course');//选择的科目
        var type=[];//题型
        var typeLength=$(".type1").length;
        var nature=$("#nature").val();//试卷性质
        var testTime=$(".time").val();//考试时间
        for(var i=0;i<typeLength;i++)
        {
            var row={};
            row.course=$(".type span").eq(i).text().trim();
            row.num=$(".num input").eq(i).val().trim();
            row.grade=$(".grade input").eq(i).val().trim();
            type.push(row);
        }


        console.log(type);
        if(level===''||chioceClass===''||nature===''||testTime==='')
        {
            alert("请选填全部信息！");
        }else {
            $.ajax({
                url:' http://10.195.7.51:9090/Examination/exam/examination/front/paper.php?token='+token,
                type:'post',
                dataType:'json',
                data:{
                    course:course,
                    level:level,
                    chioceClass:chioceClass,
                    unit:unit,
                    type:type,
                    nature:nature,//试卷性质
                    testTime:testTime,//考试时间
                },
                success:function (data) {
                    console.log(data);
                    window.localStorage.setItem('id',data);
                    alert("生成试卷成功！请点击预览查看");

                    },
                error:function (data) {
                    console.log(data);

                }
            })
        }
    })
}

//预览
function Preview(){

    $("#btn-preview").click(function () {
        var id=window.localStorage.getItem('id');
        if(id)
        {
            $.ajax({
                url:' http://10.195.7.51:9090/Examination/exam/examination/front/preview.php?id='+id,
                type:'get',
                success:function (data) {
                    console.log(data);
                    window.location.href=data;
                    alert("预览成功");
                },
                error:function (data) {
                    console.log(data);

                }
            })
        }
        else {
            alert("请先生成试卷");
        }
    })
}

//下载
function Download(){

    $("#btn-download").click(function () {
        var id=window.localStorage.getItem('id');
        if(id)
        {
            location.href=' http://10.195.7.51:9090/Examination/exam/examination/front/download.php?id='+id;
            alert("下载成功！");
        }
        else {
            alert("请先'生成'试卷");
        }
    })
}