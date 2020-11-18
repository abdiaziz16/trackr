
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css" media="all">

        #requestsTable{
            border-collapse: collapse;
            width: 100%;
            table-layout:fixed;
        }

        #requestsTable td, #requestsTable th{
            border: 1px solid #dddddd;
            padding: 8px;
        }

        #requestsTable tr:nth-child(even){
            background-color: #3490dc;
        }

        #requestsTable th{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #3490dc;
            color:white;
        }
    </style>
</head>
<body>
{{--    <table id="requestsTable">--}}
    <table id="requestsTable" class="table" style="table-layout:fixed;">
        <thead class="thead-dark">
            <tr>
                <th style="width:10%">
                    Date
                </th>
                <th style="width:10%">
                    Request Type
                </th>
                <th style="width:10%">
                    Change Type
                </th>
                <th style="width:30%">
                    Description
                </th>
                <th style="width:10%">
                    Requested By
                </th>
                <th style="width:10%">
                    Approved By
                </th>
                <th style="width:10%">
                    Reviewed By
                </th>
                <th style="width:10%">
                    Completed By
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
                <tr><td id="dateTd">
                        {{$req->created_at}}
                    </td>
                    <td>
                        {{$req->requestType}}
                    </td>
                    <td>
                        {{$req->ChangeType}}
                    </td>
                    <td>
                        {{$req->description}}
                    </td>
                    <td>
                        {{$req->requestorID}}
                    </td>
                    <td>
                        {{$req->approverID ?? 'pending'}}
                    </td>
                    <td>
                        {{$req->reviewerID ?? 'pending'}}
                    </td>
                    <td>
                        {{$req->completedBy ?? 'pending'}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

{{--<td>--}}
{{--    {{$req->date}}--}}
{{--</td>--}}
{{--<td>--}}
{{--    {{$req->requestType}}--}}
{{--</td>--}}
{{--<td>--}}
{{--    {{$req->changeType}}--}}
{{--</td>--}}
{{--<td>--}}
{{--    {{$req->description}}--}}
{{--</td>--}}
{{--<td>--}}
{{--    {{$req->requester}}--}}
{{--</td>--}}
{{--<td>--}}
{{--    {{$req->approver}}--}}
{{--</td>--}}
{{--<td>--}}
{{--    {{$req->reviewer}}--}}
{{--</td>--}}
{{--<td>--}}
{{--    {{$req->completer}}--}}
{{--</td>--}}
