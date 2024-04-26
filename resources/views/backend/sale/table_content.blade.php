<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

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
                                    @if($currentTab == "publish")
                                    <th scope="col" class="text-nowrap">Current Project</th>
                                    @endif
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
                        case 'sold':
                            $class = 'badge-warning';
                            $badge_name = 'sold';
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
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->property_name }}</td>
                    <td class="truncate-text">{{ $item->address}}</td>
                    <td class="truncate-text">
                        <!-- Add a dropdown for the 'Status' column -->
                        <select class="form-control form-control-sm"
                                onchange="updateStatus(this, {{ $item->id }})">
                            <option value="publish" {{ $item->status == 'publish' ? 'selected' : '' }}>Publish</option>
                            <option value="sold" {{ $item->status == 'sold' ? 'selected' : '' }}>Sold</option>
                            <option value="archive" {{ $item->status == 'archive' ? 'selected' : '' }}>Archive</option>
                            <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="review" {{ $item->status == 'review' ? 'selected' : '' }}>Ready For Review</option>
                        </select>
                    </td>
                    <td class="truncate-text" id="status"><span class="badge badge{{$item->id}} badge-pill {{$class}}">{{$badge_name}}</span></td>
                    <td class="">{{ $item->created_at}}</td>
                    <td class="">{{ $item->updated_at}}</td>
                    @if($currentTab == "publish")
                    <td class="text-center">
                        {{-- <input class="current-project-checkbox" data-item-id="{{ $item->id }}" type="checkbox" {{ ($item->current_project == '1')? "checked" : '' }}> --}}
                        <input class="current-project-checkbox" onchange="updateCurrentProject(this, {{ $item->id }}, this.checked)"  type="checkbox" {{ ($item->current_project == '1')? "checked" : '' }}>
                    </td>
                    @endif


                    <td class="text-nowrap">
                            <a href="{{ route('home_for_sale.details', ['id' => $item->id]) }}" target="_blank"><button class="btn btn-shadow-secondary btn-sm px-3">Preview </button></a>
                            <a href="{{ route('home_for_sale.edit', $item->id) }}"><button class="btn btn-shadow-primary btn-sm">Edit </button></a>
                            <!-- Button trigger modal -->
                            
                            <button class="btn text-danger px-2" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal{{$item->id}}"><i data-feather="trash-2"></i></button>
                            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this record?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            
                                            {{-- Form for calling the destroy method --}}
                                            <form action="{{ route('home_for_sale.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                        
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
</div>

<script>
    feather.replace();
</script>