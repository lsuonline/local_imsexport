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
 * A scheduled task.
 *
 * The only imsexport function.
 * For every item that is weighted NATURAL extra credit in a non-excluded semester.
 * Sets the aggregationcoef to 1
 * Sets the aggregationcoef2 to 0
 * Sets the weightoverride to 1
 * Sets the needsupdate flag to 1
 *
 * @package    local_imsexport
 * @copyright  2017 Robert Russo, Louisiana State University
 */

namespace local_imsexport\task;

defined('MOODLE_INTERNAL') || die();

// Extend the Moodle scheduled task class with our mods.
class export_ims extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {

        return get_string('export_ims_task', 'local_imsexport');

    }

    /**
     * Do the job.
     *
     * Throw exceptions on errors (the job will be retried).
     */
    public function execute() {

        global $CFG;
        require_once($CFG->dirroot . '/local/imsexport/lib.php');
        $imsexport = new \imsexport();
        $imsexport->run_export_ims();

    }
}
