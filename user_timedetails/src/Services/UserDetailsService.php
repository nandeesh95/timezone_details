<?php

namespace Drupal\user_timedetails\Services;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Component\Datetime\Time;
use Drupal\Core\Config\ConfigFactory;

/**
 * Class UserDetailsService.
 */
class UserDetailsService{
  
  protected $configfactory;
  protected $userTimezoneConfig;
  protected $time;

  /**
   * Constructs a new UserDetailsService object.
   * 
   */
  public function __construct(configFactory $configfactory, Time $time) {
    $this->userTimezoneConfig = $configfactory->get('user_timedetails.usertimezone');
    $this->time = $time;
  }
  /**
   * Helper function to get user timezone details.
   */
  public function getTime(){
    $timezone = $this->userTimezoneConfig->get('timezone');
    $date = new DrupalDateTime();
    $date->setTimezone(new \DateTimeZone($timezone)); 
    $date_time = $date->format('dS M Y g:i A');
    return $date_time;

  }
}
