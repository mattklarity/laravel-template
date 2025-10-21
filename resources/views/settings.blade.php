<form method="POST">
  @csrf
  <div class="form-group">
    <label class="form-label">API URL</label>
    <input name="api_url" class="form-control" value="{{ $settings['api_url'] ?? '' }}">
  </div>

  <div class="form-group mt-2">
    <label class="form-label">Enable feature</label>
    <input type="checkbox" name="enabled" value="1"
           @checked(!empty($settings['enabled']))>
  </div>

  <button class="btn btn-primary mt-3">Save</button>
</form>

