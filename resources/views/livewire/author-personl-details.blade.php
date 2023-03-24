<div>
    <form method="post" wire:submit.prevent='UpdateDetails()'>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="example-text-input" wire:model='name' placeholder="Name">
                    @error('name') <span class="text-danger">{{$message}}</span>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="example-text-input" wire:model='username' placeholder="username">
                    @error('username') <span class="text-danger">{{$message}}</span>@enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="example-text-input" wire:model="email" disabled >
                    @error('email') <span class="text-danger">{{$message}}</span>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Biography</label>
                <textarea class="form-control" name="example-textarea-input" rows="6" wire:model='biography' placeholder="Content..">Biography</textarea>
                @error('biography') <span class="text-danger">{{$message}}</span>@enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>