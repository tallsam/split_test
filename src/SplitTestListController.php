<?php
/**
 */

namespace Drupal\SplitTest;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

class SplitTestListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('Id');
    $header['first-theme'] = t('Theme A');
    $header['second-theme'] = t('Theme B');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['form'] = $this->getLabel($entity);
    // Special case the personal form.
    $row['first-theme'] = $entity->first_theme;
    $row['second-theme'] = $entity->second_theme;

    if ($entity->id() == 'personal') {
      $row['recipients'] = t('Selected user');
      $row['selected'] = t('No');
    }
    else {
      $row['recipients'] = String::checkPlain(implode(', ', $entity->getRecipients()));
      $default_form = \Drupal::config('contact.settings')->get('default_form');
      $row['selected'] = ($default_form == $entity->id() ? t('Yes') : t('No'));
    }
    return $row + parent::buildRow($entity);
  }


}