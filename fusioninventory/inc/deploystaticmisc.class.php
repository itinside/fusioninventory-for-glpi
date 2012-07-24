<?php

/*
   ------------------------------------------------------------------------
   FusionInventory
   Copyright (C) 2010-2012 by the FusionInventory Development Team.

   http://www.fusioninventory.org/   http://forge.fusioninventory.org/
   ------------------------------------------------------------------------

   LICENSE

   This file is part of FusionInventory project.

   FusionInventory is free software: you can redistribute it and/or modify
   it under the terms of the GNU Affero General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   FusionInventory is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
   GNU Affero General Public License for more details.

   You should have received a copy of the GNU Affero General Public License
   along with Behaviors. If not, see <http://www.gnu.org/licenses/>.

   ------------------------------------------------------------------------

   @package   FusionInventory
   @author    David Durieux
   @co-author Alexandre Delaunay
   @copyright Copyright (c) 2010-2012 FusionInventory team
   @license   AGPL License 3.0 or (at your option) any later version
              http://www.gnu.org/licenses/agpl-3.0-standalone.html
   @link      http://www.fusioninventory.org/
   @link      http://forge.fusioninventory.org/projects/fusioninventory-for-glpi/
   @since     2010

   ------------------------------------------------------------------------
 */

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

class PluginFusioninventoryDeployStaticmisc {

   const DEPLOYMETHOD_INSTALL   = 'deployinstall';
   const DEPLOYMETHOD_UNINSTALL = 'deployuninstall';



   static function getDeploySelections() {

      $options['entity']      = $_SESSION['glpiactive_entity'];
      $options['entity_sons'] = 1;
      $options['name']        = 'definitionselectiontoadd';
      return Dropdown::show("PluginFusioninventoryDeployPackage", $options);
   }

  /* static function getDeployActions() {

      $options['entity']      = $_SESSION['glpiactive_entity'];
      $options['entity_sons'] = Session::haveAccessToEntity($_SESSION['glpiactive_entity'],1);
      $options['name']        = 'actionselectiontoadd';
      return Dropdown::show("Computer", $options);
   }*/

   static function getDeployActions() {

      $options['entity']      = $_SESSION['glpiactive_entity'];
      $options['entity_sons'] = 1;
      $options['name']        = 'actionselectiontoadd';
      return Dropdown::show("PluginFusioninventoryDeployGroup", $options);

   }

   static function task_definitionselection_PluginFusioninventoryDeployPackage_deployinstall() {
      return self::getDeploySelections();
   }

   static function task_definitionselection_PluginFusioninventoryDeployPackage_deployuninstall() {
      return self::getDeploySelections();
   }

   static function task_definitionselection_PluginFusioninventoryDeployGroup_deployinstall() {
      return self::getDeployActions();
   }

   static function task_definitionselection_PluginFusioninventoryDeployGroup_deployuninstall() {
      return self::getDeployActions();
   }

   static function task_actionselection_Computer_deployinstall() {
      $options = array();
      $options['entity']      = $_SESSION['glpiactive_entity'];
      $options['entity_sons'] = 1;
      $options['name']        = 'actionselectiontoadd';
      $options['condition']   = '`id` IN (SELECT `items_id` FROM `glpi_plugin_fusioninventory_agents`)';
      return Dropdown::show("Computer", $options);
   }
   static function task_actionselection_Computer_deployuninstall() {
      $options = array();
      $options['entity']      = $_SESSION['glpiactive_entity'];
      $options['entity_sons'] = 1;
      $options['name']        = 'actionselectiontoadd';
      $options['condition']   = '`id` IN (SELECT `items_id` FROM `glpi_plugin_fusioninventory_agents`)';
      return Dropdown::show("Computer", $options);
   }

   static function task_actionselection_Group_deployinstall() {
      $options = array();
      $options['entity']      = $_SESSION['glpiactive_entity'];
      $options['entity_sons'] = 1;
      $options['name']        = 'actionselectiontoadd';
      return Dropdown::show("Group", $options);
   }

   static function task_actionselection_PluginFusioninventoryAgent_deployinstall() {
      return self::getDeployActions();
   }

   static function task_actionselection_PluginFusioninventoryAgent_deployuninstall() {
      return self::getDeployActions();
   }

   static function displayMenu() {

      $a_menu = array();
      if (PluginFusioninventoryProfile::haveRight("fusinvdeploy", "packages", "r")) {
         $a_menu[0]['name'] = _('Package management');

         $a_menu[0]['pic']  = GLPI_ROOT."/plugins/fusinvdeploy/pics/menu_package.png";
         $a_menu[0]['link'] = GLPI_ROOT."/plugins/fusinvdeploy/front/package.php";
      }

      $a_menu[1]['name'] = _('Mirror servers');

      $a_menu[1]['pic']  = GLPI_ROOT."/plugins/fusinvdeploy/pics/menu_files.png";
      $a_menu[1]['link'] = GLPI_ROOT."/plugins/fusinvdeploy/front/mirror.php";

      $a_menu[2]['name'] = _('Groups of computers');

      $a_menu[2]['pic']  = GLPI_ROOT."/plugins/fusinvdeploy/pics/menu_group.png";
      $a_menu[2]['link'] = GLPI_ROOT."/plugins/fusinvdeploy/front/group.php";

      return $a_menu;
   }


   static function profiles() {

      return array(array('profil'  => 'packages',
                         'name'    => _('Manage packages')),

                   array('profil'  => 'status',
                         'name'    => _('Deployment status')));

   }

   static function task_deploy_getParameters() {
      global $CFG_GLPI;

      return array ('periodicity' => 3600, 'delayStartup' => 3600, 'task' => 'Deploy',
                    'remote' => PluginFusioninventoryAgentmodule::getUrlForModule('Deploy'));
   }


}

?>
