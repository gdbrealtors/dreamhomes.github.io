<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


class OSF_Elementor_Instagram extends Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve testimonial widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'opal-instagram';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve testimonial widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Opal Instagram', 'rehomes-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve testimonial widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-social-icons';
	}

	public function get_categories() {
		return array( 'opal-addons' );
	}

	/**
	 * Register testimonial widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_instagram',
			[
				'label' => __( 'Instagram Config', 'rehomes-core' ),
			]
		);


		$this->add_control(
			'username',
			[
				'label'   => __( 'Username', 'rehomes-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'instagram'
			]
		);

		$this->add_control(
			'number',
			[
				'label'   => __( 'Number of photos', 'rehomes-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_responsive_control(
			'per_row',
			[
				'label'   => __( 'Columns', 'rehomes-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 6,
				'options' => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10 ],
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => __( 'Photo size', 'rehomes-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'thumbnail',
				'options' => [
					'thumbnail' => 'Thumbnail',
					'large'     => 'Large',
				],
			]
		);

		$this->add_control(
			'target',
			[
				'label'   => __( 'Open link in', 'rehomes-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '_blank',
				'options' => [
					'_self'  => 'Current window (_self)',
					'_blank' => 'New window (_blank)',
				],
			]
		);

		$this->add_control(
			'design',
			[
				'label'   => __( 'Design', 'rehomes-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid'     => 'Grid',
					'carousel' => 'Carousel',
				],
			]
		);

        $this->add_control(
            'style',
            [
                'label'   => __( 'Style', 'rehomes-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'outsite',
                'options' => [
                    'insite'     => 'In site',
                    'outsite' => 'Out site',
                ],
                'prefix_class' => 'elementor-instagram-style-'
            ]
        );

		$this->add_control(
			'show_username',
			[
				'label' => __( 'Show Username', 'rehomes-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_time',
			[
				'label' => __( 'Show Time', 'rehomes-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_caption',
			[
				'label' => __( 'Show Caption', 'rehomes-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'number_caption',
			[
				'label'     => __( 'Number of text caption', 'rehomes-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 15,
				'condition' => [
					'show_caption!' => '',
				],
			]
		);

		$this->add_control(
			'show_like',
			[
				'label' => __( 'Show Like', 'rehomes-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
        $this->add_control(
            'show_comment',
            [
                'label' => __( 'Show Comment', 'rehomes-core' ),
                'type'  => Controls_Manager::SWITCHER,
                'condition' => [
                    'style' => 'insite',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Username', 'rehomes-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'username_align',
			[
				'label'     => __( 'Text Alignment', 'rehomes-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => __( 'Left', 'rehomes-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'rehomes-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'rehomes-core' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'rehomes-core' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .instagram-widget .username' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'show_username!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'username_padding',
			[
				'label'      => __( 'Padding', 'rehomes-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .instagram-widget .username' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_username!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'username_typography',
				'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
                ],
				'selector' => '{{WRAPPER}} .instagram-widget .username',
			]
		);

		$this->start_controls_tabs( 'tabs_username_style' );

		$this->start_controls_tab(
			'tab_username_normal',
			[
				'label' => __( 'Normal', 'rehomes-core' ),
			]
		);

		$this->add_control(
			'username_text_color',
			[
				'label'     => __( 'Text Color', 'rehomes-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .instagram-widget .username a' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_username_hover',
			[
				'label' => __( 'Hover', 'rehomes-core' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Text Color', 'rehomes-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .instagram-widget .username a:hover' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => __( 'Image', 'rehomes-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label'     => __( 'Space Between', 'rehomes-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .instagram-widget .instagram-picture'         => 'padding: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .instagram-widget '         => 'margin: calc( -{{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

        $this->add_responsive_control(
            'image_deviation',
            [
                'label'     => __( 'Image Deviation', 'rehomes-core' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .instagram-picture:nth-child(2n) .wrapp-picture'         => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

		$this->end_controls_section();

	}

	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$class = 'instagram-widget';
		echo '<div class="' . esc_attr( $class ) . '" >';
		if ( ! empty( $settings['username'] ) ) {
			$media_array = $this->otf_scrape_instagram( $settings['username'], $settings['number'] );
			if ( is_wp_error( $media_array ) ) {
				echo esc_html( $media_array->get_error_message() );
			} else {
				if ( $settings['show_username'] === 'yes' ) {
					echo '<div class="username"><a href="//instagram.com/' . $settings['username'] . '">@' . $settings['username'] . '</a></div>';
				}

                $this->add_render_attribute('row', 'data-elementor-columns', $settings['per_row']);
                if (!empty($settings['per_row_tablet'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['per_row_tablet']);
                }
                if (!empty($settings['per_row_mobile'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['per_row_mobile']);
                }

                if ($settings['design'] === 'grid') {
                    echo '<div class="instagram-pics"' . $this->get_render_attribute_string('row') . '>';
                }
                elseif ( $settings['design'] === 'carousel' ) {
					echo '<div class="instagram-pics owl-carousel" data-opal-carousel="true" data-dots="false" data-nav="false" data-items="' . esc_attr( $settings['per_row'] ) . '" data-loop="false">';
				}
				foreach ( $media_array as $item ) {
					$image       = ( ! empty( $item[ $settings['size'] ] ) ) ? $item[ $settings['size'] ] : $item['thumbnail'];
					$datetime    = $this->otf_fnc_time( $item['time'] );
					$description = $this->osf_fnc_excerpt( $item['description'], $settings['number_caption'], '...' );
					$result
					             = '<div class="instagram-picture column-item">
                        <div class="wrapp-picture">
                            <a href="' . esc_url( $item['link'] ) . '" target="' . esc_attr( $settings['target'] ) . '"></a>
                                <img src="' . esc_url( $image ) . '" alt="' . $description . '" />';
                    if ( $settings['show_like'] === 'yes' && $settings['style'] === 'insite' ) {
                        $result .= '<div class="instagram-like"><span>' . $this->otf_pretty_number( $item['likes'] ) . _n( ' like', ' likes', $item['likes'], 'rehomes-core' ) . '</span></div>';
                    }
                    if ( $settings['show_comment'] === 'yes' && $settings['style'] === 'insite' ) {
                        $result .= '<div class="instagram-comment"><span>' . $this->otf_pretty_number( $item['comments'] ) . _n( ' Comment',' Comments', $item['comments'] ,'rehomes-core' ) . '</span></div>';
                    }
					$result      .= '</div>';

                    if ($settings['show_time'] || $settings['show_caption'] || $settings['show_like']) {
                        $result .= '<div class="instagram-information">';
                        if ($settings['show_time'] === 'yes') {
                            $result .= '<div class="instagram-createdtime"><a href="' . esc_url($item['link']) . '" target="' . esc_attr($settings['target']) . '"><span>' . $datetime . '</span></a></div>';
                        }

                        if ($settings['show_caption'] === 'yes') {
                            $result .= '<div class="instagram-description"><span>' . $description . '</span></div>';
                        }


                        if ($settings['show_like'] === 'yes' && $settings['style'] === 'outsite') {
                            $result .= '<div class="instagram-like"><span>' . $this->otf_pretty_number($item['likes']) . _n(' like', ' likes', $item['likes'], 'rehomes-core') . '</span></div>';
                        }
                        $result .='</div>';
                    }
					$result
						.= '</div>';

					echo( $result );
				}
				?>
                </div>
				<?php
			}
		}

		echo '</div>';
	}


	private function otf_scrape_instagram( $username, $slice = 9 ) {
		$username   = strtolower( $username );
		$by_hashtag = ( substr( $username, 0, 1 ) == '#' );
		if ( false === ( $instagram = get_transient( 'otf-instagram-media-new-' . sanitize_title_with_dashes( $username ) ) ) ) {
			$request_param = ( $by_hashtag ) ? 'explore/tags/' . substr( $username, 1 ) : trim( $username );
			$remote        = wp_remote_get( 'https://instagram.com/' . $request_param );

			if ( is_wp_error( $remote ) ) {
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'rehomes-core' ) );
			}

			if ( 200 != wp_remote_retrieve_response_code( $remote ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'rehomes-core' ) );
			}

			$shards      = explode( 'window._sharedData = ', $remote['body'] );
			$insta_json  = explode( ';</script>', $shards[1] );
			$insta_array = json_decode( $insta_json[0], true );

			if ( ! $insta_array ) {
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'rehomes-core' ) );
			}


			// old style
			if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
				$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
				$type   = 'old';
				// old_2 style
			} elseif ( $by_hashtag && isset( $insta_array['entry_data']['TagPage'][0]['tag']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['TagPage'][0]['tag']['media']['nodes'];
				$type   = 'old_2';
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				$type   = 'old_2';
				// new style
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
				$type   = 'new';
				// new style
			} elseif ( $by_hashtag && isset( $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'] ) ) {
				$images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
				$type   = 'new';
			} else {
				return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'rehomes-core' ) );
			}


			if ( ! is_array( $images ) ) {
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'rehomes-core' ) );
			}

			$instagram = array();

			switch ( $type ) {
				case 'old':
					foreach ( $images as $image ) {
						if ( $image['user']['username'] == $username ) {
							$image['images']['thumbnail']           = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
							$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
							$image['images']['low_resolution']      = preg_replace( "/^http:/i", "", $image['images']['low_resolution'] );
							$instagram[]                            = array(
								'description' => $image['caption']['text'],
								'link'        => $image['link'],
								'time'        => $image['created_time'],
								'comments'    => $image['comments']['count'],
								'likes'       => $image['likes']['count'],
								'thumbnail'   => $image['images']['thumbnail'],
								'large'       => $image['images']['standard_resolution'],
								'small'       => $image['images']['low_resolution'],
								'type'        => $image['type']
							);
						}
					}
					break;
				case 'old_2':
					foreach ( $images as $image ) {
						$image['thumbnail_src'] = preg_replace( "/^https:/i", "", $image['thumbnail_src'] );
						$image['thumbnail']     = preg_replace( "/^https:/i", "", $image['thumbnail_resources'][0]['src'] );
						$image['medium']        = preg_replace( "/^https:/i", "", $image['thumbnail_resources'][2]['src'] );
						$image['large']         = $image['thumbnail_src'];
						$image['display_src']   = preg_replace( "/^https:/i", "", $image['display_src'] );
						if ( $image['is_video'] == true ) {
							$type = 'video';
						} else {
							$type = 'image';
						}
						$caption = esc_html__( 'Instagram Image', 'rehomes-core' );
						if ( ! empty( $image['caption'] ) ) {
							$caption = $image['caption'];
						}
						$instagram[] = array(
							'description' => $caption,
							'link'        => '//instagram.com/p/' . $image['code'],
							'time'        => $image['date'],
							'comments'    => $image['comments']['count'],
							'likes'       => $image['likes']['count'],
							'thumbnail'   => $image['thumbnail'],
							'medium'      => $image['medium'],
							'large'       => $image['large'],
							'original'    => $image['display_src'],
							'type'        => $type
						);
					}
					break;
				default:
					foreach ( $images as $image ) {
						$image   = $image['node'];
						$caption = esc_html__( 'Instagram Image', 'rehomes-core' );
						if ( ! empty( $image['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
							$caption = $image['edge_media_to_caption']['edges'][0]['node']['text'];
						}

						$image['thumbnail_src'] = preg_replace( "/^https:/i", "", $image['thumbnail_src'] );
						$image['thumbnail']     = preg_replace( "/^https:/i", "", $image['thumbnail_resources'][0]['src'] );
						$image['medium']        = preg_replace( "/^https:/i", "", $image['thumbnail_resources'][2]['src'] );
						$image['large']         = $image['thumbnail_src'];

						$type = ( $image['is_video'] ) ? 'video' : 'image';

						$instagram[] = array(
							'description' => $caption,
							'link'        => '//instagram.com/p/' . $image['shortcode'],
							'time'        => $image['taken_at_timestamp'],
							'comments'    => $image['edge_media_to_comment']['count'],
							'likes'       => $image['edge_liked_by']['count'],
							'thumbnail'   => $image['thumbnail'],
							'medium'      => $image['medium'],
							'large'       => $image['large'],
							'type'        => $type
						);
					}
					break;
			}
			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( maybe_serialize( $instagram ) );
				set_transient( 'otf-instagram-media-new-' . sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS * 2 ) );
			}
		}
		if ( ! empty( $instagram ) ) {
			$instagram = maybe_unserialize( base64_decode( $instagram ) );

			return array_slice( $instagram, 0, $slice );
		} else {
			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'rehomes-core' ) );
		}
	}

	private function otf_pretty_number( $x = 0 ) {
		$x = (int) $x;

		if ( $x > 1000000 ) {
			return floor( $x / 1000000 ) . 'M';
		}

		if ( $x > 10000 ) {
			return floor( $x / 1000 ) . 'k';
		}

		return $x;
	}

	private function osf_fnc_excerpt( $excerpt, $limit, $afterlimit = '[...]' ) {
		$limit = empty( $limit ) ? 20 : $limit;
		if ( $excerpt != '' ) {
			$excerpt = @explode( ' ', strip_tags( $excerpt ), $limit );
		} else {
			$excerpt = @explode( ' ', strip_tags( get_the_content() ), $limit );
		}
		if ( count( $excerpt ) >= $limit ) {
			@array_pop( $excerpt );
			$excerpt = @implode( " ", $excerpt ) . ' ' . $afterlimit;
		} else {
			$excerpt = @implode( " ", $excerpt );
		}
		$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );

		return strip_shortcodes( $excerpt );
	}

	private function otf_fnc_time( $time ) {
		$date = ( current_time( 'timestamp' ) - $time ) / ( 3600 * 24 );

		if ( $date > 7 ) {
			return date_i18n( get_option( 'date_format' ), $time );
		} else {
			return human_time_diff( $time, current_time( 'timestamp' ) ) . __( ' ago', 'rehomes-core' );
		}
	}
}
$widgets_manager->register_widget_type(new OSF_Elementor_Instagram());