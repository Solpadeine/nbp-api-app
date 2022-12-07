<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Currency Code</th>
        <th>Exchange rate</th>
    </tr>
    </thead>
    <tbody>
    @foreach($currencies as $currency)
        <tr>
            <td>{{ $currency->name }}</td>
            <td>{{ $currency->currency_code }}</td>
            <td>{{ $currency->rate_formatted }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
