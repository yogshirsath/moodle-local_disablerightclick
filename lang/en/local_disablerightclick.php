<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package     local_disablerightclick
 * @copyright   (c) 2019 Yogesh Shirsath
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author      Yogesh Shirsath
 */

$string['pluginname'] = 'Disable Right Click';
$string['disablerightclickdesc'] = 'Right click(Context Menu) will be disabled throughout the site(Except Admin and Manager).';
$string['disablecutcopypaste'] = 'Disable Cut, Copy and Paste';
$string['disablecutcopypastedesc'] = 'Cut, Copy and Paste will be disabled throughout the site(Except Admin and Manager).';
$string['disabledevelopertools'] = 'Disable Developer tool shortcuts';
$string['disabledevelopertoolsdesc'] = 'Developer tool shortcuts(<a target="_blank" href="https://developers.google.com/web/tools/chrome-devtools/shortcuts">Chrome shortcuts list</a>) will be disabled throughout the site(Except Admin and Manager). Note: Tools can be opened through browser settings menu. Cannot disable that.';

// Warnings
$string['rightclick'] = 'Right click is disabled on this site.';
$string['cutcopypaste'] = 'Cut, Copy and Paste is disabled on this site.';
$string['developertools'] = 'Developer tools are disabled on this site.';
$string['pagerefresh'] = 'Page will refresh in 5 seconds. Close developer tool to prevent it.';