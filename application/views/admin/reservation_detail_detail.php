<h1>Further detail about Reservation #<?php echo $reservation->id ?></h1>

<p><strong>Customer ID:</strong> <?php echo $reservation->customer->id ?> <small>(Note: This ID is used to identify the customer on Stripe.)</small></p>

<p><strong>Customer Name:</strong> <?php echo $reservation->customer->first_name . ' ' . $reservation->customer->last_name ?></p>
<p><strong>Customer Email:</strong> <?php echo $reservation->customer->email ?></p>
<p><strong>Customer Phone:</strong> <?php echo $reservation->customer->phone ?></p>

<p><strong>Start Date:</strong> <?php echo $reservation->start_date ?></p>
<p><strong>End Date:</strong> <?php echo $reservation->end_date ?></p>

<p><strong>Room #:</strong> <?php echo $reservation->room->number ?></p>
<p><strong>Room Name:</strong> <?php echo $reservation->room->name ?></p>
<p><strong>Room Rate:</strong> <?php echo $reservation->room->rate ?></p>
<p><strong>Room Description:</strong> <?php echo $reservation->room->description ?></p>
