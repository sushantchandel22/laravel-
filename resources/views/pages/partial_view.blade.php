@if ($data->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Country</th>
                <th scope="col">Gender</th>
                <th scope="col">Hobbies</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->country_name }}</td>
                    <td>{{ $row->gender }}</td>
                    <td>
                        @foreach (json_decode($row->hobbies) as $hobby)
                            {{ $hobby }},
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No result found</p>
@endif
