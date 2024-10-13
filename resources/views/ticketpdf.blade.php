
<!DOCTYPE html>
<html>
<head>
    <title>Ticket - {{ $payment_id }}</title>
</head>
<body>
    <center><h1>EVENTO</h1></center>
    <h2>Ticket for Event: {{ $bookingdetails->event_name }}</h2>
    <p>Payment ID: {{ $payment_id }}</p>
    <p>Name: {{ Session::get('name') }}</p>
    <p>Amount Paid: {{ $bookingdetails->total_amount }}</p>
    <p>Status: {{ $bookingdetails->is_paid == 1 ? 'Paid' : 'Unpaid' }}</p>
    <p>Total Attendee : </p>

    <h3><emb>Date : {{ (new \DateTime($bookingdetails->date))->format('F j, Y') }}</emb></h3>
    <h3><emb>Time : {{ (new \DateTime($bookingdetails->date))->format('h:i A') }}</emb></h3>
    <hr>
    <div style="display: flex; justify-content: center;">
        @foreach ($customers as $c)
        <div style="margin-right: 50px;">
            <h3>Attend Name : {{$c->customer_name}}</h3>
           <p style="font-size: 18px;"> Age : {{$c->age}}</p>
           <p style="font-size: 18px;">Id proof : {{$c->id_proof_type}}</p>
           <p style="font-size: 20px;">Id proof Number : {{$c->id_proof_no}}</p>
        </div>
        @endforeach 
    </div>
    <hr>
</body>
</html>
