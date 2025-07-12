<table>
    
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
            <th>Vai trò</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
            <td>{{ $user->role }}</td>
        </tr>
        @endforeach
    </tbody>
</table>