<?php
/*
   ----------------------------------------------------------------------
   FusionInventory
   Copyright (C) 2003-2008 by the INDEPNET Development Team.

   http://www.fusioninventory.org/   http://forge.fusioninventory.org//
   ----------------------------------------------------------------------

   LICENSE

   This file is part of FusionInventory plugins.

   FusionInventory is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   FusionInventory is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with FusionInventory; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
   ------------------------------------------------------------------------
 */

// Original Author of file: David DURIEUX
// Purpose of file:
// ----------------------------------------------------------------------

if (!defined('GLPI_ROOT')) {
   define('GLPI_ROOT', '../../..');
}

include (GLPI_ROOT."/inc/includes.php");

commonHeader($LANG['plugin_fusinvdeploy']['deploystatus'][0],$_SERVER["PHP_SELF"],"plugins",
             "fusioninventory","deploy");


PluginFusioninventoryMenu::displayMenu("mini");
/*
if (!isset($_GET['sort'])) {
   $_GET['sort'] = 6;
   $_GET['order'] = 'DESC';
}
$_GET['target']="task.php";

Search::show('PluginFusinvdeployTaskjob');*/
PluginFusinvdeployState::showTasks();


commonFooter();

?>