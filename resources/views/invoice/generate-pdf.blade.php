<table class="invoice" border="0" cellpadding="0" cellspacing="0" align="center" style="min-width: 100%; width: 100%;">
	<tr>
		<td height="25" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
			<table border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
				<tr>
					<td bgcolor="#FFFFFF" align="left" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
						<a href="http://zencore.pl" target="_blank">
							<img src="{{ env('APP_URL') }}/img/logo.png" alt="" style="display: block; width: 205px;">
						</a>
					</td>
					<td bgcolor="#FFFFFF" align="right" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
						<table class="basic-info" border="0" cellpadding="0" cellspacing="0" marginheight="0">
                            <tr>
                                <td colspan="2" class="title">
									@if($invoice->advance)
										Faktura zaliczkowa VAT
									@elseif($invoice->proforma)
										Pro forma
									@else
                                    	Faktura VAT
									@endif
                                </td>
                            </tr>
							<tr>
								<td class="heading" style="font-family: opensans; font-size: 11px;">Numer:</td>
								<td style="font-family: opensans; font-size: 11px;">{{ $invoice->invoice_number }}</td>
							</tr>
							<tr>
								<td class="heading" style="font-family: opensans; font-size: 11px;">Miejsce wystawienia:</td>
								<td style="font-family: opensans; font-size: 11px;">{{ $invoice->issue_city }}</td>
							</tr>
							<tr>
								<td class="heading" style="font-family: opensans; font-size: 11px;">Data wystawienia:</td>
								<td style="font-family: opensans; font-size: 11px;">{{ $invoice->issue_date }}</td>
							</tr>
							<tr>
								<td class="heading" style="font-family: opensans; font-size: 11px;">Termin płatności:</td>
								<td style="font-family: opensans; font-size: 11px;">{{ $invoice->payment_date }}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
			<table class="companies" border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
				<tr>
					<td class="company-heading left" bgcolor="#FFFFFF" align="left" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
                        <table border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
                            <tr>
                                <td>Sprzedawca</td>
                            </tr>
                        </table>
					</td>
					<td class="company-heading right" bgcolor="#FFFFFF" align="left" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
                        <table border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
                            <tr>
                                <td>Nabywca</td>
                            </tr>
                        </table>
					</td>
				</tr>
				<tr>
					<td class="left" bgcolor="#FFFFFF" align="left" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
						<h3 style="margin: 0 0 5px 0; font-size: 12px;">{{ $owner->name }}</h3>
						<p style="font-family: opensans; font-size: 11px;">
							NIP: {{ $owner->vat_number }}<br />
							ul. {{ $owner->street }}<br />
							{{ $owner->postcode }} {{ $owner->city }}<br />
							Tel: {{ $owner->phone }}<br />
		                    Email: {{ $owner->email }}
						</p>
					</td>
					<td class="right" bgcolor="#FFFFFF" align="left" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
						<h3 style="margin: 0 0 5px 0; font-size: 12px;">
							@foreach($invoice->client()->get() as $client)
		                        {{ $client->company }}
		                    @endforeach
						</h3>
						<p style="font-family: opensans; font-size: 11px;">
							@foreach($invoice->client()->get() as $client)
		                        {!! $client->nip ? 'NIP: '.$client->nip.'<br>' : '' !!}
		                    @endforeach
		                    @foreach($invoice->address()->get() as $address)
		                        {{ $address->street }}<br>
		                        {{ $address->postcode }} {{ $address->city }}<br>
		                    @endforeach
						</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
			<table class="details" border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
				<thead>
					<tr>
						<th align="left" style="font-family: opensans; font-size: 11px;">Nazwa towaru/usługi</th>
						<th align="right" style="font-family: opensans; font-size: 11px;">Netto</th>
						<th align="right" style="font-family: opensans; font-size: 11px;">Stawka VAT</th>
						<th align="right" style="font-family: opensans; font-size: 11px;">VAT</th>
						<th align="right" style="font-family: opensans; font-size: 11px;">Brutto</th>
					</tr>
				</thead>
				<tbody>
					@foreach($invoice->invoicePositions()->get() as $key => $position)
						<tr{{ (($key + 1) == count($invoice->invoicePositions()->get()) ? ' class="last-row"' : '') }}>
							<td align="left" style="font-family: opensans; font-size: 11px;">{{ $position->name }}</td>
							<td align="right" style="font-family: opensans; font-size: 11px;">{{ number_format($position->price_tax_excl, 2, ',', ' ') }}&nbsp;zł</td>
							@foreach($position->tax()->get() as $tax)
								<td align="right" style="font-family: opensans; font-size: 11px;">{{ $tax->display }}</td>
								<td align="right" style="font-family: opensans; font-size: 11px;">{{ number_format($tax->value * ($position->price_tax_excl * $position->quantity), 2, ',', ' ') }}&nbsp;zł</td>
								<td align="right" style="font-family: opensans; font-size: 11px;">{{ number_format($tax->value * ($position->price_tax_excl * $position->quantity) + ($position->price_tax_excl * $position->quantity), 2, ',', ' ') }}&nbsp;zł</td>
							@endforeach
						</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td align="left" style="font-family: opensans; font-size: 11px;">Razem</td>
						<td align="right" style="font-family: opensans; font-size: 11px;">{{ number_format($invoice->sumPositionsValueTaxExcl, 2, ',', ' ') }}&nbsp;zł</td>
						<td align="right" style="font-family: opensans; font-size: 11px;">-</td>
						<td align="right" style="font-family: opensans; font-size: 11px;">{{ number_format($invoice->sumPositionsTaxValue, 2, ',', ' ') }}&nbsp;zł</td>
						<td align="right" style="font-family: opensans; font-size: 11px;">{{ number_format($invoice->sumPositionsValueTaxIncl, 2, ',', ' ') }}&nbsp;zł</td>
					</tr>
				</tfoot>
			</table>
		</td>
	</tr>
	<tr>
		<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
			<table class="companies" border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
				<tr>
					<td class="company-heading left" bgcolor="#FFFFFF" align="left" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
                        <table border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
                            <tr>
                                <td>Sposób płatności</td>
                            </tr>
                        </table>
					</td>
					<td class="company-heading right" bgcolor="#FFFFFF" align="left" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
						<table border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
							<tr>
								<td>Do zapłaty</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="left" bgcolor="#FFFFFF" align="left" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
						<h3 style="margin: 0 0 5px 0; font-size: 12px;">
							@if($invoice->paymentMethod()->first()->module_name == 'bank_transfer')
			                    Przelew{{ ($invoice->paid ? ' (zapłacono)' : ':') }}
			                @elseif($invoice->paymentMethod()->first()->module_name == 'cash')
			                    Gotówka{{ ($invoice->paid ? ' (zapłacono)' : '') }}
			                @elseif($invoice->paymentMethod()->first()->module_name == 'payu')
			                    PayU{{ ($invoice->paid ? ' (zapłacono)' : '') }}
							@elseif($invoice->paymentMethod()->first()->module_name == 'paypal')
								PayPal{{ ($invoice->paid ? ' (zapłacono)' : '') }}
							@elseif($invoice->paymentMethod()->first()->module_name == 'paypal')
								Bitcoin{{ ($invoice->paid ? ' (zapłacono)' : '') }}
			                @endif
						</h3>
						@if($invoice->paymentMethod()->first()->module_name == 'bank_transfer' && !$invoice->paid)
							<p style="font-family: opensans; font-size: 11px;">
	                            {{ $owner->name }}<br />
	                            {{ $owner->bank_account_number }}<br />
	                            ({{ $owner->bank_name }})<br />
	                            W tytule przelewu prosimy wpisać numer faktury <strong>{{ $invoice->invoice_number }}</strong>
							</p>
						@endif
					</td>
					<td class="right" bgcolor="#FFFFFF" align="left" style="min-width: 50%; width: 50%; background: #FFFFFF; background-color: #FFFFFF;">
						<h3 style="margin: 0 0 5px 0; font-size: 12px;">{{ number_format($invoice->sumPositionsValueTaxIncl, 2, ',', ' ') }} zł</h3>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	@if($invoice->comment)
		<tr>
			<td height="35" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
				<table class="companies companies-full" border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
					<tr>
						<td class="company-heading" bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
							<table border="0" cellpadding="0" cellspacing="0" marginheight="0" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;">
								<tr>
									<td>Uwagi</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" align="left" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF; padding-top: 10px;">
							<p style="font-family: opensans; font-size: 11px;">
								{{ $invoice->comment }}
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	@endif
	<tr>
		<td height="25" bgcolor="#FFFFFF" align="center" style="min-width: 100%; width: 100%; background: #FFFFFF; background-color: #FFFFFF;"></td>
	</tr>
</table>