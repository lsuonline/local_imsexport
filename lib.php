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
 * imsexport lib.
 *
 * Class for building scheduled task functions
 * for fixing core and third party issues
 *
 * @package    local_imsexport
 * @copyright  2017 Robert Russo, Louisiana State University
 */

defined('MOODLE_INTERNAL') or die();

// Building the class for the task to be run during scheduled tasks.
class imsexport {

    public $emaillog;

    /**
     * Master function for building the data.
     *
     * @return boolean
     */
    public function run_export_ims() {
        global $CFG, $DB;

	// Setting some stuff for later.
	$imssql = $CFG->local_imsexport_sql;
        $filename = "$CFG->dataroot/$CFG->local_imsexport_filename";

        // Standard moodle function to get records from the configured sql.
        $items = $DB->get_records_sql($imssql);

        // Setting up the arrays to use later.
        $itemids = array();

        // Set the start time so we can log how long this takes.
        $starttime = time();

        // Start feeding data into the logger.
        $this->log("Beginning building the data file.");

        // Don't do anything if we don't have any items to work with.
        if ($items) {
            $handle = fopen($filename, 'w');

            // Creates arrays from the list of Grade Item ids and Course ids.
            $i=0;
            foreach ($items as $itemid) {
                $i++;
                $header = implode(array_keys((array) $itemid), ',');
                if($i == 1) {
                    break;
                }
           }

            self::ims_write_csv_header_row($handle, $header);

            $i=0;
            foreach ($items as $itemid) {
                $i++;
                $header = implode(array_keys((array) $itemid), ',');
                $itemids[] = $itemid;
                $row = implode((array) $itemid, ',');
                self::ims_write_csv_row($handle, $row);
            }

            // Finishes up the log.
            $this->log("Finished building the data file.");

            // How long in hundreths of a second did this job take.
            $elapsedtime = round(time() - $starttime, 2);
            $this->log("The process to build your data file took " . $elapsedtime . " seconds.");

        } else {

            // We did not have anything to do.
            $this->log("I found nothing using your provided SQL.");
        }

        if (!empty($handle)) {
            fclose($handle);
        }

        // Send an email to administrators regarding this.
        $this->email_imslog_report_to_admins();
    }

    function ims_write_csv_row($handle, $itemids) {
        fwrite($handle, $itemids . "\r\n");
    }

    function ims_write_csv_header_row($handle, $header) {
        self::ims_write_csv_row($handle, $header);
    }

    /**
     * Emails a log report to admin users
     *
     * @return void
     */
    private function email_imslog_report_to_admins() {
        global $CFG;

        // Get email content from email log.
        $emailcontent = implode("\n", $this->emaillog);

        // Send to each admin.
        $users = get_admins();
        foreach ($users as $user) {
            $replyto = '';
            email_to_user($user, "Data File Generation", sprintf('Data File Generation for [%s]', $CFG->wwwroot), $emailcontent);
        }
    }

    /**
     * print during cron run and prep log data for emailling
     *
     * @param $what: data being sent to $this->log
     */
    private function log($what) {
        mtrace($what);

        $this->emaillog[] = $what;
    }
}
