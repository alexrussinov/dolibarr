<?php
/* Copyright (C) 2004-2005 Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2009 Laurent Destailleur  <eldy@users.sourceforge.net>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *	\defgroup   syslog  Module syslog
 *	\brief      Module pour gerer les messages d'erreur dans syslog
 *	\file       htdocs/core/modules/modSyslog.class.php
 *	\ingroup    syslog
 *	\brief      Fichier de description et activation du module de syslog
 */

include_once(DOL_DOCUMENT_ROOT ."/core/modules/DolibarrModules.class.php");

/**
 *	\class      modSyslog
 *	\brief      Class to enable/disable module Logs
 */
class modSyslog extends DolibarrModules
{

	/**
	 *   Constructor. Define names, constants, directories, boxes, permissions
	 *
	 *   @param      DoliDB		$db      Database handler
	 */
	function __construct($db)
	{
		$this->db = $db;
		$this->numero = 42;

		// Family can be 'crm','financial','hr','projects','products','ecm','technic','other'
		// It is used to group modules in module setup page
		$this->family = "base";
		// Module label (no space allowed), used if translation string 'ModuleXXXName' not found (where XXX is value of numeric property 'numero' of module)
		$this->name = preg_replace('/^mod/i','',get_class($this));
		// Module description, used if translation string 'ModuleXXXDesc' not found (where XXX is value of numeric property 'numero' of module)
		$this->description = "Activate debug logs (syslog)";
		// Can be enabled / disabled only in the main company
		$this->core_enabled = 1;
		// Possible values for version are: 'development', 'experimental', 'dolibarr' or version
		$this->version = 'dolibarr';    // 'experimental' or 'dolibarr' or version
		// Key used in llx_const table to save module status enabled/disabled (where MYMODULE is value of property name of module in uppercase)
		$this->const_name = 'MAIN_MODULE_'.strtoupper($this->name);
		// Where to store the module in setup page (0=common,1=interface,2=others,3=very specific)
		$this->special = 2;
		// Name of image file used for this module.
		$this->picto='technic';

		// Data directories to create when module is enabled
		$this->dirs = array();

		// Config pages
		$this->config_page_url = array("syslog.php");

		// Dependances
		$this->depends = array();
		$this->requiredby = array();

		// Constantes
		$this->const = array();

		// Boites
		$this->boxes = array();

		// Permissions
		$this->rights = array();
		$this->rights_class = 'syslog';
	}


	/**
	 *		Function called when module is enabled.
	 *		The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
	 *		It also creates data directories
	 *
     *      @param      string	$options    Options when enabling module ('', 'noboxes')
	 *      @return     int             	1 if OK, 0 if KO
	 */
	function init($options='')
	{
		$sql = array();

		return $this->_init($sql,$options);

	}

    /**
	 *		Function called when module is disabled.
	 *      Remove from database constants, boxes and permissions from Dolibarr database.
	 *		Data directories are not deleted
	 *
     *      @param      string	$options    Options when enabling module ('', 'noboxes')
	 *      @return     int             	1 if OK, 0 if KO
     */
    function remove($options='')
    {
		$sql = array();

		return $this->_remove($sql,$options);
    }

}
?>
