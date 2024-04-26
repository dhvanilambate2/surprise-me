<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

 <div class="table-responsive">
                        <table class="table" id="publish-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-nowrap">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-nowrap">Number</th>
                                    @if($currentTab != "contact")
                                    <th scope="col" class="text-nowrap">Property Name</th>
                                    @endif
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
            @foreach ($inquiriesDetails as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td class="truncate-text">{{ $item->email}}</td>
                    <td class="">{{ $item->number }}</td>
                    @if($currentTab != "contact")
                    <td class="">
                        @if($item->HomeDetails->home_for == 'rent')
                            <a href="{{ route('home_for_rent.details', $item->HomeDetails->id) }}" target="_blank">{{ $item->HomeDetails->property_name }}</a>
                        @else
                            <a href="{{ route('home_for_sale.details', $item->HomeDetails->id) }}" target="_blank">{{ $item->HomeDetails->property_name }}</a>
                        @endif
                    </td>
                    @endif
                    <td class="text-nowrap">
                           <a href="{{ route('inquiries.show', $item->id) }}"><button
                                 class="btn btn-shadow-secondary btn-sm px-3">View </button></a>
                           <!-- Button trigger modal -->
                           @can('Inquiries-delete')
                           <button class="btn text-danger px-2" type="button" data-toggle="modal"
                              data-original-title="test" data-target="#exampleModal{{$item->id}}"><i
                                 data-feather="trash-2"></i></button>
                                 @endcan
                           <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog"
                              aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                       <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                             aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                       Are you sure you want to delete this record?
                                    </div>
                                    <div class="modal-footer">
                                       <button class="btn btn-secondary" type="button"
                                          data-dismiss="modal">Cancel</button>

                                       {{-- Form for calling the destroy method --}}
                                       <form action="{{ route('inquiries.destroy', $item->id) }}" method="POST">
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