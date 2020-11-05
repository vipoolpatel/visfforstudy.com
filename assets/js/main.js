(function ($) {
	'use strict';

	jQuery(document).ready(function ($) {
		/* -------------------------
		condition to show "scroll to top" button on window scroll
		------------------------- */
		$(window).scroll(function () {
			if ($(this).scrollTop() > 300) {
				$('#scrollTop').fadeIn();
			} else {
				$('#scrollTop').fadeOut();
			}
		});
		// scroll up function
		$('#scrollTop').click(function () {
			$('html, body').animate({ scrollTop: 0 }, 500);
		});

		/* -------------------------
		profile hero sticky menu
		------------------------- */
		class StickyNavigation {
			constructor() {
				this.currentId = null;
				this.currentTab = null;
				this.tabContainerHeight = 70;
				let self = this;
				$('.hero-menu-tab').click(function () {
					self.onTabClick(event, $(this));
				});
				$(window).scroll(() => {
					this.onScroll();
				});
				$(window).resize(() => {
					this.onResize();
				});
			}

			onTabClick(event, element) {
				event.preventDefault();
				let scrollTop =
					$(element.attr('href')).offset().top -
					this.tabContainerHeight +
					1;
				$('html, body').animate({ scrollTop: scrollTop }, 600);
			}

			onScroll() {
				this.checkTabContainerPosition();
				this.findCurrentTabSelector();
			}

			onResize() {
				if (this.currentId) {
					this.setSliderCss();
				}
			}

			checkTabContainerPosition() {
				let offset =
					$('.hero-main-content').offset().top +
					$('.hero-main-content').height() -
					this.tabContainerHeight;
				if ($(window).scrollTop() > offset) {
					$('.hero-menu-tabs-container').addClass(
						'hero-main-content--top'
					);
				} else {
					$('.hero-menu-tabs-container').removeClass(
						'hero-main-content--top'
					);
				}
			}

			findCurrentTabSelector(element) {
				let newCurrentId;
				let newCurrentTab;
				let self = this;
				$('.hero-menu-tab').each(function () {
					let id = $(this).attr('href');
					let offsetTop =
						$(id).offset().top - self.tabContainerHeight;
					let offsetBottom =
						$(id).offset().top +
						$(id).height() -
						self.tabContainerHeight;
					if (
						$(window).scrollTop() > offsetTop &&
						$(window).scrollTop() < offsetBottom
					) {
						newCurrentId = id;
						newCurrentTab = $(this);
					}
				});
				if (this.currentId != newCurrentId || this.currentId === null) {
					this.currentId = newCurrentId;
					this.currentTab = newCurrentTab;
					this.setSliderCss();
				}
			}

			setSliderCss() {
				let width = 0;
				let left = 0;
				if (this.currentTab) {
					width = this.currentTab.css('width');
					left = this.currentTab.offset().left;
				}
				$('.hero-menu-tab-slider').css('width', width);
				$('.hero-menu-tab-slider').css('left', left);
			}
		}
		new StickyNavigation();

		/* -------------------------
		one page scroll active menu link (optional)
		------------------------- */
		var sections = jQuery('section'),
			nav = jQuery('nav'),
			nav_height = nav.outerHeight();

		jQuery(window).on('scroll', function () {
			var cur_pos = jQuery(this).scrollTop();

			sections.each(function () {
				var top = jQuery(this).offset().top - nav_height,
					bottom = top + jQuery(this).outerHeight();

				if (cur_pos >= top && cur_pos <= bottom) {
					nav.find('a').removeClass('current');
					sections.removeClass('current');

					jQuery(this).addClass('current');
					nav.find(
						'a[href="#' + jQuery(this).attr('id') + '"]'
					).addClass('current');
				}
			});
		});

		/* -------------------------
		profile hero mobile menu button
		------------------------- */
		$('#mobile-menu-opener').click(function () {
			$('.hero-menu-tabs-container').css('right', '0');
			$(this).fadeOut('300');
		});
		$('#mobile-menu-closer').click(function () {
			$('.hero-menu-tabs-container').css('right', '-200%');
			$('#mobile-menu-opener').fadeIn('300');
		});

		/* -------------------------
		logged in mobile menu button
		------------------------- */
		$('#loggedin-menu-opener').click(function () {
			$('.loggedin-menu-cont').css('right', '0');
			$(this).fadeOut('100');
			$('#loggedin-menu-closer').fadeIn('250');
		});
		$('#loggedin-menu-closer').click(function () {
			$('.loggedin-menu-cont').css('right', '-200%');
			$('#loggedin-menu-closer').hide();
			$('#loggedin-menu-opener').fadeIn('200');
		});
		$('.main-menu li a').click(function () {
			$('.loggedin-menu-cont').css('right', '-200%');
			$('#loggedin-menu-closer').hide();
			$('#loggedin-menu-opener').fadeIn('200');
		});

		/* -------------------------
		logged in user options popup
		------------------------- */
		$('.user-status .user-options-toggler').on('click touch', function (
			event
		) {
			event.preventDefault();
			$('#user-options-pop-wrap').fadeToggle(200);
		});
		// hide it when clicking anywhere else except the popup and the trigger
		$(document).on('click touch', function (event) {
			if (
				!$(event.target)
					.parents()
					.addBack()
					.is('.user-status .user-options-toggler')
			) {
				$('#user-options-pop-wrap').fadeOut(200);
			}
		});
		/* -------------------------
		profile hero sticky mobile menu button
		------------------------- */
		$(window).scroll(function () {
			var $w = $(this),
				header = $('.sticky-head'); //use this class to the element to make sticky

			if ($w.scrollTop() > 455) {
				if (!header.hasClass('scrolled')) {
					$('.sticky-head').addClass('scrolled');
				}
			}
			if ($w.scrollTop() < 455) {
				if (header.hasClass('scrolled')) {
					$('.sticky-head').removeClass('scrolled sticky-sleep');
				}
			}
		});

		/* -------------------------
		smooth scrolling to id
		------------------------- */
		var mySmoothScroll = function () {
			$('.scrolls').on('click', function (e) {
				//use the "scrolls" class to <a> to initiate
				var target = this.hash,
					$target = $(target);

				e.preventDefault();
				e.stopPropagation();

				$('html, body')
					.stop()
					.animate(
						{
							scrollTop: $target.offset().top - 70,
						},
						800,
						'swing'
					)
					.promise()
					.done(function () {
						// check if menu is open
						// if ($('body').hasClass('menu-is-open')) {
						//     $('.header-menu-toggle').trigger('click');
						// }

						window.location.hash = target;
					});
			});
		};
		mySmoothScroll();

		/* -------------------------
		jquery date range picker (book lesson calendar)
		------------------------- */
		$('#book-date').dateRangePicker({
			inline: true,
			container: '#date-picker-box',
			alwaysOpen: true,
			singleMonth: true,
			showShortcuts: false,
			showTopbar: false,
			monthSelect: true,
			yearSelect: true,
			startOfWeek: 'monday',
			customArrowPrevSymbol: '<i class="fas fa-chevron-left"></i>',
			customArrowNextSymbol: '<i class="fas fa-chevron-right"></i>',
			// format: 'YYYY-MM-DD',
			// separator: ' - ',
		});


		$('#book-sesson-date').dateRangePicker({
			inline: true,
			container: '#date-lesson-box',
			alwaysOpen: true,
			singleMonth: true,
			showShortcuts: false,
			showTopbar: false,
			monthSelect: true,
			yearSelect: true,
			startOfWeek: 'monday',
			customArrowPrevSymbol: '<i class="fas fa-chevron-left"></i>',
			customArrowNextSymbol: '<i class="fas fa-chevron-right"></i>',
			// format: 'YYYY-MM-DD',
			// separator: ' - ',
		});

		/* -------------------------
		jquery multiple date picker (course calendar)
		------------------------- */
		var date = new Date();
		$('#course-calendar').multiDatesPicker({
				dateFormat: 'yy-mm-dd',
				onSelect: function (selectedDate) {
					$('#altField').val(selectedDate);
					$('#getLessonDate').html(selectedDate);
					$('#HomeWorkModal').modal('show');
				}
		});


		/* -------------------------
		maginific popup video
		------------------------- */
		$('.video-pop-btn').magnificPopup({
			type: 'video',
		});

		/* -------------------------
		dynamically shorten long text with a "... more" btn (like jquery shorten plugin)
		------------------------- */
		var showChar = 80;
		$(window).width(); // returns width of browser viewport
		var charWidth = $(window).width();
		if (charWidth < 991.98 && charWidth > 767) {
			var showChar = 42;
		}
		var ellipsestext = '...';
		var moretext = 'See more';
		var lesstext = 'See less';
		$('.more').each(function () {
			var content = $(this).html();

			if (content.length > showChar) {
				var c = content.substr(0, showChar);
				var h = content.substr(showChar - 1, content.length - showChar);

				var html =
					c +
					'<span class="moreellipses">' +
					ellipsestext +
					'&nbsp;</span><span class="morecontent"><span>' +
					h +
					'</span>&nbsp;<a href="" class="morelink">' +
					moretext +
					'</a></span>';

				$(this).html(html);
			}
		});

		// longer character to show
		var showCharLong = 200;
		$('.moreLong').each(function () {
			var content = $(this).html();

			if (content.length > showCharLong) {
				var c = content.substr(0, showCharLong);
				var h = content.substr(
					showCharLong - 1,
					content.length - showCharLong
				);

				var html =
					c +
					'<span class="moreellipses">' +
					ellipsestext +
					'&nbsp;</span><span class="morecontent"><span>' +
					h +
					'</span>&nbsp;<a href="" class="morelink">' +
					moretext +
					'</a></span>';

				$(this).html(html);
			}
		});

		$('.morelink').click(function () {
			if ($(this).hasClass('less')) {
				$(this).removeClass('less');
				$(this).html(moretext);
			} else {
				$(this).addClass('less');
				$(this).html(lesstext);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});

		/* -------------------------
		add/remove subject fields on button click
		------------------------- */
		var subject_max_fields = 5000; //maximum input boxes allowed
		var subject_wrapper = $('#subject-fields-wrap'); //Fields wrapper
		var add_subject_button = $('#add-subject-btn'); //Add button ID

		var sub_count = 1; //initlal text box count
		$(add_subject_button).click(function (e) {
			//on add input button click
			e.preventDefault();
			if (sub_count < subject_max_fields) {
				//max input box allowed
				sub_count++; //text box increment
				$(subject_wrapper).append(
					'<div class="additional-field with-btn"><input type="text" name="subject_name[]" class="form-control" required placeholder="Subject"/><a href="#" class="button remove-field">&minus;</a></div>'
				); //add input box
			} else {
				alert('Max number reached.');
			}
		});
		// on remove button click
		$(subject_wrapper).on('click', '.remove-field', function (e) {
			//user click on remove text
			e.preventDefault();
			$(this).parent('div').remove();
			sub_count--;
		});

		/* -------------------------
		add/remove time fields on button click
		------------------------- */
		var time_max_fields = 5000;
		var time_wrapper = $('#time-fields-wrap');
		var add_time_button = $('#add-time-btn');

		var time_count = 1;
		$(add_time_button).click(function (e) {
			e.preventDefault();
			if (time_count < time_max_fields) {
				time_count++;
				$(time_wrapper).append(
					'<div class="additional-field  with-btn form-check-inline"><input required style="padding: 0px;padding-left: 10px;" type="time" name="lesson_time[]" class="time-from form-control text-left"/><span class="time-picker-separator">&amp;</span><input type="text" name="duration[]" class="course-duration form-control" required placeholder="Duration(60 Minutes)"><a href="#" class="button remove-field">&minus;</a></div>'
				);
			} else {
				alert('Max number reached.');
			}
		});
		// on remove button click
		$(time_wrapper).on('click', '.remove-field', function (e) {
			e.preventDefault();
			$(this).parent('div').remove();
			time_count--;
		});

		/* -------------------------
		open chat popup on chat menu click
		------------------------- */
		$('.main-menu li .chat-link').click(function (e) {
			e.preventDefault();
			$('#chatPopup').addClass('show');
		});
		$('.chat-pop-close').click(function () {
			$('#chatPopup').removeClass('show');
		});
		// var totalWidth = $(window).width();
		// if (totalWidth > 767.98) {
		// 	$('.main-menu li .chat-link').click(function (e) {
		// 		e.preventDefault();
		// 		$('#chatPopup').addClass('show');
		// 	});
		// 	$('.chat-pop-close').click(function () {
		// 		$('#chatPopup').removeClass('show');
		// 	});
		// }

		/* -------------------------
		open add homework popup on calendar date click
		------------------------- */
		$('.course-calendar-box table td a').click(function () {
			$('#hwPopup').addClass('show');
			// $('#hwPopup').fadeIn('slow');
		});
		$('.hw-pop-close').click(function () {
			$('#hwPopup').removeClass('show');
			// $('#hwPopup').fadeOut('slow');
		});

		/* -------------------------
		custom file upload button
		------------------------- */
		var inputs = document.querySelectorAll('.inputfile');
		Array.prototype.forEach.call(inputs, function (input) {
			var label = input.nextElementSibling,
				labelVal = label.innerHTML;

			input.addEventListener('change', function (e) {
				var fileName = '';
				if (this.files && this.files.length > 1)
					fileName = (
						this.getAttribute('data-multiple-caption') || ''
					).replace('{count}', this.files.length);
				else fileName = e.target.value.split('\\').pop();

				if (fileName) label.querySelector('span').innerHTML = fileName;
				else label.innerHTML = labelVal;
			});

			// Firefox bug fix
			input.addEventListener('focus', function () {
				input.classList.add('has-focus');
			});
			input.addEventListener('blur', function () {
				input.classList.remove('has-focus');
			});
		});

		/* -------------------------
		course/lesson page view offer popup
		------------------------- */
		$('.all-course-table td .view-offer1').click(function (e) {
			e.preventDefault();
			$('#viewOfferPop1').addClass('show');
		});
		$('.viewOfferPopclose1').click(function () {
			$('#viewOfferPop1').removeClass('show');
		});

		/* -------------------------
		chatbox(cb) view offer popup
		------------------------- */
		$('.chatbox .chatbox-action-buttons .view-offer-btn').click(function (
			e
		) {
			e.preventDefault();
			$('#cbViewOfferPop').addClass('show');
		});
		$('.cbViewOfferPopclose').click(function () {
			$('#cbViewOfferPop').removeClass('show');
		});

		/* -------------------------
		open add teacher popup from admin dashboard
		------------------------- */
		$('.dash-sum-items .add-teacher-btn').click(function (e) {
			e.preventDefault();
			$('#addTeacherPopup').addClass('show');
		});
		$('.addTeacherPopupClose').click(function () {
			$('#addTeacherPopup').removeClass('show');
		});

		/* -------------------------
		open add student popup from admin dashboard
		------------------------- */
		$('.dash-sum-items .add-student-btn').click(function (e) {
			e.preventDefault();
			$('#addStudentPopup').addClass('show');
		});
		$('.addStudentPopupClose').click(function () {
			$('#addStudentPopup').removeClass('show');
		});


		$('input[type="radio"][name="task-type"]').on('change', function () {
			var ThisIt = $(this);
			if (ThisIt.val() == 'monthly') {
				// when user select yes
				$('#monthlyTaskContent').fadeIn();
				$('#onetimeTaskContent').hide();
			} else {
				// when user select no
				$('#onetimeTaskContent').fadeIn();
				$('#monthlyTaskContent').hide();
				$('#onetimeTaskContent').find('input').val('');
				$('#onetimeTaskContent')
					.find('select option:first')
					.prop('selected', true);
			}
		});

		/* -------------------------
		chatbox single message options popup
		------------------------- */
		// show popup when clicking the trigger
	
		$('#getMessageChat').delegate('.message .options','click touch',function(event){
				event.stopPropagation();
				$(this).find('.options-wrap').fadeToggle(200);
		});

	});
	// end of document ready function

	/*====  window load function =====*/
	jQuery(window).on('load', function () {
		// animation with wow js
		new WOW().init();
	});
	/*====  end of window load function =====*/
})(jQuery);

/* -------------------------
pre loader function
------------------------- */
window.addEventListener('load', function () {
	const loader = document.querySelector('#preloader-container');
	loader.className += ' hidden';
});
