var Stars = (function($){

    const init = function() {

        const container = $(".stars-rating");

        if (!container.length) return;

        container.find("span").on("click", function(){

            let value = $(this).data("value");
            $("#evaluation").val(value);

            container.find("span").each(function(){
                if($(this).data("value") <= value){
                    $(this).addClass("active").text("★");
                } else {
                    $(this).removeClass("active").text("☆");
                }
            });

        });
    };

    return {
        init: init
    };

})(jQuery);
