@extends('layouts.simple.master')
@section('title', 'Home For Sale')

@section('css')
    <style>
        .truncate-text {
            max-width: 150px;
            /* Adjust the maximum width according to your design */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status {
            margin-top: 30px;
            margin-left: 50px;
        }

        .card .card-header {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
        }
        .nav-item {
        width: 20%;
        text-align: center;
   }
    </style>
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Data of <span>Home For Sale</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Properties</li>
    <li class="breadcrumb-item">Manage Homes</li>
    <li class="breadcrumb-item">Home For Sale</li>
@endsection

@section('content')
    
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header ">
            <div class="d-flex justify-content-between align-items-center">
               <h5>Home For Sale </h5>
            </div>
                <ul class="w-100 nav justify-content-between mt-5 nav-pills nav-primary border rounded-pill p-1" id="myTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="publish-tab" data-bs-toggle="pill"
                            href="#publish" role="tab" aria-controls="publish"
                            aria-selected="true" onclick="loadData('publish')">Published</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="archive-tab" data-bs-toggle="pill" href="#archive"
                            role="tab" aria-controls="archive" aria-selected="false" onclick="loadData('archive')">Archived</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sold-tab" data-bs-toggle="pill" href="#sold"
                            role="tab" aria-controls="sold" aria-selected="false" onclick="loadData('sold')">Sold</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="draft-tab" data-bs-toggle="pill" href="#draft"
                            role="tab" aria-controls="draft" aria-selected="false" onclick="loadData('draft')">Draft</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-bs-toggle="pill" href="#review"
                            role="tab" aria-controls="review" aria-selected="false" onclick="loadData('review')">Ready for
                            Review</a>
                    </li>
                </ul>

            </div>
            <div class="tab-content" id="myTabsContent">


                {{-- Publish tab --}}
                <div class="tab-pane fade show active" id="publish" role="tabpanel"
                    aria-labelledby="publish-tab">
                    <div class="table-responsive">
                        <table class="table" id="publish-table"> 
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
                                    <th scope="col" class="text-nowrap">Current Project</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="loader-row">
                                    <td colspan="9" class="text-center">
                                        <div class="spinner-border my-5" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>




                {{-- Archive tab --}}
                <div class="tab-pane fade" id="archive" role="tabpanel" aria-labelledby="archive-tab">
                    <div class="table-responsive">
                        <table class="table" id="archive-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="loader-row">
                                    <td colspan="9" class="text-center">
                                        <div class="spinner-border my-5" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>




                {{-- sold tab --}}
                <div class="tab-pane fade" id="sold" role="tabpanel" aria-labelledby="sold-tab">
                    <div class="table-responsive">
                        <table class="table" id="sold-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <tr id="loader-row">
                                    <td colspan="9" class="text-center">
                                        <div class="spinner-border my-5" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>




                {{-- Draft tab --}}
                <div class="tab-pane fade" id="draft" role="tabpanel" aria-labelledby="draft-tab">
                    <div class="table-responsive">
                        <table class="table" id="draft-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="loader-row">
                                    <td colspan="9" class="text-center">
                                        <div class="spinner-border my-5" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>




                {{-- Draft tab --}}
                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="table-responsive">
                        <table class="table" id="review-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-nowrap">Posting Date</th>
                                    <th scope="col" class="text-nowrap">Updated date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="loader-row">
                                    <td colspan="9" class="text-center">
                                        <div class="spinner-border my-5" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection


@section('script')
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
function updateCurrentProject(selectElement, itemId, isChecked)
{
    var csrfToken = '{{ csrf_token() }}';
    // Make an Ajax call
    $.ajax({
        url: '{{ route("home_for_sale.update_current_project") }}',  // Replace with your actual route
        method: 'POST',
        data: {
            _token: csrfToken, 
            id: itemId,
            is_current_project: isChecked
        },
        success: function (response) {
            // Handle success response if needed
            console.log(response.success);
            var SweetAlert_custom = {
                init: function() {
                    if (response.success) {
                        swal("Success", response.massage, "success");
                    }
                    
                    if (response.error) {
                        swal("Error", response.massage, "error");
                    }
                }
            };
            (function($) {
                SweetAlert_custom.init()
            })(jQuery);
        },
        error: function (error) {
            // Handle error if needed
            console.error(error);
        }
    });
}
 
</script>


<script>
    function loadData(tab) {
        currentTab = tab;
        // Make an Ajax call to fetch data based on the selected tab
        $.ajax({
            url: '{{ route("get_home_sale_details") }}',
            method: 'GET',
            data: { tab: tab }, // Pass the selected tab as a parameter
            success: function (response) {
                // Handle the success response and update the corresponding table
                switch (tab) {
                    case 'publish':
                        $('#publish-table').html(response.tableContent);
                        break;
                    case 'archive':
                        $('#archive-table').html(response.tableContent);
                        break;
                    case 'sold':
                        $('#sold-table').html(response.tableContent);
                        break;
                    case 'draft':
                        $('#draft-table').html(response.tableContent);
                        break;
                    case 'review':
                        $('#review-table').html(response.tableContent);
                        break;
                    default:
                        break;
                }
            },
            error: function (error) {
                // Handle the error if needed
                console.error(error);
            }
        });
    }

    // Initial load for the 'Published' tab
    loadData('publish');
</script>


<script>
  function updateStatus(selectElement, itemId) {
    var newStatus = selectElement.value;
    // Log the selected value to the console
    console.log("Selected Status:", newStatus);

    // Make an AJAX request to update the status in the database
    $.ajax({
        url: "{{ route('home_for_sale.update_status', ['id' => '__itemId__']) }}".replace('__itemId__', itemId),
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            status: newStatus
        },
        success: function(response) {

            // Handle success (optional)

            // Update the UI (as in your original code)
                // Use jQuery to remove classes
                $('.badge' + itemId).removeClass('badge-success badge-warning badge-secondary badge-light badge-danger');

               switch (newStatus) {
                    case 'publish':
                        $('.badge' + itemId).addClass('badge-success').text('Published');
                        break;
                    case 'rented':
                        $('.badge' + itemId).addClass('badge-warning').text('Rented');
                        break;
                    case 'archive':
                        $('.badge' + itemId).addClass('badge-secondary').text('Archived');
                        break;
                    case 'review':
                        $('.badge' + itemId).addClass('badge-danger').text('Ready For Review');
                        break;
                    case 'draft':
                        $('.badge' + itemId).addClass('badge-light').text('Draft');
                        break;
                }
                loadData(currentTab);
            // If the selected status is 'sold', dynamically load and display the sold data
        },
        error: function(error) {
            console.error("Error updating status:", error);
            alert('Failed to update status. Please try again.');
            // Handle error (optional)
        }
    });
}


</script>


@endsection
