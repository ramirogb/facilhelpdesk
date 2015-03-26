<?php
/***************************************************************************
 *   Copyright (C) 2006 by Yeiniel Suarez Sosa                             *
 *   yeiniel@uclv.edu.cu                                                   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 *   This program is distributed in the hope that it will be useful,       *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 *   GNU General Public License for more details.                          *
 *                                                                         *
 *   You should have received a copy of the GNU General Public License     *
 *   along with this program; if not, write to the                         *
 *   Free Software Foundation, Inc.,                                       *
 *   59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             *
 ***************************************************************************/
include('config.lib.php');
	$c = new config();
	#set config file
	$c->config_setFile('configuration.php');#instead you can use $c->config_setNewFile($file) to create a new file
	#open a existing file
	$c->config_openFile();
	$c->config_insert('opwDataBaseType','MySQL');
	$c->config_insert('opw_db','test');
	$c->config_insert('opw_dbUser','user');
	$c->config_insert('opw_dbPass','pass');
  $c->config_insert('opw_dbHost','localhost');
  $c->config_insert('opwBin','default_p');
  #write changes to file
  $c->config_closeFile();
?>