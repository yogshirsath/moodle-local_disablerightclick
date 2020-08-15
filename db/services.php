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
 * Services list
 *
 * @package     local_disablerightclick
 * @copyright   2020 Yogesh Shirsath <yogshirsath@hotmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author      Yogesh Shirsath
 */

defined('MOODLE_INTERNAL') || die();
$functions = [
    'local_disablerightclick_settings' => [
        'classname' => 'local_disablerightclick\external\api',
        'methodname' => 'settings',
        'classpath' => '',
        'description' => 'Get settings',
        'type' => 'read',
        'loginrequired' => false,
        'ajax' => true,
    ],
    'local_disablerightclick_support' => [
        'classname' => 'local_disablerightclick\external\api',
        'methodname' => 'support',
        'classpath' => '',
        'description' => 'Show support modal',
        'type' => 'read',
        'loginrequired' => true,
        'ajax' => true,
    ]
];
