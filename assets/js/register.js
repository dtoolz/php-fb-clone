$(document).ready(function(){
    //on click signup, hide login form
    $("#signup").click(function(){
        $("#first").slideUp("slow", function(){
            $("#second").slideDown("slow");
        });
    });
    
    //on click login, hide signup form
    $("#signin").click(function(){
        $("#second").slideUp("slow", function(){
            $("#first").slideDown("slow");
        });
    });
});