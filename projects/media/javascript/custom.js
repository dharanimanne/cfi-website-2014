$(document).ready(function(){
	$('#menu .menuCollapse').on('show.bs.collapse', function()
	{
		$(this).parents('.hasSubmenu:first').addClass('active');
	})
	.on('hidden.bs.collapse', function()
	{
		$(this).parents('.hasSubmenu:first').removeClass('active');
	});
});