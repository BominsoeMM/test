<div class="sidebar min-vh-100  " >
    <ul>
        <li class="my-3">
            <a href="{{ route('home') }}" >
                <img src="{{ asset('images/logos/logo-removebg-preview.png') }}" class="brand-logo" height="50" alt="">
            </a>
        </li>
        <li>
            <x-side-bar-spacer></x-side-bar-spacer>
        </li>
        <li>
            <x-side-bar-link name="home" link="{{ route('home') }}" class="fas fa-home"></x-side-bar-link>
        </li>
        <li>
            <x-side-bar-link name="test" link="{{ route('test') }}" >User</x-side-bar-link>
        </li>
        <li>
            <x-side-bar-spacer></x-side-bar-spacer>
        </li>
        <li>
            <x-side-bar-title>Category</x-side-bar-title>
        </li>
        <li>
            <x-side-bar-link name="Manage Category" link="{{ route('category.index') }}" class="bi bi-kanban-fill"></x-side-bar-link>
        </li>
        <li>
            <x-side-bar-link name="Create Category" link="{{ route('category.create') }}" class="bi bi-node-plus-fill"></x-side-bar-link>
        </li>
        <li>
            <x-side-bar-title>Post</x-side-bar-title>
        </li>
        <li>
            <x-side-bar-link name="Manage Post" link="{{ route('post.index') }}" class="bi bi-list-columns"></x-side-bar-link>
        </li>
        <li>
            <x-side-bar-link name="Create Post" link="{{ route('post.create') }}" class="bi bi-file-post"></x-side-bar-link>
        </li>
        <li>
            <x-side-bar-title>Profile</x-side-bar-title>
        </li>
        <li>
            <x-side-bar-link name="Manage Profile" link="{{ route('profile.index') }}" class="fas fa-user"></x-side-bar-link>
        </li>
        <li>
            <x-side-bar-link name="Update Photo" link="{{ route('profile.update-photo') }}" class="fas fa-image"></x-side-bar-link>
        </li>
        <li>
            <x-side-bar-link name="Change Password" link="{{ route('profile.change-password') }}" class="fas fa-key"></x-side-bar-link>
        </li>


        <li>
            <x-side-bar-spacer></x-side-bar-spacer>
        </li>
        <li>
            <a href="#" class="sidebar-link bg-light" onclick="document.getElementById('logoutForm').submit()">
                <i class="fas fa-unlock fa-fw sidebar-link-icon"></i>
                Logout
            </a>
        </li>
    </ul>
</div>
