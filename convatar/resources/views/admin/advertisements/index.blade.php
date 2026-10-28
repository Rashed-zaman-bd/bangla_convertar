
@extends('layouts.admin')

@section('title', 'Manage Advertisements')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
        <h1>Manage Advertisements</h1>

        <a href="{{ route('admin.advertisements.create') }}">
            + Add Advertisement
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; margin-top:20px;">
            <thead>
                <tr>
                    <th style="text-align:left; padding:10px;">Image</th>
                    <th style="text-align:left; padding:10px;">Title</th>
                    <th style="text-align:left; padding:10px;">Position</th>
                    <th style="text-align:left; padding:10px;">Order</th>
                    <th style="text-align:left; padding:10px;">Status</th>
                    <th style="text-align:left; padding:10px;">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($advertisements as $advertisement)
                    <tr>
                        <td style="padding:10px;">
                            @if ($advertisement->image)
                                <img
                                    src="{{ asset('storage/' . $advertisement->image) }}"
                                    alt="{{ $advertisement->title }}"
                                    style="width:100px; height:auto;"
                                >
                            @else
                                No image
                            @endif
                        </td>

                        <td style="padding:10px;">
                            {{ $advertisement->title }}
                        </td>

                        <td style="padding:10px;">
                            {{ $advertisement->position }}
                        </td>

                        <td style="padding:10px;">
                            {{ $advertisement->sort_order }}
                        </td>

                        <td style="padding:10px;">
                            {{ $advertisement->is_active ? 'Active' : 'Inactive' }}
                        </td>

                        <td style="padding:10px;">
                            <a href="{{ route('admin.advertisements.edit', $advertisement) }}">
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.advertisements.destroy', $advertisement) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Delete this advertisement?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:20px; text-align:center;">
                            No advertisements found. Add your first advertisement.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $advertisements->links() }}
    </div>
@endsection
