@extends('reports.pdf.master')

@section('report_title')

<h1></h1>

@section('report_content')

<table>
	<thead>
		<tr>
			<th>Item</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		@foreach($sales_order_lines as $x)
		<tr>
			<td>{{ $x->sellable_type }}</td>
			<td>{{ $x->price }}</td>
		</tr>
		@endforeach
	</tbody>
</table>