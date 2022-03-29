<?php

namespace Drupal\user_timedetails\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class usertimezone.
 */
class usertimezone extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'user_timedetails.usertimezone',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_timedetails';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('user_timedetails.usertimezone');
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#description' => $this->t('Please enter country name.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('country'),
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#description' => $this->t('Please enter city name'),
      '#maxlength' => 64,
      '#size' => 64,
      '#default_value' => $config->get('city'),
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#description' => $this->t('Select timezone.'),
      '#options' => ['Options in the select list' => $this->t('Options in the select list'), 'America/Chicago' => $this->t('America/Chicago'), 'America/New_York' => $this->t('America/New_York'), 'Asia/Tokyo' => $this->t('Asia/Tokyo'), 'Asia/Dubai' => $this->t('Asia/Dubai'), 'Asia/Kolkata' => $this->t('Asia/Kolkata'), 'Europe/Amsterdam' => $this->t('Europe/Amsterdam'), 'Europe/Oslo' => $this->t('Europe/Oslo'), 'Europe/London' => $this->t('Europe/London')],
      '#size' => 5,
      '#default_value' => $config->get('timezone'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('user_timedetails.usertimezone')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
  }

}
