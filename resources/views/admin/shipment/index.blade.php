<a href="{{ url('admin/shipment/create') }}">Add New</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Reff</th>
                <th>Name</th>
                <th>Active</th>
                <th>status</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($shipment as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->shipment_parent_id }}</td>
                <td>{{ $item->shipment_name }}</td>
                <td>{{ $item->shipment_is_usable }}</td>
                <td>{{ $item->shipment_status }}</td>
                <td>{{ $item->shipment_note }}</td>
                <td>
                    <a href="{{ url('/admin/shipment/show/' . $item->id) }}"><button>View</button></a>
                    <a href="{{ url('/admin/shipment/edit/' . $item->id) }}"><button>Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['/admin/shipment', $item->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'title' => 'Delete blog',
                                'onclick'=>'return confirm("Confirm delete?")'
                        )) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div> {!! $shipment->appends(['search' => Request::get('search')])->render() !!} </div>
    {!! (isset($footer_script))? $footer_script:'' !!}
