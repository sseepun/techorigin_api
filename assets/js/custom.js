$(".scrollbar-inner")[0] && $(".scrollbar-inner").scrollbar().scrollLock();

$('.notify .dropdown-menu').click(function(e) {
   e.stopPropagation();
});
function cls(){
   //$('.notify .dropdown-menu').dropdown("hidden.bs.dropdown");
}