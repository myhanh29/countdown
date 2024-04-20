<?php

class setcalendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

//Tag, Monat und Jahr für Kanlander setzen
    public function __construct($date = null) {

        $this->naviHref = htmlentities($_SERVER['PHP_SELF'] . "?page=calendar&event=user_calendar");
        //if(!isset($_GET['active_month'])&&!isset($_GET['active_year']))
        //{
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
        //}
        if (isset($_GET['active_month']) && isset($_GET['active_year'])) {

            if ($_GET['active_month'] != $this->active_month) {
                $this->active_year = $_GET['active_year'];
                $this->active_month = $_GET['active_month'];
                $this->active_day = '1';
            } else if (isset($_GET['active_day'])) {
                $this->active_day = $_GET['active_day'];
            }
        }
    }

//Termine von Database ergänzen
    public function add_event($name, $date_star, $date_end, $days = 1, $color = '',$priority) {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$name, $date_star, $date_end, $days, $color,$priority];
    }

    public function export_events_to_json() {

        $json_data = json_encode($this->events);
        return $json_data;
    }

    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '';
        $html .= '<div class="grid-container1">';
        $html .= '<div class="grid-item1">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= $this->_createNavi();
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<ul class="days">'; // Đổi thành danh sách (ul)
        foreach ($days as $day) {
            $html .= '<li class="day_name">' . $day . '</li>'; // Sử dụng thẻ li cho từng tên thứ
        }
        $html .= '</ul>';
        $html .= '<ul class="days">';

        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <li class="day_num ignore">
                    ' . ($num_days_last_month - $i + 1) . '
                </li>
            ';
        }
        $date = null;
        for ($i = 1; $i <= $num_days; $i++) {

            $selected = '';

            if ($i == $this->active_day || $this->active_month == ($date != null ? date('m', strtotime($date)) : date('m')) && $i == ($date != null ? date('d', strtotime($date)) : date('d'))) {
                $selected = ' selected';
            }

            $html .= '<li class="day_num' . $selected . '">';
            $html .= '<a href="' . $this->naviHref . '&active_month=' . $this->active_month . '&active_year=' . $this->active_year . '&active_day=' . $i . '">' . $i . '</a>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[3] - 1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[4] . '">';

                        $html .= '</div>';
                    }
                }
            }


            $html .= '</li>';
        }
        for ($i = 1; $i <= (42 - $num_days - max($first_day_of_week, 0)); $i++) {
            $html .= '
                <li class="day_num ignore">
                    ' . $i . '
                </li>
            ';
        }

        $html .= '</ul>';
        $html .= '</div>';
        $html .= $this->_createdaycalendar();
        $html .= '</div>';

        return $html;
    }

//Navi für Kalander
    private function _createNavi() {

        $nextMonth = $this->active_month == 12 ? 1 : intval($this->active_month) + 1;

        $nextYear = $this->active_month == 12 ? intval($this->active_year) + 1 : $this->active_year;

        $preMonth = $this->active_month == 1 ? 12 : intval($this->active_month) - 1;

        $preYear = $this->active_month == 1 ? intval($this->active_year) - 1 : $this->active_year;

        return

                '<a class="prev" href="' . $this->naviHref . '&active_month=' . sprintf('%02d', $preMonth) . '&active_year=' . $preYear . '">Prev</a>' .
                '<span class="title">' . date('Y M', strtotime($this->active_year . '-' . $this->active_month . '-1')) . '</span>' .
                '<a class="next" href="' . $this->naviHref . '&active_month=' . sprintf("%02d", $nextMonth) . '&active_year=' . $nextYear . '">Next</a>';
    }

// Kalander für jeden Tag mit Termine in Studen
    public function _createdaycalendar() {
        $html = '';

        $html .= '<div class="grid-item2">';
        $html .= '<div class="header1">';
        $html .= '<h3>Termine in dem Tag </h3>';
        $html .= '</div>';
        $html .= '<div class="timeslots-container">';
        $html .= '<ul class="timeslots">';
        for ($hour = 0; $hour < 24; $hour++) {
            $html .= '<li>';
            $formattedHour = sprintf("%02d:00", $hour);
            $html .= $formattedHour;
            $html .= '</li>';
        }
        $html .= '</ul>';
        $html .= '</div>';

        // Initialize an array to store filtered events
        $filteredEvents = [];

        // Loop through each hour and each event to filter events

        foreach ($this->events as $key => $event) {
            if (date('Y-m-d', strtotime($event[1])) <= date('Y-m-d', mktime(0, 0, 0,$this->active_month, $this->active_day, $this->active_year)) && date('Y-m-d', strtotime($event[2])) >= date('Y-m-d', mktime(0, 0, 0,$this->active_month, $this->active_day, $this->active_year))) {

                $filteredEvents[] = $event;
            }
            $filteredEventsJson = json_encode($filteredEvents);
 
            // Embed the JSON data into JavaScript variable eventsData
            $html .= '<script>';
            $html .= 'var eventsData = ' . $filteredEventsJson . ';';
            $html .= '</script>';
            $html .= '<script>';
            $html .= 'var activeDay = "' . date('Y-m-d', mktime(0, 0, 0, $this->active_month, $this->active_day, $this->active_year)) . '";';
            $html .= '</script>';
        }
       
        // Convert the filtered events array to JSON
        // Output the event container div
        $html .= '<div id="phpEventContainer" class="event-container">';
        $html .= '</div>';

        $html .= '</div>';

        return $html;
    }
}
