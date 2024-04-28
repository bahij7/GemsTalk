<div class="profile">
    <div class="profile-head">
        <h2>Delete Account</h2>
        <span>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</span>
        <form action="{{ route('profile.destroy')}}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')" style="margin-bottom: 2%">
            @csrf
            @method('DELETE')
            <button type="submit">Delete Account</button>
        </form>
    </div>
</div>