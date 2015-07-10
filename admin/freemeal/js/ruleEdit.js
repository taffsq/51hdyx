function ShareTable(){
    var table = $(".rule-table");
    var tBody = table.find("tbody");

    $(".add-rule").click( function(s){
        appendTr();
    } );

    function appendTr(){
        tBody.append(
            '<tr>'+
                '<td class="remove-rule">'+
                    '<a href="javascript:void(0)">'+
                        '<span class="glyphicon glyphicon-remove"></span>删除'+
                    '</a>'+
                '</td>'+
                '<td class="rule-ix">'+(tBody.find("tr").length+1)+'、</td>'+
                '<td>'+
                    '<textarea name="ruledetail[]"></textarea>'+
                '</td>'+
            '</tr>'
        )

        eventTr( tBody.find('tr').last() ) ;

    }

    function eventTr( tr ){
        tr.find(".remove-rule").click(function(e){
            alertPanel.open(1,{tit:"警告！",des:"确定删除？",fun: function(){ removeTr( tr )} });
        });
    }

    function removeTr( tr ){
        tr.remove();

        tBody.find('.rule-ix').each( function(ix,ele){
            $(this).text(ix+1+'、');
        } );
    }

    function init(){
        tBody.find('tr').each( function(ix,ele){
            eventTr( $(ele) );
        } );
    }

    init();
}

$(function(){
    new ShareTable();
})