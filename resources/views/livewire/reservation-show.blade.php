<div>
    <div>
        <h1>Reservation List</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->qr_code }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>