$( function(){
    var table = $(".food-edit");
    var precens = table.find(".precen");

    var trs = table.find( "tbody tr");

    var checkbox,precen;
    trs.each( function(ix,ele){
        checkbox = $(this).find("input[type='checkbox']");
        precen = $(this).find(".precen");

        checkbox.click( function(){
            if( this.checked ){
                $(this).hide();
                this.checked = false;
                $(this).parent().find(".precen").show().focus().val("");
            }
        } );

        precen.blur( function(e){
            if( this.value<1 ){
                $(this).hide();
                this.value = 0;
                $(ele).removeClass("info");
                $(this).parent().find("input[type='checkbox']").show();
            }else{
                $(ele).addClass("info");
                $(this).parent().find("input[type='checkbox']").hide();
            }
        }).blur();

    } );

    precens.keyup( function(e){
        var sum = 0;

        precens.each( function(ix,ele){
            sum += Number(ele.value);
        } );

        if( sum > 100 ){
            this.value = this.value - (sum-100);
            sum = 100;
        }
        $(".table-number span").text( sum );
    }).keyup();

} );