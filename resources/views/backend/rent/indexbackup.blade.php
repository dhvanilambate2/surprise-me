@extends('layouts.simple.master')
@section('title', 'Home For Rent')
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
    </style>
@endsection
@section('style')
@endsection
@section('breadcrumb-title')
    <h2>Data of <span>Home For Rent</span></h2>
@endsection
@section('breadcrumb-items')
    <li class="breadcrumb-item">Properties</li>
    <li class="breadcrumb-item">Home For Rent</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12 xl-100 col-lg-12 box-col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="pull-left">Home For Rent</h5>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-9">
                                        
                                    </div>
                                     <div class="col-md-3">
                                        <a href="<?= route('home_for_rent.create') ?>"><button class="btn btn-primary btn-sm ml-5">Add Home for Rent</button></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tabbed-card">
                                        <ul class="pull-right nav nav-pills nav-primary" id="myTabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="tab1-tab" data-bs-toggle="pill"
                                                    href="#tab1" role="tab" aria-controls="tab1"
                                                    aria-selected="true">Published</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab2-tab" data-bs-toggle="pill" href="#tab2"
                                                    role="tab" aria-controls="tab2" aria-selected="false">Archived</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab3-tab" data-bs-toggle="pill" href="#tab3"
                                                    role="tab" aria-controls="tab3" aria-selected="false">Rent</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab4-tab" data-bs-toggle="pill" href="#tab4"
                                                    role="tab" aria-controls="tab4" aria-selected="false">Draft</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tab5-tab" data-bs-toggle="pill" href="#tab5"
                                                    role="tab" aria-controls="tab5" aria-selected="false">Ready for
                                                    Review</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabsContent">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                                aria-labelledby="tab1-tab">
                                                <div class="table-responsive" id="publish">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col" class="text-nowrap">Property Name</th>
                                                                <th scope="col">Address</th>
                                                                <th scope="col">Change Status</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col" class="text-nowrap">Posting Date</th>
                                                                <th scope="col" class="text-nowrap">Updated date</th>
                                                                <th scope="col" class="text-nowrap">Currnet Project</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($homeDetails as $item)
                                                                @php
                                                                    switch ($item->status) {
                                                                        case 'draft':
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Draft';
                                                                            break;
                                                                        case 'review':
                                                                            $class = 'badge-danger';
                                                                            $badge_name = 'Ready For Review';
                                                                            break;
                                                                        case 'publish':
                                                                            $class = 'badge-success';
                                                                            $badge_name = 'Published';
                                                                            break;
                                                                        case 'rent':
                                                                            $class = 'badge-warning';
                                                                            $badge_name = 'rent';
                                                                            break;
                                                                        case 'archive':
                                                                            $class = 'badge-secondary';
                                                                            $badge_name = 'archive';
                                                                            break;
                                                                        default:
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Unknown';
                                                                            break;
                                                                    }
                                                                @endphp

                                                                @if ($item->status == 'publish')
                                                                    <tr>
                                                                        <th scope="row">{{ $item->id }}</th>
                                                                        <td>{{ $item->property_name }}</td>
                                                                        <td class="truncate-text">{{ $item->address }}</td>
                                                                        <td class="truncate-text">
                                                                            <!-- Add a dropdown for the 'Status' column -->
                                                                            <select class="form-control form-control-sm"
                                                                                onchange="updateStatus(this, {{ $item->id }},'publish')">
                                                                                <option value="publish"
                                                                                    {{ $item->status == 'publish' ? 'selected' : '' }}>
                                                                                    Publish</option>
                                                                                <option value="rent"
                                                                                    {{ $item->status == 'rent' ? 'selected' : '' }}>
                                                                                    Rent</option>
                                                                                <option value="archive"
                                                                                    {{ $item->status == 'archive' ? 'selected' : '' }}>
                                                                                    Archive</option>
                                                                                <option value="draft"
                                                                                    {{ $item->status == 'draft' ? 'selected' : '' }}>
                                                                                    Draft
                                                                                </option>
                                                                                <option value="review"
                                                                                    {{ $item->status == 'review' ? 'selected' : '' }}>
                                                                                    Ready for review
                                                                                </option>
                                                                            </select>

                                                                        </td>
                                                                        <td class="truncate-text">
                                                                            <span
                                                                                class="badge badge-pill {{ $class }}">{{ $badge_name }}</span>
                                                                        </td>
                                                                        <td>{{ $item->created_at }}</td>
                                                                        <td>{{ $item->updated_at }}</td>
                                                                        <td class="text-center">
                                                                            <input class="current-project-checkbox"
                                                                                data-item-id="{{ $item->id }}"
                                                                                type="checkbox"
                                                                                {{ $item->current_project == '1' ? 'checked' : '' }}>
                                                                        </td>
                                                                        <td class="text-nowrap">
                                                                            <a href="{{ route('home_for_rent.details', ['id' => $item->id]) }}"
                                                                                target="_blank">
                                                                                <button
                                                                                    class="btn btn-shadow-secondary btn-sm px-3">Preview</button>
                                                                            </a>
                                                                            <a
                                                                                href="{{ route('home_for_rent.edit', $item->id) }}">
                                                                                <button
                                                                                    class="btn btn-shadow-primary btn-sm">Edit</button>
                                                                            </a>
                                                                            <!-- Button trigger modal -->
                                                                            <button class="btn text-danger px-2"
                                                                                type="button" data-toggle="modal"
                                                                                data-original-title="test"
                                                                                data-target="#exampleModal{{ $item->id }}">
                                                                                <i data-feather="trash-2"></i>
                                                                            </button>
                                                                            <div class="modal fade"
                                                                                id="exampleModal{{ $item->id }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                Confirm Deletion</h5>
                                                                                            <button class="close"
                                                                                                type="button"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close"><span
                                                                                                    aria-hidden="true">×</span></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Are you sure you want to delete
                                                                                            this record?
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button
                                                                                                class="btn btn-secondary"
                                                                                                type="button"
                                                                                                data-dismiss="modal">Cancel</button>

                                                                                            {{-- Form for calling the destroy method --}}
                                                                                            <form
                                                                                                action="{{ route('home_for_sale.destroy', $item->id) }}"
                                                                                                method="POST">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">Delete</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Modal -->
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab2" role="tabpanel"
                                                aria-labelledby="tab2-tab">
                                                <div class="table-responsive" id="archive">
                                                    <!--<p>Archived</p>-->
                                                    <table class="table">
                                                        <thead>
                                                            <th scope="col">#</th>
                                                            <th scope="col" class="text-nowrap">Property Name</th>
                                                            <th scope="col">Address</th>
                                                            <th scope="col">Change Status</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col" class="text-nowrap">Posting Date</th>
                                                            <th scope="col" class="text-nowrap">Updated date</th>
                                                            <th scope="col">Action</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($homeDetails as $item)
                                                             @php
                                                                    switch ($item->status) {
                                                                        case 'draft':
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Draft';
                                                                            break;
                                                                        case 'review':
                                                                            $class = 'badge-danger';
                                                                            $badge_name = 'Ready For Review';
                                                                            break;
                                                                        case 'publish':
                                                                            $class = 'badge-success';
                                                                            $badge_name = 'Published';
                                                                            break;
                                                                        case 'rent':
                                                                            $class = 'badge-warning';
                                                                            $badge_name = 'rent';
                                                                            break;
                                                                        case 'archive':
                                                                            $class = 'badge-secondary';
                                                                            $badge_name = 'archive';
                                                                            break;
                                                                        default:
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Unknown';
                                                                            break;
                                                                    }
                                                                @endphp
                                                                @if ($item->status == 'archive')
                                                                    <tr>
                                                                        <th scope="row">{{ $item->id }}</th>
                                                                        <td>{{ $item->property_name }}</td>
                                                                        <td class="truncate-text">{{ $item->address }}
                                                                        </td>
                                                                        <td class="truncate-text">
                                                                            <!-- Add a dropdown for the 'Status' column -->
                                                                            <select class="form-control form-control-sm"
                                                                                onchange="updateStatus(this, {{ $item->id }},'archive')">
                                                                                <option value="publish"
                                                                                    {{ $item->status == 'publish' ? 'selected' : '' }}>
                                                                                    Publish
                                                                                </option>
                                                                                <option value="rent"
                                                                                    {{ $item->status == 'rent' ? 'selected' : '' }}>
                                                                                    Rent</option>
                                                                                <option value="archive"
                                                                                    {{ $item->status == 'archive' ? 'selected' : '' }}>
                                                                                    Archive
                                                                                </option>
                                                                                <option value="draft"
                                                                                    {{ $item->status == 'draft' ? 'selected' : '' }}>
                                                                                    Draft
                                                                                </option>
                                                                                <option value="review"
                                                                                    {{ $item->status == 'review' ? 'selected' : '' }}>
                                                                                    Ready for review
                                                                                </option>
                                                                            </select>
                                                                        </td>
                                                                        <td class="truncate-text">
                                                                            <span
                                                                                class="badge badge-pill {{ $class }}">{{ $badge_name }}</span>
                                                                        </td>
                                                                        <td>{{ $item->created_at }}</td>
                                                                        <td>{{ $item->updated_at }}</td>
                                                                        <!--<td class="text-center">-->
                                                                        <!--    <input class="current-project-checkbox" data-item-id="{{ $item->id }}" type="checkbox" {{ $item->current_project == '1' ? 'checked' : '' }}>-->
                                                                        <!--</td>-->
                                                                        <td class="text-nowrap">
                                                                            <a href="{{ route('home_for_rent.details', ['id' => $item->id]) }}"
                                                                                target="_blank">
                                                                                <button
                                                                                    class="btn btn-shadow-secondary btn-sm px-3">Preview</button>
                                                                            </a>
                                                                            <a
                                                                                href="{{ route('home_for_rent.edit', $item->id) }}">
                                                                                <button
                                                                                    class="btn btn-shadow-primary btn-sm">Edit</button>
                                                                            </a>
                                                                            <!-- Button trigger modal -->
                                                                            <button class="btn text-danger px-2"
                                                                                type="button" data-toggle="modal"
                                                                                data-original-title="test"
                                                                                data-target="#exampleModal{{ $item->id }}">
                                                                                <i data-feather="trash-2"></i>
                                                                            </button>
                                                                            <div class="modal fade"
                                                                                id="exampleModal{{ $item->id }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                Confirm Deletion</h5>
                                                                                            <button class="close"
                                                                                                type="button"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close"><span
                                                                                                    aria-hidden="true">×</span></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Are you sure you want to delete
                                                                                            this record?
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button
                                                                                                class="btn btn-secondary"
                                                                                                type="button"
                                                                                                data-dismiss="modal">Cancel</button>

                                                                                            {{-- Form for calling the destroy method --}}
                                                                                            <form
                                                                                                action="{{ route('home_for_sale.destroy', $item->id) }}"
                                                                                                method="POST">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">Delete</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Modal -->
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab3" role="tabpanel"
                                                aria-labelledby="tab3-tab">
                                                <div class="table-responsive" id="rent">
                                                    <!--<p>Sold</p>-->
                                                    <table class="table">
                                                        <thead>
                                                            <th scope="col">#</th>
                                                            <th scope="col" class="text-nowrap">Property Name</th>
                                                            <th scope="col">Address</th>
                                                            <th scope="col">Change Status</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col" class="text-nowrap">Posting Date</th>
                                                            <th scope="col" class="text-nowrap">Updated date</th>
                                                            <th scope="col">Action</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($homeDetails as $item)
                                                             @php
                                                                    switch ($item->status) {
                                                                        case 'draft':
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Draft';
                                                                            break;
                                                                        case 'review':
                                                                            $class = 'badge-danger';
                                                                            $badge_name = 'Ready For Review';
                                                                            break;
                                                                        case 'publish':
                                                                            $class = 'badge-success';
                                                                            $badge_name = 'Published';
                                                                            break;
                                                                        case 'rent':
                                                                            $class = 'badge-warning';
                                                                            $badge_name = 'rent';
                                                                            break;
                                                                        case 'archive':
                                                                            $class = 'badge-secondary';
                                                                            $badge_name = 'archive';
                                                                            break;
                                                                        default:
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Unknown';
                                                                            break;
                                                                    }
                                                                @endphp
                                                                @if ($item->status == 'rent')
                                                                    <tr>
                                                                        <th scope="row">{{ $item->id }}</th>
                                                                        <td>{{ $item->property_name }}</td>
                                                                        <td class="truncate-text">{{ $item->address }}
                                                                        </td>
                                                                        <td class="truncate-text">
                                                                            <!-- Add a dropdown for the 'Status' column -->
                                                                            <select class="form-control form-control-sm"
                                                                                onchange="updateStatus(this, {{ $item->id }},'rent')">
                                                                                <option value="publish"
                                                                                    {{ $item->status == 'publish' ? 'selected' : '' }}>
                                                                                    Publish
                                                                                </option>
                                                                                <option value="rent"
                                                                                    {{ $item->status == 'rent' ? 'selected' : '' }}>
                                                                                    Rent</option>
                                                                                <option value="archive"
                                                                                    {{ $item->status == 'archive' ? 'selected' : '' }}>
                                                                                    Archive
                                                                                </option>
                                                                                <option value="draft"
                                                                                    {{ $item->status == 'draft' ? 'selected' : '' }}>
                                                                                    Draft
                                                                                </option>
                                                                                <option value="review"
                                                                                    {{ $item->status == 'review' ? 'selected' : '' }}>
                                                                                    Ready for review
                                                                                </option>
                                                                            </select>
                                                                        </td>
                                                                        <td class="truncate-text">
                                                                            <span
                                                                                class="badge badge-pill {{ $class }}">{{ $badge_name }}</span>
                                                                        </td>
                                                                        <td>{{ $item->created_at }}</td>
                                                                        <td>{{ $item->updated_at }}</td>
                                                                        <!--<td class="text-center">-->
                                                                        <!--    <input class="current-project-checkbox" data-item-id="{{ $item->id }}" type="checkbox" {{ $item->current_project == '1' ? 'checked' : '' }}>-->
                                                                        <!--</td>-->
                                                                        <td class="text-nowrap">
                                                                            <a href="{{ route('home_for_rent.details', ['id' => $item->id]) }}"
                                                                                target="_blank">
                                                                                <button
                                                                                    class="btn btn-shadow-secondary btn-sm px-3">Preview</button>
                                                                            </a>
                                                                            <a
                                                                                href="{{ route('home_for_rent.edit', $item->id) }}">
                                                                                <button
                                                                                    class="btn btn-shadow-primary btn-sm">Edit</button>
                                                                            </a>
                                                                            <!-- Button trigger modal -->
                                                                            <button class="btn text-danger px-2"
                                                                                type="button" data-toggle="modal"
                                                                                data-original-title="test"
                                                                                data-target="#exampleModal{{ $item->id }}">
                                                                                <i data-feather="trash-2"></i>
                                                                            </button>
                                                                            <div class="modal fade"
                                                                                id="exampleModal{{ $item->id }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                Confirm Deletion</h5>
                                                                                            <button class="close"
                                                                                                type="button"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close"><span
                                                                                                    aria-hidden="true">×</span></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Are you sure you want to delete
                                                                                            this record?
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button
                                                                                                class="btn btn-secondary"
                                                                                                type="button"
                                                                                                data-dismiss="modal">Cancel</button>

                                                                                            {{-- Form for calling the destroy method --}}
                                                                                            <form
                                                                                                action="{{ route('home_for_sale.destroy', $item->id) }}"
                                                                                                method="POST">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">Delete</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab4" role="tabpanel"
                                                aria-labelledby="tab4-tab">
                                                <div class="table-responsive" id="draft">
                                                    <!--<p>Archived</p>-->
                                                    <table class="table">
                                                        <thead>
                                                            <th scope="col">#</th>
                                                            <th scope="col" class="text-nowrap">Property Name</th>
                                                            <th scope="col">Address</th>
                                                            <th scope="col">Change Status</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col" class="text-nowrap">Posting Date</th>
                                                            <th scope="col" class="text-nowrap">Updated date</th>
                                                            <th scope="col">Action</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($homeDetails as $item)
                                                             @php
                                                                    switch ($item->status) {
                                                                        case 'draft':
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Draft';
                                                                            break;
                                                                        case 'review':
                                                                            $class = 'badge-danger';
                                                                            $badge_name = 'Ready For Review';
                                                                            break;
                                                                        case 'publish':
                                                                            $class = 'badge-success';
                                                                            $badge_name = 'Published';
                                                                            break;
                                                                        case 'rent':
                                                                            $class = 'badge-warning';
                                                                            $badge_name = 'rent';
                                                                            break;
                                                                        case 'archive':
                                                                            $class = 'badge-secondary';
                                                                            $badge_name = 'archive';
                                                                            break;
                                                                        default:
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Unknown';
                                                                            break;
                                                                    }
                                                                @endphp
                                                                @if ($item->status == 'draft')
                                                                    <tr>
                                                                        <th scope="row">{{ $item->id }}</th>
                                                                        <td>{{ $item->property_name }}</td>
                                                                        <td class="truncate-text">{{ $item->address }}
                                                                        </td>
                                                                        <td class="truncate-text">
                                                                            <!-- Add a dropdown for the 'Status' column -->
                                                                            <select class="form-control form-control-sm"
                                                                                onchange="updateStatus(this, {{ $item->id }},'draft')">
                                                                                <option value="publish"
                                                                                    {{ $item->status == 'publish' ? 'selected' : '' }}>
                                                                                    Publish
                                                                                </option>
                                                                                <option value="rent"
                                                                                    {{ $item->status == 'rent' ? 'selected' : '' }}>
                                                                                    Rent</option>
                                                                                <option value="archive"
                                                                                    {{ $item->status == 'archive' ? 'selected' : '' }}>
                                                                                    Archive
                                                                                </option>
                                                                                <option value="draft"
                                                                                    {{ $item->status == 'draft' ? 'selected' : '' }}>
                                                                                    Draft
                                                                                </option>
                                                                                <option value="review"
                                                                                    {{ $item->status == 'review' ? 'selected' : '' }}>
                                                                                    Ready for review
                                                                                </option>
                                                                            </select>
                                                                        </td>
                                                                        <td class="truncate-text">
                                                                            <span
                                                                                class="badge badge-pill {{ $class }}">{{ $badge_name }}</span>
                                                                        </td>
                                                                        <td>{{ $item->created_at }}</td>
                                                                        <td>{{ $item->updated_at }}</td>
                                                                        <!--<td class="text-center">-->
                                                                        <!--    <input class="current-project-checkbox" data-item-id="{{ $item->id }}" type="checkbox" {{ $item->current_project == '1' ? 'checked' : '' }}>-->
                                                                        <!--</td>-->
                                                                        <td class="text-nowrap">
                                                                            <a href="{{ route('home_for_rent.details', ['id' => $item->id]) }}"
                                                                                target="_blank">
                                                                                <button
                                                                                    class="btn btn-shadow-secondary btn-sm px-3">Preview</button>
                                                                            </a>
                                                                            <a
                                                                                href="{{ route('home_for_rent.edit', $item->id) }}">
                                                                                <button
                                                                                    class="btn btn-shadow-primary btn-sm">Edit</button>
                                                                            </a>
                                                                            <!-- Button trigger modal -->
                                                                            <button class="btn text-danger px-2"
                                                                                type="button" data-toggle="modal"
                                                                                data-original-title="test"
                                                                                data-target="#exampleModal{{ $item->id }}">
                                                                                <i data-feather="trash-2"></i>
                                                                            </button>
                                                                            <div class="modal fade"
                                                                                id="exampleModal{{ $item->id }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                Confirm Deletion</h5>
                                                                                            <button class="close"
                                                                                                type="button"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close"><span
                                                                                                    aria-hidden="true">×</span></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Are you sure you want to delete
                                                                                            this record?
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button
                                                                                                class="btn btn-secondary"
                                                                                                type="button"
                                                                                                data-dismiss="modal">Cancel</button>

                                                                                            {{-- Form for calling the destroy method --}}
                                                                                            <form
                                                                                                action="{{ route('home_for_sale.destroy', $item->id) }}"
                                                                                                method="POST">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">Delete</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Modal -->
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab5" role="tabpanel"
                                                aria-labelledby="tab5-tab">
                                                <div class="table-responsive" id="review" style="display: none;">
                                                    <table class="table">
                                                        <thead>
                                                            <th scope="col">#</th>
                                                            <th scope="col" class="text-nowrap">Property Name</th>
                                                            <th scope="col">Address</th>
                                                            <th scope="col">Change Status</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col" class="text-nowrap">Posting Date</th>
                                                            <th scope="col" class="text-nowrap">Updated date</th>
                                                            <th scope="col">Action</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($homeDetails as $item)
                                                             @php
                                                                    switch ($item->status) {
                                                                        case 'draft':
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Draft';
                                                                            break;
                                                                        case 'review':
                                                                            $class = 'badge-danger';
                                                                            $badge_name = 'Ready For Review';
                                                                            break;
                                                                        case 'publish':
                                                                            $class = 'badge-success';
                                                                            $badge_name = 'Published';
                                                                            break;
                                                                        case 'rent':
                                                                            $class = 'badge-warning';
                                                                            $badge_name = 'rent';
                                                                            break;
                                                                        case 'archive':
                                                                            $class = 'badge-secondary';
                                                                            $badge_name = 'archive';
                                                                            break;
                                                                        default:
                                                                            $class = 'badge-light';
                                                                            $badge_name = 'Unknown';
                                                                            break;
                                                                    }
                                                                @endphp
                                                                @if ($item->status == 'review')
                                                                    <tr>
                                                                        <th scope="row">{{ $item->id }}</th>
                                                                        <td>{{ $item->property_name }}</td>
                                                                        <td class="truncate-text">{{ $item->address }}
                                                                        </td>
                                                                        <td class="truncate-text">
                                                                            <!-- Add a dropdown for the 'Status' column -->
                                                                            <select class="form-control form-control-sm"
                                                                                onchange="updateStatus(this, {{ $item->id }},'review')">
                                                                                <option value="publish"
                                                                                    {{ $item->status == 'publish' ? 'selected' : '' }}>
                                                                                    Publish
                                                                                </option>
                                                                                <option value="rent"
                                                                                    {{ $item->status == 'rent' ? 'selected' : '' }}>
                                                                                    Rent</option>
                                                                                <option value="archive"
                                                                                    {{ $item->status == 'archive' ? 'selected' : '' }}>
                                                                                    Archive
                                                                                </option>
                                                                                <option value="draft"
                                                                                    {{ $item->status == 'draft' ? 'selected' : '' }}>
                                                                                    Draft
                                                                                </option>
                                                                                <option value="review"
                                                                                    {{ $item->status == 'review' ? 'selected' : '' }}>
                                                                                    Ready for review
                                                                                </option>
                                                                            </select>
                                                                        </td>
                                                                        <td class="truncate-text">
                                                                            <span
                                                                                class="badge badge-pill {{ $class }}">{{ $badge_name }}</span>
                                                                        </td>
                                                                        <td>{{ $item->created_at }}</td>
                                                                        <td>{{ $item->updated_at }}</td>
                                                                        <!--<td class="text-center">-->
                                                                        <!--    <input class="current-project-checkbox" data-item-id="{{ $item->id }}" type="checkbox" {{ $item->current_project == '1' ? 'checked' : '' }}>-->
                                                                        <!--</td>-->
                                                                        <td class="text-nowrap">
                                                                            <a href="{{ route('home_for_rent.details', ['id' => $item->id]) }}"
                                                                                target="_blank">
                                                                                <button
                                                                                    class="btn btn-shadow-secondary btn-sm px-3">Preview</button>
                                                                            </a>
                                                                            <a
                                                                                href="{{ route('home_for_rent.edit', $item->id) }}">
                                                                                <button
                                                                                    class="btn btn-shadow-primary btn-sm">Edit</button>
                                                                            </a>
                                                                            <!-- Button trigger modal -->
                                                                            <button class="btn text-danger px-2"
                                                                                type="button" data-toggle="modal"
                                                                                data-original-title="test"
                                                                                data-target="#exampleModal{{ $item->id }}">
                                                                                <i data-feather="trash-2"></i>
                                                                            </button>
                                                                            <div class="modal fade"
                                                                                id="exampleModal{{ $item->id }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                Confirm Deletion</h5>
                                                                                            <button class="close"
                                                                                                type="button"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close"><span
                                                                                                    aria-hidden="true">×</span></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Are you sure you want to delete
                                                                                            this record?
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button
                                                                                                class="btn btn-secondary"
                                                                                                type="button"
                                                                                                data-dismiss="modal">Cancel</button>

                                                                                            {{-- Form for calling the destroy method --}}
                                                                                            <form
                                                                                                action="{{ route('home_for_sale.destroy', $item->id) }}"
                                                                                                method="POST">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">Delete</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Modal -->
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<!-- JavaScript function to handle tab change -->
<script>
    // Function to load and display data based on the selected status
    function loadDataForStatus(status) {
        switch (status) {
            case 'rent':
                loadRentData();
                break;
            case 'publish':
                loadPublishData();
                break;
            case 'archive':
                loadArchiveData();
                break;
            case 'draft':
                loadDraftData();
                break;
            case 'review':
                loadReviewData();
                break;
        }
    }

    // Function to load and display data for 'rent' status
    function loadRentData() {
        // Make an AJAX request to fetch rent-related data
        $.ajax({
            url: '{{ route('home_for_rent.get_rent_data') }}',
            method: 'GET',
            success: function (response) {
                console.log(response.html);

                // Update the content of the 'rent' table with the fetched data
                $('#rent tbody').html(response.html);

                // Show the 'rent' table and hide other tables
                $('#publish').hide();
                $('#archive').hide();
                $('#draft').hide();
                $('#review').hide();
                $('#rent').show();

                alert('Rent data loaded successfully.');
            },
            error: function (error) {
                console.error("Error fetching rent data:", error);
                alert('Failed to fetch rent data. Please try again.');
                // Handle error (optional)
            }
        });
    }

    // Function to load and display data for 'publish' status
    function loadPublishData() {
        // Make an AJAX request to fetch publish-related data
        $.ajax({
            url: '{{ route('home_for_rent.get_publish_data') }}',
            method: 'GET',
            success: function (response) {
                console.log(response);

                // Update the content of the 'publish' table with the fetched data
                $('#publish tbody').html(response);

                // Show the 'publish' table and hide other tables
                $('#archive').hide();
                $('#rent').hide();
                $('#draft').hide();
                $('#review').hide();
                $('#publish').show();

                alert('Publish data loaded successfully.');
            },
            error: function (error) {
                console.error("Error fetching publish data:", error);
                alert('Failed to fetch publish data. Please try again.');
                // Handle error (optional)
            }
        });
    }

    // Function to load and display data for 'archive' status
    function loadArchiveData() {
        // Make an AJAX request to fetch archive-related data
        $.ajax({
            url: '{{ route('home_for_rent.get_archive_data') }}',
            method: 'GET',
            success: function (response) {
                console.log(response);

                // Update the content of the 'archive' table with the fetched data
                $('#archive tbody').html(response);

                // Show the 'archive' table and hide other tables
                $('#publish').hide();
                $('#rent').hide();
                $('#draft').hide();
                $('#review').hide();
                $('#archive').show();

                alert('Archive data loaded successfully.');
            },
            error: function (error) {
                console.error("Error fetching archive data:", error);
                alert('Failed to fetch archive data. Please try again.');
                // Handle error (optional)
            }
        });
    }

    // Function to load and display data for 'draft' status
    function loadDraftData() {
        // Make an AJAX request to fetch draft-related data
        $.ajax({
            url: '{{ route('home_for_rent.get_draft_data') }}',
            method: 'GET',
            success: function (response) {
                console.log(response);

                // Update the content of the 'draft' table with the fetched data
                $('#draft tbody').html(response);

                // Show the 'draft' table and hide other tables
                $('#archive').hide();
                $('#rent').hide();
                $('#publish').hide();
                $('#review').hide();
                $('#draft').show();

                alert('Draft data loaded successfully.');
            },
            error: function (error) {
                console.error("Error fetching draft data:", error);
                alert('Failed to fetch Draft data. Please try again.');
                // Handle error (optional)
            }
        });
    }

    // Function to load and display data for 'review' status
    function loadReviewData() {
        // Make an AJAX request to fetch review-related data
        $.ajax({
            url: '{{ route('home_for_rent.get_review_data') }}',
            method: 'GET',
            success: function (response) {
                console.log(response);

                // Update the content of the 'review' table with the fetched data
                $('#review tbody').html(response);

                // Show the 'review' table and hide other tables
                $('#archive').hide();
                $('#rent').hide();
                $('#publish').hide();
                $('#draft').hide();
                $('#review').show();

                alert('Review data loaded successfully.');
            },
            error: function (error) {
                console.error("Error fetching review data:", error);
                alert('Failed to fetch Review data. Please try again.');
            }
        });
    }

    // Function to update status and handle UI changes
    function updateStatus(selectElement, itemId, currentStatus) {
        var newStatus = selectElement.value;
        console.log(itemId);
        // Log the selected value to the console
        console.log("Selected Status:", newStatus);

        // Make an AJAX request to update the status in the database
        $.ajax({
            url: '{{ route("admin.home_for_rent.update_status", ["id" => '__itemId__']) }}'.replace('__itemId__', itemId),
            method: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus
            },
            success: function (response) {
                console.log(response.message);

                // Handle success (optional)
                alert('Status updated successfully.');

                // Update the UI (as in your original code)
                var badgeElement = selectElement.parentNode.querySelector('.badge');

                // Check if selectElement and its parent are defined
                if (selectElement && selectElement.parentNode && badgeElement) {
                    badgeElement.classList.remove('badge-success', 'badge-warning', 'badge-secondary', 'badge-info', 'badge-light');

                    switch (newStatus) {
                        case 'publish':
                            badgeElement.classList.add('badge-success');
                            break;
                        case 'sold':
                            badgeElement.classList.add('badge-warning');
                            break;
                        case 'archive':
                            badgeElement.classList.add('badge-secondary');
                            break;
                        case 'draft':
                            badgeElement.classList.add('badge-light');
                            break;
                        case 'review':
                            badgeElement.classList.add('badge-info');
                            break;
                    }
                }

                // Dynamically load and display data based on the selected status
                loadDataForStatus(currentStatus);
            },
            error: function (error) {
                console.error("Error updating status:", error);
                alert('Failed to update status. Please try again.');
                // Handle error (optional)
            }
        });
    }

    // Event listener for when a tab is shown
    document.addEventListener('DOMContentLoaded', function () {
        $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
            var tabId = $(e.target).attr('href');
            var tabUrl = '{{ route("home_for_rent.get_tab_data", ["tab" => ":tab"]) }}'; // Use a placeholder for the tab parameter
            tabUrl = tabUrl.replace(':tab', tabId.substring(1)); // Replace the placeholder with the actual tab value

            // Fetch and display data for the selected tab
            loadData(tabId, tabUrl);
        });
    });
    
    // Function to fetch and display data based on the selected tab
    function loadData(tabId, tabUrl) {
        $.ajax({
            url: tabUrl,
            method: 'GET',
            success: function (data) {
                $(tabId).html(data.content);
            },
            error: function () {
                // Handle error if necessary
            }
        });
    }
</script>
            <script>
                $(document).ready(function() {
                    $('.current-project-checkbox').change(function() {
                        var itemId = $(this).data('item-id');
                        var isChecked = $(this).is(':checked');
                        // console.log('Checkbox State:', isChecked); // Log the checkbox state

                        var csrfToken = '{{ csrf_token() }}';
                        // Make an Ajax call
                        $.ajax({
                            url: '{{ route('home_for_sale.update_current_project') }}', // Replace with your actual route
                            method: 'POST',
                            data: {
                                _token: csrfToken,
                                id: itemId,
                                is_current_project: isChecked
                            },
                            success: function(response) {
                                // Handle success response if needed
                                console.log(response.success);
                                var SweetAlert_custom = {
                                    init: function() {
                                        if (response.success) {
                                            swal("Success", response.massage, "success");
                                        }
                                    }
                                };
                                (function($) {
                                    SweetAlert_custom.init()
                                })(jQuery);
                            },
                            error: function(error) {
                                // Handle error if needed
                                console.error(error);
                            }
                        });
                    });
                });
            </script>
            <script>
                // JavaScript to switch tabs based on URL hash
                document.addEventListener('DOMContentLoaded', function() {
                    var hash = window.location.hash;
                    if (hash) {
                        $(hash + '-tab').tab('show');
                    }

                    $('a[data-bs-toggle="pill"]').on('shown.bs.tab', function(e) {
                        var hash = e.target.hash;
                        window.location.hash = hash;
                    });
                });
            </script>
        @endsection