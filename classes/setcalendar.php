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
            }
            else if(isset($_GET['active_day']))
            {
                $this->active_day =$_GET['active_day'];
            }
        }
    }

//Termine von Database ergänzen
    public function add_event($name, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$name, $date, $days, $color];
    }

    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= $this->_createNavi();
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        $html .= '<br>';
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month - $i + 1) . '
                </div>
            ';
        }
        $date = null;
        for ($i = 1; $i <= $num_days; $i++) {
        
            $selected = '';
            

            if ($i == $this->active_day|| $this->active_month== ($date != null ? date('m', strtotime($date)) : date('m')) && $i== ($date != null ? date('d', strtotime($date)) : date('d'))) {
                $selected = ' selected';
            }

            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<a href="' . $this->naviHref . '&active_month=' . $this->active_month . '&active_year=' . $this->active_year .'&active_day=' . $i . '">' . $i . '</a>';
            foreach ($this->events as $event) {

                for ($d = 0; $d <= ($event[2] - 1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '">';

                        $html .= '</div>';
                    }
                }
            }


            $html .= '</div>';
        }
        for ($i = 1; $i <= (42 - $num_days - max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
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
    $html = "<h3>Termine in dem Tag </h3>";
    $html .= '<div class="grid-container1">';
    $html .= '<table class="table">';
      
   for ($hour = 1; $hour <= 24; $hour++) {
     
        $formattedHour = sprintf("%02d:00", $hour);
        
        $html .= '<td id="hour" class="hour_' . $hour . '">';
        $html .= $formattedHour;
        $html .= '</td>';
        $numEvents = 0;
        foreach ($this->events as $event) {
           
          
             if (date('Y-m-d H', strtotime($event[1])) == date('Y-m-d H',  mktime($hour, 0, 0, $this->active_month, $this->active_day, $this->active_year))) {
               $numEvents++;
                
            }
        }
    

        // Print each event in a column with width based on the number of events
        foreach ($this->events as $event) {
              if (date('Y-m-d H', strtotime($event[1])) == date('Y-m-d H',  mktime($hour, 0, 0, $this->active_month, $this->active_day, $this->active_year))) {
                 $columnWidth = $numEvents > 0 ? (100 / $numEvents) . '%' : '100%';
                $html .= '<td style="width: ' . $columnWidth . ';" class="event-container" id="event">';
                $html .= '<div id="event" style=" color: #000000;">' . $event[0] . '</div>';
                $html .= '</td>';
            }
        
     }   
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    $html .= '</div>';
    
    return $html;
}
}

