<table>
	<tr>
		<td>Doctor Name :</td>
		<td><b>{{ $doc_name }}</b></td>
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

    {{-- Treatments - Services --}}
	<tr>
		<td colspan="10"><center><b>Treatments - Services</b></center></td>
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
        <td>Branch</td>
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
            <td>{{ $x->branch_name }}</td>
        </tr>
    @endforeach

    <tr>
    </tr>
    <tr>
    </tr>

     {{-- Treatments - Packages --}}
     <tr>
        <td colspan="10"><center><b>Treatments - Packages</b></center></td>
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
        <td>Branch</td>
    </tr>
    @foreach($package_claims as $x)
        <tr>
            <td>{{ $x->so_number }}</td>
            <td>{{ $x->last_name . ', ' . $x->first_name }}</td>
            <td>{{ $x->service_name . "         " . $x->package_name }}]</td>
            <td>{{ $x->claimed_by_date }}</td>
            <td>{{ $x->or_number }}</td>
            <td>{{ $x->cif_number }}</td>
            <td>{{ $package_price_array[$x->id] / $divisor_array[$x->category_id]  }}</td>
            <td>{{ $x->assistant }}</td>
            <td>{{ $x->notes }}</td>
            <td>{{ $x->branch_name }}</td>
        </tr>
    @endforeach

</table>