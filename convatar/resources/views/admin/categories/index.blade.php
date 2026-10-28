@extends('admin.layout')
@section('title', 'Manage Categories')
@section('content')
    <div class="admin-title-row">
        <div>
            <h1>Newspaper Categories</h1>
            <p>Manage the sections shown on the public website.</p>
        </div><a class="button" href="{{ route('admin.newspaper-categories.create') }}">+ Add category</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Newspapers</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->newspapers_count }}</td>
                        <td>{{ $category->sort_order }}</td>
                        <td>{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                        <td class="actions"><a href="{{ route('admin.newspaper-categories.edit', $category) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.newspaper-categories.destroy', $category) }}"
                                onsubmit="return confirm('Delete this category and its newspapers?')">@csrf
                                @method('DELETE')<button class="link-danger" type="submit">Delete</button></form>
                        </td>
                    </tr>
                @empty <tr>
                        <td colspan="6">No categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
@endsection
