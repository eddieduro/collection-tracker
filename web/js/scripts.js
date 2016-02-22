$(document).ready(function(){
    $('#shiabtn').click(function(event){
        event.preventDefault();
        $(this).closest("div").addClass('shia');
        $('#doit').removeClass('hideme');
        $(this).addClass('hideme');
    });
});
