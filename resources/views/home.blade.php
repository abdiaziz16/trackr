@extends('layouts.app')

@section('title','Please Login')

@section('content')
        <h2>Tracking Changes That Matter</h2>
        <div class="tab-content">
            <div id="active" class="tab-pane fade in active">
                <table class="table">
                    <thead>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-primary request-button" data-toggle="modal" data-target="#controlItemModal">
                                Create Item Request
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-secondary request-button" data-toggle="modal" data-target="#itLogModal">
                                Create Internal Log
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info request-button" data-toggle="modal" data-target="#userModal">
                                New/Terminate User
                            </button>
                        </td>
                        <td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Filter By Status
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Pending</a></li>
                                    <li><a href="#">Approved</a></li>
                                    <li><a href="#">In Review</a></li>
                                    <li><a href="#">Completed</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="controlItemModal" tabindex="-1" role="dialog" aria-labelledby="controlItemModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ControlItemModalLongTitle">Change Control</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/create" method='POST'>
                            @csrf
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label" for="date">Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="date" name="date" autocomplete="off" placeholder="MM/DD/YYY" type="text"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="departmentInput" class="col-sm-2 col-form-label">Department</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="department" id="departmentInput" placeholder="IT/Accounting/HR">
                                </div>
                            </div>
                            <fieldset class="form-group row">
                                <div class="form-row">
                                    <div class="col-sm-5">
                                        <label>Change Type</label>
                                        <select name="changeType" class="form-control" id="sel1">
                                            @if(isset($changeTypes))
                                                @foreach($changeTypes as $type)
                                                    <option value="{{$type->id}}" >{{$type->change_type}}</option>
                                                @endforeach
                                            @endif
{{--                                            <option>Personnel</option>--}}
{{--                                            <option>Building</option>--}}
{{--                                            <option>Hardware/Equipment</option>--}}
{{--                                            <option>Software</option>--}}
{{--                                            <option>Materials</option>--}}
{{--                                            <option>Legal Issue</option>--}}
{{--                                            <option>Supplier</option>--}}
{{--                                            <option>Quality</option>--}}
{{--                                            <option>Environmental</option>--}}
{{--                                            <option>Health</option>--}}
{{--                                            <option>Safety</option>--}}
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="form-row">
                                    <div class="col-sm-10">
                                        <label for="descriptionNote">Description</label>
                                        <textarea class="form-control" name="descriptionInput" id="descriptionID" rows="5" placeholder="Description  of change"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-row">
                                    <div class="col-sm-10">
                                        <label for="riskNote">Risks Associated</label>
                                        <textarea class="form-control" name="riskInput" id="riskID" rows="5" placeholder="Risks associated with change"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-row">
                                    <div class="col-sm-10">
                                        <label for="functionNote">Functions Impacted</label>
                                        <textarea class="form-control" name="functionInput" id="functionID" rows="5" placeholder="Functions impacted by this change"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Create Request</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="itLogModal" tabindex="-1" role="dialog" aria-labelledby="itLogModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itLogModalLongTitle">Create New IT Log</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/createLog" method='POST'>
                            @csrf
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label" for="date">Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="date" name="date" autocomplete="off" placeholder="MM/DD/YYY" type="text"/>
                                </div>
                            </div>
                            <fieldset class="form-group row">
                                <div class="form-row">
                                    <div class="col-sm-5">
                                        <label>Change Type</label>
                                        <select name="changeType" class="form-control" id="sel1">
                                            <option>Active Directory</option>
                                            <option>Firewall</option>
                                            <option>Camera System</option>
                                            <option>Badge Security</option>
                                            <option>Mailserver</option>
                                            <option>SYSLog Logging Server</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="form-row">
                                    <div class="col-sm-10">
                                        <label for="logMessage">Note</label>
                                        <textarea class="form-control" name="logMessage" id="noteTextArea" rows="10" placeholder="Note..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Create Log</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLongTitle">Add/Terminate User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label" for="date">Date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="date" autocomplete="off" name="date" placeholder="MM/DD/YYY" type="text"/>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Add User Access
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Remove User Access
                                </label>
                            </div>
                            <br>
                            <fieldset class="form-group row">
                                <div class="form-row">
                                    <div class="col-sm-10">
                                        <label>Change Type</label>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">User Access
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Active Directory</a></li>
                                                <li><a href="#">SmartQ</a></li>
                                                <li><a href="#">Data Center</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="form-row">
                                    <div class="col-sm-10">
                                        <label for="descriptionNote">Note</label>
                                        <textarea class="form-control" id="noteTextArea" rows="5" placeholder="Note..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#new">New Requests</a></li>
            <li><a data-toggle="tab" href="#approved">Approved Requests</a></li>
            <li><a data-toggle="tab" href="#reviewed">Reviewed Request</a></li>
        </ul>
        <div class="tab-content">
            <div id="new" class="tab-pane fade in active">
                <table class="table">
                    <thead>
                    <tr class="bg-primary">
                        <th scope="col"></th>
                        <th scope="col">Request Type</th>
                        <th scope="col">Request Date</th>
                        <th scope="col">Requested By</th>
                        <th scope="col">Note</th>
                        <th scope="col">Action(s)</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if ( isset($newRequests) && count($newRequests) > 0)
                            @foreach($newRequests as $req)
                            <tr data-toggle="collapse" data-target="#{{$req->id}}" class="accordion-toggle">

                                <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-collapse-down"></span></button></td>

                                <td>{{$req->change_type}}</td>
                                <td>{{$req->created_at}}</td>
                                <td>{{$req->name}}</td>
                                <td>{{$req->description}}</td>
                                <td>
                                    <form action="/approve/{{ $req->id}}" method='POST'>
                                        @csrf
                                        <button type="submit" name="action" value="approve" class="btn btn-primary">Approve</button>
                                        <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            <td colspan="12" class="hiddenRow">
                                <div class="accordian-body collapse" id="{{$req->id}}">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr><th>Descriptions Note</th><th>Risk Note</th><th>Functions Impacted</th></tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <p>{{$req->description}}</p>
                                            </td>
                                            <td>
                                                <p>{{$req->riskAssessment}}</p>
                                            </td>
                                            <td>
                                                <p>{{$req->functions}}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                             </td>
                            @endforeach
                    @else
                        <tr><td class="alert alert-warning text-center"> You have no new requests at the moment!</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div id="approved" class="tab-pane fade">
                <table class="table">
                    <thead>
                    <tr class="bg-primary">
                        <th scope="col"></th>
                        <th scope="col">Request Type</th>
                        <th scope="col">Request Date</th>
                        <th scope="col">Requested By</th>
                        <th scope="col">Note</th>
                        <th scope="col">Action(s)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($approvedRequests) && count($approvedRequests) > 0)
                        @foreach($approvedRequests as $req)
                            <tr data-toggle="collapse" data-target="#{{$req->id}}" class="accordion-toggle">

                                <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-collapse-down"></span></button></td>

                                <td>{{$req->change_type}}</td>
                                <td>{{$req->created_at}}</td>
                                <td>{{$req->name}}</td>
                                <td>{{$req->description}}</td>
                                <td>
                                    <form action="/review/{{ $req->id}}" method='POST'>
                                        @csrf
                                        <button type="submit" name="action" value="approve" class="btn btn-warning">Complete Review</button>
                                        <button type="submit" name="action" value="reject" class="btn btn-danger">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            <td colspan="12" class="hiddenRow">
                                <div class="accordian-body collapse" id="{{$req->id}}">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr><th>Descriptions Note</th><th>Risk Note</th><th>Functions Impacted</th></tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <p>{{$req->description}}</p>
                                            </td>
                                            <td>
                                                <p>{{$req->riskAssessment}}</p>
                                            </td>
                                            <td>
                                                <p>{{$req->functions}}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        @endforeach
                    @else
                        <tr><td class="alert alert-warning text-center"> You have no new requests at the moment!</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div id="reviewed" class="tab-pane fade">
                <table class="table">
                    <thead>
                    <tr class="bg-primary">
                        <th scope="col"></th>
                        <th scope="col">Request Type</th>
                        <th scope="col">Request Date</th>
                        <th scope="col">Requested By</th>
                        <th scope="col">Note</th>
                        <th scope="col">Action(s)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($reviewedRequests) && count($reviewedRequests) > 0)
                        @foreach($reviewedRequests as $req)
                            <tr data-toggle="collapse" data-target="#{{$req->id}}" class="accordion-toggle">

                                <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-collapse-down"></span></button></td>

                                <td>{{$req->change_type}}</td>
                                <td>{{$req->created_at}}</td>
                                <td>{{$req->name}}</td>
                                <td>{{$req->description}}</td>
                                <td>
                                    <form action="/complete/{{ $req->id}}" method='POST'>
                                        @csrf
                                        <button type="submit"  name="action" value="approve" class="btn btn-success">Sign Off</button>
                                        <button type="submit"  name="action" value="reject" class="btn btn-danger">Reject</button>
                                    </form>
                                </td>
                            </tr>
                            <td colspan="12" class="hiddenRow">
                                <div class="accordian-body collapse" id="{{$req->id}}">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr><th>Descriptions Note</th><th>Risk Note</th><th>Functions Impacted</th></tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <p>{{$req->description}}</p>
                                            </td>
                                            <td>
                                                <p>{{$req->riskAssessment}}</p>
                                            </td>
                                            <td>
                                                <p>{{$req->functions}}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        @endforeach
                    @else
                        <tr><td class="alert alert-warning text-center"> You have no new requests at the moment!</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                var date_input=$('input[name="date"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                    format: 'yyyy-mm-dd',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                    orientation: "top",
                };
                date_input.datepicker(options);

                $('.dropdown-toggle').dropdown()
                $('.alert-success').fadeIn().delay(5000).fadeOut();
                $('.alert-danger').fadeIn().delay(5000).fadeOut();

                $('.newRequestsTab').addClass('active');
                console.log('active..');
            })
        </script>

@endsection
