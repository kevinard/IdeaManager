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

namespace framework\libs;

class LangManager
{	
    //Traductions Data
    public $lang_data = array();
  
    public function __construct()
    {
        $lang_data = array();
    }

    public function init($lang_file_path)
    {
        if(file_exists($lang_file_path))
        {
            include($lang_file_path);          
        }      
        
        $this->lang_data = array_merge($this->lang_data,$lang);
    }
    
    public function get($key)
    {
        if(array_key_exists($key, $this->lang_data))
        {
            return $this->lang_data[$key];
        }
        else
        {
            return "*".$key."*";
        }
    }
}