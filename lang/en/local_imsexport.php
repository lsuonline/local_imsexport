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
 * The local_imsexport lang file.
 *
 * @package    local_imsexport
 * @copyright  2021 Robert Russo, Louisiana State University
 */

// The plugin name and description.
$string['pluginname'] = "IMS XML Exporter";
$string['pluginname_desc'] = "Periodically exports IMS XML from Moodle.";

// The name of the task.
$string['export_ims_task'] = 'Export IMS XML';

// The strings for the Settings.
$string['ims_xml_sql'] = 'IMS SQL';
$string['ims_xml_sql_desc'] = 'SQL for file generation. Should match your desired file format.';
$string['ims_xml_filename'] = 'File name';
$string['ims_xml_filename_desc'] = 'Ensure your webserver can write to the location.';
