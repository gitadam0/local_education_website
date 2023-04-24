<h1 class="display-1">Create post</h1>
<form class="form" method="POST" action="/dashboard/create">
    <div class="mb-3">
        <label class="form-label">Post title</label><span class="text-danger"> *</span>
        <input type="text" class="form-control"  placeholder="Post title" name="post_title" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Post description title</label><span class="text-danger"> *</span>
        <input type="text" class="form-control"  placeholder="Second title of post" name="post_description_title" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Post image link</label><span class="text-danger"> *</span>
        <input type="text" class="form-control"  placeholder="Post image link" name="post_image_link" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Post image alt</label><span class="text-danger"> *</span>
        <input type="text" class="form-control"  placeholder="Post image alt" name="post_image_alt" required>
    </div>
    <div class="mb-3">
        <select class="form-select" aria-label="Default select example" name="post_category">
            <option disabled selected value="none">Select category</option>
            <option value="Android">Android</option>
            <option value="IOS">IOS</option>
            <option value="React">React</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Post Body</label><span class="text-danger"> *</span>
        <textarea class="form-control"  rows="3" placeholder="body Ex: <p> Hello world! </p> " name="post_body" required></textarea>
    </div>
    <button class="btn btn-primary" name="submit">Publish</button>
</form>