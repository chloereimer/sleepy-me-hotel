<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservations extends CI_Controller {

  function __construct(){

    parent::__construct();

    // load the reservation model
    $this->load->model('Reservation');
    $this->load->model('Room');

    // set up the calendar options

    $options = array();

    $options['show_next_prev'] = true;
    $options['next_prev_url'] = site_url() . '/reservations/calendar/';

    $options['template'] = '

      {table_open}<table>{/table_open}

      {heading_row_start}<tr>{/heading_row_start}

      {heading_previous_cell}<th><span class="previous_link" data-url="{previous_url}">&lt;&lt;</span></th>{/heading_previous_cell}
      {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
      {heading_next_cell}<th><span class="next_link" data-url="{next_url}">&gt;&gt;</span></th>{/heading_next_cell}

      {heading_row_end}</tr>{/heading_row_end}

      {week_row_start}<tr>{/week_row_start}
      {week_day_cell}<td>{week_day}</td>{/week_day_cell}
      {week_row_end}</tr>{/week_row_end}

      {cal_row_start}<tr>{/cal_row_start}
      {cal_cell_start}<td>{/cal_cell_start}

      {cal_cell_content}<span class="{content}">{day}</span>{/cal_cell_content}
      {cal_cell_content_today}<span href="{content}" class="{content} today">{day}</span>{/cal_cell_content_today}

      {cal_cell_no_content}<span>{day}</span>{/cal_cell_no_content}
      {cal_cell_no_content_today}<span class="today">{day}</span>{/cal_cell_no_content_today}

      {cal_cell_blank}&nbsp;{/cal_cell_blank}

      {cal_cell_end}</td>{/cal_cell_end}
      {cal_row_end}</tr>{/cal_row_end}

      {table_close}</table>{/table_close}

    ';

    $this->load->library( 'calendar' , $options );

  }

  public function index() {
    $args['calendar'] = $this->load->view('calendar', NULL, TRUE);
    $this->template->show('reservations', $args);
  }

  public function calendar() {

    $reservations = $this->Reservation->get_reservations();

    $year = $this->uri->segment(3);
    $month = $this->uri->segment(4);

    // generate booked/non-booked days
    $data = array();

    $args['calendar'] = $this->calendar->generate( $year, $month, $data );
    $this->load->view( 'calendar', $args );

  }

  public function available_rooms(){

    $startDate = $this->input->get('startDate');
    $endDate = $this->input->get('endDate');

    echo json_encode( $this->Room->get_available_rooms($startDate, $endDate) );


  }

}
