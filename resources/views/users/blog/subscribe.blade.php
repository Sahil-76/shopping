<div class="row bg-dark mt-3 border">
    <div class="col-12">
        <div class="bg-dark p-3 text-white">
            <h4>Subscribe</h4>
            <form action="{{ route('blog.subscribe') }}" method="post">
                @csrf
                <div class="input-group p-2">
                    <input type="email" name="gmail" id="blog_id" class="form-control" placeholder="Enter your email" required>
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                </div>
                @error('email')
                <span class="text-light">{{ $message }}</span>
                @enderror
            </form>
        </div>
    </div>
</div>
