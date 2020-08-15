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

use stdClass;
use external_api;
use external_value;
use context_system;
use external_function_parameters;
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
            [
                'contextid' => new external_value(PARAM_INT, 'Context id', VALUE_DEFAULT, 0)
            ]
        );
    }

    /**
     * Get settings
     * @param  integer $contextid Context id of course
     * @return String             JSON encoded settings
     */
    public static function settings($contextid) {
        $stringmanager = get_string_manager();
        $controller = new controller();
        $data = [
            'showsupport' => $controller->show_support(),
            'strings' => $stringmanager->load_component_strings('local_disablerightclick', current_language()),
            'settings' => [],
        ];
        if (!$controller->is_allowed($contextid)) {
            $data['settings'] = get_config('local_disablerightclick');
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


    /**
     * Describes the parameters for settings
     * @return external_function_parameters
     */
    public static function support_parameters() {
        return new external_function_parameters(
            [
                'action' => new external_value(PARAM_ALPHA, 'Action to perform with support modal')
            ]
        );
    }

    /**
     * Get settings
     * @param  integer $action Action to apply on support modal
     * @return String          JSON encoded settings
     */
    public static function support($action) {
        $controller = new controller();
        return $controller->support_action($action);
    }

    /**
     * Returns description of method parameters for support action
     * @return external_single_structure
     */
    public static function support_returns() {
        return new external_value(PARAM_RAW, 'Support action status');
    }
}
