
var Core = {
	title: 'Sylvia Luchez',
	pictures_folder: 'layout/paintings/',
	thumbs_folder: 'layout/paintings/thumbs/',
	mode: null,
	smallScreenViewportWidth: 700,
	clsPortait: 'portrait',
	clsLandscape: 'landscape',
	clsCarousel: 'carousel',
	clsMenuItemSelected: 'selected',
	clsFolderItemSelected: 'selected',
	clsFormSubmitted: 'submitted',
	clsMobileMenuOpened: 'opened',
	isPortraitMode:  function() { return this.mode === this.clsPortait; },
	isLandscapeMode: function() { return this.mode === this.clsLandscape; },
	getDisplayModeClass: function() { return mode; },
	getPreviousDisplayClass: function() { return (this.isPortraitMode() ? this.clsLandscape : this.clsPortait); },
	getVisibleBackgroundImage: function(display_is_portrait) { return display_is_portrait ? this.img_port : this.img_land; },
	carouselFolder: null,
	carouselImageIndex: null,
	getCarouselFolder: function() {
		return document.pictures[this.carouselFolder];
	},
	getCarouselImage: function() {
		return this.getCarouselFolder()[this.carouselImageIndex];
	},
	isSmallView: function() {
		return $('body').hasClass('mobile') || ($(window).width() <= this.smallScreenViewportWidth) ;
	},
	returnSizes:  function(w, h, r) {
		var res = [w, h]; res.width = res.w = w; res.height = res.h = h; res.ratio = r || 1;
		return res;
	},
	documentResized: function(e) {
		if( this.isCompliantWithCss3 ) {
			var win_dim = this.returnSizes($(window).width(), $(window).height()), display_is_portrait = (win_dim.h >= win_dim.w),
				visible_img = this.getVisibleBackgroundImage(display_is_portrait),
				img_dim = visible_img._dim,
				max_dim = this.getDimToFillSpace(img_dim, win_dim);
			$(visible_img).css({position: 'absolute', width: max_dim.w+'px', height: max_dim.h+'px',
				left: ((win_dim.w-max_dim.w)/2)+'px', top: ((win_dim.h-max_dim.h)/2)+'px'});
			if( !this.mode || (display_is_portrait !== this.isPortraitMode()) )
				$(document.body).addClass(this.mode = (display_is_portrait ? this.clsPortait : this.clsLandscape)).removeClass(this.getPreviousDisplayClass());
		}
		if( $(document.body).hasClass(Core.clsCarousel) )
			this.redimCarouselPicture();
	},
	getDimToFillSpace: function(img_dim, max_dim) {
		var w = max_dim.w, r = (max_dim.w / img_dim.w), h = img_dim.h * r;
		if( h < max_dim.h ) {
			h = max_dim.h; r = (max_dim.h / img_dim.h); w = img_dim.w * r;
		};
		return this.returnSizes(w, h, r);
	},
	getDimToFitInSpace: function(img_dim, max_dim) {
		var w = max_dim.w, r = (max_dim.w / img_dim.w), h = img_dim.h * r;
		if( h > max_dim.h ) {
			h = max_dim.h; r = (max_dim.h / img_dim.h); w = img_dim.w * r;
		};
		return this.returnSizes(w, h, r);
	},
	menuItem_hovered: function(event) {
		$(this).toggleClass('hover').toggleClass('def');
	},
	menuButtonClicked: function(event) {
		if( event && event.stopPropagation) event.stopPropagation();
		$('#site-title, #site-menu').toggleClass(this.clsMobileMenuOpened);
	},
	switchTo: function(event, elt, id, url) {
		var attr, cb, section = $('#'+id+'-box'), clsSel = this.clsMenuItemSelected;
		this.updateHistory(url, elt.title);
		$('#content-wrapper #content .page-content').hide();
		if( (attr = section.attr('data-action')) && (cb = Core[attr]) )
			cb.call(this, elt, section);
		section.show();
		$('#content-wrapper').show();
		$('#site-menu li.'+clsSel).removeClass(clsSel);
		$(elt).addClass(clsSel);
		if( $('#site-menu').hasClass(this.clsMobileMenuOpened) )
			this.menuButtonClicked(event);
		$('#content-wrapper #content, #content-wrapper #content .page-content').scrollTop(0);
	},
	updateHistory: function (url, title) {
		title += ' - ' + this.title;
		document.title = title;
		if( history.replaceState )
			history.replaceState(null, title, url);
	},
	resetContactForm: function(menu, section) { // called by switchTo() after clicking on the menu
		var form = $(section).find('form'), cls = this.clsFormSubmitted;
		if( form.hasClass(cls) ) {
			form.trigger('reset');
			form.removeClass(cls);
		}
	},
	folderSelectorClicked: function(event) {
		if( event && event.stopPropagation) event.stopPropagation();
		$('#work-menu').toggleClass('opened');
	},
	showFolder: function(element, name) {
		var cls = this.clsFolderItemSelected;
		if( $(element).hasClass(cls) ) { return; }
		$('#works-box #work-menu li').removeClass(cls);
		$(element).addClass(cls);
		var gallery = document.getElementById('gallery');
		$(gallery).empty();
		$.each(document.pictures[name], function(index, value) {
			var url = value.url, title = value.title+'&#10;'+value.desc, styles = {
				'background-image': "url('"+this.thumbs_folder+url+"')",
				width: value.thumb_width+'px'
			};
			this.preloadImage(this.pictures_folder+url);
			$(gallery).append($('<div title="'+title+'" />').addClass('thumb').css(styles).click({folder_name: name, image_index: index}, Core.showPicture.bind(Core)));
		}.bind(this));
		$('.menu_holder .folder_name').text(name);
		this.updateHistory(this.workUrl+'?folder='+name, name);
	},
	showPicture: function(event, folder_name, image_index) {
		if( event && event.stopPropagation ) event.stopPropagation();
		try {
			if( event && event.data ) {
				folder_name = event.data.folder_name;
				image_index = event.data.image_index || 0;
			}
			if( typeof(image_index) === 'string' )
				image_index = this.getImageIndex(folder_name, image_index);
			this.carouselFolder = folder_name;
			this.carouselImageIndex = image_index;
			$(document.body).addClass(Core.clsCarousel);
			this.carouselPictureChanged();
		} catch(e) {
			this.closeCarousel();
		}
	},
	carouselPictureChanged: function() {
		var img_props = this.getCarouselImage(), folder = this.carouselFolder, title = img_props.title, url = this.pictures_folder+img_props['url'];
		$('#carousel')[img_props.sold ? 'addClass' : 'removeClass']('sold');
		$('#carousel .picture').css({'background-image': "url('"+url+"')"});
		this.redimCarouselPicture(img_props);
		$('#carousel .title').text(title);
		$('#carousel .desc-text' ).text(img_props.desc);
		$('#carousel .btn_prev')[this.carouselImageIndex === 0 ? 'hide' : 'show']();
		$('#carousel .btn_next')[this.carouselImageIndex === (this.getCarouselFolder().length -1) ? 'hide' : 'show']();
		$('#carousel .preview').attr('src', url);
		this.updateHistory(this.workUrl+'?folder='+folder+'&work='+encodeURIComponent(title), title);
	},
	redimCarouselPicture: function(image_data) {
		var smallVP = this.isSmallView(), vertOffset = (smallVP ? 40 : 0), borderWidth = 2, offset = (smallVP ? 2 : 50),
			side_padding = 2*(offset+borderWidth), img_props = image_data || this.getCarouselImage(),
			img_dim = this.returnSizes(img_props.image_width, img_props.image_height),
			win_dim = this.returnSizes($(window).width() - side_padding, $(window).height() - (side_padding + vertOffset)),
			max_dim = this.getDimToFitInSpace(img_dim, win_dim);
		$('#carousel .picture').css({
			width: max_dim.w+'px',
			height: max_dim.h+'px',
			left: (offset+(win_dim.w-max_dim.w)/2)+'px',
			top: (offset+vertOffset+(win_dim.h-max_dim.h)/2)+'px'
		});
	},
	closeCarousel: function() {
		$(document.body).removeClass(Core.clsCarousel);
		$('#carousel .preview').attr('src', '#');
		var name = this.carouselFolder;
		this.updateHistory(this.workUrl+'?folder='+name, name);
	},
	viewingFirstImage: function() {
		return ( this.carouselImageIndex <= 0 );
	},
	viewingLastImage: function() {
		return ( this.carouselImageIndex >= this.getCarouselFolder().length - 1 );
	},
	showNextImage: function() {
		if( ! this.viewingLastImage() ) {
			this.carouselImageIndex++;
			this.carouselPictureChanged();
		}
	},
	showPreviousImage: function() {
		if( !this.viewingFirstImage() ) {
			this.carouselImageIndex--;
			this.carouselPictureChanged();
		}
	},
	getImageIndex: function(folder, img_name) {
		var index = -1, title = img_name.toLowerCase();
		$(document.pictures[folder]).each( function(key, value) {
			if( value.title.toLowerCase() === title )
				index = key;
		}.bind(this) );
		return index;
	},
	newSecurityCode: function() {
		var sec_code = document.getElementById('field_sec_code');
		sec_code.src = sec_code.src.replace(/\d+$/, new Date().getTime());
	},
	contactFormSubmitted: function(event) {
		var form = event.target;
		event.preventDefault();
		$.ajax({
			type: form.method,
			url: form.action,
			dataType: 'json',
			data: $(form).serializeArray()
		}).done(function( json ) {
			if( !json ) return alert('Something went wrong, the email hasn\'t been sent');
			if( ! json.success ) return alert(json.message);
			$(form).addClass(this.clsFormSubmitted);
			Core.newSecurityCode();
		}.bind(this));
	},
	keyPressed: function(event) {
		if( $(document.body).hasClass(Core.clsCarousel) ) {
			switch(event.which) {
				case 27: return this.closeCarousel();
				case 37: return this.showPreviousImage();
				case 39: return this.showNextImage();
			}
		}
	},
	getPicturesNames: function(folder) {
		var urls = new Array(), pics = document.pictures, fct = function(img){ return img.url;};
		if( folder && pics[folder] ) {
			urls = $.map(pics[folder], fct);
		} else {
		$.each(pics, function(key, value) {
			urls = $.merge(urls, $.map(value, fct));
		}.bind(this));
		}
		return urls;
	},
	preloadImage: function(url) {
		(new Image()).src = url; 
	},
	preloadImages: function(thumbs, folder) {
		var path = (thumbs ? this.thumbs_folder: this.pictures_folder), fct = function(url){return path+url;},
			full_urls = $.map(this.getPicturesNames(folder), fct);
		$.map(full_urls, this.preloadImage.bind(this));
	},
	initSlider: function() {
		$('#carousel .picture').draggable({
			axis: 'x',
			start: function(event, ui) {
				this.sliderStartPos = ui.position.left;
			}.bind(this),
			drag: function(event, ui) {
				this.sliderCurrentPos = ui.position.left;
			}.bind(this),
			revert: function() {
				return ( (this.sliderAction = this.getSliderAction()) === 0 )
			}.bind(this),
			stop: function(event, ui) {
				switch( this.sliderAction ) {
					case -1: return this.showPreviousImage();
					case  1: return this.showNextImage();
				}
			}.bind(this),
			revertDuration: 200
		});
	},
	getSliderAction: function() {
		var diff = this.sliderCurrentPos - this.sliderStartPos, threshold = 100, imgWidth = parseInt($('#carousel .picture').css('width'), 10);
		if( imgWidth ) threshold = imgWidth / 3;
		if( Math.abs(diff) < threshold ) return 0;
		if( diff < 0 && !this.viewingLastImage()) return 1;
		if( diff > 0 && !this.viewingFirstImage()) return -1;
		return 0;
	}
};


$(document).ready( function(e) {
	if( (this.img_land = $('#landscape_bkgd')[0]) && (this.img_port = $('#portrait_bkgd')[0]) ) {
		this.img_port._dim = this.returnSizes(814, 1020); // asters
		this.img_land._dim = this.returnSizes(1383,  843); // construction_and_calamity_1
		this.isCompliantWithCss3 = true;
		this.documentResized(e);
	}
	$(window).resize(this.documentResized.bind(this));
	this.preloadImages(true);
	$('#btn-menu').click(this.menuButtonClicked.bind(this));
	$('#site-menu ul li').hover(this.menuItem_hovered);
	$('.menu_holder .folder_selector').click(this.folderSelectorClicked.bind(this));
	$('#contact-form').submit(Core.contactFormSubmitted.bind(this));
	$(document).keydown(Core.keyPressed.bind(this));
	var selectedFolder = $('#work-menu li.'+this.clsMenuItemSelected)[0];
	if( selectedFolder )
		this.preloadImages(false, selectedFolder.innerHTML);
	this.initSlider();
	$('.required').each( function(i) {
		$(this).attr('title', 'This field is required!');
	});
}.bind(Core));
