// home imgaes slider interactivity
$(document).ready(function(){

    var color = ['#4084bb', '#4CCFAC', '#a0c041'];
    var teller = 0;
    if($(".date-wrap")){

        $(".date-wrap").each(function(key, value){
            $(this).css({'background': color[teller]});
            // temporaty check statement
            teller++;
            if(teller >= 3){
                teller = 0;
            }

        });

        $(".unique-btn").each(function(key, value){
            $(this).css({
                'border-bottom': " 2px solid " + color[key],
                'color': color[key],
                'border-color': color[key]
            });

            $(this).hover(function(){
                $(this).css({
                    'background': color[key],
                    'color': 'white',
                });
            }, function(){
                $(this).css({
                    'background': 'transparent',
                    'color': color[key],
                });
            })
            if(key >= 3){
                key = 0;
            }
        });

    }
});
