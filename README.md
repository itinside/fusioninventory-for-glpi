AIX LPAR support
----------------

This patch serie will be integrated in glpi0.84 branch. For the moment,
you have to update your MySQL database yourself:

    ALTER TABLE glpi_plugin_fusinvinventory_computers ADD COLUMN `vmname` VARCHAR(255) DEFAULT NULL;
    ALTER TABLE glpi_plugin_fusinvinventory_computers ADD COLUMN `vmid` VARCHAR(255) DEFAULT NULL;
    ALTER TABLE glpi_plugin_fusinvinventory_computers ADD COLUMN `vmfull` VARCHAR(255) DEFAULT NULL;


We need to create two rules in top of “FusionInventory - Equipment import and link rules”:

1. "LPAR link (update)" : 
   * criteria : "Assets to import : VMID+VMNAME" + "is already present in GLPI" + "yes"
   * action : "Fusioninventory link" + "assign" + "Link if possible, else create device"
2. "LPAR link (creation)"
   * criteria : "Assets to import : VMID+VMNAME" + "exists" + "yes"
   * action : "Fusioninventory link" + "assign" + "Link if possible, else create device"
