<?php

namespace Drupal\user_timedetails\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\user_timedetails\Services\UserDetailsService;
use Drupal\Core\cache\UncacheableDependencyTrait;

/**
 * Provides a 'UserDetailBlock' block.
 *
 * @Block(
 *  id = "timezone_block",
 *  admin_label = @Translation("Timezone block"),
 * )
 */

class UserDetailBlock extends BlockBase implements ContainerFactoryPluginInterface{
  use UncacheableDependencyTrait;
 
  /**
   * The Timezone Service
   *
   * @var \Drupal\user_timedetails\Services\UserDetailsService
  */

  protected $UserDetailsService;

  /**
     * @param array $configuration
     * @param string $plugin_id
     * @param mixed $plugin_definition
     * @param \Drupal\user_timedetails\Services\UserDetailsService $UserDetailsService
     */
    public function __construct(array $configuration, $plugin_id, $plugin_definition, UserDetailsService $UserDetailsService) {
      parent::__construct($configuration, $plugin_id, $plugin_definition);
      $this->UserDetailsService = $UserDetailsService;
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @param array $configuration
     * @param string $plugin_id
     * @param mixed $plugin_definition
     *
     * @return static
     */
    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
      return new static(
        $configuration,
        $plugin_id,
        $plugin_definition,
        $container->get('user_timedetails.time_zone')
      );
    }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('user_timedetails.usertimezone');
    $city = $config->get('city');
    $country = $config->get('country');
    $renderable = [
      '#theme' => 'render_timezone_data',
      '#city' => $city,
      '#country' => $country,
      '#time' => $this->UserDetailsService->getTime(),
    ];

    return $renderable;

  }

}
