<?php
//CLEANUP HEADER
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head','rel_canonical');
remove_filter( 'template_redirect', 'redirect_canonical');
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Отключаем сам REST API
 add_filter('rest_enabled', '__return_false');

// Отключаем фильтры REST API
 remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
 remove_action( 'wp_head', 'rest_output_link_wp_head', 10, 0 );
 remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
 remove_action( 'auth_cookie_malformed', 'rest_cookie_collect_status' );
 remove_action( 'auth_cookie_expired', 'rest_cookie_collect_status' );
 remove_action( 'auth_cookie_bad_username', 'rest_cookie_collect_status' );
 remove_action( 'auth_cookie_bad_hash', 'rest_cookie_collect_status' );
 remove_action( 'auth_cookie_valid', 'rest_cookie_collect_status' );
 remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );

// Отключаем события REST API
 remove_action( 'init', 'rest_api_init' );
 remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
 remove_action( 'parse_request', 'rest_api_loaded' );

// Отключаем Embeds связанные с REST API
 remove_action( 'rest_api_init', 'wp_oembed_register_route' );
 remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );

// removes oembed discorvery link
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

// Remove emoji script & dns-prefetch link
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_filter( 'emoji_svg_url', '__return_false' );

// Add menu for admin panel
add_theme_support( 'menus' );

register_nav_menus( array(
    'main' => 'Main menu',
    'footer' => 'Footer menu'
) );
include 'wp_bem_menu.php';

// Add thumbnails image for posts
add_theme_support( 'post-thumbnails' );
add_image_size('gallery-img',400,300,true);
add_image_size('post-img',400,250,true);
add_image_size('post-single-img',760,400,true);
add_image_size('post-gallery-img',220,165,true);
add_image_size('img-xs',160,160,true);
add_image_size('img-sm',200,200,true);
add_image_size('img-xl',1200,900,true);


//--------------------------Относительные пути для картинок и ссылок------------------------------------------------------------------------------------//
/* start remove homeurl */
function removeHomeUrl($input) {
        $mass = explode("/", $input);
    $del_url = $mass[0]."//".$mass[2];
    return str_replace( $del_url, "", $input );
}
add_filter( 'plugins_url', 'removeHomeUrl' );
add_filter( 'the_permalink', 'removeHomeUrl' );
add_filter( 'template_directory_uri', 'removeHomeUrl' );
add_filter( 'bloginfo_url', 'removeHomeUrl' );
add_filter( 'script_loader_src', 'removeHomeUrl' );
add_filter( 'style_loader_src', 'removeHomeUrl' );
add_filter( 'category_link', 'removeHomeUrl' );
add_filter( 'page_link', 'removeHomeUrl' );
add_filter( 'post_link', 'removeHomeUrl' );
add_filter( 'term_link', 'removeHomeUrl' );
add_filter( 'tag_link', 'removeHomeUrl' );
function attachment_image($attrs) {
    $url_sectors = preg_split('/\//', $attrs['src']);
    unset($url_sectors[0]);
    unset($url_sectors[1]);
    unset($url_sectors[2]);
    $attrs['src'] = '/'.join('/', $url_sectors);
    return $attrs;
}
add_filter('wp_get_attachment_image_attributes', 'attachment_image');
add_filter('wp_get_attachment_image_attributes', function($attr) {
        if (isset($attr['sizes'])) unset($attr['sizes']);
        if (isset($attr['srcset'])) unset($attr['srcset']);
        return $attr;
}, PHP_INT_MAX);

add_filter('wp_calculate_image_srcset_meta', '__return_null' );
add_filter('wp_calculate_image_sizes', '__return_false',  99 );
remove_filter('the_content', 'wp_make_content_images_responsive' );
add_filter('wp_get_attachment_image_attributes', 'unset_attach_srcset_attr', 99 );
function unset_attach_srcset_attr( $attr ){
        foreach( array('sizes','srcset') as $key )
                if( isset($attr[ $key ]) )    unset($attr[ $key ]);
        return $attr;
}
/* end remove homeurl */

/* Убираем width, height у картинок */
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
//--------------------------Заменим активный элемент меню на span------------------------------------------------------------------------------------//
add_filter( "wp_nav_menu_items", 'currentitem', 99 );
function currentitem($items) {
    $elements = explode( '<li', $items );
    //var_dump($elements);
    $newmenu = array();
    foreach($elements as $element) {
        $element = '<li'.$element;
        $needle = 'current';
        $pos = strripos($element, $needle);
        if ($pos === false) {
            $newmenu[] = $element;
        } else {
            $element = preg_replace("!<a (.*?)>(.*?)</a>!si","<span>\\2</span>", $element);
            $newmenu[] = $element;
        }
    }
    $fruit = array_shift($newmenu);
    $newitems = '';
    foreach($newmenu as $item) {
        $newitems .= $item;
    }
    return $newitems;
}

//--------------------------Обрезка текста (excerpt)------------------------------------------------------------------------------------//
/**
 * Шоткоды вырезаются. Минимальное значение maxchar может быть 22.
 * version 2.2
 * 
 * @param  массив/строка $args аргументы. Смотрите переменную $default.
 * @return строка HTML
 */
function kama_excerpt( $args = '' ){
	global $post;

	$default = array(
		'maxchar'     => 350, // количество символов.
		'text'        => '',  // какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
							  // Если есть тег <!--more-->, то maxchar игнорируется и берется все до <!--more--> вместе с HTML
		'save_format' => false, // Сохранять перенос строк или нет. Если в параметр указать теги, то они НЕ будут вырезаться: пр. '<strong><a>'
		'more_text'   => 'Читати далі...', // текст ссылки читать дальше
		'echo'        => true, // выводить на экран или возвращать (return) для обработки.
	);

	if( is_array($args) )
		$rgs = $args;
	else
		parse_str( $args, $rgs );

	$args = array_merge( $default, $rgs );

	extract( $args );

	if( ! $text ){
		$text = $post->post_excerpt ? $post->post_excerpt : $post->post_content;

		$text = preg_replace ('~\[[^\]]+\]~', '', $text ); // убираем шоткоды, например:[singlepic id=3]
		// $text = strip_shortcodes( $text ); // или можно так обрезать шоткоды, так будет вырезан шоткод и конструкция текста внутри него
		// и только те шоткоды которые зарегистрированы в WordPress. И эта операция быстрая, но она в десятки раз дольше предыдущей 
		// (хотя там очень маленькие цифры в пределах одной секунды на 50000 повторений)

		// для тега <!--more-->
		if( ! $post->post_excerpt && strpos( $post->post_content, '<!--more-->') ){
			preg_match ('~(.*)<!--more-->~s', $text, $match );
			$text = trim( $match[1] );
			$text = str_replace("\r", '', $text );
			$text = preg_replace( "~\n\n+~s", "</p><p>", $text );

			$more_text = $more_text ? '<a class="kexc_moretext" href="'. get_permalink( $post->ID ) .'#more-'. $post->ID .'">'. $more_text .'</a>' : '';

			$text = '<p>'. str_replace( "\n", '<br />', $text ) .' '. $more_text .'</p>';

			if( $echo )
				return print $text;

			return $text;
		}
		elseif( ! $post->post_excerpt )
			$text = strip_tags( $text, $save_format );
	}   

	// Обрезаем
	if ( mb_strlen( $text ) > $maxchar ){
		$text = mb_substr( $text, 0, $maxchar );
		$text = preg_replace('@(.*)\s[^\s]*$@s', '\\1 ...', $text ); // убираем последнее слово, оно 99% неполное
	}

	// Сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $save_format ){
		$text = str_replace("\r", '', $text );
		$text = preg_replace("~\n\n+~", "</p><p>", $text );
		$text = "<p>". str_replace ("\n", "<br />", trim( $text ) ) ."</p>";
	}

	//$out = preg_replace('@\*[a-z0-9-_]{0,15}\*@', '', $out); // удалить *some_name-1* - фильтр смайлов

	if( $echo ) return print $text;

	return $text;
}

?>
