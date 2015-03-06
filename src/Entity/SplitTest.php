<?php

/**
 * @file
 * Contains Drupal\split_test\Entity\SplitTest.
 */

namespace Drupal\SplitTest\Entity;


use Drupal\SplitTest\SplitTestInterface;
use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the splitTest entity.
 *
 * @ingroup split_test
 *
 * @ConfigEntityType(
 *   id = "splitTest",
 *   label = @Translation("Split Test"),
 *   module = "split_test",
 *   controllers = {
 *     list_builder = "Drupal\splitTest\SplitTestListBuilder",
 *     form = {
 *       "add" = "Drupal\splitTest\SplitTestEditFormController",
 *       "edit" = "Drupal\splitTest\SplitTestEditFormController"
 *       "delete" = "Drupal\splitTest\SplitTestDeleteFormController"
 *     },
 *   },
 *   config_prefix = "split_test",
 *   admin_permission = 'administer split tests',
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   links = {
 *     "edit-form" = "split_test.split_test_edit",
 *     "delete-form" = "split_test.split_test_delete"
 *   }
 * )
 *
 */
class SplitTest extends ConfigEntityBase implements SplitTestInterface {
  /**
   * The custom block type ID.
   *
   * @var string
   */
  public $id;

  /**
   * The name of the first theme involved in the split test.
   *
   * @var string
   */
  public $first_theme;

  /**
   * The name of second theme involved in the split test.
   *
   * @var string
   */
  public $second_theme;
}
