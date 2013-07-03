<?php
/*
Plugin Name: Subscriber login redirect
Plugin URI: http://carbolowdrates.com
Description: Redirects the user home instead of to the profile edit page
Version: 0.1
Author: Dave Preece
Author URI: http://www.scumonline.co.uk
License: GPL

Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : dangerous@scumonline.co.uk)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_filter('login_redirect', 'check_profile_access', 10, 3);

function check_profile_access($redirect_to, $request, $user){
	if($redirect_to !== admin_url() && $redirect_to !== ''){
		return $redirect_to;
	}
	
	if(!$user || !isset($user->roles)){
		return;
	}
	
	if(in_array('subscriber', $user->roles)){
		return home_url();
	}
	
	return get_admin_url();
}