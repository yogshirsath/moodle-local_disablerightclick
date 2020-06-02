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
 * Api services code
 *
 * @package     local_disablerightclick
 * @copyright   2020 Yogesh Shirsath <yogshirsath@hotmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author      Yogesh Shirsath
 */


namespace local_disablerightclick\external;

defined('MOODLE_INTERNAL') || die();

use external_api;
use external_function_parameters;
use external_value;
use stdClass;
use local_disablerightclick\controller as controller;

/**
 * All external services functions are defined in api class.
 *
 * @copyright   2020 Yogesh Shirsath <yogshirsath@hotmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class api extends external_api {
    /**
     * Describes the parameters for settings
     * @return external_function_parameters
     */
    public static function settings_parameters() {
        return new external_function_parameters(
            []
        );
    }

    /**
     * Get settings
     * @return String JSON encoded settings
     */
    public static function settings() {
        $stringmanager = get_string_manager();
        $data = [
            'settings' => [],
            'strings' => []
        ];
        if (!(new controller())->is_allowed()) {
            $data = [
                'settings' => get_config('local_disablerightclick'),
                'strings' => $stringmanager->load_component_strings('local_disablerightclick', current_language())
            ];
        }
        return json_encode($data);
    }

    /**
     * Returns description of method parameters for Settings
     * @return external_single_structure
     */
    public static function settings_returns() {
        return new external_value(PARAM_RAW, 'Settings');
    }
}
