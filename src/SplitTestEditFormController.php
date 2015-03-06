<?php

/**
 * @file
 * Contains \Drupal\split_test\SplitTestEditFormController.
 */

namespace Drupal\SplitTest;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\ConfigFormBaseTrait;
use Drupal\Core\Form\FormStateInterface;

class SplitTestEditFormController extends EntityForm  {
  use ConfigFormBaseTrait;

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['split_test.test'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $split_test = $this->entity;

    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $split_test->label(),
      '#description' => $this->t("Example: 'New layout' or 'Changing heading color'."),
      '#required' => TRUE,
    );
    $form['first'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('First Theme'),
      '#default_value' => $split_test->getFirstTheme(),
      '#description' => $this->t("Select the first theme to be split tested"),
      '#required' => TRUE,
    );
    $form['second'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Second Theme'),
      '#default_value' => $split_test->getSecondTheme(),
      '#description' => $this->t('Select the secoNd theme to be split tested.'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validate(array $form, FormStateInterface $form_state) {
    parent::validate($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $split_test = $this->entity;
    $status = $split_test->save();

    $edit_link = $this->entity->link($this->t('Edit'));
    if ($status == SAVED_UPDATED) {
      drupal_set_message($this->t('Split test %label has been updated.', array('%label' => $split_test->label())));
      $this->logger('contact')->notice('Split test %label has been updated.', array('%label' => $split_test->label(), 'link' => $edit_link));
    }
    else {
      drupal_set_message($this->t('Split test %label has been added.', array('%label' => $csplit_test->label())));
      $this->logger('contact')->notice('Split test %label has been added.', array('%label' => $split_test->label(), 'link' => $edit_link));
    }

    $form_state->setRedirectUrl($split_test->urlInfo('collection'));
  }
}