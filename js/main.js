jQuery(document).ready(function($) {

	'use strict';


	/************** Toggle *********************/
    // Cache selectors
    var lastId,
        topMenu = $(".menu-first, .menu-responsive"),
        topMenuHeight = topMenu.outerHeight()+15,
        // All list items
        menuItems = topMenu.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
          var item = $($(this).attr("href"));
          if (item.length) { return item; }
        });

    // Bind click handler to menu items
    // so we can get a fancy scroll animation
    menuItems.click(function(e){
      var href = $(this).attr("href"),
          offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
      $('html, body').stop().animate({
          scrollTop: offsetTop
      }, 300);
      e.preventDefault();
    });

    // Bind to scroll
    $(window).scroll(function(){
       // Get container scroll position
       var fromTop = $(this).scrollTop()+topMenuHeight;

       // Get id of current scroll item
       var cur = scrollItems.map(function(){
         if ($(this).offset().top < fromTop)
           return this;
       });
       // Get the id of the current element
       cur = cur[cur.length-1];
       var id = cur && cur.length ? cur[0].id : "";

       if (lastId !== id) {
           lastId = id;
           // Set/remove active class
           menuItems
             .parent().removeClass("active")
             .end().filter("[href=#"+id+"]").parent().addClass("active");
       }
    });



    $(window).scroll(function(){
         $('.main-header').toggleClass('scrolled', $(this).scrollTop() > 1);
     });



    $('a[href="#top"]').click(function(){
        $('html, body').animate({scrollTop: 0}, 'slow');
        return false;
    });


    $('.flexslider').flexslider({
      slideshow: true,
      slideshowSpeed: 3000,
      animation: "fade",
      directionNav: false,
    });


    $('.toggle-menu').click(function(){
        $('.menu-responsive').slideToggle();
        return false;
    });


    /************** LightBox *********************/
      $(function(){
        $('[data-rel="lightbox"]').lightbox();
      });

		/**********Contact Form Submit*************/

		$('#contactform').on("submit", function(e){
			e.preventDefault();
			var name = $("#name").val();
			var email = $("#email").val();
			var subject = $("#subject").val();
			var message = $("#message").val();
			$("#returnmessage").empty();
			// Checking for blank fields.
			if (name == '' || email == '' || subject == '') {
				alert("Please Fill Required Fields");
			} else {
			// Returns successful data submission message when the entered information is stored in database.
				$.post("contact_form.php", {
				name1: name,
				email1: email,
				subject1: subject,
				message1: message
				}, function(data) {
					$("#returnmessage").append(data); // Append returned message to message paragraph.
					if (data == "Thank you for reaching out! I will be in touch soon.") {
						$("#form")[0].reset(); // To reset form fields on success.
					};
				});
			};
		});


});
