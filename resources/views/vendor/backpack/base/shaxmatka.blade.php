<html>

<table>
    <thead>
        <tr>
            <th
                style="background-color: #1490e2;align-items: center;text-align: center;font-weight: bold;">
            </th>
            <th
                style="background-color: #1490e2;align-items: center;text-align: center;font-weight: bold;">
            </th>
            @foreach ($organizations as $org)
                <th
                    style="background-color: #1490e2;align-items: center;text-align: center;font-weight: bold; min-width: 200px;" >
                    {{ $org->name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($organizations as $item)
            <tr>
                <td style="background-color: #1490e2; align-items: center; text-align: center;font-weight: bold;">
                    {{ $item->name }}</td>
                <td style="background-color: #1490e2; align-items: center; text-align: center;font-weight: bold;">
                    {{ $item->inn }}</td>
                @foreach ($a[$item->id] as $key => $value)
                    <td
                        @if ($value && $value!='-') 
                            style="background-color: yellow; align-items: center; text-align: center;font-weight: bold;" 
                        @elseif($value == '0')
                            style="background-color: limegreen; align-items: center; text-align: center;font-weight: bold;" 
                        @else
                            style="align-items: center; text-align: center;font-weight: bold;"
                        @endif>
                        {{ $value }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

</html>
