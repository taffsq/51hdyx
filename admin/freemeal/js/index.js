
//弹出面板
function Alert_Panel(){
    var _aler;

    //打开时，类型参数，还有参数列表
    this.open = function( type,arg ){
        _aler = $(".bs-example-modal-sm");

        _aler.find('.modal-title').text(arg.tit);
        _aler.find('.modal-body').text( arg.des );
        _aler.modal('show');
        switch( type ){
            case 0:
                _aler.find('.modal-footer').hide();
                break;
            case 1:
                _aler.find('.modal-footer').show();
                _aler.find('.btn-primary').unbind("click").click( function(e){
                    _aler.modal('hide');
                    arg.fun();
                } );
                break;
        }

    }

}

var alertPanel;
function init() {
    alertPanel = new Alert_Panel();
    //alertPanel.open( 0,{tit:"标题",des:"你来参加？"} );

    //主菜单点击，切换界面
    $(".leftpanel .leftmenu ul > li > a").click(function () {
        var par = $(this).parent();

        if (par.hasClass("active")) return;
        else par.addClass("active").siblings().removeClass("active");

        var url = $(this).attr("data-type");
        if (url && url.length > 1)
            $(".main-frame").attr("src", url);
    });

    //默认active的点击
    var _acti = $(".leftpanel .leftmenu .dropdown .active");
    _acti.removeClass("active");
    _acti.find("a").click();

    //主菜界面显示效果
    $('.leftmenu .dropdown > a').click(function () {
        if (!$(this).next().is(':visible')) {
            $(this).find(".glyphicon-th-large").attr("class", "glyphicon glyphicon-th");
            $(this).find(".glyphicon-menu-up").attr("class", "glyphicon glyphicon-menu-down");
            $(this).next().slideDown('fast');
        } else {
            $(this).find(".glyphicon-th").attr("class", "glyphicon glyphicon-th-large");
            $(this).find(".glyphicon-menu-down").attr("class", "glyphicon glyphicon-menu-up");
            $(this).next().slideUp('fast');
        }
    }).first().click();

    //form中的自定义菜单转换
    $(".select-drop-down").each(function (ix, ele) {
        var tar = $(ele);
        var btn;
        tar.find("li").click(function (e) {
            btn = tar.find(".btn");

            btn.text($(this).text());
            btn.attr("data-info", $(this).attr("data-info"));
        });
    });

    //初始化预览框
    $('[data-toggle="popover-img"]').popover({
        content: function () {
            return '<img src="' + $(this).attr("data-img-url") + '"/>';
        }, html: true, trigger: 'hover'
    });
    $('[data-toggle="popover"]').popover({trigger: 'hover'});


    $("button.reload").click(function () {
        window.location.reload();
    })
}

function check_all(obj,cName) {
    var checkboxs = document.getElementsByName(cName);
    for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;}
}

function formChange( form ){
    //将form表中的自定义属性添加上属性
    var ele = $(form).find(".form-item");

    var info;
    ele.each( function( ix,ele ){
        info = $(ele).attr("data-info");
        if( info && info.length>0 ){
            form[$(ele).attr("data-form-name")].value = info;
        }
    } );
}

$(function(){
    init();

    $(".act-edit-main .form-a").click( function(){
        $(".act-edit-main form").submit();
        console.log("submit");
    } );
})