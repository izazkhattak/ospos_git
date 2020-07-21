jQuery(document).ready(function(){
$("#sidebarCollapse").click(function(){
$(".navbar.navbar-default").toggleClass("toggle-sidebar");
});
$("#sidebarCollapse").click(function(){
    $(".container.main_content").toggleClass("toggle-sidebar-content");
    });
    $("#sidebarCollapse").click(function(){
        $("a.navbar-brand").toggleClass("toggle-sidebar");
    });
    $("#sidebarCollapse").click(function(){
        $("#sidebarCollapse").toggleClass("toggle-sidebar");
    });
    $("#sidebarCollapse").click(function(){
        $(".navbar-center").toggleClass("toggle-sidebar");
    });

    $("#sidebarCollapse").click(function(){
        $(".container.main_content").animate({left:"250px"},1000);
    });

});
