<?php

$thumbs_margin = 3;
$thumbs_border = 1;
$thumbs_extra = 2 * ($thumbs_margin + $thumbs_border);

// NOTE: thumbnails height should be 108px
$_work_pics = Array(
	'asters' => Array(
		'url' => 'asters.jpg',
		'title' => 'Asters',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 484,
		'image_height' => 616,
		'thumb_width' => 88 + $thumbs_extra,
		'sold' => true
	),
	'autumn_flowers_1' => Array(
		'url' => 'autumn_flowers_1.jpg',
		'title' => 'Autumn Flowers 1',
		'desc' => 'Pencil on paper, 9" x 12"',
		'image_width' => 463,
		'image_height' => 621,
		'thumb_width' => 79 + $thumbs_extra
	),
	'autumn_flowers_2' => Array(
		'url' => 'autumn_flowers_2.jpg',
		'title' => 'Autumn Flowers 2',
		'desc' => 'Pencil on paper, 9" x 12"',
		'image_width' => 491,
		'image_height' => 640,
		'thumb_width' => 84 + $thumbs_extra,
		'sold' => true
	),
	// 'beauty_contest' => Array(
		// 'url' => 'beauty_contest.jpg',
		// 'title' => 'Beauty Contest',
		// 'desc' => 'Pencil on paper', // to be completed
		// 'image_width' => 835,
		// 'image_height' => 620,
		// 'thumb_width' => 146 + $thumbs_extra
	// ),
	'blue_orchid_1' => Array(
		'url' => 'blue_orchid_1.jpg',
		'title' => 'Blue Orchid I',
		'desc' => 'Acrylic on canvas, 20" x 20"',
		'image_width' => 619,
		'image_height' => 620,
		'thumb_width' => 109 + $thumbs_extra
	),
	'blue_orchid_2' => Array(
		'url' => 'blue_orchid_2.jpg',
		'title' => 'Blue Orchid II',
		'desc' => 'Acrylic on canvas, 20" x 20"',
		'image_width' => 612,
		'image_height' => 615,
		'thumb_width' => 112 + $thumbs_extra,
		'sold' => true
	),
	'cascade' => Array(
		'url' => 'cascade.jpg',
		'title' => 'Cascade',
		'desc' => 'Mixed media on paper, 11" x 14"',
		'image_width' => 494,
		'image_height' => 620,
		'thumb_width' => 86 + $thumbs_extra
	),
	// 'celtic_symbol' => Array(
		// 'url' => 'celtic_symbol.jpg',
		// 'title' => 'Celtic Symbol',
		// 'desc' => 'Mixed media on paper', // to be completed
		// 'image_width' => 780,
		// 'image_height' => 620,
		// 'thumb_width' => 136 + $thumbs_extra
	// ),
	'city_life' => Array(
		'url' => 'city_life.jpg',
		'title' => 'City Life',
		'desc' => 'Acrylic on canvas, 3\' x 4\'',
		'image_width' => 445,
		'image_height' => 601,
		'thumb_width' => 80 + $thumbs_extra
	),
	'collected_objects' => Array(
		'url' => 'collected_objects.jpg',
		'title' => 'Collected Objects',
		'desc' => 'Acylic on canvas, 11" x 14"',
		'image_width' => 442,
		'image_height' => 576,
		'thumb_width' => 83 + $thumbs_extra
	),
	'conscious_ascent' => Array(
		'url' => 'conscious_ascent.jpg',
		'title' => 'Conscious Ascent',
		'desc' => 'Acrylic on canvas, 24" x 36"',
		'image_width' => 521,
		'image_height' => 644,
		'thumb_width' => 86 + $thumbs_extra
	),
	'construction_and_calamity_1' => Array(
		'url' => 'construction_and_calamity_1.jpg',
		'title' => 'Construction and Calamity I',
		'desc' => 'Acrylic on canvas, 72" x 84"',
		'image_width' => 471,
		'image_height' => 611,
		'thumb_width' => 84 + $thumbs_extra
	),
	'construction_and_calamity_2' => Array(
		'url' => 'construction_and_calamity_2.jpg',
		'title' => 'Construction and Calamity II',
		'desc' => 'Acrylic on canvas, 60" x 72"',
		'image_width' => 467,
		'image_height' => 629,
		'thumb_width' => 78 + $thumbs_extra
	),
	'decorative_peppers' => Array(
		'url' => 'decorative_peppers.jpg',
		'title' => 'Decorative Peppers',
		'desc' => 'Pencil on paper, 9" x 12"',
		'image_width' => 463,
		'image_height' => 622,
		'thumb_width' => 84 + $thumbs_extra
	),
	'dream' => Array(
		'url' => 'dream.jpg',
		'title' => 'Dream',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 865,
		'image_height' => 620,
		'thumb_width' => 151 + $thumbs_extra,
		'sold' => true
	),
	'dream2' => Array(
		'url' => 'dream2.jpg',
		'title' => 'Dream 2',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 785,
		'image_height' => 618,
		'thumb_width' => 137 + $thumbs_extra,
		'sold' => true
	),
	'field' => Array(
		'url' => 'field.jpg',
		'title' => 'Field',
		'desc' => 'Acrylic on canvas, 8" x 10"',
		'image_width' => 489,
		'image_height' => 620,
		'thumb_width' => 85 + $thumbs_extra,
		'sold' => true
	),
	'foliage' => Array(
		'url' => 'foliage.jpg',
		'title' => 'Foliage',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 464,
		'image_height' => 620,
		'thumb_width' => 81 + $thumbs_extra
	),
	'flowers_in_a_square_vase' => Array(
		'url' => 'flowers_in_a_square_vase.jpg',
		'title' => 'Flowers in a Square Vase',
		'desc' => 'Mixed media on paper, 9" x 12"',
		'image_width' => 460,
		'image_height' => 611,
		'thumb_width' => 81 + $thumbs_extra
	),
	'fragments' => Array(
		'url' => 'fragments.jpg',
		'title' => 'Fragments',
		'desc' => 'Acrylic on canvas, 8" x 13"',
		'image_width' => 604,
		'image_height' => 942,
		'thumb_width' => 71 + $thumbs_extra
	),
	'frogs' => Array(
		'url' => 'frogs.jpg',
		'title' => 'Frogs',
		'desc' => 'Acrylic on canvas, 8" x 10"',
		'image_width' => 773,
		'image_height' => 620,
		'thumb_width' => 135 + $thumbs_extra,
		'sold' => true
	),
	'glacier' => Array(
		'url' => 'glacier.jpg',
		'title' => 'Glacier',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 787,
		'image_height' => 623,
		'thumb_width' => 137 + $thumbs_extra,
		'sold' => true
	),
	'growth' => Array(
		'url' => 'growth.jpg',
		'title' => 'Growth',
		'desc' => 'Acrylic on canvas, 16" x 20"',
		'image_width' => 493,
		'image_height' => 618,
		'thumb_width' => 87 + $thumbs_extra,
		'sold' => true
	),
	'hope' => Array(
		'url' => 'hope.jpg',
		'title' => 'Hope',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 480,
		'image_height' => 620,
		'thumb_width' => 84 + $thumbs_extra,
		'sold' => true
	),
	'hushed_sentiment' => Array(
		'url' => 'hushed_sentiment.jpg',
		'title' => 'Hushed Sentiment',
		'desc' => 'Acrylic on canvas, 16" x 16"',
		'image_width' => 634,
		'image_height' => 654,
		'thumb_width' => 106 + $thumbs_extra,
		'sold' => true
	),
	'in_another_world' => Array(
		'url' => 'in_another_world.jpg',
		'title' => 'In Another World',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 499,
		'image_height' => 634,
		'thumb_width' => 86 + $thumbs_extra
	),
	'claiming_space' => Array(
		'url' => 'claiming_space.jpg',
		'title' => 'Claiming Space',
		'desc' => 'Acrylic on canvas, 20" x 20"',
		'image_width' => 611,
		'image_height' => 617,
		'thumb_width' => 110 + $thumbs_extra
	),
	'neighborhoods' => Array(
		'url' => 'neighborhoods.jpg',
		'title' => 'Neighborhoods',
		'desc' => 'Acrylic on canvas, 18" x 24"',
		'image_width' => 814,
		'image_height' => 609,
		'thumb_width' => 144 + $thumbs_extra
	),
	'near_the_window' => Array(
		'url' => 'near_the_window.jpg',
		'title' => 'Near The Window',
		'desc' => 'Mixed Media on paper, 12" x 18"',
		'image_width' => 408,
		'image_height' => 620,
		'thumb_width' => 71 + $thumbs_extra,
		'sold' => true
	),
	'open_space' => Array(
		'url' => 'open_space.jpg',
		'title' => 'Open Space',
		'desc' => 'Acrylic on canvas, 18" x 24"',
		'image_width' => 466,
		'image_height' => 626,
		'thumb_width' => 78 + $thumbs_extra
	),
	'poinsettia' => Array(
		'url' => 'poinsettia.jpg',
		'title' => 'Poinsettia',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 475,
		'image_height' => 620,
		'thumb_width' => 83 + $thumbs_extra
	),
	'poinsettia_in_foil_vase' => Array(
		'url' => 'poinsettia_in_foil_vase.jpg',
		'title' => 'Poinsettia in Foil Vase',
		'desc' => 'Mixed media on paper, 9" x 12"',
		'image_width' => 466,
		'image_height' => 620,
		'thumb_width' => 81 + $thumbs_extra
	),
	'porcelain' => Array(
		'url' => 'porcelain.jpg',
		'title' => 'Porcelain',
		'desc' => 'Mixed media on paper, 12" x 9"',
		'image_width' => 821,
		'image_height' => 620,
		'thumb_width' => 143 + $thumbs_extra
	),
	'rain' => Array(
		'url' => 'rain.jpg',
		'title' => 'Rain',
		'desc' => 'Mixed media on paper, 9" x 12"',
		'image_width' => 471,
		'image_height' => 629,
		'thumb_width' => 81 + $thumbs_extra
	),
	'revealed' => Array(
		'url' => 'revealed.jpg',
		'title' => 'Revealed',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 487,
		'image_height' => 619,
		'thumb_width' => 88 + $thumbs_extra
	),
	'reflection' => Array(
		'url' => 'reflection.jpg',
		'title' => 'Reflection',
		'desc' => 'Acrylic on canvas, 16" x 20"',
		'image_width' => 510,
		'image_height' => 633,
		'thumb_width' => 87 + $thumbs_extra
	),
	'rose' => Array(
		'url' => 'rose.jpg',
		'title' => 'Rose',
		'desc' => 'Oil on canvas, 14" x 11"',
		'image_width' => 792,
		'image_height' => 623,
		'thumb_width' => 143 + $thumbs_extra,
		'sold' => true
	),
	'roses' => Array(
		'url' => 'roses.jpg',
		'title' => 'Roses',
		'desc' => 'Acrylic on paper, 12" x 16"',
		'image_width' => 492,
		'image_height' => 620,
		'thumb_width' => 86 + $thumbs_extra,
		'sold' => true
	),
	'roses_in_water' => Array(
		'url' => 'roses_in_water.jpg',
		'title' => 'Roses in water',
		'desc' => 'Mixed media on paper, 9" x 12"',
		'image_width' => 487,
		'image_height' => 623,
		'thumb_width' => 88 + $thumbs_extra
	),
	'scissors' => Array(
		'url' => 'scissors.jpg',
		'title' => 'Scissors',
		'desc' => 'Oil pastel, watercolor on paper, 16.5" x 14"',
		'image_width' => 755,
		'image_height' => 589,
		'thumb_width' => 139 + $thumbs_extra
	),
	'shadows' => Array(
		'url' => 'shadows.jpg',
		'title' => 'Shadows',
		'desc' => 'Mixed media on paper, 9" x 12"',
		'image_width' => 455,
		'image_height' => 614,
		'thumb_width' => 81 + $thumbs_extra
	),
	'silhouette' => Array(
		'url' => 'silhouette.jpg',
		'title' => 'Silhouette',
		'desc' => 'Acrylic on canvas, 3\' x 4\'',
		'image_width' => 452,
		'image_height' => 606,
		'thumb_width' => 81 + $thumbs_extra
	),
	'stained_glass' => Array(
		'url' => 'stained_glass.jpg',
		'title' => 'Stained Glass',
		'desc' => 'Acrylic on canvas, 3\' x 4\'',
		'image_width' => 450,
		'image_height' => 605,
		'thumb_width' => 80 + $thumbs_extra
	),
	'together' => Array(
		'url' => 'together.jpg',
		'title' => 'Together',
		'desc' => 'Oil pastel, acrylic on paper, 17" x 22"',
		'image_width' => 451,
		'image_height' => 620,
		'thumb_width' => 79 + $thumbs_extra
	),
	'sudden_arc' => Array(
		'url' => 'sudden_arc.jpg',
		'title' => 'Sudden Arc',
		'desc' => 'Acrylic on canvas, 3\' x 4\'',
		'image_width' => 447,
		'image_height' => 601,
		'thumb_width' => 80 + $thumbs_extra
	),
	'two_views' => Array(
		'url' => 'two_views.jpg',
		'title' => 'Two Views',
		'desc' => 'Acrylic on canvas, 18" x 24"',
		'image_width' => 840,
		'image_height' => 634,
		'thumb_width' => 143 + $thumbs_extra
	),
	// 'untitled' => Array(
		// 'url' => 'untitled.jpg',
		// 'title' => 'Untitled',
		// 'desc' => 'Acrylic on canvas, 20" x 20"',
		// 'image_width' => 629,
		// 'image_height' => 625,
		// 'thumb_width' => 109 + $thumbs_extra
	// ),
	'warm_day' => Array(
		'url' => 'warm_day.jpg',
		'title' => 'Warm Day',
		'desc' => 'Acrylic on canvas, 9" x 12"',
		'image_width' => 460,
		'image_height' => 620,
		'thumb_width' => 80 + $thumbs_extra
	),
	'waterfall' => Array(
		'url' => 'waterfall.jpg',
		'title' => 'Waterfall',
		'desc' => 'Oil pastels, watercolor on paper, 11" x 14"',
		'image_width' => 483,
		'image_height' => 620,
		'thumb_width' => 84 + $thumbs_extra
	),
	'westward' => Array(
		'url' => 'westward.jpg',
		'title' => 'Westward',
		'desc' => 'Acrylic on canvas, 11" x 14"',
		'image_width' => 487,
		'image_height' => 620,
		'thumb_width' => 84 + $thumbs_extra,
		'sold' => true
	),
	'wind' => Array(
		'url' => 'wind.jpg',
		'title' => 'Wind',
		'desc' => 'Mixed media on paper, 9" x 12"',
		'image_width' => 465,
		'image_height' => 622,
		'thumb_width' => 84 + $thumbs_extra
	),
	'winding_path' => Array(
		'url' => 'winding_path.jpg',
		'title' => 'Winding Path',
		'desc' => 'Acrylic on canvas, 16" x 20"',
		'image_width' => 799,
		'image_height' => 632,
		'thumb_width' => 136 + $thumbs_extra
	),
	'zzzzzz' => false // to end the array properly
);

$_work_tabs = Array(
	'2016' => Array('poinsettia_in_foil_vase', 'cascade'),
	'2015' => Array('city_life', 'sudden_arc', 'neighborhoods', 'silhouette', 'stained_glass', 'fragments', 'construction_and_calamity_1', 'construction_and_calamity_2', 'blue_orchid_2', 'blue_orchid_1', 'open_space', 'claiming_space', 'conscious_ascent', 'hushed_sentiment', 'shadows', 'flowers_in_a_square_vase', 'porcelain'),
	'2014' => Array('two_views', 'in_another_world', 'dream2', 'foliage', 'hope', 'asters', 'rose', 'frogs', 'field', 'growth', 'reflection', 'winding_path', 'revealed', 'glacier'),
	'2013' => Array('dream', 'near_the_window', 'westward', 'poinsettia', 'warm_day', 'together', 'waterfall', 'collected_objects'),
	'2012' => Array('autumn_flowers_1', 'autumn_flowers_2', 'roses_in_water', 'rain', 'wind', 'decorative_peppers', 'roses')
	//'Other' => Array('scissors', 'roses', 'beauty_contest') //, 'collected_objects'
);


?>