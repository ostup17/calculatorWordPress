<?php
add_action( 'wp_enqueue_scripts', 'true_enqueue_js_and_css' );
 
function true_enqueue_js_and_css() {
 
	// CSS
	wp_enqueue_style( 
		'style', // идентификатор стиля
		get_stylesheet_directory_uri() . '/calcstyle.css',  // URL стиля
		array(), // без зависимостей
		'5.0' // версия, это например ".../misha.css?ver=5.0"
	);
 
	// JavaScript
	wp_enqueue_script( 
		'calc_js', // идентификатор скрипта
		get_stylesheet_directory_uri() . '/script.js', // URL скрипта
		array( 'jquery' ), // зависимости от других скриптов
		time(), // версия каждую секунду разная, чтоб не кэшировать во время разработки 
		true // true - в футере, false – в хедере
	);
 
}
?>