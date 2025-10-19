<?php
/**
 * WPML Manager
 *
 * @package EduMentor
 * @version 1.0.0
 */
namespace HexQode\EduMentor\Classes;

defined( 'ABSPATH' ) || die();

class WpmlManager{

    public function init() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'add_widgets_to_translate' ] );
	}

    public function add_widgets_to_translate( $widgets ) {
        $widgets_map = [
            // Category Carousel
            'hq-category-carousel' => [
				'fields' => [
                    [
                        'field'       => 'count_text',
                        'type'        => esc_html__( 'Category Carousel: Count Text', 'edumentor' ),
                        'editor_type' => 'LINE',
                    ]
                ],
			],
            
            // Posts Carousel
            'hq-posts-carousel' => [
				'fields' => [
                    [
                        'field'       => 'posted_by',
                        'type'        => esc_html__( 'Posts Carousel: Posted by Text', 'edumentor' ),
                        'editor_type' => 'LINE',
                    ],
                    [
                        'field'       => 'readmore_text',
                        'type'        => esc_html__( 'Posts Carousel: Readmore Text', 'edumentor' ),
                        'editor_type' => 'LINE',
                    ],
                ]
			],
        ];

        foreach ( $widgets_map as $key => $data ) {

			$entry = [
				'conditions' => [
					'widgetType' => $key,
				],
				'fields' => $data['fields'],
			];

			if ( isset( $data['integration-class'] ) ) {
				$entry['integration-class'] = $data['integration-class'];
			}

			$widgets[ $key ] = $entry;
		}

		return $widgets;
    }
}