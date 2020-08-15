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
 * Settings definition
 *
 * @package     local_disablerightclick
 * @copyright   2020 Yogesh Shirsath <yogshirsath@hotmail.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author      Yogesh Shirsath
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    // Settings will be NULL.
    $settings = new admin_settingpage('local_disablerightclick', get_string('pluginname', 'local_disablerightclick'));
    $ADMIN->add('localplugins', $settings);

    // Allow all on following pages.
    $settings->add(
        new admin_setting_configtextarea(
            'local_disablerightclick/allowall',
            get_string('allowall', 'local_disablerightclick'),
            get_string('allowalldesc', 'local_disablerightclick'),
            ''
        )
    );

    // Disable right click.
    $settings->add(
        new admin_setting_configcheckbox(
            'local_disablerightclick/disablerightclick',
            get_string('pluginname', 'local_disablerightclick'),
            get_string('disablerightclickdesc', 'local_disablerightclick'),
            true
        )
    );

    // Allow right click on following pages.
    $settings->add(
        new admin_setting_configtextarea(
            'local_disablerightclick/allowrightclick',
            get_string('allowrightclick', 'local_disablerightclick'),
            get_string('allowrightclickdesc', 'local_disablerightclick'),
            ''
        )
    );

    // Disable Cut Copy Paste.
    $settings->add(
        new admin_setting_configcheckbox(
            'local_disablerightclick/disablecutcopypaste',
            get_string('disablecutcopypaste', 'local_disablerightclick'),
            get_string('disablecutcopypastedesc', 'local_disablerightclick'),
            true
        )
    );

    // Allow cut, copy and paste on following pages.
    $settings->add(
        new admin_setting_configtextarea(
            'local_disablerightclick/allowcutcopypaste',
            get_string('allowcutcopypaste', 'local_disablerightclick'),
            get_string('allowcutcopypastedesc', 'local_disablerightclick'),
            ''
        )
    );

    // Disable Developer Tools.
    $settings->add(
        new admin_setting_configcheckbox(
            'local_disablerightclick/disabledevelopertools',
            get_string('disabledevelopertools', 'local_disablerightclick'),
            get_string('disabledevelopertoolsdesc', 'local_disablerightclick'),
            true
        )
    );

    // Allow developer tools on following pages.
    $settings->add(
        new admin_setting_configtextarea(
            'local_disablerightclick/allowdevelopertools',
            get_string('allowdevelopertools', 'local_disablerightclick'),
            get_string('allowdevelopertoolsdesc', 'local_disablerightclick'),
            ''
        )
    );
}
