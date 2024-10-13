@extends('layout')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-20">All Customers</h4>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" style="width:100% ">
                                <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact no</th>
                                    <th>whatsapp no</th>
                                    <th>User type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $i=1;
                                        $today = now();
                                    @endphp
                                    @foreach ($customers as $d)
                                    <tr data-id="{{ $d->id }}" style="{{ $d->is_enable == 1 ? '' : 'background-color: lightcoral;' }}">
                                    <td>{{$i++}}</td>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->mail_id}}</td>
                                    <td>{{$d->contact_no}}</td>
                                    <td>{{$d->whatsapp_no}}</td>
                                    <td>{{$d->user_type}}</td>
                                    @if ($d->is_enable == 1)
                                    <td><span class="badge rounded-pill bg-success" style="font-size: 14px">ACTIVE</span>
                                    </td>
                                    @else
                                    <td><span class="badge rounded-pill bg-danger" style="font-size: 14px">INACTIVE</span>
                                    </td>
                                    @endif
                                    <td> <a class="btn btn-outline-secondary btn-sm edit delete-btn" href="{{url('/')}}/deletecustomer/{{$d->id}}" title="Delete">
                                        <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                                    </a></td>
                                    @if ($d->user_type == "admin")
                                        
                                    @else
                                    <td>
                                        <input type="checkbox" class="status-switch" data-id="{{ $d->id }}" id="switch{{ $d->id }}" switch="none" {{ $d->is_enable == 1 ? 'checked' : '' }} />
                                        <label for="switch{{ $d->id }}" data-on-label="On" data-off-label="Off"></label>
                                    </td>
                                    @endif
                                    
                                    </tr>                  
                                    @endforeach                                    
                                
                                
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSwitches = document.querySelectorAll('.status-switch');

        statusSwitches.forEach(switchElement => {
            switchElement.addEventListener('change', function() {
                const customerId = this.dataset.id;
                const status = this.checked ? 1 : 0; // 1 for enabled, 0 for disabled

                $.ajax({
                    url: '{{ route("toggleCustomerStatus") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: customerId,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            const row = document.querySelector(`tr[data-id="${customerId}"]`);
                            const statusCell = row.querySelector('td span.badge');
                            
                            // Update row background color based on status
                            if (status == 0) {
                                row.style.backgroundColor = 'lightcoral'; // Inactive
                                statusCell.classList.remove('bg-success');
                                statusCell.classList.add('bg-danger');
                                statusCell.textContent = 'INACTIVE'; // Update status text
                            } else {
                                row.style.backgroundColor = ''; // Active
                                statusCell.classList.remove('bg-danger');
                                statusCell.classList.add('bg-success');
                                statusCell.textContent = 'ACTIVE'; // Update status text
                            }
                        }
                    }
                });
            });
        });
    });
</script>

@endsection
