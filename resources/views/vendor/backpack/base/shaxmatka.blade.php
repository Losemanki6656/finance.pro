<html>
<div class="loader" id="loader_content" style="display: block"></div>

<div class="table-container" id="content_table" style="display: none">
    <table class="custom-table">

        <thead class="fixed-header">
            <tr>
                <th
                    style="background-color: #1490e2;align-items: center;text-align: center;font-weight: bold; min-width: 200px;">
                    
                </th>
                <th
                    style="background-color: #1490e2;align-items: center;text-align: center;font-weight: bold; min-width: 200px;">
                    
                </th>
                @foreach ($organizations as $org)
                    <th
                        style="background-color: #1490e2;align-items: center;text-align: center;font-weight: bold; min-width: 200px;">
                        {{ $org->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="custom-table-body">
            @foreach ($organizations as $item)
                <tr onclick="selectRow({{ $item->id }})" id="{{ $item->id }}">
                    <td class="custom-table-body-item-first "
                        style="background-color: #1490e2; align-items: center; text-align: center;font-weight: bold;">
                        {{ $item->name }}</td>
                    <td style="background-color: #1490e2; align-items: center; text-align: center;font-weight: bold;"
                        class="custom-table-body-item-second">
                        {{ $item->inn }}</td>
                    @foreach ($a[$item->id] as $key => $value)
                        <td
                            @if ($value && $value != '-') style="background-color: yellow; align-items: center; text-align: center;font-weight: bold;" 
                        @elseif($value == '0')
                            style="background-color: limegreen; align-items: center; text-align: center;font-weight: bold;" 
                        @else
                            style="align-items: center; text-align: center;font-weight: bold;" @endif>
                            {{ $value }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    setTimeout(function() {
        const selectElement = document.getElementById('loader_content');
        selectElement.style.display = "none";
        const tableelement = document.getElementById('content_table');
        tableelement.style.display = "block";
    }, 5000)

    function selectRow(id) {

        const selectElement = document.getElementById(id);

        if (selectElement.classList.contains('select-row')) {
            selectElement.classList.remove("select-row")
        } else
            selectElement.classList.add("select-row")
    }
</script>
<style>
    html,
    body {
        height: 100%;
    }

    body {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .loader {
        animation: rotate 2s infinite;
        height: 50px;
        width: 50px;
    }

    .loader:before,
    .loader:after {
        border-radius: 50%;
        content: '';
        display: block;
        height: 20px;
        width: 20px;
    }

    .loader:before {
        animation: ball1 2s infinite;
        background-color: #ffd700;
        box-shadow: 30px 0 0 #ffd700;
        margin-bottom: 10px;
    }

    .loader:after {
        animation: ball2 2s infinite;
        background-color: #ffd700;
        box-shadow: 30px 0 0 #ffd700;
    }

    @keyframes rotate {
        0% {
            -webkit-transform: rotate(0deg) scale(0.8);
            -moz-transform: rotate(0deg) scale(0.8);
        }

        50% {
            -webkit-transform: rotate(360deg) scale(1.2);
            -moz-transform: rotate(360deg) scale(1.2);
        }

        100% {
            -webkit-transform: rotate(720deg) scale(0.8);
            -moz-transform: rotate(720deg) scale(0.8);
        }
    }

    @keyframes ball1 {
        0% {
            box-shadow: 30px 0 0 #ffd700;
        }

        50% {
            box-shadow: 0 0 0 #ffd700;
            margin-bottom: 0;
            -webkit-transform: translate(15px, 15px);
            -moz-transform: translate(15px, 15px);
        }

        100% {
            box-shadow: 30px 0 0 #ffd700;
            margin-bottom: 10px;
        }
    }

    @keyframes ball2 {
        0% {
            box-shadow: 30px 0 0 #ffd700;
        }

        50% {
            box-shadow: 0 0 0 #ffd700;
            margin-top: -20px;
            -webkit-transform: translate(15px, 15px);
            -moz-transform: translate(15px, 15px);
        }

        100% {
            box-shadow: 30px 0 0 #ffd700;
            margin-top: 0;
        }
    }
</style>
<style>
    * {
        box-sizing: border-box !important
    }

    body {
        margin: 0px !important;
    }

    .table-container {
        position: relative !important;
        width: 100% !important;
        max-height: 100vw !important;
        min-height: 100% !important;
        max-height: 100vh !important;
        overflow: auto !important;

    }

    .fixed-header {
        position: sticky;
        top: 0px;
        left: 0px;
        z-index: 100;

    }

    .custom-table-body {
        margin-top: 100px !important;
        top: 0px;
        left: 0px;

    }

    .custom-table-body-item-first {
        position: sticky !important;
        left: 0px;
        z-index: 10 !important;
        width: 303px !important;

    }

    .custom-table-body-item-second {
        position: sticky !important;
        left: 302.4px;
        z-index: 10 !important;

    }

    .select-row {
        background-color: deepskyblue !important;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

</style>

</html>
