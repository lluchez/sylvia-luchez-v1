<?php
	//error_reporting(E_ALL | E_WARNING | E_NOTICE);
	//ini_set('display_errors', TRUE);

	// Include the necessary files
	include_once '.private/init.inc.php';
	include_once '.private/works.data.php';
	
	// Browser detection and support
	$is_mobile_device = is_mobile_device();
	$is_recent_browser = $is_mobile_device || does_browser_support_most_of_css3_directives();
	
	// Menu items
	$default_menu = $is_recent_browser ? 'about' : 'home';
	$menu_items = Array(
		'news'    => Array('title' => 'News',    'img_base' => 'news',    'url' => 'news.html'),
		'works'   => Array('title' => 'Works',   'img_base' => 'works',   'url' => 'works.html'),
		'about'   => Array('title' => 'About',   'img_base' => 'about',   'url' => 'about.html'),
		'contact' => Array('title' => 'Contact', 'img_base' => 'contact', 'url' => 'contact.html')
	);
	$show_frame = true;
	if( ! isset($page) && array_key_exists('page', $_GET) )
		$page = $_GET['page'];
	if( ! isset($page) || ! array_key_exists($page, $menu_items) ) {
		$page = $default_menu;
		if( ! $is_recent_browser ) {
			$show_frame = false;
		}
	}
	$page_title = $menu_items[$page]['title'];
	
	
	if( ($page == 'contact') && is_pDefined(POST_MAIL_NAME, POST_MAIL_PHONE, POST_MAIL_EMAIL, POST_MAIL_SUBJECT, POST_MAIL_MESSAGE, POST_MAIL_CODE) )
	{
		handle_send_email_request();
		die();
	}
	
	// CSS and JavaScript files to load
	$js_files = Array('scripts/lib/jquery-1.11.2.min.js', 'scripts/lib/jquery-ui.min.js', 'scripts/lib/jquery.ui.touch-punch.min.js',
		'scripts/data.js.php', 'scripts/scripts.js');
	$css_files = Array( Array('url' => 'layout/styles.css', 'media' => 'all') );
	if($is_recent_browser) {
		$css_files = array_merge($css_files, Array(
			Array('url' => 'layout/styles-css3.css', 'media' => 'all'),
			Array('url' => 'layout/styles-align-landscape.css', 'media' => '(orientation: landscape)'),
			Array('url' => 'layout/styles-align-portrait.css', 'media' => '(orientation: portrait)')
		));
		if( $is_mobile_device ) {
			$css_files[] = Array('url' => 'layout/styles-small.css', 'media' => 'all');
		} else {
			$css_files = array_merge($css_files, Array(
				Array('url' => 'layout/styles-small.css', 'media' => '(max-width: 700px)'),
				Array('url' => 'layout/styles-large.css', 'media' => '(min-width: 701px)')
			));
		}
	} else {
		$css_files = array_merge($css_files, Array(
			Array('url' => 'layout/styles-old.css', 'media' => 'all'),
			Array('url' => 'layout/styles-large.css', 'media' => 'all')
		));
	}
	
	// Works folder
	$get_tab = get(URL_PARAM_FOLDER);
	$sel_tab = null;
	if( isset($get_tab) && array_key_exists($get_tab, $_work_tabs) ) {
		$sel_tab = $page_title = $get_tab;
	} else {
		$tmp_keys = array_keys($_work_tabs);
		$sel_tab = $tmp_keys[0];
	}
	
	// Works pictures
	$get_pic = get(URL_PARAM_WORK);
	$sel_pic = null;
	$pic_folder = 'layout/paintings/';
	$pic_names = $_work_tabs[$sel_tab];
	if( isset($get_pic) ) {
		foreach($pic_names as $pic_name) {
			if( strtolower($_work_pics[$pic_name]['title']) === strtolower($get_pic) )
				$sel_pic = $_work_pics[$pic_name];
				$page_title = $sel_pic['title'];
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<link rel="SHORTCUT ICON" href="layout/favicon.png" />
	<title><?php echo (empty($page_title)) ? '' : "{$page_title} - "; ?>Sylvia Luchez</title>
<?php
if($is_recent_browser)
{
?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<?php
}
?>
	<meta name="keywords" content="artist, art, Chicago artist, Chicago, Polish-American, acrylic painting, pencil drawing, flowers, paintings of flowers, still life, oil painting, contemporary artist, painter, artwork, Sylvia, Luchez, Prokopowicz" />
	<meta name="description" content="Polish-American contemporary artist in Chicago." />
	<meta name="author" content="Lionel Luchez" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	if( $sel_pic ) :
?>
	<meta property="og:image" content="<?php echo /*FULL_URL .*/ $pic_folder . $sel_pic['url']; ?>"/> 
<?php
	endif;
?>
<?php foreach($css_files as $css): ?>
	<link type="text/css" media="<?php echo $css['media']; ?>" rel="stylesheet" href="<?php echo $css['url']; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $js): ?>
	<script type="text/javascript" src="<?php echo $js; ?>"></script>
<?php endforeach; ?>
	<script type="text/javascript">
		// Google Analytics
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-50755313-1', 'sylvialuchez.com');
		ga('send', 'pageview');
		
		// Init
		$(document).ready( function(e) {
			Core.workUrl = '<?php echo $menu_items['works']['url']; ?>';
<?php
	if( $sel_pic ) {
?>
			Core.showPicture(null, '<?php echo $sel_tab; ?>', '<?php echo $sel_pic['title']; ?>');
<?php
	}
?>
		});
	</script>
</head>
<body class="<?php echo ($is_recent_browser ? 'css3' : 'no_css3').' '.($is_mobile_device ? 'mobile' : 'desktop'); ?>">
<?php
if( ! $is_recent_browser )
{
	// For NON-CCS3 browsers // JavaScript will update the class of the <body/> and CSS will hide one or the one background image
?>
	<img id="landscape_bkgd" src="layout/dream.jpg" />
	<img id="portrait_bkgd"  src="layout/growth.jpg" />
<?php
}
?>
	<header id="site-title">
		<img src="layout/menu/sl.png" title="Sylvia Luchez" class="for_large_screen" />
		<div id="btn-menu" class="for_small_screen"></div>
		<label class="for_small_screen">Sylvia <span class="sm-not-visible">Prokopowicz</span> Luchez</label>
	</header>
	<nav id="site-menu">
		<ul class="site-menu">
<?php foreach($menu_items as $key => $props): ?>
			<li class="<?php echo 'def'.($key === $page ? ' selected' : ''); ?>" onClick="javascript: Core.switchTo(event, this, '<?php echo $key; ?>', '<?php echo $props['url']; ?>');" title="<?php echo $props['title']; ?>">
				<img src="layout/menu/<?php echo $props['img_base']; ?>.png" class="for_large_screen def" />
				<img src="layout/menu/<?php echo $props['img_base']; ?>_hover.png" class="for_large_screen hover" />
				<label class="for_small_screen"><?php echo $props['title']; ?></label>
			</li>
<?php endforeach; ?>
		</ul>
	</nav>
	<div id="content-wrapper" style="display: <?php echo $show_frame ? 'block' : 'none'; ?>;">
		<div class="frame"></div>
		<div id="content">
			<div id="about-box" class="page-content" style="display: <?php echo ($page === 'about') ? 'block' : 'none'; ?>;">
				<h1>About</h1>
				<h2>Artist's Biography</h2>
				<div class="text-block">
					<p>Sylvia lives and works in Chicago. She studied English literature and visual art at the University of Chicago.
					She now finds inspiration from her everyday work as an art teacher in a private school in Chicago.</p>
				</div>
				
				<h2>Artist's Statement</h2>
				<div class="text-block">
					<!--<img src="<php echo $pic_folder; ?>thumbs/growth.jpg" title="Growth" style="float: right; padding: 10px;" />-->
					<p>I work in acrylic paint. I love to use color. Even when I limit my palette or mix white into my colors, I invariably go back to color.
					My point of departure is traditionally objects and landscapes—things, materials, spaces. I love to focus on a thing.
					I can sit with it and it will sit with me. It has line, form, shape and color, and sometimes—almost always—these elements exist
					in a combination that is different from what I have ever seen before.</p>
					<p>My abstract work is a collection of moments spent looking at things, drawing them, painting them, and being with them.
					They are memories of my favorite lines, colors, and shapes. They are also memories of my moods and thoughts: my anger, happiness,
					sadness, confusion—all of the thoughts and feelings I experience throughout the day.</p>
				</div>
			</div>
			<div id="works-box" class="page-content" style="display: <?php echo ($page === 'works') ? 'block' : 'none'; ?>;">
				<h1>Works</h1>
				<div class="menu_holder">
					<div class="folder_label">Folder</div>
					<div class="folder_selector">
						<label class="folder_name"><?php echo $sel_tab; ?></label>
						<span class="caret"></span>
						<ul id="work-menu">
<?php
								foreach($_work_tabs as $name => $work_names)
								{
									$is_current = ($name == $sel_tab);
									$class = ($is_current ? 'selected' : '');
									echo "\t\t\t\t\t\t\t<li class=\"{$class}\" onClick=\"javascript: Core.showFolder(this, '{$name}');\">{$name}</li>\n";
								}
?>
						</ul>
					</div>
				</div>
				<div class="clearer"></div>
				<div id="gallery">
				<?php
					$nl = "&#10;";
					foreach($pic_names as $key => $pic_name)
					{
						$pic = $_work_pics[$pic_name];
						$title = htmlspecialchars($pic['title'], ENT_QUOTES).$nl.htmlspecialchars($pic['desc'], ENT_QUOTES);
						if( array_key_exists('sold', $pic) && $pic['sold'] )
							$title .= $nl.'Sold';
						$style = "background-image: url('{$pic_folder}thumbs/{$pic['url']}'); width: {$pic['thumb_width']}px;";
						$onClick = "javascript: return Core.showPicture(this, '{$sel_tab}', {$key})";
						echo "\t\t\t\t\t<div class=\"thumb\" style=\"{$style}\" title=\"{$title}\" onClick=\"{$onClick};\"></div>\n";
					}
					if( $sel_pic ) {
						echo "\t\t\t\t\t<div style=\"display: none;\"><img src=\"{$pic_folder}{$sel_pic['url']}\" /></div>\n";
					}
				?>
				</div>
				<div class="clearer"></div>
			</div>
			<div id="news-box" class="page-content" style="display: <?php echo ($page === 'news') ? 'block' : 'none'; ?>;">
				<h1>News</h1>
				
				<!-- Nature and Abstractions exhibition -->
				<div class="news_item">
					<h2>
						<span class="name">Group Exhibition "Color Theory"</span>
						<span class="date">Posted on May 7th, 2016</span>
					</h2>
					<div class="description">
						Exhibition of art work by Sylvia Prokopowicz Luchez, Zulian Tuohey Martinez and Oscar Luis Martinez
						exploring the relationship of colors and abstraction in art.
					</div>
					<div class="item_details_holder">
						<table class="item_details">
							<tr>
								<td class="label"><span class="color2">Address</span></td>
								<td class="value"><a href="https://www.google.com/maps/place/1841+S+Halsted+St/@41.854928,-87.6449436,16z" target="_blank" title="See the location with Google Maps">1841 S. Halsted</a></td>
							</tr>
							<tr>
								<td class="label"><span class="color2">Date & Time</span></td>
								<td class="value">Friday, May 13th, 6-10PM</td>
							</tr>
							<tr>
								<td class="label"><span class="color2">More info</span></td>
								<td class="value"><a href="http://chicagoartsdistrict.org/secondfridays_main.asp" target="_blank">Second Friday Art Walk</a></td>
							</tr>
						</table>
					</div>
					<div class="for_small_screen">
						<img class="img-responsive margin-centered" src="layout/news/color-theory/sm-stained-glass.jpg" alt="Stained Glass" title="Stained Glass" />
					</div>
					<div class="for_large_screen table-row">
						<div class="cell-of-3 news-img-holder-cell">
							<img class="img-responsive" src="layout/news/color-theory/lg-city-life.jpg" alt="City Life" title="City Life" />
						</div>
						<div class="cell-of-3 news-img-holder-cell">
							<img class="img-responsive" src="layout/news/color-theory/lg-stained-glass.jpg" alt="Stained Glass" title="Stained Glass" />
						</div>
						<div class="cell-of-3 news-img-holder-cell">
							<img class="img-responsive" src="layout/news/color-theory/lg-sudden-arc.jpg" alt="Sudden Arc" title="Sudden Arc" />
						</div>
					</div>
					<div class="statement-block">
						<h3>Group's Statement</h3>
						<div class="text-block">
							<p>
								<img src="layout/quote_open.png" class="open_quote" />
								Color is the essence of art, of mood, of our whole perception of the physical world.
								Whether taken from a palette or opening the doors of perception, color is central to art not only as an element but also as an idea.
								The work included in this exhibition explores the meaning and use of color in abstraction.
								<img src="layout/quote_close.png" class="close_quote" />
							</p>
						</div>
					</div>
				</div>
				
				<!-- Nature and Abstractions exhibition -->
				<div class="news_item not_first_news">
					<h2>
						<span class="name">Exhibition "Nature and Abstraction"</span>
						<span class="date">Posted on July 17th, 2015</span>
					</h2>
					<div class="description">
						I will be showing my artwork, a blend of representational still life and more abstract work, at a gallery in Pilsen.<br />
						All are welcome! Feel free to invite your friends.
					</div>
					<div class="item_details_holder">
						<table class="item_details">
							<tr>
								<td class="label"><span class="color2">Address</span></td>
								<td class="value"><a href="https://www.google.com/maps/place/1841+S+Halsted+St/@41.854928,-87.6449436,16z" target="_blank" title="See the location with Google Maps">1841 S. Halsted</a></td>
							</tr>
							<tr>
								<td class="label"><span class="color2">Date & Time</span></td>
								<td class="value">Friday, September 11th, 6-10PM</td>
							</tr>
							<tr>
								<td class="label"><span class="color2">More info</span></td>
								<td class="value"><a href="http://chicagoartsdistrict.org/secondfridays_main.asp" target="_blank">Second Friday Art Walk</a></td>
							</tr>
						</table>
					</div>
					<div class="description">
						<b><u>UPDATE</u></b>: There will be a second opening on <b>Saturday, September 26th</b> from 6pm to 10pm.
					</div>
					<center>
						<img class="img-responsive" src="<?php echo $pic_folder; ?>silhouette.jpg" title="Silhouette" style="padding: 10px;" />
					</center>
					<div class="statement-block">
						<h3>Artist's Statement</h3>
						<div class="text-block">
							<p>
								<img src="layout/quote_open.png" class="open_quote" />
								Nature and Abstraction is a blend of my earlier representational work and my abstract work.
								In my abstract work, the images of objects and spaces only exist in pieces.
								A line from the branch of a tree and the shape and color of a passing train coexist.
								The paintings are a visual compromise of things man-made and naturally made.
								I understand my works as gatherings of people, things, and movements—buildings, trees, sidewalks, and bodies of water all in one place.
								They are records of the intersections of these things in the everyday life of a city.
							</p>
							<p>
								After working for a long time on abstract pieces, painting on larger surfaces as I progressed, I reviewed my earliest exercises,
								the first small abstract pieces. They were important to me as records of my beginnings but did not feel like complete works
								in the way my larger pieces felt. These earlier works have a less complicated structure and composition;
								they are the first steps I took in abstraction since college.
								These paintings turned into hybrids, with representational images of natural objects overlaying the abstracted lines
								and shapes that lay beneath. At times I want these images to flicker back and forth and to blend together,
								the organic blending with the man-made. At other times, I want them to be completely separate,
								just as sometimes we move in accordance with nature and at other times we move against it.
								<img src="layout/quote_close.png" class="close_quote" />
							</p>
						</div>
					</div>
				</div>
				
				<!-- Interiors exhibition -->
				<div class="news_item not_first_news">
					<h2>
						<span class="name">Exhibition "Interiors"</span>
						<span class="date">Posted on April 6th, 2014</span>
					</h2>
					<div class="description">
						I will be exhibiting my series "Interiors" at <a href="https://www.google.com/maps/place/1841+S+Halsted+St/@41.854928,-87.6449436,16z" target="_blank" title="See the location with Google Maps">1841 S. Halsted</a> as part of Chicago Art District's 2nd Fridays.<br />
						Gallery opening: Friday, May 9th 6-10PM.
					</div>
					<div class="item_details_holder">
						<table class="item_details">
							<tr>
								<td class="label"><span class="color2">Address</span></td>
								<td class="value"><a href="https://www.google.com/maps/place/1841+S+Halsted+St/@41.854928,-87.6449436,16z" target="_blank" title="See the location with Google Maps">1841 S. Halsted</a></td>
							</tr>
							<tr>
								<td class="label"><span class="color2">Date & Time</span></td>
								<td class="value">Friday, May 9th, 6-10PM</td>
							</tr>
							<tr>
								<td class="label"><span class="color2">More info</span></td>
								<td class="value"><a href="http://chicagoartsdistrict.org/secondfridays_main.asp" target="_blank">Second Friday Art Walk</a></td>
							</tr>
						</table>
					</div>
					<center>
						<img class="img-responsive" src="<?php echo $pic_folder; ?>asters.jpg" title="Asters" style="padding: 10px;" />
					</center>
					<div class="statement-block">
						<h3>Artist's Statement</h3>
						<div class="text-block">
							<p>
								<img src="layout/quote_open.png" class="open_quote" />
								I paint enclosed spaces, saturated with what I consider to be domestic symbols. However, I always strive to let the spaces I paint "breathe".
								My paintings are symbols of freedom at the same time as they are enclosures, harbingers of stability.
							</p>
							<p>
								Plants are often a starting point for me because they represent calm, steady growth, and rootedness.
								But plants brought into a domestic space also remind me of our place in the natural world; we are fundamentally animals, and we can be both as beautiful and ugly as nature is itself.
								We have an ability and need to live spontaneously, and to depart from set structures.
								Plants are free to grow however they need, following the sun or the shape of their environment.
								Their lines are soft and curved. They survive, but they are not aggressive.
							</p>
							<p>In my paintings, there is always a "way out" of the comfortable space of the structured, patterned interior.
								Windows leading to large, open spaces symbolize freedom and opportunity. My paintings express the feeling of freedom as it comes from two seemingly opposite sources.
								It can come from stability and routine, because these structures provide us with comfort, consistency and the idea of leisure time.
								But it can also come from lack of structure--from open space and the idea of possibilities.
								My paintings exhibit a state of mind in which we are free to navigate between both worlds at will--the human world of order and structure, and the natural world of chaos, chance and fluidity.
								<img src="layout/quote_close.png" class="close_quote" />
							</p>
						</div>
					</div>
				</div>
			</div>
			<div id="contact-box" class="page-content" style="display: <?php echo ($page === 'contact') ? 'block' : 'none'; ?>;" data-action="resetContactForm">
				<h1>Contact</h1>
				<div class="form-header">
					<label class="color1">Contact me</label>
				</div>
				<form id="contact-form" action="contact.php" method="post" class="">
					<div class="hide-when-submitted">
						<!-- Name -->
						<div class="field">
							<label class="color2 required" for="<?php echo POST_MAIL_NAME; ?>">Name <span>*</span></label>
							<div class="input">
								<input type="name" name="<?php echo POST_MAIL_NAME; ?>" id="<?php echo POST_MAIL_NAME; ?>" placeHolder="Name" class="fill" />
							</div>
						</div>
						<!-- Email -->
						<div class="field">
							<label class="color2 required" for="<?php echo POST_MAIL_EMAIL; ?>">Email <span>*</span></label>
							<div class="input">
								<input type="email" name="<?php echo POST_MAIL_EMAIL; ?>" id="<?php echo POST_MAIL_EMAIL; ?>" placeHolder="Email address" class="fill" />
							</div>
						</div>
						<!-- Phone -->
						<div class="field">
							<label class="color2" for="<?php echo POST_MAIL_PHONE; ?>">Phone</label>
							<div class="input">
								<input type="tel" name="<?php echo POST_MAIL_PHONE; ?>" id="<?php echo POST_MAIL_PHONE; ?>" placeHolder="Phone" />
							</div>
						</div>
						<!-- Subject -->
						<div class="field">
							<label class="color2 required" for="<?php echo POST_MAIL_SUBJECT; ?>">Subject <span>*</span></label>
							<div class="input">
								<input type="text" name="<?php echo POST_MAIL_SUBJECT; ?>" id="<?php echo POST_MAIL_SUBJECT; ?>" placeHolder="Subject" class="fill" />
							</div>
						</div>
						<!-- Message -->
						<div class="field">
							<label class="color2 required" for="<?php echo POST_MAIL_MESSAGE; ?>">Message <span>*</span></label>
							<div class="input">
								<textarea name="<?php echo POST_MAIL_MESSAGE; ?>" id="<?php echo POST_MAIL_MESSAGE; ?>" placeHolder="Message" rows="5" class="fill"></textarea>
							</div>
						</div>
						<!-- Confirmation Code -->
						<div class="field">
							<label class="color2 required" for="<?php echo POST_MAIL_CODE; ?>">Confirmation Code <span>*</span></label>
							<div class="input sec-code">
								<input type="text" name="<?php echo POST_MAIL_CODE; ?>" id="<?php echo POST_MAIL_CODE; ?>" placeHolder="Code" autocomplete="off" size="6" />
								<img src="layout/securitycode.png.php?ts=<?php echo mktime(); ?>" id="field_sec_code" title="Security code to type in" />
								<img src="layout/reload.png" id="btn_new_sec_code" title="Generate a new security code" onClick="javascript: Core.newSecurityCode();" />
							</div>
						</div>
						<!-- Send button -->
						<div class="actions">
							<button class="btn_send_email" title="Send email to Sylvia">Send</button>
						</div>
					</div>
					<!-- Message sent -->
					<div class="show-when-submitted info-box email-sent">Your email has been sent.</div>
				</form>
			</div>
		</div>
	</div>
	<div id="carousel">
		<div class="overlay"></div>
		<div class="button btn_close" onClick="javascript: Core.closeCarousel();"></div>
		<div class="button btn_prev nav" onClick="javascript: Core.showPreviousImage();"></div>
		<div class="button btn_next nav" onClick="javascript: Core.showNextImage();"></div>
		<div class="picture">
			<!--<img src="layout/sold.png" class="sold-icon" title="This painting has been sold" />-->
		</div>
		<div class="text-holder text title"></div>
		<div class="text-holder desc">
			<span class="text desc-text"></span>
			<img src="layout/sold-mark.png" class="sold-mark" title="Sold" alt="Sold" />
		</div>
<?php
	if( $sel_pic ) :
?>
		<link href="<?php echo ($pic_folder.$sel_pic['url']); ?>" class="preview" rel="image_src" />
		<img src="<?php echo ($pic_folder.$sel_pic['url']); ?>" class="preview" />
<?php
	endif;
?>
	</div>
</body>
</html>