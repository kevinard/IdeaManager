<?php 
/**
 * Copyright (C) 2011 - K√©vin O'NEILL, Fran√ßois KLINGLER - <contact@42framework.com>
 * 
 * 42framework is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * 42framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
 */

$config = array(
	'environment' => 'development',
        'errorReporting' => E_ALL|E_STRICT,
	'displayErrors' => 1,
	'defaultModule' => 'website',
        'defaultAction' => 'index',
	'defaultLayout' => false,
	'defaultCharset' => 'utf-8',
	'defaultLanguage' => 'fr_FR',
	'defaultTimezone' => 'Europe/Paris',
	'viewExtension' => '.php',
	'siteUrl' => 'http://localhost/',
	'routes' => array(),
	'historySize' => 2,
	'errorHandlerListeners' => array('framework\\errorHandler\\listeners\\Html'),
	'viewExtension' => '.php',
        'langExtension' => '.php',
	'applicationFilters' => array(),
	'viewFilters' => array(),
	'events' => array(),
	'dbConnectionParams' => array(
		'driver' => 'pdo_sqlite',
		'path' => APPLICATION_DIR.DS.'database'.DS.'db.sqlite'
	)
);