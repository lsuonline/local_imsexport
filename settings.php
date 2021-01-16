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
 * @package   local_imsexport
 * @copyright 2021 Robert Russo, Louisiana State University
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Make sure the user can config moodle.
if ($hassiteconfig) {

    // Set up the main settings page.
    $settings = new admin_settingpage('local_imsexport', get_string('pluginname', 'local_imsexport'));

    // Add this to the nav tree.
    $ADMIN->add('localplugins', $settings);

    // Add the header to the settings page.
    $settings->add(
        new admin_setting_heading('local_imsexport_header', '',
            get_string('pluginname_desc', 'local_imsexport')
        )
    );

    // Add the filename setting.
    $settings->add(
        new admin_setting_configtext('local_imsexport_filename',
            get_string('ims_xml_filename', 'local_imsexport'),
            get_string('ims_xml_filename_desc', 'local_imsexport'),
            '' //DEFAULT
        )
    );

    // Add the SQL setting.
    $settings->add(
        new admin_setting_configtextarea('local_imsexport_sql',
            get_string('ims_xml_sql', 'local_imsexport'),
	    get_string('ims_xml_sql_desc', 'local_imsexport'),
	    'Insert SQL here' //DEFAULT
        )
    );
}
