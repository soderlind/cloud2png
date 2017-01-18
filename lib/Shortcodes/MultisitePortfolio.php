<?php

namespace Cloud2PNG\Shortcodes;
if ( ! class_exists( 'Cloud2PNG\Shortcodes\MultisitePortfolio' ) ) {
	class MultisitePortfolio extends Shortcode {

		public function init() {
			add_shortcode( 'cloud2portfolio', array( $this, 'cloud2portfolio' ) );
		}

		public function cloud2portfolio( $attributes  ) {
			$attributes = shortcode_atts( array(
				'url' => home_url( '/' ),
				'baz' => 'default baz',
			), $attributes, 'cloud2png' );

			// return $this->webshot( $attributes['url'], $attributes );
		}
	}
}
