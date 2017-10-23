<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('site');
        $this->load->helper('form');
        $this->load->helper('string');
        $this->load->model('F_Model');
        $this->load->library('session');
        $pref_lang = $this->session->userdata('pref_lang');
        if ($pref_lang == 1) {
            $idiom = 'english';
        } else if ($pref_lang == 2) {
            $idiom = 'swedish';
        }
        $this->lang->load("all", $idiom);
    }

    public function index()
    {
        $this->load->view("admin/calendar_view", array());
    }

    public function get_events()
    {
        // Our Start and End Dates
        $start = $this->input->get("start");
        $end = $this->input->get("end");

        $startdt = new DateTime('now'); // setup a local datetime
        $startdt->setTimestamp($start); // Set the date based on timestamp
        $start_format = $startdt->format('Y-m-d H:i:s');

        $enddt = new DateTime('now'); // setup a local datetime
        $enddt->setTimestamp($end); // Set the date based on timestamp
        $end_format = $enddt->format('Y-m-d H:i:s');

        $events = $this->F_Model->get_events($start_format, $end_format);

        $data_events = array();

        foreach ($events->result() as $r) {

            $data_events[] = array(
                "id" => $r->ID,
                "title" => $r->title,
                "description" => $r->description,
                "end" => $r->end,
                "start" => $r->start
            );
        }

        echo json_encode(array("events" => $data_events));
        exit();
    }

    public function add_event()
    {
        /* Our calendar data */
        $name = $this->input->post("name", TRUE);
        $desc = $this->input->post("description", TRUE);
        $start_date = $this->input->post("start_date", TRUE);
        $end_date = $this->input->post("end_date", TRUE);

        if (!empty($start_date)) {
            $sd = DateTime::createFromFormat("Y-m-d H:i", $start_date);
            $start_date = $sd->format('Y-m-d H:i:s');
            $start_date_timestamp = $sd->getTimestamp();
        } else {
            $start_date = date("Y-m-d H:i:s", time());
            $start_date_timestamp = time();
        }

        if (!empty($end_date)) {
            $ed = DateTime::createFromFormat("Y-m-d H:i", $end_date);
            $end_date = $ed->format('Y-m-d H:i:s');
            $end_date_timestamp = $ed->getTimestamp();
        } else {
            $end_date = date("Y-m-d H:i:s", time());
            $end_date_timestamp = time();
        }

        $this->F_Model->add_event(array(
                "title" => $name,
                "description" => $desc,
                "start" => $start_date,
                "end" => $end_date
            )
        );
        redirect(site_url("calendar"));
    }

    public function edit_event()
    {
        $eventid = intval($this->input->post("eventid"));
        $event = $this->F_Model->get_event($eventid);
        if ($event->num_rows() == 0) {
            echo "Invalid Event";
            exit();
        }
        $event->row();

        /* Our calendar data */
        $name = $this->input->post("name");
        $desc = $this->input->post("description");
        $start_date = $this->input->post("start_date");
        $end_date = $this->input->post("end_date");
        $delete = intval($this->input->post("delete"));

        if (!$delete) {
            if (!empty($start_date)) {
                $sd = DateTime::createFromFormat("Y-m-d H:i", $start_date);
                $start_date = $sd->format('Y-m-d H:i:s');
                $start_date_timestamp = $sd->getTimestamp();
            } else {
                $start_date = date("Y-m-d H:i:s", time());
                $start_date_timestamp = time();
            }

            if (!empty($end_date)) {
                $ed = DateTime::createFromFormat("Y-m-d H:i", $end_date);
                $end_date = $ed->format('Y-m-d H:i:s');
                $end_date_timestamp = $ed->getTimestamp();
            } else {
                $end_date = date("Y-m-d H:i:s", time());
                $end_date_timestamp = time();
            }
            $where = "ID = '" . $eventid . "'";
            $this->F_Model->update_event($where, array(
                    "title" => $name,
                    "description" => $desc,
                    "start" => $start_date,
                    "end" => $end_date
                )
            );

        } else {
            $this->F_Model->delete_event($eventid);
        }
        redirect(site_url("calendar"));
    }
}

?>