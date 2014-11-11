<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'application/third_party/stripe/Stripe.php';

class Reservations extends CI_Controller {

  function __construct(){

    parent::__construct();

    // load the reservation model
    $this->load->model('Reservation');
    $this->load->model('Room');

    $this->load->helper('form');
    $this->load->helper('foundation_form');

    $this->load->library('form_validation');

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

      {cal_cell_no_content}<span class="room_not_available">{day}</span>{/cal_cell_no_content}
      {cal_cell_no_content_today}<span class="today room_not_available">{day}</span>{/cal_cell_no_content_today}

      {cal_cell_blank}&nbsp;{/cal_cell_blank}

      {cal_cell_end}</td>{/cal_cell_end}
      {cal_row_end}</tr>{/cal_row_end}

      {table_close}</table>{/table_close}

    ';

    $this->load->library( 'calendar' , $options );

    $stripe = array(
      "secret_key"      => $_ENV['STRIPE_SECRET_KEY'],
      "publishable_key" => $_ENV['STRIPE_PUBLISHABLE_KEY']
    );
    Stripe::setApiKey($stripe['secret_key']);

  }

  public function index() {
    // unset any data after this step
    $this->session->unset_userdata('arrival_date');
    $this->session->unset_userdata('departure_date');
    $this->session->unset_userdata('room');

    $args['calendar'] = $this->load->view('calendar', NULL, TRUE);
    $this->template->show('reservations', $args);
  }

  public function select_a_room(){

    $startDate = $this->get_data_from_post_or_session('arrival_date');
    $endDate = $this->get_data_from_post_or_session('departure_date');

    if( empty( $startDate ) || empty( $endDate ) ){
      // redirect to step 1 if missing any info
      redirect('reservations/index');
    }

    // unset any data after this step
    $this->session->unset_userdata('room');

    $args['rooms'] = $this->Room->get_available_rooms($startDate, $endDate);
    $args['startDate'] = $startDate;
    $args['endDate'] = $endDate;

    $this->template->show('reservations/select_a_room', $args);

  }

  public function payment(){

    $startDate = $this->get_data_from_post_or_session('arrival_date');
    $endDate = $this->get_data_from_post_or_session('departure_date');
    $room = $this->Room->get_room( $this->get_data_from_post_or_session('room') );

    if( empty( $room ) ){
      // redirect to step 2 if room is missing
      redirect('reservations/select_a_room');
    } else if( empty( $startDate ) || empty( $endDate ) ){
      // redirect to step 1 if either date is missing
      redirect('reservations/index');
    }

    $args = array( 'startDate' => $startDate, 'endDate' => $endDate, 'room' => $room );

    $this->template->show('reservations/payment', $args);

  }

  public function confirm(){

    $startDate = $this->get_data_from_post_or_session('arrival_date');
    $endDate = $this->get_data_from_post_or_session('departure_date');
    $room = $this->Room->get_room( $this->get_data_from_post_or_session('room') );

    if( empty( $room ) ){
      // redirect to step 2 if room is missing
      redirect('reservations/select_a_room');
    } else if( empty( $startDate ) || empty( $endDate ) ){
      // redirect to step 1 if either date is missing
      redirect('reservations/index');
    }

    $args = array( 'startDate' => $startDate, 'endDate' => $endDate, 'room' => $room );

    $this->form_validation->set_rules( $this->validation_rules() );

    if( $this->form_validation->run() == false ){

      $this->template->show('reservations/payment', $args);

    } else {

      $this->template->show('reservations/confirm', $args);

    }

  }

  public function room_info(){

    $args['room'] = $this->Room->get_room( $this->input->get('id') );
    $this->load->view('reservations/room_info', $args);

  }

  public function calendar() {

    $reservations = $this->Reservation->get_reservations();

    $year = $this->uri->segment(3);
    $month = $this->uri->segment(4);

    // generate booked/non-booked days
    $data = array();

    $today = new DateTime();

    $startDate = new DateTime("$year-$month-1");
    $endDate = new DateTime("$year-$month-" . $startDate->format('t') );

    while( $startDate <= $endDate ){

      if( $startDate > $today ){
        $available_rooms = $this->Room->get_available_rooms($startDate->format('Y-m-d'), $startDate->format('Y-m-d'));
        if( count( $available_rooms ) > 0 ){
          $data[ ltrim($startDate->format('d'), '0') ] = 'room_available';
        }
      } else {
        $data[ltrim($startDate->format('d'), '0')] = 'before_today';
      }

      $startDate->modify('+1 day');
    }

    $args['calendar'] = $this->calendar->generate( $year, $month, $data );
    $this->load->view( 'calendar', $args );

  }

  public function available_rooms(){

    $startDate = $this->input->get('startDate');
    $endDate = $this->input->get('endDate');

    echo json_encode( $this->Room->get_available_rooms($startDate, $endDate) );

  }

  public function get_data_from_post_or_session($string){

    $data = null;

    if( !empty( $this->input->post($string) ) ){
      $data = $this->input->post($string);
      $this->session->set_userdata($string, $data);
    } else if ( !empty( $this->session->userdata($string) ) ){
      $data = $this->session->userdata($string);
    }

    return $data;

  }

  private function validation_rules(){
    $rules = array(
                   array(
                         'field' => 'first_name',
                         'label' => 'First Name',
                         'rules' => 'trim|required',
                         ),
                   array(
                         'field' => 'last_name',
                         'label' => 'Last Name',
                         'rules' => 'trim|required',
                        ),
                   array(
                         'field' => 'email',
                         'label' => 'Email',
                         'rules' => 'trim|required|callback_validate_email',
                        ),
                   );
    return $rules;
  }

  public function validate_email($string)
  {
    if ( preg_match( '/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/' , $string ) != 1 ) {
      $this->form_validation->set_message('validate_phone', "The %s field is invalid.");
      return false;
    } else {
      return true;
    }
  }

}
