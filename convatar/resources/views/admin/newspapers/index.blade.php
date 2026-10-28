@extends('admin.layout')
@section('title', 'Manage Newspapers')
@section('content')
    <div class="admin-title-row">
        <div>
            <h1>Newspapers and websites</h1>
            <p>Add or update links and logos displayed on the home page.</p>
        </div><a class="button" href="{{ route('admin.newspapers.create') }}">+ Add newspaper</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>URL</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($newspapers as $newspaper)
                    <tr>
                        <td>
                            <div class="admin-name">
                                @if ($newspaper->logo)
                                    <img src="{{ $newspaper->logo_url }}" alt="" width="40" height="30">
                                @endif {{ $newspaper->name }}
                            </div>
                        </td>
                        <td>{{ $newspaper->category?->title ?? '—' }}</td>
                        <td class="url-cell">{{ $newspaper->url }}</td>
                        <td>{{ $newspaper->sort_order }}</td>
                        <td>{{ $newspaper->is_active ? 'Active' : 'Inactive' }}</td>
                        <td class="actions"><a href="{{ route('admin.newspapers.edit', $newspaper) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.newspapers.destroy', $newspaper) }}"
                                onsubmit="return confirm('Delete this newspaper?')">@csrf @method('DELETE')<button
                                    class="link-danger" type="submit">Delete</button></form>
                        </td>
                    </tr>
                @empty <tr>
                        <td colspan="6">No newspapers yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $newspapers->links() }}
@endsection
