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

// Ensure the user is not trying to access this directly.
defined('MOODLE_INTERNAL') || die();

$plugin->version = 2021011400;
$plugin->requires = 2015111600;
$plugin->component = 'local_imsexport';
$plugin->maturity = MATURITY_STABLE;
$plugin->release = '1.0';
