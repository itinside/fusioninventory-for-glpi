<?php
/*
 * @version $Id: computer.form.php 15453 2011-08-22 10:12:56Z yllen $
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2011 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software Foundation, Inc.,
 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------

define('GLPI_ROOT', '../../../');
include (GLPI_ROOT . "/inc/includes.php");

if (!isset($_GET["id"])) {
   $_GET["id"] = 0;
}

$collect = new PluginFusioninventoryInventoryComputerCollectContent();

//Add a new collectcontent
if (isset($_POST["add"])) {
//we need to rebuild the post.

   $data = array( 'plugin_fusioninventory_inventorycomputercollects_id' => $_POST['plugin_fusioninventory_inventorycomputercollects_id'],
               'plugin_fusioninventory_inventorycomputercollecttypes_id' => 
               $_POST['plugin_fusioninventory_inventorycomputercollecttypes_id'],
               'name' => $_POST['name']);

   switch($_POST['plugin_fusioninventory_inventorycomputercollecttypes_id']){
      case 1:
         $data['details'] = serialize(array( 'hives_id' => $_POST['hives_id'],
                                             'path'     => $_POST['path'],
                                             'key'      => $_POST['key'])
            );
         
      break;

      //getFromWMI
      case 2:
         $data['details'] = serialize(array( 'class' => $_POST['class'],
                                             'property'     => $_POST['property']));
      break;

      //findFile
      case 3:
         $data['details'] = serialize(array( 'path'         => $_POST['path'],
                                             'filename'     => $_POST['filename'],
                                             'getcontent'   => $_POST['getcontent']));        
      break;
      //runCommand
      case 4:
         $data['details'] = serialize(array( 'path'         => $_POST['path'],
                                             'command'     => $_POST['command']));        
      break;
   }

   $collect->add($data);
   Html::redirect($_SERVER['HTTP_REFERER']);
// update the properties
} else if (isset($_POST["delete_x"])) {

   $collect->delete($_POST);

   
   Html::redirect($_SERVER['HTTP_REFERER']);

}else{ //shoudn't happen
   Html::redirect($_SERVER['HTTP_REFERER']);
}

?>
