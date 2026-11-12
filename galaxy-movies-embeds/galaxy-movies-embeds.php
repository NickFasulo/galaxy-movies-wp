<?php
/**
 * Plugin Name:       Galaxy Movies — Streaming Arrivals & Departures
 * Plugin URI:        https://www.galaxymovies.app/widgets
 * Description:       Embed daily-updated "new on" and "leaving" lists plus monthly churn stats for 20 US streaming services. Data from galaxymovies.app.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Galaxy Movies
 * Author URI:        https://www.galaxymovies.app
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       galaxy-movies-embeds
 *
 * @package galaxy-movies-embeds
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GME_VERSION', '1.0.0' );
define( 'GME_EMBED_BASE', 'https://www.galaxymovies.app/embed/' );

/**
 * Embeddable providers — mirrors embeddableProviders(): US services whose
 * diffs carry coming-soon data.
 *
 * @return array<string,string> Provider key => display label.
 */
function gme_providers() {
	return array(
		'netflix'            => 'Netflix',
		'amazon-prime-video' => 'Amazon Prime Video',
		'hulu'               => 'Hulu',
		'disney-plus'        => 'Disney+',
		'apple-tv'           => 'Apple TV',
		'max'                => 'HBO Max',
		'peacock'            => 'Peacock',
		'paramount-plus'     => 'Paramount+',
		'tubi'               => 'Tubi',
		'pluto-tv'           => 'Pluto TV',
		'roku-channel'       => 'The Roku Channel',
		'starz'              => 'Starz',
		'amc-plus'           => 'AMC+',
		'mgm-plus'           => 'MGM+',
		'crunchyroll'        => 'Crunchyroll',
		'discovery-plus'     => 'Discovery+',
		'plex'               => 'Plex',
		'kanopy'             => 'Kanopy',
		'shudder'            => 'Shudder',
		'criterion'          => 'Criterion Channel',
	);
}

/**
 * Renders the embed iframe for the [galaxy] shortcode and the block.
 *
 * @param array<string,mixed> $atts Shortcode/block attributes.
 * @return string
 */
function gme_render_embed( $atts ) {
	$atts = shortcode_atts(
		array(
			'provider' => 'netflix',
			'theme'    => 'dark',
			'kind'     => 'changes',
			'height'   => 380,
		),
		$atts,
		'galaxy'
	);

	$provider = sanitize_key( $atts['provider'] );
	$kind     = sanitize_key( $atts['kind'] );
	$theme    = 'light' === $atts['theme'] ? 'light' : 'dark';
	$height   = min( 900, max( 200, absint( $atts['height'] ) ) );

	if ( 'churn' !== $kind && ! isset( gme_providers()[ $provider ] ) ) {
		$msg = sprintf(
			/* translators: %s: the provider attribute value that failed validation */
			__( 'Galaxy Movies embed: unknown provider "%s".', 'galaxy-movies-embeds' ),
			$provider
		);
		$out = '<!-- ' . esc_html( $msg ) . ' -->';
		if ( current_user_can( 'edit_posts' ) ) {
			$out .= sprintf(
				'<p style="padding:12px;border:1px dashed #c00;color:#c00">%s %s</p>',
				esc_html( $msg ),
				/* translators: %s: comma-separated list of valid provider keys */
				esc_html( sprintf( __( 'Valid: %s', 'galaxy-movies-embeds' ), implode( ', ', array_keys( gme_providers() ) ) ) )
			);
		}
		return $out;
	}

	$src = 'churn' === $kind ? GME_EMBED_BASE . 'churn' : GME_EMBED_BASE . $provider;
	if ( 'light' === $theme ) {
		$src = add_query_arg( 'theme', 'light', $src );
	}

	return sprintf(
		'<iframe src="%s" height="%d" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="border:0;width:100%%"></iframe>',
		esc_url( $src ),
		$height
	);
}

add_shortcode( 'galaxy', 'gme_render_embed' );

/**
 * Registers the server-rendered block. Attrs map 1:1 onto the shortcode's,
 * so the same renderer covers both and the editor needs no JS render logic.
 */
function gme_register_block() {
	register_block_type(
		__DIR__ . '/block',
		array( 'render_callback' => 'gme_render_embed' )
	);
}
add_action( 'init', 'gme_register_block' );
