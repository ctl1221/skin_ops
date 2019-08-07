<table>
	<tr>
		<td>Doctor Name :</td>
		<td>{{ $doc_name }}</td>
	</tr>
	<tr>
		<td>Date Start :</td>
		<td>{{ $date_start }}</td>
	</tr>
	<tr>
		<td>Date End :</td>
		<td>{{ $date_end }}</td>
	</tr>
	<tr>
	</tr>


	<tr>
		<td colspan="9"><center><b>Treatments</b></center></td>
	</tr>
    <tr>
    	<td>SO Number</td>
    	<td>Name</td>
    	<td>Description</td>
        <td>Date</td>
        <td>OR #</td>
        <td>CIF #</td>
        <td>Amount</td>
        <td>Aesthetician</td>
        <td>Remarks</td>
    </tr>
    @foreach($sol_service as $x)
        <tr>
        	<td>{{ $x->so_number }}</td>
        	<td>{{ $x->last_name . ', ' . $x->first_name }}</td>
        	<td>{{ $x->name }}</td>
            <td>{{ $x->date }}</td>
            <td>{{ $x->or_number }}</td>
            <td>{{ $x->cif_number }}</td>
            <td>{{ $x->price }}</td>
            <td>{{ $x->assistant }}</td>
            <td>{{ $x->notes }}</td>
        </tr>
    @endforeach
</table>